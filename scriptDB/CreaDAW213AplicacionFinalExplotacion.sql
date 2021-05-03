/* Base de datos a usar */
    USE dbs272025;

CREATE TABLE T02_Departamento (
    T02_CodDepartamento VARCHAR(3) PRIMARY KEY,
    T02_DescDepartamento VARCHAR(255) NOT NULL,
    T02_FechaCreacionDepartamento INT NOT NULL,
    T02_VolumenNegocio FLOAT NOT NULL,
    T02_FechaBajaDepartamento INT DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=LATIN1;

CREATE TABLE T01_Usuario (
    T01_CodUsuario VARCHAR(10) PRIMARY KEY,
    T01_Password VARCHAR(64) NOT NULL,
    T01_DescUsuario VARCHAR(255) NOT NULL,
    T01_NumConexiones INT DEFAULT 0,
    T01_FechaHoraUltimaConexion INT,
    T01_Perfil enum('administrador', 'usuario') DEFAULT 'usuario',
    T01_ImagenUsuario mediumblob NULL
)ENGINE=INNODB DEFAULT CHARSET=LATIN1;