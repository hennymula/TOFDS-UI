-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 22, 2025 at 06:55 AM
-- Server version: 5.7.44
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stfms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(20) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_email`, `admin_password`, `admin_name`, `code`, `status`) VALUES
(1, 'tofds@gmail.com', '392a4ddea2df34a918560a6abff9c264', 'Admin', 0, 'verified'),
(2, 'tofds222@gmail.com', '47526f19c2ecc7263d5d83336180a57d', 'Admin 222', 0, 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `license_id` varchar(255) NOT NULL,
  `driver_email` varchar(255) NOT NULL,
  `driver_password` varchar(255) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `home_address` varchar(255) NOT NULL,
  `license_issue_date` date NOT NULL,
  `license_expire_date` date NOT NULL,
  `class_of_vehicle` varchar(255) NOT NULL,
  `registered_at` date NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`license_id`, `driver_email`, `driver_password`, `driver_name`, `home_address`, `license_issue_date`, `license_expire_date`, `class_of_vehicle`, `registered_at`, `code`, `status`) VALUES
('ABB0100', 'enock@gmail.com', '392a4ddea2df34a918560a6abff9c264', 'enock khumalo', 'chongwe, market', '2017-10-24', '2022-10-24', 'G1', '2025-01-15', 0, 'verified'),
('B4500800', 'chansa@gmail.com', '392a4ddea2df34a918560a6abff9c264', 'bandara chansa', 'appollo baracks, unit 20', '2024-10-16', '2029-10-16', 'A1,A', '2025-02-01', 0, 'verified'),
('B4502650', 'alvin@gmail.com', '392a4ddea2df34a918560a6abff9c264', 'alvin jahmal', 'kabwata, Dr aggrey Rd', '2019-06-11', '2024-06-11', 'A1,A', '2024-03-14', 0, 'verified'),
('BAC4117', 'james@gmail.com', '392a4ddea2df34a918560a6abff9c264', 'james chanda', 'longacers, kalingalinga', '2023-05-08', '2028-05-08', 'B1,B,', '2025-08-01', 0, 'verified'),
('BAZ0119', 'john@gmail.com', '392a4ddea2df34a918560a6abff9c264', 'john kabunja', 'chalala, apex Rd', '2025-06-18', '2030-06-18', 'A,B', '2025-01-18', 0, 'verified'),
('CAA2008', 'bupe@gmail.com', '392a4ddea2df34a918560a6abff9c264', 'lucy bupe', 'woodlands, cedar RD', '2024-08-28', '2029-08-28', 'B', '2025-03-15', 0, 'verified'),
('DAB3998', 'mosses@gmail.com', '392a4ddea2df34a918560a6abff9c264', 'mosses emmanual', 'kanyama, lady diana', '2025-03-10', '2023-03-10', 'A', '2025-03-10', 0, 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `fine_tickets`
--

CREATE TABLE `fine_tickets` (
  `fine_id` varchar(255) NOT NULL,
  `section_of_act` varchar(255) NOT NULL,
  `provision` varchar(255) NOT NULL,
  `fine_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fine_tickets`
--

INSERT INTO `fine_tickets` (`fine_id`, `section_of_act`, `provision`, `fine_amount`) VALUES
('100', 'Section 30.3', 'Failure to display an ROAD TAX', 500.00),
('101', 'Section 133(a)', 'No Certificate of Fitness ', 200.00),
('102', 'Section 56.1', 'Unlicensed Driver', 400.00),
('103', 'Section 102.5', 'Failure to comply with court order\r\nissued under section 102, subsection 4', 5000.00),
('104', 'section 64(c)', 'Underage Driver/inexperienced driver', 1000.00),
('105', 'Section 135', 'Failure to carry a Driving Licence when driving.', 2000.00),
('106', 'Section 163.2', 'Driving M/Vehicle in Dangerous\r\nCondition', 200.00),
('107', 'Section 151', 'Failure to comply with road rules eg Road Racing ', 300.00),
('108', 'Section 148', 'Failure to fit a Speed Limiter on a PSV 1', 300.00),
('109', 'Section 204.2', 'Interference /damage of m/vehicle', 200.00),
('110', 'Section 11.4', 'Use of Unregistered MV ', 400.00),
('111', 'Section 29.1', 'Obscured number plate ', 150.00),
('112', '167.3', 'Failure to wear seat belt', 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `issued_fines`
--

CREATE TABLE `issued_fines` (
  `ref_no` int(255) NOT NULL,
  `police_id` varchar(255) NOT NULL,
  `license_id` varchar(255) NOT NULL,
  `vehicle_no` varchar(255) NOT NULL,
  `class_of_vehicle` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `issued_date` date NOT NULL,
  `issued_time` time NOT NULL,
  `expire_date` date NOT NULL,
  `court` varchar(255) NOT NULL,
  `court_date` date NOT NULL,
  `provisions` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `paid_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issued_fines`
--

INSERT INTO `issued_fines` (`ref_no`, `police_id`, `license_id`, `vehicle_no`, `class_of_vehicle`, `place`, `issued_date`, `issued_time`, `expire_date`, `court`, `court_date`, `provisions`, `total_amount`, `status`, `paid_date`) VALUES
(10020, 'P55555', 'B4502650', 'BAC2004', 'A', 'town', '2025-02-10', '02:41:05', '2025-04-10', 'high court', '2025-04-10', '104', 300.00, 'pending', '2025-03-01'),
(10021, 'P55555', 'B4500800', 'AAE100', 'A1,A,B1,B,G1', 'Kandy', '2021-08-01', '02:41:21', '2021-08-22', 'Mawanella', '2021-08-22', '106', 2000.00, 'pending', '2021-08-01'),
(10022, 'P55555', 'B4500800', 'AAE100', 'A1,A,B1,B,G1', 'Colombo 05', '2021-08-01', '02:41:46', '2021-08-22', 'Mawanella', '2021-08-22', '108', 3000.00, 'pending', '2021-08-01'),
(10023, 'P55555', 'B4502650', 'WP2510', 'A1,A,B1,B,G1', 'Kandy', '2021-08-01', '02:42:33', '2021-08-22', 'Mawanella', '2021-08-22', '107', 2000.00, 'pending', '2021-08-01'),
(10024, 'P55555', 'B4502650', 'WP2510', 'A1,A,B1,B,G1', 'Kegalle', '2021-08-01', '02:42:48', '2021-08-22', 'Mawanella', '2021-08-22', '108', 3000.00, 'pending', '2021-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `mtd`
--

CREATE TABLE `mtd` (
  `mtd_id` int(20) NOT NULL,
  `mtd_email` varchar(255) NOT NULL,
  `mtd_password` varchar(255) NOT NULL,
  `registered_at` date NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mtd`
--

INSERT INTO `mtd` (`mtd_id`, `mtd_email`, `mtd_password`, `registered_at`, `code`, `status`) VALUES
(1, 'ratsa@gmail.com', '392a4ddea2df34a918560a6abff9c264', '2024-03-10', 0, 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `revenue_license`
--

CREATE TABLE `revenue_license` (
  `vehicle_no` varchar(255) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `vehicle_type` varchar(255) NOT NULL,
  `fuel_type` varchar(255) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `issue_date` date NOT NULL,
  `expire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `revenue_license`
--

INSERT INTO `revenue_license` (`vehicle_no`, `reference_no`, `vehicle_type`, `fuel_type`, `driver_name`, `email`, `issue_date`, `expire_date`) VALUES
('BAC4525', '11111113', 'A', 'disel', 'hendricks mwape', 'kabwe, chindwin', '2025-03-15', '2026-03-15'),
('CPAAE0000', '1111111', 'van', 'Petrol', 'gayan banda', 'northmead, flats', '2025-06-11', '2026-06-11'),
('WPBE5264', '11111112', 'Bus', 'Disel', 'simba mulolo', 'chelstone, avondale', '2024-02-10', '2025-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `tpo`
--

CREATE TABLE `tpo` (
  `police_id` varchar(255) NOT NULL,
  `officer_email` varchar(255) NOT NULL,
  `officer_password` varchar(255) NOT NULL,
  `officer_name` varchar(255) NOT NULL,
  `police_station` varchar(255) NOT NULL,
  `court` varchar(255) NOT NULL,
  `registered_at` date NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tpo`
--

INSERT INTO `tpo` (`police_id`, `officer_email`, `officer_password`, `officer_name`, `police_station`, `court`, `registered_at`, `code`, `status`) VALUES
('P55555', 'geshom@gmail.com', '392a4ddea2df34a918560a6abff9c264', 'B. geshom', 'kabwata', 'High court', '2025-02-18', 0, 'verified'),
('P55556', 'ruth@stfms.com', '392a4ddea2df34a918560a6abff9c264', 'A. ruth', 'chilenje', 'Magistrate court', '2025-03-07', 0, 'verified'),
('P55557', 'phiri@stfms.com', '392a4ddea2df34a918560a6abff9c264', 'J. phiri', 'central ', 'Local courts', '2025-01-11', 0, 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`license_id`),
  ADD UNIQUE KEY `driver_email` (`driver_email`);

--
-- Indexes for table `fine_tickets`
--
ALTER TABLE `fine_tickets`
  ADD PRIMARY KEY (`fine_id`);

--
-- Indexes for table `issued_fines`
--
ALTER TABLE `issued_fines`
  ADD PRIMARY KEY (`ref_no`),
  ADD KEY `fk_pid` (`police_id`),
  ADD KEY `fk_lid` (`license_id`);

--
-- Indexes for table `mtd`
--
ALTER TABLE `mtd`
  ADD PRIMARY KEY (`mtd_id`),
  ADD UNIQUE KEY `mtd_email` (`mtd_email`);

--
-- Indexes for table `revenue_license`
--
ALTER TABLE `revenue_license`
  ADD PRIMARY KEY (`vehicle_no`),
  ADD UNIQUE KEY `reference_no` (`reference_no`);

--
-- Indexes for table `tpo`
--
ALTER TABLE `tpo`
  ADD PRIMARY KEY (`police_id`),
  ADD UNIQUE KEY `officer_email` (`officer_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `issued_fines`
--
ALTER TABLE `issued_fines`
  MODIFY `ref_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10025;

--
-- AUTO_INCREMENT for table `mtd`
--
ALTER TABLE `mtd`
  MODIFY `mtd_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issued_fines`
--
ALTER TABLE `issued_fines`
  ADD CONSTRAINT `fk_lid` FOREIGN KEY (`license_id`) REFERENCES `driver` (`license_id`),
  ADD CONSTRAINT `fk_pid` FOREIGN KEY (`police_id`) REFERENCES `tpo` (`police_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
