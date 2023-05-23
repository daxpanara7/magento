<?php
$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS `dax`;
CREATE TABLE `dax` (
  `entity_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `dax`
  ADD PRIMARY KEY (`entity_id`);

ALTER TABLE `dax`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT;

");

$installer->endSetup();
?>