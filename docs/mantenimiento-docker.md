# Guía de Mantenimiento y Desarrollo con Docker

Dado que la carpeta `src/` está montada como **volumen** (`volumes: - ./src:/var/www`) en los contenedores, los cambios en tu código local se reflejan automáticamente dentro de los contenedores.

Aquí tienes cómo gestionar el ciclo de vida de la aplicación:

## 1. Cambios en Código PHP (Controladores, Rutas, Modelos)
Al estar los archivos sincronizados, no necesitas hacer nada extra. Los cambios se aplican automáticamente.

## 2. Cambios en Dependencias
*   **PHP (Composer):** Si instalas o actualizas una librería en `composer.json`, ejecuta:
    ```bash
    docker-compose exec app composer install
    ```
*   **JS/Frontend (NPM):** Si instalas o actualizas una librería en `package.json`, ejecuta:
    ```bash
    docker-compose run --rm node npm install
    ```

## 3. Cambios en Base de Datos (Migraciones)
Siempre que crees un nuevo archivo de migración en `src/database/migrations/`, debes ejecutar el siguiente comando para actualizar la estructura de la base de datos:
```bash
docker-compose exec app php artisan migrate
```

**Nota sobre Autenticación:** El sistema utiliza el modelo nativo `User` de Laravel y la tabla `users`. Para inicializar el usuario administrador (admin@ordis.com), ejecuta:
```bash
docker-compose exec app php artisan db:seed
```


## 4. Cambios en Assets Frontend (CSS, JS)
Si estás desarrollando con Vite, debes mantener el servidor de compilación activo para ver cambios en tiempo real:
```bash
docker-compose run --rm node npm run dev
```

## 5. Cuándo reiniciar los contenedores
Solo es necesario recrear o reiniciar los contenedores si realizas cambios en la configuración del entorno:
*   Modificas archivos en la carpeta `docker/` (ej. `Dockerfile`, configuraciones de Nginx).
*   Instalas nuevas extensiones PHP en el `Dockerfile`.

Para aplicar estos cambios estructurales:
```bash
docker-compose up -d --build
```
