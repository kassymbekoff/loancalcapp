-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 25 2020 г., 17:54
-- Версия сервера: 10.4.13-MariaDB
-- Версия PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `loandb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `amount` decimal(19,4) NOT NULL,
  `overpayment_amount` decimal(12,2) NOT NULL,
  `term` int(11) NOT NULL,
  `percent` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `loans`
--

INSERT INTO `loans` (`id`, `start_date`, `amount`, `overpayment_amount`, `term`, `percent`, `created_at`, `updated_at`) VALUES
(1, '2020-12-25', '20000.0000', '2584.00', 24, 10, '2020-12-25 17:54:44', '2020-12-25 17:54:44');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1608818668),
('m130524_201442_init', 1608818671),
('m190124_110200_add_verification_token_column_to_user_table', 1608818671),
('m201224_134548_create_table_loans', 1608818671),
('m201225_110737_add_column_overpayment_amount', 1608894546);

-- --------------------------------------------------------

--
-- Структура таблицы `payment_schedule`
--

CREATE TABLE `payment_schedule` (
  `id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `serial` int(11) DEFAULT NULL COMMENT 'Номер платежа',
  `payment_date` date DEFAULT NULL COMMENT 'Дата платежа',
  `monthly_amount` decimal(12,2) DEFAULT NULL COMMENT 'Ежемесячный платеж',
  `percent_amount` decimal(12,2) DEFAULT NULL COMMENT 'Сумму погашаемых процентов',
  `main_amount` decimal(12,2) DEFAULT NULL COMMENT 'Сумму погашаемого основного долга',
  `principal_debt` decimal(12,2) DEFAULT NULL COMMENT 'Остаток основного долга',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `payment_schedule`
--

INSERT INTO `payment_schedule` (`id`, `loan_id`, `serial`, `payment_date`, `monthly_amount`, `percent_amount`, `main_amount`, `principal_debt`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-12-25', '2020.00', '2020.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 2, '2020-12-25', '2020.00', '2021.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 3, '2020-12-25', '2020.00', '2021.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 4, '2020-12-25', '2020.00', '2021.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 5, '2020-12-25', '2020.00', '2021.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 6, '2020-12-25', '2020.00', '2021.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 7, '2020-12-25', '2020.00', '2021.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 8, '2020-12-25', '2020.00', '2021.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 9, '2020-12-25', '2020.00', '2021.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 10, '2020-12-25', '2020.00', '2021.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 11, '2020-12-25', '2020.00', '2021.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 12, '2020-12-25', '2020.00', '2021.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 1, 13, '2020-12-25', '2020.00', '2021.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 1, 14, '2020-12-25', '2020.00', '2022.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, 15, '2020-12-25', '2020.00', '2022.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 1, 16, '2020-12-25', '2020.00', '2022.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 1, 17, '2020-12-25', '2020.00', '2022.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 1, 18, '2020-12-25', '2020.00', '2022.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 1, 19, '2020-12-25', '2020.00', '2022.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 1, 20, '2020-12-25', '2020.00', '2022.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 1, 21, '2020-12-25', '2020.00', '2022.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 1, 22, '2020-12-25', '2020.00', '2022.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 1, 23, '2020-12-25', '2020.00', '2022.00', '833.00', '108.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 1, 24, '2020-12-25', '2020.00', '2022.00', '841.00', '100.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `payment_schedule`
--
ALTER TABLE `payment_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `payment_schedule`
--
ALTER TABLE `payment_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
