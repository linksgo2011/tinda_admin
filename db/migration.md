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
 
# 密码查询关闭提示

> **ALTER TABLE `tinda`.`hchi_pscxsz` 
 ADD COLUMN `closed_tip` VARCHAR(45) NULL AFTER `pz_beiz`;**
 
# 增加用户积分
 ALTER TABLE `tinda`.`feedbackinfo` 
 ADD COLUMN `point` INT NOT NULL DEFAULT 0 COMMENT '积分' AFTER `us_koner`;

# product表

ALTER TABLE `tinda`.`product` 
ADD COLUMN `type` INT NULL DEFAULT 1 COMMENT '1 充时间 2充积分' AFTER `days`;

ALTER TABLE `tinda`.`product` 
ADD COLUMN `point` INT(11) NULL DEFAULT 0 AFTER `type`;

ALTER TABLE `tinda`.`order` 
ADD COLUMN `type` INT(11) NULL DEFAULT 1 COMMENT '1 充时间 2充积分' AFTER `days`,
ADD COLUMN `point` INT(11) NULL DEFAULT 0 AFTER `type`;

#live 表
ALTER TABLE  `live` ADD  `time` INT( 11 ) NOT NULL ,
ADD  `if_need_point` INT( 1 ) NOT NULL DEFAULT  '0',
ADD  `point` INT( 11 ) NOT NULL DEFAULT  '0',
ADD  `if_returned_point` INT( 1 ) NOT NULL DEFAULT  '0'

#创建apply_live表
CREATE TABLE `apply_live` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `if_need_point` tinyint(1) DEFAULT '0',
  `point` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `time` int(11) DEFAULT NULL,
  `img` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#创建live_rate

CREATE TABLE `tinda`.`live_rate` (
  `id` INT UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `live_id` INT NULL,
  `user_id` INT NULL,
  `rate` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));
  
# VIP 

ALTER TABLE `tinda`.`feedbackinfo` 
ADD COLUMN `vip` TINYINT(2) NULL DEFAULT 0 AFTER `point`;


# module

ALTER TABLE `tinda`.`finl` 
ADD COLUMN `module` VARCHAR(45) NULL DEFAULT 'data' AFTER `ggimg`;

# add created field to rj table 

ALTER TABLE `tinda`.`rj` 
ADD COLUMN `created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;

# add new field for `rj`

ALTER TABLE `tinda`.`rj` 
ADD COLUMN `chex` VARCHAR(45) NULL AFTER `created`;

# add field for points pay
ALTER TABLE `tinda`.`hchi_pscxsz` 
ADD COLUMN `points` INT NULL DEFAULT 0 AFTER `closed_tip`;


# add points for log
ALTER TABLE `tinda`.`rj` 
ADD COLUMN `points` INT NULL DEFAULT 0 AFTER `chex`;


# 密码查询提示语

ALTER TABLE `tinda`.`hchi_pscxsz` 
ADD COLUMN `pass_tip` VARCHAR(45) NULL AFTER `points`;

## 二手信息

CREATE TABLE `info_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '0 草稿\n1. 发布\n-1删除',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

CREATE TABLE `info_product_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

CREATE TABLE `info_product_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT '0' COMMENT '0 正常\n-1 删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
