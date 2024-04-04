DROP DATABASE IF EXISTS proyectotech;

CREATE DATABASE proyectotech;
USE proyectotech;

CREATE TABLE registros(
  id_usuario int AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(60),
  apellidos varchar(60),
  fecha date(60),    
  email varchar(60) NOT NULL,
  contraseña varchar(60) NOT NULL,
  cargo varchar(60),
  admin boolean NOT NULL
);