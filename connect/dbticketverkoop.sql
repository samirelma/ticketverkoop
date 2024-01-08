-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 08 jan 2024 om 15:58
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 7.4.29

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
  `zaalID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `evenementen`
--

INSERT INTO `evenementen` (`evenementID`, `naam`, `datum`, `aantalTickets`, `beschrijving`, `afbeelding`, `zaalID`) VALUES
(1, 'Test', '0000-00-00 00:00:00', 15, 'testtt', '', 0),
(2, 'test', '2023-11-06 00:00:00', 15, 'cool', '', 1),
(3, '', '0000-00-00 00:00:00', 0, '', '', 1),
(4, 'Hans Zimmer live! ', '2023-11-30 20:30:00', 2000, 'Hans Zimmer live a unique concert experience ', 'HansZimmerLive.jpeg', 1),
(5, 'Robi Live', '2023-12-08 00:00:00', 11, 'wwww', 'e8773f51-7d80-4086-a861-3ef6628fef30.jpeg', 0),
(6, 'ww', '2023-11-29 00:00:00', 11, 'll', 'achtergrond.jpg', 1),
(7, 'testttt', '2023-11-29 00:00:00', 1000, 'ttt', 'e8773f51-7d80-4086-a861-3ef6628fef30.jpeg', 2);

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
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `tbltickets`
--

INSERT INTO `tbltickets` (`TicketID`, `rij`, `stoel`, `evenementID`, `categoryID`, `userID`) VALUES
(1, 10, 20, 4, 1, 17);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblzalen`
--

CREATE TABLE `tblzalen` (
  `zaalID` int(11) NOT NULL,
  `naam` varchar(9999) NOT NULL,
  `afbeelding` mediumtext NOT NULL,
  `capaciteit` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `tblzalen`
--

INSERT INTO `tblzalen` (`zaalID`, `naam`, `afbeelding`, `capaciteit`) VALUES
(1, 'Sportpaleis', 'Sportpaleis.jpg', '23359'),
(2, 'Lotto Arena ', 'LottoArena.jpg', '8050');

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
(22, 'john', 'john@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$YnNjTTdtcVhacU9xcUhmVA$Wvf27gmT2sxZKqozdk/CB0GE87Ms02nMPGPKk+RokX8', 'john', 'Doe', 3, '', '2023-12-01 12:53:32', '2023-12-01 12:50:01');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_purchases`
--

CREATE TABLE `user_purchases` (
  `id` int(11) NOT NULL,
  `timeOfPurchase` datetime NOT NULL,
  `productId` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `productName` text NOT NULL,
  `productImage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `evenementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `tbltickets`
--
ALTER TABLE `tbltickets`
  MODIFY `TicketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
