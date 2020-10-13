-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema PlusBag
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema PlusBag
-- -----------------------------------------------------
CREATE DATABASE PlusBag;
USE PlusBag;

-- -----------------------------------------------------
-- Table `PlusBag`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PlusBag`.`Categorias` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NombreC` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `NombreC` (`NombreC` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `PlusBag`.`Media`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PlusBag`.`Media` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NombreArchivo` VARCHAR(255) NOT NULL,
  `TipoArchivo` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `id` (`id` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `PlusBag`.`Productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PlusBag`.`Productos` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NombreProducto` VARCHAR(255) NOT NULL,
  `Cantidad` VARCHAR(50) NULL DEFAULT NULL,
  `PrecioCompra` DECIMAL(25,2) NULL DEFAULT NULL,
  `PrecioVenta` DECIMAL(25,2) NOT NULL,
  `categorias_id` INT(11) UNSIGNED NOT NULL,
  `Media_id` INT(11) NULL DEFAULT '0',
  `Fecha` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `NombreProducto` (`NombreProducto` ASC) VISIBLE,
  INDEX `categorias_id` (`categorias_id` ASC) VISIBLE,
  INDEX `Media_id` (`Media_id` ASC) VISIBLE,
  CONSTRAINT `FK_products`
    FOREIGN KEY (`categorias_id`)
    REFERENCES `PlusBag`.`categorias` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `Media`
    FOREIGN KEY ()
    REFERENCES `PlusBag`.`Media` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `PlusBag`.`Salida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PlusBag`.`Salida` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Productos_id` INT(11) UNSIGNED NOT NULL,
  `Qty` INT(11) NOT NULL,
  `Precio` DECIMAL(25,2) NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `Productos_id` (`Productos_id` ASC) VISIBLE,
  CONSTRAINT `SK`
    FOREIGN KEY (`Productos_id`)
    REFERENCES `PlusBag`.`Productos` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish2_ci;


-- -----------------------------------------------------
-- Table `PlusBag`.`TipoUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PlusBag`.`TipoUsuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `NombreRol` VARCHAR(150) NOT NULL,
  `Cargo` INT(11) NOT NULL,
  `Estado` INT(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `Cargo` (`Cargo` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `PlusBag`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PlusBag`.`Usuarios` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NombreUsuario` VARCHAR(50) NOT NULL,
  `Nombre` VARCHAR(60) NOT NULL,
  `Contraseña` VARCHAR(255) NOT NULL,
  `Estado` INT(1) NOT NULL,
  `Imagen` VARCHAR(255) NULL DEFAULT 'no_image.jpg',
  `UltimoAcceso` DATETIME NULL DEFAULT NULL,
  `Cargo` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `NombreUsuario`),
  UNIQUE INDEX `NombreUsuario` (`NombreUsuario` ASC) VISIBLE,
  INDEX `user_level` (`Cargo` ASC) VISIBLE,
  CONSTRAINT `FK_user`
    FOREIGN KEY (`Cargo`)
    REFERENCES `PlusBag`.`TipoUsuario` (`Cargo`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
