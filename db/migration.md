# 这个文件存放每次添加功能后SQL变化

> CREATE TABLE `meta` (
    `id` int(11) NOT NULL,
    `key` varchar(45) NOT NULL,
    `value` varchar(45) NOT NULL,
    `comment` varchar(45) DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `id_UNIQUE` (`id`),
    UNIQUE KEY `key_UNIQUE` (`key`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 