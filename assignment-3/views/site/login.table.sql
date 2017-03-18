CREATE TABLE `login` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `authKey` varchar(128) NOT NULL,
  `accessToken` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1