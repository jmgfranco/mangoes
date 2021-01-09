-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2020 at 07:17 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reader_dbase`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `chapterId` int(11) NOT NULL,
  `chapterName` longtext NOT NULL,
  `chapterNumber` int(11) NOT NULL,
  `chapterVolId` int(11) NOT NULL,
  `chapterSerId` int(11) NOT NULL,
  `chapterDate` datetime NOT NULL,
  `chapterLocation` longtext NOT NULL,
  `chapterCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`chapterId`, `chapterName`, `chapterNumber`, `chapterVolId`, `chapterSerId`, `chapterDate`, `chapterLocation`, `chapterCount`) VALUES
(3, 'Sample Chapter 1', 1, 2, 3, '2020-07-29 07:14:46', 'files/series/Sample Series/Sample Volume/Sample Chapter 1', 1),
(4, 'Sample Chapter 2', 2, 2, 3, '2020-07-29 07:15:29', 'files/series/Sample Series/Sample Volume/Sample Chapter 2', 0),
(5, 'Sample Chapter 3', 3, 2, 3, '2020-07-29 07:15:44', 'files/series/Sample Series/Sample Volume/Sample Chapter 3', 0),
(6, 'Sample Chapter 4', 4, 2, 3, '2020-07-29 07:15:59', 'files/series/Sample Series/Sample Volume/Sample Chapter 4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cover`
--

CREATE TABLE `cover` (
  `coverId` int(11) NOT NULL,
  `coverName` longtext NOT NULL,
  `coverTmpName` longtext NOT NULL,
  `coverSize` int(11) NOT NULL,
  `coverError` int(11) NOT NULL,
  `coverType` longtext NOT NULL,
  `coverLocation` longtext NOT NULL,
  `coverDate` datetime NOT NULL,
  `coverSerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cover`
--

INSERT INTO `cover` (`coverId`, `coverName`, `coverTmpName`, `coverSize`, `coverError`, `coverType`, `coverLocation`, `coverDate`, `coverSerId`) VALUES
(1, '1.png', 'C:\\xampp\\tmp\\phpCEAA.tmp', 1967017, 0, 'image/png', 'files/cover/1.png', '2020-07-29 07:13:43', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pageId` int(11) NOT NULL,
  `pageName` longtext NOT NULL,
  `pageTmpName` longtext NOT NULL,
  `pageSize` int(11) NOT NULL,
  `pageError` int(11) NOT NULL,
  `pageType` longtext NOT NULL,
  `pageChpId` int(11) NOT NULL,
  `pageVolId` int(11) NOT NULL,
  `pageSerId` int(11) NOT NULL,
  `pageDate` datetime NOT NULL,
  `pageLocation` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pageId`, `pageName`, `pageTmpName`, `pageSize`, `pageError`, `pageType`, `pageChpId`, `pageVolId`, `pageSerId`, `pageDate`, `pageLocation`) VALUES
(47, '2.png', 'C:\\xampp\\tmp\\phpC3D8.tmp', 1202315, 0, 'image/png', 3, 2, 3, '2020-07-29 07:14:46', 'files/series/Sample Series/Sample Volume/Sample Chapter 1/2.png'),
(48, '5.png', 'C:\\xampp\\tmp\\phpC3E9.tmp', 2407011, 0, 'image/png', 3, 2, 3, '2020-07-29 07:14:46', 'files/series/Sample Series/Sample Volume/Sample Chapter 1/5.png'),
(49, '6.png', 'C:\\xampp\\tmp\\phpC3FA.tmp', 1069515, 0, 'image/png', 3, 2, 3, '2020-07-29 07:14:46', 'files/series/Sample Series/Sample Volume/Sample Chapter 1/6.png'),
(50, '3.png', 'C:\\xampp\\tmp\\php6B56.tmp', 2002999, 0, 'image/png', 4, 2, 3, '2020-07-29 07:15:29', 'files/series/Sample Series/Sample Volume/Sample Chapter 2/3.png'),
(51, '4.png', 'C:\\xampp\\tmp\\php6B67.tmp', 2508886, 0, 'image/png', 4, 2, 3, '2020-07-29 07:15:29', 'files/series/Sample Series/Sample Volume/Sample Chapter 2/4.png'),
(52, '7.png', 'C:\\xampp\\tmp\\phpA796.tmp', 528520, 0, 'image/png', 5, 2, 3, '2020-07-29 07:15:44', 'files/series/Sample Series/Sample Volume/Sample Chapter 3/7.png'),
(53, '8.png', 'C:\\xampp\\tmp\\phpA7A7.tmp', 520817, 0, 'image/png', 5, 2, 3, '2020-07-29 07:15:44', 'files/series/Sample Series/Sample Volume/Sample Chapter 3/8.png'),
(54, '9.png', 'C:\\xampp\\tmp\\phpA7A8.tmp', 519127, 0, 'image/png', 5, 2, 3, '2020-07-29 07:15:44', 'files/series/Sample Series/Sample Volume/Sample Chapter 3/9.png'),
(55, '10.png', 'C:\\xampp\\tmp\\phpA7B8.tmp', 438958, 0, 'image/png', 5, 2, 3, '2020-07-29 07:15:44', 'files/series/Sample Series/Sample Volume/Sample Chapter 3/10.png'),
(56, '11.png', 'C:\\xampp\\tmp\\phpA7B9.tmp', 563199, 0, 'image/png', 5, 2, 3, '2020-07-29 07:15:44', 'files/series/Sample Series/Sample Volume/Sample Chapter 3/11.png'),
(57, '12.png', 'C:\\xampp\\tmp\\phpDF84.tmp', 851023, 0, 'image/png', 6, 2, 3, '2020-07-29 07:15:59', 'files/series/Sample Series/Sample Volume/Sample Chapter 4/12.png'),
(58, '13.png', 'C:\\xampp\\tmp\\phpDF94.tmp', 782429, 0, 'image/png', 6, 2, 3, '2020-07-29 07:15:59', 'files/series/Sample Series/Sample Volume/Sample Chapter 4/13.png'),
(59, '14.png', 'C:\\xampp\\tmp\\phpDFA5.tmp', 888362, 0, 'image/png', 6, 2, 3, '2020-07-29 07:15:59', 'files/series/Sample Series/Sample Volume/Sample Chapter 4/14.png'),
(60, '15.png', 'C:\\xampp\\tmp\\phpDFB6.tmp', 889745, 0, 'image/png', 6, 2, 3, '2020-07-29 07:15:59', 'files/series/Sample Series/Sample Volume/Sample Chapter 4/15.png'),
(61, '16.png', 'C:\\xampp\\tmp\\phpDFB7.tmp', 890215, 0, 'image/png', 6, 2, 3, '2020-07-29 07:15:59', 'files/series/Sample Series/Sample Volume/Sample Chapter 4/16.png');

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `serId` int(11) NOT NULL,
  `serName` varchar(255) NOT NULL,
  `serAuthor` varchar(255) NOT NULL,
  `serDesc` longtext NOT NULL,
  `serVolNum` int(11) NOT NULL,
  `serChpNum` int(11) NOT NULL,
  `serPageNum` int(11) NOT NULL,
  `serDate` datetime NOT NULL,
  `serLocation` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`serId`, `serName`, `serAuthor`, `serDesc`, `serVolNum`, `serChpNum`, `serPageNum`, `serDate`, `serLocation`) VALUES
(3, 'Sample Series', 'Sample Author', 'A sample series containing images provided by cjaysonv(https://www.behance.net/cjaysonv?fbclid=IwAR1Uwf0pWXIt_v5THLdC-hOtbn7zFtRSqkeeFhZaz9grLksUgVNjqCi6w5w)', 1, 3, 10, '2020-07-29 07:13:43', 'files/series/Sample Series');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` tinytext NOT NULL,
  `userPass` tinytext NOT NULL,
  `userDspName` tinytext NOT NULL,
  `userEmail` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userPass`, `userDspName`, `userEmail`) VALUES
(2, 'test', '$2y$10$xkIFD1Irnwrus9QpCfGlreBnlwDeCivFd65j8XpSjaB8eMF7jZ7t2', 'Test', 'test@test.com'),
(3, 'test2', '$2y$10$wym7jn7VHbT2ZARQyC0L7eOwt4QeA2.1pgyQxRB2tqgPaXcZxU5Zq', 'test2', 'test@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `volume`
--

CREATE TABLE `volume` (
  `volumeId` int(11) NOT NULL,
  `volumeSerNum` int(11) NOT NULL,
  `volumeName` longtext NOT NULL,
  `volumeChpNum` int(11) NOT NULL,
  `volumeTotPage` int(11) NOT NULL,
  `volumeDate` datetime NOT NULL,
  `volumeFileLoc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `volume`
--

INSERT INTO `volume` (`volumeId`, `volumeSerNum`, `volumeName`, `volumeChpNum`, `volumeTotPage`, `volumeDate`, `volumeFileLoc`) VALUES
(2, 3, 'Sample Volume', 0, 0, '2020-07-29 07:14:23', 'files/series/Sample Series/Sample Volume');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`chapterId`),
  ADD KEY `ser_FK` (`chapterSerId`),
  ADD KEY `vol_FK` (`chapterVolId`);

--
-- Indexes for table `cover`
--
ALTER TABLE `cover`
  ADD PRIMARY KEY (`coverId`),
  ADD KEY `FK_Cover` (`coverSerId`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pageId`),
  ADD KEY `pag_serFK` (`pageSerId`),
  ADD KEY `pag_volFK` (`pageVolId`),
  ADD KEY `pag_chpFK` (`pageChpId`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`serId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `volume`
--
ALTER TABLE `volume`
  ADD PRIMARY KEY (`volumeId`),
  ADD KEY `vol_serFK` (`volumeSerNum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `chapterId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cover`
--
ALTER TABLE `cover`
  MODIFY `coverId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `serId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `volume`
--
ALTER TABLE `volume`
  MODIFY `volumeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `ser_FK` FOREIGN KEY (`chapterSerId`) REFERENCES `series` (`serId`),
  ADD CONSTRAINT `vol_FK` FOREIGN KEY (`chapterVolId`) REFERENCES `volume` (`volumeId`);

--
-- Constraints for table `cover`
--
ALTER TABLE `cover`
  ADD CONSTRAINT `FK_Cover` FOREIGN KEY (`coverSerId`) REFERENCES `series` (`serId`);

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pag_chpFK` FOREIGN KEY (`pageChpId`) REFERENCES `chapter` (`chapterId`),
  ADD CONSTRAINT `pag_serFK` FOREIGN KEY (`pageSerId`) REFERENCES `series` (`serId`),
  ADD CONSTRAINT `pag_volFK` FOREIGN KEY (`pageVolId`) REFERENCES `volume` (`volumeId`);

--
-- Constraints for table `volume`
--
ALTER TABLE `volume`
  ADD CONSTRAINT `vol_serFK` FOREIGN KEY (`volumeSerNum`) REFERENCES `series` (`serId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
