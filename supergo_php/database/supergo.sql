DROP DATABASE IF EXISTS supergo;
CREATE DATABASE supergo;
USE supergo;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(120) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('ADMIN', 'CLIENTE') NOT NULL DEFAULT 'CLIENTE',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id)
);

CREATE TABLE carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL DEFAULT 1,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);

INSERT INTO categorias(nombre) VALUES
('Frutas'),
('Verduras'),
('Bebidas');

INSERT INTO productos(nombre, precio, stock, id_categoria) VALUES
('Manzana', 500, 50, 1),
('Pera', 450, 40, 1),
('Lechuga', 300, 30, 2),
('Coca Cola', 900, 20, 3);

-- Usuario admin de prueba.
-- Contraseña en texto plano sugerida: admin123
-- Este hash fue generado con password_hash('admin123', PASSWORD_DEFAULT)
INSERT INTO usuarios (nombre, correo, contrasena, rol) VALUES
('Administrador', 'admin@supergo.com', '$2y$10$2G6oKzw5f/9kr6w7tXifHOVMl6UpM4yxSaVv/jW/23LJ4mZzTH4U.', 'ADMIN');
