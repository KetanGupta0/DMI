-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2023 at 07:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_code` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_code`) VALUES
(4006, 'Meghalaya', 'IN'),
(4007, 'Haryana', 'IN'),
(4008, 'Maharashtra', 'IN'),
(4009, 'Goa', 'IN'),
(4010, 'Manipur', 'IN'),
(4011, 'Puducherry', 'IN'),
(4012, 'Telangana', 'IN'),
(4013, 'Odisha', 'IN'),
(4014, 'Rajasthan', 'IN'),
(4015, 'Punjab', 'IN'),
(4016, 'Uttarakhand', 'IN'),
(4017, 'Andhra Pradesh', 'IN'),
(4018, 'Nagaland', 'IN'),
(4019, 'Lakshadweep', 'IN'),
(4020, 'Himachal Pradesh', 'IN'),
(4021, 'Delhi', 'IN'),
(4022, 'Uttar Pradesh', 'IN'),
(4023, 'Andaman and Nicobar Islands', 'IN'),
(4024, 'Arunachal Pradesh', 'IN'),
(4025, 'Jharkhand', 'IN'),
(4026, 'Karnataka', 'IN'),
(4027, 'Assam', 'IN'),
(4028, 'Kerala', 'IN'),
(4029, 'Jammu and Kashmir', 'IN'),
(4030, 'Gujarat', 'IN'),
(4031, 'Chandigarh', 'IN'),
(4033, 'Dadra and Nagar Haveli and Daman and Diu', 'IN'),
(4034, 'Sikkim', 'IN'),
(4035, 'Tamil Nadu', 'IN'),
(4036, 'Mizoram', 'IN'),
(4037, 'Bihar', 'IN'),
(4038, 'Tripura', 'IN'),
(4039, 'Madhya Pradesh', 'IN'),
(4040, 'Chhattisgarh', 'IN'),
(4852, 'Ladakh', 'IN'),
(4853, 'West Bengal', 'IN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5134;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
