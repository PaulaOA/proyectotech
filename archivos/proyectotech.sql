DROP DATABASE IF EXISTS proyectotech;

CREATE DATABASE proyectotech;
USE proyectotech;

CREATE TABLE registro(
  id_usuario int AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(60),
  apellidos varchar(60),
  fecha date,    
  email varchar(60) NOT NULL,
  contraseña varchar(60) NOT NULL,
  cargo varchar(60),
  admin boolean NOT NULL, 
  token varchar(32) NOT NULL,
  verificado boolean DEFAULT false
);

CREATE TABLE participantes(
  id_participante INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT, 
  FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario)
);

CREATE TABLE mentores(
  id_mentor INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT, 
  token_registro VARCHAR(100) NOT NULL,
  mentor_registrado BOOLEAN DEFAULT FALSE,
  FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario)
);

CREATE TABLE perfil_mentores (
    id_perfil INT AUTO_INCREMENT PRIMARY KEY,
    id_mentor INT NOT NULL,
    nombre_completo VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    profesion VARCHAR(255) NOT NULL,
    empresa VARCHAR(255) NOT NULL,
    cargo VARCHAR(255) NOT NULL,
    especializacion VARCHAR(255) NOT NULL,
    experiencia_mentor ENUM('si', 'no') NOT NULL,
    descripcion_experiencia TEXT NOT NULL,
    num_equipos_mentoreados INT NOT NULL,
    motivacion TEXT NOT NULL,
    disponibilidad VARCHAR(255) NOT NULL,
    acepto_terminos BOOLEAN NOT NULL,
    FOREIGN KEY (id_mentor) REFERENCES mentores(id_mentor)
);

CREATE TABLE jueces(
  id_juez INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT, 
  FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario)
);

CREATE TABLE equipos(
  id_equipo int AUTO_INCREMENT PRIMARY KEY,
  nombre_equipo varchar(60),
  id_creador int,
  id_mentor INT,
  estado ENUM('pendiente', 'aceptada', 'rechazada') DEFAULT 'pendiente',
  division varchar(60),
  FOREIGN KEY (id_creador) REFERENCES registro(id_usuario),
  FOREIGN KEY (id_mentor) REFERENCES mentores(id_mentor)
  );

CREATE TABLE documentos(
  id int AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(500),
  descripcion varchar(500),
  id_usuario int,
  ruta varchar(255),
  FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario)
);

CREATE TABLE videos(
  id int AUTO_INCREMENT PRIMARY KEY,
  nombrevideo varchar(250) NOT NULL,
  urlvideo varchar(250) NOT NULL,
  fecha varchar(50) NOT NULL,
  id_usuario int,
  FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario)
);

CREATE TABLE solicitudes_equipo (
    id_solicitud INT AUTO_INCREMENT PRIMARY KEY,
    id_participante INT,
    id_equipo INT,
    estado ENUM('pendiente', 'aceptada', 'rechazada') DEFAULT 'pendiente',
    FOREIGN KEY (id_participante) REFERENCES participantes(id_participante),
    FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo)
);

CREATE TABLE documentos_compartidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_documento INT,
    id_equipo INT,
    id_usuario int,
    FOREIGN KEY (id_documento) REFERENCES documentos(id) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE
);

CREATE TABLE videos_compartidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_video INT,
    id_equipo INT,
    id_usuario int,
    FOREIGN KEY (id_video) REFERENCES videos (id) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE
);

CREATE TABLE jueces_equipos (
    id_juez INT,
    id_equipo INT,
    estado_evaluacion ENUM('sin evaluaciones', 'guardada', 'definitiva') DEFAULT 'sin evaluaciones',
    PRIMARY KEY (id_juez, id_equipo),
    FOREIGN KEY (id_juez) REFERENCES jueces(id_juez) ON DELETE CASCADE,
    FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE
);

CREATE TABLE categorias_junior (
   id_categoria INT PRIMARY KEY AUTO_INCREMENT,
   nombre VARCHAR(255)
);

CREATE TABLE items_junior (
   id_item INT PRIMARY KEY AUTO_INCREMENT,
   descripcion TEXT,
   id_categoria INT,
   FOREIGN KEY (id_categoria) REFERENCES categorias_junior (id_categoria)
);

CREATE TABLE categorias_senior (
   id_categoria INT PRIMARY KEY AUTO_INCREMENT,
   nombre VARCHAR(255)
);

CREATE TABLE items_senior (
   id_item INT PRIMARY KEY AUTO_INCREMENT,
   descripcion TEXT,
   id_categoria INT,
   FOREIGN KEY (id_categoria) REFERENCES categorias_senior(id_categoria)
);

CREATE TABLE puntuaciones_temporales_junior(
   id_puntuacion_equipo INT PRIMARY KEY AUTO_INCREMENT,
   id_item INT,
   puntuacion INT,
   id_equipo INT,
   id_juez INT,
   FOREIGN KEY (id_item) REFERENCES items_junior(id_item) ON DELETE CASCADE,
   FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE,
   FOREIGN KEY (id_juez) REFERENCES jueces(id_juez) ON DELETE CASCADE
);

CREATE TABLE puntuaciones_definitivas_junior(
   id_puntuacion_equipo INT PRIMARY KEY AUTO_INCREMENT,
   id_item INT,
   puntuacion INT,
   id_equipo INT,
   id_juez INT,
   FOREIGN KEY (id_item) REFERENCES items_junior(id_item) ON DELETE CASCADE,
   FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE,
   FOREIGN KEY (id_juez) REFERENCES jueces(id_juez) ON DELETE CASCADE
);

CREATE TABLE puntuaciones_temporales_senior(
   id_puntuacion_equipo INT PRIMARY KEY AUTO_INCREMENT,
   id_item INT,
   puntuacion INT,
   id_equipo INT,
   id_juez INT,
   FOREIGN KEY (id_item) REFERENCES items_senior(id_item) ON DELETE CASCADE,
   FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE,
   FOREIGN KEY (id_juez) REFERENCES jueces(id_juez) ON DELETE CASCADE
);

CREATE TABLE puntuaciones_definitivas_senior(
   id_puntuacion_equipo INT PRIMARY KEY AUTO_INCREMENT,
   id_item INT,
   puntuacion INT,
   id_equipo INT,
   id_juez INT,
   FOREIGN KEY (id_item) REFERENCES items_senior(id_item) ON DELETE CASCADE,
   FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE,
   FOREIGN KEY (id_juez) REFERENCES jueces(id_juez) ON DELETE CASCADE
);

CREATE TABLE puntuaciones_totales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_equipo INT,
    id_juez INT,
    total_general INT,
    total_categoria1 INT,
    total_categoria2 INT,
    total_categoria3 INT,
    total_categoria4 INT,
    total_categoria5 INT,
    FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE,
    FOREIGN KEY (id_juez) REFERENCES jueces(id_juez) ON DELETE CASCADE
);

ALTER TABLE participantes
DROP FOREIGN KEY participantes_ibfk_1;

ALTER TABLE participantes
ADD CONSTRAINT FK_participantes_registro
FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario)
ON DELETE CASCADE;

ALTER TABLE mentores
DROP FOREIGN KEY mentores_ibfk_1;

ALTER TABLE mentores
ADD CONSTRAINT FK_mentores_registro
FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario)
ON DELETE CASCADE;

ALTER TABLE jueces
DROP FOREIGN KEY jueces_ibfk_1;

ALTER TABLE jueces
ADD CONSTRAINT FK_jueces_registro
FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario)
ON DELETE CASCADE;

ALTER TABLE equipos
DROP FOREIGN KEY equipos_ibfk_1;

ALTER TABLE equipos
DROP FOREIGN KEY equipos_ibfk_2;

ALTER TABLE equipos
ADD CONSTRAINT FK_equipos_creador
FOREIGN KEY (id_creador) REFERENCES registro(id_usuario)
ON DELETE CASCADE;

ALTER TABLE equipos
ADD CONSTRAINT FK_equipos_mentor
FOREIGN KEY (id_mentor) REFERENCES mentores(id_mentor)
ON DELETE CASCADE;

ALTER TABLE solicitudes_equipo
DROP FOREIGN KEY solicitudes_equipo_ibfk_1;

ALTER TABLE solicitudes_equipo
DROP FOREIGN KEY solicitudes_equipo_ibfk_2;

ALTER TABLE solicitudes_equipo
ADD CONSTRAINT FK_solicitudes_participante
FOREIGN KEY (id_participante) REFERENCES participantes(id_participante)
ON DELETE CASCADE;

ALTER TABLE solicitudes_equipo
ADD CONSTRAINT FK_solicitudes_equipo
FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo)
ON DELETE CASCADE;

ALTER TABLE documentos
DROP FOREIGN KEY documentos_ibfk_1;

ALTER TABLE documentos
ADD CONSTRAINT FK_documentos_registro
FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario)
ON DELETE CASCADE;

ALTER TABLE videos
DROP FOREIGN KEY videos_ibfk_1;

ALTER TABLE videos
ADD CONSTRAINT FK_videos_registro
FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario)
ON DELETE CASCADE;

INSERT INTO registro (nombre, apellidos, email, contraseña, admin, verificado) VALUES 
("Admin", "Admin", "admin@proyectotech.com", "123456", 1, 1);

INSERT INTO categorias_junior (nombre) VALUES 
('Descripción del problema/proyecto en 100 palabras'),
('Vídeo de lanzamiento'),
('Vídeo técnico'),
('Plan de adopción de usuarios (carga de documentos de la plantilla)'),
('Ruta de aprendizaje de Technovation (200 palabras y 2-6 imágenes)')
;

INSERT INTO items_junior (descripcion, id_categoria) VALUES
('Descripción del proyecto', 1),
('Expone claramente el problema y muestra por qué es importante para el equipo y la
comunidad.', 2),
('Explica qué ha investigado el equipo sobre el problema y cómo se relaciona con los Objetivos
de Desarrollo Sostenible de las Naciones Unidas.', 2),
('Convence al espectador de que la aplicación o la solución de IA resuelve el problema de los
usuarios.', 2),
('Explica por qué la tecnología seleccionada (prototipo de IA o aplicación móvil) es la mejor
herramienta para resolver el problema', 2),
('Muestra cómo es una solución mejor comparada con lo que ya existe.', 2),
('Explica cómo se asegurará el equipo de que la solución tendrá un impacto positivo en los
usuarios directos o indirectos y en el planeta.
', 2),
('Explica los comentarios de los usuarios sobre el problema y la solución y muestra cómo se
han realizado los cambios en función de dichos comentarios.', 2),
('Explica los objetivos y planes futuros del proyecto', 2),
('Muestra qué aplicación han construido y qué partes funcionan correctamente hasta ahora',3),
('Explica qué codificación hicieron para 1-2 partes importantes de su aplicación (excluyendo la
pantalla de inicio de sesión)
',3),
('Muestra lo que aún no funciona y/o comparte futuras funciones de la aplicación',3),
('Muestra el modelo de IA que han creado y entrenado, explicando los datos que han
recopilado y con los que han entrenado el modelo.',3),
('Muestra qué invento han construido o prototipado, explicando cómo lo han construido y
mostrando las partes que funcionan
',3),
('Muestra lo que aún no funciona y/o comparte las futuras características del prototipo',3),
('Muestra cuántos usuarios han probado ya la aplicación o el invento, y los comentarios
recibidos.', 4),
('Explica cómo conseguirá el equipo que nuevos usuarios utilicen su aplicación o invento en su
primer año.
', 4),
('Comparte lo que el equipo ha aprendido usando texto e imágenes (por ejemplo, capturas de
pantalla, prototipos). Comparte las fuentes técnicas utilizadas/recicladas; si no hay ninguna,
comparte vuestro recurso técnico favorito.', 5),
('Describe cómo superó el equipo los retos técnicos o no técnicos', 5)
;

INSERT INTO categorias_senior (nombre) VALUES 
('Descripción del problema/proyecto en 100 palabras'),
('Vídeo de lanzamiento'),
('Vídeo técnico'),
('Plan de negocio (carga de documentos)'),
('Ruta de aprendizaje de Technovation (200 palabras y 2-6 imágenes)')
;

INSERT INTO items_senior (descripcion, id_categoria) VALUES
('Descripción convincente del proyecto en 100 palabras que exponga claramente el
problema y la solución', 1),
('Expone claramente el problema y muestra por qué es importante para el equipo y la
comunidad.', 2),
('Explica qué ha investigado el equipo sobre el problema y cómo se relaciona con los Objetivos
de Desarrollo Sostenible de las Naciones Unidas.', 2),
('Convence al espectador de que la aplicación o la solución de IA resuelve el problema de los
usuarios.', 2),
('Explica por qué la tecnología seleccionada (prototipo de IA o aplicación móvil) es la mejor
herramienta para resolver el problema.', 2),
('Muestra cómo es una mejor solución comparada con lo que ya existe.', 2),
('Muestra qué aplicación han construido y qué partes funcionan con éxito hasta ahora.',3),
('Explica cómo se probó la aplicación con los usuarios, qué comentarios se recibieron y cómo
afectaron a las características de la aplicación.',3),
('Explica qué codificación hicieron para 1-2 partes importantes de su aplicación (no la pantalla
de inicio de sesión)',3),
('Muestra lo que aún no funciona y/o comparte futuras funciones de la aplicación.',3),
('Muestra el modelo de IA que han creado y entrenado, explicando los datos que han
recopilado y con los que han entrenado el modelo.',3),
('Explica cómo se probó el prototipo con los usuarios, qué comentarios se recibieron y cómo
afectaron a las características del prototipo.', 3),
('Muestra qué invento han construido o prototipado, explicando cómo lo han construido y
mostrando las partes que funcionan.',3),
('Muestra lo que aún no funciona y/o comparte las futuras características del prototipo.',3),
('Explica claramente la empresa y la descripción del producto en un documento bien
redactado que se apoya en gráficos pertinentes.', 4),
('Muestra qué estudios de mercado ha realizado el equipo para identificar a los usuarios
objetivo y a los principales competidores.', 4),
('Explica el plan de marketing para que el equipo consiga que nuevos usuarios utilicen su
aplicación o invento en su primer año.', 4),
('Muestra los planes financieros para poner en marcha la empresa y por qué son realistas.', 4),
('Comparte lo que el equipo ha aprendido mediante una combinación de palabras e imágenes
(por ejemplo, capturas de pantalla, prototipos). Comparte las fuentes técnicas
utilizadas/combinadas; si no hay ninguna, comparte el recurso técnico favorito.', 5),
('Describe cómo superó el equipo los retos técnicos o no técnicos.', 5)
;