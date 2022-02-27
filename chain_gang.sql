DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `admins` VALUES (1,'Kevin','Skoglund','kevin@somewhere.com','kskoglund','$2y$10$74202tWuILkLIEKyAUKR/ejEmtXUjwIV3XWlWz.BeRpSgOtZAC0FS');

DROP TABLE IF EXISTS `bicycles`;
CREATE TABLE `bicycles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(4) NOT NULL,
  `category` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `weight_kg` decimal(9,5) NOT NULL,
  `condition_id` tinyint(3) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO `bicycles` VALUES (1,'Trek','Emonda',2017,'Hybrid','Unisex','black',1495.00,1.50000,5,''),(2,'Cannondale','Synapse',2016,'Road','Unisex','matte black',1999.00,1.00000,5,''),(3,'Schwinn','Cutter',2016,'City','Unisex','white',450.00,18.00000,4,''),(4,'Mongoose','Switchback Sport',2015,'Mountain','Mens','blue',399.00,24.00000,2,''),(5,'Diamondback','Overdrive',2016,'Mountain','Unisex','dark green',565.00,23.70000,3,''),(6,'Schwinn','21-Speed Suburban CS',2015,'Hybrid','Womens','burgundy',299.00,20.00000,3,''),(7,'Schwinn','Sanctuary 7-Speed',2016,'Cruiser','Womens','purple',199.00,19.50000,3,'');
