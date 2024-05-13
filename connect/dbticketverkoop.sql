-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 28 apr 2024 om 18:28
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `evenementen`
--

INSERT INTO `evenementen` (`evenementID`, `naam`, `datum`, `aantalTickets`, `beschrijving`, `afbeelding`, `zaalID`, `userID`, `weergeven`) VALUES
(1, 'Test', '2024-04-19 14:05:26', 15, 'testtt', 'e8773f51-7d80-4086-a861-3ef6628fef30.jpeg', 1, 0, 0),
(4, 'Hans Zimmer live! ', '2024-04-29 10:00:44', 200, 'Hans Zimmer live a unique concert experience ', 'HansZimmerLive.jpeg', 1, 26, 1),
(5, 'Robi Live', '2023-12-08 00:00:00', 11, 'wwww', 'e8773f51-7d80-4086-a861-3ef6628fef30.jpeg', 0, 0, 0),
(6, 'ww', '2023-11-29 00:00:00', 11, 'll', 'achtergrond.jpg', 1, 0, 0),
(7, 'testttt', '2023-11-29 00:00:00', 1000, 'ttt', 'e8773f51-7d80-4086-a861-3ef6628fef30.jpeg', 2, 0, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tbltickets`
--

INSERT INTO `tbltickets` (`TicketID`, `rij`, `stoel`, `evenementID`, `categoryID`, `userID`, `purchaseID`) VALUES
(69, 1, 3, 4, 1, 34, 192),
(70, 1, 3, 4, 1, 34, 192),
(71, 1, 2, 9, 1, 34, 193),
(72, 1, 2, 9, 1, 34, 193),
(73, 1, 5, 4, 1, 34, 195),
(74, 1, 5, 4, 1, 34, 195),
(75, 1, 6, 4, 1, 34, 197),
(76, 1, 6, 4, 1, 34, 197),
(77, 212, 1, 4, 3, 34, 198);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `ticket_categories`
--

INSERT INTO `ticket_categories` (`id`, `name`, `icon`, `beschrijving`, `prijs`) VALUES
(1, 'Golden Cirkel (VIP) ', 'vipIcon.jpg', 'Op vertoon van dit ticket krijg je toegang tot het eten, de zaal en de parking. De deuren van de voorstelling gaan telkens een half uur voor de start van de voorstelling open. ', 80),
(2, 'casual', '', 'de stoelen met goed zicht achter de vip arrangementen ', 70),
(3, 'normal', '', 'zitplaatsen verst verwijderd van het podium ', 50);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `function`, `profilePicture`, `updatedAt`, `createdAt`) VALUES
(33, 'klant', 'klant@123.com', '$argon2id$v=19$m=65536,t=4,p=1$REZQM0hUWnZKTUpabVhzVQ$K9Qb5GvYBsc0FOlD6Y1r2YRWLgqhkfFNaHSQWUe5BMs', 'klant', 'klant', 1, '', '2024-04-27 13:35:07', '2024-04-27 13:35:07'),
(34, 'alfa@alfa.com', 'alfa@alfa.com', '$argon2id$v=19$m=65536,t=4,p=1$RjF5bzhxZVRzSGhJUFFXdw$gQYbZxgXr41R+usmVbenF+mov2ZeODUUlNHzvq1JCN0', 'alfa', 'alfa', 2, '', '2024-04-28 13:14:00', '2024-04-28 13:14:00');

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
  `isPaid` tinyint(1) NOT NULL,
  `blok` int(11) NOT NULL,
  `stoel` int(11) NOT NULL,
  `evenementID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user_purchases`
--

INSERT INTO `user_purchases` (`purchaseID`, `id`, `timeOfPurchase`, `productId`, `price`, `productName`, `secretkey`, `isPaid`, `blok`, `stoel`, `evenementID`) VALUES
(198, 34, '2024-04-28 18:04:25', 3, 50, 'normal', '82b15ac8b11ad108e511888ca6110dd57acbd07439c00c21dff0b59b3ae89e044446e90ae25dc2f2d58bfd77e5d4c2b2097c929c9fa0d1b4a989ac781b11f89b', 1, 212, 1, 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `TicketID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT voor een tabel `user_purchases`
--
ALTER TABLE `user_purchases`
  MODIFY `purchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT voor een tabel `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
