-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 02:12 PM
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
-- Database: `corememories`
--

-- --------------------------------------------------------

--
-- Table structure for table `islandcontents`
--

CREATE TABLE `islandcontents` (
  `islandContentID` int(4) NOT NULL,
  `islandOfPersonalityID` int(4) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `content` varchar(300) NOT NULL,
  `color` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `islandcontents`
--

INSERT INTO `islandcontents` (`islandContentID`, `islandOfPersonalityID`, `image`, `content`, `color`) VALUES
(1, 1, 'images/chanchannnnn.jpg', 'Smiling all day at little joys.', '#FFEB3B'),
(2, 1, 'images/tawa.jpg', 'Laughing with friends over silly jokes.', '#FFEB3B'),
(3, 1, 'images/sunny.jpg', 'Finding happiness in sunny weather.', '#FFEB3B'),
(4, 2, 'images/goal.jpg', 'Focused on achieving goals.', '#4CAF50'),
(5, 2, 'images/crossing.jpg', 'The satisfaction of crossing the finish line.', '#4CAF50'),
(6, 2, 'images/hardwork.jpg', 'Pushing through challenges with determination.', '#4CAF50'),
(7, 3, 'images/chat.jpg', 'Solving backend challenges, building APIs, and crafting efficient systems is my forte.', '#2196F3'),
(8, 3, 'images/fb.jpg', 'I enjoy creating scalable and reliable backend solutions.', '#2196F3'),
(9, 3, 'images/net.jpg', 'Working with databases, servers, and ensuring smooth integration is my passion.', '#2196F3'),
(13, 5, 'images/ml.jpg', 'Mobile Legends: Play as Gusion - A master assassin with high burst damage.', '#ffcc00'),
(14, 5, 'images/codm.jpg', 'CODM Spotlight: AS VAL - Perfect for stealth operations.', '#333333'),
(15, 5, 'images/jett.mp4', 'Tamang ace', '#ff6699'),
(16, 4, 'images/mountain.JPG', 'Conquered the summit of Mt. Everest in Nepal! A thrilling climb that pushed my limits.', '#1E90FF'),
(17, 4, 'images/surf.jpg', 'Diving into the Great Barrier Reef! Exploring the underwater world was surreal and magical.', '#FFD700'),
(18, 4, 'images/tawa.jpg', 'Witnessed the wild wonders of Africa on a safari trip. The lions and elephants were breathtaking!', '#228B22');

-- --------------------------------------------------------

--
-- Table structure for table `islandsofpersonality`
--

CREATE TABLE `islandsofpersonality` (
  `islandOfPersonalityID` int(4) NOT NULL,
  `name` varchar(40) NOT NULL,
  `shortDescription` varchar(300) DEFAULT NULL,
  `longDescription` varchar(900) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `islandsofpersonality`
--

INSERT INTO `islandsofpersonality` (`islandOfPersonalityID`, `name`, `shortDescription`, `longDescription`, `color`, `image`, `status`) VALUES
(1, 'Happiness Island', 'A place of joy and smiles', 'This island represents your happy moments, where positivity and optimism thrive.', '#FFEB3B', 'images/chanchannnnn.jpg', 'active'),
(2, 'Determination Island', 'The drive to finish tasks', 'This island represents your unshakable determination to complete things you love to do.', '#4CAF50', 'images/couch.jpg', 'active'),
(3, 'Developer Island', 'Where I enjoyed being a backend developer', 'This island represents my passion and joy in working as a backend developer, solving complex problems, and building scalable systems.', '#2196F3', 'developer_island.jpg', 'active'),
(4, 'Adventure Island', 'For the thrill-seekers and explorers', 'Adventure Island embodies the love for discovering new experiences, embracing challenges, and exploring the unknown.', '#F44336', 'lazy.png', 'active'),
(5, 'Gaming Land', 'Explore the world of gaming', 'A haven for gamers of all genres, featuring top games like Mobile Legends, Call of Duty, and Valorant.', '#00ccff', 'gaming_land.png', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `islandcontents`
--
ALTER TABLE `islandcontents`
  ADD PRIMARY KEY (`islandContentID`);

--
-- Indexes for table `islandsofpersonality`
--
ALTER TABLE `islandsofpersonality`
  ADD PRIMARY KEY (`islandOfPersonalityID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `islandcontents`
--
ALTER TABLE `islandcontents`
  MODIFY `islandContentID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `islandsofpersonality`
--
ALTER TABLE `islandsofpersonality`
  MODIFY `islandOfPersonalityID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
