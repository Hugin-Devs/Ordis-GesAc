# Ordis-GesAc — Estado del Sistema

> **Última actualización:** 2026-06-25
> **Framework:** Laravel 12 (PHP) · Bootstrap 5 · MySQL 8 · Docker Compose

---

## 1. Descripción General

**Ordis-GesAc** es un sistema de gestión académica orientado a instituciones educativas. Permite gestionar personas, matrículas, carga docente, oferta académica, evaluaciones y calificaciones a través de un panel administrativo con control de acceso por roles.

---

## 2. Infraestructura y Entorno

| Servicio         | Tecnología         | Puerto  | Contenedor        |
|------------------|--------------------|---------|-------------------|
| Aplicación PHP   | Laravel 12 / PHP   | 9000    | `ordis-app`       |
| Servidor Web     | Nginx Alpine       | 8000    | `ordis-web`       |
| Base de Datos    | MySQL 8.0          | 3306    | `ordis-db`        |
| Administración BD| phpMyAdmin         | 8080    | `ordis-phpmyadmin`|
| Frontend Build   | Node 22            | —       | `ordis-node`      |

### Credenciales por defecto (desarrollo)
- **App URL:** `http://localhost:8000`
- **phpMyAdmin:** `http://localhost:8080`
- **DB:** host `db`, user `ordis_user`, pass `password`, db `ordis_db`
- **Admin:** email `admin@ordis.com`, pass `password123`

---

## 3. Stack Tecnológico Confirmado

- **Backend:** Laravel 12, Blade tradicional
- **Frontend:** Bootstrap 5, CSS vanilla
- **Base de datos:** MySQL 8 (via Eloquent ORM)
- **Entorno:** Docker Compose
- **Control de versiones:** Git (GitHub — Hugin-Devs/Ordis-GesAc)

---

## 4. Paleta de Colores

| Uso                   | Color     |
|-----------------------|-----------|
| Sidebar público       | `#003882` |
| Sidebar admin         | `#1A1A1A` |
| Botones (fondo)       | `#1A1A1A` |
| Botones (hover)       | `#272727` |
| Fondo dashboard       | `#f0f0f0` |
| Acento amarillo       | `#C5992E` |

---

## 5. Actores del Sistema

| Actor          | Descripción                                                                 |
|----------------|-----------------------------------------------------------------------------|
| **Administrador** | Configura el sistema, gestiona personas, oferta académica y matrículas   |
| **Profesor**      | Gestiona sus clases, planes de evaluación y calificaciones               |
| **Estudiante**    | Consulta su matrícula y calificaciones                                   |
| **Representante** | Consulta las calificaciones del estudiante bajo su cargo                 |

---

## 6. Estructura de la Base de Datos

### Tablas Existentes (con migración aplicada)

| Tabla                            | Descripción                                              | PK                       |
|----------------------------------|----------------------------------------------------------|--------------------------|
| `users`                          | Cuentas de acceso al sistema                             | `id`                     |
| `tabla_persona`                  | Datos base de toda persona                               | `cedula_identidad`       |
| `tabla_estudiante`               | Perfil de estudiante                                     | `id_estudiante`          |
| `tabla_profesor`                 | Perfil de profesor                                       | `id_profesor`            |
| `tabla_representante`            | Perfil de representante                                  | `id_representante`       |
| `tabla_ficha_medica_fisica`      | Ficha médica: sangre, peso, tallas, alergias, etc.       | `id_ficha`               |
| `tabla_estudiante_representante` | Relación muchos-a-muchos estudiante ↔ representante      | —                        |
| `tabla_periodo_academico`        | Períodos lectivos (nombre, fecha_inicio, fecha_fin, estado) | `id_periodo`          |
| `tabla_programa_educativo`       | Programas o carreras                                     | `id_programa`            |
| `tabla_fase_academica`           | Fases/semestres dentro de un programa                    | `id_fase`                |
| `tabla_asignatura`               | Asignaturas dentro de una fase                           | `id_asignatura`          |
| `tabla_profesor_asignatura`      | Carga docente: Profesor + Asignatura + Período           | `id_profesor_asignatura` |
| `tabla_matricula`                | Matrícula de un estudiante en un período/fase            | `id_matricula`           |
| `tabla_matricula_detalle`        | Asignaturas inscritas por matrícula (con nota final)     | `id_detalle`             |
| `tabla_plan_evaluacion`          | Evaluaciones definidas por el profesor                   | `id_evaluacion`          |
| `tabla_calificacion`             | Nota obtenida por estudiante en una evaluación           | `id_calificacion`        |

### Columnas relevantes en `users`

| Columna             | Tipo     | Descripción                                              |
|---------------------|----------|----------------------------------------------------------|
| `cedula_persona_fk` | integer  | FK hacia `tabla_persona.cedula_identidad`                |
| `role`              | string   | `admin`, `profesor`, `estudiante`, `representante`       |
| `estado_cuenta`     | string   | `Activo` / `Inactivo`                                    |
| `ultimo_acceso`     | datetime | Última vez que inició sesión                             |

---

## 7. Modelos Eloquent Existentes

| Modelo              | Tabla                        |
|---------------------|------------------------------|
| `User`              | `users`                      |
| `Persona`           | `tabla_persona`              |
| `Estudiante`        | `tabla_estudiante`           |
| `Profesor`          | `tabla_profesor`             |
| `Representante`     | `tabla_representante`        |
| `FichaMedicaFisica` | `tabla_ficha_medica_fisica`  |
| `PeriodoAcademico`  | `tabla_periodo_academico`    |
| `ProgramaEducativo` | `tabla_programa_educativo`   |
| `FaseAcademica`     | `tabla_fase_academica`       |
| `Asignatura`        | `tabla_asignatura`           |
| `Matricula`         | `tabla_matricula`            |
| `MatriculaDetalle`  | `tabla_matricula_detalle`    |
| `PlanEvaluacion`    | `tabla_plan_evaluacion`      |
| `Calificacion`      | `tabla_calificacion`         |

---

## 8. Plantillas Blade

| Archivo                            | Descripción                                        |
|------------------------------------|----------------------------------------------------|
| `layouts/app.blade.php`            | Layout principal (sidebar azul `#003882`)          |
| `layouts/admin.blade.php`          | Layout del panel admin (sidebar negro `#1A1A1A`)   |
| `admin/dashboard.blade.php`        | Dashboard del administrador (básico, sin datos reales) |
| `admin/personas/index.blade.php`   | Listado de personas (stub sin datos)               |
| `admin/personas/create.blade.php`  | Formulario de registro de persona (funcional)      |

---

## 9. Rutas Definidas

```
GET  /                         → welcome (pública)
GET  /login                    → Login form (pública)
POST /login                    → Autenticación
POST /logout                   → Cerrar sesión
GET  /dashboard                → Dashboard general (auth)

--- Grupo /admin [auth + can:view-admin-dashboard] ---
GET  /admin/dashboard          → admin.dashboard
GET  /admin/personas           → admin.personas.index
GET  /admin/personas/create    → admin.personas.create
POST /admin/personas           → admin.personas.store
```

---

## 10. Controladores

| Controlador         | Métodos implementados               |
|---------------------|-------------------------------------|
| `LoginController`   | `showLogin`, `login`, `logout`      |
| `AdminController`   | `index` (dashboard)                 |
| `PersonaController` | `index`, `create`, `store`, `edit`, `update`, `destroy` |

---

## 11. Seguridad y Autorización
- **Sistema RBAC:** Implementado control de acceso granular mediante roles (`admin`, `coordinador`) y permisos (Gates).
- **Autorización:** Uso de middleware `can` y directivas `@can` en vistas para proteger funcionalidades específicas (CRUD de personas).
- **Soft Deletes:** Implementado borrado lógico en tablas críticas (`users`, `tabla_persona`).

---

## 12. Lo Que Está Listo ✅
- [x] Entorno Docker funcional (app, nginx, mysql, phpmyadmin, node)
- [x] Laravel 12 instalado y configurado
- [x] Base de datos completa migrada y seeded
- [x] Sistema de Roles y Permisos (RBAC) con persistencia en DB
- [x] Autenticación con redirección inteligente (admin → /admin/dashboard)
- [x] Panel admin con plantilla separada (`admin.blade.php`)
- [x] Dashboard administrativo (básico)
- [x] Gestión de Personas funcional (CRUD completo con Soft Deletes):
  - [x] Listado paginado con permisos granulares
  - [x] Registro transaccional
  - [x] Edición de datos y estado de cuenta
  - [x] Eliminación lógica (baja) de personas

---

## 13. Lo Que Falta Por Desarrollar ⏳

### Panel Administrativo — Gestión de Personas
- [ ] Gestión de Fichas Médicas (`tabla_ficha_medica_fisica`)
- [ ] Vincular Representantes a Estudiantes (`tabla_estudiante_representante`)

### Panel Administrativo — Oferta Académica
- [ ] CRUD de Programas Educativos (`tabla_programa_educativo`)
- [ ] CRUD de Fases Académicas (`tabla_fase_academica`)
- [ ] CRUD de Asignaturas (`tabla_asignatura`)

### Panel Administrativo — Períodos y Carga
- [ ] CRUD de Períodos Académicos (`tabla_periodo_academico`)
- [ ] Asignación de Carga Docente (`tabla_profesor_asignatura`)

### Panel Administrativo — Matrículas
- [ ] Proceso de inscripción de estudiante en período/fase
- [ ] Selección de asignaturas a cursar (`tabla_matricula_detalle`)

### Panel del Profesor
- [ ] Vista de clases asignadas
- [ ] Creación/gestión de Plan de Evaluación (porcentajes deben sumar 100%)
- [ ] Registro de calificaciones por estudiante y evaluación

### Panel del Estudiante
- [ ] Vista de matrícula activa
- [ ] Vista de calificaciones

### Panel del Representante
- [ ] Vista de estudiantes vinculados
- [ ] Consulta de calificaciones del estudiante

### Aspectos Transversales
- [ ] Notificación por correo al crear usuario (envío de contraseña temporal)
- [ ] Cambio de contraseña forzado en primer inicio de sesión
- [ ] Dashboard admin con métricas reales
- [ ] Diseño mejorado con acento `#C5992E` (amarillo aún sin uso)
- [ ] Responsividad completa del panel admin

---

## 14. Decisiones de Diseño Tomadas

| Decisión                           | Detalle                                                             |
|------------------------------------|---------------------------------------------------------------------|
| Plantillas separadas               | `app.blade.php` (público) y `admin.blade.php` (exclusivo admin)     |
| Roles en columna `users.role`      | String simple en lugar de tabla de roles/permisos separada          |
| Persona como entidad central       | Toda persona se registra en `tabla_persona` antes que en su tabla de rol |
| Contraseña temporal aleatoria      | `Str::random(10)` al crear usuario desde el admin                   |
| `DB::transaction` en registro      | Si falla cualquier inserción, se revierte todo                      |
| Sin Livewire / Inertia / Vue       | Blade puro + Bootstrap 5                                            |
| Middleware por alias               | `role:admin`, `role:profesor`, etc. en `bootstrap/app.php`          |
