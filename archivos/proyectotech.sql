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

CREATE TABLE documentos(
  id int AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(500),
  descripcion varchar(500)
);

CREATE TABLE videos(
  id int AUTO_INCREMENT PRIMARY KEY,
  nombrevideo varchar(250) NOT NULL,
  urlvideo varchar(250) NOT NULL,
  fecha varchar(50) NOT NULL
);

CREATE TABLE equipos(
  id_equipo int AUTO_INCREMENT PRIMARY KEY,
  nombre_equipo varchar(60),
  id_creador int,
  id_mentor INT,
  id_participante INT,
  estado ENUM('pendiente', 'aceptada', 'rechazada') DEFAULT 'pendiente',
  FOREIGN KEY (id_creador) REFERENCES registro(id_usuario),
  FOREIGN KEY (id_mentor) REFERENCES mentores(id_mentor),
  FOREIGN KEY (id_participante) REFERENCES participantes(id_participante)
);

INSERT INTO registro (nombre, apellidos, email, contraseña, admin) VALUES 
("Admin", "Admin", "admin@proyectotech.com", "123456", 1);