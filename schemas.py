from pydantic import BaseModel, EmailStr
from typing import Optional, List

class UserCreate(BaseModel):
    name: str
    email: EmailStr
    password: str

class UserLogin(BaseModel):
    email: EmailStr
    password: str
    remember: bool = False

class ForgotPassword(BaseModel):
    email: EmailStr

class VerifyCode(BaseModel):
    email: EmailStr
    code: str

class ResetPassword(BaseModel):
    email: EmailStr
    password: str
    password_confirmation: str

class UserResponse(BaseModel):
    id: int
    name: str
    email: EmailStr
    created_at: str

class Revenue(BaseModel):
    year: int
    month: str
    amount: float
    status: str

class Cost(BaseModel):
    year: int
    month: str
    amount: float
    type: str
    status: str

class History(BaseModel):
    parameter: str
    date: str
    user: str
    change: str

class ProjectCreate(BaseModel):
    org_name: str
    org_inn: str
    project_name: str
    service: str
    payment_type: str
    stage: str
    probability: int
    manager: str
    business_segment: str
    year: str
    industry_manager: str
    project_number: str
    industry_solution: bool
    forecast_accepted: bool
    dzo_implementation: bool
    management_control: bool
    assessment_accepted: str
    created_at: str
    current_status: Optional[str] = None
    done_in_period: Optional[str] = None
    plans_for_next_period: Optional[str] = None
    revenues: List[Revenue] = []
    costs: List[Cost] = []
    history: List[History] = []