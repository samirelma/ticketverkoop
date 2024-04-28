-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 19 apr 2024 om 14:29
-- Serverversie: 10.4.25-MariaDB
-- PHP-versie: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbticketverkoop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `evenementen`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `evenementen`
--

INSERT INTO `evenementen` (`evenementID`, `naam`, `datum`, `aantalTickets`, `beschrijving`, `afbeelding`, `zaalID`, `userID`, `weergeven`) VALUES
(1, 'Test', '2024-04-19 14:05:26', 15, 'testtt', 'e8773f51-7d80-4086-a861-3ef6628fef30.jpeg', 1, 0, 0),
(2, 'test', '2024-01-19 14:33:28', 15, 'cool', '', 1, 0, 0),
(3, '', '2024-01-19 14:33:24', 0, '', '', 1, 0, 0),
(4, 'Hans Zimmer live! ', '2024-03-11 10:00:44', 200, 'Hans Zimmer live a unique concert experience ', 'HansZimmerLive.jpeg', 1, 26, 1),
(5, 'Robi Live', '2023-12-08 00:00:00', 11, 'wwww', 'e8773f51-7d80-4086-a861-3ef6628fef30.jpeg', 0, 0, 0),
(6, 'ww', '2023-11-29 00:00:00', 11, 'll', 'achtergrond.jpg', 1, 0, 0),
(7, 'testttt', '2023-11-29 00:00:00', 1000, 'ttt', 'e8773f51-7d80-4086-a861-3ef6628fef30.jpeg', 2, 0, 0),
(8, 'aaa', '2024-01-02 16:11:00', 2147483647, 'ffsq', '', 1, 0, 0),
(9, 'weergeventest', '2024-02-10 20:00:00', 2500, 'test', '', 1, 0, 1),
(10, 'nieuwe test', '2024-01-19 14:43:00', 2500, 'test invoegen userid', '', 1, 26, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbloverdraagnotifications`
--

CREATE TABLE `tbloverdraagnotifications` (
  `overdragerID` int(11) NOT NULL,
  `ontvangerID` int(11) NOT NULL,
  `evenementID` int(11) NOT NULL,
  `ticketID` int(11) NOT NULL,
  `notificatieID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `tbloverdraagnotifications`
--

INSERT INTO `tbloverdraagnotifications` (`overdragerID`, `ontvangerID`, `evenementID`, `ticketID`, `notificatieID`) VALUES
(32, 30, 4, 1, 15);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbltickets`
--

CREATE TABLE `tbltickets` (
  `TicketID` int(11) NOT NULL,
  `rij` int(11) NOT NULL,
  `stoel` int(11) NOT NULL,
  `evenementID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `purchaseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `tbltickets`
--

INSERT INTO `tbltickets` (`TicketID`, `rij`, `stoel`, `evenementID`, `categoryID`, `userID`, `purchaseID`) VALUES
(1, 10, 20, 4, 1, 26, 21),
(2, 1, 1, 1, 1, 26, 22),
(3, 1, 1, 1, 1, 26, 23),
(4, 1, 1, 1, 1, 26, 24),
(5, 1, 1, 1, 1, 26, 25);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblzalen`
--

CREATE TABLE `tblzalen` (
  `zaalID` int(11) NOT NULL,
  `naam` varchar(9999) NOT NULL,
  `afbeelding` mediumtext NOT NULL,
  `plategrond` text NOT NULL,
  `capaciteit` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `tblzalen`
--

INSERT INTO `tblzalen` (`zaalID`, `naam`, `afbeelding`, `plategrond`, `capaciteit`) VALUES
(1, 'Sportpaleis', 'Sportpaleis.jpg', 'zaalplanSportpaleis.jpg', '23359'),
(2, 'Lotto Arena ', 'LottoArena.jpg', 'seatplanLottoArena.jpg', '8050');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ticket_categories`
--

CREATE TABLE `ticket_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` text NOT NULL,
  `beschrijving` text NOT NULL,
  `prijs` decimal(38,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `ticket_categories`
--

INSERT INTO `ticket_categories` (`id`, `name`, `icon`, `beschrijving`, `prijs`) VALUES
(1, 'Golden Cirkel (VIP) ', 'vipIcon.jpg', 'Op vertoon van dit ticket krijg je toegang tot het eten, de zaal en de parking. De deuren van de voorstelling gaan telkens een half uur voor de start van de voorstelling open. ', '80'),
(2, 'casual', '', 'de stoelen met goed zicht achter de vip arrangementen ', '70'),
(3, 'normal', '', 'zitplaatsen verst verwijderd van het podium ', '50');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `function`, `profilePicture`, `updatedAt`, `createdAt`) VALUES
(1, 'test', 'test@gmail.com', '123', 'test', 'test', 3, '', '2023-12-01 12:53:25', '2023-10-20 16:34:52'),
(2, 'a', 'a@a.com', 'crcr', 'a', 'a', 0, '', '2023-10-24 08:37:24', '2023-10-24 08:37:24'),
(4, 'll', 'mlsml@l.p', '$argon2id$v=19$m=65536,t=4,p=1$YWR4ck16SmlML0JnS1Q0Ng$fQoTYc9pSAN51pgFUpzqmg8wlC7oQ7SgO8suGOYt38w', 'sa', 'sa', 0, '', '2023-11-05 19:32:50', '2023-11-05 19:32:50'),
(6, 'colslll', 'ss@lm.p', '$argon2id$v=19$m=65536,t=4,p=1$UkJHYXpHWUhUWjNKOGRveA$akbvJiDknTLS4JcugOsXIpULZWNXW5WfxL3YEULhhNQ', 'plpl', 'ozllm', 0, '', '2023-11-05 19:34:38', '2023-11-05 19:34:38'),
(11, 'slkzld', 'dkzl@m.o', '$argon2id$v=19$m=65536,t=4,p=1$U3c4YzExbzB2cEVmeFAzLg$lM6JRqUFKpoIadiRHLn3C4ZDaInWI+WnY8KaQ221XWE', 'dlzm', 'smlom', 0, '', '2023-11-05 19:39:12', '2023-11-05 19:39:12'),
(12, 'zzz', 'ss@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$eDRTN2dVWGw2Ty5RejhHSQ$QFV+mdvQ5z4cpaD/Miv1ZbqjiIO1Inu3q6T/t2Bl8jg', 'as', 's', 0, '', '2023-11-23 12:00:19', '2023-11-23 12:00:19'),
(13, 'a@gmail.com', 'a@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$MVpOdTZ4d2h0MFFDZnJzWA$j/GQ/4Mkp0icHTB6OXoWUeKdRQ2i0EQRZN1xKYKVwpM', 'a@gmail.com', 'a@gmail.com', 0, '', '2023-11-23 12:01:08', '2023-11-23 12:01:08'),
(14, 'testlogin', 'tetslogin@robi.com', '$argon2id$v=19$m=65536,t=4,p=1$VHVLMkRGUGE3ZnhWeG9VZQ$Dson51wwp2kKnWVfVY4wwO2WG7C73OXkGcumPBLfkKs', 'testlogin', 'testlogin', 0, '', '2023-11-23 12:04:41', '2023-11-23 12:04:41'),
(15, 'aeaea', 'e@e.be', '$argon2id$v=19$m=65536,t=4,p=1$SnFQdUlhSkxZLmRDUEUxVA$IzjoxdXYkPfPQOHDOMRkoj+OSJtJ2QTPlqOAKCRiXPE', 'eaea', 'eaeae', 0, '', '2023-11-24 13:30:23', '2023-11-24 13:30:23'),
(16, 'kkk@kk.com', 'kkk@kk.com', '$argon2id$v=19$m=65536,t=4,p=1$bDFtR0VUY3FNcmVBSXhBdw$8niuZVgC5RvyySC07JGblneTiTpBQTvxo4+67+KaIRI', 'kkk@kk.com', 'kkk@kk.com', 2, '', '2023-11-27 11:30:02', '2023-11-27 11:30:02'),
(17, '123', 'test@lol.com', '$argon2id$v=19$m=65536,t=4,p=1$VFpYUDQ4MGNrWGFTU3lXSw$SE8cUvW7gWrp08kBzfkDFiNXRw21RkgLm5n2A6Sx0MQ', 'test', 'test', 1, '', '2023-11-30 08:17:01', '2023-11-27 11:32:41'),
(19, 'ik@test.com', 'ik@test.com', '$argon2id$v=19$m=65536,t=4,p=1$dndvczZiSXhmbmoxSUpObQ$skAS6YEdda9jnbAJkEgC8s/z1yYRrS6csCz+G9frvLw', 'ik', 'l', 2, '', '2023-11-27 15:01:00', '2023-11-27 15:01:00'),
(21, 'bedijf', 'bedrijftest@test.com', '$argon2id$v=19$m=65536,t=4,p=1$ZTFkOTBZY0JmTVdIS2p2eg$yKEx+BHWd3mWp6Rgkmlv4Bv1hY9nQvVMiPEAr5l2zis', 'bdrijf', 'bedrijf', 2, '', '2023-12-01 12:47:24', '2023-12-01 12:47:24'),
(22, 'john', 'john@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$YnNjTTdtcVhacU9xcUhmVA$Wvf27gmT2sxZKqozdk/CB0GE87Ms02nMPGPKk+RokX8', 'john', 'Doe', 3, '', '2023-12-01 12:53:32', '2023-12-01 12:50:01'),
(26, 'alfa', 'alfa@alfa.com', '$argon2id$v=19$m=65536,t=4,p=1$N2xiTGhFNXdQYkZsZmt0Rw$86t6vRuVNtYyp0VEfhyLKjsC6sNJQuUWsVyyOvixgOg', 'alfa', 'alfa', 2, 'achtergrond.jpg', '2024-03-08 10:11:42', '2024-01-08 15:10:09'),
(28, 'AAAAAAAAAAAAAA', 'a@b.c', '$argon2id$v=19$m=65536,t=4,p=1$QWxMQUsuOHhYSkp3WmxjWA$B/kZyv/iycZAf47V9TEBsV5XjCOfq4/Hq54NouY7cWA', 'AAAAAAAAAAAAAAAAAA', 'AAAAAAAAAAAAAAAAAA', 1, 'achtergrond.jpeg', '2024-01-15 14:49:18', '2024-01-15 14:49:04'),
(30, 'robi', 'robi@gebruiker.com', '$argon2id$v=19$m=65536,t=4,p=1$TjhJeDVidlpVdU12MlM4MQ$v0l4m2Da4XrWtmZxS7GiBGFca+we801qG00VDEIZk6Y', 'robi', 'robi', 1, '', '2024-03-07 20:55:52', '2024-03-07 20:55:52'),
(32, 'Hans', 'robi@gebruiker2.com', '$argon2id$v=19$m=65536,t=4,p=1$Q1Bad1dkbWJBdXV1d2N1NA$PzxHR6LVU5VWmYtf1PMb2NlGvgz/ASn2mvWH8OEgtr8', 'robi', 'robi', 1, '', '2024-03-07 21:04:11', '2024-03-07 21:04:11');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_purchases`
--

CREATE TABLE `user_purchases` (
  `purchaseID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `timeOfPurchase` datetime NOT NULL,
  `productId` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `productName` text NOT NULL,
  `secretkey` text NOT NULL,
  `isPaid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user_purchases`
--

INSERT INTO `user_purchases` (`purchaseID`, `id`, `timeOfPurchase`, `productId`, `price`, `productName`, `secretkey`, `isPaid`) VALUES
(1, 26, '2024-04-15 09:55:17', 1, 80, 'Golden Cirkel (VIP) ', '', 0),
(2, 26, '2024-04-15 09:57:38', 2, 70, 'casual', '', 0),
(3, 26, '2024-04-15 15:13:08', 1, 80, 'Golden Cirkel (VIP) ', '', 0),
(4, 26, '2024-04-15 15:16:11', 1, 80, 'Golden Cirkel (VIP) ', '', 0),
(5, 26, '2024-04-18 12:58:24', 1, 80, 'Golden Cirkel (VIP) ', '', 0),
(6, 26, '2024-04-18 13:00:01', 1, 80, 'Golden Cirkel (VIP) ', '', 0),
(7, 26, '2024-04-18 13:00:18', 1, 80, 'Golden Cirkel (VIP) ', '', 0),
(8, 26, '2024-04-18 13:03:04', 1, 80, 'Golden Cirkel (VIP) ', '', 0),
(9, 26, '2024-04-18 13:14:07', 1, 80, 'Golden Cirkel (VIP) ', '', 0),
(10, 26, '2024-04-18 13:14:19', 1, 80, 'Golden Cirkel (VIP) ', '', 0),
(11, 26, '2024-04-18 13:14:58', 1, 80, 'Golden Cirkel (VIP) ', '', 0),
(12, 26, '2024-04-18 13:15:13', 1, 80, 'Golden Cirkel (VIP) ', '', 0),
(13, 26, '2024-04-18 13:17:04', 1, 80, 'Golden Cirkel (VIP) ', '272e10eca07373e7091caf2eceaafece9999370d100c09b68e5efbfbb5ef1b8ea72c95c3c10041075a3cd91d82eb8f469d1a7a1b6ca144b6e323fe41ad8ce77b', 0),
(14, 26, '2024-04-18 13:24:05', 1, 80, 'Golden Cirkel (VIP) ', '786c0edbc246a3d46421865e3c75b2229fee21e236153d8515d89d7e62036cb46acca89b4fc19987e6e03798f0b437d99e61c969992058c46040786bc8cdf56d', 0),
(15, 26, '2024-04-18 13:26:02', 2, 70, 'casual', '66050f266d1dba9a86f73612f288170e7c00355d1e7e2b43a71ea53a66640a8dfc1ac6aa50ac96fa32d75c16118303e8de61a7bb1f7e465caa6d481659ff031e', 0),
(16, 26, '2024-04-18 13:38:43', 2, 70, 'casual', 'f006839ad2951557d08422a851f9994da3e58fd37708719d49698c463ecde8104a5de1ab77797fb0cf79caf6d898bf45313e10c548ee57a816107b91f184ae9a', 1),
(17, 26, '2024-04-18 13:40:31', 1, 80, 'Golden Cirkel (VIP) ', 'aa4e8cf20a211762055ed3050a222d7c5de286a518fce4c9fc210782eca63b11380ebbde9ce76557389584c11f3fc57dabec972cb3ff36d742b6689537150910', 0),
(18, 26, '2024-04-18 13:41:00', 1, 80, 'Golden Cirkel (VIP) ', '45efa8e1d0756c7f06693be2daeee3165257c173542bda2c656ffa9cabbe53abc6ab846e6790e3f65701e0d9f1f7916c13de44a279b94e04e224106a5f8c468d', 0),
(21, 26, '2024-04-19 10:29:24', 3, 50, 'normal', 'ba05338ecee8589c0b22e1e1e87aa523afc66683de5bd3b31f145a46d799df8161a509f7c95b8ff44c8c06b5157eb611de804d64d0b798570a4e92b4c3347714', 1),
(22, 26, '2024-04-19 14:02:37', 1, 80, 'Golden Cirkel (VIP) ', '6ec936bed3f2fb348bf09626965107ea4ca4af57852ec8fd4ae14e871af5d44b4edf71b650bd8be609edfa121b9eb250579b89d6883149e83f25265093dd772b', 1),
(23, 26, '2024-04-19 14:08:27', 1, 80, 'Golden Cirkel (VIP) ', '389ae704febb6fa2daad45e32631fcab30fcc0e3429a4b7f3665e04f350c0ea6024d9145c4700013926d7629ec03c9d4d0e772ccc6ae4be837c581c0d3f0ae1d', 1),
(24, 26, '2024-04-19 14:22:35', 1, 80, 'Golden Cirkel (VIP) ', '2b6cbd5d176ce30cc0d232be803545cab1592c0d6ec3e3846fb5d2f0fccd2329d19c1764da07557b8e5b4b913aa297a85d03d837a660b0577801e8111a79fa16', 0),
(25, 26, '2024-04-19 14:24:38', 1, 80, 'Golden Cirkel (VIP) ', '3a1ce73eebd4882e100a33db5604b63869d0bcb42a0db1bdf52d8ba686b7c83e7ed095c005a445c40f77fd96485d13b98f21b6a2bde1ff6f5e12439898794588', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`) VALUES
(3, 'admin'),
(2, 'bedrijf'),
(1, 'member');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `evenementen`
--
ALTER TABLE `evenementen`
  ADD PRIMARY KEY (`evenementID`);

--
-- Indexen voor tabel `tbloverdraagnotifications`
--
ALTER TABLE `tbloverdraagnotifications`
  ADD PRIMARY KEY (`notificatieID`);

--
-- Indexen voor tabel `tbltickets`
--
ALTER TABLE `tbltickets`
  ADD PRIMARY KEY (`TicketID`);

--
-- Indexen voor tabel `tblzalen`
--
ALTER TABLE `tblzalen`
  ADD PRIMARY KEY (`zaalID`);

--
-- Indexen voor tabel `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_category_name` (`name`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `user_purchases`
--
ALTER TABLE `user_purchases`
  ADD PRIMARY KEY (`purchaseID`);

--
-- Indexen voor tabel `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `evenementen`
--
ALTER TABLE `evenementen`
  MODIFY `evenementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `tbloverdraagnotifications`
--
ALTER TABLE `tbloverdraagnotifications`
  MODIFY `notificatieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT voor een tabel `tbltickets`
--
ALTER TABLE `tbltickets`
  MODIFY `TicketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `tblzalen`
--
ALTER TABLE `tblzalen`
  MODIFY `zaalID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `ticket_categories`
--
ALTER TABLE `ticket_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT voor een tabel `user_purchases`
--
ALTER TABLE `user_purchases`
  MODIFY `purchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
