-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Май 16 2017 г., 14:43
-- Версия сервера: 5.5.54-0ubuntu0.12.04.1-log
-- Версия PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `note-book_blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `pubdate` datetime NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `title`, `text`, `category_id`, `pubdate`, `image`) VALUES
(1, 'Trump revealed highly classified information to Russian foreign minister and ambassador', '<p style=\"box-sizing: border-box; font-size: 18px; font-family: Georgia; line-height: 1.8em; margin: 0px auto 18px; max-width: 100%; color: rgb(17, 17, 17);\">President Trump revealed highly classified information to the Russian foreign minister and ambassador in a White House meeting last week, according to current and former U.S. officials, who said Trumpâ€™s disclosures jeopardized a critical source of intelligence on the Islamic State.</p><p style=\"box-sizing: border-box; font-size: 18px; font-family: Georgia; line-height: 1.8em; margin: 0px auto 18px; max-width: 100%; color: rgb(17, 17, 17);\">The information the president relayed had been provided by a U.S. partner through an intelligence-sharing arrangement considered so sensitive that details have been withheld from allies and tightly restricted even within the U.S. government, officials said.</p><p style=\"box-sizing: border-box; font-size: 18px; font-family: Georgia; line-height: 1.8em; margin: 0px auto 18px; max-width: 100%; color: rgb(17, 17, 17);\">The partner had not given the United States permission to share the material with Russia, and officials said Trumpâ€™s decision to do so endangers cooperation from an ally that has access to the inner workings of the Islamic State. After Trumpâ€™s meeting, senior White House officials took steps to contain the damage, placing calls to the CIA and the National Security Agency.</p><p style=\"box-sizing: border-box; font-size: 18px; font-family: Georgia; line-height: 1.8em; margin: 0px auto 18px; max-width: 100%; color: rgb(17, 17, 17);\">â€œThis is code-word information,â€ said a U.S. official familiar with the matter, using terminology that refers to one of the highest classification levels used by American spy agencies. Trump â€œrevealed more information to the Russian ambassador than we have shared with our own allies.â€ The revelation comes as the president faces rising legal and political pressure on multiple Russia-related fronts. Last week,', 0, '2017-05-16 11:24:20', ''),
(4, '7,000-plus Coloradansâ€™ names, addresses used to post fake comments about government decision', '<font face=\"Arial, Verdana\"><span style=\"font-size: 13.3333px;\">7,000-plus Coloradansâ€™ names, addresses used to post fake comments about government decision</span></font>', 0, '2017-05-16 11:39:30', '');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `pubdate` datetime NOT NULL,
  `articles_id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `author`, `nickname`, `text`, `pubdate`, `articles_id`, `email`) VALUES
(1, 'mac7', '', 'He thinks he\'s Reagan when he\'s not even W. Not that I think that much of Reagan to begin with...', '2017-05-16 14:25:37', 1, 'mac7@gmail.com'),
(2, 'mac7', '', 'The White House Weekly schedule  \n \n1 President Screws up \n2 President\'s aides do Damage Control \n3 President makes aides look like complete fools', '2017-05-16 14:26:02', 1, 'mac7@gmail.com'),
(3, 'ChaunceyGardner', '', 'Trumplings! To the barricades! Your orange lord and master has admitted his deed via Twitter. Now justify it!', '2017-05-16 14:27:09', 1, 'ChaunceyGardner@gmail.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
