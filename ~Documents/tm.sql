SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `sibnii` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `sibnii` ;

-- -----------------------------------------------------
-- Table `sibnii`.`client`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`client` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL ,
  `logo` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`project`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`project` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL ,
  `is_complite` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `client_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_project_client` (`client_id` ASC) ,
  CONSTRAINT `fk_project_client`
    FOREIGN KEY (`client_id` )
    REFERENCES `sibnii`.`client` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`service`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`service` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`project_service`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`project_service` (
  `project_id` INT UNSIGNED NOT NULL ,
  `service_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`project_id`, `service_id`) ,
  INDEX `fk_project_service_service1` (`service_id` ASC) ,
  CONSTRAINT `fk_project_service_project1`
    FOREIGN KEY (`project_id` )
    REFERENCES `sibnii`.`project` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_service_service1`
    FOREIGN KEY (`service_id` )
    REFERENCES `sibnii`.`service` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`gallery`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`gallery` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `img` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL ,
  `object_id` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_user_role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_user_role` (
  `id` INT NOT NULL ,
  `title` VARCHAR(32) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(32) NOT NULL ,
  `password` VARCHAR(32) NOT NULL ,
  `role_id` INT NOT NULL ,
  `date_create` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tm_user_tm_user_role1` (`role_id` ASC) ,
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) ,
  CONSTRAINT `fk_tm_user_tm_user_role1`
    FOREIGN KEY (`role_id` )
    REFERENCES `sibnii`.`tm_user_role` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_task`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_task` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  `date_create` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tm_task_tm_user1` (`user_id` ASC) ,
  CONSTRAINT `fk_tm_task_tm_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `sibnii`.`tm_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_acl_task`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_acl_task` (
  `user_id` INT UNSIGNED NOT NULL ,
  `task_id` INT UNSIGNED NOT NULL ,
  `is_read` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `is_write` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `is_executant` TINYINT(1)  NULL DEFAULT 0 ,
  PRIMARY KEY (`user_id`, `task_id`) ,
  INDEX `fk_tm_acl_tm_user1` (`user_id` ASC) ,
  INDEX `fk_tm_acl_tm_task1` (`task_id` ASC) ,
  CONSTRAINT `fk_tm_acl_tm_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `sibnii`.`tm_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tm_acl_tm_task1`
    FOREIGN KEY (`task_id` )
    REFERENCES `sibnii`.`tm_task` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_document`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_document` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `date_create` DATETIME NOT NULL ,
  `file` VARCHAR(255) NULL ,
  `is_folder` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `parent_id` INT UNSIGNED NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tm_document_tm_document1` (`parent_id` ASC) ,
  CONSTRAINT `fk_tm_document_tm_document1`
    FOREIGN KEY (`parent_id` )
    REFERENCES `sibnii`.`tm_document` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_discussion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_discussion` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `message` TEXT NOT NULL ,
  `date` DATETIME NOT NULL ,
  `is_first` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `topic_id` INT UNSIGNED NOT NULL ,
  `parent_id` INT UNSIGNED NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tm_discussion_tm_discussion1` (`parent_id` ASC) ,
  INDEX `fk_tm_discussion_tm_user1` (`user_id` ASC) ,
  CONSTRAINT `fk_tm_discussion_tm_discussion1`
    FOREIGN KEY (`parent_id` )
    REFERENCES `sibnii`.`tm_discussion` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tm_discussion_tm_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `sibnii`.`tm_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_task_relation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_task_relation` (
  `parent_id` INT UNSIGNED NOT NULL ,
  `child_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`parent_id`, `child_id`) ,
  INDEX `fk_tm_task_relation_tm_task2` (`child_id` ASC) ,
  CONSTRAINT `fk_tm_task_relation_tm_task1`
    FOREIGN KEY (`parent_id` )
    REFERENCES `sibnii`.`tm_task` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tm_task_relation_tm_task2`
    FOREIGN KEY (`child_id` )
    REFERENCES `sibnii`.`tm_task` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_user_profile`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_user_profile` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `profile_key` VARCHAR(255) NOT NULL ,
  `profile_value` TEXT NOT NULL ,
  PRIMARY KEY (`user_id`, `profile_key`) ,
  INDEX `fk_tm_user_profile_tm_user1` (`user_id` ASC) ,
  CONSTRAINT `fk_tm_user_profile_tm_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `sibnii`.`tm_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_task_attribute_type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_task_attribute_type` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(50) NOT NULL ,
  `handler` VARCHAR(100) NOT NULL ,
  `description` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `title_UNIQUE` (`title` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_task_attribute`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_task_attribute` (
  `task_id` INT UNSIGNED NOT NULL ,
  `attribute_key` VARCHAR(255) NOT NULL ,
  `type_id` INT UNSIGNED NOT NULL ,
  `attribute_value` TEXT NOT NULL ,
  PRIMARY KEY (`task_id`, `attribute_key`) ,
  INDEX `fk_tm_task_attribute_tm_task_attribute_type1` (`type_id` ASC) ,
  INDEX `fk_tm_task_attribute_tm_task1` (`task_id` ASC) ,
  CONSTRAINT `fk_tm_task_attribute_tm_task_attribute_type1`
    FOREIGN KEY (`type_id` )
    REFERENCES `sibnii`.`tm_task_attribute_type` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tm_task_attribute_tm_task1`
    FOREIGN KEY (`task_id` )
    REFERENCES `sibnii`.`tm_task` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_discussion_document`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_discussion_document` (
  `tm_document_id` INT UNSIGNED NOT NULL ,
  `tm_discussion_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`tm_document_id`, `tm_discussion_id`) ,
  INDEX `fk_tm_document_discussion_tm_document1` (`tm_document_id` ASC) ,
  INDEX `fk_tm_document_discussion_tm_discussion1` (`tm_discussion_id` ASC) ,
  CONSTRAINT `fk_tm_document_discussion_tm_document1`
    FOREIGN KEY (`tm_document_id` )
    REFERENCES `sibnii`.`tm_document` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tm_document_discussion_tm_discussion1`
    FOREIGN KEY (`tm_discussion_id` )
    REFERENCES `sibnii`.`tm_discussion` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_task_document`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_task_document` (
  `task_id` INT UNSIGNED NOT NULL ,
  `document_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`task_id`, `document_id`) ,
  INDEX `fk_tm_task_document_tm_task1` (`task_id` ASC) ,
  CONSTRAINT `fk_tm_task_document_tm_document1`
    FOREIGN KEY (`document_id` )
    REFERENCES `sibnii`.`tm_document` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tm_task_document_tm_task1`
    FOREIGN KEY (`task_id` )
    REFERENCES `sibnii`.`tm_task` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_acl_document`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_acl_document` (
  `user_id` INT UNSIGNED NOT NULL ,
  `document_id` INT UNSIGNED NOT NULL ,
  `is_read` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `is_write` TINYINT(1)  NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`user_id`, `document_id`) ,
  INDEX `fk_tm_acl_document_tm_user1` (`user_id` ASC) ,
  CONSTRAINT `fk_tm_acl_document_tm_document1`
    FOREIGN KEY (`document_id` )
    REFERENCES `sibnii`.`tm_document` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tm_acl_document_tm_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `sibnii`.`tm_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_acl_discussion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_acl_discussion` (
  `user_id` INT UNSIGNED NOT NULL ,
  `discussion_id` INT UNSIGNED NOT NULL ,
  `is_read` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `is_write` TINYINT(1)  NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`user_id`, `discussion_id`) ,
  INDEX `fk_tm_acl_discussion_tm_discussion1` (`discussion_id` ASC) ,
  INDEX `fk_tm_acl_discussion_tm_user1` (`user_id` ASC) ,
  CONSTRAINT `fk_tm_acl_discussion_tm_discussion1`
    FOREIGN KEY (`discussion_id` )
    REFERENCES `sibnii`.`tm_discussion` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tm_acl_discussion_tm_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `sibnii`.`tm_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_task_discussion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_task_discussion` (
  `task_id` INT UNSIGNED NOT NULL ,
  `discussion_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`task_id`, `discussion_id`) ,
  INDEX `fk_tm_task_discussion_tm_discussion1` (`discussion_id` ASC) ,
  CONSTRAINT `fk_tm_task_discussion_tm_task1`
    FOREIGN KEY (`task_id` )
    REFERENCES `sibnii`.`tm_task` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tm_task_discussion_tm_discussion1`
    FOREIGN KEY (`discussion_id` )
    REFERENCES `sibnii`.`tm_discussion` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_document_attribute_type`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_document_attribute_type` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(50) NOT NULL ,
  `handler` VARCHAR(100) NOT NULL ,
  `description` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `title_UNIQUE` (`title` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibnii`.`tm_document_attribute`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibnii`.`tm_document_attribute` (
  `document_id` INT UNSIGNED NOT NULL ,
  `attribute_key` VARCHAR(255) NOT NULL ,
  `type_id` INT UNSIGNED NOT NULL ,
  `attribute_value` TEXT NOT NULL ,
  PRIMARY KEY (`document_id`, `attribute_key`) ,
  INDEX `fk_tm_task_attribute_tm_task1` (`document_id` ASC) ,
  INDEX `fk_tm_document_attribute_tm_document_attribute_type1` (`type_id` ASC) ,
  CONSTRAINT `fk_tm_task_attribute_tm_task10`
    FOREIGN KEY (`document_id` )
    REFERENCES `sibnii`.`tm_document` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tm_document_attribute_tm_document_attribute_type1`
    FOREIGN KEY (`type_id` )
    REFERENCES `sibnii`.`tm_document_attribute_type` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
