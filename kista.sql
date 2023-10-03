-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 12:20 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kista`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentid` varchar(14) NOT NULL,
  `content` varchar(500) NOT NULL,
  `productid` varchar(14) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `commentdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentid`, `content`, `productid`, `userid`, `commentdate`) VALUES
('AFRHMSO2060826', 'Are they some offers?', 'OC77024887', 'BGNAALS8937230', '2023-05-31 11:12:49'),
('ARILETO9342610', 'Beautiful product. I like it!', 'OC77024887', 'BGNAALS8937230', '2023-05-31 12:01:21'),
('CIN77737731656', 'Nice!', 'AC83868817', 'EKTHUCN3334955', '2023-05-31 12:15:43'),
('CRNOPI46688577', 'Nice product', 'AC72903418', 'EKTHUCN3334955', '2023-05-31 12:16:11'),
('HDCRREO6449690', 'Can you reduce the price?', 'OC77024887', 'VLA76146141885', '2023-05-31 12:03:56'),
('ICN13723729027', 'nice\r\n', 'AC10765256', 'IWL67287281549', '2023-05-31 12:18:35'),
('IHIIA0N1394534', 'I have 800 per unit, is it possible?', 'PSOW14546835', 'MAIMRJO5858458', '2023-05-31 12:13:19'),
('IOOISOL4509022', 'it is looking good', 'RIOP82794097', 'MAIMRJO5858458', '2023-05-31 12:15:46'),
('OITIOIG2010434', 'Your price is too high.', 'OC77024887', 'VLA76146141885', '2023-05-31 12:03:39'),
('OPNCRI24259512', 'Nice product!', 'OC77024887', 'BGNAALS8937230', '2023-05-31 11:12:12'),
('TFNERO89948832', 'Not Fresh\r\n', 'CO59319422', 'EKTHUCN3334955', '2023-05-31 12:10:12'),
('UIATHML0935717', 'The image is flu\r\n', 'OC77024887', 'EKTHUCN3334955', '2023-05-31 12:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` varchar(14) NOT NULL,
  `userid` varchar(14) NOT NULL,
  `productname` varchar(30) NOT NULL,
  `productimg` varchar(70) NOT NULL,
  `productquantity` tinyint(12) NOT NULL,
  `productprice` smallint(12) NOT NULL,
  `productdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `userid`, `productname`, `productimg`, `productquantity`, `productprice`, `productdate`) VALUES
('AC10765256', 'IWL67287281549', 'cassava', 'Accounts/will@gmail/image-qr-code.png', 123, 32767, '2023-05-31 12:17:48'),
('AC72903418', 'BGNAALS8937230', 'Casava', 'Accounts/ngoupayouhabil@gmail.com/casava2.jpg', 127, 32767, '2023-05-31 11:07:02'),
('AC83868817', 'VLA76146141885', 'Casava', 'Accounts/valery@gmail.com/casava2.jpg', 100, 2000, '2023-05-31 12:12:00'),
('CO59319422', 'VLA76146141885', 'Cocoyam', 'Accounts/valery@gmail.com/cocoyam.jpg', 127, 32767, '2023-05-31 12:03:04'),
('OC77024887', 'BGNAALS8937230', 'Cocoyam', 'Accounts/ngoupayouhabil@gmail.com/cocoyam.jpg', 127, 32767, '2023-05-31 11:11:09'),
('PSOW14546835', 'EKTHUCN3334955', 'Sweet potato', 'Accounts/kenneruby@gmail.com/12.jpg', 20, 1000, '2023-05-31 12:08:59'),
('RIOP82794097', 'EKTHUCN3334955', 'Irish potato', 'Accounts/kenneruby@gmail.com/7.jpg', 100, 20000, '2023-05-31 12:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `replyid` varchar(14) NOT NULL,
  `content` varchar(500) NOT NULL,
  `commentid` varchar(14) NOT NULL,
  `userid` varchar(14) NOT NULL,
  `replydate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_general_ci;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`replyid`, `content`, `commentid`, `userid`, `replydate`) VALUES
('AAIGML95230186', 'I am glad.', 'AFRHMSO2060826', 'BGNAALS8937230', '2023-05-31 11:42:10'),
('AIEOYTO6392697', 'Yeah! But, it is too expensive.', 'ARILETO9342610', 'VLA76146141885', '2023-05-31 12:06:15'),
('BIIISTT3922781', 'it is bitter', 'CIN77737731656', 'MAIMRJO5858458', '2023-05-31 12:18:12'),
('DHH37747741500', 'dhhs', 'AFRHMSO2060826', 'VLA76146141885', '2023-05-31 12:07:33'),
('DHS98598590557', 'hdsk', 'ARILETO9342610', 'VLA76146141885', '2023-05-31 12:07:51'),
('EYA39849847986', 'Yeah!', 'OPNCRI24259512', 'BGNAALS8937230', '2023-05-31 11:34:23'),
('HAT98008003471', 'thanks', 'ICN13723729027', 'IWL67287281549', '2023-05-31 12:18:51'),
('ISRTUIT1142215', 'it is true', 'TFNERO89948832', 'MAIMRJO5858458', '2023-05-31 12:14:35'),
('IYAUOER0878118', 'Your are right!', 'HDCRREO6449690', 'VLA76146141885', '2023-05-31 12:05:42'),
('OHRWTE61779289', 'The word.', 'OITIOIG2010434', 'VLA76146141885', '2023-05-31 12:07:13'),
('OVEGROE1051904', 'Yeah! Very good.', 'IHIIA0N1394534', 'BGNAALS8937230', '2023-05-31 12:18:10'),
('ROCEOOS6860609', 'No problem you can try something else\r\n', 'TFNERO89948832', 'EKTHUCN3334955', '2023-05-31 12:11:11'),
('SYEETH34297989', 'Yes there\'re. ', 'OPNCRI24259512', 'BGNAALS8937230', '2023-05-31 11:35:42'),
('TAHYEE51054475', 'reply', 'OPNCRI24259512', 'BGNAALS8937230', '2023-05-31 11:32:51'),
('TDH45795796218', 'thdjs', 'OITIOIG2010434', 'VLA76146141885', '2023-05-31 12:07:59'),
('TTT27607604436', 'ttt', 'HDCRREO6449690', 'VLA76146141885', '2023-05-31 12:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` varchar(14) NOT NULL,
  `username` varchar(30) NOT NULL,
  `useremail` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `userimg` varchar(60) NOT NULL,
  `userdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `useremail`, `password`, `userimg`, `userdate`) VALUES
('BCTUHRN4336529', 'Tchinda Kenne Ruby', 'kenneruby131@gmail.com', '$2y$10$K8rxhWJhvkWDlSYEjLU5d.9cQlEpewAYIHOsNZJoEtduCt5.kOKBC', 'Images/user.jpeg', '2023-05-31 12:06:44'),
('BGNAALS8937230', 'Ngoupayou Habil Salim', 'ngoupayouhabil@gmail.com', '$2y$10$3cfvFbtsupXEuwfpzHalnej7YqVkWusQqqTMVlnxiPXx61tbIuYUS', 'Accounts/ngoupayouhabil@gmail.com/Habil5.png', '2023-05-31 11:01:50'),
('EKTHUCN3334955', 'Tchinda Kenne Ruby', 'kenneruby@gmail.com', '$2y$10$CClajFNonArGsV6TvfxEx.OYQ5V9F7HcQBkIXbB8QnosMlxM.VBMm', 'Images/user.jpeg', '2023-05-31 12:07:32'),
('ETUKHNB3299910', 'Tchinda Kenne Ruby', 'kenneruby131@gmail.com', '$2y$10$G2AcQNliqQb8Ul7ZeqmcTeOSE6asDvPqTCQYmFmHTv/wnRPkT.0ha', 'Images/user.jpeg', '2023-05-31 12:05:52'),
('IWL67287281549', 'will', 'will@gmail', '$2y$10$jTtn02qsaHAHIeJATNBeKeKdUNw252lhAT8XrgRG7pLiIS6eJKMyK', 'Images/user.jpeg', '2023-05-31 12:16:25'),
('MAIMRJO5858458', 'MALALOUM DJOU MIREILLE', 'malaloummireille@gmail.com', '$2y$10$0kFn2W4xN0l3Tg4gg7uY5Oym8Nnv.G86/UwYKXKCzL5KyF7y8lauO', 'Accounts/malaloummireille@gmail.com/mireille.png', '2023-05-31 12:11:38'),
('VLA76146141885', 'Valery', 'valery@gmail.com', '$2y$10$2wrA0wyyb2QaDXtH.arhHuPX4urSNBhsYN4WQRUU72bYJfkprgHPK', 'Accounts/valery@gmail.com/valery.jpg', '2023-05-31 12:01:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`replyid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
