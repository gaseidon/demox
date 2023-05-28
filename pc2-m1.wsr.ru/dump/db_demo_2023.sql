-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 28 2023 г., 18:33
-- Версия сервера: 5.6.51-log
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_demo_2023`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(6, 'ufdyj'),
(8, 'gdf');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `count_orders` int(11) DEFAULT NULL,
  `status` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `user_id`, `number`, `count_orders`, `status`, `reason`, `created_at`, `updated_at`) VALUES
(28, 0, 1, 1117615476, 1, 'Новый', NULL, '2023-02-11 17:21:58', '2023-02-11 17:21:58'),
(30, 0, 1, 1510668529, 1, 'Подтверждённый', NULL, '2023-02-11 17:22:34', '2023-04-10 20:06:58'),
(150, 0, 1, 1117615476, 1, 'Новый', NULL, '2023-02-11 17:21:58', '2023-02-11 17:21:58'),
(151, 0, 1, 1510668529, 1, 'Подтверждённый', NULL, '2023-02-11 17:22:34', '2023-04-10 20:06:58'),
(152, 0, 1, 1117615476, 1, 'Новый', NULL, '2023-02-11 17:21:58', '2023-02-11 17:21:58'),
(154, 0, 1, 1117615476, 1, 'Новый', NULL, '2023-02-11 17:21:58', '2023-02-11 17:21:58'),
(206, 0, 16, 1665764681, 2, 'Новый', NULL, '2023-04-11 20:09:17', '2023-04-11 20:09:17'),
(208, 0, 16, 1436296297, 1, 'Отменённый', 'hygfh', '2023-04-11 20:09:42', '2023-05-13 09:57:23'),
(215, 0, 16, 1768960746, 6, 'Новый', NULL, '2023-04-12 19:42:59', '2023-04-12 19:42:59'),
(217, 0, 16, 1050676637, 2, 'Новый', NULL, '2023-04-12 19:46:51', '2023-04-12 19:46:51'),
(219, 0, 16, 1696881503, 4, 'Новый', NULL, '2023-04-12 20:13:58', '2023-04-12 20:13:58'),
(221, 0, 16, 1601127272, 1, 'Новый', NULL, '2023-04-12 20:14:30', '2023-04-12 20:14:30'),
(223, 0, 16, 1643847253, 1, 'Новый', NULL, '2023-04-12 20:15:22', '2023-04-12 20:15:22'),
(225, 0, 16, 1963104050, 1, 'Подтверждённый', NULL, '2023-04-12 20:16:02', '2023-05-13 08:27:53'),
(250, 49, 16, NULL, 32, NULL, NULL, '2023-04-12 21:07:17', '2023-05-13 08:39:37'),
(252, 50, 16, NULL, 11, NULL, NULL, '2023-05-01 19:45:59', '2023-05-13 08:41:05'),
(253, 51, 16, NULL, 3, NULL, NULL, '2023-05-13 08:40:54', '2023-05-13 08:41:06'),
(263, 0, 13, 1447821418, 1, 'Подтверждённый', NULL, '2023-05-18 20:45:54', '2023-05-18 20:58:33'),
(265, 0, 13, 1668666311, 1, 'Новый', NULL, '2023-05-27 18:09:14', '2023-05-27 18:09:14'),
(267, 0, 13, 1635783026, 4, 'Новый', NULL, '2023-05-27 18:10:19', '2023-05-27 18:10:19'),
(269, 0, 32, 1584371988, 2, 'Новый', NULL, '2023-05-28 15:24:09', '2023-05-28 15:24:09');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `country` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `model` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count_products` int(11) NOT NULL,
  `path` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `country`, `year`, `model`, `category`, `count_products`, `path`, `created_at`) VALUES
(1, 'павп', 1234324, 'gg', 3232, 'аыв', 'ufdyj', 122, 'images/upload/1_1684940935_jG8yF_TP7VM.jpg', '2023-05-24 15:08:55'),
(2, 'павпва', 43, 'авыа', 12332, 'fdfs', 'ufdyj', 117, 'images/upload/1_1685119393_изображение_2023-05-26_194312782.png', '2023-05-26 16:43:13'),
(3, 'павпва', 321, 'fdsfdsf', 343, 'fdsfsdf', 'ufdyj', 123, 'images/upload/1_1685120322_r9hRIhRhh-Y.jpg', '2023-05-26 16:58:42'),
(4, 'gfd', 123, 'gg', 45, 'gfd', 'gdf', 213, 'images/upload/1_1685121853_jG8yF_TP7VM.jpg', '2023-05-26 17:24:13'),
(5, 'павпва', 453, 'gdfg', 324, 'fdgfg', 'ufdyj', 234, 'images/upload/1_1685121865_jG8yF_TP7VM.jpg', '2023-05-26 17:24:25'),
(6, 'альебрт', 321, 'авыа', 4324, 'аыв', 'ufdyj', 123, 'images/upload/1_1685284742_jG8yF_TP7VM.jpg', '2023-05-28 14:39:02');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `name`, `surname`, `patronymic`, `login`, `email`, `password`, `role`) VALUES
(31, 'павпва', 'павп', 'выавыа', 'danil12345434', 'gfdgfd4444g@mail.ru', 'e10adc3949ba59abbe56e057f20f883e', 'client'),
(32, 'павп', 'павпавпвап', 'выавыа', 'danil1234532', 'al32l@mail.ru', 'e10adc3949ba59abbe56e057f20f883e', 'client'),
(33, 'павп', 'пвап', 'павп', 'gfdg', 'dad234324a@mail.ru', 'e10adc3949ba59abbe56e057f20f883e', 'client'),
(34, 'Данил', 'Гасилов', 'Александрович', 'admin', 'admin@mail.ru', 'e020590f0e18cd6053d7ae0e0a507609', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
