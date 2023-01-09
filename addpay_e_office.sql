-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2023 at 03:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `addpay_e_office`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `archives_id` bigint(20) NOT NULL,
  `archives_title` varchar(255) NOT NULL,
  `archives_file` varchar(255) NOT NULL,
  `archives_create` datetime NOT NULL,
  `archives_update` datetime DEFAULT NULL,
  `archives_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`archives_id`, `archives_title`, `archives_file`, `archives_create`, `archives_update`, `archives_uid`) VALUES
(2, 'hj', 'archives-20230104165804.pdf', '2023-01-04 16:18:59', '2023-01-04 16:58:04', 1),
(7, 'zjoirbiilh', 'archives-20230105090924.pdf', '2023-01-04 16:57:23', '2023-01-05 09:09:24', 1),
(8, 'et;n;z', 'archives-20230105090737.pdf', '2023-01-05 09:07:37', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `contract_id` bigint(20) NOT NULL,
  `contract_lgdeld` date NOT NULL,
  `contract_lgexpd` date NOT NULL,
  `contract_title` varchar(255) NOT NULL,
  `contract_comp` varchar(255) NOT NULL,
  `contract_file` varchar(255) NOT NULL,
  `contract_filesigner` varchar(255) NOT NULL,
  `contract_ann` date NOT NULL,
  `contract_create` datetime NOT NULL,
  `contract_update` datetime NOT NULL,
  `contract_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `docin`
--

CREATE TABLE `docin` (
  `docin_id` bigint(20) NOT NULL,
  `docin_no` varchar(255) NOT NULL,
  `docin_date` date NOT NULL,
  `docin_srcname` varchar(255) NOT NULL,
  `docin_title` varchar(255) NOT NULL,
  `docin_to` varchar(255) NOT NULL,
  `docin_file` varchar(255) NOT NULL,
  `docin_create` datetime NOT NULL,
  `docin_update` datetime DEFAULT NULL,
  `docin_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `docin`
--

INSERT INTO `docin` (`docin_id`, `docin_no`, `docin_date`, `docin_srcname`, `docin_title`, `docin_to`, `docin_file`, `docin_create`, `docin_update`, `docin_uid`) VALUES
(6, '465drrnn', '2023-01-06', 'daba', 'sarg', 'wrg', 'docin-20230104101618.pdf', '2023-01-04 10:16:18', '2023-01-05 09:06:21', 1),
(7, 'hkbl', '2023-01-14', 'JJlszkhr', 'hj', 'aer', 'docin-20230104110953.pdf', '2023-01-04 10:25:28', '2023-01-04 11:09:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `docout`
--

CREATE TABLE `docout` (
  `docout_id` bigint(20) NOT NULL,
  `docout_no` varchar(255) NOT NULL,
  `docout_date` date NOT NULL,
  `docout_title` varchar(255) NOT NULL,
  `docout_to` varchar(255) NOT NULL,
  `docout_send` longtext NOT NULL,
  `docout_details` longtext NOT NULL,
  `docout_signame` varchar(255) NOT NULL,
  `docout_position` varchar(255) NOT NULL,
  `docout_create` datetime NOT NULL,
  `docout_update` datetime DEFAULT NULL,
  `docout_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `docout`
--

INSERT INTO `docout` (`docout_id`, `docout_no`, `docout_date`, `docout_title`, `docout_to`, `docout_send`, `docout_details`, `docout_signame`, `docout_position`, `docout_create`, `docout_update`, `docout_uid`) VALUES
(1, '222', '2022-12-15', 'าา', 'ดะัาอเ', 'ั่เอ่', 'kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', 'jk', 'bbb', '2022-12-27 07:55:29', '2022-12-27 07:55:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expenses_id` bigint(20) NOT NULL,
  `expenses_type` varchar(255) NOT NULL,
  `expenses_date` date NOT NULL,
  `expenses_list` varchar(255) NOT NULL,
  `expenses_price` varchar(255) NOT NULL,
  `expenses_file` varchar(255) NOT NULL,
  `expenses_create` datetime NOT NULL,
  `expenses_update` datetime NOT NULL,
  `expenses_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoicebill`
--

CREATE TABLE `invoicebill` (
  `invbill_id` bigint(20) NOT NULL,
  `invbill_no` varchar(255) NOT NULL,
  `invbill_date` bigint(20) NOT NULL,
  `invbill_name` varchar(255) NOT NULL,
  `invbill_address` varchar(255) NOT NULL,
  `invbill_cusid` varchar(255) NOT NULL,
  `invbill_total` float NOT NULL,
  `invbill_texttotal` varchar(255) NOT NULL,
  `invbill_create` datetime NOT NULL,
  `invbill_update` datetime NOT NULL,
  `invbill_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoicebill_details`
--

CREATE TABLE `invoicebill_details` (
  `invbilld_id` bigint(20) NOT NULL,
  `invbilld_bid` bigint(20) NOT NULL,
  `invbilld_item` varchar(255) NOT NULL,
  `invbilld_price` float NOT NULL,
  `invbilld_vat` float NOT NULL,
  `invbilld_result` float NOT NULL,
  `invbilld_create` datetime NOT NULL,
  `invbilld_update` datetime NOT NULL,
  `invbilld_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoicetax`
--

CREATE TABLE `invoicetax` (
  `invtax_id` bigint(20) NOT NULL,
  `invtax_no` varchar(255) NOT NULL,
  `invtax_date` date NOT NULL,
  `invtax_name` varchar(255) NOT NULL,
  `invtax_address` varchar(255) NOT NULL,
  `invtax_cusid` varchar(255) NOT NULL,
  `invtax_sum` float NOT NULL,
  `invtax_vat` float NOT NULL,
  `invtax_total` float NOT NULL,
  `invtax_texttotal` varchar(255) NOT NULL,
  `invtax_create` datetime NOT NULL,
  `invtax_update` datetime NOT NULL,
  `invtax_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoicetax_details`
--

CREATE TABLE `invoicetax_details` (
  `invtaxd_id` bigint(20) NOT NULL,
  `invtaxd_tid` bigint(20) NOT NULL,
  `invtaxd_item` varchar(255) NOT NULL,
  `invtaxd_amount` varchar(255) NOT NULL,
  `invtaxd_price` float NOT NULL,
  `invtaxd_result` float NOT NULL,
  `invtaxd_create` datetime NOT NULL,
  `invtaxd_update` datetime NOT NULL,
  `invtaxd_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presentation`
--

CREATE TABLE `presentation` (
  `present_id` bigint(20) NOT NULL,
  `present_repid` bigint(20) DEFAULT NULL,
  `present_create` datetime DEFAULT NULL,
  `present_update` datetime DEFAULT NULL,
  `present_uid` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` bigint(20) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_agency` varchar(255) NOT NULL,
  `project_budget` varchar(255) NOT NULL,
  `project_detail` varchar(255) NOT NULL,
  `project_quodate` date NOT NULL,
  `project_quoprice` varchar(255) NOT NULL,
  `project_quoid` bigint(20) NOT NULL,
  `project_create` datetime NOT NULL,
  `project_update` datetime NOT NULL,
  `project_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_plan`
--

CREATE TABLE `project_plan` (
  `plan_id` bigint(20) NOT NULL,
  `plan_proid` bigint(20) NOT NULL,
  `plan_repid` bigint(20) NOT NULL,
  `plan_create` datetime NOT NULL,
  `plan_update` datetime NOT NULL,
  `plan_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_appraisal`
--

CREATE TABLE `quotation_appraisal` (
  `quo_id` bigint(20) NOT NULL,
  `quo_no` int(255) NOT NULL,
  `quo_date` date NOT NULL,
  `quo_namepj` varchar(255) NOT NULL,
  `quo_name` varchar(255) NOT NULL,
  `quo_address` varchar(255) NOT NULL,
  `quo_sum` float NOT NULL,
  `quo_specialdis` float NOT NULL,
  `quo_afterdis` float NOT NULL,
  `quo_vat` float NOT NULL,
  `quo_deli` float NOT NULL,
  `quo_total` float NOT NULL,
  `quo_create` datetime NOT NULL,
  `quo_update` datetime NOT NULL,
  `quo_uid` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `quotation_appraisal`
--

INSERT INTO `quotation_appraisal` (`quo_id`, `quo_no`, `quo_date`, `quo_namepj`, `quo_name`, `quo_address`, `quo_sum`, `quo_specialdis`, `quo_afterdis`, `quo_vat`, `quo_deli`, `quo_total`, `quo_create`, `quo_update`, `quo_uid`) VALUES
(21, 16, '2022-12-17', '1111111111111', 'j', 'k', 28, 3, 25, 1.75, 0, 26.75, '2022-12-24 11:36:43', '2022-12-27 10:08:53', 1),
(23, 4, '2022-12-18', 'hhhhhhhhhhhhhhhhh', 'gg', 'jdzhj;j;', 9, 0, 9, 0.63, 0, 9.63, '2022-12-24 16:41:08', '0000-00-00 00:00:00', 1),
(24, 2, '2023-01-21', 'da', 'rag', 'ar', 9, 0, 9, 0.63, 10, 19.63, '2023-01-03 12:02:30', '0000-00-00 00:00:00', 1),
(25, 2221, '2023-01-15', '่ารร', 'ห', 'หยยย', 28, 0, 28, 1.96, 20, 49.96, '2023-01-03 13:35:36', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_appraisal_details`
--

CREATE TABLE `quotation_appraisal_details` (
  `quode_id` bigint(20) NOT NULL,
  `quode_quoid` bigint(20) NOT NULL,
  `quode_item` varchar(255) NOT NULL,
  `quode_amount` int(255) NOT NULL,
  `quode_price` float NOT NULL,
  `quode_result` float NOT NULL,
  `quode_create` datetime NOT NULL,
  `quode_update` datetime NOT NULL,
  `quode_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `quotation_appraisal_details`
--

INSERT INTO `quotation_appraisal_details` (`quode_id`, `quode_quoid`, `quode_item`, `quode_amount`, `quode_price`, `quode_result`, `quode_create`, `quode_update`, `quode_uid`) VALUES
(22, 23, 'ydjd', 3, 3, 9, '2022-12-24 16:41:08', '0000-00-00 00:00:00', 1),
(41, 21, 'j', 4, 4, 16, '2022-12-24 11:36:43', '2022-12-27 10:08:53', 1),
(42, 21, 'k', 2, 4, 8, '2022-12-24 11:36:43', '2022-12-27 10:08:53', 1),
(43, 21, 'kk', 2, 2, 4, '2022-12-24 11:36:43', '2022-12-27 10:08:53', 1),
(46, 24, 'n', 3, 3, 9, '2023-01-03 12:02:30', '0000-00-00 00:00:00', 1),
(47, 25, '้ำ', 3, 4, 12, '2023-01-03 13:35:36', '0000-00-00 00:00:00', 1),
(48, 25, 'นน', 2, 8, 16, '2023-01-03 13:35:36', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_in`
--

CREATE TABLE `quotation_in` (
  `quoin_id` bigint(20) NOT NULL,
  `quoin_no` varchar(255) NOT NULL,
  `quoin_date` date NOT NULL,
  `quoin_company` varchar(255) NOT NULL,
  `quoin_file` varchar(255) NOT NULL,
  `quoin_status` varchar(255) NOT NULL DEFAULT 'รออนุมัติ',
  `quoin_remark` varchar(255) DEFAULT NULL,
  `quoin_create` datetime NOT NULL,
  `quoin_update` datetime DEFAULT NULL,
  `quoin_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `quotation_in`
--

INSERT INTO `quotation_in` (`quoin_id`, `quoin_no`, `quoin_date`, `quoin_company`, `quoin_file`, `quoin_status`, `quoin_remark`, `quoin_create`, `quoin_update`, `quoin_uid`) VALUES
(1, 'sb', '2022-12-31', 'df', 'quotationin-20230104154932.pdf', 'ไม่อนุมัติ', 'df', '2023-01-04 15:49:32', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_out`
--

CREATE TABLE `quotation_out` (
  `quoout_id` bigint(20) NOT NULL,
  `quoout_no` int(255) NOT NULL,
  `quoout_date` date NOT NULL,
  `quoout_name` varchar(255) NOT NULL,
  `quoout_address` varchar(255) NOT NULL,
  `quoout_numtax` varchar(255) DEFAULT NULL,
  `quoout_sum` float NOT NULL,
  `quoout_specialdis` float NOT NULL,
  `quoout_afterdis` float NOT NULL,
  `quoout_vat` float NOT NULL,
  `quoout_deli` float DEFAULT NULL,
  `quoout_total` float NOT NULL,
  `quoout_create` datetime NOT NULL,
  `quoout_update` datetime DEFAULT NULL,
  `quoout_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `quotation_out`
--

INSERT INTO `quotation_out` (`quoout_id`, `quoout_no`, `quoout_date`, `quoout_name`, `quoout_address`, `quoout_numtax`, `quoout_sum`, `quoout_specialdis`, `quoout_afterdis`, `quoout_vat`, `quoout_deli`, `quoout_total`, `quoout_create`, `quoout_update`, `quoout_uid`) VALUES
(4, 113, '2022-12-17', '', '', '1212121212121', 60, 0, 60, 4.2, 0, 64.2, '2022-12-24 16:46:23', '2022-12-28 16:48:51', 1),
(5, 13, '2022-12-18', 'g', 'gg', '11111111111111', 24, 4.2, 19.8, 1.39, 0, 21.19, '2022-12-27 10:49:38', NULL, 1),
(6, 754, '2023-01-13', '', 'jbjh', '11', 4, 0, 4, 0.28, 10, 14.28, '2023-01-03 11:58:15', '2023-01-03 12:01:47', 1),
(7, 2, '2023-01-13', 'n', 'jjk', '', 4, 0, 4, 0.28, 0, 4.28, '2023-01-03 11:59:50', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_out_details`
--

CREATE TABLE `quotation_out_details` (
  `quooutde_id` bigint(20) NOT NULL,
  `quooutde_quooutid` bigint(20) NOT NULL,
  `quooutde_item` varchar(255) NOT NULL,
  `quooutde_amount` int(255) NOT NULL,
  `quooutde_price` float NOT NULL,
  `quooutde_result` float NOT NULL,
  `quooutde_create` datetime NOT NULL,
  `quooutde_update` datetime NOT NULL,
  `quooutde_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `quotation_out_details`
--

INSERT INTO `quotation_out_details` (`quooutde_id`, `quooutde_quooutid`, `quooutde_item`, `quooutde_amount`, `quooutde_price`, `quooutde_result`, `quooutde_create`, `quooutde_update`, `quooutde_uid`) VALUES
(6, 5, 'hh', 2, 2, 4, '2022-12-27 10:49:38', '0000-00-00 00:00:00', 1),
(7, 5, 'gg', 4, 5, 20, '2022-12-27 10:49:38', '0000-00-00 00:00:00', 1),
(8, 4, 'ysbhuhb', 5, 12, 60, '2022-12-24 16:46:23', '2022-12-28 16:48:51', 1),
(10, 7, 'kj', 2, 2, 4, '2023-01-03 11:59:50', '0000-00-00 00:00:00', 1),
(11, 6, 'jj', 2, 2, 4, '2023-01-03 11:58:15', '2023-01-03 12:01:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` bigint(20) NOT NULL,
  `report_proid` bigint(20) NOT NULL,
  `report_name` varchar(255) NOT NULL,
  `report_create` datetime NOT NULL,
  `report_update` datetime NOT NULL,
  `report_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_subtitle`
--

CREATE TABLE `report_subtitle` (
  `repsub_id` bigint(20) NOT NULL,
  `repsub_tid` bigint(20) NOT NULL,
  `repsub_name` varchar(255) NOT NULL,
  `repsub_detail` varchar(255) NOT NULL,
  `repsub_create` datetime NOT NULL,
  `repsub_update` datetime NOT NULL,
  `repsub_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_title`
--

CREATE TABLE `report_title` (
  `reptitle_id` bigint(20) NOT NULL,
  `reptitle_repuid` bigint(20) NOT NULL,
  `reptitle_name` varchar(255) NOT NULL,
  `reptitle_detail` varchar(255) NOT NULL,
  `reptitle_create` datetime NOT NULL,
  `reptitle_update` datetime NOT NULL,
  `reptitle_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_unit`
--

CREATE TABLE `report_unit` (
  `repunit_id` bigint(20) NOT NULL,
  `repunit_repid` bigint(20) NOT NULL,
  `repunit_name` varchar(255) NOT NULL,
  `repunit_create` datetime NOT NULL,
  `repunit_update` datetime NOT NULL,
  `repunit_uid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `prefix`, `fname`, `lname`, `gender`, `age`, `email`, `position`, `department`, `phone`, `img`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'นาย', 'test', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-23 10:04:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`archives_id`),
  ADD KEY `archives_uid` (`archives_uid`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `contract_uid` (`contract_uid`);

--
-- Indexes for table `docin`
--
ALTER TABLE `docin`
  ADD PRIMARY KEY (`docin_id`),
  ADD KEY `docin_uid` (`docin_uid`);

--
-- Indexes for table `docout`
--
ALTER TABLE `docout`
  ADD PRIMARY KEY (`docout_id`),
  ADD KEY `docout_uid` (`docout_uid`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expenses_id`),
  ADD KEY `expenses_uid` (`expenses_uid`);

--
-- Indexes for table `invoicebill`
--
ALTER TABLE `invoicebill`
  ADD PRIMARY KEY (`invbill_id`),
  ADD KEY `invbill_uid` (`invbill_uid`);

--
-- Indexes for table `invoicebill_details`
--
ALTER TABLE `invoicebill_details`
  ADD PRIMARY KEY (`invbilld_id`),
  ADD KEY `invbilld_bid` (`invbilld_bid`),
  ADD KEY `invbilld_uid` (`invbilld_uid`);

--
-- Indexes for table `invoicetax`
--
ALTER TABLE `invoicetax`
  ADD PRIMARY KEY (`invtax_id`),
  ADD KEY `invtax_uid` (`invtax_uid`);

--
-- Indexes for table `invoicetax_details`
--
ALTER TABLE `invoicetax_details`
  ADD PRIMARY KEY (`invtaxd_id`),
  ADD KEY `invtaxd_tid` (`invtaxd_tid`),
  ADD KEY `invtaxd_uid` (`invtaxd_uid`);

--
-- Indexes for table `presentation`
--
ALTER TABLE `presentation`
  ADD PRIMARY KEY (`present_id`),
  ADD KEY `present_repid` (`present_repid`),
  ADD KEY `present_uid` (`present_uid`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `project_quoid` (`project_quoid`),
  ADD KEY `project_uid` (`project_uid`);

--
-- Indexes for table `project_plan`
--
ALTER TABLE `project_plan`
  ADD PRIMARY KEY (`plan_id`),
  ADD KEY `plan_proid` (`plan_proid`),
  ADD KEY `plan_repid` (`plan_repid`),
  ADD KEY `plan_uid` (`plan_uid`);

--
-- Indexes for table `quotation_appraisal`
--
ALTER TABLE `quotation_appraisal`
  ADD PRIMARY KEY (`quo_id`),
  ADD KEY `uid` (`quo_uid`);

--
-- Indexes for table `quotation_appraisal_details`
--
ALTER TABLE `quotation_appraisal_details`
  ADD PRIMARY KEY (`quode_id`),
  ADD KEY `quode_quoid` (`quode_quoid`),
  ADD KEY `quode_uid` (`quode_uid`);

--
-- Indexes for table `quotation_in`
--
ALTER TABLE `quotation_in`
  ADD PRIMARY KEY (`quoin_id`),
  ADD KEY `quoin_uid` (`quoin_uid`);

--
-- Indexes for table `quotation_out`
--
ALTER TABLE `quotation_out`
  ADD PRIMARY KEY (`quoout_id`),
  ADD KEY `quoout_uid` (`quoout_uid`);

--
-- Indexes for table `quotation_out_details`
--
ALTER TABLE `quotation_out_details`
  ADD PRIMARY KEY (`quooutde_id`),
  ADD KEY `quooutd_quoid` (`quooutde_quooutid`),
  ADD KEY `quooutd_uid` (`quooutde_uid`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `report_proid` (`report_proid`),
  ADD KEY `report_uid` (`report_uid`);

--
-- Indexes for table `report_subtitle`
--
ALTER TABLE `report_subtitle`
  ADD PRIMARY KEY (`repsub_id`),
  ADD KEY `repsub_tid` (`repsub_tid`),
  ADD KEY `repsub_uid` (`repsub_uid`);

--
-- Indexes for table `report_title`
--
ALTER TABLE `report_title`
  ADD PRIMARY KEY (`reptitle_id`),
  ADD KEY `reptitle_repuid` (`reptitle_repuid`),
  ADD KEY `reptitle_uid` (`reptitle_uid`);

--
-- Indexes for table `report_unit`
--
ALTER TABLE `report_unit`
  ADD PRIMARY KEY (`repunit_id`),
  ADD KEY `repunit_repid` (`repunit_repid`),
  ADD KEY `repunit_uid` (`repunit_uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `archives_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `contract_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `docin`
--
ALTER TABLE `docin`
  MODIFY `docin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `docout`
--
ALTER TABLE `docout`
  MODIFY `docout_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenses_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoicebill`
--
ALTER TABLE `invoicebill`
  MODIFY `invbill_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoicebill_details`
--
ALTER TABLE `invoicebill_details`
  MODIFY `invbilld_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoicetax`
--
ALTER TABLE `invoicetax`
  MODIFY `invtax_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoicetax_details`
--
ALTER TABLE `invoicetax_details`
  MODIFY `invtaxd_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presentation`
--
ALTER TABLE `presentation`
  MODIFY `present_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_plan`
--
ALTER TABLE `project_plan`
  MODIFY `plan_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_appraisal`
--
ALTER TABLE `quotation_appraisal`
  MODIFY `quo_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `quotation_appraisal_details`
--
ALTER TABLE `quotation_appraisal_details`
  MODIFY `quode_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `quotation_in`
--
ALTER TABLE `quotation_in`
  MODIFY `quoin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotation_out`
--
ALTER TABLE `quotation_out`
  MODIFY `quoout_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quotation_out_details`
--
ALTER TABLE `quotation_out_details`
  MODIFY `quooutde_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_subtitle`
--
ALTER TABLE `report_subtitle`
  MODIFY `repsub_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_title`
--
ALTER TABLE `report_title`
  MODIFY `reptitle_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_unit`
--
ALTER TABLE `report_unit`
  MODIFY `repunit_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `archives_ibfk_1` FOREIGN KEY (`archives_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `contract_ibfk_1` FOREIGN KEY (`contract_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `docin`
--
ALTER TABLE `docin`
  ADD CONSTRAINT `docin_ibfk_1` FOREIGN KEY (`docin_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `docout`
--
ALTER TABLE `docout`
  ADD CONSTRAINT `docout_ibfk_1` FOREIGN KEY (`docout_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`expenses_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoicebill`
--
ALTER TABLE `invoicebill`
  ADD CONSTRAINT `invoicebill_ibfk_1` FOREIGN KEY (`invbill_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoicebill_details`
--
ALTER TABLE `invoicebill_details`
  ADD CONSTRAINT `invoicebill_details_ibfk_1` FOREIGN KEY (`invbilld_bid`) REFERENCES `invoicebill` (`invbill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoicebill_details_ibfk_2` FOREIGN KEY (`invbilld_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoicetax`
--
ALTER TABLE `invoicetax`
  ADD CONSTRAINT `invoicetax_ibfk_1` FOREIGN KEY (`invtax_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `invoicetax_details`
--
ALTER TABLE `invoicetax_details`
  ADD CONSTRAINT `invoicetax_details_ibfk_1` FOREIGN KEY (`invtaxd_tid`) REFERENCES `invoicetax` (`invtax_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoicetax_details_ibfk_2` FOREIGN KEY (`invtaxd_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `presentation`
--
ALTER TABLE `presentation`
  ADD CONSTRAINT `presentation_ibfk_1` FOREIGN KEY (`present_repid`) REFERENCES `report` (`report_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presentation_ibfk_2` FOREIGN KEY (`present_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`project_quoid`) REFERENCES `quotation_appraisal` (`quo_id`),
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`project_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_plan`
--
ALTER TABLE `project_plan`
  ADD CONSTRAINT `project_plan_ibfk_1` FOREIGN KEY (`plan_proid`) REFERENCES `project` (`project_id`),
  ADD CONSTRAINT `project_plan_ibfk_2` FOREIGN KEY (`plan_repid`) REFERENCES `report` (`report_id`),
  ADD CONSTRAINT `project_plan_ibfk_3` FOREIGN KEY (`plan_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quotation_appraisal`
--
ALTER TABLE `quotation_appraisal`
  ADD CONSTRAINT `quotation_appraisal_ibfk_1` FOREIGN KEY (`quo_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quotation_appraisal_details`
--
ALTER TABLE `quotation_appraisal_details`
  ADD CONSTRAINT `quotation_appraisal_details_ibfk_1` FOREIGN KEY (`quode_quoid`) REFERENCES `quotation_appraisal` (`quo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quotation_appraisal_details_ibfk_2` FOREIGN KEY (`quode_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `quotation_in`
--
ALTER TABLE `quotation_in`
  ADD CONSTRAINT `quotation_in_ibfk_1` FOREIGN KEY (`quoin_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `quotation_out`
--
ALTER TABLE `quotation_out`
  ADD CONSTRAINT `quotation_out_ibfk_1` FOREIGN KEY (`quoout_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `quotation_out_details`
--
ALTER TABLE `quotation_out_details`
  ADD CONSTRAINT `quotation_out_details_ibfk_1` FOREIGN KEY (`quooutde_quooutid`) REFERENCES `quotation_out` (`quoout_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quotation_out_details_ibfk_2` FOREIGN KEY (`quooutde_uid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`report_proid`) REFERENCES `project` (`project_id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`report_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `report_subtitle`
--
ALTER TABLE `report_subtitle`
  ADD CONSTRAINT `report_subtitle_ibfk_1` FOREIGN KEY (`repsub_tid`) REFERENCES `report_title` (`reptitle_id`),
  ADD CONSTRAINT `report_subtitle_ibfk_2` FOREIGN KEY (`repsub_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `report_title`
--
ALTER TABLE `report_title`
  ADD CONSTRAINT `report_title_ibfk_1` FOREIGN KEY (`reptitle_repuid`) REFERENCES `report_unit` (`repunit_id`),
  ADD CONSTRAINT `report_title_ibfk_2` FOREIGN KEY (`reptitle_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `report_unit`
--
ALTER TABLE `report_unit`
  ADD CONSTRAINT `report_unit_ibfk_1` FOREIGN KEY (`repunit_repid`) REFERENCES `report` (`report_id`),
  ADD CONSTRAINT `report_unit_ibfk_2` FOREIGN KEY (`repunit_uid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
