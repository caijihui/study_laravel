CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ## 密码：md5(123456) 格式;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `updated_at`, `created_at`)
VALUES
	(1, 'test', '', 'e10adc3949ba59abbe56e057f20f883e', '2018-08-29 07:29:23', '2018-08-29 07:29:23'),
	(2, 't1', '', 'e10adc3949ba59abbe56e057f20f883e', '2018-08-29 07:29:23', '2018-08-29 07:29:23'),
	(3, 't2', '', 'e10adc3949ba59abbe56e057f20f883e', '2018-08-29 07:29:23', '2018-08-29 07:29:23'),
	(4, 't3', '', 'e10adc3949ba59abbe56e057f20f883e', '2018-08-29 07:29:23', '2018-08-29 07:29:23');
