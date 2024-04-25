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

INSERT INTO registro (nombre, apellidos, email, contraseña, admin) VALUES 
("Admin", "Admin", "admin@proyectotech.com", "123456", 1);