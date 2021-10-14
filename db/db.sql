USE `host1836266_invoices`;

/*Table structure for table `invoices` */

DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `status_id` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-invoices-from_id` (`from_id`),
  KEY `fk-invoices-to_id` (`to_id`),
  KEY `fk-invoices-receiver_id` (`receiver_id`),
  KEY `fk-invoices-status_id` (`status_id`),
  CONSTRAINT `fk-invoices-from_id` FOREIGN KEY (`from_id`) REFERENCES `places` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-invoices-receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `receivers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-invoices-status_id` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-invoices-to_id` FOREIGN KEY (`to_id`) REFERENCES `places` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `invoices` */

insert  into `invoices`(`id`,`from_id`,`to_id`,`receiver_id`,`status_id`) values 
(1,4,6,1,6),
(2,2,10,1,6),
(3,1,9,1,6),
(4,3,8,1,6),
(5,1,7,1,6),
(10,4,4,1,6),
(11,1,7,1,6),
(12,8,4,1,5),
(13,2,2,1,5);

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values 
('m000000_000000_base',1634103263),
('m211013_052237_create_places_table',1634103265),
('m211013_052243_create_receivers_table',1634103265),
('m211013_052250_create_status_table',1634103265),
('m211013_052254_create_invoices_table',1634103269);

/*Table structure for table `places` */

DROP TABLE IF EXISTS `places`;

CREATE TABLE `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `places` */

insert  into `places`(`id`,`name`,`description`,`is_active`) values 
(1,'Москва','',1),
(2,'Тверь','',1),
(3,'Омск','',1),
(4,'Томск','',1),
(5,'Хабаровск','',1),
(6,'Челябинск','',1),
(7,'Самара','',1),
(8,'Иркутск','',1),
(9,'Краснаярск','',1),
(10,'Владивосток','',1);

/*Table structure for table `receivers` */

DROP TABLE IF EXISTS `receivers`;

CREATE TABLE `receivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) DEFAULT NULL,
  `is_active` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `receivers` */

insert  into `receivers`(`id`,`fullname`,`is_active`) values 
(1,'Иванов И.И',1);

/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `is_active` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `status` */

insert  into `status`(`id`,`name`,`is_active`) values 
(1,'Создан',1),
(2,'Доставлено',1),
(3,'В пути',1),
(4,'Принят на склад',1),
(5,'Возвращен',1),
(6,'Ожидает отправки',1);
