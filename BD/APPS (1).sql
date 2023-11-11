CREATE TABLE `Maestros` (
  `ID_Maestro` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Nombre_maestro` varchar(30) NOT NULL,
  `Horario` varchar(30) NOT NULL
);

CREATE TABLE `Semestre` (
  `ID_Semestre` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Nombre_semestre` varchar(10)
);

CREATE TABLE `Grupopedagogico` (
  `ID_Grupopedagogico` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(10)
);


CREATE TABLE `Materia` (
  `ID_Materia` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Nombre_materia` varchar(20) NOT NULL,
  `ID_Maestro` int(3),
  FOREIGN KEY (`ID_Maestro`) REFERENCES `Maestros` (`ID_Maestro`)
);

CREATE TABLE `Generacion` (
  `ID_Generacion` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) NOT NULL,
  `ID_Semestre` int(3),
  `ID_Grupopedagogico` int(3),
  FOREIGN KEY (`ID_Semestre`) REFERENCES `Semestre` (`ID_Semestre`),
  FOREIGN KEY (`ID_Grupopedagogico`) REFERENCES `Grupopedagogico` (`ID_Grupopedagogico`)
);

CREATE TABLE `Incidencias` (
  `ID_Incidencias` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Motivo` varchar(50),
  `Fecha` date,
  `ID_Maestro` int(3),
  FOREIGN KEY (`ID_Maestro`) REFERENCES `Maestros` (`ID_Maestro`)
);

CREATE TABLE `Actext` (
  `id_act` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nombre_act` varchar(50),
  `ID_Maestro` int(3),
  FOREIGN KEY (`ID_Maestro`) REFERENCES `Maestros` (`ID_Maestro`)
);

CREATE TABLE `generacion_materia` (
  `id_mm` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `ID_Materia` int(3),
  `ID_Generacion` int(3),
  FOREIGN KEY (`ID_Materia`) REFERENCES `Materia` (`ID_Materia`),
  FOREIGN KEY (`ID_Generacion`) REFERENCES `Generacion` (`ID_Generacion`)
);
