-- MySQL Workbench Synchronization
-- Generated: 2020-12-03 15:36
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Audrey

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `portfolio-v2` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `portfolio-v2`.`portfolio_user` (
  `id_portfolio_user` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nickname_portfolio_user` VARCHAR(80) NOT NULL,
  `pwd_portfolio_user` VARCHAR(255) NOT NULL,
  `permission_portfolio_user` TINYINT(4) NOT NULL,
  `validation_status_portfolio_user` TINYINT(4) NOT NULL,
  `validation_key_portfolio_user` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_portfolio_user`),
  UNIQUE INDEX `nickname_portfolio_user_UNIQUE` (`nickname_portfolio_user` ASC) VISIBLE,
  UNIQUE INDEX `validation_key_portfolio_user_UNIQUE` (`validation_key_portfolio_user` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfolio-v2`.`portfolio_mail` (
  `id_portfolio_mail` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_portfolio_mail` VARCHAR(255) NOT NULL,
  `email_portfolio_mail` VARCHAR(180) NOT NULL,
  `phone_portfolio_mail` VARCHAR(25) NULL DEFAULT NULL,
  `message_portfolio_mail` TINYTEXT NOT NULL,
  PRIMARY KEY (`id_portfolio_mail`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfolio-v2`.`portfolio_link` (
  `id_portfolio_link` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_portfolio_link` VARCHAR(200) NOT NULL,
  `url_portfolio_link` VARCHAR(255) NOT NULL,
  `description_portfolio_link` TINYTEXT NOT NULL,
  `portfolio_user_id_portfolio_user` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_portfolio_link`),
  UNIQUE INDEX `name_portfolio_link_UNIQUE` (`name_portfolio_link` ASC) VISIBLE,
  INDEX `fk_portfolio_link_portfolio_user_idx` (`portfolio_user_id_portfolio_user` ASC) VISIBLE,
  CONSTRAINT `fk_portfolio_link_portfolio_user`
    FOREIGN KEY (`portfolio_user_id_portfolio_user`)
    REFERENCES `portfolio-v2`.`portfolio_user` (`id_portfolio_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `portfolio-v2`.`portfolio_img` (
  `id_portfolio_img` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_portfolio_img` VARCHAR(255) NOT NULL,
  `alt_portfolio_img` VARCHAR(100) NOT NULL,
  `portfolio_user_id_portfolio_user` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_portfolio_img`),
  INDEX `fk_portfolio_img_portfolio_user1_idx` (`portfolio_user_id_portfolio_user` ASC) VISIBLE,
  CONSTRAINT `fk_portfolio_img_portfolio_user1`
    FOREIGN KEY (`portfolio_user_id_portfolio_user`)
    REFERENCES `portfolio-v2`.`portfolio_user` (`id_portfolio_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
