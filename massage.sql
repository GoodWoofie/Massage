-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Cze 2022, 15:20
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Baza danych: `massage`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `appointment`
--

CREATE TABLE `appointment` (
  `ID` int(11) NOT NULL,
  `staff_ID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `appointment`
--

INSERT INTO `appointment` (`ID`, `staff_ID`, `date`) VALUES
(1, 1, '2022-06-08 11:00:00'),
(2, 1, '2022-06-08 13:00:00'),
(3, 2, '2022-06-08 12:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customer`
--

CREATE TABLE `customer` (
  `ID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `pesel` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `customer`
--

INSERT INTO `customer` (`ID`, `firstName`, `lastName`, `phone`, `pesel`) VALUES
(1, 'Jan', 'Potocki', '546778920', ''),
(3, 'Kacper', 'Kufel', '784844659', '85230845821');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customerappointment`
--

CREATE TABLE `customerappointment` (
  `ID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `appointmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `customerappointment`
--

INSERT INTO `customerappointment` (`ID`, `customerID`, `appointmentID`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `staff`
--

CREATE TABLE `staff` (
  `ID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `staff`
--

INSERT INTO `staff` (`ID`, `firstName`, `lastName`) VALUES
(1, 'Jan', 'Kowalczyk'),
(2, 'Adam', 'Nowy'),
(3, 'Iwona', 'Pochocka'),
(4, 'Karolina', 'Kawosz');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `staff_ID` (`staff_ID`);

--
-- Indeksy dla tabeli `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `customerappointment`
--
ALTER TABLE `customerappointment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `patientID` (`customerID`),
  ADD KEY `appointmentID` (`appointmentID`);

--
-- Indeksy dla tabeli `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `appointment`
--
ALTER TABLE `appointment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `customerappointment`
--
ALTER TABLE `customerappointment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `staff`
--
ALTER TABLE `staff`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`ID`);
COMMIT;
