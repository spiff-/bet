SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `bet`.`category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bet`.`category` (
  `id_cat` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `url` VARCHAR(32) NOT NULL ,
  `name` VARCHAR(64) NOT NULL ,
  PRIMARY KEY (`id_cat`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bet`.`bet`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bet`.`bet` (
  `id_bet` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_cat` INT UNSIGNED NOT NULL ,
  `question` VARCHAR(128) NOT NULL ,
  `max_points` INT UNSIGNED NULL ,
  `ends` DATETIME NULL ,
  PRIMARY KEY (`id_bet`) ,
  CONSTRAINT `fk_bet_category`
    FOREIGN KEY (`id_cat` )
    REFERENCES `bet`.`category` (`id_cat` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bet`.`party`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bet`.`party` (
  `id_party` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `url` VARCHAR(32) NOT NULL ,
  `acronym` VARCHAR(12) NOT NULL ,
  `name` VARCHAR(64) NOT NULL ,
  PRIMARY KEY (`id_party`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bet`.`bet_option`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bet`.`bet_option` (
  `id_bet` INT UNSIGNED NOT NULL ,
  `id_bet_option` TINYINT UNSIGNED NOT NULL ,
  `text` VARCHAR(64) NULL ,
  `id_party` INT UNSIGNED NULL ,
  PRIMARY KEY (`id_bet`, `id_bet_option`) ,
  CONSTRAINT `fk_bet_options_bet1`
    FOREIGN KEY (`id_bet` )
    REFERENCES `bet`.`bet` (`id_bet` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bet_options_party1`
    FOREIGN KEY (`id_party` )
    REFERENCES `bet`.`party` (`id_party` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bet`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bet`.`user` (
  `id_user` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nickname` VARCHAR(16) NOT NULL ,
  `password` VARCHAR(32) NOT NULL ,
  `email` VARCHAR(32) NOT NULL ,
  `points` INT UNSIGNED NULL DEFAULT 10 ,
  PRIMARY KEY (`id_user`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bet`.`bet_vote`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bet`.`bet_vote` (
  `id_user` INT UNSIGNED NOT NULL ,
  `id_bet` INT UNSIGNED NOT NULL ,
  `id_bet_option` TINYINT UNSIGNED NOT NULL ,
  `points` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_user`, `id_bet`) ,
  CONSTRAINT `fk_user_has_bet_option_user1`
    FOREIGN KEY (`id_user` )
    REFERENCES `bet`.`user` (`id_user` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_bet_option_bet_option1`
    FOREIGN KEY (`id_bet` , `id_bet_option` )
    REFERENCES `bet`.`bet_option` (`id_bet` , `id_bet_option` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bet`.`lottery`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bet`.`lottery` (
  `id_lot` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_cat` INT UNSIGNED NOT NULL ,
  `question` VARCHAR(128) NOT NULL ,
  `type` TINYINT UNSIGNED NOT NULL ,
  `points` SMALLINT UNSIGNED NOT NULL ,
  `ends` DATETIME NULL ,
  PRIMARY KEY (`id_lot`) ,
  CONSTRAINT `fk_lottery_category1`
    FOREIGN KEY (`id_cat` )
    REFERENCES `bet`.`category` (`id_cat` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bet`.`district`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bet`.`district` (
  `id_cat` INT UNSIGNED NOT NULL ,
  `id_district` SMALLINT UNSIGNED NOT NULL ,
  `name` VARCHAR(32) NOT NULL ,
  `seats` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_cat`, `id_district`) ,
  CONSTRAINT `fk_district_category1`
    FOREIGN KEY (`id_cat` )
    REFERENCES `bet`.`category` (`id_cat` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bet`.`district_party`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bet`.`district_party` (
  `id_district_party` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_cat` INT UNSIGNED NOT NULL ,
  `id_district` SMALLINT UNSIGNED NOT NULL ,
  `id_party` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_district_party`) ,
  CONSTRAINT `fk_district_has_party_district1`
    FOREIGN KEY (`id_cat` , `id_district` )
    REFERENCES `bet`.`district` (`id_cat` , `id_district` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_district_has_party_party1`
    FOREIGN KEY (`id_party` )
    REFERENCES `bet`.`party` (`id_party` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `bet`.`lottery_district_vote`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bet`.`lottery_district_vote` (
  `id_user` INT UNSIGNED NOT NULL ,
  `id_lot` INT UNSIGNED NOT NULL ,
  `id_district_party` INT UNSIGNED NOT NULL ,
  `result` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_user`, `id_lot`, `id_district_party`) ,
  CONSTRAINT `fk_lottery_vote_user1`
    FOREIGN KEY (`id_user` )
    REFERENCES `bet`.`user` (`id_user` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lottery_vote_lottery1`
    FOREIGN KEY (`id_lot` )
    REFERENCES `bet`.`lottery` (`id_lot` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lottery_district_vote_district_party1`
    FOREIGN KEY (`id_district_party` )
    REFERENCES `bet`.`district_party` (`id_district_party` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bet`.`lottery_vote`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `bet`.`lottery_vote` (
  `id_user` INT UNSIGNED NOT NULL ,
  `id_lot` INT UNSIGNED NOT NULL ,
  `answer` INT UNSIGNED NULL ,
  PRIMARY KEY (`id_user`, `id_lot`) ,
  CONSTRAINT `fk_user_has_lottery_user1`
    FOREIGN KEY (`id_user` )
    REFERENCES `bet`.`user` (`id_user` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_lottery_lottery1`
    FOREIGN KEY (`id_lot` )
    REFERENCES `bet`.`lottery` (`id_lot` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
