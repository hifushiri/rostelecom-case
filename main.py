from fastapi import FastAPI, HTTPException, Request
from fastapi.responses import JSONResponse, HTMLResponse, FileResponse
from fastapi.middleware.cors import CORSMiddleware
from fastapi.staticfiles import StaticFiles
from fastapi.templating import Jinja2Templates
from contextlib import asynccontextmanager
import aiosqlite
from typing import Optional
import smtplib
from email.mime.text import MIMEText
from database import init_db, create_user, get_user_by_email, save_reset_code, verify_reset_code, update_user_password, create_project, get_all_projects, get_project_metrics
from schemas import UserCreate, UserLogin, ForgotPassword, VerifyCode, ResetPassword, UserResponse, ProjectCreate
from auth import hash_password, verify_password, create_access_token, generate_reset_code
import logging
from datetime import datetime, timedelta

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

SMTP_SERVER = "smtp.gmail.com"
SMTP_PORT = 587
SMTP_EMAIL = "your-email@gmail.com"
SMTP_PASSWORD = "your-app-password"

async def send_verification_code(email: str, code: str):
    try:
        msg = MIMEText(f"Ваш код подтверждения для входа: {code}")
        msg['Subject'] = 'Код подтверждения Ростелеком'
        msg['From'] = SMTP_EMAIL
        msg['To'] = email
        with smtplib.SMTP(SMTP_SERVER, SMTP_PORT) as server:
            server.starttls()
            server.login(SMTP_EMAIL, SMTP_PASSWORD)
            server.send_message(msg)
        logger.info(f"Код подтверждения отправлен на {email}: {code}")
    except Exception as e:
        logger.error(f"Ошибка отправки email на {email}: {str(e)}")
        logger.info(f"Код подтверждения: {code}")

@asynccontextmanager
async def lifespan(app: FastAPI):
    await init_db()
    yield

app = FastAPI(title="Ростелеком Управление проектами", lifespan=lifespan)

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

templates = Jinja2Templates(directory="templates")
app.mount("/static", StaticFiles(directory="static"), name="static")

@app.exception_handler(Exception)
async def global_exception_handler(request: Request, exc: Exception):
    logger.error(f"Необработанная ошибка: {str(exc)}")
    return JSONResponse(
        status_code=500,
        content={"detail": f"Внутренняя ошибка сервера: {str(exc)}"}
    )

@app.get("/", response_class=HTMLResponse)
async def root(request: Request):
    return templates.TemplateResponse("entrance.blade.php", {"request": request})

@app.get("/entrance", response_class=HTMLResponse)
async def get_entrance(request: Request):
    return templates.TemplateResponse("entrance.blade.php", {"request": request})

@app.get("/registration", response_class=HTMLResponse)
async def get_registration(request: Request):
    return templates.TemplateResponse("registration.blade.php", {"request": request})

@app.get("/forgot-password", response_class=HTMLResponse)
async def get_forgot_password(request: Request):
    return templates.TemplateResponse("forgot-password.blade.php", {"request": request})

@app.get("/reset-password", response_class=HTMLResponse)
async def get_reset_password(request: Request):
    return templates.TemplateResponse("reset-password.blade.php", {"request": request})

@app.get("/verify-code", response_class=HTMLResponse)
async def get_verify_code(request: Request):
    return templates.TemplateResponse("verify-code.blade.php", {"request": request})

@app.get("/project-card", response_class=HTMLResponse)
async def get_project_card(request: Request):
    current_date = datetime.now().strftime("%Y-%m-%d")
    return templates.TemplateResponse("project-card.blade.php", {
        "request": request,
        "current_date": current_date
    })

@app.get("/newpage", response_class=HTMLResponse)
async def get_newpage(request: Request):
    projects = await get_all_projects()
    metrics = await get_project_metrics()
    logger.info(f"Projects: {projects}")
    logger.info(f"Metrics: {metrics}")
    return templates.TemplateResponse("newpage.blade.php", {
        "request": request,
        "projects": projects,
        "metrics": metrics
    })

@app.get("/favicon.ico", response_class=FileResponse)
async def favicon():
    return FileResponse("static/favicon.ico")

@app.post("/register", response_model=UserResponse)
async def register(user: UserCreate):
    try:
        logger.info(f"Регистрация: email={user.email}, длина пароля={len(user.password)} символов")
        if len(user.password) < 8:
            raise HTTPException(status_code=400, detail="Пароль должен содержать минимум 8 символов")
        password_hash = hash_password(user.password)
        success = await create_user(user.name, user.email, password_hash)
        if not success:
            raise HTTPException(status_code=400, detail="Email уже зарегистрирован")
        user_db = await get_user_by_email(user.email)
        logger.info(f"Пользователь зарегистрирован: {user.email}")
        return user_db
    except Exception as e:
        logger.error(f"Ошибка при регистрации: {str(e)}")
        raise HTTPException(status_code=500, detail=f"Ошибка сервера: {str(e)}")

@app.post("/login")
async def login(user: UserLogin):
    try:
        logger.info(f"Попытка входа: email={user.email}")
        user_db = await get_user_by_email(user.email)
        if not user_db:
            logger.error(f"Пользователь с email {user.email} не найден")
            raise HTTPException(status_code=400, detail="Неверный email или пароль")
        if not verify_password(user.password, user_db["password_hash"]):
            logger.error(f"Неверный пароль для {user.email}")
            raise HTTPException(status_code=400, detail="Неверный email или пароль")
        code = generate_reset_code()
        await save_reset_code(user_db["email"], code)
        await send_verification_code(user_db["email"], code)
        access_token = create_access_token(data={"sub": user_db["email"]}, remember=user.remember)
        logger.info(f"Успешный вход: {user.email}")
        return {
            "access_token": access_token,
            "token_type": "bearer",
            "email": user_db["email"],
            "redirect": "/verify-code?email=" + user_db["email"]
        }
    except Exception as e:
        logger.error(f"Ошибка при входе: {str(e)}")
        raise HTTPException(status_code=500, detail=f"Ошибка сервера: {str(e)}")

@app.post("/forgot-password")
async def forgot_password(data: ForgotPassword):
    user_db = await get_user_by_email(data.email)
    if not user_db:
        raise HTTPException(status_code=400, detail="Укажите корректный email")
    code = generate_reset_code()
    await save_reset_code(data.email, code)
    await send_verification_code(data.email, code)
    logger.info(f"Код для восстановления пароля отправлен на {data.email}")
    return {"message": "Ссылка для сброса пароля отправлена на ваш email"}

@app.post("/verify-code")
async def verify_code(data: VerifyCode):
    try:
        is_valid = await verify_reset_code(data.email, data.code)
        if not is_valid:
            logger.error(f"Неверный код для {data.email}: {data.code}")
            raise HTTPException(status_code=400, detail="Неверный код")
        logger.info(f"Код подтвержден для {data.email}")
        return {"message": "Код подтвержден", "redirect": "/newpage"}
    except Exception as e:
        logger.error(f"Ошибка при проверке кода: {str(e)}")
        raise HTTPException(status_code=500, detail=f"Ошибка сервера: {str(e)}")

@app.post("/reset-password")
async def reset_password(data: ResetPassword):
    if data.password != data.password_confirmation:
        raise HTTPException(status_code=400, detail="Пароли не совпадают")
    user_db = await get_user_by_email(data.email)
    if not user_db:
        raise HTTPException(status_code=400, detail="Пользователь не найден")
    try:
        password_hash = hash_password(data.password)
        await update_user_password(data.email, password_hash)
        return {"message": "Пароль успешно обновлен"}
    except Exception as e:
        logger.error(f"Ошибка при обновлении пароля: {str(e)}")
        raise HTTPException(status_code=500, detail=f"Ошибка сервера: {str(e)}")

@app.post("/project")
async def create_project_endpoint(project: ProjectCreate):
    try:
        project_id = await create_project(project.dict())
        logger.info(f"Проект создан: {project.project_name} (ID: {project_id})")
        return {"message": "Проект успешно добавлен", "project_id": project_id}
    except Exception as e:
        logger.error(f"Ошибка при создании проекта: {str(e)}")
        raise HTTPException(status_code=500, detail=f"Ошибка сервера: {str(e)}")

if __name__ == "__main__":
    import uvicorn
    logger.info("Запуск сервера")
    uvicorn.run(app, host="0.0.0.0", port=8000)