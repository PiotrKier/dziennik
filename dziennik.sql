-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 01:18 AM
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
(16, '6');

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
  `edycja` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownik`
--

INSERT INTO `uzytkownik` (`uzytkownik_id`, `imie`, `drugie_imie`, `nazwisko`, `haslo`, `edycja`) VALUES
(1, 'Jan', 'Adam', 'Kowalski', 'Haslo1!23', 1),
(2, 'Anna', NULL, 'Nowak', 'Xyz@2023#', 1),
(3, 'Piotr', 'Marek', 'Wiśniewski', 'Abc#4567$', 1),
(4, 'Kasia', NULL, 'Zielińska', 'P@ssW0rd99', 1),
(5, 'Tomasz', 'Krzysztof', 'Mazur', 'R@nd0mKey!', 1),
(6, 'Ewa', NULL, 'Kwiatkowska', 'Secure#21$', 0),
(7, 'Marek', 'Jerzy', 'Jankowski', 'P@ssword1!', 0),
(8, 'Magda', NULL, 'Wojciechowska', 'A!2b3C4d5', 0),
(9, 'Kamil', 'Rafał', 'Krawczyk', 'L0ck!Key23', 0),
(10, 'Paulina', NULL, 'Dąbrowska', 'H#2YzX@p$', 0),
(11, 'Jakub', NULL, 'Pawlak', 'V@ry$tr0ng', 0),
(12, 'Marta', 'Sylwia', 'Zając', 'F0rTY@tw1!', 0),
(13, 'Filip', NULL, 'Kaczmarek', 'H@ppY7Luck', 0),
(14, 'Agnieszka', 'Ewelina', 'Michalska', 'Sun#rise88$', 0),
(15, 'Dawid', NULL, 'Grabowski', 'M@agic4Real', 0);

--
-- Indeksy dla zrzutów tabel
--

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
  ADD PRIMARY KEY (`uzytkownik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ocena`
--
ALTER TABLE `ocena`
  MODIFY `ocena_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `przedmiot`
--
ALTER TABLE `przedmiot`
  MODIFY `przedmiot_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tabela_glowna`
--
ALTER TABLE `tabela_glowna`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `uzytkownik_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
