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
  id_usuario int,
  creador_equipo varchar(60),
  mentor_equipo varchar(60),
  FOREIGN KEY (id_usuario) REFERENCES registro(id_usuario)
);

INSERT INTO registro (nombre, apellidos, email, contraseña, admin) VALUES 
("Admin", "Admin", "admin@proyectotech.com", "123456", 1);