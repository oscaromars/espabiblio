CREATE TABLE IF NOT EXISTS `biblio_copy_fields_dm` (
  `code` varchar(16) NOT NULL,
  `description` char(32) NOT NULL,
  `default_flg` char(1) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;