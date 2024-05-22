-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2024 at 10:28 AM
-- Server version: 10.6.16-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `samirelma`
--

-- --------------------------------------------------------

--
-- Table structure for table `evenementen`
--

CREATE TABLE `evenementen` (
  `evenementID` int(11) NOT NULL,
  `naam` mediumtext NOT NULL,
  `datum` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `aantalTickets` int(11) NOT NULL,
  `beschrijving` text NOT NULL,
  `afbeelding` mediumtext NOT NULL,
  `zaalID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `weergeven` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evenementen`
--

INSERT INTO `evenementen` (`evenementID`, `naam`, `datum`, `aantalTickets`, `beschrijving`, `afbeelding`, `zaalID`, `userID`, `weergeven`) VALUES
(12, 'The world of Hans Zimmer - A new dimension', '2024-07-24 20:00:00', 23359, 'Concert met de muziek van Hans Zimmer gebracht door symfonisch orkest onder leiding van Gavin Greenway', 'A_new_dimension.jpg', 1, 36, 1),
(13, 'Alice Cooper - School\'s out', '2024-06-30 20:00:00', 8050, 'shock rock legend Alice Cooper komt terug met zijn nieuwe wereld tour School\'s out. ', 'alice cooper live.jpg', 2, 36, 1),
(14, 'Cavalluna - A land of a thousand dreams ', '2024-07-05 20:30:00', 23359, 'De epische paarden show Cavalluna komt terug naar België en deze keer groter dan ooit. ', 'cavalluna.webp', 1, 36, 1),
(15, 'The show - A tribute to ABBA ', '2024-06-07 20:00:00', 23359, 'Herbeleef de muziek van ABBA terug live in deze prachtige tribute concert', 'ABBA.jpg', 1, 36, 1),
(20, 'test', '2024-05-24 22:02:00', 32, 'jife fe,fief i fe,f of,sif s,f,so, fosf ,i, so,fo sf,os,f o,f,ois, ,s,f ois, f o   jife fe,fief i fe,f of,sif s,f,so, fosf ,i, so,fo sf,os,f o,f,ois, ,s,f ois, f o   ', 'photo-1575936123452-b67c3203c357.jpg', 1, 41, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbloverdraagnotifications`
--

CREATE TABLE `tbloverdraagnotifications` (
  `overdragerID` int(11) NOT NULL,
  `ontvangerID` int(11) NOT NULL,
  `evenementID` int(11) NOT NULL,
  `ticketID` int(11) NOT NULL,
  `notificatieID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbltickets`
--

CREATE TABLE `tbltickets` (
  `TicketID` int(11) NOT NULL,
  `rij` int(11) NOT NULL,
  `stoel` int(11) NOT NULL,
  `evenementID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `purchaseID` int(11) NOT NULL,
  `scanned` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltickets`
--

INSERT INTO `tbltickets` (`TicketID`, `rij`, `stoel`, `evenementID`, `categoryID`, `userID`, `purchaseID`, `scanned`) VALUES
(82, 1, 1, 12, 1, 41, 207, 0),
(83, 1, 2, 12, 1, 41, 208, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblzalen`
--

CREATE TABLE `tblzalen` (
  `zaalID` int(11) NOT NULL,
  `naam` varchar(9999) NOT NULL,
  `afbeelding` mediumtext NOT NULL,
  `plategrond` text NOT NULL,
  `capaciteit` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblzalen`
--

INSERT INTO `tblzalen` (`zaalID`, `naam`, `afbeelding`, `plategrond`, `capaciteit`) VALUES
(1, 'Sportpaleis', 'Sportpaleis.jpg', 'zaalplanSportpaleis.jpg', '23359'),
(2, 'Lotto Arena ', 'LottoArena.jpg', 'seatplanLottoArena.jpg', '8050');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_categories`
--

CREATE TABLE `ticket_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` text NOT NULL,
  `beschrijving` text NOT NULL,
  `prijs` decimal(38,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_categories`
--

INSERT INTO `ticket_categories` (`id`, `name`, `icon`, `beschrijving`, `prijs`) VALUES
(1, 'Golden Cirkel (VIP) ', 'vipIcon.jpg', 'Op vertoon van dit ticket krijg je toegang tot het eten, de zaal en de parking. De deuren van de voorstelling gaan telkens een half uur voor de start van de voorstelling open. ', 80),
(2, 'casual', '', 'de stoelen met goed zicht achter de vip arrangementen ', 70),
(3, 'normal', '', 'zitplaatsen verst verwijderd van het podium ', 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `function` int(11) NOT NULL,
  `profilePicture` text NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `function`, `profilePicture`, `updatedAt`, `createdAt`) VALUES
(35, 'Jack C.', 'jack.daniels@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$V1Y2MHhPeW1lZFRGRUIvMw$EniNjWX90O3yRwjwWh4pwRAmcCV1tEkesRo9gBVrAd8', 'Jack ', 'Daniels', 1, '', '2024-05-13 06:39:57', '2024-05-13 06:39:57'),
(36, 'john B.', 'john.doe@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$OURFYTVtelczdDgySzlDSQ$Byp2YOH8r+6lHEZ9orRbEIkJNuJPfiM4cOkTx1u0C5E', 'John', 'Doe', 2, '', '2024-05-13 06:40:36', '2024-05-13 06:40:36'),
(37, 'James A.', 'james.webb@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$Qnh4cE1VTEp2QVZIblVCbQ$symtWbQmfU033ABOinTheNLk4h4oSTU1OkeIdEzHSjg', 'James', 'Webb', 3, '', '2024-05-13 06:43:04', '2024-05-13 06:42:54'),
(41, 'testkodz@gmail.com', 'testkodz@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$ODNCLlU2RVFMb25TVERKSQ$o6UVFfB9bKqL9ol36HdAFUa4ciz6TiBUx5NsZC0Vom8', 'testkodz@gmail.com', 'testkodz@gmail.com', 2, 'no_profile_picture.jpg', '2024-05-22 08:49:35', '2024-05-22 08:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_purchases`
--

CREATE TABLE `user_purchases` (
  `purchaseID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `timeOfPurchase` datetime NOT NULL,
  `productId` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `productName` text NOT NULL,
  `secretkey` text NOT NULL DEFAULT '',
  `isPaid` tinyint(1) NOT NULL,
  `blok` int(11) NOT NULL,
  `stoel` int(11) NOT NULL,
  `evenementID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_purchases`
--

INSERT INTO `user_purchases` (`purchaseID`, `id`, `timeOfPurchase`, `productId`, `price`, `productName`, `secretkey`, `isPaid`, `blok`, `stoel`, `evenementID`) VALUES
(205, 36, '2024-05-16 13:14:06', 1, 80, 'Golden Cirkel (VIP) ', '5d21ad61b598f13654f9c2ff887dd6bf7c68b7b9f65d4ac3ad4c6424a6589c8d99c4d8bf174660339fe1aabc9b6ef1c304a8a41773f56a85f84186bd1ef08fe0', 1, 1, 12, 16),
(206, 36, '2024-05-16 14:00:50', 1, 80, 'Golden Cirkel (VIP) ', '', 0, 1, 1, 16),
(207, 41, '2024-05-22 10:23:59', 1, 80, 'Golden Cirkel (VIP) ', '', 0, 1, 1, 12),
(208, 41, '2024-05-22 10:24:39', 1, 80, 'Golden Cirkel (VIP) ', '4eeb0eda8223fb1a0b6643f5e739bba62df5300802df0306f011fe090b58816c5cb3f2836b0b389e94e0cab6e05e564854f1a9d1d28db1eaba46a413cf94264c', 0, 1, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`) VALUES
(3, 'admin'),
(2, 'bedrijf'),
(1, 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evenementen`
--
ALTER TABLE `evenementen`
  ADD PRIMARY KEY (`evenementID`);

--
-- Indexes for table `tbloverdraagnotifications`
--
ALTER TABLE `tbloverdraagnotifications`
  ADD PRIMARY KEY (`notificatieID`);

--
-- Indexes for table `tbltickets`
--
ALTER TABLE `tbltickets`
  ADD PRIMARY KEY (`TicketID`);

--
-- Indexes for table `tblzalen`
--
ALTER TABLE `tblzalen`
  ADD PRIMARY KEY (`zaalID`);

--
-- Indexes for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_category_name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_purchases`
--
ALTER TABLE `user_purchases`
  ADD PRIMARY KEY (`purchaseID`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evenementen`
--
ALTER TABLE `evenementen`
  MODIFY `evenementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbloverdraagnotifications`
--
ALTER TABLE `tbloverdraagnotifications`
  MODIFY `notificatieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbltickets`
--
ALTER TABLE `tbltickets`
  MODIFY `TicketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tblzalen`
--
ALTER TABLE `tblzalen`
  MODIFY `zaalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_purchases`
--
ALTER TABLE `user_purchases`
  MODIFY `purchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
