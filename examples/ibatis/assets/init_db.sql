CREATE TABLE IF NOT EXISTS `item` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `status` bit(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB;

INSERT IGNORE item (title, status) values ("Item 1", 1);
INSERT IGNORE item (title, status) values ("Item 2", 0);
INSERT IGNORE item (title, status) values ("Item 3", 1);

CREATE PROCEDURE IF NOT EXISTS `sp_in`(IN p VARCHAR(10))
	SET @x = P;

