from passlib.context import CryptContext
from jose import JWTError, jwt
from datetime import datetime, timedelta
import secrets
import logging

logger = logging.getLogger(__name__)

# Настройки для хеширования паролей
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")

# Настройки для JWT
SECRET_KEY = "your-secret-key"  # Замените на свой секретный ключ
ALGORITHM = "HS256"
ACCESS_TOKEN_EXPIRE_MINUTES = 30

def hash_password(password: str) -> str:
    logger.info(f"Хеширование пароля, исходная длина: {len(password)} символов, {len(password.encode('utf-8'))} байт")
    # Обрезаем пароль до 72 байт
    password = password.encode('utf-8')[:72].decode('utf-8', errors='ignore')
    logger.info(f"Обрезанный пароль: длина {len(password)} символов, {len(password.encode('utf-8'))} байт")
    try:
        return pwd_context.hash(password)
    except Exception as e:
        logger.error(f"Ошибка bcrypt при хешировании: {str(e)}")
        raise

def verify_password(plain_password: str, hashed_password: str) -> bool:
    logger.info(f"Проверка пароля, исходная длина: {len(plain_password)} символов, {len(plain_password.encode('utf-8'))} байт")
    # Обрезаем пароль до 72 байт
    plain_password = plain_password.encode('utf-8')[:72].decode('utf-8', errors='ignore')
    logger.info(f"Обрезанный пароль: длина {len(plain_password)} символов, {len(plain_password.encode('utf-8'))} байт")
    try:
        return pwd_context.verify(plain_password, hashed_password)
    except Exception as e:
        logger.error(f"Ошибка bcrypt при проверке: {str(e)}")
        raise

def create_access_token(data: dict, expires_delta: timedelta = None, remember: bool = False) -> str:
    to_encode = data.copy()
    if remember:
        expire = datetime.utcnow() + timedelta(days=30)
    else:
        expire = datetime.utcnow() + (expires_delta or timedelta(minutes=ACCESS_TOKEN_EXPIRE_MINUTES))
    to_encode.update({"exp": expire})
    encoded_jwt = jwt.encode(to_encode, SECRET_KEY, algorithm=ALGORITHM)
    return encoded_jwt

def generate_reset_code() -> str:
    return secrets.token_urlsafe(6)