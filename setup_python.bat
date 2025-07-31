@echo off
echo Setting up Python environment for PneumoDetect...

REM Check if Python 3 is installed
python --version >nul 2>&1
if errorlevel 1 (
    echo Python is not installed. Please install Python 3.8 or higher.
    pause
    exit /b 1
)

REM Check Python version
for /f "tokens=2" %%i in ('python --version 2^>^&1') do set python_version=%%i
echo Python version: %python_version%

REM Install virtual environment
echo Installing virtual environment...
pip install virtualenv

REM Create virtual environment
echo Creating virtual environment...
python -m venv venv

REM Activate virtual environment
echo Activating virtual environment...
call venv\Scripts\activate.bat

REM Install requirements
echo Installing Python dependencies...
pip install -r requirements.txt

echo Setup completed successfully!
echo To activate the environment, run: venv\Scripts\activate.bat
pause 