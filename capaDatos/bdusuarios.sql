/**
 * bdusuarios.sql
 * Script para la creación de la base de datos.
 */

/** Borra la base de datos si existe. */
drop database if exists BDCinemaskope;

/** Crea la base de datos. */
create database BDCinemaskope;

/** Crea el usuario para acceder a la base de datos. */
grant select, insert, update, delete on BDCinemaskope.*
  to 'UBDCinemaskope'@'localhost' identified by '12-CinemaSkope-12';

/** Selecciona la base de datos. */
use BDCinemaskope;

/** Crea la tabla Usuarios. */
create table Usuarios (
    email varchar(50) primary key not null,
    contraseña varchar(15) not null,
    nombre varchar(50) not null
);

/** Crea la tabla Películas. */
create table Peliculas (
    idpelicula int not null AUTO_INCREMENT primary key,
    nombre varchar(50) not null,
    fecha date default '1900-01-01',
    sinopsis varchar(500)
);

/** Crea la tabla Comentarios. */
create table Comentarios (
    idcomentario int not null AUTO_INCREMENT primary key,
    idpelicula int not null,
    email varchar(50) not null,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP not null,
    contenido varchar(500),
    
    FOREIGN KEY(idpelicula) REFERENCES Peliculas(idpelicula),
    FOREIGN KEY(email) REFERENCES Usuarios(email) ON DELETE CASCADE ON UPDATE CASCADE
);

/** Crea la tabla Valoraciones. */
create table Valoraciones (
    idvaloracion int not null AUTO_INCREMENT primary key,
    idpelicula int not null,
    email varchar(50) not null,
    valoracion float not null default 0,
    fechaval TIMESTAMP DEFAULT CURRENT_TIMESTAMP not null,
    
    FOREIGN KEY(idpelicula) REFERENCES Peliculas(idpelicula),
    FOREIGN KEY(email) REFERENCES Usuarios(email) ON DELETE CASCADE ON UPDATE CASCADE
);
/** Inserciones en base de datos */
INSERT INTO `peliculas` (`idpelicula`, `nombre`, `fecha`, `sinopsis`) VALUES (NULL, 'El poder del perro', '2021-11-17', 'Los acaudalados hermanos Phil y George Burbank son las dos caras de la misma moneda. Phil es elegante y cruel, mientras que George es impasible y amable. Cuando George se casa en secreto con una viuda del pueblo, Phil lleva a cabo una guerra sádica e implacable usando a su afeminado hijo, Peter, como peón.');
INSERT INTO `peliculas` (`idpelicula`, `nombre`, `fecha`, `sinopsis`) VALUES (NULL, 'Interstellar', '2014-10-26', 'El tiempo en la Tierra está llegando a su fin; un equipo de exploradores asume la misión más importante en la historia de la humanidad; viajar fuera de esta galaxia para descubrir si la humanidad tiene un futuro más allá de las estrellas.');
INSERT INTO `peliculas` (`idpelicula`, `nombre`, `fecha`, `sinopsis`) VALUES (NULL, 'Última noche en el Soho', '2021-09-04', 'Una joven amante de la moda viaja en el tiempo y termina en Londres en la década de 1960. Allí conoce a su gran ídolo, una cantante. Sin embargo, tiene que descubrir que la vida en ese momento en el Soho es diferente de lo que ella esperaba.');
INSERT INTO `peliculas` (`idpelicula`, `nombre`, `fecha`, `sinopsis`) VALUES (NULL, 'No mires arriba', '2021-12-05', 'Dos astrónomos mediocres descubren que en pocos meses un meteorito destruirá el planeta Tierra. Desde ese momento, deberán advertir a la humanidad del peligro que se avecina a través de los medios de comunicación.');
INSERT INTO `peliculas` (`idpelicula`, `nombre`, `fecha`, `sinopsis`) VALUES (NULL, 'Dune', '2021-10-22', 'Arrakis, también denominado Dune, se ha convertido en el planeta más importante del universo. A su alrededor comienza una gigantesca lucha por el poder que culmina en una guerra interestelar.');

