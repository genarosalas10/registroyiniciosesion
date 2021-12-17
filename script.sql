DROP DATABASE IF EXISTS Registro;
CREATE DATABASE IF NOT EXISTS Registro DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE Registro;

CREATE TABLE  Usuarios(
    idUsuario tinyint UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	usuario varchar(20) NOT NULL UNIQUE ,
	nombre varchar(60) NOT NULL,
	correo varchar(100) NOT NULL,
	contrasena varchar(50) NOT NULL
);

CREATE TABLE  Minijuegos(
    idMinijuego tinyint UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nombre varchar(60) NOT NULL UNIQUE ,
	ruta varchar(3000)NULL
);

CREATE TABLE  Preferencias(
    idMinijuego tinyint UNSIGNED NOT NULL,
	idUsuario tinyint UNSIGNED NOT NULL,
	CONSTRAINT FK_idMinijuego_Minijuegos FOREIGN KEY (idMinijuego) REFERENCES Minijuegos(idMinijuego),
	CONSTRAINT FK_idUsuario_Usuarios FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario),
	CONSTRAINT PK_Preferencias PRIMARY KEY (idUsuario,idMinijuego)
);

/* METER DATOS */
INSERT INTO Minijuegos (nombre) 
VALUES
('Multiplos'),
('Tabla Periodica'),
('Juego de Ingles'),
('Reciclaje');