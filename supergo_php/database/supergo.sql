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
    nombre VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    ruta_imagen VARCHAR(255) DEFAULT NULL,
    id_categoria INT NOT NULL,
    CONSTRAINT fk_productos_categoria
        FOREIGN KEY (id_categoria) REFERENCES categorias(id)
);

CREATE TABLE carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL DEFAULT 1,
    CONSTRAINT fk_carrito_usuario
        FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    CONSTRAINT fk_carrito_producto
        FOREIGN KEY (id_producto) REFERENCES productos(id) ON DELETE CASCADE,
    CONSTRAINT uq_carrito UNIQUE (id_usuario, id_producto)
);

INSERT INTO categorias (nombre) VALUES
('Abarrotes'),
('Jugos y Bebidas'),
('Mascotas'),
('Bebidas Alcohólicas'),
('Limpieza'),
('Higiene y belleza'),
('Lácteos y Huevos'),
('Electrónicos y Herramientas'),
('Rebajas');

INSERT INTO productos (nombre, descripcion, precio, stock, ruta_imagen, id_categoria) VALUES
('Arroz 1kg', 'Arroz blanco de excelente calidad', 1250, 30, 'img/productos/arroz.jpg', 1),
('Frijoles negros 800g', 'Frijoles ideales para tu despensa', 980, 25, 'img/productos/frijoles.jpg', 1),
('Jugo de naranja 1L', 'Jugo refrescante natural', 1350, 20, 'img/productos/jugo.jpg', 2),
('Gaseosa cola 2L', 'Bebida gaseosa clásica', 1650, 18, 'img/productos/gaseosa.jpg', 2),
('Alimento para perro 2kg', 'Nutrición balanceada para tu mascota', 4200, 12, 'img/productos/perro.jpg', 3),
('Detergente líquido', 'Limpieza profunda para tu ropa', 2850, 16, 'img/productos/detergente.jpg', 5);

INSERT INTO usuarios (nombre, correo, contrasena, rol) VALUES
('Administrador', 'admin@supergo.com', '$2y$10$2G6oKzw5f/9kr6w7tXifHOVMl6UpM4yxSaVv/jW/23LJ4mZzTH4U.', 'ADMIN');


ALTER TABLE usuarios
ADD COLUMN foto_perfil VARCHAR(255) DEFAULT NULL,
ADD COLUMN telefono VARCHAR(30) DEFAULT NULL,
ADD COLUMN direccion VARCHAR(255) DEFAULT NULL;