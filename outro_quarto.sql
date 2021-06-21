-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 17, 2021 at 09:10 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `outro_quarto`
--

-- --------------------------------------------------------

--
-- Table structure for table `announces`
--

CREATE TABLE `announces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `house_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `county` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_METHOD` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `living_room` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kitchen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bathroom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `garden` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `furniture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `truth` tinyint(1) NOT NULL DEFAULT '1',
  `untrue` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announces`
--

INSERT INTO `announces` (`id`, `user_id`, `house_code`, `city`, `county`, `district`, `street`, `period`, `type`, `payment_METHOD`, `price`, `room`, `living_room`, `kitchen`, `bathroom`, `garden`, `furniture`, `state`, `description`, `email`, `phone`, `profile`, `slug`, `truth`, `untrue`, `created_at`, `updated_at`) VALUES
(1, 3, 'i0ttar7v8oowooc84ckk0c88g48ks00', 'Bengo', 'Caxito', 'sadas', 'sd', 'long period', 'Apartamento', 'Monthly', '200000', '3', '1', '2', '2', 'yes', 'yes', 'available', '<p>Binding background image style using a <strong>dynamic</strong> value from <strong>v-for</strong> loop could be done like this.</p>', 'nulok@mailinator.com', '+380507004256', 'images/announce/thumbnail/1611513610_thumbnailbanner2.jpg', NULL, 1, 0, '2021-01-09 09:15:06', '2021-01-24 16:52:35'),
(3, 2, 'rx1na3rkqq8cgckwkwoog8wg4cswsc8', 'Bengo', 'Dande', 'Mbeleque', 'Rua domingos 12, casa n. 3', 'short period', 'Apartamento', 'Monthly', '5234550', '2', '2', '1', '2', 'yes', 'not', 'available', '<p>Com uma equipa de cerca de 250 consultores especializados, a Rumos Serviços promove as competências técnicas dos seus consultores, através de planos de formação certificada pelos principais fabricantes.</p>', 'nulok@mailinator.com', '+380507004256', 'images/announce/thumbnail/1611513381_thumbnailbanner3.jpg', NULL, 1, 0, '2021-01-16 06:29:40', '2021-01-24 16:36:21'),
(5, 2, '33ghb42ievwgkog0808gk8ccws0ggo0', 'Cuando Cubango', 'Dirico', 'Cazenga', 'Rua mae preta', 'long period', 'Apartamento', 'Quarterly', '105200.20', '2', '3+', '2', '2', 'yes', 'not', 'available', '<p>Um profissional Rumos desenvolve projetos especializados em empresas nacionais e internacionais.</p>', 'nulok@mailinator.com', '+380507004256', 'images/announce/thumbnail/1611797423_thumbnailafrica-animal-black-and-white-black-and-white-259351.jpg', NULL, 1, 0, '2021-01-16 09:42:25', '2021-01-27 23:30:24'),
(6, 2, 'rcds7t1zg1cs4o40444cw4g4w8k4cg0', 'Huambo', 'Huambo', NULL, NULL, 'short period', 'Vivenda', 'Weekly', '123123', '3', '2', '2', '2', 'yes', 'yes', 'available', '<h3>Hi!</h3><p>Write your content here...</p>', 'nulok@mailinator.com', '+380507004256', 'images/announce/thumbnail/1612027669_thumbnailb2.jpg', NULL, 1, 0, '2021-01-16 09:43:42', '2021-01-30 15:28:11'),
(10, 4, 'k35oj1azoo0go44w4g8okgosc4okowg', 'Lunda Sul', 'Cocolo', NULL, NULL, 'long period', 'Apartamento', 'Semiannual', '22000', '3', '2', '2', '2', 'yes', 'yes', 'available', '<p>If the height of a modal changes while it is open, you should call myModal.handleUpdate() to readjust the modal’s position in case a scrollbar appears.</p><p>If the height of a modal changes while it is open, you should call myModal.handleUpdate() to readjust the modal’s position in case a scrollbar appears.</p><p>If the height of a modal changes while it is open, you should call myModal.handleUpdate() to readjust the modal’s position in case a scrollbar appears.</p><p>If the height of a modal changes while it is open, you should call myModal.handleUpdate() to readjust the modal’s position in case a scrollbar appears.</p>', 'vofy@mailinator.com', NULL, 'images/announce/thumbnail/1611732820_thumbnailaerial-photography-of-city-3016350.jpg', NULL, 1, 0, '2021-01-27 05:33:42', '2021-01-27 05:38:37'),
(11, 2, 'plmmre7nj6swcw088wwcw8sowg8ock4', 'Bié', 'Andulo', NULL, NULL, 'long period', 'Hospedaria', 'Weekly', '56558988', '2', '1', '1', '2', 'yes', 'not', 'occupied', '<p>Bootstrap uses the class \'form-input\' for controlling the attributes of \'input fields\'. Simply, add your own \'form-input\' class with the desired width, border, text size, etc in your css file or head section.</p>', 'nulok@mailinator.com', '+380507004256', 'images/announce/thumbnail/1612027833_thumbnailchair-beside-book-shelves-2041540.jpg', NULL, 1, 0, '2021-01-30 15:30:36', '2021-02-04 08:21:29'),
(12, 5, 'ag9rmilhd1s8gsok84co00c8ksscoko', 'Cuanza Norte', 'Golungo Alto', NULL, NULL, 'short period', 'outhouse', 'Daily', '4545454', '3', '2', '1', '2', 'not', 'not', 'available', '<h3>Hi!</h3><p>Write your content here...</p>', 'fyme@mailinator.com', '(+244) 333-555-666', 'images/announce/thumbnail/1613441601_thumbnailbanner2.jpg', NULL, 1, 0, '2021-02-16 00:13:24', '2021-02-16 00:13:24'),
(13, 5, '758jprl5rcco00k84swg0o44w40wk88', 'Cuanza Norte', 'Golungo Alto', 'Sao Romeu', 'Rua Angelina Rodrigues, 21', 'short period', 'outhouse', 'Semiannual', '4545454', '2', '2', '1', '2', 'not', 'not', 'available', '<h3>Hi!</h3><p>Write your content here...</p>', 'fyme@mailinator.com', '(+244) 333-555-666', 'images/announce/thumbnail/1613562741_thumbnailaboutus.jpg', NULL, 1, 0, '2021-02-16 00:13:28', '2021-02-20 16:56:47'),
(14, 2, '12qvj9cfj3qook0go0s88ssgsc8k8cc', 'Bié', 'Cuito', NULL, NULL, 'long period', 'Vivenda', 'Quarterly', '6582', '2', '1', '1', '3', 'yes', 'yes', 'occupied', '<h3>Hi!</h3><p>Write your content here...</p>', 'nulok@mailinator.com', '+380507004256', 'images/announce/thumbnail/1613937699_thumbnailZAY_0028.JPG', NULL, 1, 0, '2021-02-21 18:01:43', '2021-02-21 18:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `house_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `house_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `county` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'long period',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_METHOD` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `living_room` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kitchen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bathroom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seal` tinyint(1) NOT NULL DEFAULT '0',
  `furniture` tinyint(1) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `verification` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/property/thumbnail/no-image.png',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `property_id`, `house_code`, `status`, `city`, `county`, `district`, `street`, `period`, `type`, `payment_METHOD`, `price`, `room`, `living_room`, `kitchen`, `bathroom`, `seal`, `furniture`, `state`, `verification`, `description`, `profile`, `username`, `email`, `phone`, `slug`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', 'Active', 'Cabinda', 'Belize', 'sdfsd', 'sdfsdf', 'long period', 'Apartamento', 'Quarterly', '34535', '3', '3', '2', '2', 0, 0, 0, 0, '<h3>Hi!</h3><p>Write your content here...</p>', 'images/property/thumbnail/1614752359_thumbnailimg_920x519$2018_08_02_00_02_02_1430865.jpg', NULL, 'nulok@mailinator.com', '+380507004256', NULL, '2021-03-05 23:35:45', '2021-03-05 23:35:45'),
(2, 5, 2, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', 'Active', 'Cabinda', 'Belize', 'sdfsd', 'sdfsdf', 'long period', 'Apartamento', 'Quarterly', '34535', '3', '3', '2', '2', 0, 0, 0, 0, '<h3>Hi!</h3><p>Write your content here...</p>', 'images/property/thumbnail/1614752359_thumbnailimg_920x519$2018_08_02_00_02_02_1430865.jpg', NULL, 'nulok@mailinator.com', '+380507004256', NULL, '2021-03-05 23:36:26', '2021-03-05 23:36:26'),
(3, 2, 5, '6aru7tq2qhwkggokgkoowsk0wwggg8k', 'Active', 'Cuando Cubango', 'Dirico', '435dsfsdf', 'dsfsdf54 5', 'long period', 'Vivenda', 'Monthly', '7668', '6', '2', '3', '3', 0, 0, 0, 0, '<h3>Hi!</h3><p>Write your content here...</p>', 'images/property/thumbnail/1617565948_thumbnaillaravel.jpg', 'Cora Dominguez', 'nulok@mailinator.com', '+380507004256', NULL, '2021-04-10 20:49:27', '2021-04-10 20:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `house_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `county` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'long period',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_METHOD` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `living_room` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kitchen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bathroom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seal` tinyint(1) NOT NULL DEFAULT '0',
  `furniture` tinyint(1) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `verification` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/property/thumbnail/no-image.png',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`id`, `user_id`, `property_id`, `house_code`, `status`, `city`, `county`, `district`, `street`, `period`, `type`, `payment_METHOD`, `price`, `room`, `living_room`, `kitchen`, `bathroom`, `seal`, `furniture`, `state`, `verification`, `description`, `profile`, `username`, `email`, `phone`, `slug`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', 'Active', 'Cabinda', 'Belize', 'sdfsd', 'sdfsdf', 'long period', 'Apartamento', 'Quarterly', '34535', '3', '3', '2', '2', 0, 0, 0, 0, '<h3>Hi!</h3><p>Write your content here...</p>', 'images/property/thumbnail/1614752359_thumbnailimg_920x519$2018_08_02_00_02_02_1430865.jpg', 'Cora Dominguez', 'nulok@mailinator.com', '+380507004256', NULL, '2021-03-06 10:22:07', '2021-03-06 10:22:07'),
(2, 2, 2, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', 'Active', 'Cabinda', 'Belize', 'sdfsd', 'sdfsdf', 'long period', 'Apartamento', 'Quarterly', '34535', '3', '3', '2', '2', 0, 0, 0, 0, '<h3>Hi!</h3><p>Write your content here...</p>', 'images/property/thumbnail/1614752359_thumbnailimg_920x519$2018_08_02_00_02_02_1430865.jpg', 'Cora Dominguez', 'nulok@mailinator.com', '+380507004256', NULL, '2021-03-06 10:24:42', '2021-03-06 10:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `house_images`
--

CREATE TABLE `house_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `house_id` bigint(20) UNSIGNED NOT NULL,
  `house_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `src_src` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `src_thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `house_images`
--

INSERT INTO `house_images` (`id`, `user_id`, `house_id`, `house_code`, `src`, `thumb`, `caption`, `src_src`, `src_thumb`, `created_at`, `updated_at`) VALUES
(1, 5, 2, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', '../images/property/original/1618182524_originaloutra dama 2.jpg', '../images/property/thumbnail/1618182524_thumboutra dama 2.jpg', 'outra dama 2.jpg', 'images/property/original/1618182524_originaloutra dama 2.jpg', 'images/property/thumbnail/1618182524_thumboutra dama 2.jpg', '2021-04-11 20:08:44', '2021-04-11 20:08:44'),
(2, 5, 2, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', '../images/property/original/1618182524_originalmocinha.jpg', '../images/property/thumbnail/1618182524_thumbmocinha.jpg', 'mocinha.jpg', 'images/property/original/1618182524_originalmocinha.jpg', 'images/property/thumbnail/1618182524_thumbmocinha.jpg', '2021-04-11 20:08:44', '2021-04-11 20:08:44'),
(3, 5, 2, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', '../images/property/original/1618182554_originalZAY_0082.JPG', '../images/property/thumbnail/1618182554_thumbZAY_0082.JPG', 'ZAY_0082.JPG', 'images/property/original/1618182554_originalZAY_0082.JPG', 'images/property/thumbnail/1618182554_thumbZAY_0082.JPG', '2021-04-11 20:09:17', '2021-04-11 20:09:17'),
(4, 5, 2, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', '../images/property/original/1618182557_originalZAY_0081.JPG', '../images/property/thumbnail/1618182557_thumbZAY_0081.JPG', 'ZAY_0081.JPG', 'images/property/original/1618182557_originalZAY_0081.JPG', 'images/property/thumbnail/1618182557_thumbZAY_0081.JPG', '2021-04-11 20:09:19', '2021-04-11 20:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `house_reviews`
--

CREATE TABLE `house_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `house_id` bigint(20) UNSIGNED NOT NULL,
  `house_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` double DEFAULT NULL,
  `approved` tinyint(4) DEFAULT NULL,
  `mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `house_reviews`
--

INSERT INTO `house_reviews` (`id`, `user_id`, `house_id`, `house_code`, `user_name`, `description`, `rating`, `approved`, `mode`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', 'Cora Dominguez', NULL, 0.5, NULL, 'true', '2021-03-05 21:07:41', '2021-03-05 21:07:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2017_12_07_122845_create_oauth_providers_table', 1),
(12, '2019_08_19_000000_create_failed_jobs_table', 1),
(24, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(25, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(26, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(27, '2016_06_01_000004_create_oauth_clients_table', 2),
(28, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(29, '2020_11_28_030851_create_announces_table', 2),
(30, '2021_01_08_212953_create_roles_table', 2),
(31, '2021_01_08_213030_create_permissions_table', 2),
(87, '2021_02_17_211630_create_appointments_table', 3),
(88, '2021_02_22_200530_create_properties_table', 3),
(89, '2021_02_24_102247_create_house_images_table', 3),
(90, '2021_02_24_102541_create_house_reviews_table', 3),
(91, '2021_03_01_224700_create_verify_services_table', 3),
(92, '2021_03_01_225705_create_promo_services_table', 3),
(93, '2021_03_04_004822_create_schedule_services_table', 4),
(98, '2021_03_06_001406_create_favourites_table', 5),
(99, '2021_03_06_121002_create_histories_table', 6),
(100, '2021_03_17_102829_create_suggests_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_providers`
--

CREATE TABLE `oauth_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refresh_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promo_services`
--

CREATE TABLE `promo_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `house_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_county` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fixed_amount_per_day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt_promo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo_services`
--

INSERT INTO `promo_services` (`id`, `user_id`, `house_code`, `username`, `phone`, `email`, `house_city`, `house_county`, `house_district`, `house_street`, `fixed_amount_per_day`, `total_days`, `total_amount`, `receipt_promo`, `request_type`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, '1qwl0x4364dcowssg808o4ccggwkgwo', 'Xena Zimmerman', '(+244) 333-555-666', 'fyme@mailinator.com', 'Benguela', 'Baia Farta', 'edsad', 'sdsadsa', '200', '10', '2000', 'images/receipt/promotion/1616029785_NAT_2342.jpg', 'promo', NULL, 'pending', '2021-03-17 23:09:45', '2021-03-17 23:09:45'),
(2, 5, '1qwl0x4364dcowssg808o4ccggwkgwo', 'Xena Zimmerman', '(+244) 333-555-666', 'fyme@mailinator.com', 'Benguela', 'Baia Farta', 'edsad', 'sdsadsa', '200', '30', '6000', 'images/receipt/promotion/1616085524_outra dama 2.jpg', 'promo', NULL, 'pending', '2021-03-18 14:38:45', '2021-03-18 14:38:45'),
(3, 5, '1qwl0x4364dcowssg808o4ccggwkgwo', 'Xena Zimmerman', '(+244) 333-555-666', 'fyme@mailinator.com', 'Benguela', 'Baia Farta', 'edsad', 'sdsadsa', '200', '15', '3000', 'images/receipt/promotion/1616085603_ZAY_0028.JPG', 'promo', NULL, 'pending', '2021-03-18 14:40:03', '2021-03-18 14:40:03'),
(4, 5, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', 'Xena Zimmerman', '(+244) 333-555-666', 'fyme@mailinator.com', 'Cabinda', 'Belize', 'sdfsd', 'sdfsdf', '200', '85', '17000', 'images/receipt/promotion/1616157018_photo_2021-03-12_16-15-37.jpg', 'promo', NULL, 'pending', '2021-03-19 10:30:18', '2021-03-19 10:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `house_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `county` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'long period',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_METHOD` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `living_room` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kitchen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bathroom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seal` tinyint(1) NOT NULL DEFAULT '0',
  `furniture` tinyint(1) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `verification` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/property/thumbnail/no-image.png',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `add_images` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `user_id`, `house_code`, `status`, `city`, `county`, `district`, `street`, `period`, `type`, `payment_METHOD`, `price`, `room`, `living_room`, `kitchen`, `bathroom`, `seal`, `furniture`, `state`, `verification`, `description`, `profile`, `username`, `email`, `phone`, `add_images`, `slug`, `created_at`, `updated_at`) VALUES
(2, 5, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', 'Active', 'Cabinda', 'Belize', 'sdfsd', 'sdfsdf', 'long period', 'Apartamento', 'Monthly', '34535', '3', '3', '2', '2', 0, 0, 1, 0, '<h3>Hi!</h3><p>Write your content here...</p>', 'images/property/thumbnail/1617566543_thumbnailprot3.png', 'you', 'fyme@mailinator.com', '(+244) 333-555-666', 'has', NULL, '2021-03-03 04:19:19', '2021-04-11 20:08:44'),
(5, 5, '6aru7tq2qhwkggokgkoowsk0wwggg8k', 'Active', 'Cuando Cubango', 'Dirico', '435dsfsdf', 'dsfsdf54 5', 'long period', 'Vivenda', 'Monthly', '7668', '6', '2', '3', '3', 0, 0, 1, 0, '<h3>Hi!</h3><p>Write your content here...</p>', 'images/property/thumbnail/1617565948_thumbnaillaravel.jpg', 'you', 'fyme@mailinator.com', '(+244) 333-555-666', 'hasnot', NULL, '2021-04-04 16:52:29', '2021-04-11 13:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slug`, `name`, `created_at`, `updated_at`) VALUES
(1, 'developer', 'Developer', NULL, NULL),
(2, 'admin', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_services`
--

CREATE TABLE `schedule_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `house_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_county` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule_services`
--

INSERT INTO `schedule_services` (`id`, `user_id`, `house_code`, `username`, `phone`, `email`, `address`, `house_city`, `house_county`, `house_district`, `house_street`, `price`, `date`, `time`, `receipt`, `request_type`, `description`, `status`, `owner`, `created_at`, `updated_at`) VALUES
(1, 5, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', 'Xena Zimmerman', '(+244) 333-555-666', 'fyme@mailinator.com', 'HEROIV KRUT', 'Cabinda', 'Belize', 'sdfsd', 'sdfsdf', '200', '2021-03-04', 'Thu Mar 04 2021 03:10:00 GMT+0200 (Eastern European Standard Time)', 'images/receipt/visit/1614819455_202100716R.pdf', 'Schedule Visit', NULL, 'pending', '3', '2021-03-03 22:57:35', '2021-03-03 22:57:35'),
(2, 2, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', 'Cora Dominguez', '(+244) 333-555-666', 'nulok@mailinator.com', 'HEROIV KRUT', 'Cabinda', 'Belize', 'sdfsd', 'sdfsdf', '200', '2021-03-04', 'Thu Mar 04 2021 01:10:00 GMT+0200 (Eastern European Standard Time)', 'images/receipt/visit/1614819691_Captura de tela de 2021-02-25 11-42-58.png', 'Schedule Visit', NULL, 'resolved', '5', '2021-03-03 23:01:31', '2021-03-03 23:01:31'),
(3, 2, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', 'Cora Dominguez', '(+244) 333-555-666', 'nulok@mailinator.com', 'HEROIV KRUT', 'Cabinda', 'Belize', 'sdfsd', 'sdfsdf', '200', '2021-03-26', '3:20:00', 'images/receipt/visit/1614854838_Captura de tela de 2021-02-25 11-51-15.png', 'Schedule Visit', NULL, 'pending', '5', '2021-03-04 08:47:18', '2021-03-14 07:41:44'),
(4, 2, '1qwl0x4364dcowssg808o4ccggwkgwo', 'Cora Dominguez', '(+244) 333-555-666', 'nulok@mailinator.com', 'HEROIV KRUT', 'Benguela', 'Baia Farta', 'edsad', 'sdsadsa', '200', '2021-05-12', '2:30:10', 'images/receipt/visit/1614953508_202100716R.pdf', 'Schedule Visit', NULL, 'confirmed', '5', '2021-03-05 12:11:48', '2021-03-14 07:41:07'),
(5, 2, '1qwl0x4364dcowssg808o4ccggwkgwo', 'Cora Dominguez', '+380507004256', 'nulok@mailinator.com', 'rua hhhhh', 'Benguela', 'Baia Farta', 'edsad', 'sdsadsa', '200', '2021-03-14', '3:20:00', 'images/receipt/visit/1615043470_202100716R.pdf', 'Schedule Visit', NULL, 'confirmed', '5', '2021-03-06 13:11:10', '2021-03-14 07:41:49'),
(6, 2, '6aru7tq2qhwkggokgkoowsk0wwggg8k', 'Cora Dominguez', '+380507004256', 'nulok@mailinator.com', 'rua hhhhh', 'Cuando Cubango', 'Dirico', '435dsfsdf', 'dsfsdf54 5', '200', '2021-04-12', 'Sun Apr 11 2021 01:10:00 GMT+0300 (Eastern European Summer Time)', 'images/receipt/visit/1618096504_Centro proficional  - Ester Gomes.pdf', 'Schedule Visit', NULL, 'pending', 'you', '2021-04-10 20:15:04', '2021-04-10 20:15:04'),
(7, 2, '6aru7tq2qhwkggokgkoowsk0wwggg8k', 'Cora Dominguez', '+380507004256', 'nulok@mailinator.com', 'rua hhhhh', 'Cuando Cubango', 'Dirico', '435dsfsdf', 'dsfsdf54 5', '200', '2021-04-12', '3:20', 'images/receipt/visit/1618097797_horario s16.pdf', 'Schedule Visit', NULL, 'pending', 'you', '2021-04-10 20:36:37', '2021-04-10 20:36:37'),
(8, 2, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', 'Cora Dominguez', '+380507004256', 'nulok@mailinator.com', 'rua hhhhh', 'Cabinda', 'Belize', 'sdfsd', 'sdfsdf', '200', '2021-04-15', '2:00', 'images/receipt/visit/1618098614_traded.png', 'Schedule Visit', NULL, 'pending', 'you', '2021-04-10 20:50:14', '2021-04-10 20:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `suggests`
--

CREATE TABLE `suggests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `yourname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youraddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yourphone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ownername` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owneraddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ownerphone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suggests`
--

INSERT INTO `suggests` (`id`, `yourname`, `youraddress`, `yourphone`, `ownername`, `owneraddress`, `ownerphone`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ariane Cristina - Gomes de Menezes', 'ttet', '345353', 'JOSE PINTO', '345345', '345345', 'unread', '2021-03-17 09:20:47', '2021-03-17 09:20:47'),
(2, 'PRODEMGE MINAS PRODEMGE', 'terter', '56546', 'Ariane Cristina - Gomes de Menezes', 'fghfgh', '64564', 'unread', '2021-03-17 09:39:18', '2021-03-17 09:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `identity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `confirmed`, `status`, `identity`, `birth`, `phone`, `photo`, `address`, `city`, `country`, `slug`, `activity`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Cora Dominguez', 'nulok@mailinator.com', NULL, '$2y$10$Ai0gSgwWG9F9wg8dDBtxd.xRnC6XPM1tqSl8j5ZYBKA13qL7HJdTu', 'user', 0, 'Active', '88900889AB334', '20-06-1999', '+380507004256', NULL, 'rua hhhhh', 'luanda', 'Angola', NULL, NULL, NULL, '2020-11-28 15:01:59', '2021-03-20 13:05:08'),
(3, 'Katell Woodard', 'mozonaki@mailinator.com', NULL, '$2y$10$hF9G9SQbu0c7VtqrAzBHZ.kADaR0L43aUPGQiCKa2bBmdYGFS2NIq', 'employer', 0, 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-06 03:55:05', '2020-12-06 03:55:05'),
(4, 'Bradley Greer', 'vofy@mailinator.com', NULL, '$2y$10$UUwfYMyYlxzNwsoyd0LznOgcmg2FzEfVuWCcp1fbEgGZONb.eBCIu', 'admin', 0, 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-08 21:17:04', '2021-01-08 21:17:04'),
(5, 'Xena Zimmerman', 'fyme@mailinator.com', NULL, '$2y$10$TDRr5qpDLC8AnuGFAz/Z/eZTlkh.xmHIsaxT3LkHsHneyHEB83NXG', 'owner', 0, 'Active', '000000000II000', '03-03-2021', '(+244) 333-555-666', '/images/profile/thumbnail/1617543707_thumbnailIMG-20210108-WA0010.jpg', 'HEROIV KRUT', 'SUMY', 'Ukraine', NULL, NULL, NULL, '2021-02-03 20:40:32', '2021-04-04 10:41:48'),
(8, 'Allegra Valdez', 'volibyvo@mailinator.com', NULL, '$2y$10$uk1Q9qCFQRXgAFmdukPFdeQRHisyOjTvtPKOSAW3HzPS0LUQPwL12', 'owner', 0, 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, '2021-03-14 13:17:09', '2021-03-14 13:17:09'),
(9, 'Kermit Clay', 'fidyz@mailinator.com', NULL, '$2y$10$k8uShsAvm/QzWYuAFv/K8eu36je8DSEkHtyxePEwrHjnwFcxPyqwm', 'owner', 0, 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Intermediate', NULL, '2021-03-14 13:35:31', '2021-03-14 13:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `verify_services`
--

CREATE TABLE `verify_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `house_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_county` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `house_street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receipt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verify_services`
--

INSERT INTO `verify_services` (`id`, `user_id`, `house_code`, `username`, `phone`, `email`, `house_city`, `house_county`, `house_district`, `house_street`, `price`, `date`, `time`, `receipt`, `request_type`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, 5, '27o8zwev5xgk84ck0c8ssw4kwoo48w0', 'Xena Zimmerman', '(+244) 333-555-666', 'fyme@mailinator.com', 'Cabinda', 'Belize', 'sdfsd', 'sdfsdf', '400', '2021-03-18', '1:10:20', 'images/receipt/verification/1616069034_IMG-20210108-WA0010.jpg', 'verification', NULL, 'pending', '2021-03-18 10:03:54', '2021-03-18 10:03:54'),
(3, 5, '1qwl0x4364dcowssg808o4ccggwkgwo', 'Xena Zimmerman', '(+244) 333-555-666', 'fyme@mailinator.com', 'Benguela', 'Baia Farta', 'edsad', 'sdsadsa', '400', '2021-03-20', '1:10:00', 'images/receipt/verification/1616085467_IMG-20210108-WA0010.jpg', 'verification', NULL, 'pending', '2021-03-18 14:37:47', '2021-03-18 14:37:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announces`
--
ALTER TABLE `announces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announces_user_id_foreign` (`user_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourites_user_id_foreign` (`user_id`),
  ADD KEY `favourites_property_id_foreign` (`property_id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `histories_user_id_foreign` (`user_id`),
  ADD KEY `histories_property_id_foreign` (`property_id`);

--
-- Indexes for table `house_images`
--
ALTER TABLE `house_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `house_images_user_id_foreign` (`user_id`),
  ADD KEY `house_images_house_id_foreign` (`house_id`);

--
-- Indexes for table `house_reviews`
--
ALTER TABLE `house_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `house_reviews_user_id_foreign` (`user_id`),
  ADD KEY `house_reviews_house_id_foreign` (`house_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_providers`
--
ALTER TABLE `oauth_providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_providers_user_id_foreign` (`user_id`),
  ADD KEY `oauth_providers_provider_user_id_index` (`provider_user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_services`
--
ALTER TABLE `promo_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_services_user_id_foreign` (`user_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_services`
--
ALTER TABLE `schedule_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_services_user_id_foreign` (`user_id`);

--
-- Indexes for table `suggests`
--
ALTER TABLE `suggests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `verify_services`
--
ALTER TABLE `verify_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `verify_services_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announces`
--
ALTER TABLE `announces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `house_images`
--
ALTER TABLE `house_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `house_reviews`
--
ALTER TABLE `house_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `oauth_providers`
--
ALTER TABLE `oauth_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promo_services`
--
ALTER TABLE `promo_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedule_services`
--
ALTER TABLE `schedule_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suggests`
--
ALTER TABLE `suggests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `verify_services`
--
ALTER TABLE `verify_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announces`
--
ALTER TABLE `announces`
  ADD CONSTRAINT `announces_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `histories`
--
ALTER TABLE `histories`
  ADD CONSTRAINT `histories_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `house_images`
--
ALTER TABLE `house_images`
  ADD CONSTRAINT `house_images_house_id_foreign` FOREIGN KEY (`house_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `house_images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `house_reviews`
--
ALTER TABLE `house_reviews`
  ADD CONSTRAINT `house_reviews_house_id_foreign` FOREIGN KEY (`house_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `house_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `oauth_providers`
--
ALTER TABLE `oauth_providers`
  ADD CONSTRAINT `oauth_providers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promo_services`
--
ALTER TABLE `promo_services`
  ADD CONSTRAINT `promo_services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedule_services`
--
ALTER TABLE `schedule_services`
  ADD CONSTRAINT `schedule_services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `verify_services`
--
ALTER TABLE `verify_services`
  ADD CONSTRAINT `verify_services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
