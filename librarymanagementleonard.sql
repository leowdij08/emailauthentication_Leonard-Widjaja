-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 25, 2024 at 05:49 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librarymanagementleonard`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` bigint UNSIGNED NOT NULL DEFAULT '0',
  `stock` int UNSIGNED NOT NULL DEFAULT '0',
  `published_date` date NOT NULL,
  `category` enum('classic','adventure','philosophy','science','history','technology','psychology') COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_link` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `catalogue_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'book'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `publisher`, `description`, `price`, `stock`, `published_date`, `category`, `purchase_link`, `created_at`, `updated_at`, `catalogue_type`) VALUES
(1, 'Meditations', 'Marcus Aurelius', 'Penguin Classics', 'A series of personal writings by Marcus Aurelius on Stoic philosophy.', 80000, 15, '0180-01-01', 'philosophy', 'https://example.com/meditations', NULL, NULL, 'book'),
(2, 'The Adventures of Sherlock Holmes', 'Arthur Conan Doyle', 'George Newnes', 'A collection of twelve short stories featuring the detective Sherlock Holmes.', 120000, 10, '1892-10-14', 'adventure', 'https://example.com/sherlock-holmes', NULL, NULL, 'book'),
(3, 'The Selfish Gene', 'Richard Dawkins', 'Oxford University Press', 'A popular science book on the evolution of life and gene-centered view of evolution.', 135000, 12, '1976-03-13', 'science', NULL, NULL, NULL, 'book'),
(4, 'Guns, Germs, and Steel', 'Jared Diamond', 'W. W. Norton & Company', 'A study of the factors that influenced the development of civilizations.', 180000, 8, '1997-03-01', 'history', 'https://example.com/guns-germs-steel', NULL, NULL, 'book'),
(5, 'Thinking, Fast and Slow', 'Daniel Kahneman', 'Farrar, Straus and Giroux', 'A groundbreaking book on behavioral psychology and decision-making processes.', 160000, 10, '2011-10-25', 'psychology', 'https://example.com/thinking-fast-slow', NULL, NULL, 'book');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_items`
--

CREATE TABLE `borrowed_items` (
  `id` bigint UNSIGNED NOT NULL,
  `borrower_id` bigint UNSIGNED NOT NULL,
  `borrowable_id` bigint UNSIGNED NOT NULL,
  `borrowable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `borrowed_at` date NOT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collection_update_requests`
--

CREATE TABLE `collection_update_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catalogue_id` bigint UNSIGNED NOT NULL,
  `new_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_publisher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_datePublished` date DEFAULT NULL,
  `new_price` decimal(8,2) DEFAULT NULL,
  `new_stock` int DEFAULT NULL,
  `new_onlineLink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `c_d_s`
--

CREATE TABLE `c_d_s` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint NOT NULL DEFAULT '0',
  `stock` int NOT NULL DEFAULT '0',
  `datePublished` date NOT NULL,
  `genre` enum('fiction','nonfiction','fantasy','mystery','science_fiction','biography','rock','jazz','pop') COLLATE utf8mb4_unicode_ci NOT NULL,
  `onlineLink` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `catalogue_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CD'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `c_d_s`
--

INSERT INTO `c_d_s` (`id`, `title`, `author`, `publisher`, `description`, `price`, `stock`, `datePublished`, `genre`, `onlineLink`, `catalogue_type`) VALUES
(1, 'Abbey Road', 'The Beatles', 'Apple Records', 'The iconic album from The Beatles featuring classics like \"Come Together\" and \"Here Comes the Sun\".', 250000, 15, '1969-09-26', 'rock', 'https://example.com/abbey-road', 'CD'),
(2, 'Rumours', 'Fleetwood Mac', 'Warner Bros. Records', 'One of the best-selling albums of all time, featuring timeless tracks like \"Go Your Own Way\" and \"Dreams\".', 220000, 10, '1977-02-04', 'rock', 'https://example.com/rumours', 'CD'),
(3, 'Kind of Blue', 'Miles Davis', 'Columbia Records', 'A masterpiece of jazz, regarded as one of the greatest albums of all time, featuring Miles Davis and John Coltrane.', 180000, 20, '1959-08-17', 'jazz', 'https://example.com/kind-of-blue', 'CD'),
(4, '25', 'Adele', 'XL Recordings', 'Adele\'s record-breaking album, featuring chart-topping hits like \"Hello\" and \"When We Were Young\".', 200000, 18, '2015-11-20', 'pop', 'https://example.com/25', 'CD'),
(5, 'Thriller', 'Michael Jackson', 'Epic Records', 'The best-selling album of all time, featuring hits like \"Billie Jean\", \"Beat It\", and \"Thriller\".', 300000, 25, '1982-11-30', 'pop', 'https://example.com/thriller', 'CD');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `final_year_projects`
--

CREATE TABLE `final_year_projects` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `university` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abstract` text COLLATE utf8mb4_unicode_ci,
  `available_copies` int UNSIGNED NOT NULL DEFAULT '0',
  `publication_date` date NOT NULL,
  `project_url` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'final year project',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `final_year_projects`
--

INSERT INTO `final_year_projects` (`id`, `title`, `author`, `university`, `abstract`, `available_copies`, `publication_date`, `project_url`, `project_type`, `created_at`, `updated_at`) VALUES
(1, 'AI-Powered Agriculture: Precision Farming System', 'Liam Peterson', 'AgriTech University', 'A precision farming system leveraging AI and IoT to monitor crop health, optimize irrigation, and improve yield efficiency.', 5, '2024-03-10', 'https://example.com/project/precision-farming-ai', 'final year project', NULL, NULL),
(2, 'Blockchain for Supply Chain Transparency', 'Sophia Jackson', 'TechWorld University', 'A blockchain-based solution for ensuring transparency and traceability in supply chain operations.', 7, '2023-09-15', 'https://example.com/project/blockchain-supply-chain', 'final year project', NULL, NULL),
(3, 'Smart Home Automation Using IoT', 'Ethan Brown', 'FutureTech Institute', 'A project focusing on creating a smart home ecosystem with IoT-enabled devices for energy efficiency and security.', 4, '2023-12-20', NULL, 'final year project', NULL, NULL),
(4, 'Virtual Reality for Medical Training', 'Olivia Martinez', 'HealthTech University', 'Exploring the use of VR to simulate medical scenarios, enhancing the training experience for healthcare professionals.', 6, '2024-01-25', 'https://example.com/project/vr-medical-training', 'final year project', NULL, NULL),
(5, 'Machine Learning for Financial Forecasting', 'Ava Wilson', 'DataScience Academy', 'A project using machine learning models to predict stock market trends and assist in financial decision-making.', 8, '2023-11-30', 'https://example.com/project/ml-financial-forecasting', 'final year project', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abstract` text COLLATE utf8mb4_unicode_ci,
  `price` bigint UNSIGNED NOT NULL DEFAULT '0',
  `available_copies` int UNSIGNED NOT NULL DEFAULT '0',
  `release_date` date NOT NULL,
  `volume` smallint UNSIGNED NOT NULL,
  `issue` smallint UNSIGNED NOT NULL,
  `part` smallint UNSIGNED DEFAULT NULL,
  `access_url` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `catalogue_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'journal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `title`, `author`, `publisher`, `abstract`, `price`, `available_copies`, `release_date`, `volume`, `issue`, `part`, `access_url`, `created_at`, `updated_at`, `catalogue_type`) VALUES
(1, 'Journal of Artificial Intelligence Research', 'Dr. Susan Carter', 'AI Research Society', 'A peer-reviewed journal covering advancements, applications, and ethical considerations in artificial intelligence.', 150000, 10, '2024-02-15', 12, 3, 1, 'https://example.com/journal/ai-research', NULL, NULL, 'journal'),
(2, 'Sustainability and Climate Change Journal', 'Dr. Jonathan Green', 'Earth Matters Press', 'A journal focused on global sustainability efforts, climate science, and renewable energy innovations.', 180000, 12, '2023-11-01', 22, 5, 3, 'https://example.com/journal/sustainability-climate', NULL, NULL, 'journal'),
(3, 'Global Economics and Policy Journal', 'Prof. Mark Taylor', 'Economics Press International', 'A journal examining economic policies, global markets, and emerging trends in financial systems.', 200000, 8, '2024-01-10', 30, 4, 5, 'https://example.com/journal/global-economics', NULL, NULL, 'journal'),
(4, 'Journal of Advanced Robotics', 'Dr. Alice Wang', 'TechFuture Publishing', 'An in-depth journal on robotics advancements, automation technologies, and real-world applications.', 160000, 15, '2024-03-20', 9, 2, 7, 'https://example.com/journal/advanced-robotics', NULL, NULL, 'journal'),
(5, 'Health and Wellness Journal', 'Dr. Clara Bennett', 'Wellness Publications', 'A journal promoting new research in health, nutrition, mental well-being, and fitness.', 140000, 18, '2023-12-05', 7, 1, 8, 'https://example.com/journal/health-wellness', NULL, NULL, 'journal');

-- --------------------------------------------------------

--
-- Table structure for table `library_inventory`
--

CREATE TABLE `library_inventory` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` bigint UNSIGNED NOT NULL DEFAULT '0',
  `stock` int UNSIGNED NOT NULL DEFAULT '0',
  `published_date` date NOT NULL,
  `category` enum('classic','adventure','philosophy','science','history','technology','psychology') COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_link` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(24, '0001_01_01_000000_create_users_table', 1),
(25, '0001_01_01_000001_create_cache_table', 1),
(26, '0001_01_01_000002_create_jobs_table', 1),
(27, '2024_10_31_005437_create_books_table', 1),
(28, '2024_10_31_005603_create_journals_table', 1),
(29, '2024_11_09_042406_add_catalogue_type_to_books_and_journals', 1),
(30, '2024_11_09_044826_create_c_d_s_table', 1),
(31, '2024_11_09_044842_create_newspapers_table', 1),
(32, '2024_11_09_044852_create_final_year_projects_table', 1),
(33, '2024_11_23_123454_add_role_to_users_table', 1),
(34, '2024_11_23_132746_create_notifications_table', 1),
(35, '2024_11_24_023315_create_collection_update_requests_table', 1),
(36, '2024_11_24_062059_create_borrowed_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newspapers`
--

CREATE TABLE `newspapers` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint NOT NULL DEFAULT '0',
  `stock` int NOT NULL DEFAULT '0',
  `datePublished` date NOT NULL,
  `onlineLink` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `catalogue_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'newspaper'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newspapers`
--

INSERT INTO `newspapers` (`id`, `title`, `author`, `publisher`, `description`, `price`, `stock`, `datePublished`, `onlineLink`, `catalogue_type`) VALUES
(1, 'Global News Today', 'Jessica Morgan', 'Global Media Corp.', 'A reliable daily newspaper providing the latest updates on international events, trade policies, and emerging trends.', 10000, 150, '2024-01-01', 'https://example.com/newspaper/global-news-today', 'newspaper'),
(2, 'Tech Innovators Weekly', 'Alan Stevenson', 'NextGen Publications', 'A weekly publication showcasing breakthroughs in technology, AI research, and futuristic gadgets.', 12000, 90, '2023-12-15', 'https://example.com/newspaper/tech-innovators-weekly', 'newspaper'),
(3, 'The Sustainability Digest', 'Rachel Williams', 'EcoAware Media', 'An essential resource for eco-conscious readers, featuring sustainable living tips, and environmental case studies.', 8000, 120, '2023-11-20', 'https://example.com/newspaper/sustainability-digest', 'newspaper'),
(4, 'Art & Culture Review', 'Michael Carter', 'Creative Minds Press', 'A bi-weekly newspaper offering in-depth analyses of contemporary art, theater, and cultural events worldwide.', 7000, 50, '2023-12-01', 'https://example.com/newspaper/art-culture-review', 'newspaper'),
(5, 'Sports Action Today', 'Oliver James', 'SportSphere Media', 'A daily sports-focused publication featuring match updates, player statistics, and expert analyses.', 6000, 200, '2024-01-15', 'https://example.com/newspaper/sports-action-today', 'newspaper');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','librarian','student','lecturer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowed_items`
--
ALTER TABLE `borrowed_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowed_items_borrower_id_foreign` (`borrower_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `collection_update_requests`
--
ALTER TABLE `collection_update_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collection_update_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `c_d_s`
--
ALTER TABLE `c_d_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `final_year_projects`
--
ALTER TABLE `final_year_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `library_inventory`
--
ALTER TABLE `library_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newspapers`
--
ALTER TABLE `newspapers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `borrowed_items`
--
ALTER TABLE `borrowed_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection_update_requests`
--
ALTER TABLE `collection_update_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_d_s`
--
ALTER TABLE `c_d_s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_year_projects`
--
ALTER TABLE `final_year_projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `library_inventory`
--
ALTER TABLE `library_inventory`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `newspapers`
--
ALTER TABLE `newspapers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed_items`
--
ALTER TABLE `borrowed_items`
  ADD CONSTRAINT `borrowed_items_borrower_id_foreign` FOREIGN KEY (`borrower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `collection_update_requests`
--
ALTER TABLE `collection_update_requests`
  ADD CONSTRAINT `collection_update_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
