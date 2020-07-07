-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-04-27 15:00:45
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `music_classroom`
--

-- --------------------------------------------------------

--
-- 資料表結構 `activity_management`
--

CREATE TABLE `activity_management` (
  `activityId` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '活動編號',
  `activityCategory` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '活動類別',
  `activityName` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '活動名稱',
  `activityContent` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '活動內容',
  `activityStartTime` datetime NOT NULL COMMENT '活動開始時間',
  `activityEndTime` datetime NOT NULL COMMENT '活動結束時間',
  `activityLocation` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '活動地點',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `activity_management`
--

INSERT INTO `activity_management` (`activityId`, `activityCategory`, `activityName`, `activityContent`, `activityStartTime`, `activityEndTime`, `activityLocation`, `created_at`, `updated_at`) VALUES
('A001', '說明會', '春季吉他班說明會', '說明會－時 間：2019年11月25日（一）晚上18:00~19:30費 用：免費地 點：台北市大安區辛亥路一段 (近台電大樓捷運站)', '2019-11-25 18:00:00', '2019-11-25 19:30:00', '台北市大安區辛亥路一段', '2019-10-01 16:10:33', '2020-04-27 20:25:24'),
('A002', '說明會', '春季鋼琴班說明會', '說明會－時 間：2019年12月11日（三）晚上18:00~19:30費 用：免費地 點：台北市大安區辛亥路一段 (近台電大樓捷運站)', '2019-12-11 18:00:00', '2019-12-11 19:30:00', '台北市大安區辛亥路一段', '2019-10-11 21:35:10', '2020-04-27 20:25:30'),
('A003', '講座', '鐵玫瑰音樂學院：大師講堂', '目的為拓展大眾對流行音樂的認識與視野，本活動邀請薛忠銘、王治平、侯志堅、許景淳、馬修連恩等樂壇大師，以結合說唱及現場音樂表演的方式，輕鬆地帶領大家進入寬廣的流行音樂世界。首場講堂6月28日（日）下午1時於桃園展演中心大廳展開，邀請到臺灣音樂大師、具豐富跨國製作經驗的王治平老師，以「音樂製作與跨國樂手的音樂合作」為題，結合講座及現場吉他演奏，與大家分享他的音樂故事。', '2019-12-11 18:00:00', '2019-12-11 19:30:00', '台北市忠孝東路五段482號15樓', '2019-12-01 18:00:10', '2020-04-27 20:26:15'),
('A004', '發表會', '春季中提琴班發表會', '發表會－\n時 間：2020年03月11日（三）晚上19:00~21:00\n地 點：台北市大安區辛亥路一段 (近台電大樓捷運站)', '2020-03-11 19:00:00', '2020-03-11 21:00:00', '台北市大安區辛亥路一段', '2020-02-26 13:10:25', '2020-04-27 20:25:57'),
('A005', '發表會', '春季小提琴班發表會', '發表會－時 間：2020年04月15日（三）晚上19:00~21:00地 點：台北市大安區辛亥路一段 (近台電大樓捷運站)', '2020-04-15 19:00:00', '2020-04-15 21:00:00', '台北市大安區辛亥路一段', '2020-03-10 16:22:15', '2020-04-27 20:30:41'),
('A006', '發表會', '春季鋼琴班發表會', '發表會－\n時 間：2020年04月18日（六）晚上19:00~21:00\n地 點：台北市大安區辛亥路一段 (近台電大樓捷運站)', '2020-04-18 19:00:00', '2020-04-18 21:00:00', '台北市大安區辛亥路一段', '2020-03-11 08:42:17', '2020-04-27 20:26:03'),
('A007', '說明會', '夏季吉他班說明會', '說明會－\n時 間：2020年04月25日（六）晚上18:00~19:30\n費 用：免費\n地 點：台北市大安區辛亥路一段 (近台電大樓捷運站)', '2020-04-25 18:00:00', '2020-04-25 19:30:00', '台北市大安區辛亥路一段', '2020-04-01 07:33:12', '2020-04-27 20:25:34'),
('A008', '說明會', '夏季小提琴班說明會', '說明會－\n時 間：2020年05月02日（六）晚上18:00~19:30\n費 用：免費\n地 點：台北市大安區辛亥路一段 (近台電大樓捷運站)', '2020-05-02 18:00:00', '2020-05-02 19:30:00', '台北市大安區辛亥路一段', '2020-03-02 12:10:11', '2020-04-27 20:25:37'),
('A009', '說明會', '夏季烏克莉莉班說明會', '說明會－\n時 間：2020年05月04日（一）晚上18:00~19:30\n費 用：免費\n地 點：台北市大安區辛亥路一段 (近台電大樓捷運站)', '2020-05-04 18:00:00', '2020-05-04 19:30:00', '台北市大安區辛亥路一段', '2020-04-10 15:16:42', '2020-04-27 20:25:42'),
('A010', '講座', '搖滾 BAND！變搖滾！', '好聲音與舞台表達極為重要，唱出自己的風格能讓觀眾耳目一新，肢體技能同樣不能忽視。由文化部影視及流行音樂產業局主辦、台灣音樂文化國際交流協會承辦的音樂巡迴講座「搖滾 BAND！變搖滾！」，第二季「Band 精彩」系列將從下週六 6/13 開跑，在台北舉辦講座，以「用一首歌的時間全面捕獲觀眾的心」為主題，邀請許多資深音樂人、製作人、經紀人、專業舞台 PA 和硬體總監等老師，分享如何打造獨一無二的現場演出。重點是，講座全程免費！', '2020-05-26 08:00:00', '2020-05-28 16:00:00', '新北市板橋區遠東路1號2樓', '2020-04-01 14:11:15', '2020-04-27 20:30:33');

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '使用者帳號',
  `pwd` char(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '使用者密碼',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '管理者姓名',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='管理者帳號';

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`id`, `username`, `pwd`, `name`, `created_at`, `updated_at`) VALUES
(2, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', NULL, '2020-04-27 11:32:27', '2020-04-27 11:32:27');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT '流水號',
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '使用者名稱',
  `pwd` char(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '使用者密碼',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '姓名',
  `gender` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '性別',
  `phoneNumber` int(11) NOT NULL COMMENT '手機號碼',
  `birthday` datetime NOT NULL COMMENT '出生年月日',
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '地址',
  `isActivated` tinyint(1) NOT NULL DEFAULT 0 COMMENT '開通狀況',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='使用者資料表';

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `username`, `pwd`, `name`, `gender`, `phoneNumber`, `birthday`, `address`, `isActivated`, `created_at`, `updated_at`) VALUES
(2, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '', '', 0, '0000-00-00 00:00:00', '', 0, '2020-04-27 11:32:40', '2020-04-27 11:32:40');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `activity_management`
--
ALTER TABLE `activity_management`
  ADD PRIMARY KEY (`activityId`);

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
