CREATE TABLE `actor_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
INSERT INTO `actor_test` VALUES (1,'Jens','Bodal'),(2,'Emily','Snyder');
CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `test2` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;