-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2025 at 03:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finals_sam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `email` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin1', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `medal` int(11) NOT NULL,
  `flag` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `medal`, `flag`) VALUES
(1, 'United States', 100, '../assets/flags/usa.JPG'),
(2, 'China', 84, '../assets/flags/china.JPG'),
(3, 'Russia', 75, '../assets/flags/russia.JPG'),
(4, 'France', 85, '../assets/flags/france.JPG'),
(5, 'Germany', 75, '../assets/flags/germany.JPG'),
(6, 'United Kingdom', 63, '../assets/flags/uk.JPG'),
(7, 'Japan', 61, '../assets/flags/japan.JPG'),
(8, 'Australia', 53, '../assets/flags/australia.JPG'),
(9, 'Italy', 50, '../assets/flags/italy.JPG'),
(10, 'South Korea', 45, '../assets/flags/korea.JPG'),
(11, 'Canada', 38, '0'),
(12, 'Brazil', 30, '0'),
(13, 'Netherlands', 32, '0'),
(14, 'India', 26, '0'),
(15, 'Sweden', 21, '0');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `team1_id` int(11) NOT NULL,
  `team2_id` int(11) NOT NULL,
  `team1_odds` decimal(5,2) NOT NULL,
  `team2_odds` decimal(5,2) NOT NULL,
  `draw_odds` decimal(5,2) DEFAULT NULL,
  `game_date` datetime NOT NULL,
  `status` enum('Upcoming','Ongoing','Completed') DEFAULT 'Upcoming',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `event_name`, `team1_id`, `team2_id`, `team1_odds`, `team2_odds`, `draw_odds`, `game_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Volleyball', 1, 2, 1.50, 2.70, 3.00, '2025-01-10 18:00:00', 'Upcoming', '2025-01-05 13:54:16', '2025-01-05 13:54:16'),
(2, 'Football', 3, 4, 1.80, 3.10, 3.50, '2025-01-11 20:00:00', 'Upcoming', '2025-01-05 13:54:16', '2025-01-05 13:54:16'),
(3, 'Basketball', 5, 6, 1.60, 2.20, 2.90, '2025-01-12 16:00:00', 'Upcoming', '2025-01-05 13:54:16', '2025-01-05 13:54:16'),
(4, 'Tennis', 7, 8, 1.40, 3.50, 2.70, '2025-01-13 14:00:00', 'Upcoming', '2025-01-05 13:54:16', '2025-01-05 13:54:16'),
(5, 'Swimming', 9, 10, 1.70, 2.90, NULL, '2025-01-14 10:00:00', 'Upcoming', '2025-01-05 13:54:16', '2025-01-05 13:54:16'),
(6, 'Track and Field', 11, 12, 1.55, 3.20, 2.85, '2025-01-15 12:00:00', 'Upcoming', '2025-01-05 13:54:16', '2025-01-05 13:54:16'),
(7, 'Cycling', 13, 14, 1.65, 2.45, 2.80, '2025-01-16 09:00:00', 'Upcoming', '2025-01-05 13:54:16', '2025-01-05 13:54:16'),
(8, 'Gymnastics', 15, 1, 1.35, 4.00, 3.25, '2025-01-17 18:30:00', 'Upcoming', '2025-01-05 13:54:16', '2025-01-05 13:54:16'),
(9, 'Boxing', 2, 3, 1.75, 3.00, 2.90, '2025-01-18 20:00:00', 'Upcoming', '2025-01-05 13:54:16', '2025-01-05 13:54:16'),
(10, 'Weightlifting', 4, 5, 1.50, 2.80, 3.10, '2025-01-19 15:00:00', 'Upcoming', '2025-01-05 13:54:16', '2025-01-05 13:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `game_reviews`
--

CREATE TABLE `game_reviews` (
  `id` int(11) NOT NULL,
  `game_name` varchar(255) NOT NULL,
  `review_content` text NOT NULL,
  `icon_class` varchar(255) NOT NULL DEFAULT 'ni ni-controller',
  `review_date` datetime DEFAULT current_timestamp(),
  `img` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_reviews`
--

INSERT INTO `game_reviews` (`id`, `game_name`, `review_content`, `icon_class`, `review_date`, `img`) VALUES
(4, 'USA vs France Basketball', 'USA wins against France in Basketball with a final score of 87-82. The game featured outstanding performances by NBA stars like LeBron James and Victor Wembanyama.', 'ni ni-basketball', '2024-07-27 22:30:00', '../assets/flags/usa.JPG'),
(5, 'Men\'s 100m Final', 'Usain Bolt\'s 100m World Record is broken by a young sprinter from Jamaica, clocking in at 9.54 seconds, earning him the gold medal.', 'ni ni-runner', '2024-07-28 21:00:00', '../assets/flags/usa.JPG'),
(6, 'Women\'s Swimming Relay', 'USA women\'s swimming relay team takes gold in a thrilling finish, edging out Australia by 0.2 seconds in the 4x100m freestyle relay.', 'ni ni-trophy', '2024-07-29 19:45:00', '../assets/flags/usa.JPG'),
(7, 'France vs Spain in Soccer', 'France defeats Spain 2-1 in the semi-finals, with Kylian Mbappé scoring the winning goal in the 89th minute.', 'ni ni-soccer', '2024-07-30 16:00:00', '../assets/flags/usa.JPG'),
(8, 'France Gold in Judo', 'France wins a historic gold in Judo at the Paris Olympics with a stunning throw in the men’s 66 kg final.', 'ni ni-medal', '2024-07-30 13:30:00', '../assets/flags/usa.JPG'),
(9, 'France Gold in Judo', 'France wins a historic gold in Judo at the Paris Olympics with a stunning throw in the men’s 66 kg final.', 'ni ni-medal', '2024-07-30 13:30:00', '../assets/flags/usa.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `medal`
--

CREATE TABLE `medal` (
  `country_id` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `silver` int(11) NOT NULL,
  `bronze` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medal`
--

INSERT INTO `medal` (`country_id`, `gold`, `silver`, `bronze`) VALUES
(1, 45, 30, 25),
(2, 38, 28, 18),
(3, 32, 25, 18),
(4, 28, 32, 25),
(5, 20, 30, 25),
(6, 18, 25, 20),
(7, 16, 20, 25),
(8, 15, 18, 20),
(9, 12, 20, 18),
(10, 10, 15, 20),
(11, 8, 12, 18),
(12, 8, 10, 12),
(13, 5, 12, 15),
(14, 4, 10, 12),
(15, 3, 8, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_date` datetime DEFAULT current_timestamp(),
  `total_bet_amount` decimal(10,2) NOT NULL,
  `payment_method` enum('Credit Card','PayPal','Debit Card','Other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `transaction_date`, `total_bet_amount`, `payment_method`) VALUES
(1, 1, '2025-01-01 10:00:00', 100.00, 'Credit Card'),
(2, 2, '2025-01-01 11:30:00', 150.00, 'PayPal'),
(3, 2, '2025-01-01 12:00:00', 200.00, 'Debit Card'),
(4, 1, '2025-01-02 14:00:00', 250.00, 'Credit Card'),
(5, 1, '2025-01-03 15:00:00', 300.00, 'PayPal'),
(6, 1, '2025-01-03 10:30:00', 500.00, 'Credit Card'),
(7, 2, '2025-01-04 14:45:00', 300.00, 'PayPal'),
(8, 2, '2025-01-04 09:20:00', 150.00, 'Debit Card'),
(9, 1, '2025-01-05 11:00:00', 700.00, 'Credit Card'),
(10, 2, '2025-01-05 13:10:00', 450.00, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `detail_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `bet_type` enum('Win','loss','pend') NOT NULL,
  `bet_amount` decimal(10,2) NOT NULL,
  `odds` decimal(5,2) NOT NULL COMMENT 'Odds of the bet',
  `potential_payout` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`detail_id`, `transaction_id`, `event_name`, `bet_type`, `bet_amount`, `odds`, `potential_payout`) VALUES
(1, 1, '100m Sprint', 'Win', 50.00, 2.50, 125.00),
(2, 1, 'Basketball Finals', 'Win', 50.00, 3.00, 150.00),
(3, 2, 'Swimming', 'loss', 75.00, 1.80, 135.00),
(4, 2, 'Gymnastics', 'loss', 75.00, 4.00, 300.00),
(5, 3, 'Marathon', 'Win', 100.00, 2.20, 220.00),
(6, 4, 'High Jump', 'loss', 125.00, 2.00, 250.00),
(7, 5, 'Relay Race', 'loss', 150.00, 1.50, 225.00),
(8, 6, 'Olympics 2025 - 100m Sprint', 'Win', 200.00, 1.50, 300.00),
(9, 6, 'Olympics 2025 - 200m Sprint', 'Win', 150.00, 2.00, 300.00),
(10, 7, 'World Cup 2025 - Final', 'loss', 100.00, 3.50, 350.00),
(11, 8, 'Super Bowl 2025', 'Win', 75.00, 1.80, 135.00),
(12, 9, 'Volleyball Brazil vs Germany', 'Win', 400.00, 2.50, 1000.00),
(13, 10, 'Wimbledon 2025 - Men\'s Final', 'Win', 300.00, 1.80, 540.00),
(14, 10, 'Wimbledon 2025 - Women\'s Final', 'pend', 150.00, 3.00, 450.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_activity` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `contact_number`, `username`, `password`, `last_activity`) VALUES
(1, 'kaikaigarvill@gmail.com', '09913379901', 'Chanchan', '1818', '2025-01-26 03:12:54.000000'),
(2, 'vincent@gmail.com', '0932488823', 'Kael', '1010', '2025-01-05 15:49:12.071949');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `bday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `first_name`, `last_name`, `bday`) VALUES
(1, 1, 'Christian Paul', 'Villanueva', '2002-09-04'),
(2, 2, 'Vincent', 'Manalang', '2001-06-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `team_1_id` (`team1_id`),
  ADD KEY `team_2_id` (`team2_id`);

--
-- Indexes for table `game_reviews`
--
ALTER TABLE `game_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `game_reviews`
--
ALTER TABLE `game_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`team1_id`) REFERENCES `country` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `games_ibfk_2` FOREIGN KEY (`team2_id`) REFERENCES `country` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
