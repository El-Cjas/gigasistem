-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS gigasistem;
USE gigasistem;



-- Login de usuario
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    clave VARCHAR(255) NOT NULL
);

-- Insertar usuario de prueba (contraseña: 123)
INSERT INTO users (nombre, email, clave) 
VALUES ('User', 'gigasistem@gmail.com', '$2y$12$LDlMvYmzB9tN4IA5v7RDhe6kADKSQoM1y.Y2oIQCIYcYgmrAf0jCu');


-- Tabla de categorías de productos
CREATE TABLE categoria(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    descripcion VARCHAR(255), -- descripcion puede ser null
    borrado_en DATETIME DEFAULT NULL -- campo para marcar si la categoria ha sido borrada
);

-- Tabla de productos
CREATE TABLE producto(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255),           -- descripcion puede ser null
    codigo INT,
    precio_compra DECIMAL(10,2) NOT NULL,
    precio_venta DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,       -- igual que stock para que no haya problema si no hay existencias todavia
    ID_categoria INT NOT NULL,          -- Es la foreing key de la categoria el cual no puede ser not null
    FOREIGN KEY (ID_categoria) REFERENCES categoria(ID),
    borrado_en DATETIME DEFAULT NULL -- campo para marcar si la categoria ha sido borrada
);

-- Tabla de movimientos de inventario (entradas y salidas)
CREATE TABLE movimiento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    tipo BOOLEAN NOT NULL, -- el atributo tipo se usa para definir el tipo de movimiento
    cantidad INT NOT NULL,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    observaciones VARCHAR(255),
    FOREIGN KEY (producto_id) REFERENCES producto(id)
);





-- -- Tablas de movimientos ----
-- CREATE TABLE entrada(
--     ID INT AUTO_INCREMENT PRIMARY KEY, -- se pone un id para poder hacer alguna consulta en la tabla movimiento
--     ID_producto INT NOT NULL, -- es la foreing key del producto
--     cantidad INT NOT NULL,
--     fecha DATE, -- tipo de dato date para tener el formato de fecha y hora en el formato de YYYY-MM-DD HH:MI:SS
--     FOREIGN KEY (ID_producto) REFERENCES producto(ID)
-- );

-- CREATE TABLE salida(
--     ID INT AUTO_INCREMENT PRIMARY KEY, -- se pone un id para poder hacer alguna consulta en la tabla movimiento
--     ID_producto INT NOT NULL, -- es la foreing key del producto
--     cantidad INT NOT NULL,
--     fecha DATE, -- tipo de dato date para tener el formato de fecha y hora en el formato de YYYY-MM-DD HH:MI:SS
--     FOREIGN KEY (ID_producto) REFERENCES producto(ID)
-- );