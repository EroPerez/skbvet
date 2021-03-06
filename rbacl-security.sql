/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'latin1' */;

SET FOREIGN_KEY_CHECKS=0;

/* Dropping database objects */

DROP TABLE IF EXISTS `roles_acl_users`;
DROP TABLE IF EXISTS `permission_roles`;
DROP TABLE IF EXISTS `roles`;
DROP TABLE IF EXISTS `permissions`;
DROP TABLE IF EXISTS `acl_users`;

/* Structure for the `acl_users` table : */

CREATE TABLE `acl_users` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) COLLATE latin1_swedish_ci DEFAULT NULL,
  `username` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT NULL,
  `password` VARCHAR(255) COLLATE latin1_swedish_ci DEFAULT NULL,
  `code` VARCHAR(6) COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=10 ROW_FORMAT=DYNAMIC CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `permissions` table : */

CREATE TABLE `permissions` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT NULL,
  `display_name` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` TINYTEXT COLLATE latin1_swedish_ci,
  `status` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE KEY `name` USING BTREE (`name`)
) ENGINE=InnoDB
AUTO_INCREMENT=133 ROW_FORMAT=DYNAMIC CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `roles` table : */

CREATE TABLE `roles` (
  `id` INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(200) COLLATE latin1_swedish_ci NOT NULL,
  `display_name` VARCHAR(30) COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` VARCHAR(500) COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`),
  UNIQUE KEY `UK_user_roles_role_Name` USING BTREE (`name`)
) ENGINE=InnoDB
CHECKSUM=1 DELAY_KEY_WRITE=1 AUTO_INCREMENT=6 ROW_FORMAT=DYNAMIC CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `permission_roles` table : */

CREATE TABLE `permission_roles` (
  `role_id` INTEGER(11) UNSIGNED NOT NULL,
  `permission_id` INTEGER(11) NOT NULL,
  `priority` INTEGER(11) GENERATED ALWAYS AS (`permission_id`) STORED,
  PRIMARY KEY USING BTREE (`role_id`, `permission_id`),
  KEY `permission_roles_fk1` USING BTREE (`permission_id`),
  CONSTRAINT `permission_roles_fk1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_roles_fk2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `roles_acl_users` table : */

CREATE TABLE `roles_acl_users` (
  `user_id` INTEGER(11) NOT NULL,
  `role_id` INTEGER(11) UNSIGNED NOT NULL,
  PRIMARY KEY USING BTREE (`user_id`, `role_id`),
  KEY `roles_acl_users_fk2` USING BTREE (`role_id`),
  CONSTRAINT `roles_acl_users_fk1` FOREIGN KEY (`user_id`) REFERENCES `acl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `roles_acl_users_fk2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB
ROW_FORMAT=DYNAMIC CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Data for the `acl_users` table  (LIMIT 0,500) */

INSERT INTO `acl_users` (`id`, `name`, `username`, `password`, `code`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1,'Super Administrator','admin','$2y$10$hDri6v4SbLM/aedVwwL5m.YK8u4aufHes8Zroac4TePsTD0Yu9JCa','',1,NULL,NULL,NULL),
  (7,'Dr. Valia','valia','$2y$10$KAgtbtHPXDDxpUnCBev7qukuorECvmpeoX9o3ZbcIhu1WaG6HpWEe',NULL,1,NULL,NULL,NULL),
  (8,'Skylab','skylab','$2y$10$jxWfMxUOCrizZB5kb663pebU8ZMyQkXIDZ08zN1UzwdekrfyQKmyG',NULL,1,NULL,NULL,NULL);
COMMIT;

/* Data for the `permissions` table  (LIMIT 0,500) */

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (3,'index-users','Allow list all users',NULL,1,'2019-09-29 23:40:58',NULL,NULL),
  (4,'add-users','Allow add user',NULL,1,'2019-09-29 23:45:26',NULL,NULL),
  (5,'edit-users','Allow edit user',NULL,1,'2019-09-29 23:45:26',NULL,NULL),
  (6,'read-users','Allow view user',NULL,1,'2019-09-29 23:45:26',NULL,NULL),
  (7,'list-users','Allow back to list of users',NULL,1,'2019-09-29 23:50:23',NULL,NULL),
  (8,'delete-users','Allow delete users',NULL,1,'2019-09-29 23:50:23',NULL,NULL),
  (9,'ajax_list-users','Allow refresh the list of users',NULL,1,'2019-09-29 23:50:23',NULL,NULL),
  (10,'insert_validation-users','Allow validate insertions of users',NULL,1,'2019-09-30 00:01:40',NULL,NULL),
  (11,'success-users','Allow reponse successfully before insert or update an user',NULL,1,'2019-09-30 00:01:40',NULL,NULL),
  (12,'insert-users','Allow insert user',NULL,1,'2019-09-30 00:05:02',NULL,NULL),
  (13,'update-users','Allow update user',NULL,1,'2019-09-30 00:08:43',NULL,NULL),
  (14,'update_validation-users','Allow update validation user',NULL,1,'2019-09-30 00:08:44',NULL,NULL),
  (15,'export-users','Allow export users',NULL,1,'2019-09-30 00:18:42',NULL,NULL),
  (16,'ajax_list_info-users','Allow ajax list info users',NULL,1,'2019-09-30 00:32:31',NULL,NULL),
  (17,'ajax_relation_n_n-users','Allow many to many relation between users and roles',NULL,1,'2019-09-30 00:32:31',NULL,NULL),
  (18,'index-permissions','Allow list all roles and permissions',NULL,1,'2019-09-30 00:57:21',NULL,NULL),
  (21,'edit-permissions','Allow edit  role and permissions',NULL,1,'2019-09-30 01:50:28',NULL,NULL),
  (22,'delete-permissions','Allow delete role and permissions',NULL,1,'2019-09-30 01:50:28',NULL,NULL),
  (23,'read-permissions','Allow view role and permissions',NULL,1,'2019-09-30 01:50:28',NULL,NULL),
  (24,'clone-permissions','Allow clone role and permissions',NULL,1,'2019-09-30 01:50:28',NULL,NULL),
  (25,'list-permissions','Allow back to list of role and permissions',NULL,1,'2019-09-30 01:50:28',NULL,NULL),
  (26,'ajax_list-permissions','Allow refresh role and permissions',NULL,1,'2019-09-30 01:50:28',NULL,NULL),
  (27,'insert_validation-permissions','Allow insert validation of role and permissions',NULL,1,'2019-09-30 01:50:29',NULL,NULL),
  (28,'insert-permissions','Allow  insert role and permissions',NULL,1,'2019-09-30 01:50:29',NULL,NULL),
  (29,'update_validation-permissions','Allow update validation of role and permissions',NULL,1,'2019-09-30 01:50:29',NULL,NULL),
  (30,'update-permissions','Allow update of role and permissions',NULL,1,'2019-09-30 01:50:29',NULL,NULL),
  (31,'success-permissions','Allow reponse successfully before insert or update role and permissions',NULL,1,'2019-09-30 01:50:29',NULL,NULL),
  (32,'export-permissions','Allow export roles',NULL,1,'2019-09-30 01:50:29',NULL,NULL),
  (33,'ajax_list_info-permissions','Allow ajax list info of role and permissions',NULL,1,'2019-09-30 01:54:08',NULL,NULL),
  (34,'ajax_relation_n_n-permissions','Allow many to many relation between role and permissions',NULL,1,'2019-09-30 01:54:08',NULL,NULL),
  (35,'index-farm','Allow list all farm',NULL,1,'2019-09-30 11:33:11',NULL,NULL),
  (36,'add-farm','Allow add farm and farmers',NULL,1,'2019-09-30 11:33:12',NULL,NULL),
  (37,'list-farm','Allow  back to list of farm',NULL,1,'2019-09-30 11:36:11',NULL,NULL),
  (38,'delete-farm','Allow delete farm',NULL,1,'2019-09-30 11:36:11',NULL,NULL),
  (39,'ajax_list-farm','Allow refresh the list of farm',NULL,1,'2019-09-30 11:36:11',NULL,NULL),
  (40,'export-farm','Allow export farm data',NULL,1,'2019-09-30 11:40:19',NULL,NULL),
  (41,'farmers-farm','Allow edit or view farm and farmers',NULL,1,'2019-09-30 11:40:19',NULL,NULL),
  (56,'Farm-farm','Allow get ajax content of farm and farmers',NULL,1,'2019-09-30 12:25:07',NULL,NULL),
  (57,'index-transfer','Allow list all transfer sale',NULL,1,'2019-09-30 12:57:30',NULL,NULL),
  (58,'list-transfer','Allow back to list of transfer sale',NULL,1,'2019-09-30 12:59:11',NULL,NULL),
  (59,'ajax_list-transfer','Allow refresh the list of transfer sale',NULL,1,'2019-09-30 12:59:11',NULL,NULL),
  (60,'export-transfer','Allow export transfer sale data',NULL,1,'2019-09-30 13:00:18',NULL,NULL),
  (61,'delete-transfer','Allow delete transfer sale',NULL,1,'2019-09-30 13:01:04',NULL,NULL),
  (62,'add-transfer','Allow add new transfer sale',NULL,1,'2019-09-30 13:01:41',NULL,NULL),
  (63,'Transfer-transfer','Allow get ajax content from transfer sale',NULL,1,'2019-09-30 13:10:18',NULL,NULL),
  (64,'index-illness','Allow list all case information',NULL,1,'2019-09-30 13:31:47',NULL,NULL),
  (65,'delete-illness','Allow delete case information',NULL,1,'2019-09-30 13:31:47',NULL,NULL),
  (66,'list-illness','Allow back to list of case information',NULL,1,'2019-09-30 13:31:47',NULL,NULL),
  (67,'ajax_list-illness','Allow refresh the list of case information',NULL,1,'2019-09-30 13:34:55',NULL,NULL),
  (68,'export-illness','Allow export case information data',NULL,1,'2019-09-30 13:34:55',NULL,NULL),
  (69,'add-illness','Allow add case information',NULL,1,'2019-09-30 13:40:44',NULL,NULL),
  (70,'case-illness','Allow edit or view case information',NULL,1,'2019-09-30 13:40:44',NULL,NULL),
  (71,'Illness-illness','Allow get ajax content of case information',NULL,1,'2019-09-30 13:43:34',NULL,NULL),
  (72,'index-comimp','Allow list all commodity import licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (73,'list-comimp','Allow back to  list of all commodity import licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (74,'add-comimp','Allow add a commodity import licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (75,'delete-comimp','Allow delete a commodity import licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (76,'ajax_list-comimp','Allow refresh the list of commodity import licences',NULL,1,'2019-09-30 14:10:27',NULL,NULL),
  (77,'export-comimp','Allow export the list of commodity import licences',NULL,1,'2019-09-30 14:10:27',NULL,NULL),
  (78,'licence-comimp','Allow edit or view a commodity import licences',NULL,1,'2019-09-30 14:11:25',NULL,NULL),
  (79,'Comimp-comimp','Allow get ajax content from a commodity import licences',NULL,1,'2019-09-30 14:12:22',NULL,NULL),
  (80,'index-comexp','Allow list all commodity export licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (81,'list-comexp','Allow back to  list of all commodity export licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (82,'add-comexp','Allow add a commodity export licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (83,'delete-comexp','Allow delete a commodity export licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (84,'ajax_list-comexp','Allow refresh the list of commodity export licences',NULL,1,'2019-09-30 14:10:27',NULL,NULL),
  (85,'export-comexp','Allow export the list of commodity export licences',NULL,1,'2019-09-30 14:10:27',NULL,NULL),
  (86,'licence-comexp','Allow edit or view a commodity export licences',NULL,1,'2019-09-30 14:11:25',NULL,NULL),
  (87,'Comexp-comexp','Allow get ajax content from a commodity export licences',NULL,1,'2019-09-30 14:12:22',NULL,NULL),
  (88,'index-animalimp','Allow list all live animals import licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (89,'list-animalimp','Allow back to  list of all live animals import licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (90,'add-animalimp','Allow add a live animals import licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (91,'delete-animalimp','Allow delete a live animals import licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (92,'ajax_list-animalimp','Allow refresh the list of live animals import licences',NULL,1,'2019-09-30 14:10:27',NULL,NULL),
  (93,'export-animalimp','Allow export the list of live animals import licences',NULL,1,'2019-09-30 14:10:27',NULL,NULL),
  (94,'licence-animalimp','Allow edit or view a live animals import licences',NULL,1,'2019-09-30 14:11:25',NULL,NULL),
  (95,'Animalimp-animalimp','Allow get ajax content from a live animals import licences',NULL,1,'2019-09-30 14:12:22',NULL,NULL),
  (96,'index-animalexp','Allow list all live animals export licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (97,'list-animalexp','Allow back to  list of all live animals export licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (98,'add-animalexp','Allow add a live animals export licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (99,'delete-animalexp','Allow delete a live animals export licences',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (100,'ajax_list-animalexp','Allow refresh the list of live animals export licences',NULL,1,'2019-09-30 14:10:27',NULL,NULL),
  (101,'export-animalexp','Allow export the list of live animals export licences',NULL,1,'2019-09-30 14:10:27',NULL,NULL),
  (102,'licence-animalexp','Allow edit or view a live animals export licences',NULL,1,'2019-09-30 14:11:25',NULL,NULL),
  (103,'Animalexp-animalexp','Allow get ajax content from a live animals export licences',NULL,1,'2019-09-30 14:12:22',NULL,NULL),
  (104,'index-specimen','Allow list all specimen permits',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (105,'list-specimen','Allow back to list of all specimen permits',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (106,'add-specimen','Allow add a specimen permits',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (107,'delete-specimen','Allow delete a specimen permits',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (108,'ajax_list-specimen','Allow refresh the list of specimen permits',NULL,1,'2019-09-30 14:10:27',NULL,NULL),
  (109,'export-specimen','Allow export the list of specimen permits',NULL,1,'2019-09-30 14:10:27',NULL,NULL),
  (110,'permit-specimen','Allow edit or view a specimen permits',NULL,1,'2019-09-30 14:11:25',NULL,NULL),
  (111,'Specimen_Permit-specimen','Allow get ajax content from a specimen permits',NULL,1,'2019-09-30 14:12:22',NULL,NULL),
  (112,'index-surveillance','Allow list all surveillance data',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (113,'list-surveillance','Allow back to list of all surveillance data',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (114,'add-surveillance','Allow add a surveillance data',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (115,'delete-surveillance','Allow delete a surveillance data',NULL,1,'2019-09-30 14:05:04',NULL,NULL),
  (116,'ajax_list-surveillance','Allow refresh the list of surveillance data',NULL,1,'2019-09-30 14:10:27',NULL,NULL),
  (117,'export-surveillance','Allow export the list of surveillance data',NULL,1,'2019-09-30 14:10:27',NULL,NULL),
  (118,'data-surveillance','Allow edit or view a surveillance data',NULL,1,'2019-09-30 14:11:25',NULL,NULL),
  (119,'Surveillance-surveillance','Allow get ajax content from a surveillance data',NULL,1,'2019-09-30 14:12:22',NULL,NULL),
  (120,'import-licences-report','Allow view meats import licences report',NULL,1,'2019-09-30 15:48:51',NULL,NULL),
  (122,'animal-imported-report','Allow view animal import licences report',NULL,1,'2019-09-30 15:53:48',NULL,NULL),
  (123,'export-animals-report','Allow view animal export licences report',NULL,1,'2019-09-30 16:00:21',NULL,NULL),
  (124,'export-meats-report','Allow view meats export licences report',NULL,1,'2019-09-30 16:08:05',NULL,NULL),
  (125,'animal-illness-cases-report','Allow view  animals illness cases report',NULL,1,'2019-09-30 16:12:44',NULL,NULL),
  (126,'withdrawal-period-report','Allow view withdrawal period report',NULL,1,'2019-09-30 16:15:17',NULL,NULL),
  (127,'number-of-biological-report','Allow view specimen permit issued report',NULL,1,'2019-09-30 16:17:14',NULL,NULL),
  (128,'surveillance-report','Allow view surveillance report',NULL,1,'2019-09-30 16:19:14',NULL,NULL),
  (129,'index-dashboard','Allow view dashboard',NULL,1,'2019-09-30 16:21:57',NULL,NULL),
  (130,'index-setup','Allow setup codifier','Allow add,edit, delete: Commodity, Country, Illneses, Species, Traders, Treatments, Tests, Units, Vets, Districts',1,'2019-09-30 16:36:35',NULL,NULL),
  (131,'Setup-setup','Allow get ajax content in setup codifier',NULL,1,'2019-09-30 16:36:28',NULL,NULL),
  (132,'add-permissions','Allow add new role and permitions',NULL,1,'2019-09-30 17:46:50',NULL,NULL);
COMMIT;

/* Data for the `roles` table  (LIMIT 0,500) */

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1,'admin','Administrator','Administrator have full access over the system.',1,NULL,NULL,NULL),
  (2,'licences','Licences','Licences can manage only commodity and livestock licences and view its report.',0,'2019-09-29 14:31:39',NULL,NULL),
  (3,'veterinarian','Veterinarian','Veterinarian have full access over the system functionality but can not create other user or grant new user permissions.',1,'2019-09-29 14:34:58',NULL,NULL),
  (5,'farmer','Farmer','Farmer can manage farm and farmers information',1,NULL,NULL,NULL);
COMMIT;

/* Data for the `permission_roles` table  (LIMIT 0,500) */

INSERT INTO `permission_roles` (`role_id`, `permission_id`, `priority`) VALUES
  (1,3,3),
  (1,4,4),
  (1,5,5),
  (1,6,6),
  (1,7,7),
  (1,8,8),
  (1,9,9),
  (1,10,10),
  (1,11,11),
  (1,12,12),
  (1,13,13),
  (1,14,14),
  (1,15,15),
  (1,16,16),
  (1,17,17),
  (1,18,18),
  (1,21,21),
  (1,22,22),
  (1,23,23),
  (1,24,24),
  (1,25,25),
  (1,26,26),
  (1,27,27),
  (1,28,28),
  (1,29,29),
  (1,30,30),
  (1,31,31),
  (1,32,32),
  (1,33,33),
  (1,34,34),
  (1,35,35),
  (1,36,36),
  (1,37,37),
  (1,38,38),
  (1,39,39),
  (1,40,40),
  (1,41,41),
  (1,56,56),
  (1,57,57),
  (1,58,58),
  (1,59,59),
  (1,60,60),
  (1,61,61),
  (1,62,62),
  (1,63,63),
  (1,64,64),
  (1,65,65),
  (1,66,66),
  (1,67,67),
  (1,68,68),
  (1,69,69),
  (1,70,70),
  (1,71,71),
  (1,72,72),
  (1,73,73),
  (1,74,74),
  (1,75,75),
  (1,76,76),
  (1,77,77),
  (1,78,78),
  (1,79,79),
  (1,80,80),
  (1,81,81),
  (1,82,82),
  (1,83,83),
  (1,84,84),
  (1,85,85),
  (1,86,86),
  (1,87,87),
  (1,88,88),
  (1,89,89),
  (1,90,90),
  (1,91,91),
  (1,92,92),
  (1,93,93),
  (1,94,94),
  (1,95,95),
  (1,96,96),
  (1,97,97),
  (1,98,98),
  (1,99,99),
  (1,100,100),
  (1,101,101),
  (1,102,102),
  (1,103,103),
  (1,104,104),
  (1,105,105),
  (1,106,106),
  (1,107,107),
  (1,108,108),
  (1,109,109),
  (1,110,110),
  (1,111,111),
  (1,112,112),
  (1,113,113),
  (1,114,114),
  (1,115,115),
  (1,116,116),
  (1,117,117),
  (1,118,118),
  (1,119,119),
  (1,120,120),
  (1,122,122),
  (1,123,123),
  (1,124,124),
  (1,125,125),
  (1,126,126),
  (1,127,127),
  (1,128,128),
  (1,129,129),
  (1,130,130),
  (1,131,131),
  (1,132,132),
  (2,72,72),
  (2,73,73),
  (2,74,74),
  (2,75,75),
  (2,76,76),
  (2,77,77),
  (2,78,78),
  (2,79,79),
  (2,80,80),
  (2,81,81),
  (2,82,82),
  (2,83,83),
  (2,84,84),
  (2,85,85),
  (2,86,86),
  (2,87,87),
  (2,88,88),
  (2,89,89),
  (2,90,90),
  (2,91,91),
  (2,92,92),
  (2,93,93),
  (2,94,94),
  (2,95,95),
  (2,96,96),
  (2,97,97),
  (2,98,98),
  (2,99,99),
  (2,100,100),
  (2,101,101),
  (2,102,102),
  (2,103,103),
  (2,120,120),
  (2,122,122),
  (2,123,123),
  (2,124,124),
  (2,127,127),
  (2,130,130),
  (2,131,131),
  (3,35,35),
  (3,36,36),
  (3,37,37),
  (3,38,38),
  (3,39,39),
  (3,40,40),
  (3,41,41),
  (3,56,56),
  (3,57,57),
  (3,58,58),
  (3,59,59),
  (3,60,60),
  (3,61,61),
  (3,62,62),
  (3,63,63),
  (3,64,64),
  (3,65,65),
  (3,66,66),
  (3,67,67),
  (3,68,68),
  (3,69,69),
  (3,70,70),
  (3,71,71),
  (3,72,72),
  (3,73,73),
  (3,74,74),
  (3,75,75),
  (3,76,76),
  (3,77,77),
  (3,78,78),
  (3,79,79),
  (3,80,80),
  (3,81,81),
  (3,82,82),
  (3,83,83),
  (3,84,84),
  (3,85,85),
  (3,86,86),
  (3,87,87),
  (3,88,88),
  (3,89,89),
  (3,90,90),
  (3,91,91),
  (3,92,92),
  (3,93,93),
  (3,94,94),
  (3,95,95),
  (3,96,96),
  (3,97,97),
  (3,98,98),
  (3,99,99),
  (3,100,100),
  (3,101,101),
  (3,102,102),
  (3,103,103),
  (3,104,104),
  (3,105,105),
  (3,106,106),
  (3,107,107),
  (3,108,108),
  (3,109,109),
  (3,110,110),
  (3,111,111),
  (3,112,112),
  (3,113,113),
  (3,114,114),
  (3,115,115),
  (3,116,116),
  (3,117,117),
  (3,118,118),
  (3,119,119),
  (3,120,120),
  (3,122,122),
  (3,123,123),
  (3,124,124),
  (3,125,125),
  (3,126,126),
  (3,127,127),
  (3,128,128),
  (3,129,129),
  (3,130,130),
  (3,131,131),
  (5,35,35),
  (5,36,36),
  (5,37,37),
  (5,38,38),
  (5,39,39),
  (5,40,40),
  (5,41,41),
  (5,56,56);
COMMIT;

/* Data for the `roles_acl_users` table  (LIMIT 0,500) */

INSERT INTO `roles_acl_users` (`user_id`, `role_id`) VALUES
  (1,1),
  (7,2),
  (8,3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;