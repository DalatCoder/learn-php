CREATE DATABASE cms;

CREATE TABLE `cms`.`category` ( 
	`cat_id` INT(3) NOT NULL AUTO_INCREMENT , 
	`cat_title` VARCHAR(255) NOT NULL , 
	PRIMARY KEY (`cat_id`(3))
) ENGINE = InnoDB;