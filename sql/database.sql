CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin') DEFAULT 'admin',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE alumnos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    dni VARCHAR(20) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100),
    domicilio TEXT,
    fecha_registro DATE NOT NULL,
    es_menor BOOLEAN DEFAULT 0,
    nombre_representante VARCHAR(100),
    apellidos_representante VARCHAR(100),
    dni_representante VARCHAR(20),
    telefono_representante VARCHAR(20),
    email_representante VARCHAR(100),
    domicilio_representante TEXT,
    tipo_alta ENUM('renovacion', 'nuevo') NOT NULL,
    bonificacion ENUM('ninguna', 'familia_numerosa', 'renta_baja', 'banda') DEFAULT 'ninguna',
    estado ENUM('activo', 'lista_espera', 'baja') DEFAULT 'activo'
);
