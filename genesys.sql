-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2019 at 02:43 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `genesys`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `campaign_id` varchar(255) NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `target_audience` enum('remaja','dewasa','orang tua') NOT NULL,
  `gender` enum('pria','wanita') NOT NULL,
  `job` enum('karyawan','pegawai','pengusaha') NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `custom_status` varchar(255) NOT NULL,
  `service_type` enum('social media marketing','pay per click ads') NOT NULL,
  `social_medias` set('facebook','instagram','twitter','linkedin') NOT NULL,
  `target_like` int(11) NOT NULL,
  `target_view` int(11) NOT NULL,
  `target_click` int(11) NOT NULL,
  `time_period` int(11) NOT NULL,
  `final_cost` int(11) NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `is_reviewed` tinyint(1) NOT NULL DEFAULT '0',
  `payment_id` varchar(36) NOT NULL,
  `result` enum('reviewed','accepted','declined','finished','rated') NOT NULL DEFAULT 'reviewed',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`campaign_id`, `user_id`, `target_audience`, `gender`, `job`, `company_name`, `custom_status`, `service_type`, `social_medias`, `target_like`, `target_view`, `target_click`, `time_period`, `final_cost`, `is_paid`, `is_reviewed`, `payment_id`, `result`, `created_at`) VALUES
('58a3af28-e256-4731-89e1-bdf92c4dff8c', '66', 'dewasa', 'wanita', 'karyawan', 'PT Lion Group tbk', 'Ayo Naik Lion ke Bali!!', 'social media marketing', 'facebook,instagram', 3000, 9000000, 600000, 216, 108000000, 0, 0, '', 'declined', '2019-06-24 06:12:49'),
('86a631e6-1e98-43ce-84af-4c181ff1df10', '66', 'remaja', 'pria', 'pegawai', 'PT Lion Group tbk', 'Lion Parcel Solusi Pengiriman Anda!', 'social media marketing', 'instagram,twitter', 100, 2000000, 1000, 48, 24000000, 1, 0, '', 'accepted', '2019-06-24 06:13:35'),
('b5855724-949f-4aa5-8222-93858dcf662b', '66', 'remaja', 'pria', 'pegawai', 'PT Lion Group tbk', 'tes1', 'pay per click ads', '', 100, 25000, 1000, 4, 1600000, 1, 0, '', 'accepted', '2019-06-25 04:13:07'),
('d4557e49-48ee-45b6-b213-412aac1ec47b', '66', 'orang tua', 'pria', 'pengusaha', 'PT Lion Group tbk', 'Ayo Kumpulkan Point Lion Mu!', 'social media marketing', 'facebook', 500, 3000000, 1000, 72, 36000000, 1, 1, '', 'rated', '2019-06-24 06:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` varchar(255) NOT NULL,
  `payment_type` enum('credit','debit') DEFAULT NULL,
  `card_number` varchar(255) NOT NULL,
  `card_exp` varchar(255) NOT NULL,
  `cvv` varchar(32) NOT NULL,
  `account_name` varchar(32) NOT NULL,
  `account_number` varchar(32) NOT NULL,
  `ammount` int(11) NOT NULL,
  `receipt` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment_type`, `card_number`, `card_exp`, `cvv`, `account_name`, `account_number`, `ammount`, `receipt`, `created_at`) VALUES
('58a3af28-e256-4731-89e1-bdf92c4dff8c', NULL, '', '', '', '', '', 108000000, '', '2019-06-24 06:12:49'),
('81142ea0-42ff-4f39-a954-77e74a75b44d', NULL, '', '', '', '', '', 0, '', '2019-06-25 04:08:57'),
('8289f7c1-2137-4978-bdc3-9a29e02b8083', NULL, '', '', '', '', '', 14500000, '', '2019-06-24 06:19:12'),
('86a631e6-1e98-43ce-84af-4c181ff1df10', 'debit', '', '', '', 'RusdyK', '87372723', 24000000, 'BCA.jpg', '2019-06-24 06:13:35'),
('ab42e63f-99f3-467d-b286-011ac961b4ac', NULL, '', '', '', '', '', 0, '', '2019-06-25 04:10:32'),
('b5855724-949f-4aa5-8222-93858dcf662b', 'credit', '313354', '01/22', '1234', '', '', 1600000, '', '2019-06-25 04:13:07'),
('d4557e49-48ee-45b6-b213-412aac1ec47b', 'debit', '', '', '', 'RusdyK', '87372723', 36000000, 'BCA.jpg', '2019-06-24 06:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `campaign_id` varchar(255) NOT NULL,
  `current_like` int(11) NOT NULL,
  `current_view` int(11) NOT NULL,
  `current_click` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remaja` int(11) NOT NULL,
  `dewasa` int(11) NOT NULL,
  `orang_tua` int(11) NOT NULL,
  `pria` int(11) NOT NULL,
  `wanita` int(11) NOT NULL,
  `pegawai` int(11) NOT NULL,
  `karyawan` int(11) NOT NULL,
  `pengusaha` int(11) NOT NULL,
  `facebook` int(11) NOT NULL,
  `twitter` int(11) NOT NULL,
  `instagram` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `campaign_id`, `current_like`, `current_view`, `current_click`, `created_at`, `remaja`, `dewasa`, `orang_tua`, `pria`, `wanita`, `pegawai`, `karyawan`, `pengusaha`, `facebook`, `twitter`, `instagram`) VALUES
(211, 'd4557e49-48ee-45b6-b213-412aac1ec47b', 0, 0, 0, '2019-06-23 23:25:18', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(212, '86a631e6-1e98-43ce-84af-4c181ff1df10', 0, 0, 0, '2019-06-23 23:25:18', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(213, 'd4557e49-48ee-45b6-b213-412aac1ec47b', 10, 1000, 100, '2019-06-25 17:00:00', 900, 10, 90, 200, 800, 200, 300, 500, 1000, 0, 0),
(214, 'd4557e49-48ee-45b6-b213-412aac1ec47b', 20, 3000, 2000, '2019-06-27 17:00:00', 2100, 300, 600, 1000, 2000, 200, 1800, 1000, 3000, 0, 0),
(215, 'b5855724-949f-4aa5-8222-93858dcf662b', 0, 0, 0, '2019-06-24 21:13:51', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `testimonial_id` int(255) NOT NULL,
  `campaign_id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `result` enum('reviewed','accepted','declined') NOT NULL DEFAULT 'reviewed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`testimonial_id`, `campaign_id`, `name`, `company`, `user_id`, `img`, `rating`, `comment`, `created_at`, `result`) VALUES
(18, 'd4557e49-48ee-45b6-b213-412aac1ec47b', 'Rusdy Kirana', 'PT Lion Group tbk', '66', 'ron-weasley-sad-person.jpeg', 5, 'Hebat!\nCampaign saya selesai pada waktunya dan hasilnya sangat memuaskan! Bisnis saya tumbuh sampai 140% berkat jasa ini!', '2019-06-24 06:28:20', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(36) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `phone_number` varchar(32) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`, `company_name`, `phone_number`, `img`, `role`) VALUES
(63, 'admin', '1a1dc91c907325c69271ddf0c944bc72', 'admin@genesys.com', 'admin', '-', 'PT Genesys Sarana', '0812123123', 'default.jpg', 'admin'),
(64, 'edy', '1a1dc91c907325c69271ddf0c944bc72', 'edywilliam@wings.com', 'Edy', 'William', 'PT Wings Group', '081214422', 'default.jpg', 'user'),
(65, 'rudy', '1a1dc91c907325c69271ddf0c944bc72', 'rudy@gmail.com', 'Rudy', 'Salim', 'PT Indo Marco', '084523232', 'default.jpg', 'user'),
(66, 'rusdy', '1a1dc91c907325c69271ddf0c944bc72', 'rusdi@lionair.com', 'Rusdy', 'Kirana', 'PT Lion Group tbk', '087862623', 'ron-weasley-sad-person.jpeg', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`campaign_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`testimonial_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `testimonial_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
