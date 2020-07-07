-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2020 年 04 月 29 日 08:36
-- 伺服器版本： 5.7.26
-- PHP 版本： 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `Coupon`
--

-- --------------------------------------------------------

--
-- 資料表結構 `Coupon`
--

CREATE TABLE `Coupon` (
  `id` int(20) UNSIGNED NOT NULL COMMENT '流水號',
  `user_id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '優惠卷編碼',
  `number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '優惠卷號碼',
  `content` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '優惠卷內容',
  `price` int(8) NOT NULL COMMENT '金額',
  `password` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '優惠卷密碼',
  `use_date` date NOT NULL COMMENT '使用時間',
  `alidityv` date NOT NULL COMMENT '到期時間',
  `status` tinyint(4) NOT NULL COMMENT '-1 過期 0 未使用 1 已使用',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `Coupon`
--

INSERT INTO `Coupon` (`id`, `user_id`, `number`, `content`, `price`, `password`, `use_date`, `alidityv`, `status`, `created_at`, `updated_at`) VALUES
(1, 'A001', '1022001', '折價100', -100, 'HANDSOME111', '2020-05-01', '2020-05-31', 1, '2020-04-25 13:26:29', '2020-04-29 10:40:51'),
(2, 'A002', '1022002', '折價200', -200, 'SOGOOD777', '2020-05-01', '2020-05-31', 0, '2020-04-24 14:49:16', '2020-04-25 09:50:26'),
(3, 'A003', '1022003', '折價500', -500, 'VERYNICE888', '2020-05-01', '2020-05-31', 0, '2020-04-24 14:49:33', '2020-04-25 09:50:35'),
(4, 'A004', '1022004', '折價1000', -1000, 'PRETTY591', '2020-04-01', '2020-04-30', -1, '2020-04-24 14:49:01', '2020-04-28 11:48:53'),
(5, 'A005', '1022005', '免運費', -60, 'MUSIC666', '2020-04-01', '2020-04-30', -1, '2020-04-24 16:21:40', '2020-04-28 11:49:04'),
(7, 'A006', '1022006', '110', 100, 'MAX111', '2020-05-01', '2020-05-31', 0, '2020-04-29 13:46:30', '2020-04-29 13:46:30');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `Coupon`
--
ALTER TABLE `Coupon`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `Coupon`
--
ALTER TABLE `Coupon`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
