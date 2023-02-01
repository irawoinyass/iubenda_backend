-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 01:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `collaborators`
--

CREATE TABLE `collaborators` (
  `collaborator_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collaborators`
--

INSERT INTO `collaborators` (`collaborator_id`, `t_id`, `p_id`, `c_id`, `created_at`) VALUES
(1, 1, 1, 4, '2023-01-31 19:53:27'),
(2, 1, 2, 4, '2023-01-31 19:53:27'),
(3, 1, 3, 5, '2023-01-31 19:53:27'),
(4, 1, 5, 6, '2023-01-31 19:53:27'),
(5, 2, 1, 4, '2023-01-31 19:54:19'),
(6, 2, 3, 5, '2023-01-31 19:54:19');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `company_email` varchar(200) NOT NULL,
  `company_phone` double NOT NULL,
  `company_address` text NOT NULL,
  `company_website` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `company_email`, `company_phone`, `company_address`, `company_website`, `created_at`) VALUES
(4, 'Swiftprofile Limited', 'hello@swiftprofile.com', 447377232501, 'UK, Ireland, Germany, Canada, and US', 'swiftprofile.com', '2023-01-30 20:45:34'),
(5, 'Zahtech Limited', 'info@zahtech.co.uk', 447470272804, '2 Consort Dr, Bramley, Tadley RG26 5WH.', 'zahtech.co.uk', '2023-01-30 21:16:18'),
(6, 'ISLERIDGE', 'info@isleridge.com', 7019866713, '11/13 Alade St. Ketu Lagos. Nigeria', 'https://isleridge.com/', '2023-01-30 21:19:14'),
(7, 'BOT EXPRESS Logistics', 'hello@botexpress.ng', 9066001073, 'B Complex, Suit 186, Sura Shopping Complex, Simpson St, Lagos Island.', 'https://botexpress.ng/', '2023-01-30 21:21:20'),
(8, 'BOT EXPRESS Logistics', 'hello@botexpress.ng', 9066001073, 'B Complex, Suit 186, Sura Shopping Complex, Simpson St, Lagos Island.', 'https://botexpress.ng/', '2023-01-30 22:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `people_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `com_id` int(11) NOT NULL,
  `position` varchar(200) NOT NULL,
  `account_status` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`people_id`, `name`, `email`, `gender`, `date_of_birth`, `com_id`, `position`, `account_status`, `password`, `created_at`) VALUES
(1, 'Lasisi Saheed', 'lasisisaheed5@gmail.com', 'Male', '1995-07-12', 4, 'Manager', 'active', '$2y$10$/x8Xh3WGzK9.07a3dB8.fOq/GybK0zETPExgW42kI53JN8X6OqlDu', '2023-01-31 13:14:50'),
(2, 'Shola Bakinde', 'shola@gmail.com', 'Female', '1994-02-12', 4, 'Director', 'active', '$2y$10$hFtoMfgRXtlq0IKA0H0qLOdGMtEO6iQhLCAJQ8T4DdUufYFMv4tfm', '2023-01-30 22:39:58'),
(3, 'Biodun Badmus', 'badmus@gmail.com', 'Female', '1995-09-30', 5, 'Software Engineer', 'inactive', '$2y$10$NVsDg9VRB5.QiWGA5xiZwOl1rVsHmBVugG5s6izk0acNf03vcdj2m', '2023-01-30 22:48:05'),
(5, 'Papa Kunle', 'kunle@gmail.com', 'Male', '1995-09-30', 6, 'Cloud Engineer', 'active', '$2y$10$39dwhvQqQEAhT540N2f91eygLuRSC2JXFNt68QOXo5FHoYAf0jGvC', '2023-01-30 23:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `headline` varchar(455) NOT NULL,
  `description` text NOT NULL,
  `due_date` date NOT NULL,
  `collaborators` int(11) NOT NULL,
  `col_draft` text NOT NULL,
  `solved` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `headline`, `description`, `due_date`, `collaborators`, `col_draft`, `solved`, `created_at`) VALUES
(1, 'How to Write an Awesome Blog Post in 5 Steps', 'Now that I’m done thoroughly mangling that vague metaphor, let’s get down to business. You know you need to start blogging to grow your business, but you don’t know how. In this post, I’ll show you how to write a great blog post in five simple steps that people will actually want to read. Ready? Let’s get started.', '2020-05-12', 4, 'lasisisaheed5@gmail.com,shola@gmail.com,kunle@gmail.com,asdfa', 'Yes', '2023-01-31 19:53:27'),
(2, 'How to Write a Blog Post in Five Easy Steps [Summary]', 'Long before you sit down to put digital pen to paper, you need to make sure you have everything you need to sit down and write. Many new bloggers overlook the planning process, and while you might be able to get away with skipping the planning stage, doing your homework will actually save you time further down the road and help you develop good blogging habits.', '2020-05-12', 2, 'lasisisaheed5@gmail.com', 'No', '2023-01-31 22:47:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collaborators`
--
ALTER TABLE `collaborators`
  ADD PRIMARY KEY (`collaborator_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`people_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collaborators`
--
ALTER TABLE `collaborators`
  MODIFY `collaborator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `people_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
