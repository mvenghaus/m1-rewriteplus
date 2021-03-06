<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS `rewriteplus_pages`;
CREATE TABLE `rewriteplus_pages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `store_ids` VARCHAR (255) NOT NULL,
  `group_id` INT (11),
  `request_uri_match` VARCHAR (255) NOT NULL,
  `request_uri_original` VARCHAR (255) NOT NULL,
  `title` VARCHAR (255),
  `description_top` TEXT,
  `description_bottom` TEXT,
  `meta_title` TEXT,
  `meta_description` TEXT,
  `meta_keywords` TEXT,
  `meta_robots` VARCHAR (255),
  `meta_canonical` TEXT,
  `status` TINYINT,
  `created_at` DATETIME,
  PRIMARY KEY (`id`),
  INDEX (`store_ids`),
  INDEX (`request_uri_match`),
  INDEX (`status`)
);
");


$installer->run("
DROP TABLE IF EXISTS `rewriteplus_groups`;
CREATE TABLE `rewriteplus_groups` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR (255),
  `created_at` DATETIME,
  PRIMARY KEY (`id`)
);
");


$installer->endSetup();
