-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 17, 2025 at 08:40 AM
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
-- Database: `rental_property_is`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(200) NOT NULL,
  `expense_user_id` int(200) NOT NULL,
  `expense_type` varchar(200) NOT NULL,
  `expense_amount` varchar(200) NOT NULL,
  `expense_property_id` int(200) NOT NULL,
  `expense_date` varchar(200) NOT NULL,
  `expense_house_number` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `expense_user_id`, `expense_type`, `expense_amount`, `expense_property_id`, `expense_date`, `expense_house_number`) VALUES
(3, 1, 'Renovation of block B', '45000', 5, '05/09/2025', ''),
(4, 1, 'Renovation ', '10000', 5, '05/09/2025', '45A and 56C');

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `house_id` int(200) NOT NULL,
  `house_property_id` int(200) NOT NULL,
  `house_number` varchar(200) NOT NULL,
  `house_category` varchar(200) NOT NULL,
  `house_status` varchar(200) NOT NULL DEFAULT 'Vacant',
  `house_rent` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`house_id`, `house_property_id`, `house_number`, `house_category`, `house_status`, `house_rent`) VALUES
(1, 5, '001', 'Singles', 'Occupied', '3900'),
(2, 5, '002', 'Singles', 'Occupied', '3500'),
(3, 5, '003', 'Singles', 'Vacant', '3500'),
(6, 5, '008', 'Bedsitters', 'Occupied', '7800'),
(7, 5, 'A120', 'Bedsitters', 'Occupied', '4500'),
(8, 5, 'A001', 'Singles', 'Vacant', '4500'),
(9, 5, 'A002', 'Singles', 'Vacant', '4500'),
(10, 5, 'A003', 'Singles', 'Vacant', '4500');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(200) NOT NULL,
  `payment_ref_code` varchar(200) NOT NULL,
  `payment_invoice_number` varchar(200) NOT NULL,
  `payment_amount` varchar(200) NOT NULL,
  `payment_type` varchar(200) NOT NULL,
  `payment_tenant_id` int(200) NOT NULL,
  `payment_date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment_ref_code`, `payment_invoice_number`, `payment_amount`, `payment_type`, `payment_tenant_id`, `payment_date`) VALUES
(6, 'RCV1ERERR534', 'INV/04/2023/EDNAY', '3500', 'Mpesa', 1, '03/31/2023'),
(7, 'RCV6231ERE', 'INV/04/2023/XTBWQ', '3900', 'Mpesa', 2, '03/31/2023'),
(8, 'RCV6231256', 'INV/04/2023/M5XE7', '4500', 'Mpesa', 5, '03/31/2023'),
(9, 'RCV62TGH99', 'INV/04/2023/9QXTL', '7800', 'Mpesa', 6, '03/30/2023');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `property_id` int(200) NOT NULL,
  `property_name` varchar(200) NOT NULL,
  `property_location` longtext NOT NULL,
  `property_caretaker_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`property_id`, `property_name`, `property_location`, `property_caretaker_id`) VALUES
(5, 'Turn Yke Heights', 'Nairobi - Off Mombasa Road', 5);

-- --------------------------------------------------------

--
-- Table structure for table `property_utilities`
--

CREATE TABLE `property_utilities` (
  `property_utilities_id` int(200) NOT NULL,
  `property_utility_utility_id` int(200) NOT NULL,
  `property_utility_property_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `tenant_id` int(200) NOT NULL,
  `tenant_national_id` varchar(200) NOT NULL,
  `tenant_name` varchar(200) NOT NULL,
  `tenant_mobile_number` varchar(200) NOT NULL,
  `tenant_house_id` int(200) NOT NULL,
  `tenant_date_of_registration` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`tenant_id`, `tenant_national_id`, `tenant_name`, `tenant_mobile_number`, `tenant_house_id`, `tenant_date_of_registration`) VALUES
(1, '35574881', 'Martin Mbithi', '0740847563', 2, '03/24/2023'),
(2, '356777690', 'Bosco Mulwa', '0740847567', 1, '03/24/2023'),
(5, '356777690', 'James Doe', '0277555425', 7, '03/24/2023'),
(6, '3567778790', 'Janet Doe', '0712556789', 6, '03/24/2023');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(200) NOT NULL,
  `user_type` varchar(200) NOT NULL,
  `user_names` varchar(200) NOT NULL,
  `user_login_name` varchar(200) NOT NULL,
  `user_contact` varchar(200) NOT NULL,
  `user_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `user_names`, `user_login_name`, `user_contact`, `user_password`) VALUES
(1, 'Administrator', 'Martin Mbithi', 'sysadmin', '+254740847563', 'a69681bcf334ae130217fea4505fd3c994f5683f'),
(5, 'Caretaker', 'Martin', 'mart', '+25437229776', 'a69681bcf334ae130217fea4505fd3c994f5683f');

-- --------------------------------------------------------

--
-- Table structure for table `utilities`
--

CREATE TABLE `utilities` (
  `utility_id` int(200) NOT NULL,
  `utility_name` varchar(200) NOT NULL,
  `utility_cost` varchar(200) NOT NULL,
  `utility_status` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilities`
--

INSERT INTO `utilities` (`utility_id`, `utility_name`, `utility_cost`, `utility_status`) VALUES
(2, 'Water', '100', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `ExpenseUserID` (`expense_user_id`),
  ADD KEY `ExpensePropertyID` (`expense_property_id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`house_id`),
  ADD KEY `Property` (`house_property_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `PaymentRelation` (`payment_tenant_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `CaretakerID` (`property_caretaker_id`);

--
-- Indexes for table `property_utilities`
--
ALTER TABLE `property_utilities`
  ADD PRIMARY KEY (`property_utilities_id`),
  ADD KEY `PropertyID` (`property_utility_property_id`),
  ADD KEY `UtilityID` (`property_utility_utility_id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`tenant_id`),
  ADD KEY `TenantHouse` (`tenant_house_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`utility_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `house_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `property_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `property_utilities`
--
ALTER TABLE `property_utilities`
  MODIFY `property_utilities_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `tenant_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `utilities`
--
ALTER TABLE `utilities`
  MODIFY `utility_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `ExpensePropertyID` FOREIGN KEY (`expense_property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ExpenseUserID` FOREIGN KEY (`expense_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `houses`
--
ALTER TABLE `houses`
  ADD CONSTRAINT `Property` FOREIGN KEY (`house_property_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `PaymentRelation` FOREIGN KEY (`payment_tenant_id`) REFERENCES `tenants` (`tenant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `CaretakerID` FOREIGN KEY (`property_caretaker_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property_utilities`
--
ALTER TABLE `property_utilities`
  ADD CONSTRAINT `PropertyID` FOREIGN KEY (`property_utility_property_id`) REFERENCES `utilities` (`utility_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UtilityID` FOREIGN KEY (`property_utility_utility_id`) REFERENCES `properties` (`property_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `TenantHouse` FOREIGN KEY (`tenant_house_id`) REFERENCES `houses` (`house_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
