CREATE TABLE `Maestros` (
  `ID_Maestro` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Nombre_maestro` varchar(30) NOT NULL
);

CREATE TABLE `Grupopedagogico` (
  `ID_Grupopedagogico` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30),
  `Semestre` int(3),
  `ID_Generacion` int(3),
  `id_carrera` int(3)
);

CREATE TABLE `Materia` (
  `ID_Materia` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Nombre_materia` varchar(20) NOT NULL,
  `Horas_totales` int(20),
  `Horas_impartidas` int(20),
  `ID_Grupopedagogico` int(3)
);

CREATE TABLE `Generacion` (
  `ID_Generacion` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(30) NOT NULL
);

CREATE TABLE `Carrera` (
  `id_carrera` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL
);

CREATE TABLE `Incidencias` (
  `ID_Incidencias` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Motivo` varchar(50),
  `Fecha` date,
  `ID_Grupopedagogico` int(3)
);

CREATE TABLE `Actext` (
  `id_act` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nombre_act` varchar(50)
);

CREATE TABLE `MaestroMateria` (
  `id_maestro_materia` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `ID_Maestro` int,
  `ID_Materia` int
);

CREATE TABLE `Horario` (
  `ID_Horario` int PRIMARY KEY AUTO_INCREMENT,
  `NombreHorario` varchar(255),
  `ID_Grupopedagogico` int(3),
  `Semana` varchar(50)
);

CREATE TABLE `DetalleHorario` (
  `ID_DetalleHorario` int PRIMARY KEY AUTO_INCREMENT,
  `ID_Horario` int,
  `Dia` varchar(10),
  `HoraInicio` time,
  `HoraFin` time,
  `ID_MaestroMateria` int
);

ALTER TABLE `MaestroMateria` ADD FOREIGN KEY (`ID_Maestro`) REFERENCES `Maestros` (`ID_Maestro`);

ALTER TABLE `MaestroMateria` ADD FOREIGN KEY (`ID_Materia`) REFERENCES `Materia` (`ID_Materia`);

ALTER TABLE `DetalleHorario` ADD FOREIGN KEY (`ID_Horario`) REFERENCES `Horario` (`ID_Horario`);

ALTER TABLE `DetalleHorario` ADD FOREIGN KEY (`ID_MaestroMateria`) REFERENCES `MaestroMateria` (`id_maestro_materia`);

ALTER TABLE `Materia` ADD FOREIGN KEY (`ID_Grupopedagogico`) REFERENCES `Grupopedagogico` (`ID_Grupopedagogico`);

ALTER TABLE `Incidencias` ADD FOREIGN KEY (`ID_Grupopedagogico`) REFERENCES `Grupopedagogico` (`ID_Grupopedagogico`);

ALTER TABLE `Grupopedagogico` ADD FOREIGN KEY (`ID_Generacion`) REFERENCES `Generacion` (`ID_Generacion`);

ALTER TABLE `Grupopedagogico` ADD FOREIGN KEY (`id_carrera`) REFERENCES `Carrera` (`id_carrera`);

ALTER TABLE `Horario` ADD FOREIGN KEY (`ID_Grupopedagogico`) REFERENCES `Grupopedagogico` (`ID_Grupopedagogico`);
