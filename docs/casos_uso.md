Aquí tienes la información formateada en Markdown:

### 1. Identificación de Actores

* **Administrador (Personal Administrativo):** Es el encargado de la configuración del sistema, registro de usuarios, creación de períodos y proceso de matriculación.
* **Profesor:** Encargado de gestionar las clases que se le han asignado, definir sus evaluaciones y asentar las notas.
* **Estudiante:** Usuario final que recibe la educación y necesita ver su progreso.
* **Representante:** Tutor legal que supervisa el progreso de uno o más estudiantes.

---

### 2. Estructura de Casos de Uso

#### Actor: Administrador

* **Gestionar Personas:** Registrar los datos básicos de estudiantes, profesores y representantes de manera centralizada.
* **Gestionar Ficha Médica:** Registrar información de salud, tipo de sangre, alergias y discapacidades de una persona.
* **Configurar Oferta Académica:** Crear Programas Educativos (ej. Carreras), Fases (ej. Semestres) y Asignaturas.
* **Gestionar Períodos Académicos:** Abrir, modificar y cerrar los ciclos de estudio (ej. Año Escolar 2024-2025).
* **Asignar Carga Docente:** Vincular a un Profesor con una Asignatura en un Período Académico específico.
* **Matricular Estudiante:** Inscribir al estudiante en una fase y período, y asignarle las asignaturas específicas que va a cursar.

#### Actor: Profesor

* **Consultar Clases Asignadas:** Ver qué materias le tocan dictar en el período activo.
* **Crear Plan de Evaluación:** Definir los exámenes, proyectos, descripciones y porcentajes de peso (que sumen 100%) para su clase.
* **Registrar Calificaciones:** Ingresar las notas obtenidas por los estudiantes en cada evaluación y dejar observaciones.

#### Actor: Estudiante

* **Consultar Matrícula:** Ver las asignaturas en las que está inscrito y su estado (Cursando, Aprobada, etc.).
* **Consultar Calificaciones:** Ver sus notas individuales y su nota final definitiva.

#### Actor: Representante

* **Consultar Calificaciones del Estudiante:** Acceder a las notas y matrícula de los estudiantes con los que tiene un parentesco registrado.