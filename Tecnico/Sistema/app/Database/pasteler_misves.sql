CREATE DATABASE IF NOT EXISTS `pasteler_misves`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `pasteler_misves`;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `detallepedido`;
DROP TABLE IF EXISTS `resena`;
DROP TABLE IF EXISTS `pedido`;
DROP TABLE IF EXISTS `producto`;
DROP TABLE IF EXISTS `usuario`;
DROP TABLE IF EXISTS `rol`;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `rol` (
  `idRol` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(60) NOT NULL,
  `apellido` VARCHAR(60) NULL,
  `correo` VARCHAR(100) NOT NULL,
  `contrasena` VARCHAR(255) NOT NULL,
  `idRol` INT NOT NULL DEFAULT 1,
  `estado` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `uq_usuario_correo` (`correo`),
  KEY `idx_usuario_rol` (`idRol`),
  CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `producto` (
  `idProducto` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `precio` DOUBLE NOT NULL DEFAULT 0,
  `imagen` VARCHAR(255) NULL,
  `estado` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pedido` (
  `idPedido` INT NOT NULL AUTO_INCREMENT,
  `idUsuario` INT NOT NULL,
  `fechaPedido` DATETIME NOT NULL,
  `estado` VARCHAR(30) NOT NULL DEFAULT 'Pendiente',
  `TotalComprar` DOUBLE NULL DEFAULT 0,
  PRIMARY KEY (`idPedido`),
  KEY `idx_pedido_usuario` (`idUsuario`),
  CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `detallepedido` (
  `idDetallePedido` INT NOT NULL AUTO_INCREMENT,
  `idPedido` INT NOT NULL,
  `idProducto` INT NOT NULL,
  `cantidad` INT NOT NULL DEFAULT 1,
  `precioUnitario` DOUBLE NOT NULL DEFAULT 0,
  `TotalComprar` DOUBLE NOT NULL DEFAULT 0,
  PRIMARY KEY (`idDetallePedido`),
  KEY `idx_detalle_pedido` (`idPedido`),
  KEY `idx_detalle_producto` (`idProducto`),
  CONSTRAINT `fk_detalle_pedido` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`)
    ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `resena` (
  `idResena` INT NOT NULL AUTO_INCREMENT,
  `idUsuario` INT NOT NULL,
  `idProducto` INT NOT NULL,
  `comentario` VARCHAR(500) NULL,
  `calificacion` TINYINT NOT NULL,
  `fecha` DATETIME NOT NULL,
  PRIMARY KEY (`idResena`),
  KEY `idx_resena_usuario` (`idUsuario`),
  KEY `idx_resena_producto` (`idProducto`),
  CONSTRAINT `fk_resena_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`)
    ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `fk_resena_producto` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`)
    ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `chk_resena_calificacion` CHECK (`calificacion` BETWEEN 1 AND 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `rol` (`idRol`, `nombre`) VALUES
  (1, 'cliente'),
  (2, 'administrador'),
  (3, 'domiciliario');

INSERT INTO `producto` (`nombre`, `descripcion`, `precio`, `imagen`, `estado`) VALUES
  ('Gelatina', 'Gelatina artesanal de frutas.', 5000, 'gelatina.jpeg', 1),
  ('Postre de limón', 'Postre cremoso de limón.', 6500, 'limon.jpeg', 1),
  ('Postre de maracuyá', 'Postre fresco de maracuyá.', 6500, 'maracuya.jpg', 1),
  ('Tiramisú', 'Tiramisú artesanal.', 9000, 'tiramisu.jpeg', 1),
  ('Fresas con barquillos', 'Fresas con crema y barquillos.', 8000, 'barquillos.jpeg', 1);

-- Usuarios de ejemplo con contraseñas bcrypt.
-- Para generar usuarios adicionales usa php spark db:seed UsuarioSeeder.
INSERT INTO `usuario` (`nombre`, `apellido`, `correo`, `contrasena`, `idRol`, `estado`) VALUES
  ('Administrador', 'Sistema', 'admin@pasteleria.local', '$2y$10$92IXUNVk2bWQ7Ff8Y2sRrOQw0xkGz6kV4zQ7Vj7c7r5qM7T3K8u', 2, 1),
  ('Cliente', 'Demo', 'cliente@pasteleria.local', '$2y$10$92IXUNVk2bWQ7Ff8Y2sRrOQw0xkGz6kV4zQ7Vj7c7r5qM7T3K8u', 1, 1);

-- La contraseña de los usuarios de ejemplo debe establecerse desde UsuarioSeeder
-- para garantizar un hash generado por PHP password_hash().

SET FOREIGN_KEY_CHECKS = 1;

-- Alternativa recomendada para instalar en CodeIgniter 4:
-- php spark migrate --seed
-- Las imágenes deben estar en public/uploads/productos/.
