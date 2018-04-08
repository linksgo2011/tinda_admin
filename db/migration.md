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