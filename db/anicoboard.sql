-- MySQL Script generated by MySQL Workbench
-- Mon Nov  6 17:21:45 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema anicoboard
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema anicoboard
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `anicoboard` DEFAULT CHARACTER SET utf8 ;
USE `anicoboard` ;

-- -----------------------------------------------------
-- Table `anicoboard`.`register`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anicoboard`.`register` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(50) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `author` VARCHAR(45) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anicoboard`.`articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anicoboard`.`articles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `register_id` INT NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_articles_register1_idx` (`register_id` ASC),
  CONSTRAINT `fk_articles_register1`
    FOREIGN KEY (`register_id`)
    REFERENCES `anicoboard`.`register` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anicoboard`.`pics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anicoboard`.`pics` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `articles_id` INT NOT NULL,
  `src` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pics_articles_idx` (`articles_id` ASC),
  CONSTRAINT `fk_pics_articles`
    FOREIGN KEY (`articles_id`)
    REFERENCES `anicoboard`.`articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anicoboard`.`likes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anicoboard`.`likes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `articles_id` INT NOT NULL,
  `register_id` INT NOT NULL,
  `like` TINYINT(10) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_likes_articles1_idx` (`articles_id` ASC),
  INDEX `fk_likes_register1_idx` (`register_id` ASC),
  CONSTRAINT `fk_likes_articles1`
    FOREIGN KEY (`articles_id`)
    REFERENCES `anicoboard`.`articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_likes_register1`
    FOREIGN KEY (`register_id`)
    REFERENCES `anicoboard`.`register` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anicoboard`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anicoboard`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `articles_id` INT NOT NULL,
  `register_id` INT NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comments_articles1_idx` (`articles_id` ASC),
  INDEX `fk_comments_register1_idx` (`register_id` ASC),
  CONSTRAINT `fk_comments_articles1`
    FOREIGN KEY (`articles_id`)
    REFERENCES `anicoboard`.`articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_register1`
    FOREIGN KEY (`register_id`)
    REFERENCES `anicoboard`.`register` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anicoboard`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anicoboard`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usericon` VARCHAR(255) NOT NULL,
  `register_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_register1_idx` (`register_id` ASC),
  CONSTRAINT `fk_users_register1`
    FOREIGN KEY (`register_id`)
    REFERENCES `anicoboard`.`register` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
