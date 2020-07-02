-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 7 月 02 日 14:36
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsacf_d06_34`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `06kadai_table`
--

CREATE TABLE `06kadai_table` (
  `id` int(12) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `hizuke` date NOT NULL,
  `img_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `honbun` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `06kadai_table`
--

INSERT INTO `06kadai_table` (`id`, `title`, `hizuke`, `img_file`, `honbun`, `updated_at`) VALUES
(1, 'm2m2m2', '2020-06-05', 'uploads/56fee0147b271bb54e3a09fb88b7d785f297fad2.jpg', 'xxxyyy', '2020-07-02 12:51:06'),
(3, 'testest', '2020-06-24', 'uploads/ae807a1af4e8f0aa94958fe27b99ce85b0584148.jpg', 'aaaaaaaaaaaaaaaa', '2020-06-25 23:42:10'),
(6, 'なんとかクラゲ', '2020-06-30', 'uploads/56fee0147b271bb54e3a09fb88b7d785f297fad2.jpg', '', '2020-07-02 21:24:07'),
(7, 'mmm', '2020-06-19', 'uploads/5a32a082d2b60cfd5fa2e9808e57fd04de3b5f36.jpg', 'xxx', '2020-07-02 03:03:38'),
(8, 'test3test3', '2020-07-02', 'uploads/85f600cabf66725ff5b6ec5469bab2d65aeba77f.jpg', 'あいうえおおおおおおおおおお', '2020-07-02 21:02:11'),
(9, 'ユキノシタ', '2020-07-03', 'uploads/932aa3511a80f55eada74b22703dbb9ef14b07f0.jpg', '2019年6月撮影', '2020-07-02 21:04:31'),
(10, 'test4', '2020-07-02', 'uploads/7c6bb7d3579a136aedff91a97897c414ff4a57b0.jpg', '2017年8月撮影', '2020-07-02 21:23:31');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `06kadai_table`
--
ALTER TABLE `06kadai_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `06kadai_table`
--
ALTER TABLE `06kadai_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
