# Ordis-GesAc

Sistema de Gestión Académica.

## Descripción
Proyecto para la gestión integral de instituciones académicas.

## Estructura del proyecto
- `src/`: Código fuente del proyecto Laravel.
- `docker/`: Configuración de Docker.

## Instalación y Configuración para Desarrollo

Para poner en marcha el proyecto en una nueva máquina, sigue estos pasos:

1. **Clonar el repositorio.**

2. **Configurar el entorno:**
   ```bash
   cp src/.env.example src/.env
   ```

3. **Levantar los contenedores de Docker:**
   ```bash
   docker-compose up -d
   ```

4. **Instalar dependencias y configurar la aplicación:**
   ```bash
   # Instalar dependencias de PHP
   docker-compose exec app composer install
   
   # Generar clave de aplicación (necesario para cifrado)
   docker-compose exec app php artisan key:generate
   
   # Instalar dependencias de Frontend (Node.js)
   docker-compose run --rm node npm install
   
   # Ejecutar migraciones y poblar base de datos inicial
   docker-compose exec app php artisan migrate --seed
   ```

5. **Iniciar compilación de assets:**
   ```bash
   docker-compose run --rm node npm run dev
   ```

6. El proyecto estará disponible en `http://localhost:8000`.
   *   Usuario administrador por defecto: `admin@ordis.com` / `password123`.



## Contribución
(Instrucciones de contribución por definir)
