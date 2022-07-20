-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 22 2022 г., 11:03
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `films`
--

-- --------------------------------------------------------

--
-- Структура таблицы `actor`
--

CREATE TABLE `actor` (
  `ID_Actor` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `actor`
--

INSERT INTO `actor` (`ID_Actor`, `name`) VALUES
(1, 'Джаред Лето'),
(2, 'Бенедикт Камбербетч'),
(3, 'Метт Сміт'),
(4, 'Адріа Архона'),
(5, 'Чиветел Еджіофор'),
(6, 'Бенедикт Вонґ');

-- --------------------------------------------------------

--
-- Структура таблицы `film`
--

CREATE TABLE `film` (
  `name` text NOT NULL,
  `date` date NOT NULL,
  `country` text NOT NULL,
  `quality` text NOT NULL,
  `resolution` text NOT NULL,
  `codec` text NOT NULL,
  `producer` text NOT NULL,
  `director` text NOT NULL,
  `carrier` text NOT NULL,
  `ID_Film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `film`
--

INSERT INTO `film` (`name`, `date`, `country`, `quality`, `resolution`, `codec`, `producer`, `director`, `carrier`, `ID_Film`) VALUES
('Морбіус', '2022-03-24', 'США', '1080p', '1980х720', 'WebRip', 'Аві Арад', 'Даніель Еспіноса', 'DVD', 1),
('Доктор Стрендж', '2016-10-26', 'США', '720p', '1980х1080', 'HDRip', 'Кевін Файгі', 'Скотт Дерріксон', 'CD,DVD', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `film_actor`
--

CREATE TABLE `film_actor` (
  `FID_Film` int(11) NOT NULL,
  `FID_Actor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `film_actor`
--

INSERT INTO `film_actor` (`FID_Film`, `FID_Actor`) VALUES
(1, 1),
(1, 3),
(1, 4),
(2, 2),
(2, 6),
(2, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `film_genre`
--

CREATE TABLE `film_genre` (
  `FID_Film` int(11) NOT NULL,
  `FID_Genre` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `film_genre`
--

INSERT INTO `film_genre` (`FID_Film`, `FID_Genre`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE `genre` (
  `ID_Genre` int(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `genre`
--

INSERT INTO `genre` (`ID_Genre`, `title`) VALUES
(1, 'Екшн'),
(2, 'Фантастика'),
(3, 'Бойовик'),
(4, 'Пригоди');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `actor`
--
ALTER TABLE `actor`
  ADD KEY `ID_Actor` (`ID_Actor`);

--
-- Индексы таблицы `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`ID_Film`);

--
-- Индексы таблицы `film_actor`
--
ALTER TABLE `film_actor`
  ADD KEY `FID_Actor` (`FID_Actor`),
  ADD KEY `FID_Film` (`FID_Film`);

--
-- Индексы таблицы `film_genre`
--
ALTER TABLE `film_genre`
  ADD KEY `FID_Film` (`FID_Film`),
  ADD KEY `FID_Genre` (`FID_Genre`) USING BTREE;

--
-- Индексы таблицы `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`ID_Genre`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `film_actor`
--
ALTER TABLE `film_actor`
  ADD CONSTRAINT `film_actor_ibfk_1` FOREIGN KEY (`FID_Actor`) REFERENCES `actor` (`ID_Actor`),
  ADD CONSTRAINT `film_actor_ibfk_2` FOREIGN KEY (`FID_Film`) REFERENCES `film` (`ID_Film`);

--
-- Ограничения внешнего ключа таблицы `film_genre`
--
ALTER TABLE `film_genre`
  ADD CONSTRAINT `film_genre_ibfk_1` FOREIGN KEY (`FID_Film`) REFERENCES `film` (`ID_Film`),
  ADD CONSTRAINT `film_genre_ibfk_2` FOREIGN KEY (`FID_Genre`) REFERENCES `genre` (`ID_Genre`);

--
-- Ограничения внешнего ключа таблицы `genre`
--
ALTER TABLE `genre`
  ADD CONSTRAINT `genre_ibfk_1` FOREIGN KEY (`ID_Genre`) REFERENCES `film_genre` (`FID_Genre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
