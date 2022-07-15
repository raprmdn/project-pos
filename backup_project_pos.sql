-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: project_pos
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Makanan','makanan','2022-07-14 08:52:40','2022-07-14 08:52:40',NULL),(2,'Minuman','minuman','2022-07-14 08:52:40','2022-07-14 08:52:40',NULL),(3,'Elektronik','elektronik','2022-07-14 08:52:40','2022-07-14 08:52:40',NULL),(4,'Snack','snack','2022-07-14 08:52:40','2022-07-14 08:52:40',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2022_06_12_022015_create_categories_table',1),(7,'2022_06_12_022026_create_units_table',1),(8,'2022_06_12_022030_create_products_table',1),(9,'2022_06_12_022058_create_suppliers_table',1),(10,'2022_06_12_022060_create_order_products_table',1),(11,'2022_06_12_022123_create_order_products_details_table',1),(12,'2022_06_12_022136_create_sales_table',1),(13,'2022_06_12_022148_create_sale_details_table',1),(14,'2022_06_14_020123_create_permission_tables',1),(15,'2022_06_19_181958_drop_phone_from_suppliers',1),(16,'2022_06_19_182030_add_phone_column_to_suppliers',1),(17,'2022_07_14_132230_add_photo_to_users_table',1);
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
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(1,'App\\Models\\User',2),(1,'App\\Models\\User',3),(1,'App\\Models\\User',4),(2,'App\\Models\\User',5),(3,'App\\Models\\User',6),(4,'App\\Models\\User',7);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_items` int NOT NULL DEFAULT '0',
  `total` double unsigned NOT NULL DEFAULT '0',
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_products_invoice_unique` (`invoice`),
  UNIQUE KEY `order_products_uuid_unique` (`uuid`),
  KEY `order_products_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `order_products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_products`
--

LOCK TABLES `order_products` WRITE;
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
INSERT INTO `order_products` VALUES (1,1,'ORD20220702HABN','1df1fad6-a8c8-40ad-a536-8ad7ab4c8d80',95,1310000,NULL,'completed','2022-07-01 11:41:12','2022-07-01 11:42:11',NULL),(2,2,'ORD20220702Y8KN','a9f5e2d7-aeff-4aa9-a269-9f16aaec8890',25,577500,NULL,'completed','2022-07-01 11:42:49','2022-07-01 11:43:13',NULL),(3,4,'ORD20220702PVM1','84f7a3be-b922-406a-a53f-7bb0cbe2b0c4',45,1222500,NULL,'completed','2022-07-02 11:43:35','2022-07-02 11:43:59',NULL),(4,3,'ORD20220702TSBJ','3a8d532c-165b-4630-b7d7-4b23dd2da524',170,965000,NULL,'completed','2022-07-02 11:45:42','2022-07-02 11:45:58',NULL);
/*!40000 ALTER TABLE `order_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_products_details`
--

DROP TABLE IF EXISTS `order_products_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_products_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_product_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `qty` int NOT NULL,
  `total` double unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_products_details_order_product_id_foreign` (`order_product_id`),
  KEY `order_products_details_product_id_foreign` (`product_id`),
  CONSTRAINT `order_products_details_order_product_id_foreign` FOREIGN KEY (`order_product_id`) REFERENCES `order_products` (`id`),
  CONSTRAINT `order_products_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_products_details`
--

LOCK TABLES `order_products_details` WRITE;
/*!40000 ALTER TABLE `order_products_details` DISABLE KEYS */;
INSERT INTO `order_products_details` VALUES (1,1,1,30,210000,'2022-07-01 11:41:28','2022-07-01 11:41:39'),(2,1,2,30,150000,'2022-07-01 11:41:46','2022-07-01 11:41:50'),(3,1,3,5,500000,'2022-07-01 11:41:56','2022-07-01 11:41:59'),(4,1,4,30,450000,'2022-07-01 11:42:05','2022-07-01 11:42:09'),(5,2,8,10,390000,'2022-07-01 11:42:55','2022-07-01 11:42:59'),(6,2,7,5,62500,'2022-07-01 11:43:02','2022-07-01 11:43:05'),(7,2,6,10,125000,'2022-07-01 11:43:08','2022-07-01 11:43:12'),(8,3,5,30,165000,'2022-07-01 11:43:39','2022-07-01 11:43:46'),(9,3,9,15,1057500,'2022-07-01 11:43:52','2022-07-01 11:43:57'),(10,4,10,150,525000,'2022-07-01 11:45:46','2022-07-01 11:45:51'),(11,4,11,20,440000,'2022-07-01 11:45:53','2022-07-01 11:45:57');
/*!40000 ALTER TABLE `order_products_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view-master-menu','web','2022-07-14 08:52:39','2022-07-14 08:52:39'),(2,'view-transaction-menu','web','2022-07-14 08:52:39','2022-07-14 08:52:39'),(3,'view-reports-menu','web','2022-07-14 08:52:39','2022-07-14 08:52:39'),(4,'view-role-and-permissions-menu','web','2022-07-14 08:52:39','2022-07-14 08:52:39'),(5,'view-trash-menu','web','2022-07-14 08:52:39','2022-07-14 08:52:39'),(6,'view-settings-menu','web','2022-07-14 08:52:39','2022-07-14 08:52:39'),(7,'view-category','web','2022-07-14 08:52:39','2022-07-14 08:52:39'),(8,'view-unit','web','2022-07-14 08:52:39','2022-07-14 08:52:39'),(9,'view-product','web','2022-07-14 08:52:39','2022-07-14 08:52:39'),(10,'view-supplier','web','2022-07-14 08:52:39','2022-07-14 08:52:39'),(11,'view-purchase','web','2022-07-14 08:52:39','2022-07-14 08:52:39'),(12,'view-sales','web','2022-07-14 08:52:39','2022-07-14 08:52:39'),(13,'create-transaction','web','2022-07-14 08:52:39','2022-07-14 08:52:39'),(14,'view-sales-reports','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(15,'view-role','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(16,'view-permissions','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(17,'view-products-trash','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(18,'view-categories-trash','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(19,'view-units-trash','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(20,'view-suppliers-trash','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(21,'view-users','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(22,'view-chart','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(23,'create-users','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(24,'create-category','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(25,'edit-category','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(26,'delete-category','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(27,'create-unit','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(28,'edit-unit','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(29,'delete-unit','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(30,'create-supplier','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(31,'edit-supplier','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(32,'delete-supplier','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(33,'create-product','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(34,'edit-product','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(35,'delete-product','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(36,'restore-product','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(37,'restore-category','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(38,'restore-unit','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(39,'restore-supplier','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(40,'view-profile','web','2022-07-15 08:34:50','2022-07-15 08:34:50');
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
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `price` double unsigned NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint unsigned NOT NULL,
  `unit_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_barcode_unique` (`barcode`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_unit_id_foreign` (`unit_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'329815269','Richese Nabati Coklat','richese-nabati-coklat-MZmy',30,7000,NULL,'Richese Nabati Coklat',4,3,'2022-07-02 11:26:12','2022-07-02 11:42:11',NULL),(2,'455507334','Susu Ultra Milk Coklat 200ml','susu-ultra-milk-coklat-200ml-6Vmt',19,5000,NULL,'Susu Ultra Milk Coklat 200ml',2,2,'2022-07-02 11:26:30','2022-07-14 09:14:08',NULL),(3,'659628092','Susu Ultra Milk Coklat 1 Pack','susu-ultra-milk-coklat-1-pack-LJ5w',0,100000,NULL,'Susu Ultra Milk Coklat 1 Pack',2,4,'2022-07-02 11:27:00','2022-07-14 06:19:51',NULL),(4,'895406229','Fresh Tea Apple 150ml','fresh-tea-apple-150ml-awGX',25,15000,NULL,'Fresh Tea Apple 150ml',2,3,'2022-07-02 11:34:15','2022-07-14 09:08:53',NULL),(5,'275989574','Sari Roti Coklat','sari-roti-coklat-QpDL',24,5500,NULL,'Sari Roti Coklat',1,3,'2022-07-02 11:35:11','2022-07-03 05:15:01',NULL),(6,'784683501','Kacang Kulit','kacang-kulit-V4au',9,12500,NULL,'Kacang Kulit',4,3,'2022-07-02 11:36:25','2022-07-14 10:12:33',NULL),(7,'143950783','Kopi Kapal Api','kopi-kapal-api-5ZBL',2,12500,NULL,'Kopi Kapal Api',2,3,'2022-07-02 11:37:53','2022-07-03 05:14:56',NULL),(8,'334479062','Nutella','nutella-O3I9',4,39000,NULL,'Nutella',1,3,'2022-07-02 11:38:39','2022-07-03 05:14:53',NULL),(9,'539323611','Milo 800g','milo-800g-tDac',8,70500,NULL,'Milo 800g',2,3,'2022-07-02 11:39:30','2022-07-03 05:14:51',NULL),(10,'627784608','Indomie Goreng','indomie-goreng-d2mt',77,3500,NULL,'Indomie Goreng',1,3,'2022-07-02 11:40:04','2022-07-14 06:19:57',NULL),(11,'664174466','Sirup Marjan Cocopandan 460ml','sirup-marjan-cocopandan-460ml-AiBL',15,22000,NULL,'Sirup Marjan Cocopandan 460ml',2,3,'2022-07-02 11:40:55','2022-07-14 10:08:20',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
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
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(1,2),(2,2),(3,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(24,2),(27,2),(30,2),(33,2),(40,2),(1,3),(2,3),(6,3),(9,3),(11,3),(12,3),(13,3),(40,3),(6,4),(40,4);
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrator','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(2,'staff','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(3,'cashier','web','2022-07-14 08:52:40','2022-07-14 08:52:40'),(4,'user','web','2022-07-14 08:52:40','2022-07-14 08:52:40');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sale_details`
--

DROP TABLE IF EXISTS `sale_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sale_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `unit_price` double unsigned NOT NULL,
  `qty` int NOT NULL,
  `total` double unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_details_sale_id_foreign` (`sale_id`),
  KEY `sale_details_product_id_foreign` (`product_id`),
  CONSTRAINT `sale_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `sale_details_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sale_details`
--

LOCK TABLES `sale_details` WRITE;
/*!40000 ALTER TABLE `sale_details` DISABLE KEYS */;
INSERT INTO `sale_details` VALUES (1,1,9,70500,1,70500,'2022-07-02 11:44:16','2022-07-02 11:44:16'),(2,1,5,5500,3,16500,'2022-07-02 11:44:19','2022-07-02 11:44:22'),(3,1,3,100000,1,100000,'2022-07-02 11:44:27','2022-07-02 11:44:27'),(4,1,7,12500,1,12500,'2022-07-02 11:44:33','2022-07-02 11:44:33'),(5,1,8,39000,1,39000,'2022-07-02 11:44:36','2022-07-02 11:44:36'),(6,2,10,3500,10,35000,'2022-07-02 11:47:37','2022-07-02 11:47:41'),(7,2,3,100000,1,100000,'2022-07-02 11:47:45','2022-07-02 11:47:45'),(8,2,5,5500,2,11000,'2022-07-02 11:47:49','2022-07-02 11:47:52'),(9,2,8,39000,1,39000,'2022-07-02 11:47:56','2022-07-02 11:47:56'),(10,2,9,70500,1,70500,'2022-07-02 11:47:59','2022-07-02 11:47:59'),(11,2,11,22000,1,22000,'2022-07-02 11:48:01','2022-07-02 11:48:01'),(12,2,4,15000,1,15000,'2022-07-02 11:48:04','2022-07-02 11:48:04'),(13,2,7,12500,1,12500,'2022-07-02 11:48:10','2022-07-02 11:48:10'),(14,3,9,70500,3,211500,'2022-07-03 05:11:59','2022-07-03 05:12:02'),(15,3,10,3500,40,140000,'2022-07-03 05:12:12','2022-07-03 05:12:16'),(16,3,3,100000,1,100000,'2022-07-03 05:12:20','2022-07-03 05:12:20'),(17,4,3,100000,1,100000,'2022-07-03 05:13:18','2022-07-03 05:13:18'),(18,4,8,39000,3,117000,'2022-07-03 05:13:23','2022-07-03 05:13:27'),(19,4,9,70500,1,70500,'2022-07-03 05:13:32','2022-07-03 05:13:32'),(20,4,2,5000,5,25000,'2022-07-03 05:13:36','2022-07-03 05:13:42'),(21,4,10,3500,10,35000,'2022-07-03 05:13:44','2022-07-03 05:13:48'),(22,4,11,22000,2,44000,'2022-07-03 05:13:52','2022-07-03 05:13:56'),(23,5,11,22000,2,44000,'2022-07-03 05:14:41','2022-07-03 05:14:47'),(24,5,9,70500,1,70500,'2022-07-03 05:14:51','2022-07-03 05:14:51'),(25,5,8,39000,1,39000,'2022-07-03 05:14:53','2022-07-03 05:14:53'),(26,5,7,12500,1,12500,'2022-07-03 05:14:56','2022-07-03 05:14:56'),(27,5,6,12500,1,12500,'2022-07-03 05:14:59','2022-07-03 05:14:59'),(28,5,5,5500,1,5500,'2022-07-03 05:15:01','2022-07-03 05:15:01'),(29,5,4,15000,1,15000,'2022-07-03 05:15:04','2022-07-03 05:15:04'),(30,6,2,5000,5,25000,'2022-07-03 05:15:26','2022-07-03 05:15:28'),(31,6,4,15000,3,45000,'2022-07-03 05:15:34','2022-07-03 05:15:44'),(32,6,10,3500,8,28000,'2022-07-03 05:15:51','2022-07-03 05:16:03'),(37,13,3,100000,1,100000,'2022-07-14 06:19:51','2022-07-14 06:19:51'),(38,13,10,3500,5,17500,'2022-07-14 06:19:54','2022-07-14 06:19:57'),(43,15,2,5000,1,5000,'2022-07-14 09:14:08','2022-07-14 09:14:08');
/*!40000 ALTER TABLE `sale_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_items` int NOT NULL DEFAULT '0',
  `subtotal` double unsigned NOT NULL DEFAULT '0',
  `discount` double(8,2) unsigned NOT NULL DEFAULT '0.00',
  `saved` double unsigned NOT NULL DEFAULT '0',
  `total` double unsigned NOT NULL DEFAULT '0',
  `received` double unsigned NOT NULL DEFAULT '0',
  `change` double NOT NULL DEFAULT '0',
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sales_invoice_unique` (`invoice`),
  UNIQUE KEY `sales_uuid_unique` (`uuid`),
  KEY `sales_user_id_foreign` (`user_id`),
  CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,3,'TRX20220702X3AF','e9d0118e-f866-4e75-b364-fb2fd77a3b5a',7,238500,1.00,2385,236115,250000,13885,'Terima Kasih Telah Berbelanja!','completed','2022-07-02 11:44:08','2022-07-02 11:45:02',NULL),(2,3,'TRX20220702KHBO','3cfc51b4-b170-4d23-b740-d2f285cce8d2',18,305000,1.25,3812.5,301187.5,302000,812.5,'Terima Kasih telah berbelanja!','completed','2022-07-02 11:47:34','2022-07-02 11:48:48',NULL),(3,3,'TRX202207036GHL','71d2bdd4-006f-4bb4-b735-a33d7d4a1994',44,451500,0.00,0,451500,500000,48500,NULL,'completed','2022-07-03 05:11:54','2022-07-03 05:12:50',NULL),(4,3,'TRX20220703BZ3J','eeb67db5-47ea-43a5-973e-8c3a895857fe',22,391500,0.00,0,391500,400000,8500,NULL,'completed','2022-07-03 05:13:13','2022-07-03 05:14:03',NULL),(5,3,'TRX20220703T1WA','a2fd6089-cc8e-4a08-b331-66e6995fb564',8,199000,0.00,0,199000,200000,1000,NULL,'completed','2022-07-03 05:14:36','2022-07-03 05:15:14',NULL),(6,3,'TRX20220703GFOW','6eb0eb9a-a9aa-4d90-945b-dea21bb0c037',16,98000,0.00,0,98000,100000,2000,NULL,'completed','2022-07-03 05:15:19','2022-07-03 05:16:10',NULL),(13,3,'TRX202207141YRM','09956561-70c0-4d6e-a5c4-89774c2c1b8e',6,117500,0.00,0,117500,120000,2500,'Terima kasih telah berbelanja!','completed','2022-07-14 06:19:47','2022-07-14 06:20:31',NULL),(15,3,'TRX20220714KRN1','7dbb4950-a1ad-4667-b878-cff1bc8e2047',1,5000,0.00,0,5000,5000,0,NULL,'completed','2022-07-14 09:04:23','2022-07-14 09:14:40',NULL);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `suppliers_slug_unique` (`slug`),
  UNIQUE KEY `suppliers_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'Supplier 1','supplier-1','Jl. Raya 1','081234567891','Supplier 1 Description','2022-07-14 08:52:40','2022-07-14 08:52:40',NULL),(2,'Supplier 2','supplier-2','Jl. Raya 2','081234567892','Supplier 2 Description','2022-07-14 08:52:40','2022-07-14 08:52:40',NULL),(3,'Supplier 3','supplier-3','Jl. Raya 3','081234567893','Supplier 3 Description','2022-07-14 08:52:40','2022-07-14 08:52:40',NULL),(4,'Supplier 4','supplier-4','Jl. Raya 4','081234567894','Supplier 4 Description','2022-07-14 08:52:40','2022-07-14 08:52:40',NULL);
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `units_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'Kg','kg','2022-07-14 08:52:40','2022-07-14 08:52:40',NULL),(2,'Ml','ml','2022-07-14 08:52:40','2022-07-14 08:52:40',NULL),(3,'Pcs','pcs','2022-07-14 08:52:40','2022-07-14 08:52:40',NULL),(4,'Pack','pack','2022-07-14 08:52:40','2022-07-14 08:52:40',NULL),(5,'Lain-lain','lain-lain','2022-07-14 08:52:40','2022-07-14 08:52:40',NULL);
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Qoidurrahman Haqiqi','kiki@email.com',NULL,'$2y$10$WayDkXqnrkQmslS5h.P70.Qn/ePfcYAT4E9DKCyfWQ6JgmbnieLHi',NULL,NULL,NULL,NULL,'2022-07-14 08:52:40','2022-07-14 08:52:40'),(2,'Muhammad Nabil Islam','nabil@email.com',NULL,'$2y$10$KUmgFPXWyhNZW8d2YyWj2ekV4u1YDoqunF0QyjK7uqHzbkePPuiEa',NULL,NULL,NULL,NULL,'2022-07-14 08:52:40','2022-07-14 08:52:40'),(3,'Rafi Putra Ramadhan','rafi@email.com',NULL,'$2y$10$5SH.vgN896axWShv2jiAQOALlB6YwLtaN/vYmguQPxHAQ8u3RhlBi','profile/images/gR5Z-rafi-putra-ramadhan.jpg',NULL,NULL,NULL,'2022-07-14 08:52:40','2022-07-14 09:01:37'),(4,'Muhammad Yusuf Hijriah','yusuf@email.com',NULL,'$2y$10$uTMxCT6wEXkiIpcnNe3DmuT5AqRyObp2.j9bKf3Egm.T9FRI1XWBC',NULL,NULL,NULL,NULL,'2022-07-14 08:52:40','2022-07-14 08:52:40'),(5,'User Staff','staff@email.com',NULL,'$2y$10$lD6UwrArNu5tTd0E29bu1esR4qu/PXU2X8k7hwK0UpAJp.93IDgbK',NULL,NULL,NULL,NULL,'2022-07-14 08:52:40','2022-07-14 08:52:40'),(6,'User Cashier','cashier@email.com',NULL,'$2y$10$tw845rctOzz8mNaCeR755.8trvuATCYIqUWjqroovfJygwxfFfDIi',NULL,NULL,NULL,NULL,'2022-07-14 08:52:40','2022-07-14 08:52:40'),(7,'User','user@email.com',NULL,'$2y$10$2bBgy5SdOsWXaiom1kbYV.oDUHBFwu5tr/QRKkBXSwPsV5hBtS3Au',NULL,NULL,NULL,NULL,'2022-07-14 08:52:40','2022-07-14 08:52:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-15 16:01:20
