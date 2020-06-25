-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 6 月 25 日 16:51
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
  `honbun` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `06kadai_table`
--

INSERT INTO `06kadai_table` (`id`, `title`, `hizuke`, `img_file`, `honbun`, `updated_at`) VALUES
(1, 'mmm', '2020-06-05', 'uploads/56fee0147b271bb54e3a09fb88b7d785f297fad2.jpg', 'xxx', '2020-06-25 23:35:52'),
(2, 'mmm', '2020-06-19', 'uploads/ae807a1af4e8f0aa94958fe27b99ce85b0584148.jpg', 'xxx', '2020-06-25 23:37:04'),
(3, 'testest', '2020-06-24', 'uploads/ae807a1af4e8f0aa94958fe27b99ce85b0584148.jpg', 'aaaaaaaaaaaaaaaa', '2020-06-25 23:42:10');

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
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
