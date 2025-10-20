@echo off
echo ========================================
echo   ARMERIA E-COMMERCE - Setup Database
echo ========================================
echo.

echo [1/4] Refrescando base de datos...
php artisan migrate:fresh
echo.

echo [2/4] Ejecutando migraciones nuevas...
php artisan migrate
echo.

echo [3/4] Creando enlace simbolico para storage...
php artisan storage:link
echo.

echo [4/4] Poblando base de datos con seeders...
php artisan db:seed
echo.

echo ========================================
echo   Setup completado exitosamente!
echo ========================================
echo.
echo Credenciales de acceso:
echo Email: admin@armeria.cl
echo Password: password
echo.
pause
