-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 05:31 PM
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
-- Database: `kool7_car_aircon_specialist`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `description`) VALUES
(1, 'We Have 28 Years Of Experience In This Field', 'With an impressive 28-year legacy in air conditioning services, our dedication to delivering excellence remains steadfast. Throughout the ups and downs of business, our highly experienced team has weathered every challenge, emerging stronger and more resilient. Drawing from decades of expertise, we guarantee unparalleled care for your air conditioning system. Rely on our seasoned professionals to navigate any obstacle and ensure optimal performance and safety for all your cooling needs.');

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `action_description` text NOT NULL,
  `action_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `action_logs`
--

CREATE TABLE `action_logs` (
  `id` int(11) NOT NULL,
  `action` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `username`, `password`) VALUES
(1, 'kool7', 'mejaki1996');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `car_model` varchar(255) NOT NULL,
  `year_model` int(11) NOT NULL,
  `preferred_service` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `additional_message` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `email`, `contact_number`, `car_model`, `year_model`, `preferred_service`, `date`, `time`, `additional_message`, `status`) VALUES
(15, 'Estraño, Kirstie Claudine I.', 'estranokirstie@gmail.com', '9083301368', 'toyota', 2012, 'general', '2024-11-27', '16:55:00', 'fdsafda', 'Approved'),
(17, 'Ross', 'ross@yahoo.com', '9123456789', 'Honda Civic', 2022, 'general', '2024-12-10', '15:30:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `approved`
--

CREATE TABLE `approved` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `car_model` varchar(255) NOT NULL,
  `year_model` int(11) NOT NULL,
  `preferred_service` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `additional_message` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hours` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `phone`, `address`, `email`, `hours`) VALUES
(1, '09123456789', 'Brgy. Del Remedio, San Pablo City', 'kool7@gmail.com', 'From 8:00 AM to 4:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `section_id` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `section_id`, `content`) VALUES
(1, '44', 'With an impressive 28-year legacy in air conditioning services, our dedication to delivering excellence remains steadfast. Throughout the ups and downs of business, our highly experienced team has weathered every challenge, emerging stronger and more resilient. Drawing from decades of expertise, we guarantee unparalleled care for your air conditioning system. Rely on our seasoned professionals to navigate any obstacle and ensure optimal performance and safety for all your cooling needs. test test test.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `satisfaction` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `suggestions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `phone`, `satisfaction`, `suggestions`) VALUES
(1, 'kirstie', 'kirstie@gmail.com', '099989271776', 'yes', 'kk'),
(2, 'ross', 'ross@gmail.com', '099999', 'yes', 'great'),
(3, 'hannah', 'hannah@gmail.com', '099999', 'yes', 'great'),
(4, 'lyncel', 'lyncel@gmail.com', '09989271776', 'yes', 'great');

-- --------------------------------------------------------

--
-- Table structure for table `footer_content`
--

CREATE TABLE `footer_content` (
  `id` int(11) NOT NULL,
  `logo_path` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_content`
--

INSERT INTO `footer_content` (`id`, `logo_path`, `description`) VALUES
(1, 'logo 2.png', 'With a proud history of 28 years, our dedication to exceptional car air conditioning servicing remains steadfast.');

-- --------------------------------------------------------

--
-- Table structure for table `general_services`
--

CREATE TABLE `general_services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `service_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_services`
--

INSERT INTO `general_services` (`id`, `service_name`, `service_link`) VALUES
(1, 'GENERAL SERVICES', '#service'),
(2, 'CAR AIRCON DIAGNOSTIC SERVICES', '#service'),
(3, 'CAR AIRCON CLEANING SERVICES', '#service'),
(4, 'CAR AIRCON REPLACEMENT SERVICES', '#service');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `tool_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `tool_name` varchar(255) NOT NULL,
  `available_size` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`tool_id`, `category`, `tool_name`, `available_size`, `status`, `quantity`) VALUES
(1, 'Screw', 'flat screw', '123', 'avail', 0),
(2, 'Screw', 'Philip Screw', '123', 'available', 12),
(3, 'Example Category', 'Example Tool', 'Example Size', 'Example Status', 1),
(4, 'category', 'tool name', 'size', 'status', 9);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `description`, `price`, `desc`) VALUES
(1, 'GENERAL SERVICES', 'Diagnose the issue.\r\n\r\nRepair or replace faulty components.\r\n\r\nTest the system to ensure proper functionality.\r\n\r\nProvide maintenance recommendations to prevent future breakdowns.', '₱3,500', ' '),
(2, 'CAR AIRCON DIAGNOSTICS SERVICES', 'Checking refrigerant levels.\r\n\r\nInspecting for leaks in the system.\r\n\r\nTesting compressor functionality.\r\n\r\nEvaluating electrical connections.\r\n\r\nAssessing temperature and pressure readings.\r\n\r\nChecking for blockages in the system.\r\n\r\nExamining cabin air filters.\r\n\r\nConducting a visual inspection of components for wear or damage.', '₱1,000.00', ''),
(3, 'CAR AIRCON CLEANING SERVICES', 'Evaporator coil cleaning.\r\n\r\nCondenser coil cleaning.\r\n\r\nAir filter replacement.\r\n\r\nDrain line clearing.\r\n\r\nDisinfecting evaporator housing.\r\n\r\nChecking and topping up refrigerant levels.\r\n\r\nInspecting and cleaning blower fan.\r\n\r\nVisual inspection of ductwork for blockages.', '₱2,500.00~ UP', ''),
(4, 'CAR AIRCON REPLACEMENT SERVICES', 'Removal of old air conditioning components.\r\n\r\nInstallation of new compressor.\r\n\r\nReplacement of evaporator and condenser coils.\r\n\r\nInstallation of new air filter.\r\n\r\nTesting system for leaks and pressure.\r\n\r\nCharging system with refrigerant.\r\n\r\nTesting system functionality.', '₱2,500.00~ UP', '');

-- --------------------------------------------------------

--
-- Table structure for table `rescheduledappointments`
--

CREATE TABLE `rescheduledappointments` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `ContactNumber` varchar(15) NOT NULL,
  `CarModel` varchar(50) NOT NULL,
  `YearModel` varchar(10) NOT NULL,
  `PreferredService` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `AdditionalMessage` text NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `image_path`) VALUES
(1, 'Car Aircon Repair', 'Experience Comfort on the Road with Car Aircon Repair. Professional Service to Ensure Optimal Cooling. Expert Repairs, Conveniently Scheduled.', 'service-1.jpg'),
(2, 'Car Aircon Diagnostics', 'Stay composed with our special offer—comprehensive diagnostics available to our esteemed customers, ensuring optimal performance of your car\'s air conditioning system for every ride.', 'service-2.jpg'),
(3, 'Ripper Truck Air Conditioning Installation', 'Enhance Your Work Environment with Ripper Truck Air Conditioning Installation. Our Professional Services Ensure Comfortable Operations, Maximizing Productivity. Trust Expert Installations Tailored to Your Fleet\'s Needs.', 'service-3.jpg'),
(4, 'Regular Maintenance of Car Aircon', 'Experience Lasting Comfort with Our Air Conditioning Maintenance Service. Our Expert Technicians Conduct Regular Inspections and Tune-ups to Ensure Optimal Performance and Efficiency.', 'service-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` int(11) NOT NULL,
  `approved` int(11) DEFAULT 0,
  `cancelled` int(11) DEFAULT 0,
  `reschedule` int(11) DEFAULT 0,
  `archive` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `content`, `author`, `image`) VALUES
(1, 'The car air conditioning service exceeded my expectations. \r\n                Not only did they fix the issues promptly, but the cooling system now works better than ever. \r\n                I\'m impressed by their professionalism and attention to detail. \r\n                Highly recommended!', '- Kirstie E.', 'testimonial-1.jpg'),
(2, 'I recently had my car\'s air conditioning serviced, and I couldn\'t be happier with the results. \r\n                The team was efficient, knowledgeable, and courteous throughout the process. \r\n                Now, my car feels like a haven of cool comfort, thanks to their excellent workmanship. \r\n                I\'ll definitely be returning for future maintenance.', '- Rosalyn L.', 'testimonial-5.jpg'),
(3, 'As a car enthusiast, I\'m very selective about who handles my beloved vehicle. The team\'s dedication and proficiency in car air conditioning truly stand out. My car\'s cooling system has never performed better, and its overall condition has never been more impressive.', 'Hannah P.', 'testimonial-6.jpg'),
(4, 'I recently visited Kool 7 Car Aircon Specialist, and I couldn\'t be happier with the service I received! My car\'s air conditioning was completely fixed, and it feels like a brand-new vehicle now. The team was professional, knowledgeable, and incredibly friendly. They explained the entire process to me and worked quickly without compromising on quality. I highly recommend their services to anyone looking for efficient and reliable car maintenance. Five stars!\"', '- Lyncel C.', 'testimonial-7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `address`, `phone_number`, `age`, `gender`, `created_at`) VALUES
(1, 'ross', '$2y$10$ornoQQEaaJVZdEKhbKQmzeD7oHLbMYy4B/XqL75I2K3.if7qKu6z2', 'ross', 'ross@gmail.com', 'San Pablo City', '09123456789', 18, 'female', '2024-11-30 09:12:46'),
(2, 'rosalyn', '$2y$10$P05ShZVyBP2e6degc1EEbOaNOkJWklI6GI1j.Op1NyxGoxZ7z4JEi', 'Rosalyn Lcson', 'ross@yahoo.com', 'San Pablo City', '09123456789', 33, 'female', '2024-11-30 14:47:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `action_logs`
--
ALTER TABLE `action_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approved`
--
ALTER TABLE `approved`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_content`
--
ALTER TABLE `footer_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_services`
--
ALTER TABLE `general_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`tool_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rescheduledappointments`
--
ALTER TABLE `rescheduledappointments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `action_logs`
--
ALTER TABLE `action_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `approved`
--
ALTER TABLE `approved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `footer_content`
--
ALTER TABLE `footer_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `general_services`
--
ALTER TABLE `general_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `tool_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rescheduledappointments`
--
ALTER TABLE `rescheduledappointments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
