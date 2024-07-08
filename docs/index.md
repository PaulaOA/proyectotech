# Documentación Técnica

## 1. Introducción

### Descripción General

La presente documentación hace referencia a la plataforma web de nombre Technovation, la cual ha sido diseñada para gestionar de forma eficiente el concurso Technovation CV. La plataforma permite el registro de usuarios de forma individual, escogiendo su rol (participante, mentor o juez). Los participantes tienen la posibilidad de formar equipo designando un mentor, o unirse a uno existente, y subir documentación relacionada con su proyecto, el cual será evaluado por parte de los jueces.

### Propósito

El objetivo principal de esta plataforma es facilitar la organización y gestión del concurso Technovation CV, proporcionando una herramienta eficiente y accesible para todos los involucrados.

### Objetivos del Proyecto

1. Desarrollar una plataforma web intuitiva y fácil de usar para la gestión de equipos y evaluaciones en el concurso Technovation CV.
2. Permitir a los usuarios registrarse individualmente y crear equipos con un mentor designado.
3. Implementar la funcionalidad para que los equipos puedan enviar solicitudes de inscripción a otros equipos existentes.
4. Proporcionar un sistema de gestión de contenido que permita a los usuarios subir documentación relacionada con sus proyectos.
5. Integrar un perfil de juez que permita la evaluación de equipos según una rúbrica predefinida.
6. Implementar un proceso de verificación de autorización paterna para la participación de los estudiantes.

### Funcionalidades Principales

- Registro de Usuarios
- Verificación de Autorización Paterna
- Creación de Equipos
- Subida de Contenido
- Evaluación de Proyectos

### Público objetivo

La plataforma está diseñada para ser utilizada por todos aquellos implicados en el concurso, sea cual sea su rol. Esto es, los participantes del concurso (estudiantes de entre 11 y 18 años), los mentores registrados que acepten la solicitud de mentor y cumplimenten el formulario correspondiente y los jueces expertos en el sector cuyo papel en la plataforma consiste en puntuar los proyectos presentados en base a una rúbrica predefinida.

### Tecnologías Utilizadas

Esta plataforma ha sido desarrollada utilizando una variedad de tecnologías descritas a continuación:

- **Lenguaje de Programación**: PHP
  - Utilizado para la lógica del servidor y la generación dinámica de contenido.

- **Base de Datos**: MySQL
  - La base de datos MySQL es administrada a través de phpMyAdmin y gestionada localmente con XAMPP.

- **Framework Frontend**: Bootstrap
  - Utilizado como framework CSS y JS para el diseño responsivo y moderno de la interfaz de usuario.

- **JavaScript y AJAX**:
  - JavaScript es utilizado para mejorar la interactividad en el lado del cliente.
  - AJAX se emplea para peticiones asíncronas al servidor, facilitando la carga dinámica de contenido y la validación de formularios sin recargar la página.

- **Control de Versiones**: GitHub
  - GitHub se utiliza para el control de versiones del código fuente, permitiendo la colaboración y el seguimiento de cambios en el proyecto.

- **Servidor Local**: XAMPP
  - Utilizado como entorno de desarrollo local para ejecutar el servidor web Apache, PHP y MySQL.

## 2. Arquitectura del Sistema

### Descripción General de la Arquitectura

La plataforma está basada en una arquitectura de tres niveles, donde se utilizan diversas tecnologías para separar las responsabilidades y gestionar la interacción entre el cliente y el servidor.

### Componentes del Sistema

**Capa de Presentación (Frontend)**:

- Tecnologías: HTML, CSS, JavaScript, Bootstrap.
- Función: Proporciona la interfaz de usuario y maneja la interacción del usuario.

**Capa de Lógica de Aplicación (Backend)**:

- Tecnologías: PHP.
- Función: Procesa las solicitudes del cliente, maneja la lógica de negocio y coordina la comunicación entre la capa de presentación y la base de datos.

**Capa de Acceso a Datos (Base de Datos)**:

- Tecnologías: MySQL, phpMyAdmin.
- Función: Almacena y gestiona los datos de la aplicación.

### Interacción entre Componentes

1. **Solicitud:** El cliente envía una solicitud al servidor, por ejemplo, cuando un usuario rellena y envía un formulario de registro.
2. **Procesamiento:** El servidor recibe la solicitud y ejecuta la lógica de aplicación necesaria, como validación de datos introducidos, crear nuevos registros en la base de datos, etc.
3. **Acceso a datos:** Si se requiere acceso a datos, el servidor realiza las consultas correspondientes utilizando MySQL para almacenar o recuperar información.
4. **Respuesta:** El servidor genera una respuesta basada en la operación realizada (por ejemplo, un mensaje de éxito o error) y la envía de vuelta al cliente para actualizar la interfaz de usuario.

## 3. Requisitos del Sistema

### Requisitos Funcionales

**1. Registro de Usuarios:** Los usuarios pueden registrarse en la plataforma como participantes, mentores o jueces, proporcionando información básica y verificando su correo electrónico.
**2. Autenticación de Usuarios:** Se implementa un sistema de autenticación para garantizar la seguridad de las cuentas de usuario.
**3. Creación de Equipos:** Los participantes pueden crear equipos escogiendo un mentor y la división correspondiente (junior o senior).
**4. Solicitudes de Inscripción:** Los participantes pueden enviar solicitudes de inscripción a equipos existentes.
**5. Subida de Contenido:** Cada participante puede subir contenido relacionado con su proyecto, incluyendo enlaces a videos, archivos de código fuente y PDF y compartirlo con el resto de participantes de su equipo.
**6. Verificación de Autorización Paterna:** Se incluye de un proceso de verificación de autorización para la participación de estudiantes.
**7. Evaluación de Proyectos:** Los jueces pueden puntuar los proyectos según una rúbrica predefinida.
**8. Gestión de Usuarios y Equipos:** El usuario administrador puede gestionar usuarios, equipos y evaluaciones de cada proyecto.
