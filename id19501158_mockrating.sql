-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-10-16 18:45:07
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `id19501158_mockrating`
--

-- --------------------------------------------------------

--
-- 資料表結構 `dz_thread`
--

CREATE TABLE `dz_thread` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `nickname` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `account` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `content_negative` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `Revise_C` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Revise_C_N` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `q1` int(5) DEFAULT NULL,
  `q2` int(5) DEFAULT NULL,
  `q3` int(5) DEFAULT NULL,
  `q4` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `dz_thread`
--

INSERT INTO `dz_thread` (`id`, `product_id`, `nickname`, `account`, `content`, `content_negative`, `Revise_C`, `Revise_C_N`, `ip`, `time`, `q1`, `q2`, `q3`, `q4`) VALUES
(1, 1, 'Tina', 'test1', 'cccccccccccccccccc', 'cccccccccccccccc', '１１', '１１', '127.0.0.1', '2022-10-15 06:23:34', 5, 5, 5, 5),
(324, 9, 'Tina', 'test1', 'x', 'x', '1', '1', '127.0.0.1', '2022-10-15 06:26:49', 1, 1, 1, 1),
(325, 3, 'Tina', 'test1', 'x', 'x', '１', '１', '127.0.0.1', '2022-10-15 06:26:56', 1, 1, 1, 1),
(326, 2, 'Tina', 'test1', '1', '1', '１', '１', '127.0.0.1', '2022-10-15 06:31:55', 1, 1, 1, 1),
(327, 4, 'Tina', 'test1', '1', '1', '１', '１', '127.0.0.1', '2022-10-15 06:31:59', 1, 1, 1, 1),
(328, 7, 'Tina', 'test1', '1', '1', '１', '１', '127.0.0.1', '2022-10-15 06:53:58', 1, 1, 1, 1),
(329, 8, 'Tina', 'test1', '1', '1', '１', '１', '127.0.0.1', '2022-10-15 06:54:14', 5, 5, 5, 5),
(330, 5, 'Tina', 'test1', 'sss', 'ss', 'vvvvvvvv1', 'vvvvvvvvvvv1', '127.0.0.1', '2022-10-15 16:04:53', 1, 1, 1, 1),
(338, 9, 'Tina', 'test1', '11', '11', '1', '1', '127.0.0.1', '2022-10-15 16:51:43', 1, 1, 1, 1),
(339, 9, 'Tina', 'test1', '１１１', '１１１', '1', '1', '127.0.0.1', '2022-10-15 16:55:39', 1, 1, 1, 1),
(340, 3, 'Tina', 'test1', '１', '１', '１', '１', '127.0.0.1', '2022-10-15 16:55:57', 1, 1, 1, 1),
(341, 1, 'Tina', 'test1', '１１', '１１', '１１', '１１', '127.0.0.1', '2022-10-15 16:56:13', 5, 5, 5, 5),
(342, 4, 'Tina', 'test1', '１', '１', '１', '１', '127.0.0.1', '2022-10-15 16:56:30', 1, 1, 1, 1),
(343, 7, 'Tina', 'test1', '１', '１', '１', '１', '127.0.0.1', '2022-10-15 16:56:42', 1, 1, 1, 1),
(344, 6, 'Tina', 'test1', '１', '１', '１', '１', '127.0.0.1', '2022-10-15 16:56:58', 5, 5, 5, 5),
(345, 6, 'Tina', 'test1', '１', '１', '１', '１', '127.0.0.1', '2022-10-15 16:57:05', 5, 5, 5, 5),
(346, 8, 'Tina', 'test1', '１', '１', '１', '１', '127.0.0.1', '2022-10-15 16:57:15', 5, 5, 5, 5),
(347, 2, 'Tina', 'test1', '１', '１', '１', '１', '127.0.0.1', '2022-10-15 16:57:29', 1, 1, 1, 1),
(348, 9, 'Tina', 'test1', '11', '11', '1', '1', '127.0.0.1', '2022-10-16 16:40:38', 1, 1, 1, 1),
(349, 9, 'Tina', 'test1', '1', '1', '1', '1', '127.0.0.1', '2022-10-16 16:41:29', 1, 1, 1, 1),
(350, 9, 'Tina', 'test1', '1', '1', '1', '1', '127.0.0.1', '2022-10-16 16:42:51', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`id`, `name`, `status`) VALUES
(1, '時尚皮帶', 0),
(2, '灰色踝襪', 0),
(3, '防水機車口罩', 0),
(7, '雪花深灰毛帽', 0),
(8, '黑色踝襪', 0),
(6, '褐色皮帶', 0),
(5, '純黑護膝', 0),
(4, '質感灰毛帽', 0),
(9, '【練習用】T恤', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `profileimg`
--

CREATE TABLE `profileimg` (
  `status` int(11) NOT NULL,
  `account` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `profileimg`
--

INSERT INTO `profileimg` (`status`, `account`) VALUES
(0, 'test1'),
(1, 'test2'),
(1, '11'),
(0, 'sere'),
(1, 'test3'),
(0, 'demo'),
(1, 'ssssssssss'),
(1, 'hidihid');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `account` varchar(32) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `nickname` varchar(32) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `account`, `pwd`, `nickname`, `is_admin`) VALUES
(1, 'test1', '827ccb0eea8a706c4c34a16891f84e7b', 'Tina', 1),
(2, 'test2', '827ccb0eea8a706c4c34a16891f84e7b', '小華華', 1),
(42, '11', '6512bd43d9caa6e02c990b0a82652dca', '11', 0),
(43, 'sere', '87697a92382d3302b376ae04117b203d', 'Lin', 0),
(44, 'test3', '827ccb0eea8a706c4c34a16891f84e7b', '咩咩', 0),
(53, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `dz_thread`
--
ALTER TABLE `dz_thread`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `dz_thread`
--
ALTER TABLE `dz_thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
