CREATE DATABASE `PoaPostos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE PoaPostos;

CREATE TABLE `marker` (
  `marker_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR( 120 ) NOT NULL,
  `address` VARCHAR( 140 ) NOT NULL,
  `lat` FLOAT( 10, 8 ) NOT NULL,
  `lng` FLOAT( 10, 8 ) NOT NULL,
  `type` VARCHAR( 80 ) NOT NULL,
  `price` FLOAT( 6, 3 ) NOT NULL
) ENGINE = MYISAM ;
