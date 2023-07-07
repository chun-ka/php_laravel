-- MySQL dump 10.13  Distrib 8.0.25, for macos11 (x86_64)
--
-- Host: localhost    Database: realestate
-- ------------------------------------------------------
-- Server version	8.0.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amenities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `amenitis_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amenities`
--

LOCK TABLES `amenities` WRITE;
/*!40000 ALTER TABLE `amenities` DISABLE KEYS */;
INSERT INTO `amenities` VALUES (1,'House',NULL,NULL),(2,'Nhà hàng',NULL,NULL),(3,'Phòng trọ',NULL,NULL);
/*!40000 ALTER TABLE `amenities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (1,'Real Estate','real-estate',NULL,'2023-06-26 07:33:39'),(2,'Interior','interior',NULL,'2023-06-26 07:34:04'),(3,'Tips and advice','tips-and-advice',NULL,NULL),(4,'Architecture','architecture',NULL,NULL),(5,'Home improvement','home-improvement',NULL,NULL);
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `blogcat_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `post_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_descp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `long_descp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `post_tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_posts`
--

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;
INSERT INTO `blog_posts` VALUES (1,1,10,'Khẩu vị','khẩu-vị','upload/post/1769787955187366.jpg','rất ngon và tuyệt vời','<p><span style=\"color: rgb(255, 255, 255);\">c&oacute; cơ hội sẽ ủng họ tiếp nha</span></p>','Realestate,house','2023-06-26 10:41:58','2023-06-26 10:43:31');
/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `post_id` int unsigned NOT NULL,
  `parent_id` int unsigned DEFAULT NULL,
  `subject` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,3,1,NULL,'This is a nice post','This is a nice post','2023-06-26 21:44:01',NULL),(2,3,1,NULL,'Tuyệt vời lắm nha','Rất là tuyệt vời đó ạ','2023-06-26 21:46:47',NULL),(3,3,1,2,'cảm ơn bạn đã để lại ý kiến','tôi sẽ liên hệ với bạn sau','2023-06-26 23:44:59',NULL),(4,3,1,1,'Cảm ơn','Hãy đợi trong giấy lát,nhân viên sẽ gọi điện lại cho bạn ngay','2023-06-27 00:24:58',NULL),(5,3,1,NULL,'xin chào','tôi có một câu hỏi muốn hỏi bạn','2023-06-27 00:29:11',NULL);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compares`
--

DROP TABLE IF EXISTS `compares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compares` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `property_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compares`
--

LOCK TABLES `compares` WRITE;
/*!40000 ALTER TABLE `compares` DISABLE KEYS */;
INSERT INTO `compares` VALUES (1,3,1,'2023-06-22 21:58:24',NULL),(4,3,4,'2023-06-25 02:10:50',NULL),(5,3,5,'2023-06-25 02:10:56',NULL);
/*!40000 ALTER TABLE `compares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facilities`
--

DROP TABLE IF EXISTS `facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `facilities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `property_id` int NOT NULL,
  `facility_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distance` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facilities`
--

LOCK TABLES `facilities` WRITE;
/*!40000 ALTER TABLE `facilities` DISABLE KEYS */;
INSERT INTO `facilities` VALUES (5,1,'Hospital','1','2023-06-20 00:20:14','2023-06-20 00:20:14'),(6,1,'SuperMarket','1','2023-06-20 00:20:14','2023-06-20 00:20:14'),(7,1,'Pharmacy','1','2023-06-20 00:20:14','2023-06-20 00:20:14'),(13,3,'Hospital','1','2023-06-20 20:33:43','2023-06-20 20:33:43'),(14,3,'School','2','2023-06-20 20:33:43','2023-06-20 20:33:43'),(15,3,'Pharmacy','3','2023-06-20 20:33:43','2023-06-20 20:33:43'),(16,4,'Hospital','1','2023-06-20 23:52:49','2023-06-20 23:52:49'),(17,4,'SuperMarket','2','2023-06-20 23:52:49','2023-06-20 23:52:49'),(18,5,'SuperMarket','3','2023-06-21 01:30:23','2023-06-21 01:30:23'),(19,6,'Hospital','1','2023-06-25 00:34:14','2023-06-25 00:34:14'),(20,6,'SuperMarket','2','2023-06-25 00:34:14','2023-06-25 00:34:14'),(21,6,'School','3','2023-06-25 00:34:14','2023-06-25 00:34:14'),(23,7,'Hospital','1','2023-06-25 18:30:12','2023-06-25 18:30:12');
/*!40000 ALTER TABLE `facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_06_16_034633_create_property_types_table',1),(6,'2023_06_16_090726_create_amenities_table',1),(7,'2023_06_18_140723_create_multi_images_table',1),(8,'2023_06_18_141100_create_facilities_table',1),(9,'2023_06_19_034854_create_properties_table',1),(10,'2023_06_21_062215_create_package_plans_table',2),(11,'2023_06_22_072602_create_wishlists_table',3),(12,'2023_06_23_043003_create_compares_table',4),(13,'2023_06_23_081249_create_property_massages_table',5),(14,'2023_06_25_165010_create_states_table',6),(15,'2023_06_26_083915_create_testimonials_table',7),(16,'2023_06_26_100752_create_blog_categories_table',8),(17,'2023_06_26_152620_create_blog_posts_table',9),(18,'2023_06_27_035037_create_comments_table',10),(19,'2023_06_27_075812_create_schedules_table',11),(20,'2023_06_28_013735_create_smtp_settings_table',12),(21,'2023_06_28_035839_create_site_settings_table',13),(22,'2023_06_28_073510_create_permission_tables',14);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (5,'App\\Models\\User',20),(3,'App\\Models\\User',21),(2,'App\\Models\\User',22),(1,'App\\Models\\User',23);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multi_images`
--

DROP TABLE IF EXISTS `multi_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `multi_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `property_id` int NOT NULL,
  `photo_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multi_images`
--

LOCK TABLES `multi_images` WRITE;
/*!40000 ALTER TABLE `multi_images` DISABLE KEYS */;
INSERT INTO `multi_images` VALUES (1,1,'upload/property/multi-image/1769200898186412.jpg','2023-06-19 23:10:57',NULL),(2,1,'upload/property/multi-image/1769200898261123.jpg','2023-06-19 23:10:57',NULL),(3,1,'upload/property/multi-image/1769200898329605.jpg','2023-06-19 23:10:57',NULL),(8,3,'upload/property/multi-image/1769281603246156.jpg','2023-06-20 20:33:43',NULL),(9,3,'upload/property/multi-image/1769281603281389.jpg','2023-06-20 20:33:43',NULL),(10,4,'upload/property/multi-image/1769294129684333.jpg','2023-06-20 23:52:49',NULL),(11,4,'upload/property/multi-image/1769294129721090.jpg','2023-06-20 23:52:49',NULL),(12,5,'upload/property/multi-image/1769300268251920.jpg','2023-06-21 01:30:23',NULL),(13,5,'upload/property/multi-image/1769300268295734.jpg','2023-06-21 01:30:23',NULL),(14,6,'upload/property/multi-image/1769659122581899.jpg','2023-06-25 00:34:14',NULL),(15,6,'upload/property/multi-image/1769659122651865.jpg','2023-06-25 00:34:14',NULL),(16,6,'upload/property/multi-image/1769659122724362.jpg','2023-06-25 00:34:14',NULL),(17,6,'upload/property/multi-image/1769659122810885.jpg','2023-06-25 00:34:14',NULL),(18,7,'upload/property/multi-image/1769726688866478.jpg','2023-06-25 18:28:10',NULL),(19,7,'upload/property/multi-image/1769726688993771.jpg','2023-06-25 18:28:10',NULL),(20,7,'upload/property/multi-image/1769726689084656.jpg','2023-06-25 18:28:10',NULL);
/*!40000 ALTER TABLE `multi_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_plans`
--

DROP TABLE IF EXISTS `package_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `package_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `package_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_credits` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_plans`
--

LOCK TABLES `package_plans` WRITE;
/*!40000 ALTER TABLE `package_plans` DISABLE KEYS */;
INSERT INTO `package_plans` VALUES (1,10,'Business','ERS61827318','3','20','2023-06-21 01:12:20',NULL),(2,10,'Professional','ERS13626629','10','50','2023-06-21 01:39:58',NULL);
/*!40000 ALTER TABLE `package_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'type.menu','web','type','2023-06-28 01:54:49','2023-06-28 02:19:43'),(2,'all.type','web','type','2023-06-28 01:55:08','2023-06-28 01:55:08'),(3,'add.type','web','type','2023-06-28 01:55:40','2023-06-28 01:55:40'),(4,'edit.type','web','type','2023-06-28 01:56:14','2023-06-28 01:56:14'),(5,'delete.type','web','type','2023-06-28 01:56:27','2023-06-28 01:56:27'),(6,'state.menu','web','state','2023-06-28 01:58:50','2023-06-28 01:58:50'),(7,'all.state','web','state','2023-06-28 01:59:00','2023-06-28 01:59:00'),(8,'add.state','web','state','2023-06-28 01:59:10','2023-06-28 01:59:10'),(9,'edit.state','web','state','2023-06-28 01:59:19','2023-06-28 01:59:19'),(12,'delete.state','web','state','2023-06-28 06:44:38','2023-06-28 06:44:38'),(48,'agent.menu','web','agent','2023-06-28 10:31:08','2023-06-28 10:31:08'),(49,'agent.all','web','agent','2023-06-28 10:31:08','2023-06-28 10:31:08'),(50,'agent.add','web','agent','2023-06-28 10:31:08','2023-06-28 10:31:08'),(51,'agent.edit','web','agent','2023-06-28 10:31:08','2023-06-28 10:31:08'),(52,'agent.delete','web','agent','2023-06-28 10:31:08','2023-06-28 10:31:08'),(53,'amenities.menu','web','amenities','2023-06-28 10:31:08','2023-06-28 10:31:08'),(54,'amenities.all','web','amenities','2023-06-28 10:31:08','2023-06-28 10:31:08'),(55,'amenities.add','web','amenities','2023-06-28 10:31:08','2023-06-28 10:31:08'),(56,'amenities.edit','web','amenities','2023-06-28 10:31:08','2023-06-28 10:31:08'),(57,'amenities.delete','web','amenities','2023-06-28 10:31:08','2023-06-28 10:31:08'),(58,'property.menu','web','property','2023-06-28 10:31:08','2023-06-28 10:31:08'),(59,'property.all','web','property','2023-06-28 10:31:08','2023-06-28 10:31:08'),(60,'property.add','web','property','2023-06-28 10:31:08','2023-06-28 10:31:08'),(61,'property.edit','web','property','2023-06-28 10:31:08','2023-06-28 10:31:08'),(62,'property.delete','web','property','2023-06-28 10:31:08','2023-06-28 10:31:08'),(63,'history.menu','web','history','2023-06-28 10:31:08','2023-06-28 10:31:08'),(73,'testimonials.menu','web','testimonials','2023-06-28 10:31:08','2023-06-28 10:31:08'),(74,'testimonials.all','web','testimonials','2023-06-28 10:31:08','2023-06-28 10:31:08'),(75,'testimonials.add','web','testimonials','2023-06-28 10:31:08','2023-06-28 10:31:08'),(76,'testimonials.edit','web','testimonials','2023-06-28 10:31:08','2023-06-28 10:31:08'),(77,'testimonials.delete','web','testimonials','2023-06-28 10:31:08','2023-06-28 10:31:08'),(78,'category.menu','web','category','2023-06-28 10:31:08','2023-06-28 10:31:08'),(83,'post.menu','web','post','2023-06-28 10:31:08','2023-06-28 10:31:08'),(88,'comment.menu','web','comment','2023-06-28 10:31:08','2023-06-28 10:31:08'),(93,'smtp.menu','web','smtp','2023-06-28 10:31:08','2023-06-28 10:31:08'),(98,'site.menu','web','site','2023-06-28 10:31:08','2023-06-28 10:31:08'),(103,'role.menu','web','role','2023-06-28 10:31:08','2023-06-28 10:31:08');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `properties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ptype_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amenities_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lowest_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_thambnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_descp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `long_descp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `bedrooms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bathrooms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garage_size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amenitis_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_video` varchar(555) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neighborhood` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hot` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
INSERT INTO `properties` VALUES (1,'1','House,Nhà hàng,Phòng trọ','Villa','villa','PC001','rent','1000','1000','upload/property/thambnail/1769200898107818.jpg','đẹp','<p><span style=\"color: rgb(255, 255, 255);\">qu&aacute; đẹp</span></p>','10','10','10','10',NULL,'10','https://www.youtube.com/embed/bsYdm2AG7wk','Nguyen Tat Thanh','Da Nang','5','123456','có','10.810583','106.709145','1','1',NULL,'1','2023-06-19 23:10:57','2023-06-25 18:31:31'),(3,'1','House,Nhà hàng,Phòng trọ','House','house','PC002','buy','1000','1000','upload/property/thambnail/1769281603211055.jpg','không','<p><span style=\"color: rgb(255, 255, 255);\">kh&ocirc;ng c&oacute; g&igrave;</span></p>','1','1','1','10',NULL,'10','https://www.youtube.com/embed/bsYdm2AG7wk','Nguyen Tat Thanh','Da Nang','3','123456','có','Sài Gòn','Sài Gòn','1','1',NULL,'1','2023-06-20 20:33:43','2023-06-25 18:31:11'),(4,'2','House,Nhà hàng,Phòng trọ','545 Tracey','545 tracey','PC003','rent','1000','1000','upload/property/thambnail/1769294129642542.jpg',NULL,NULL,'1','1','1','10',NULL,'10','https://www.youtube.com/embed/bsYdm2AG7wk','Nguyen Tat Thanh','Da Nang','5','123456','có','Sài Gòn','Sài Gòn','1','1',10,'1','2023-06-20 23:52:49','2023-06-25 18:31:03'),(5,'2','House,Nhà hàng,Phòng trọ','Nhà Ở','nhà Ở','PC004','buy','1000','1000','upload/property/thambnail/1769300268210822.jpg',NULL,NULL,'1','1','1','10',NULL,'10','https://www.youtube.com/embed/bsYdm2AG7wk','Nguyen Tat Thanh','Da Nang','4','123456','có','Sài Gòn','Sài Gòn','1','1',10,'1','2023-06-21 01:30:23','2023-06-25 18:30:49'),(6,'3','House,Nhà hàng,Phòng trọ','House','house','PC005','rent','100','200','upload/property/thambnail/1769659122445773.jpg','đẹp','<p><span style=\"color: rgb(255, 255, 255);\">nh&igrave;n cũng được</span></p>','1','2','3','100',NULL,'10','không','Nguyen Tat Thanh','Da Nang','3','123456','có','16.054407','108.202164','1','1',10,'1','2023-06-25 00:34:13','2023-06-25 18:30:24'),(7,'4','House,Nhà hàng','Room','room','PC006','rent','1000','2000','upload/property/thambnail/1769726688751550.jpg',NULL,NULL,'1','1','1','100',NULL,'100','có','Nguyen Tat Thanh','Da Nang','2','123456','có',NULL,NULL,'1','1',9,'1','2023-06-25 18:28:10','2023-06-25 18:30:17');
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_massages`
--

DROP TABLE IF EXISTS `property_massages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_massages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  `property_id` int DEFAULT NULL,
  `msg_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msg_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msg_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_massages`
--

LOCK TABLES `property_massages` WRITE;
/*!40000 ALTER TABLE `property_massages` DISABLE KEYS */;
INSERT INTO `property_massages` VALUES (1,3,NULL,1,'User','user@gmail.com','123456','anh ơi em có câu hỏi muốn hỏi anh','2023-06-23 02:20:45',NULL),(2,3,10,4,'User','user@gmail.com','123456','anh cho em hỏi cái này với ạ','2023-06-23 02:21:53',NULL),(3,3,10,4,'User','user@gmail.com','123456','có ai ở đó không','2023-06-23 03:52:00',NULL),(4,3,10,4,'User','user@gmail.com','123456','tối nay ăn gì m','2023-06-25 00:08:45',NULL),(5,3,10,NULL,'User','user@gmail.com','123456','cho tôi hỏi cái này xíu','2023-06-25 03:06:07',NULL);
/*!40000 ALTER TABLE `property_massages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_types`
--

DROP TABLE IF EXISTS `property_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_types`
--

LOCK TABLES `property_types` WRITE;
/*!40000 ALTER TABLE `property_types` DISABLE KEYS */;
INSERT INTO `property_types` VALUES (1,'Duplex','icon-4',NULL,'2023-06-21 09:17:35'),(2,'Warehouse','icon-6',NULL,'2023-06-21 09:17:41'),(3,'Apartment','icon-1',NULL,NULL),(4,'Office','icon-2',NULL,NULL),(5,'Floor','icon-3',NULL,NULL),(6,'Building','icon-5',NULL,NULL);
/*!40000 ALTER TABLE `property_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(12,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(73,1),(74,1),(75,1),(76,1),(77,1),(78,1),(83,1),(88,1),(93,1),(98,1),(103,1),(1,2),(3,2),(48,2),(1,3),(2,3),(4,3),(6,3),(7,3),(58,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','web','2023-06-28 09:13:14','2023-06-28 09:22:59'),(2,'Manager','web','2023-06-28 09:17:09','2023-06-28 09:17:09'),(3,'Admin','web','2023-06-28 09:17:14','2023-06-28 09:17:14'),(5,'Sales','web','2023-06-28 09:26:43','2023-06-28 09:26:43');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `property_id` int DEFAULT NULL,
  `agent_id` int DEFAULT NULL,
  `tour_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tour_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (1,3,4,10,'06/28/2023','6pm','tôi muốn xem chi tiết hơn về nhà này','0','2023-06-27 01:31:03','2023-06-27 19:56:24'),(2,3,4,10,'06/30/2023','10am','Tôi muốn hỏi thêm thông tin về căn hộ này','1','2023-06-27 02:38:34','2023-06-27 20:25:22'),(3,3,5,10,'06/07/2023','6pm','tôi có vấn đề muốn hỏi bạn','1','2023-06-27 02:39:43','2023-06-27 20:26:24');
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'upload/logo/1769920907669521.png','0898212386','15A Nguyễn Trung Trực,Bình Thạnh','trungnoo196@gmail.com','https://www.facebook.com/','https://www. twitter.com/','Quoc Trung © 2023 All Right Reserved',NULL,'2023-06-27 21:56:45');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smtp_settings`
--

DROP TABLE IF EXISTS `smtp_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `smtp_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mailer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encryption` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smtp_settings`
--

LOCK TABLES `smtp_settings` WRITE;
/*!40000 ALTER TABLE `smtp_settings` DISABLE KEYS */;
INSERT INTO `smtp_settings` VALUES (1,'smtp','sandbox.smtp.mailtrap.io','2525','03c467b7443a9c','74f62f3631c54f','tls','trungnoo196@gmail.com',NULL,'2023-06-27 19:12:40');
/*!40000 ALTER TABLE `smtp_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `state_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (2,'KAWRAN BAZAR','upload/state/1769696735610476.jpg',NULL,NULL),(3,'BANINI','upload/state/1769696807287460.jpg',NULL,NULL),(4,'Paktan','upload/state/1769696867942397.jpg',NULL,NULL),(5,'Mutina','upload/state/1769696889475077.jpg',NULL,NULL);
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'quốc trung','giám đốc','upload/testimonials/1769757988879323.png','chất lượng rất tốt,nhân viên phục vụ tận tình',NULL,'2023-06-26 02:45:40'),(2,'kha','thư kí','upload/testimonials/1769757995703166.png','chất lượng ổn định,không có vấn đề gì đâu',NULL,'2023-06-26 02:45:46');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `role` enum('admin','agent','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `credit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Agent','agent','agent@gmail.com',NULL,'$2y$10$dI/q6PSQnD8SzGUhdhpKAuVec2dXO9axejPqtTAJc8yIa/O3Nq5xG','202306201009avatar-1.png','113','Việ Nam','agent','active','0',NULL,NULL,'2023-06-23 01:09:38'),(3,'User','user','user@gmail.com',NULL,'$2y$10$1KFeQpeDUfNxYFH7V9t3t.05IttU7rciVtgUqC1Avlu/NtOtWFxwm','202306221013avatar-2.png','123456',NULL,'user','active','0',NULL,NULL,'2023-06-22 03:13:41'),(6,'Yasmin Kohler Jr.',NULL,'kirlin.gisselle@example.net','2023-06-19 22:45:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','https://via.placeholder.com/60x60.png/0066dd?text=consequatur','(551) 265-6176','382 Vicente Ridges\nAbbottport, FL 83975-5608','user','inactive','0','6y2l41Jb9O','2023-06-19 22:45:17','2023-06-19 22:45:17'),(10,'Kha','kha','kha@gmail.com',NULL,'$2y$10$6t3368vGciMy4.iUnAtUxujq/caWxHQCSqdKAgF/20DyZNv3caRTy','2023062015548423ED23-522F-4081-9471-D0ACE0737357_1_201_a.jpeg','113','Sài Gòn','agent','active','18',NULL,NULL,'2023-06-25 00:34:14'),(11,'Estatelaza',NULL,'estatelaza@gmail.com',NULL,'$2y$10$3tCxu5kvvlODhNXQb7nyK.2zBBxD71NsJ/9GxesWkxtVASrv9ltPq','202306250801avatar-6.png','1234567','Đà Nẵng','agent','active','0',NULL,NULL,'2023-06-25 01:01:37'),(20,'sale','sale','sale@gmail.com',NULL,'$2y$10$IBATgMRuVGbp4WV5sdLFeeL3FFeIE0dElmmYGmi8OASG0APQAGhf6',NULL,'123456','Sài Gòn','admin','active','0',NULL,'2023-06-29 02:09:17','2023-06-29 02:57:54'),(21,'admin','admin','admin@gmail.com',NULL,'$2y$10$OuBeRgFR46tNwxJsulJWl.8pSdNXmdUTRaRlysusceyi7V3z68VXi','2023062909567DDD11E8-C61C-4C49-BA41-A4993CEEAF98_1_105_c.jpeg','111','Sài Gòn','admin','active','0',NULL,'2023-06-29 02:52:52','2023-06-29 03:07:03'),(22,'manager','manager','manager@gmail.com',NULL,'$2y$10$bXlBpUmhEJ8f1JuAq6naJ.Wq8x6DpsGBGUiDvlH8Sq.k28UgHOi6W',NULL,'111','Sài Gòn','admin','active','0',NULL,'2023-06-29 02:58:34','2023-06-29 02:58:34'),(23,'trung','trung','trung@gmail.com',NULL,'$2y$10$dywamy4qtxsSH5G1bX7UguowNEJIqEY3STRgHKxdOTmR7WO77NTu2','2023062910007545C536-57CE-40EE-A6AA-55F7DC67407C_1_105_c.jpeg','111','Sài Gòn','admin','active','0',NULL,'2023-06-29 02:59:31','2023-06-29 03:07:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `property_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
INSERT INTO `wishlists` VALUES (2,3,3,'2023-06-22 02:33:00',NULL),(3,3,4,'2023-06-22 02:33:03',NULL),(4,3,1,'2023-06-22 21:05:02',NULL);
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'realestate'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-30 10:36:49
