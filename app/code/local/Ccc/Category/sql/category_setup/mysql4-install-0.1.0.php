<?php
$installer = $this;
$installer->startSetup();
$installer->run("
	DROP TABLE IF EXISTS {$this->getTable('category')};
	CREATE TABLE {$this->getTable('category')} (
	  `category_id` int(11) NOT NULL,
	  `name` varchar(255) NOT NULL,
	  `status` tinyint(4) NOT NULL,
	  `created_at` datetime NOT NULL,
	  `updated_at` datetime DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
	ALTER TABLE {$this->getTable('category')}
		ADD PRIMARY KEY (`category_id`);
	ALTER TABLE {$this->getTable('category')}
  		MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;
");
$installer->endSetup();