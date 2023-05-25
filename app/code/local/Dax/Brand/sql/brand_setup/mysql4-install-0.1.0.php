<?php
$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;
");

$installer->endSetup();
?>




