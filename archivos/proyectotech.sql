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
  admin boolean NOT NULL
);

CREATE TABLE participantes(
  id_participante INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT, 
  FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario)
);

CREATE TABLE mentores(
  id_mentor INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT, 
  FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario)
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

INSERT INTO registro (nombre, apellidos, email, contraseña, admin) VALUES 
("Admin", "Admin", "admin@proyectotech.com", "123456", 1);