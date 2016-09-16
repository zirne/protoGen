CREATE TABLE IF NOT EXISTS `tbl_meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8_swedish_ci NOT NULL,
  `title` text COLLATE utf8_swedish_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `editable` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

