-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2026 at 04:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsa3_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL DEFAULT '',
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` varchar(100) NOT NULL DEFAULT '',
  `contact_number` varchar(30) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `username`, `password`, `birthday`, `contact_number`, `created_at`) VALUES
(8, 'Francis Sebastian', 'Advincula', 'Pertudo', 'fapertudo@fit.edu.ph', 'Sebastian', '$2y$10$0sEnYpgbeuYCqYmVBebtr.fD39TVscx6CS8LRExwECSkI4etbmQGG', 'October, 26, 2005', '0932512332', '2026-07-03 16:35:12'),
(9, 'Liam', 'Santos', 'Reyes', 'liam.reyes@example.com', 'liam01', '$2y$10$iHdKKDk.yfnS9Dh4IrsieuQALU9KSlMW0gGz8Mcll.R2W/WwQe9FO', 'March 12 2001', '09171234501', '2026-07-03 16:38:54'),
(10, 'Mia', 'Cruz', 'Garcia', 'mia.garcia@example.com', 'mia02', '$2y$10$iHdKKDk.yfnS9Dh4IrsieuQALU9KSlMW0gGz8Mcll.R2W/WwQe9FO', 'July 8 2002', '09171234502', '2026-07-03 16:38:54'),
(11, 'Noah', 'Dela', 'Rosa', 'noah.rosa@example.com', 'noah03', '$2y$10$iHdKKDk.yfnS9Dh4IrsieuQALU9KSlMW0gGz8Mcll.R2W/WwQe9FO', 'November 21 2000', '09171234503', '2026-07-03 16:38:54'),
(12, 'Ava', 'Marie', 'Lopez', 'ava.lopez@example.com', 'ava04', '$2y$10$iHdKKDk.yfnS9Dh4IrsieuQALU9KSlMW0gGz8Mcll.R2W/WwQe9FO', 'February 5 2003', '09171234504', '2026-07-03 16:38:54'),
(13, 'Ethan', 'James', 'Torres', 'ethan.torres@example.com', 'ethan05', '$2y$10$iHdKKDk.yfnS9Dh4IrsieuQALU9KSlMW0gGz8Mcll.R2W/WwQe9FO', 'September 17 1999', '09171234505', '2026-07-03 16:38:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
