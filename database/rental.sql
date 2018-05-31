-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2018 at 03:28 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `res_id` int(11) NOT NULL,
  `pickup_date` datetime NOT NULL,
  `return_date` datetime NOT NULL,
  `status` enum('pending','denied','deleted','active','complete') NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`res_id`, `pickup_date`, `return_date`, `status`, `user_id`, `vehicle_id`) VALUES
(1, '2018-06-03 08:00:00', '2018-06-08 08:00:00', 'active', 9, 6),
(2, '2018-02-17 08:00:00', '2018-02-18 08:00:00', 'complete', 14, 9),
(3, '2018-09-20 08:00:00', '2018-09-23 08:00:00', 'pending', 9, 20),
(4, '2018-10-11 08:00:00', '2018-10-13 08:00:00', 'pending', 10, 12),
(5, '2018-04-01 08:00:00', '2018-04-02 08:00:00', 'complete', 15, 17),
(6, '2018-10-17 08:00:00', '2018-10-18 08:00:00', 'pending', 10, 1),
(7, '2018-11-09 13:00:00', '2018-11-10 13:00:00', 'pending', 14, 2),
(8, '2018-08-07 08:00:00', '2018-08-10 08:00:00', 'pending', 9, 4),
(9, '2018-03-01 08:00:00', '2018-03-02 08:00:00', 'complete', 9, 8),
(10, '2018-12-23 08:00:00', '2018-12-26 08:00:00', 'pending', 15, 13),
(11, '2018-11-02 13:00:00', '2018-11-06 13:00:00', 'active', 14, 19),
(12, '2018-07-25 13:00:00', '2018-07-26 13:00:00', 'pending', 9, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `contact_no` varchar(45) NOT NULL,
  `role` enum('customer','admin','service provider') NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('pending','active','denied','deleted') NOT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `address`, `email`, `contact_no`, `role`, `username`, `password`, `status`, `registration_date`) VALUES
(1, 'Tristan', 'Leybag', 'Baguio City', '3stan@example.org', '1-560-370-8528', 'admin', '3stan', 'password', 'active', '2009-11-05 08:57:42'),
(2, 'Edgar', 'Powlowski', '896 Bogisich Prairie Apt. 074\nNew Hailie, DE ', 'hhermiston@example.net', '1-978-796-2014', 'service provider', 'preilly', 'leannon.richard', 'active', '1996-09-30 14:52:11'),
(3, 'Alanis', 'Thiel', '568 Lysanne Passage\nLeliachester, ME 46667-26', 'allan.witting@example.com', '995.782.4940x52345', 'service provider', 'rath.roxane', 'leonel86', 'active', '2011-04-24 18:15:41'),
(4, 'Esperanza', 'Roberts', '4062 Grady Points Suite 441\nHellerberg, CA 18', 'batz.orpha@example.net', '(471)894-1229x98487', 'service provider', 'brooke.toy', 'audie.mohr', 'active', '2001-03-07 20:15:39'),
(5, 'Beatrice', 'Gleason', '5806 Kessler Meadow\nHermistonchester, CA 1206', 'windler.samson@example.org', '552.131.7312x17030', 'service provider', 'irwin27', 'marmstrong', 'active', '2003-06-27 06:01:57'),
(6, 'Augustine', 'Hamill', '31357 Iliana Roads\nPort Amina, OK 29105-2411', 'lkerluke@example.org', '676.507.9995', 'service provider', 'maximilian18', 'natalia.collier', 'active', '2013-11-13 02:37:29'),
(7, 'Madeline', 'Simonis', '155 Floyd Plain\nPort Era, AZ 59126', 'heidenreich.leonora@example.com', '+54(3)6763631299', 'service provider', 'mbosco', 'cummings.barton', 'pending', '2010-02-09 13:24:30'),
(8, 'Crystal', 'Ward', '9263 Maria Forges Suite 075\nNew Cloyd, SD 587', 'ambrose17@example.org', '(887)813-5135x8719', 'service provider', 'rolfson.hermann', 'rgutmann', 'active', '1983-02-13 23:52:06'),
(9, 'Elda', 'Leffler', '0510 Carroll Ridges Suite 778\nSchillermouth, ', 'nwalter@example.org', '1-280-821-1327', 'customer', 'reilly.arnaldo', 'donnie.breitenberg', 'active', '1991-07-13 11:22:43'),
(10, 'Violette', 'Boyer', '021 Meaghan Fort\nNew Sheilamouth, NV 96206', 'abshire.eliezer@example.net', '1-577-810-1548x445', 'customer', 'stanton.arjun', 'caleb.strosin', 'active', '2009-04-19 22:21:45'),
(11, 'Gideon', 'Harvey', '6971 Adams Gardens Apt. 274\nWittingfort, OK 3', 'jwiegand@example.com', '(776)430-1199x83430', 'service provider', 'predovic.myrna', 'corwin.jefferey', 'active', '1983-09-23 17:13:30'),
(12, 'Baylee', 'Beier', '794 Destinee Inlet\nNorth Stephonmouth, DE 932', 'marcos.smitham@example.net', '(769)398-9187', 'service provider', 'thomenick', 'damaris.beer', 'active', '1982-03-26 01:10:41'),
(13, 'Chance', 'O\'Kon', '4855 Furman Inlet Apt. 472\nAshleechester, LA ', 'santina75@example.org', '1-707-218-4445x567', 'service provider', 'krista.gerhold', 'hans.williamson', 'active', '1972-05-10 04:30:23'),
(14, 'Kali', 'Barrows', '889 King Roads\nBoehmchester, SD 32282', 'nienow.caden@example.com', '1-047-488-7134x16127', 'customer', 'eulalia.stokes', 'flavie49', 'active', '2012-11-08 10:44:51'),
(15, 'Coralie', 'Prosacco', '945 Vincent Prairie Suite 784\nWest Dasiashire', 'erica79@example.net', '1-420-554-0904x5119', 'customer', 'jullrich', 'josephine40', 'active', '1981-10-11 19:50:32'),
(16, 'Halie', 'Mertz', '69335 Dickinson Burg Apt. 696\nNellachester, W', 'mohr.jodie@example.com', '040-923-9178', 'service provider', 'shanel.corkery', 'annabell.yundt', 'active', '2003-08-08 23:00:29'),
(17, 'Colton', 'Bartoletti', '63740 Gerlach Plains Suite 128\nKennyview, WV ', 'gwiza@example.org', '589-469-2206x870', 'service provider', 'pluettgen', 'else14', 'active', '1990-02-01 17:56:47'),
(18, 'Fabian', 'Vandervort', '9224 Domenick Centers\nEast Terryside, CO 8606', 'littel.reba@example.org', '04181889651', 'service provider', 'rosemary03', 'katlynn.mcclure', 'active', '2005-12-17 00:09:11'),
(19, 'Augustine', 'Dietrich', '608 Schuppe Parkway Apt. 631\nGrantton, DE 917', 'fdouglas@example.org', '1-156-080-2724x0900', 'customer', 'walsh.earlene', 'brant64', 'pending', '1987-12-31 15:42:43'),
(20, 'Demond', 'Schmidt', '5238 Darwin Islands Suite 486\nLake Bert, CT 8', 'mann.margaretta@example.org', '773-590-3792', 'service provider', 'betsy72', 'muriel.mertz', 'active', '1982-07-10 07:15:16'),
(21, 'Test', 'Name', 'Baguio City', 'test@test.com', '123 4567', 'customer', 'test', 'password', 'pending', '2018-05-16 15:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `model` varchar(45) NOT NULL,
  `seating_capacity` varchar(45) NOT NULL,
  `luggage_capacity` varchar(45) NOT NULL,
  `air_conditioned` tinyint(1) NOT NULL,
  `transmission` enum('manual','automatic') NOT NULL,
  `regno` varchar(45) NOT NULL,
  `daily_rate` varchar(45) NOT NULL,
  `picture` blob NOT NULL,
  `pickup_location` varchar(45) NOT NULL,
  `status` enum('available','not available','denied','deleted','pending') NOT NULL,
  `sp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `model`, `seating_capacity`, `luggage_capacity`, `air_conditioned`, `transmission`, `regno`, `daily_rate`, `picture`, `pickup_location`, `status`, `sp_id`) VALUES
(1, 'Navigator', '8', '1', 0, 'automatic', '906013700-0', '1500', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313332783137362e6a70672f6363303030302f666666666666, '9 Ridgeview Hill', 'not available', 2),
(2, 'Element', '4', '1', 1, 'manual', '550601666-2', '2000', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f323031783233342e626d702f3566613264642f666666666666, '2790 Graceland Crossing', 'not available', 2),
(3, 'Express 1500', '2', '4', 1, 'automatic', '982582131-0', '1000', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313231783138382e6a70672f6666343434342f666666666666, '51 Forest Run Circle', 'pending', 13),
(4, 'LTD Crown Victoria', '6', '4', 0, 'automatic', '492616497-3', '2500', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313532783139302e626d702f6363303030302f666666666666, '19 Cherokee Plaza', 'not available', 17),
(5, 'Land Cruiser', '3', '3', 0, 'manual', '076497020-8', '3000', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313331783231322e6a70672f6363303030302f666666666666, '9616 Portage Pass', 'available', 5),
(6, 'A6', '5', '1', 0, 'automatic', '063557578-7', '1000', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f323138783131392e706e672f3566613264642f666666666666, '443 Hanover Center', 'not available', 17),
(7, 'Eclipse', '7', '5', 1, 'automatic', '594379377-1', '2000', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313931783230302e706e672f6666343434342f666666666666, '3 Stang Street', 'denied', 20),
(8, '900', '1', '2', 0, 'automatic', '804599709-5', '1000', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313738783138302e6a70672f3566613264642f666666666666, '4 Loftsgordon Street', 'not available', 5),
(9, '5 Series', '4', '2', 0, 'automatic', '346410122-3', '1500', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f323033783233362e626d702f6464646464642f303030303030, '4 Sullivan Park', 'not available', 12),
(10, 'Crown Victoria', '3', '4', 1, 'manual', '554962058-8', '2500', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313730783139372e706e672f6464646464642f303030303030, '1 Rockefeller Crossing', 'deleted', 6),
(11, '9-7X', '1', '5', 1, 'manual', '361324837-9', '1500', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313435783232342e6a70672f6363303030302f666666666666, '5 Lyons Crossing', 'not available', 2),
(12, 'Transit Connect', '7', '5', 0, 'manual', '632179295-0', '3000', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313532783230372e706e672f6666343434342f666666666666, '9 Jackson Center', 'not available', 3),
(13, 'CC', '9', '4', 0, 'automatic', '171089181-5', '1500', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313330783133362e706e672f6363303030302f666666666666, '148 Cherokee Circle', 'not available', 16),
(14, 'Tacoma', '2', '3', 1, 'manual', '525134077-X', '3000', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313630783234332e626d702f3566613264642f666666666666, '3 Gerald Lane', 'available', 11),
(15, 'Sprinter', '8', '1', 1, 'automatic', '320711716-3', '2000', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313934783232332e6a70672f6666343434342f666666666666, '89 Golf View Lane', 'pending', 6),
(16, 'LeSabre', '7', '3', 0, 'manual', '173665246-X', '1500', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313932783132322e706e672f3566613264642f666666666666, '1 Park Meadow Road', 'available', 4),
(17, 'QX', '1', '1', 1, 'automatic', '230001273-1', '3000', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313333783135372e6a70672f6666343434342f666666666666, '7458 Banding Alley', 'not available', 6),
(18, 'Galant', '2', '2', 1, 'manual', '602030140-0', '1500', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313233783230312e706e672f6464646464642f303030303030, '0 Schlimgen Place', 'pending', 12),
(19, 'Grand Cherokee', '9', '4', 0, 'manual', '588062861-2', '1000', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f313136783135322e706e672f6464646464642f303030303030, '46 Lighthouse Bay Road', 'not available', 18),
(20, 'Frontier', '4', '5', 0, 'automatic', '163069598-X', '2500', 0x687474703a2f2f64756d6d79696d6167652e636f6d2f323337783235302e626d702f6363303030302f666666666666, '0 Glacier Hill Place', 'not available', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`res_id`),
  ADD KEY `CUSTOMER` (`user_id`),
  ADD KEY `VEHICLE` (`vehicle_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `PROVIDER` (`sp_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `CUSTOMER` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `VEHICLE` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `PROVIDER` FOREIGN KEY (`sp_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
