-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 20 Sty 2021, 18:26
-- Wersja serwera: 5.7.29
-- Wersja PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `19_kijowski`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `artist`
--

CREATE TABLE `artist` (
  `artist_id` int(4) NOT NULL,
  `artist_firstName` varchar(256) NOT NULL,
  `artist_lastName` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `artist`
--

INSERT INTO `artist` (`artist_id`, `artist_firstName`, `artist_lastName`) VALUES
(1, 'Hieronim', 'Bosch'),
(2, 'Salvador', 'Dali'),
(3, 'Zdzisław', 'Beksiński');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `artwork`
--

CREATE TABLE `artwork` (
  `artwork_id` int(4) NOT NULL,
  `artwork_title` varchar(256) NOT NULL,
  `artwork_price` int(9) DEFAULT NULL,
  `artwork_year` int(4) DEFAULT NULL,
  `artwork_artist_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `artwork`
--

INSERT INTO `artwork` (`artwork_id`, `artwork_title`, `artwork_price`, `artwork_year`, `artwork_artist_id`) VALUES
(1, 'Ogród rozkoszy ziemskich', 1000, 1500, 1),
(2, 'Trwałość pamięci', 1235, 1933, 2),
(3, 'Sen spowodowany lotem pszczoły', 1234, 1944, 2),
(4, 'Pełzająca śmierć', 1245, 1973, 3),
(5, 'Niezatutułowany', 1235, 1976, 3),
(6, 'Y', 1219, 2005, 3),
(7, 'Niezatytułowany II', 1259, 1978, 3),
(8, 'Wóz z sianem', 4219, 1516, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(4) NOT NULL,
  `user_cart` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `cart`
--

INSERT INTO `cart` (`cart_id`, `user_cart`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cartItem`
--

CREATE TABLE `cartItem` (
  `cartItem_id` int(4) NOT NULL,
  `cartItem_cart` int(4) DEFAULT NULL,
  `cartItem_artwork` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `user_firstName` varchar(256) NOT NULL,
  `user_lastName` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_uid` varchar(256) NOT NULL,
  `user_pwd` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `user_firstName`, `user_lastName`, `user_email`, `user_uid`, `user_pwd`) VALUES
(1, 'Jan', 'Kowalski', 'jan.kowalski@gmail.com', 'jan123', '123'),
(2, 'Karol', 'Kijowski', 'kkijowski11@gmail.com', '19_kijowski', '1234');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indeksy dla tabeli `artwork`
--
ALTER TABLE `artwork`
  ADD PRIMARY KEY (`artwork_id`),
  ADD KEY `artwork_artist_id` (`artwork_artist_id`);

--
-- Indeksy dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_cart` (`user_cart`);

--
-- Indeksy dla tabeli `cartItem`
--
ALTER TABLE `cartItem`
  ADD PRIMARY KEY (`cartItem_id`),
  ADD KEY `cartItem_cart` (`cartItem_cart`),
  ADD KEY `cartItem_artwork` (`cartItem_artwork`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `artist`
--
ALTER TABLE `artist`
  MODIFY `artist_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `artwork`
--
ALTER TABLE `artwork`
  MODIFY `artwork_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `cartItem`
--
ALTER TABLE `cartItem`
  MODIFY `cartItem_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `artwork`
--
ALTER TABLE `artwork`
  ADD CONSTRAINT `artwork_ibfk_1` FOREIGN KEY (`artwork_artist_id`) REFERENCES `artist` (`artist_id`);

--
-- Ograniczenia dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_cart`) REFERENCES `users` (`user_id`);

--
-- Ograniczenia dla tabeli `cartItem`
--
ALTER TABLE `cartItem`
  ADD CONSTRAINT `cartItem_ibfk_1` FOREIGN KEY (`cartItem_cart`) REFERENCES `cart` (`cart_id`),
  ADD CONSTRAINT `cartItem_ibfk_2` FOREIGN KEY (`cartItem_artwork`) REFERENCES `artwork` (`artwork_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
