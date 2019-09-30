-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema tiendalrv
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tiendalrv
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tiendalrv` DEFAULT CHARACTER SET utf8 ;
USE `tiendalrv` ;

-- -----------------------------------------------------
-- Table `tiendalrv`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tiendalrv`.`categorias` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) CHARACTER SET 'utf8mb4' NOT NULL,
  `slug` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `descripcion` TEXT CHARACTER SET 'utf8mb4' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8mb4
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `tiendalrv`.`failed_jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tiendalrv`.`failed_jobs` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` TEXT CHARACTER SET 'utf8mb4' NOT NULL,
  `queue` TEXT CHARACTER SET 'utf8mb4' NOT NULL,
  `payload` LONGTEXT CHARACTER SET 'utf8mb4' NOT NULL,
  `exception` LONGTEXT CHARACTER SET 'utf8mb4' NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `tiendalrv`.`marcas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tiendalrv`.`marcas` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `marcas_nombre_unique` (`nombre` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `tiendalrv`.`productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tiendalrv`.`productos` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `categoria_id` BIGINT(20) UNSIGNED NOT NULL,
  `nombre` VARCHAR(150) CHARACTER SET 'utf8mb4' NOT NULL,
  `slug` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `descripcion` TEXT CHARACTER SET 'utf8mb4' NOT NULL,
  `resumen` VARCHAR(300) CHARACTER SET 'utf8mb4' NOT NULL,
  `precio` DECIMAL(12,2) NOT NULL,
  `visible` TINYINT(1) NOT NULL,
  `color` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `nuevo` TINYINT(1) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  `marca_id` BIGINT(20) UNSIGNED NOT NULL,
  `oferta` TINYINT(1) NOT NULL DEFAULT '0',
  `precio_anterior` DECIMAL(12,2) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `productos_categoria_id_foreign` (`categoria_id` ASC),
  INDEX `productos_marca_id_foreign` (`marca_id` ASC),
  CONSTRAINT `productos_categoria_id_foreign`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `tiendalrv`.`categorias` (`id`),
  CONSTRAINT `productos_marca_id_foreign`
    FOREIGN KEY (`marca_id`)
    REFERENCES `tiendalrv`.`marcas` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb4
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `tiendalrv`.`imagenes_productos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tiendalrv`.`imagenes_productos` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `producto_id` BIGINT(20) UNSIGNED NOT NULL,
  `url` VARCHAR(500) CHARACTER SET 'utf8mb4' NOT NULL,
  `default` TINYINT(1) NOT NULL DEFAULT '1',
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `imagenes_productos_producto_id_foreign` (`producto_id` ASC),
  CONSTRAINT `imagenes_productos_producto_id_foreign`
    FOREIGN KEY (`producto_id`)
    REFERENCES `tiendalrv`.`productos` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8mb4
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `tiendalrv`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tiendalrv`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8mb4
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `tiendalrv`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tiendalrv`.`roles` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `descripcion` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `tiendalrv`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tiendalrv`.`users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `a_paterno` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `a_materno` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `email` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `nickname` VARCHAR(20) CHARACTER SET 'utf8mb4' NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `activo` TINYINT(1) NOT NULL,
  `direccion` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `remember_token` VARCHAR(100) CHARACTER SET 'utf8mb4' NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  `rol_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `users_email_unique` (`email` ASC),
  INDEX `users_rol_id_foreign` (`rol_id` ASC),
  CONSTRAINT `users_rol_id_foreign`
    FOREIGN KEY (`rol_id`)
    REFERENCES `tiendalrv`.`roles` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `tiendalrv`.`ordenes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tiendalrv`.`ordenes` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subtotal` DECIMAL(12,2) NOT NULL,
  `shiping` DECIMAL(12,2) NOT NULL,
  `user_id` BIGINT(20) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `ordenes_user_id_foreign` (`user_id` ASC),
  CONSTRAINT `ordenes_user_id_foreign`
    FOREIGN KEY (`user_id`)
    REFERENCES `tiendalrv`.`users` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `tiendalrv`.`ordenes_items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tiendalrv`.`ordenes_items` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `precio` DECIMAL(12,2) NOT NULL,
  `cantidad` INT(10) UNSIGNED NOT NULL,
  `orden_id` BIGINT(20) UNSIGNED NOT NULL,
  `producto_id` BIGINT(20) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `ordenes_items_orden_id_foreign` (`orden_id` ASC),
  INDEX `ordenes_items_producto_id_foreign` (`producto_id` ASC),
  CONSTRAINT `ordenes_items_orden_id_foreign`
    FOREIGN KEY (`orden_id`)
    REFERENCES `tiendalrv`.`ordenes` (`id`),
  CONSTRAINT `ordenes_items_producto_id_foreign`
    FOREIGN KEY (`producto_id`)
    REFERENCES `tiendalrv`.`productos` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
ROW_FORMAT = DYNAMIC;


-- -----------------------------------------------------
-- Table `tiendalrv`.`password_resets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tiendalrv`.`password_resets` (
  `email` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `token` VARCHAR(255) CHARACTER SET 'utf8mb4' NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `password_resets_email_index` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
ROW_FORMAT = DYNAMIC;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
