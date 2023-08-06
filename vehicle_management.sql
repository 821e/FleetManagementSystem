-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2023 at 03:17 PM
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
-- Database: `vehicle management`
--

-- --------------------------------------------------------

--
-- Table structure for table `accident_reports`
--

CREATE TABLE `accident_reports` (
  `id` int(11) NOT NULL,
  `vehicle` varchar(100) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  `accident_date` date NOT NULL,
  `accident_description` text NOT NULL,
  `accident_photo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `type` varchar(8) NOT NULL,
  `req_date` varchar(100) NOT NULL,
  `req_time` varchar(100) NOT NULL,
  `ret_date` varchar(100) NOT NULL,
  `ret_time` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `pickup_point` varchar(100) NOT NULL,
  `resons` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(14) NOT NULL,
  `confirmation` int(11) NOT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT 0,
  `veh_reg` varchar(255) NOT NULL,
  `driverid` int(11) NOT NULL,
  `finished` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driverid` int(11) NOT NULL,
  `drname` varchar(255) NOT NULL,
  `drjoin` varchar(255) NOT NULL,
  `drmobile` varchar(20) NOT NULL,
  `drnid` varchar(30) NOT NULL,
  `drlicense` varchar(30) NOT NULL,
  `drlicensevalid` varchar(100) NOT NULL,
  `draddress` varchar(255) NOT NULL,
  `drphoto` varchar(30) NOT NULL,
  `dr_available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driverid`, `drname`, `drjoin`, `drmobile`, `drnid`, `drlicense`, `drlicensevalid`, `draddress`, `drphoto`, `dr_available`) VALUES
(22, 'Abdirisaq Adan', '06/01/2023', '+60112222222222', 'P002321321312', 'RO2023015022', '06/02/2024', ' No. 1, UCSI Heights, Jalan Puncak Menara Gading, Taman Connaught, 56000 Cheras, Federal Territory of Kuala Lumpur', 'abdirisaq.jpg', 0),
(31, 'Miachle', '07/12/2023', '011412421312', 'T00713882', 'RO2023015027', '07/18/2024', 'jalan 4/27a wangsa maju', 'driver1.png', 0),
(32, 'Rami Alwalid', '06/07/2023', '011232844433', 'T00713883', 'RO2023015029', '09/18/2024', 'jalan bani bu ali', 'driver2.png', 0),
(33, 'Saad AL-walid', '06/08/2023', '0114782167412', 'T00713889', 'RO2023015030', '05/23/2024', 'jalan alor food street kuala lumpur', 'driver3.png', 0),
(34, 'Nassar Al-shamari', '07/06/2023', '0114812747821847', 'S00713882', 'RO2023015031', '05/17/2024', ' Bukit Bintang, 50200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur\r\n', 'driver4.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `issue_id` int(11) NOT NULL,
  `issue` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`issue_id`, `issue`) VALUES
(1, 'Engine Overheating'),
(2, 'Brake Failure'),
(3, 'Electrical Problems'),
(4, 'Transmission Issues'),
(5, 'Suspension Problems'),
(6, 'Tire Blowout'),
(7, 'Oil Leak'),
(8, 'Cooling System Problems');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintenance_id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `task` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `issue` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `veh_id` int(11) NOT NULL,
  `veh_reg` varchar(100) NOT NULL,
  `veh_type` varchar(20) NOT NULL,
  `chesisno` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `veh_color` varchar(100) NOT NULL,
  `veh_regdate` varchar(100) NOT NULL,
  `veh_description` varchar(255) NOT NULL,
  `veh_photo` varchar(255) NOT NULL,
  `veh_available` int(11) NOT NULL,
  `oil_consumption_column_name` varchar(50) DEFAULT NULL,
  `distance_crossed_column_name` varchar(50) DEFAULT NULL,
  `oil_consumption` varchar(100) DEFAULT NULL,
  `distance_crossed` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`veh_id`, `veh_reg`, `veh_type`, `chesisno`, `brand`, `veh_color`, `veh_regdate`, `veh_description`, `veh_photo`, `veh_available`, `oil_consumption_column_name`, `distance_crossed_column_name`, `oil_consumption`, `distance_crossed`) VALUES
(36, 'JK02A', 'bus', 'WDD1771872W000452', 'Yutong bus', 'Gray', '06/02/2023', 'Reliable and friendly professional university bus driver who will ensure safe transportation for students, faculty, and staff while fostering a welcoming atmosphere on campus.', 'shuttlebus-kt.jpg', 0, '10.5', '5000.25', '12.22', '4555.22'),
(37, 'JK40A', 'bus', 'WDD1771872W000485', 'Yutong bus', 'Gray', '06/01/2023', 'Reliable and friendly professional university bus driver who will ensure safe transportation for students, faculty, and staff while fostering a welcoming atmosphere on campus.', 'shuttlebus.jpg', 0, '11.5', '45000.3', '11.11', '33422.3'),
(42, 'JK51A', 'Van', 'WDD1771872W000457', 'Toyota Hiace', 'White', '07/01/2023', ' Toyota Hiace 2023 is a 2 Seater Van available at a price of RM 108,000 in the Malaysia. It is available in 1 variants, 1 engine, and 1 transmissions option: Manual in the Malaysia. It has a ground clearance of 195 mm and dimensions is 4695 mm L x 1695 mm', 'van.png', 0, NULL, NULL, '14.33', '5600.2'),
(43, 'JK52A', 'Truck', 'WDD1771872W000458', 'Volvo FH16', 'Blue and White', '07/01/2023', ' Volvo FH16 2023\r\nIt is available in 10 variants and 1 body types: Tractor Head Trailer. The FH16 is powered by a 16100 cc engine, and has a maximum power of 650 bh', 'Truck.png', 0, NULL, NULL, '15.33', '55332.3'),
(44, 'JK53A', 'car', 'WDD1771872W000459', 'Toyota', 'Yellow ', '07/01/2023', ' usually four-wheeled vehicle designed primarily for passenger transportation and commonly propelled by an internal-combustion engine using a volatile fuel', 'car.png', 0, NULL, NULL, NULL, NULL),
(45, 'samdad', 'car', 'WDD1771872W000499', 'Toyota', 'yellow', '07/01/2023', ' dsdsddssdssda', 'car.png', 0, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accident_reports`
--
ALTER TABLE `accident_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverid`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`maintenance_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`veh_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accident_reports`
--
ALTER TABLE `accident_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driverid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `maintenance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `veh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
