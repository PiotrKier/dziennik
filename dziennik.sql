-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 08:11 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dziennik`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klasy`
--

CREATE TABLE `klasy` (
  `id_klasy` int(11) NOT NULL,
  `klasa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klasy`
--

INSERT INTO `klasy` (`id_klasy`, `klasa`) VALUES
(1, '1A'),
(2, '1B'),
(3, '1C'),
(4, '2A'),
(5, '2B'),
(6, '2C'),
(7, '3A'),
(8, '3B'),
(9, '3C');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ocena`
--

CREATE TABLE `ocena` (
  `ocena_id` int(30) NOT NULL,
  `ocena` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ocena`
--

INSERT INTO `ocena` (`ocena_id`, `ocena`) VALUES
(1, '1'),
(2, '1+'),
(3, '2-'),
(4, '2'),
(5, '2+'),
(6, '3-'),
(7, '3'),
(8, '3+'),
(9, '4-'),
(10, '4'),
(11, '4+'),
(12, '5-'),
(13, '5'),
(14, '5+'),
(15, '6-'),
(16, '6'),
(17, '6');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmiot`
--

CREATE TABLE `przedmiot` (
  `przedmiot_id` int(30) NOT NULL,
  `przedmiot` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `przedmiot`
--

INSERT INTO `przedmiot` (`przedmiot_id`, `przedmiot`) VALUES
(1, 'Język polski'),
(2, 'Język angielski'),
(3, 'Język niemiecki'),
(4, 'Matematyka'),
(5, 'Fizyka'),
(6, 'Chemia'),
(7, 'Biologia'),
(8, 'Geografia'),
(9, 'Historia'),
(10, 'Wiedza o społeczeństwie'),
(11, 'Informatyka'),
(12, 'Muzyka'),
(13, 'Wychowanie fizyczne'),
(14, 'Religia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tabela_glowna`
--

CREATE TABLE `tabela_glowna` (
  `id` int(30) NOT NULL,
  `uzytkownik_id` int(30) NOT NULL,
  `ocena_id` int(30) NOT NULL,
  `opis` varchar(255) DEFAULT NULL,
  `przedmiot_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `uzytkownik_id` int(30) NOT NULL,
  `imie` varchar(50) NOT NULL,
  `drugie_imie` varchar(50) DEFAULT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `edycja` tinyint(1) NOT NULL,
  `id_klasy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownik`
--

INSERT INTO `uzytkownik` (`uzytkownik_id`, `imie`, `drugie_imie`, `nazwisko`, `haslo`, `edycja`, `id_klasy`) VALUES
(1, 'Jan', 'Adam', 'Kowalski', 'Haslo1!23', 1, NULL),
(2, 'Anna', NULL, 'Nowak', 'Xyz@2023#', 1, NULL),
(3, 'Piotr', 'Marek', 'Wiśniewski', 'Abc#4567$', 1, NULL),
(4, 'Kasia', NULL, 'Zielińska', 'P@ssW0rd99', 1, NULL),
(5, 'Tomasz', 'Krzysztof', 'Mazur', 'R@nd0mKey!', 1, NULL),
(6, 'Ewa', NULL, 'Kwiatkowska', 'Secure#21$', 0, 4),
(7, 'Marek', 'Jerzy', 'Jankowski', 'P@ssword1!', 0, 6),
(8, 'Magda', NULL, 'Wojciechowska', 'A!2b3C4d5', 0, 2),
(9, 'Kamil', 'Rafał', 'Krawczyk', 'L0ck!Key23', 0, 6),
(10, 'Paulina', NULL, 'Dąbrowska', 'H#2YzX@p$', 0, 5),
(11, 'Jakub', NULL, 'Pawlak', 'V@ry$tr0ng', 0, 3),
(12, 'Marta', 'Sylwia', 'Zając', 'F0rTY@tw1!', 0, 9),
(13, 'Filip', NULL, 'Kaczmarek', 'H@ppY7Luck', 0, 7),
(14, 'Agnieszka', 'Ewelina', 'Michalska', 'Sun#rise88$', 0, 8),
(15, 'Dawid', NULL, 'Grabowski', 'M@agic4Real', 0, 1),
(16, 'Jan', 'Adam', 'Kowalski', 'haslo1', 0, 1),
(17, 'Michał', NULL, 'Nowak', 'haslo2', 0, 1),
(18, 'Anna', 'Maria', 'Wiśniewska', 'haslo3', 0, 1),
(19, 'Paweł', 'Jan', 'Mazur', 'haslo4', 0, 2),
(20, 'Ewa', NULL, 'Kwiatkowska', 'haslo5', 0, 2),
(21, 'Magda', 'Karolina', 'Zielińska', 'haslo6', 0, 2),
(22, 'Tomasz', 'Rafał', 'Jankowski', 'haslo7', 0, 3),
(23, 'Jakub', 'Piotr', 'Mazur', 'haslo8', 0, 3),
(24, 'Filip', NULL, 'Wiśniewski', 'haslo9', 0, 3),
(25, 'Kasia', 'Agnieszka', 'Zajac', 'haslo10', 0, 4),
(26, 'Paula', 'Monika', 'Dąbrowska', 'haslo11', 0, 4),
(27, 'Piotr', 'Andrzej', 'Kaczmarek', 'haslo12', 0, 4),
(28, 'Rafał', 'Wojciech', 'Jankowski', 'haslo13', 0, 5),
(29, 'Jakub', NULL, 'Krawczyk', 'haslo14', 0, 5),
(30, 'Natalia', 'Olga', 'Michalska', 'haslo15', 0, 5),
(31, 'Oskar', 'Adam', 'Szymański', 'haslo16', 0, 6),
(32, 'Marta', 'Sylwia', 'Woźniak', 'haslo17', 0, 6),
(33, 'Dawid', 'Maciej', 'Grabowski', 'haslo18', 0, 6),
(34, 'Wojciech', 'Paweł', 'Zając', 'haslo19', 0, 7),
(35, 'Magda', 'Zofia', 'Kaczmarek', 'haslo20', 0, 7),
(36, 'Tomasz', 'Andrzej', 'Krawczyk', 'haslo21', 0, 7),
(37, 'Wojciech', 'Paweł', 'Wiśniewski', 'haslo22', 0, 8),
(38, 'Michał', NULL, 'Jankowski', 'haslo23', 0, 8),
(39, 'Agnieszka', 'Maria', 'Bąk', 'haslo24', 0, 8),
(40, 'Tomasz', 'Adam', 'Grabowski', 'haslo25', 0, 9),
(41, 'Jakub', 'Kamil', 'Kaczmarek', 'haslo26', 0, 9),
(42, 'Marek', 'Piotr', 'Szymański', 'haslo27', 0, 9);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klasy`
--
ALTER TABLE `klasy`
  ADD PRIMARY KEY (`id_klasy`);

--
-- Indeksy dla tabeli `ocena`
--
ALTER TABLE `ocena`
  ADD PRIMARY KEY (`ocena_id`);

--
-- Indeksy dla tabeli `przedmiot`
--
ALTER TABLE `przedmiot`
  ADD PRIMARY KEY (`przedmiot_id`);

--
-- Indeksy dla tabeli `tabela_glowna`
--
ALTER TABLE `tabela_glowna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`),
  ADD KEY `ocena_id` (`ocena_id`),
  ADD KEY `przedmiot_id` (`przedmiot_id`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`uzytkownik_id`),
  ADD KEY `id_klasy` (`id_klasy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ocena`
--
ALTER TABLE `ocena`
  MODIFY `ocena_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `przedmiot`
--
ALTER TABLE `przedmiot`
  MODIFY `przedmiot_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tabela_glowna`
--
ALTER TABLE `tabela_glowna`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `uzytkownik_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabela_glowna`
--
ALTER TABLE `tabela_glowna`
  ADD CONSTRAINT `tabela_glowna_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownik` (`uzytkownik_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tabela_glowna_ibfk_2` FOREIGN KEY (`ocena_id`) REFERENCES `ocena` (`ocena_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tabela_glowna_ibfk_3` FOREIGN KEY (`przedmiot_id`) REFERENCES `przedmiot` (`przedmiot_id`) ON DELETE CASCADE;

--
-- Constraints for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD CONSTRAINT `uzytkownik_ibfk_1` FOREIGN KEY (`id_klasy`) REFERENCES `klasy` (`id_klasy`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
