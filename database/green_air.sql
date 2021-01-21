/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.13-MariaDB : Database - green_air
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `account_types` */

DROP TABLE IF EXISTS `account_types`;

CREATE TABLE `account_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `account_types` */

insert  into `account_types`(`id`,`name`,`created_at`,`updated_at`) values (1,'Customer',NULL,NULL),(2,'Supplier',NULL,NULL),(3,'Official',NULL,NULL);

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `accounts` */

/*Table structure for table `brands` */

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `brands` */

insert  into `brands`(`id`,`name`,`description`,`created_at`,`updated_at`) values (1,'Sharp',NULL,NULL,NULL),(2,'Philips',NULL,NULL,NULL),(3,'National',NULL,NULL,NULL),(4,'Winstar',NULL,NULL,NULL),(5,'China TV',NULL,NULL,NULL),(6,'All Brand',NULL,NULL,NULL),(7,'Pigeon',NULL,NULL,NULL),(8,'Elite',NULL,NULL,NULL),(9,'General',NULL,NULL,NULL),(10,'Gree',NULL,NULL,NULL),(11,'Midea',NULL,NULL,NULL),(12,'Miyako',NULL,NULL,NULL),(13,'Panasonic',NULL,NULL,NULL),(14,'Nova',NULL,NULL,NULL),(15,'Pezion',NULL,NULL,NULL),(16,'Samsung',NULL,NULL,NULL),(17,'Sony',NULL,NULL,NULL),(18,'Mi',NULL,NULL,NULL),(19,'Shamim',NULL,NULL,NULL),(20,'Hot Point',NULL,NULL,NULL),(21,'Ariston',NULL,NULL,NULL);

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`description`,`created_at`,`updated_at`) values (1,'Blender',NULL,NULL,NULL),(2,'Hair Dryer',NULL,NULL,NULL),(3,'Air Cutter',NULL,NULL,NULL),(4,'Room Heater',NULL,NULL,NULL),(5,'TV',NULL,NULL,NULL),(6,'Iron',NULL,NULL,NULL),(7,'Kettle',NULL,NULL,NULL),(8,'AC',NULL,NULL,NULL),(9,'Dehumidifier',NULL,NULL,NULL),(10,'Vaccum Cleaner',NULL,NULL,NULL),(11,'Infared Cooker',NULL,NULL,NULL),(12,'Micro Oven',NULL,NULL,NULL),(13,'Air Cooler',NULL,NULL,NULL),(14,'Refrigerator',NULL,NULL,NULL),(15,'Rice Cooker',NULL,NULL,NULL),(16,'Electric Oven',NULL,NULL,NULL),(17,'Washing Machine',NULL,NULL,NULL),(18,'TV Box',NULL,NULL,NULL),(19,'Accessories',NULL,NULL,NULL),(20,'Geyser',NULL,NULL,NULL);

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid` double(16,2) DEFAULT NULL,
  `due` double(16,2) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000127 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers` */

insert  into `customers`(`id`,`name`,`address`,`area`,`country`,`primary_contact`,`secondary_contact`,`email`,`customer_type`,`paid`,`due`,`remarks`,`created_at`,`updated_at`) values (1000000,'Aminur Rahman','Mirpur 10, Dhaka','','','8801712161847','','','',0.00,3500.00,'\r',NULL,NULL),(1000001,'Adnan Bhai','','','','8801672218333','','','',0.00,44500.00,'Sar Securities\r',NULL,NULL),(1000002,'Anowar Hossain','','','','8801715861776','','','',0.00,10500.00,'Police\r',NULL,NULL),(1000003,'Anik ','Anwar Landmark, Kallyanpur, Dhaka','','','8801711281827','','','',0.00,11500.00,'Chuadanga\r',NULL,NULL),(1000004,'Aqualink','','','','','','','',0.00,8000.00,'Asif Reference\r',NULL,NULL),(1000005,'Afroza Apa','','','','8801733003883','','','',0.00,15000.00,'Apple Tree School\r',NULL,NULL),(1000006,'Asif Jahangir','Senpara Parbota, Mirpur 10, Dhaka','','','8801673677052','','','',0.00,19000.00,'\r',NULL,NULL),(1000007,'Apple Tree School','','','','','','','',0.00,57600.00,'\r',NULL,NULL),(1000008,'Bikroy.Com','Banani Dhaka','','','8801844080531','','','',0.00,13500.00,'\r',NULL,NULL),(1000009,'Chinu Mama','','','','','','','',0.00,55900.00,'\r',NULL,NULL),(1000010,'Chottu Bhai','Mohammadpur, Dhaka','','','8801752065076','','','',0.00,14000.00,'\r',NULL,NULL),(1000011,'Dc Asad Shaheeb','Dhanmondi, Dhaka','','','8801711124234','','','',0.00,21500.00,'\r',NULL,NULL),(1000012,'Earthmoving Solutions','Majar Road, Dhaka','','','8801711281827','','','',0.00,51500.00,'\r',NULL,NULL),(1000013,'Engineer Habib Bhai','Mitaly Housing, Kochukhet, Dhaka','','','','','','',0.00,10000.00,'\r',NULL,NULL),(1000014,'Emdad ','Mirpur 2, Dhaka','','','8801718737117','','','',0.00,4000.00,'Shohag\' Collegue\r',NULL,NULL),(1000015,'Ehasanur Rahman','','','','8801674977961','','','',0.00,36000.00,'Asif Ref.\r',NULL,NULL),(1000016,'Faisal Ahmed','Ibrahimpur, Dhaka','','','','','','',0.00,54600.00,'Atik Friend\r',NULL,NULL),(1000017,'Farzana ','','','','8801626623507','','','',0.00,22000.00,'Asiatek\r',NULL,NULL),(1000018,'Feroz Reza','','','','8801730405936','','','',0.00,13000.00,'Runner Auto\r',NULL,NULL),(1000019,'General Engineering','','','','8801709998110','','','',0.00,129060.00,'\r',NULL,NULL),(1000020,'Happy ','Darsana, Chuadanga','','','8801783903749','','','',0.00,2500.00,'Darsana Atik Ref\r',NULL,NULL),(1000021,'Home Décor','Mirpur 10, Dhaka','','','','','','',0.00,2000.00,'Curtain Shop\r',NULL,NULL),(1000022,'International Office of Migration (IOM)','Gulshan 1, Dhaka','','','','','','',0.00,93500.00,'Faisal Ref\r',NULL,NULL),(1000023,'Jony ','Jamalpur','','','8801711642080','','','',0.00,44600.00,'Atik\'s Friend\r',NULL,NULL),(1000024,'Jhontu','Darsana, Chuadanga','','','','','','',0.00,3000.00,'Darsana\r',NULL,NULL),(1000025,'Jahangir Alam','Darsana, Chuadanga','','','8801974442849','','','',0.00,13000.00,'Darsana\r',NULL,NULL),(1000026,'Kajol Vai ','','','','8801716247429','','','',0.00,3000.00,'Mirpur Traders \r',NULL,NULL),(1000027,'Kopot ','Anwar Landmark, Kallyanpur, Dhaka','','','','','','',0.00,12500.00,'Shohag Ref.\r',NULL,NULL),(1000028,'Lt Colonel Anwar','','','','8801711159216','','','',0.00,32500.00,'Atik\r',NULL,NULL),(1000029,'Masud Bhai','Senpara Parbota, Mirpur 10, Dhaka','','','8801913040402','','','',0.00,1600.00,'Senpara Car Workshop\r',NULL,NULL),(1000030,'Mazhar Bhai','Mirpur 10, Dhaka','','','8801612366711','','','',0.00,17200.00,'\r',NULL,NULL),(1000031,'Mehedy zaman','Mirpur 10, Dhaka','','','','','','',0.00,-2000.00,'\r',NULL,NULL),(1000032,'Mentors Kolabagan Branch','Kalabagan, Dhaka','','','','','','',0.00,215150.00,'\r',NULL,NULL),(1000033,'Mentors Uttara Branch','Josimuddin, Dhaka','','','','','','',0.00,2500.00,'\r',NULL,NULL),(1000034,'Mentors Mouchak Branch','Mouchak, Dhaka','','','','','','',0.00,9600.00,'\r',NULL,NULL),(1000035,'Jamil ','','','','','','','',0.00,33000.00,'Asif Ref.\r',NULL,NULL),(1000036,'Masud','','','','','','','',0.00,23000.00,'Asif Ref\r',NULL,NULL),(1000037,'Mishu Vai ','Jamalpur','','','8801783000813','','','',0.00,55850.00,'Atik Ref\r',NULL,NULL),(1000038,'Manhood Fashion','Mirpur 10, Dhaka','','','8801710420742','','','',0.00,162000.00,'\r',NULL,NULL),(1000039,'Monowar','60 Feet, Mirpur Dhaka','','','8801672879159','','','',0.00,14310.00,'\r',NULL,NULL),(1000040,'Miraz Vai','Mirpur 11, Dhaka','','','8801923288073','','','',0.00,9900.00,'Japan\r',NULL,NULL),(1000041,'Mony Vai ','Mirpur 10, Dhaka','','','8801791055080','','','',0.00,26900.00,'Mirpur Traders \r',NULL,NULL),(1000042,'Mosharof Vai','Senpara Parbota, Mirpur 13, Dhaka','','','8801759998877','','','',0.00,10600.00,'\r',NULL,NULL),(1000043,'Nahid ','','','','8801911680690','','','',0.00,1500.00,'Thai Mistry\r',NULL,NULL),(1000044,'Nasif ','Senpara Parbota, Mirpur 13, Dhaka','','','8801933334443','','','',0.00,67400.00,'BJ Auto Solution\r',NULL,NULL),(1000045,'Nazrul Vai ','Mirpur 1, Dhaka','','','8801711277423','','','',0.00,21000.00,'Senpara land office\r',NULL,NULL),(1000046,'Dulal Bhai ','Sobhanbagh, Dhaka','','','','','','',0.00,25000.00,'OC Mohamedpur Thana\r',NULL,NULL),(1000047,'Pantho Engineering','Ibrahimpur, Dhaka','','','8801817140240','','','',0.00,186520.00,'Alam Shaheb\r',NULL,NULL),(1000048,'EQMS','Banani Dhaka','','','','','','',0.00,66000.00,'Palash Mama\r',NULL,NULL),(1000049,'Police Kallayan Trust','Gulshan 1, Dhaka','','','','','','',0.00,125550.00,'\r',NULL,NULL),(1000050,'Ponno Bd Electronics','Shewrapara, Dhaka','','','8801856111313','','','',0.00,0.00,'\r',NULL,NULL),(1000051,'Rafiq','Mirpur 10, Dhaka','','','','','','',0.00,19600.00,'Curtain Shop Manager\r',NULL,NULL),(1000052,'Runner Automobiles Limited','Tejgaon, Dhaka','','','','','','',0.00,77000.00,'\r',NULL,NULL),(1000053,'Rakib ','Senpara, Mirpur 13, Dhaka','','','8801621143058','','','',0.00,25000.00,'Mahedi Ref\r',NULL,NULL),(1000054,'Redwan Bhai','Khulna','','','8801911185115','','','',0.00,5600.00,'Khulna\r',NULL,NULL),(1000055,'Riaz','','','','8801711100115','','','',0.00,2975.00,'Marketing\r',NULL,NULL),(1000056,'Rifat Khan','','','','','','','',0.00,23000.00,'Pervez Sir Reference\r',NULL,NULL),(1000057,'Rocky Bhai','','','','8801713243404','','','',0.00,42500.00,'Mentors \r',NULL,NULL),(1000058,'Rupa Apa','','','','8801711464325','','','',0.00,7000.00,'\r',NULL,NULL),(1000059,'Rumi','','','','','','','',0.00,6500.00,'Mony Vai\r',NULL,NULL),(1000060,'Shagor Bhai','','','','8801715122987','','','',0.00,10000.00,'\r',NULL,NULL),(1000061,'Sayeed Bhai','','','','8801779669988','','','',0.00,9465.00,'Innovative Technologies\r',NULL,NULL),(1000062,'Shamim Bhai','','','','8801712377009','','','',0.00,10000.00,'Anwar Ref Police\r',NULL,NULL),(1000063,'Shamim Engineering ','','','','','','','',0.00,2500.00,'Riaz Bhai\r',NULL,NULL),(1000064,'Shahin Bhai','','','','','','','',0.00,50000.00,'London\r',NULL,NULL),(1000065,'Shohel Bhai','','','','','','','',0.00,11000.00,'Bank Contractor\r',NULL,NULL),(1000066,'Sahana Enterprise','Mohammadpur, Dhaka','','','','','','',0.00,216300.00,'Asif Ref.\r',NULL,NULL),(1000067,'Shanto ','Ibrahimpur, Dhaka','','','8801709998108','','','',0.00,35850.00,'Asif Ref.\r',NULL,NULL),(1000068,'Shibly','','','','','','','',0.00,60800.00,'Rajshahi\r',NULL,NULL),(1000069,'Shohan','','','','8801798621282','','','',0.00,1000.00,'Atik Ref\r',NULL,NULL),(1000070,'Shobuz ','Shewrapara, Dhaka','','','8801317055454','','','',0.00,35530.00,'Pickup Driver\r',NULL,NULL),(1000071,'Shohag Bhai','Darsana, Chuadanga','','','','','','',0.00,2000.00,'Darsana\r',NULL,NULL),(1000072,'Shorif Bhai','','','','8801713243408','','','',0.00,5000.00,'Mentors Kalabagan\r',NULL,NULL),(1000073,'Sofiullah','','','','','','','',0.00,66500.00,'Exen Dcc - Asif Ref.\r',NULL,NULL),(1000074,'Soma Apa','Ibrahimpur, Dhaka','','','8801716856101','','','',0.00,35000.00,'\r',NULL,NULL),(1000075,'Sony','364, Senpara Parbota, Mirpur 10, Dhaka','','','','','','',0.00,17100.00,'Shahed Ref.\r',NULL,NULL),(1000076,'Sony Apa','Senpara, Mirpur 13, Dhaka','','','8801711196727','','','',0.00,175000.00,'\r',NULL,NULL),(1000077,'Sumon','','','','8801676031745','','','',0.00,34000.00,' Mahedi Ref\r',NULL,NULL),(1000078,'Tawfique Bhai','Mirpur Dhaka','','','','','','',0.00,66700.00,'\r',NULL,NULL),(1000079,'Nahid Bhabi','364, Senpara Parbota, Mirpur 10, Dhaka','','','8801712113148','','','',0.00,45000.00,'364, Senpara\r',NULL,NULL),(1000080,'Zamal Bhai','','','','8801915620780','','','',0.00,43000.00,'\r',NULL,NULL),(1000081,'Kazi Mizanur Rahman','Mirpur 10, Dhaka','','','8801613550831','','','',0.00,-12835.00,'\r',NULL,NULL),(1000082,'Nayan Bhai ','Mirpur 10, Dhaka','','','8801711030469','','','',0.00,-38700.00,'Sony Showroom\r',NULL,NULL),(1000083,'Noor Trade Electronics','Bangabandhu National Stadium','','','','','','',0.00,1553600.00,'\r',NULL,NULL),(1000084,'Shamsul Alam','Chuadanga','','','8801789505499','','','',0.00,-35000.00,'\r',NULL,NULL),(1000085,'Zabir Mistri','Senpara Parbota, Mirpur 10, Dhaka','','','8801918538178','','','',0.00,-14439.00,'\r',NULL,NULL),(1000086,'Angle Shop','Mirpur 10, Dhaka','','','8801735733049','','','',0.00,-8140.00,'Kausar \r',NULL,NULL),(1000087,'Bhai Bhai Electronics','Darsana, Chuadanga','','','8801914120894','','','',0.00,-80000.00,NULL,NULL,NULL);

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `employees` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_09_03_181858_create_sales_table',1),(5,'2020_09_03_185645_create_purchase_cart_details_table',1),(6,'2020_09_03_185714_create_sales_cart_details_table',1),(7,'2020_09_10_161252_create_roles_table',1),(8,'2020_09_10_161538_create_permissions_table',1),(9,'2020_09_10_161624_create_role_user_table',1),(10,'2020_09_12_141405_create_employees_table',1),(11,'2020_09_12_141536_create_customers_table',1),(12,'2020_09_12_141648_create_products_table',1),(13,'2020_09_12_141734_create_suppliers_table',1),(14,'2020_09_12_141829_create_purchases_table',1),(15,'2020_09_12_141920_create_transactions_table',1),(16,'2020_09_12_141958_create_transaction_types_table',1),(17,'2020_09_13_102500_create_accounts_table',1),(18,'2020_09_24_145100_create_categories_table',1),(19,'2020_09_24_150022_create_brands_table',1),(20,'2020_09_30_133758_create_account_types_table',1),(21,'2020_10_04_144024_create_officals_table',1),(22,'2020_10_04_172634_create_officials_table',1),(23,'2021_01_15_122705_create_official_types_table',2);

/*Table structure for table `official_types` */

DROP TABLE IF EXISTS `official_types`;

CREATE TABLE `official_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `official_types` */

insert  into `official_types`(`id`,`name`,`created_at`,`updated_at`) values (1,'Capital','2021-01-20 07:50:26','2021-01-20 07:50:26'),(2,'SHARMISTA KURI','2021-01-20 08:22:51','2021-01-21 05:29:14'),(3,'SHARMISTA KURI','2021-01-20 08:23:37','2021-01-20 08:23:37');

/*Table structure for table `officials` */

DROP TABLE IF EXISTS `officials`;

CREATE TABLE `officials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(16,2) DEFAULT NULL,
  `official_type_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000002 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `officials` */

insert  into `officials`(`id`,`name`,`amount`,`official_type_id`,`description`,`created_at`,`updated_at`) values (1000000,'Kuri',1000.00,1,NULL,NULL,'2021-01-21 05:16:02'),(1000001,'SHARMISTA KURI',NULL,1,NULL,'2021-01-20 08:25:10','2021-01-20 08:25:10');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_role` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */


/*Table structure for table `purchase_cart_details` */

DROP TABLE IF EXISTS `purchase_cart_details`;

CREATE TABLE `purchase_cart_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` double(16,2) NOT NULL,
  `amount` double(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `purchase_cart_details` */

insert  into `purchase_cart_details`(`id`,`purchase_id`,`product_id`,`quantity`,`rate`,`amount`,`created_at`,`updated_at`) values (1,1,1000000,2,10000.00,20000.00,'2020-12-11 16:13:07','2020-12-11 16:13:07'),(2,2,1000000,2,20000.00,40000.00,'2020-12-13 04:30:10','2020-12-13 04:30:10');

/*Table structure for table `purchases` */

DROP TABLE IF EXISTS `purchases`;

CREATE TABLE `purchases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_type` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `subtotal` double(16,2) NOT NULL,
  `vat` double(16,2) DEFAULT NULL,
  `transport_labour` double(16,2) DEFAULT NULL,
  `discount` double(16,2) DEFAULT NULL,
  `total` double(16,2) NOT NULL,
  `paid` double(16,2) NOT NULL,
  `due` double(16,2) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `purchases` */

insert  into `purchases`(`id`,`invoice_no`,`employee_id`,`purchase_date`,`purchase_type`,`supplier_id`,`subtotal`,`vat`,`transport_labour`,`discount`,`total`,`paid`,`due`,`remarks`,`created_at`,`updated_at`) values (1,'SI-2020-12-11-1',9,'2020-12-11',1,1000000,20000.00,0.00,0.00,0.00,20000.00,20000.00,0.00,NULL,'2020-12-11 16:13:07','2020-12-11 16:13:07'),(2,'SI-2020-12-13-2',9,'2020-12-13',1,1000000,40000.00,0.00,0.00,0.00,40000.00,40000.00,0.00,NULL,'2020-12-13 04:30:10','2020-12-13 04:30:10');

/*Table structure for table `ref_role` */

DROP TABLE IF EXISTS `ref_role`;

CREATE TABLE `ref_role` (
  `id` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `ref_role` */

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_user` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

/*Table structure for table `sales` */

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` int(11) NOT NULL,
  `sale_date` date NOT NULL,
  `sale_type` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `subtotal` double(16,2) NOT NULL,
  `vat` double(16,2) DEFAULT NULL,
  `transport_labour` double(16,2) DEFAULT NULL,
  `discount` double(16,2) DEFAULT NULL,
  `total` double(16,2) NOT NULL,
  `paid` double(16,2) NOT NULL,
  `due` double(16,2) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sales` */

insert  into `sales`(`id`,`invoice_no`,`employee_id`,`sale_date`,`sale_type`,`customer_id`,`subtotal`,`vat`,`transport_labour`,`discount`,`total`,`paid`,`due`,`remarks`,`created_at`,`updated_at`) values (1,'SI-2020-12-11-1',9,'2020-12-11',1,1000000,20000.00,0.00,0.00,0.00,20000.00,20000.00,0.00,NULL,'2020-12-11 16:26:55','2020-12-11 16:26:55'),(2,'SI-2021-01-11-2',8,'2021-01-11',1,1000067,1000.00,NULL,0.00,10.00,990.00,100.00,990.00,NULL,'2021-01-11 07:07:59','2021-01-11 07:07:59'),(7,'SI-2021-01-12-4',8,'2021-01-12',1,1000067,5000.00,500.00,0.00,100.00,5400.00,0.00,5400.00,NULL,'2021-01-12 06:39:26','2021-01-12 06:39:26'),(8,'SI-2021-01-12-8',8,'2021-01-12',1,1000067,2000.00,0.00,0.00,0.00,2000.00,0.00,2000.00,NULL,'2021-01-12 07:32:37','2021-01-12 07:32:37'),(9,'SI-2021-01-13-9',8,'2021-01-13',1,1000067,20000.00,2000.00,0.00,200.00,21800.00,0.00,21800.00,NULL,'2021-01-13 05:40:58','2021-01-13 05:40:58');

/*Table structure for table `sales_cart_details` */

DROP TABLE IF EXISTS `sales_cart_details`;

CREATE TABLE `sales_cart_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sales_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` double(16,2) NOT NULL,
  `amount` double(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sales_cart_details` */

insert  into `sales_cart_details`(`id`,`sales_id`,`product_id`,`quantity`,`rate`,`amount`,`created_at`,`updated_at`) values (1,1,1000000,2,10000.00,20000.00,'2020-12-11 16:26:55','2020-12-11 16:26:55'),(4,4,1000001,1,1000.00,1000.00,'2021-01-12 05:26:20','2021-01-12 05:26:20'),(5,5,1000001,1,10000.00,10000.00,'2021-01-12 05:28:53','2021-01-12 05:28:53'),(6,6,1000002,1,9999.00,9999.00,'2021-01-12 05:30:24','2021-01-12 05:30:24'),(9,9,1000003,2,10000.00,20000.00,'2021-01-13 05:40:58','2021-01-13 05:40:58');

/*Table structure for table `suppliers` */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid` double(16,2) DEFAULT NULL,
  `due` double(16,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000001 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `suppliers` */

insert  into `suppliers`(`id`,`name`,`address`,`area`,`country`,`primary_contact`,`secondary_contact`,`email`,`supplier_type`,`paid`,`due`,`created_at`,`updated_at`) values (1000000,'Sharmista Kuri',NULL,NULL,'Bangladesh',NULL,NULL,NULL,'1,2',NULL,NULL,'2020-12-11 16:12:43','2021-01-13 06:42:34');

/*Table structure for table `transaction_types` */

DROP TABLE IF EXISTS `transaction_types`;

CREATE TABLE `transaction_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaction_types` */

insert  into `transaction_types`(`id`,`name`,`created_at`,`updated_at`) values (1,'Cash Receive',NULL,NULL),(2,'Cash Out',NULL,NULL);

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `transaction_type_id` int(11) NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `sales_purchase_id` int(11) DEFAULT 0,
  `official_type_id` int(11) DEFAULT 0,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1000013 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`date`,`transaction_type_id`,`account_type_id`,`account_id`,`sales_purchase_id`,`official_type_id`,`description`,`amount`,`created_at`,`updated_at`) values (1000000,'2020-12-11',2,2,1000000,0,0,NULL,20000.00,'2020-12-11 16:13:07','2020-12-11 16:13:07'),(1000001,'2020-12-11',1,1,1000000,0,0,NULL,20000.00,'2020-12-11 16:26:55','2020-12-11 16:26:55'),(1000002,'2020-12-13',2,2,1000000,0,0,NULL,40000.00,'2020-12-13 04:30:11','2020-12-13 04:30:11'),(1000003,'2021-01-11',1,1,1000067,0,0,NULL,100.00,'2021-01-11 07:07:59','2021-01-11 07:07:59'),(1000004,'2021-01-11',1,1,1000067,0,0,NULL,1000.00,'2021-01-11 08:42:05','2021-01-11 08:42:05'),(1000005,'2021-01-12',1,1,1000067,0,0,NULL,0.00,'2021-01-12 05:26:21','2021-01-12 05:26:21'),(1000006,'2021-01-12',1,1,1000067,0,0,NULL,0.00,'2021-01-12 05:28:53','2021-01-12 05:28:53'),(1000007,'2021-01-12',1,1,1000003,0,0,NULL,0.00,'2021-01-12 05:30:24','2021-01-12 05:30:24'),(1000008,'2021-01-12',1,1,1000067,0,0,NULL,0.00,'2021-01-12 06:39:26','2021-01-12 06:39:26'),(1000009,'2021-01-12',1,1,1000067,0,0,NULL,0.00,'2021-01-12 07:32:37','2021-01-12 07:32:37'),(1000010,'2021-01-13',1,1,1000067,0,0,NULL,0.00,'2021-01-13 05:40:58','2021-01-13 05:40:58'),(1000011,'2021-01-17',1,3,1000000,0,0,'why',1000.00,'2021-01-17 15:50:13','2021-01-17 15:50:13'),(1000012,'2021-01-17',1,3,1000000,0,1,'why',1000.00,'2021-01-17 15:55:10','2021-01-17 15:55:10');


/*Table structure for table `usr_activities` */

DROP TABLE IF EXISTS `usr_activities`;

CREATE TABLE `usr_activities` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `usr_activities` */

insert  into `usr_activities`(`id`,`name`) values (1,'Add'),(2,'Edit'),(3,'Delete'),(4,'Set Right'),(5,'Reset Password'),(6,'Change Password'),(7,'Deactivate'),(8,'Activate'),(9,'Wrong Password Lock'),(10,'Unlock Wrong Password Lock'),(11,'Password Validity Period update '),(12,'Default Password Update'),(13,'Password Length Update'),(14,'Global Idle Time Update'),(15,'Individual Idle Time Update'),(16,'IP Mapping Update (Location)'),(17,'User ID Length Update'),(18,'Send Request'),(19,'Verify'),(20,'Approval'),(21,'Cancel'),(22,'Mapping Data'),(23,'Lock'),(24,'Unlock'),(25,'Maintenance'),(26,'Change');

/*Table structure for table `usr_activities_histry` */

DROP TABLE IF EXISTS `usr_activities_histry`;

CREATE TABLE `usr_activities_histry` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Activities_Id` int(5) NOT NULL,
  `Activities_by` int(11) NOT NULL,
  `Activities_dt` datetime NOT NULL,
  `IP` varchar(20) DEFAULT NULL,
  `Operate_Id` varchar(20) NOT NULL,
  `table_name` varchar(150) NOT NULL,
  `Description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `usr_activities_histry` */

insert  into `usr_activities_histry`(`id`,`Activities_Id`,`Activities_by`,`Activities_dt`,`IP`,`Operate_Id`,`table_name`,`Description`) values (1,1,8,'2021-01-12 06:39:27','::1','7','sales','Product Philips-Pink-HP8108 is sold to customer Shanto '),(2,3,8,'2021-01-12 06:53:26','::1','3','sales','Sales Deleted'),(3,3,8,'2021-01-12 07:01:42','::1','2','sales','Sales Deleted'),(4,1,8,'2021-01-12 07:32:37','::1','8','sales','Product Philips-Pink-HP8108 is sold to customer Shanto '),(5,3,8,'2021-01-12 07:33:45','::1','8','sales','Sales Deleted'),(6,1,8,'2021-01-13 05:40:58','::1','9','sales','Product Winstar-RH04 is sold to customer Shanto '),(7,1,8,'2021-01-17 15:55:10','::1','1000012','transactions','Transaction added '),(8,1,8,'2021-01-20 08:25:10','::1','1000001','official_types','Official Type Added'),(9,2,8,'2021-01-21 05:16:02','::1','1000000','officials','Official Updated'),(10,2,8,'2021-01-21 05:27:41','::1','2','official_types','Official Type Updated'),(11,2,8,'2021-01-21 05:29:14','::1','2','official_types','Official Type Updated');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
