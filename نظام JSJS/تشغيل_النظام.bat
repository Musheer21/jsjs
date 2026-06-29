@echo off
setlocal
chcp 65001 > nul

rem --- Configuration ---
set "BASE_DIR=%~dp0"
for %%i in ("%BASE_DIR%") do set "SHORT_PATH=%%~si"
cd /d "%SHORT_PATH%"

echo.
echo ========================================
echo   Justice System Portable Launcher
echo ========================================
echo.

set "PHP_EXE=php.exe"
set "PHP_INI=php.ini"
set "PUBLIC_DIR=..\public"

cd /d "%SHORT_PATH%bin"

if not exist "%PHP_EXE%" (
    echo [ERROR] PHP engine not found in: %PHP_EXE%
    pause
    exit /b
)

echo [INFO] System is starting...
echo [INFO] URL: http://127.0.0.1:8888
echo.
echo [!] Keep this window open while using the system.
echo [!] To stop, close this window.
echo.

start http://127.0.0.1:8888
"%PHP_EXE%" -c "%PHP_INI%" -S 127.0.0.1:8888 -t "%PUBLIC_DIR%"

pause
