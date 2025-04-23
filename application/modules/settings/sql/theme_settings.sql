-- Theme Settings Table for KlinicX

CREATE TABLE IF NOT EXISTS `theme_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_id` varchar(255) NOT NULL,
  `setting_key` varchar(255) NOT NULL,
  `setting_value` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `theme_key_unique` (`theme_id`, `setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 