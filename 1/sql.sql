CREATE TABLE Modulos (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,
    Departamento VARCHAR(255) NOT NULL,
    Nomenclatura VARCHAR(50) NOT NULL,
    Descripcion TEXT
);

-- Insertar datos de ejemplo
INSERT INTO Modulos (Nombre, Departamento, Nomenclatura, Descripcion) VALUES
('Programación', 'Informática', 'PRG', 'Módulo de programación en diversos lenguajes.'),
('Bases de Datos', 'Informática', 'BD', 'Módulo de diseño y gestión de bases de datos.'),
('Redes', 'Telecomunicaciones', 'RED', 'Módulo sobre infraestructura de redes.'),
('Sistemas Operativos', 'Informática', 'SO', 'Módulo sobre sistemas operativos y administración.'),
('Electrónica', 'Electrónica', 'ELEC', 'Módulo de fundamentos electrónicos.'),
('Matemáticas', 'Ciencias Básicas', 'MAT', 'Módulo de matemáticas aplicadas.'),
('Seguridad Informática', 'Informática', 'SEC', 'Módulo de ciberseguridad y protección de datos.');