<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS `rewriteplus_pages`;
CREATE TABLE `rewriteplus_pages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `store_id` INT NOT NULL DEFAULT 0,
  `request_uri_match` VARCHAR (255) NOT NULL,
  `request_uri_original` VARCHAR (255) NOT NULL,
  `title` VARCHAR (255),
  `description_top` TEXT,
  `description_bottom` TEXT,
  `meta_title` TEXT,
  `meta_description` TEXT,
  `meta_keywords` TEXT,
  `status` TINYINT,
  `created_at` DATETIME,
  PRIMARY KEY (`id`),
  INDEX (`store_id`),
  INDEX (`request_uri_match`),
  INDEX (`status`)
);
");

$installer->endSetup();
