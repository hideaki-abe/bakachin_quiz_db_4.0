-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-07-15 13:09:27
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `php_quiz`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `scores`
--

INSERT INTO `scores` (`id`, `created_at`, `username`, `score`) VALUES
(1, '2024-06-23 13:00:31', 'バカチンガー', 2),
(2, '2024-06-23 13:04:38', 'バカチンガー', 3),
(3, '2024-06-23 13:07:55', 'バカチンガー', 2),
(4, '2024-06-23 13:08:38', 'バカチン花子', 5),
(5, '2024-06-23 13:09:00', 'バカチンガー', 0),
(6, '2024-06-23 13:23:59', 'バカチン太郎', 5),
(7, '2024-06-23 13:45:07', 'バカチン花子', 3),
(8, '2024-06-23 13:45:49', 'バカチン一平', 1),
(9, '2024-06-25 16:07:38', 'バカチンガー', 2),
(10, '2024-06-29 03:06:55', 'バカチンガー', 2),
(11, '2024-06-29 04:05:11', 'バカチンガー', 2),
(12, '2024-06-29 05:11:13', 'バカチンガー', 1),
(13, '2024-06-30 11:44:58', 'バカチンガー', 2),
(14, '2024-06-30 12:40:47', 'バカチン太郎', 2),
(15, '2024-06-30 13:50:21', 'バカチン一平', 2),
(16, '2024-07-06 04:06:51', 'バカチンガー', 2),
(17, '2024-07-07 13:59:04', 'バカチンガー', 2),
(18, '2024-07-13 04:06:20', 'バカチンガー', 2),
(19, '2024-07-15 10:02:58', 'バカチンガー', 2),
(20, '2024-07-15 11:03:27', 'バカチンガー', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `created_at`, `username`, `email`, `password`, `role`) VALUES
(1, '2024-06-23 13:08:24', 'バカチンガー', 'bakachin@gmail.com', '$2y$10$AypUInPI3BlStM0EUMt6C.muWorJZrjGOW7wu31DJJMxGfBDj0dX6', 1),
(2, '2024-06-23 13:08:24', 'バカチン太郎', 'bakachin1@gmail.com', '$2y$10$5o/MWllcPBRCzyvyHd2bNeGBwhWY2uNQZFNaNGWvh5SY9LJ.hi0my', 1),
(3, '2024-06-23 13:23:38', 'バカチン次郎', 'bakachin2@gmail.com', '$2y$10$d0Nt9jbDITx728sZNxKgZO3DLvPZtl6tENXRktanmMi43RLnqZwLW', 1),
(4, '2024-06-23 13:45:40', 'バカチン三郎', 'bakachin3@gmail.com', '$2y$10$yiL3wVpUyq.vw/ue4TJNTevSnub.Rv2cqo9QgjI7WjAcHt25RrFKq', 1),
(7, '2024-06-30 12:50:33', 'バカチン七子', 'bakachin7@gmail.com', '$2y$10$aT2cisateANiO9EDkvD/ReN1pp/lsu3vrsVPUvCfkyY/u/JIBTVmm', 1),
(8, '2024-06-30 13:35:03', 'バカチン四郎', 'bakachin4@gmail.com', '$2y$10$dv1C3zzFSVfvnYV4dIotvugW8sjDSZG9DMYw45Yr7ExUxWw/7wG06', 1),
(9, '2024-07-07 13:42:08', 'バカチン五郎', 'bakachin5@gmail.com', '$2y$10$aFmOvcbzBPGJn3YUHHSUpuZVFkoe7V13tdjk8aMHfsJAYUsvvYe/i', 1),
(10, '2024-07-07 13:42:57', 'admin', 'admin@gmail.com', '$2y$10$8HRUmH5wMENVQ5ElSiN7rOyVoTf3aY4cKfsq2lpMm7HUoKDyB0DO.', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `user_logins`
--

CREATE TABLE `user_logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `login_count` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `last_login`, `login_count`) VALUES
(1, 10, '2024-07-15 11:04:39', 7),
(2, 1, '2024-07-15 11:04:25', 3),
(3, 7, '2024-07-15 10:56:11', 3),
(4, 9, '2024-07-15 10:50:46', 1),
(5, 2, '2024-07-15 10:51:26', 1),
(6, 3, '2024-07-15 10:51:39', 1),
(7, 8, '2024-07-15 10:52:11', 1),
(8, 4, '2024-07-15 10:52:24', 2);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- テーブルのインデックス `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `user_logins`
--
ALTER TABLE `user_logins`
  ADD CONSTRAINT `user_logins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
