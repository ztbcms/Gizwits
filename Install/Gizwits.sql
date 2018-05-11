DROP TABLE IF EXISTS `cms_gizwits_config`;
CREATE TABLE `cms_gizwits_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_key` varchar(128) NOT NULL DEFAULT '' COMMENT '产品key',
  `product_secret` varchar(128) NOT NULL DEFAULT '' COMMENT '产品密钥',
  `phone_id` varchar(128) NOT NULL DEFAULT '' COMMENT '匿名注册，通过唯一的 phone_id',
  `app_id` varchar(128) NOT NULL DEFAULT '' COMMENT '应用ID',
  `app_secret` varchar(128) NOT NULL DEFAULT '' COMMENT '应用私钥',
  `user_token` varchar(128) NOT NULL DEFAULT '' COMMENT '匿名用户访问凭证',
  `user_token_expire_at` int(11) NOT NULL COMMENT '匿名用户访问凭证过期时间',
  `frequency_sync_dev` int(11) NOT NULL COMMENT '同步设备频率(x秒/次)',
  `is_default` tinyint(2) NOT NULL COMMENT '是否是默认',
  PRIMARY KEY (`id`),
  KEY `product_key` (`product_key`),
  KEY `app_id` (`app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cms_gizwits_config` (`id`, `product_key`, `product_secret`, `phone_id`, `app_id`, `app_secret`, `user_token`, `user_token_expire_at`, `frequency_sync_dev`, `is_default`)
VALUES
	(1,'d650f482d0d9443f90e434d3714a41f8','1eb5ba81c00f44cd8d0559889cbc4e90','b352fae9a8b141f5944216c1c2b73038','b352fae9a8b141f5944216c1c2b73038','c3153a19f14e486c8d6d06aa28483266','91e5695b18eb44aea17aa78ac65d7f90',1523957003,300,1);


DROP TABLE IF EXISTS `cms_gizwits_control_log`;
CREATE TABLE `cms_gizwits_control_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(11) NOT NULL DEFAULT '' COMMENT '命令类型',
  `param` varchar(11) NOT NULL DEFAULT '',
  `response` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `cms_gizwits_device`;
CREATE TABLE `cms_gizwits_device` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_key` varchar(128) NOT NULL DEFAULT '' COMMENT '所属产品key',
  `mac` varchar(128) NOT NULL DEFAULT '' COMMENT '设备mac地址',
  `did` varchar(128) NOT NULL DEFAULT '' COMMENT '设备id',
  `is_online` tinyint(2) NOT NULL COMMENT '是否在线 0不在线 1在线',
  `passcode` varchar(64) NOT NULL DEFAULT '' COMMENT '设备 passcode',
  `host` varchar(64) NOT NULL DEFAULT '' COMMENT '连接服务器的域名',
  `port` varchar(16) NOT NULL DEFAULT '' COMMENT 'M2M 的 mqtt 端口号',
  `port_s` varchar(16) NOT NULL DEFAULT '' COMMENT 'M2M 的 mqtt SSL 端口号',
  `ws_port` varchar(16) NOT NULL DEFAULT '' COMMENT 'websocket 端口号',
  `wss_port` varchar(16) NOT NULL DEFAULT '' COMMENT 'websocket SSL 端口号',
  `remark` varchar(64) NOT NULL DEFAULT '' COMMENT '设备备注',
  `is_disabled` tinyint(2) NOT NULL COMMENT '是否注销 0否 1是',
  `type` varchar(16) NOT NULL DEFAULT '' COMMENT '设备类型，单品设备:normal,中控设备:center_control,中控子设备:sub_dev',
  `dev_alias` varchar(64) NOT NULL DEFAULT '' COMMENT '设备别名',
  `dev_label` varchar(128) NOT NULL DEFAULT '' COMMENT '设备标签列表，目前用于语音 API 批量设备控制',
  `role` varchar(32) NOT NULL DEFAULT '' COMMENT '绑定角色， 特殊用户:special,拥有者:owner,访客:guest,普通用户:normal',
  `attr` text NOT NULL COMMENT '数据点及其值',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '最后更新时间',
  `sync_at` int(11) NOT NULL COMMENT 'IOT平台最后同步时间',
  `cloud_update_at` int(11) NOT NULL COMMENT '机智云平台最后更新时间',
  PRIMARY KEY (`id`),
  KEY `did` (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;