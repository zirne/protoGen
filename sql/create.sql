CREATE TABLE IF NOT EXISTS `tbl_meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8_swedish_ci NOT NULL,
  `title` text COLLATE utf8_swedish_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `editable` tinyint(1) NOT NULL,
  `created` timestamp DEFAULT 0 NOT NULL ,
  `edited` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE IF NOT EXISTS `tbl_attachments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` TEXT COLLATE utf8_swedish_ci NOT NULL,
  `type` TEXT COLLATE utf8_swedish_ci NOT NULL,
  `data` LONGBLOB NOT NULL,
  `meetingID` INT(11) NOT NULL,
  `size` TEXT COLLATE utf8_swedish_ci NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `created` TIMESTAMP DEFAULT 0 NOT NULL,
  `edited` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
