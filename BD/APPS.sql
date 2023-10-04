CREATE TABLE Materia(
ID_Materia int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
Nombre_materia varchar(20) NOT NULL,
Horas_materia varchar(20) NOT NULL);

INSERT INTO `MATERIA` (`Nombre_materia`,`Horas_materia`)
	VALUES  ('Geografia','46'), ('Matematicas','60');






CREATE TABLE Maestros(
ID_Maestro int (3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
Nombre_maestro varchar(30) NOT NULL,
Ape_maestro varchar(30) NOT NULL,
ID_Materia int(3),
FOREIGN KEY (ID_Materia) REFERENCES Materia (ID_Materia));
  

CREATE TABLE Generacion(
ID_Generacion int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
Nombre_maestro varchar(30) NOT NULL,
ID_materia int(3),
FOREIGN KEY (ID_materia) REFERENCES Materia (ID_Materia));


CREATE TABLE Semestre(
ID_Semestre int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
Nombre_semestre varchar(10),
ID_Generacion int(3),
FOREIGN KEY (ID_Generacion) REFERENCES Generacion (ID_Generacion));

CREATE TABLE Grupopedagogico(
ID_Grupopedagogico int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
Nombre_maestro varchar(10),
ID_Materia int(3),
FOREIGN KEY (ID_Materia) REFERENCES Materia (ID_Materia));

CREATE TABLE Incidencias(
ID_Incidencias int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
Motivo varchar(50),
Fecha date,
ID_Materia int(3),
ID_Maestro int(3),
FOREIGN KEY (ID_Materia) REFERENCES Materia (ID_Materia),
FOREIGN KEY (ID_Maestro) REFERENCES Maestros (ID_Maestro));




SELECT MAESTROS.Nombre_maestro, MAESTROS.Ape_maestro, MATERIA.Nombre_materia FROM MAESTROS 
	INNER JOIN MATERIA ON MAESTROS.ID_Materia = MATERIA.ID_Materia
	 WHERE MATERIA.ID_Materia = 3;




