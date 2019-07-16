DROP TABLE IF EXISTS `module`;
CREATE TABLE `module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `isdistinction` tinyint(1) DEFAULT NULL,
  `markreceived` float DEFAULT NULL,
  `modulecode` varchar(128) DEFAULT NULL,
  `moduledescription` varchar(128) DEFAULT NULL,
  `snumber` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `birthdate` date DEFAULT NULL,
  `degree` varchar(128) DEFAULT NULL,
  `entrydate` date DEFAULT NULL,
  `firstname` varchar(128) DEFAULT NULL,
  `lastname` varchar(128) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

INSERT INTO `module` (`id`,`modulecode`,`moduledescription`,`isdistinction`,`markreceived`,`snumber`) VALUES 
 ('1', 'COS121', 'Software Modelling in C', '1', '80', '1'),
 ('2', 'COS110', 'Program Design Introduction', '0', '60', '1'),
 ('3', 'COS122', 'Operating Systems', '1', '78', '1'),
 ('4', 'COS326', 'Database Systems', '1', '85', '2'),
 ('5', 'COS330', 'Computer Security and Ethics', '1', '83', '2'),
 ('6', 'COS333', 'Programming Languages', '1', '89', '2'),
 ('7', 'COS214', 'Software Modelling', '0', '54', '3'),
 ('8', 'COS226', 'Concurrent Systems', '0', '48', '3'),
 ('9', 'COS284', 'Computer Organisation and Architecture', '0', '57', '3'),
 ('10', 'COS326', 'Database Systems', '0', '69', '4'),
 ('11', 'COS330', 'Computer Security and Ethics', '1', '94', '4'),
 ('12', 'COS333', 'Programming Languages', '0', '74', '4');

INSERT INTO `student` (`degree`,`entrydate`,`id`,`lastname`,`firstname`,`birthdate`,`year`) VALUES 
 ('BScIT', '2019-01-01', '1', 'Larone', 'Toby', '1995-07-09', '1'),
 ('BScCS', '2017-01-01', '2', 'Beans', 'Phil', '1993-09-11', '3'),
 ('BScCS', '2018-01-01', '3', 'Beans', 'Phil', '1994-07-03', '2'),
 ('BscCS', '2019-01-01', '4', 'Helen', 'Hywater', '1994-03-06', '3');