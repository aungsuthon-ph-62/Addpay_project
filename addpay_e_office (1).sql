-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 28, 2023 at 03:00 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.27

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
  `archives_id` bigint NOT NULL,
  `archives_title` varchar(255) NOT NULL,
  `archives_file` varchar(255) NOT NULL,
  `archives_create` datetime NOT NULL,
  `archives_update` datetime DEFAULT NULL,
  `archives_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`archives_id`, `archives_title`, `archives_file`, `archives_create`, `archives_update`, `archives_uid`) VALUES
(8, 'zsgyh', 'archives-20230105090737.pdf', '2023-01-05 09:07:37', '2023-01-24 13:53:11', 2),
(10, 'nnnn', 'archives-20230124140236.JPG', '2023-01-24 10:23:47', '2023-01-24 14:10:12', 2),
(13, 'zsrhar', 'archives-20230124135754.JPG', '2023-01-24 12:31:10', '2023-01-24 14:05:23', 2),
(15, 'เทนนิส', 'archives-20230124160040.jpg', '2023-01-24 16:00:40', '2023-01-24 16:01:00', 7);

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `contract_id` bigint NOT NULL,
  `contract_lgdeld` date NOT NULL,
  `contract_lgexpd` date NOT NULL,
  `contract_comp` varchar(255) NOT NULL,
  `contract_title` varchar(255) NOT NULL,
  `contract_file` varchar(255) NOT NULL,
  `contract_filesigner` varchar(255) NOT NULL,
  `contract_ann` date NOT NULL,
  `contract_create` datetime NOT NULL,
  `contract_update` datetime DEFAULT NULL,
  `contract_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`contract_id`, `contract_lgdeld`, `contract_lgexpd`, `contract_comp`, `contract_title`, `contract_file`, `contract_filesigner`, `contract_ann`, `contract_create`, `contract_update`, `contract_uid`) VALUES
(2, '2023-01-19', '2023-01-29', 'ำ้ำพห', 'rexh', 'contract-20230116104243.JPG', 'filesigner-20230116104243.pdf', '2023-02-01', '2023-01-05 10:15:13', '2023-02-22 15:29:31', 4),
(4, '2023-01-14', '2023-01-27', 'EJegedzdzn', 'gj,ansfzdn', 'contract-20230116102254.JPG', 'filesigner-20230116102254.JPG', '2023-02-01', '2023-01-16 10:22:54', '2023-01-24 12:47:16', 2),
(6, '2023-01-25', '2023-01-26', 'abcdef', 'ขอเชิญบุคลากรในสังกัดเป็นวิทยากรการเกษตร', 'contract-20230124104346.pdf', 'filesigner-20230124104346.pdf', '2023-01-26', '2023-01-24 10:43:46', '2023-01-24 10:44:00', 7),
(7, '2023-01-25', '2023-01-27', 'bnk 48', 'เบงเค 48', 'contract-20230124160816.jpg', 'filesigner-20230124160816.jpg', '2023-01-26', '2023-01-24 16:08:16', '2023-01-24 16:08:46', 7);

-- --------------------------------------------------------

--
-- Table structure for table `docin`
--

CREATE TABLE `docin` (
  `docin_id` bigint NOT NULL,
  `docin_no` varchar(255) NOT NULL,
  `docin_date` date NOT NULL,
  `docin_srcname` varchar(255) NOT NULL,
  `docin_title` varchar(255) NOT NULL,
  `docin_to` varchar(255) NOT NULL,
  `docin_file` varchar(255) NOT NULL,
  `docin_create` datetime NOT NULL,
  `docin_update` datetime DEFAULT NULL,
  `docin_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `docin`
--

INSERT INTO `docin` (`docin_id`, `docin_no`, `docin_date`, `docin_srcname`, `docin_title`, `docin_to`, `docin_file`, `docin_create`, `docin_update`, `docin_uid`) VALUES
(2, 'n', '2023-01-08', 'jjh', 'jhb', 'j', 'docin-20230106142412.pdf', '2023-01-06 14:24:12', '2023-02-23 09:42:30', 4),
(77, 'm', '2023-01-08', 'jjhyu h', 'jhb', 'j', 'docin-20230109104635.pdf', '2023-01-06 14:24:12', '2023-01-09 10:46:35', 2),
(85, 'อพ. 020/21', '2023-01-24', 'เบงเค 48', 'เรียนเชิญมานะ', 'ใครก็ไม่รู้', 'docin-20230124160413.png', '2023-01-24 16:04:13', '2023-01-24 16:04:29', 7),
(86, '2225', '2023-02-22', 'j', 'jj', 'jj', 'docin-20230209111421.png', '2023-02-09 11:14:21', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `docout`
--

CREATE TABLE `docout` (
  `docout_id` bigint NOT NULL,
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
  `docout_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `docout`
--

INSERT INTO `docout` (`docout_id`, `docout_no`, `docout_date`, `docout_title`, `docout_to`, `docout_send`, `docout_details`, `docout_signame`, `docout_position`, `docout_create`, `docout_update`, `docout_uid`) VALUES
(1, '222', '2022-12-15', 'าาjjhh', '้่jiuarkkkk', '<p>hbjablrhhhhhhhhhhsbghkdjrggbbbbbhhhahghagrsrbhnrbghgrbgrbhbhsbggrgbhrhgrhghrgjgndndjdnrrrrrrrrrrrrhuhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh</p><p><br></p><p><br></p><p data-f-id=\"pbf\" style=\"text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;\">Powered by <a href=\"https://www.froala.com/wysiwyg-editor?pb=1\" title=\"Froala Editor\">Froala Editor</a></p>', '<p>jjjkkkkkkkkkkkkkkkkkkkkkkkkkkkkeaไพgukbuywabgrguhbsbheubbwbgbwfbhgbwbhgghwaggbabawekfwbhfjhwbfbwbwebhbefwfbwgggggggggggggggggggggggggggggggggggggggggggggggggekfbhwwghb</p><p data-f-id=\"pbf\" style=\"text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;\">Powered by <a href=\"https://www.froala.com/wysiwyg-editor?pb=1\" title=\"Froala Editor\">Froala Editor</a></p>', 'jkmm', 'bbb', '2022-12-27 07:55:29', '2023-02-02 19:52:36', 3),
(3, 'llkkk', '2023-01-06', 'wth', 'uyh', 'hb', 'bhhbjnj\r\nhbuib', 'vg', 'vg', '2023-01-05 15:36:19', '2023-01-05 16:07:00', 1),
(7, 'jjg', '2023-01-20', 'g', 'j', '<p>hbj</p>', '<p>hbj</p>', 'hjb', 'hb', '2023-01-06 13:52:52', NULL, 2),
(8, 'hbj', '2023-01-14', 'hbj', 'bkjh', '<p>bh</p>', '<p>hb</p>', 'h', 'h', '2023-01-06 13:53:08', NULL, 2),
(12, 'ah', '2023-01-20', 'sh', 'erh', '', '', 'rzd', 'reah', '2023-01-07 09:34:01', NULL, 2),
(13, 'lGBW', '2023-01-21', 'aeh', 'eahi', '<p>aehrr</p>', '<p>aehrr</p>', 'rjz', 'aeh', '2023-01-07 10:39:58', NULL, 2),
(14, 'hgjr', '2023-01-13', 'ag', 'erah', '<p>tt</p>', '<p>sh</p>', 'rare', 're', '2023-01-07 10:40:19', NULL, 2),
(17, 'อพ. 020/2564', '2023-02-23', 'ขอเชิญบุคลากรในสังกัดเป็นวิทยากรการ', 'คณบดี คณะเทคโนโลยีอุตสาหกรรม มหาวิทยาลัยราชภัฎอุบลราชธานี', '<p>hrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrh rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr r&nbsp; &nbsp; &nbsp; &nbsp;ryry&nbsp; r yry r r yryr r yryr&nbsp; ryryr ryryry</p>', 'hrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrh rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr r       ryry  r yry r r yryr r yryr  ryryr ryryry', 'ดร.ศิริมาเมธ์วดี ศิรธนิตรา', 'ประธานกรรมการ', '2023-02-08 09:58:01', NULL, 4),
(18, 'อพ. 020/2565', '2023-02-08', 'ขอเชิญบุคลากรในสังกัดเป็นวิทยากรการ', 'คณบดี คณะเทคโนโลยีอุตสาหกรรม มหาวิทยาลัยราชภัฎอุบลราชธานี', '<p>ccccccccc</p><p>fffffffffff</p><p>fffffffffffff</p>', '<p>fffffffffffffffffffffffffffffffffffffvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv</p>', 'ดร.ศิริมาเมธ์วดี ศิรธนิตรา', 'ประธานกรรมการ', '2023-02-08 10:49:39', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expenses_id` bigint NOT NULL,
  `expenses_type` varchar(255) NOT NULL,
  `expenses_date` date NOT NULL,
  `expenses_list` varchar(255) NOT NULL,
  `expenses_price` varchar(255) NOT NULL,
  `expenses_file` varchar(255) NOT NULL,
  `expenses_create` datetime NOT NULL,
  `expenses_update` datetime DEFAULT NULL,
  `expenses_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expenses_id`, `expenses_type`, `expenses_date`, `expenses_list`, `expenses_price`, `expenses_file`, `expenses_create`, `expenses_update`, `expenses_uid`) VALUES
(3, 'ประจำ', '2023-01-20', 'jdzkl', '100202', 'expenses-20230109133726.docx', '2023-01-09 13:37:26', '2023-01-09 14:08:05', 2),
(4, 'ประจำ', '2023-01-13', 'jdzkl', '222', 'expenses-20230109134542.JPG', '2023-01-09 13:45:42', '0000-00-00 00:00:00', 2),
(7, 'ประจำ', '2023-01-24', 'ค่าไฟ', '500.5', 'expenses-20230124142118.png', '2023-01-24 14:20:54', '2023-01-24 14:30:29', 7),
(8, 'ไม่ประจำ', '2023-01-24', 'ค่าข้าว', '800.78', 'expenses-20230124143052.png', '2023-01-24 14:30:52', '2023-01-24 14:31:02', 4),
(10, 'ไม่ประจำ', '2023-01-25', 'ค่ารถไฟอุบล - กรุงเทพ', '750.52', 'expenses-20230124160149.png', '2023-01-24 16:01:49', '2023-01-24 16:03:11', 7);

-- --------------------------------------------------------

--
-- Table structure for table `invoicebill`
--

CREATE TABLE `invoicebill` (
  `invbill_id` bigint NOT NULL,
  `invbill_no` varchar(255) NOT NULL,
  `invbill_date` date NOT NULL,
  `invbill_name` varchar(255) NOT NULL,
  `invbill_address` varchar(255) NOT NULL,
  `invbill_cusid` varchar(255) NOT NULL,
  `invbill_deli` float DEFAULT NULL,
  `invbill_total` float NOT NULL,
  `invbill_page` int NOT NULL,
  `invbill_remark` varchar(255) DEFAULT NULL,
  `invbill_create` datetime NOT NULL,
  `invbill_update` datetime DEFAULT NULL,
  `invbill_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `invoicebill`
--

INSERT INTO `invoicebill` (`invbill_id`, `invbill_no`, `invbill_date`, `invbill_name`, `invbill_address`, `invbill_cusid`, `invbill_deli`, `invbill_total`, `invbill_page`, `invbill_remark`, `invbill_create`, `invbill_update`, `invbill_uid`) VALUES
(74, '288', '2023-02-10', 'บริษทั อาเคโบโน เบรค (ประเทศไทย) จำกัด', 'หหห', '1234567898745', 800, 7220, 1, '', '2023-01-24 15:54:55', '2023-02-22 15:21:53', 4),
(75, '6401027777', '2023-01-18', 'บริษัท อาเคโบโน เบรค (ประเทศไทย) จำกัด', 'uujjk', '205-5490-2184-4', 60, 16110, 1, '', '2023-01-30 11:50:40', '2023-02-22 15:22:10', 4),
(76, '64010211', '2023-01-26', 'บริษัท อาเคโบโน เบรค (ประเทศไทย) จำกัด', ']pnnnnnnnnnnnnnnnn', '205-5490-2184-4', 0, 14980, 1, '', '2023-01-30 11:52:13', '2023-02-22 15:22:22', 4),
(77, '1144', '2023-02-22', 'บริษัท อาเคโบโน เบรค (ประเทศไทย) จำกัด', 'rrffff', '205-5490-2184-4', 60, 1986, 1, '', '2023-02-22 15:20:51', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `invoicebill_details`
--

CREATE TABLE `invoicebill_details` (
  `invbilld_id` bigint NOT NULL,
  `invbilld_bid` bigint NOT NULL,
  `invbilld_inv_date` date DEFAULT NULL,
  `invbilld_due_date` date DEFAULT NULL,
  `invbilld_item` varchar(255) NOT NULL,
  `invbilld_price` float NOT NULL,
  `invbilld_vat` float NOT NULL,
  `invbilld_result` float NOT NULL,
  `invbilld_create` datetime NOT NULL,
  `invbilld_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `invoicebill_details`
--

INSERT INTO `invoicebill_details` (`invbilld_id`, `invbilld_bid`, `invbilld_inv_date`, `invbilld_due_date`, `invbilld_item`, `invbilld_price`, `invbilld_vat`, `invbilld_result`, `invbilld_create`, `invbilld_update`) VALUES
(61, 77, NULL, NULL, 'ถุงกระดาษ', 500, 35, 535, '2023-02-22 15:20:51', NULL),
(62, 77, NULL, NULL, 'mp3 module', 1300, 91, 1391, '2023-02-22 15:20:51', NULL),
(63, 74, NULL, NULL, 'ถุงกระดาษ', 6000, 420, 6420, '2023-02-22 15:21:53', NULL),
(64, 75, NULL, NULL, 'บอร์ด Control', 15000, 1050, 16050, '2023-02-22 15:22:10', NULL),
(65, 76, NULL, NULL, 'mp3 module', 14000, 980, 14980, '2023-02-22 15:22:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoicetax`
--

CREATE TABLE `invoicetax` (
  `invtax_id` bigint NOT NULL,
  `invtax_no` varchar(255) NOT NULL,
  `invtax_date` date NOT NULL,
  `invtax_name` varchar(255) NOT NULL,
  `invtax_address` varchar(255) NOT NULL,
  `invtax_cusid` varchar(255) NOT NULL,
  `invtax_sum` float NOT NULL,
  `invtax_vat` float NOT NULL,
  `invtax_total` float NOT NULL,
  `invtax_create` datetime NOT NULL,
  `invtax_update` datetime DEFAULT NULL,
  `invtax_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `invoicetax`
--

INSERT INTO `invoicetax` (`invtax_id`, `invtax_no`, `invtax_date`, `invtax_name`, `invtax_address`, `invtax_cusid`, `invtax_sum`, `invtax_vat`, `invtax_total`, `invtax_create`, `invtax_update`, `invtax_uid`) VALUES
(4, '77777777', '2023-01-24', 'อุบลยูเนี่ยน 2558 จำกัด', 'pppppppppp', '', 25000, 1750, 26750, '2023-01-24 10:38:59', NULL, 4),
(6, '1', '2023-01-25', 'KANTEERA WADCHARATHADSANAKUL', 'เบงเค 48', '1234567890123', 1950, 136.5, 2086.5, '2023-01-24 15:59:22', '2023-01-24 15:59:49', 7),
(7, '1144', '2023-02-22', 'อุบลยูเนี่ยน 2558 จำกัด', 'hklnflahgdjgavohgjevkd\'0jg-epjgeovodbhga0ejgabmdoahgakv;\'kvpmg[ahegjep', '', 3500, 245, 3745, '2023-02-22 15:23:16', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `invoicetax_details`
--

CREATE TABLE `invoicetax_details` (
  `invtaxd_id` bigint NOT NULL,
  `invtaxd_tid` bigint NOT NULL,
  `invtaxd_item` varchar(255) NOT NULL,
  `invtaxd_amount` int NOT NULL,
  `invtaxd_price` float NOT NULL,
  `invtaxd_result` float NOT NULL,
  `invtaxd_create` datetime NOT NULL,
  `invtaxd_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `invoicetax_details`
--

INSERT INTO `invoicetax_details` (`invtaxd_id`, `invtaxd_tid`, `invtaxd_item`, `invtaxd_amount`, `invtaxd_price`, `invtaxd_result`, `invtaxd_create`, `invtaxd_update`) VALUES
(8, 4, 'ถุงกระดาษ', 500, 50, 25000, '2023-01-24 10:38:59', NULL),
(17, 6, 'boxset_nnn', 5, 50, 250, '2023-01-24 15:59:22', '2023-01-24 15:59:49'),
(18, 6, 'aaa', 10, 50, 500, '2023-01-24 15:59:22', '2023-01-24 15:59:49'),
(19, 6, 'boxset_nnn', 12, 100, 1200, '2023-01-24 15:59:22', '2023-01-24 15:59:49'),
(20, 7, 'ถุงกระดาษ', 100, 35, 3500, '2023-02-22 15:23:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `presentation`
--

CREATE TABLE `presentation` (
  `present_id` bigint NOT NULL,
  `present_repid` bigint DEFAULT NULL,
  `present_create` datetime DEFAULT NULL,
  `present_update` datetime DEFAULT NULL,
  `present_uid` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` bigint NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_agency` varchar(255) NOT NULL,
  `project_budget` varchar(255) NOT NULL,
  `project_detail` varchar(255) NOT NULL,
  `project_quoid` bigint NOT NULL,
  `project_quono` varchar(255) NOT NULL,
  `project_file` varchar(255) NOT NULL,
  `project_create` datetime NOT NULL,
  `project_update` datetime DEFAULT NULL,
  `project_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `project_agency`, `project_budget`, `project_detail`, `project_quoid`, `project_quono`, `project_file`, `project_create`, `project_update`, `project_uid`) VALUES
(7, 'ehhrr', 'bfbb', '8000', 'ehbssbsbb', 43, '1144', 'project-20230222150516.pdf', '2023-02-22 15:05:16', '2023-02-23 10:13:56', 4),
(8, 'ehhrr', 'bfbb', '8000', 'ehbssbsbb', 43, '1144', 'project-20230222152705.pdf', '2023-02-22 15:27:05', '2023-02-23 10:13:56', 4),
(9, 'ehhrr2', 'bfbb', '8000', 'ehbssbsbb', 43, '1144', 'project-20230222154322.png', '2023-02-22 15:43:22', '2023-02-23 10:16:36', 4);

-- --------------------------------------------------------

--
-- Table structure for table `project_plan`
--

CREATE TABLE `project_plan` (
  `plan_id` bigint NOT NULL,
  `plan_proid` bigint NOT NULL,
  `plan_repid` bigint NOT NULL,
  `plan_create` datetime NOT NULL,
  `plan_update` datetime NOT NULL,
  `plan_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `project_tor`
--

CREATE TABLE `project_tor` (
  `projtor_id` bigint NOT NULL,
  `projtor_pid` bigint NOT NULL,
  `projtor_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `projtor_detail` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `projtor_create` datetime NOT NULL,
  `projtor_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_tor`
--

INSERT INTO `project_tor` (`projtor_id`, `projtor_pid`, `projtor_title`, `projtor_detail`, `projtor_create`, `projtor_update`) VALUES
(11, 7, 'hdhdd', 'dhdd', '2023-02-22 15:05:16', NULL),
(12, 7, 'dhrh', 'fxtfnbr', '2023-02-22 15:05:16', NULL),
(13, 8, 'เงื่อนไข', 'gegegegevdv', '2023-02-22 15:27:05', NULL),
(14, 8, 'ssgfs', 'vsvssvsvsssvssv', '2023-02-22 15:27:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_appraisal`
--

CREATE TABLE `quotation_appraisal` (
  `quo_id` bigint NOT NULL,
  `quo_no` varchar(255) NOT NULL,
  `quo_date` date NOT NULL,
  `quo_namepj` varchar(255) NOT NULL,
  `quo_name` varchar(255) NOT NULL,
  `quo_address` varchar(255) NOT NULL,
  `quo_sum` float NOT NULL,
  `quo_specialdis` float DEFAULT NULL,
  `quo_afterdis` float NOT NULL,
  `quo_vat` float NOT NULL,
  `quo_deli` float DEFAULT NULL,
  `quo_total` float NOT NULL,
  `quo_create` datetime NOT NULL,
  `quo_update` datetime DEFAULT NULL,
  `quo_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `quotation_appraisal`
--

INSERT INTO `quotation_appraisal` (`quo_id`, `quo_no`, `quo_date`, `quo_namepj`, `quo_name`, `quo_address`, `quo_sum`, `quo_specialdis`, `quo_afterdis`, `quo_vat`, `quo_deli`, `quo_total`, `quo_create`, `quo_update`, `quo_uid`) VALUES
(27, 'yukk', '2023-01-15', 'srz', 'aer', 'rh', 59, 0, 59, 4.13, 20, 83.13, '2023-01-07 11:50:43', '2023-01-07 13:29:54', 1),
(30, 'yug', '2023-01-07', 'aeh', 'aeh', 'earh', 59, 0, 59, 4.13, 0, 63.13, '2023-01-07 15:44:30', '2023-01-24 10:26:57', 2),
(31, 'yuoo', '2023-01-14', 'gvv', 'gbh', 'gb12345', 77, 0, 77, 5.39, 0, 82.39, '2023-01-10 13:47:01', '2023-01-24 10:17:32', 7),
(34, 'yuudlg', '2023-01-14', 'njzd', 'hbfxjh', 'dfbs', 315, 20, 295, 20.65, 20, 335.65, '2023-01-24 10:41:52', NULL, 2),
(35, 'yuhj,', '2023-01-20', 'xjn c', 'xjcn', 'xchn', 76, 20, 56, 3.92, 20, 79.92, '2023-01-24 10:45:08', NULL, 2),
(37, 'yus', '2023-01-21', 'ัเ้', 'ัะ้', 'ัอเ้', 48, 0, 48, 3.36, 0, 51.36, '2023-01-24 10:55:10', NULL, 2),
(38, 'ush', '2023-01-28', 'ftvg', 'tf', 'ty', 63, 0, 63, 4.41, 0, 67.41, '2023-01-24 10:56:56', NULL, 2),
(39, 'ubh', '2023-01-20', 'gh', 'gvh', 'h', 48, 0, 48, 3.36, 0, 51.36, '2023-01-24 11:33:17', NULL, 2),
(41, 'ex.123', '2023-01-25', 'อิงฟ้า', 'มิสแกรนด์', 'มิสแกรนด์กรุงเทพมหานคร 2022', 6000, 0, 6000, 420, 0, 6420, '2023-01-24 16:10:22', '2023-01-24 16:10:41', 7),
(42, '155', '2023-02-07', 'test', 'test', 'test', 376, 0, 376, 26.32, 0, 402.32, '2023-02-07 10:26:23', NULL, 8),
(43, '1144', '2023-02-22', 'พัฒนาชุมชน', 'พัฒนาชุมชน จ.อุบล', 'hhhtrfbsfhrwhrjjj', 17500, 0, 17500, 1225, 60, 18785, '2023-02-22 15:24:09', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_appraisal_details`
--

CREATE TABLE `quotation_appraisal_details` (
  `quode_id` bigint NOT NULL,
  `quode_quoid` bigint NOT NULL,
  `quode_item` varchar(255) NOT NULL,
  `quode_amount` int NOT NULL,
  `quode_price` float NOT NULL,
  `quode_result` float NOT NULL,
  `quode_create` datetime NOT NULL,
  `quode_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `quotation_appraisal_details`
--

INSERT INTO `quotation_appraisal_details` (`quode_id`, `quode_quoid`, `quode_item`, `quode_amount`, `quode_price`, `quode_result`, `quode_create`, `quode_update`) VALUES
(52, 27, ';l', 4, 5, 20, '2023-01-07 11:50:43', '2023-01-07 13:29:54'),
(53, 27, 'k', 7, 5, 35, '2023-01-07 11:50:43', '2023-01-07 13:29:54'),
(54, 27, 'ol', 2, 2, 4, '2023-01-07 11:50:43', '2023-01-07 13:29:54'),
(63, 31, 'fgjvm', 8, 7, 56, '2023-01-10 13:47:01', '2023-01-24 10:17:32'),
(64, 31, 'yubh', 3, 3, 9, '2023-01-10 13:47:01', '2023-01-24 10:17:32'),
(65, 31, 'jn', 2, 6, 12, '2023-01-10 13:47:01', '2023-01-24 10:17:32'),
(66, 30, 'reh', 3, 3, 9, '2023-01-07 15:44:30', '2023-01-24 10:26:57'),
(67, 30, 'uiijh', 10, 5, 50, '2023-01-07 15:44:30', '2023-01-24 10:26:57'),
(69, 34, 'hbj,', 45, 7, 315, '2023-01-24 10:41:52', NULL),
(70, 35, 'hbdjxb', 4, 5, 20, '2023-01-24 10:45:08', NULL),
(71, 35, 'jxn4', 8, 7, 56, '2023-01-24 10:45:08', NULL),
(74, 37, 'gh', 8, 6, 48, '2023-01-24 10:55:10', NULL),
(75, 38, 'ghjn', 7, 9, 63, '2023-01-24 10:56:56', NULL),
(76, 39, 'gfvb', 8, 6, 48, '2023-01-24 11:33:17', NULL),
(81, 41, 'ชา', 1, 1000, 1000, '2023-01-24 16:10:22', '2023-01-24 16:10:41'),
(82, 41, 'ล็อต', 1, 5000, 5000, '2023-01-24 16:10:22', '2023-01-24 16:10:41'),
(83, 42, '1_test', 4, 34, 136, '2023-02-07 10:26:23', NULL),
(84, 42, '2_test', 4, 60, 240, '2023-02-07 10:26:23', NULL),
(85, 43, 'ถุงกระดาษ', 500, 35, 17500, '2023-02-22 15:24:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_in`
--

CREATE TABLE `quotation_in` (
  `quoin_id` bigint NOT NULL,
  `quoin_no` varchar(255) NOT NULL,
  `quoin_date` date NOT NULL,
  `quoin_company` varchar(255) NOT NULL,
  `quoin_file` varchar(255) NOT NULL,
  `quoin_status` varchar(255) NOT NULL DEFAULT 'รออนุมัติ',
  `quoin_remark` varchar(255) DEFAULT NULL,
  `quoin_create` datetime NOT NULL,
  `quoin_update` datetime DEFAULT NULL,
  `quoin_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `quotation_in`
--

INSERT INTO `quotation_in` (`quoin_id`, `quoin_no`, `quoin_date`, `quoin_company`, `quoin_file`, `quoin_status`, `quoin_remark`, `quoin_create`, `quoin_update`, `quoin_uid`) VALUES
(2, 'uskhb', '2023-01-28', 'dsuh', 'quotationin-20230124115151.PNG', 'รออนุมัติ', 'd', '2023-01-24 11:51:51', NULL, 1),
(3, 'กก12333', '2023-01-26', 'test556789', 'quotationin-20230124115400.pdf', 'ไม่อนุมัติ', 'ไม่ชอบ', '2023-01-24 11:54:00', '2023-01-24 11:54:20', 7),
(4, '123', '2023-01-25', 'ไดเวอร์ซิตี้', 'quotationin-20230124161157.jpg', 'อนุมัติ', 'ชอบ', '2023-01-24 16:11:57', '2023-01-24 16:12:37', 7);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_out`
--

CREATE TABLE `quotation_out` (
  `quoout_id` bigint NOT NULL,
  `quoout_no` varchar(255) NOT NULL,
  `quoout_date` date NOT NULL,
  `quoout_name` varchar(255) NOT NULL,
  `quoout_address` varchar(255) NOT NULL,
  `quoout_numtax` varchar(255) DEFAULT NULL,
  `quoout_sum` float NOT NULL,
  `quoout_specialdis` float DEFAULT NULL,
  `quoout_afterdis` float NOT NULL,
  `quoout_vat` float NOT NULL,
  `quoout_deli` float DEFAULT NULL,
  `quoout_total` float NOT NULL,
  `quoout_create` datetime NOT NULL,
  `quoout_update` datetime DEFAULT NULL,
  `quoout_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `quotation_out`
--

INSERT INTO `quotation_out` (`quoout_id`, `quoout_no`, `quoout_date`, `quoout_name`, `quoout_address`, `quoout_numtax`, `quoout_sum`, `quoout_specialdis`, `quoout_afterdis`, `quoout_vat`, `quoout_deli`, `quoout_total`, `quoout_create`, `quoout_update`, `quoout_uid`) VALUES
(16, '5555', '2023-01-24', 'ddddddddddd', 'dddddddddddddddddddd', '', 25000, 0, 25000, 1750, 60, 26810, '2023-01-24 13:51:16', NULL, 4),
(18, '1144', '2023-02-22', 'IMCO PACK CORPRATION LIMITED', 'rsgssvsvs', '', 17500, 0, 17500, 1225, 80, 18805, '2023-02-22 15:25:04', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_out_details`
--

CREATE TABLE `quotation_out_details` (
  `quooutde_id` bigint NOT NULL,
  `quooutde_quooutid` bigint NOT NULL,
  `quooutde_item` varchar(255) NOT NULL,
  `quooutde_amount` int NOT NULL,
  `quooutde_price` float NOT NULL,
  `quooutde_result` float NOT NULL,
  `quooutde_create` datetime NOT NULL,
  `quooutde_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `quotation_out_details`
--

INSERT INTO `quotation_out_details` (`quooutde_id`, `quooutde_quooutid`, `quooutde_item`, `quooutde_amount`, `quooutde_price`, `quooutde_result`, `quooutde_create`, `quooutde_update`) VALUES
(18, 16, 'mp3 module', 5, 5000, 25000, '2023-01-24 13:51:16', NULL),
(22, 18, 'ถุงกระดาษ', 500, 35, 17500, '2023-02-22 15:25:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` bigint NOT NULL,
  `report_proid` bigint NOT NULL,
  `report_name` varchar(255) NOT NULL,
  `report_create` datetime NOT NULL,
  `report_update` datetime NOT NULL,
  `report_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `report_title`
--

CREATE TABLE `report_title` (
  `reptitle_id` bigint NOT NULL,
  `reptitle_repuid` bigint NOT NULL,
  `reptitle_name` varchar(255) NOT NULL,
  `reptitle_detail` varchar(255) NOT NULL,
  `reptitle_create` datetime NOT NULL,
  `reptitle_update` datetime NOT NULL,
  `reptitle_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `report_unit`
--

CREATE TABLE `report_unit` (
  `repunit_id` bigint NOT NULL,
  `repunit_repid` bigint NOT NULL,
  `repunit_name` varchar(255) NOT NULL,
  `repunit_create` datetime NOT NULL,
  `repunit_update` datetime NOT NULL,
  `repunit_uid` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `prefix`, `fname`, `lname`, `gender`, `age`, `email`, `position`, `department`, `phone`, `img`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'นาย', 'test', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-23 10:04:45', NULL),
(2, 'jomtap', '$2y$10$fLxylLaitQ/I/Pw.Zr0Vcuc4wwTinprPmpKQ1Xs1j/v80bHWSuf9q', 'นาย', 'ธนวัฒน์', 'ลัดดา', NULL, NULL, NULL, NULL, NULL, NULL, '242217087_3073194829622220_2369252618758948707_n-63b7d97119d6e.jpg', '2023-01-05 14:42:11', '2023-01-06 15:18:57'),
(3, 'Aungsu_test', '$2y$10$YyRnGrBK40WDzmqCMYCPBuws659Tn.5EUSTnjVBh6SSvG9H.3zaPK', 'นาย', 'Aungsuthon', 'Phosu', 'ชาย', '22', 'aungsuthon.ph.62@ubu.ac.th', 'IT', 'IT', '0622200843', 'Aungsuthon-63c4c150ea5b7.jpg', '2023-01-16 10:12:23', '2023-01-16 10:15:28'),
(4, 'lima', '$2y$10$B2fGTvoUg3Fie.VVYbowzubP3Tzcc6mn/GrLNpdeUfOrzt5lPYGd2', 'นางสาว', 'ลีมา', 'ศรีภักดี', 'หญิง', '22', 'test@test.com', 'นักศึกษาฝึกสหกิจ', 'ไอที', '0901236584', 'IMG_20210312_183851-63e07c3eaddb9.jpg', '2023-01-16 10:16:31', '2023-02-06 11:04:14'),
(5, 'pia', '$2y$10$KCQn6h2r6RdG0P2ruQRWSuhsbyhQ4BzaCXK8HrlyNJCGrFQw9lOA6', 'นางสาว', 'ยุภาวดี', 'ปรนปรือ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-16 10:17:04', NULL),
(6, 'Oofoilppk', '$2y$10$fiiEsj3p3NqkeILr7mo4buGbEsslUyLtBwDErOMAqoCiphw4eMMnK', 'นางสาว', 'Foil', 'Aooni', 'หญิง', '10000', 'df@gmail.com', 'คนสวย', 'คนรวย', '1234567890', 'inbound1802785245553588070-63c4c35849f0e.jpg', '2023-01-16 10:22:58', '2023-01-16 10:26:01'),
(7, 'noey_bkk', '$2y$10$F8LGQJWg.antO4dGUfHLtOkogtSiVhTQsfH/CjD6Jl9aGP7jCqq8i', 'นางสาว', 'กานต์ธีรา', 'วัชระทัศนกุล', 'หญิง', '25', 'noey@gmail.com', 'คนสวย', 'สวยมาก', '0987654321', '275380410_510889567070961_3760607044981260987_n-63cf4cf44df9c.jpg', '2023-01-24 10:12:34', '2023-01-24 10:14:56'),
(8, 'somying', '$2y$10$q96DNKaweyt2PMqWgkffE.oA9PcBNEGrXXZeTTMb8zHrilu9FGi/i', 'นางสาว', 'สมหญิง', 'ใจดี', 'หญิง', '22', 'somying01@gmail.com', 'นักศึกษาฝึกสหกิจ', 'ไอที', '0611112233', NULL, '2023-02-06 14:38:16', '2023-02-06 14:39:25'),
(9, 'khunaoy', '$2y$10$ObgK485YNO.i135v5ow9AuDfCYGRVsSKhOQ0u0fYhLCVOV9FzzHBO', 'นางสาว', 'สมศรี', 'วรรณู', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-27 15:15:14', NULL);

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
  ADD KEY `invbilld_bid` (`invbilld_bid`);

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
  ADD KEY `invtaxd_tid` (`invtaxd_tid`);

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
-- Indexes for table `project_tor`
--
ALTER TABLE `project_tor`
  ADD PRIMARY KEY (`projtor_id`),
  ADD KEY `detail` (`projtor_pid`);

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
  ADD KEY `quode_quoid` (`quode_quoid`);

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
  ADD KEY `quooutd_quoid` (`quooutde_quooutid`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `report_proid` (`report_proid`),
  ADD KEY `report_uid` (`report_uid`);

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
  MODIFY `archives_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `contract_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `docin`
--
ALTER TABLE `docin`
  MODIFY `docin_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `docout`
--
ALTER TABLE `docout`
  MODIFY `docout_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenses_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoicebill`
--
ALTER TABLE `invoicebill`
  MODIFY `invbill_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `invoicebill_details`
--
ALTER TABLE `invoicebill_details`
  MODIFY `invbilld_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `invoicetax`
--
ALTER TABLE `invoicetax`
  MODIFY `invtax_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoicetax_details`
--
ALTER TABLE `invoicetax_details`
  MODIFY `invtaxd_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `presentation`
--
ALTER TABLE `presentation`
  MODIFY `present_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `project_plan`
--
ALTER TABLE `project_plan`
  MODIFY `plan_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_tor`
--
ALTER TABLE `project_tor`
  MODIFY `projtor_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `quotation_appraisal`
--
ALTER TABLE `quotation_appraisal`
  MODIFY `quo_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `quotation_appraisal_details`
--
ALTER TABLE `quotation_appraisal_details`
  MODIFY `quode_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `quotation_in`
--
ALTER TABLE `quotation_in`
  MODIFY `quoin_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quotation_out`
--
ALTER TABLE `quotation_out`
  MODIFY `quoout_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quotation_out_details`
--
ALTER TABLE `quotation_out_details`
  MODIFY `quooutde_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_title`
--
ALTER TABLE `report_title`
  MODIFY `reptitle_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_unit`
--
ALTER TABLE `report_unit`
  MODIFY `repunit_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `archives_ibfk_1` FOREIGN KEY (`archives_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `contract_ibfk_1` FOREIGN KEY (`contract_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `docin`
--
ALTER TABLE `docin`
  ADD CONSTRAINT `docin_ibfk_1` FOREIGN KEY (`docin_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `docout`
--
ALTER TABLE `docout`
  ADD CONSTRAINT `docout_ibfk_1` FOREIGN KEY (`docout_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`expenses_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoicebill`
--
ALTER TABLE `invoicebill`
  ADD CONSTRAINT `invoicebill_ibfk_1` FOREIGN KEY (`invbill_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoicebill_details`
--
ALTER TABLE `invoicebill_details`
  ADD CONSTRAINT `invoicebill_details_ibfk_1` FOREIGN KEY (`invbilld_bid`) REFERENCES `invoicebill` (`invbill_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoicetax`
--
ALTER TABLE `invoicetax`
  ADD CONSTRAINT `invoicetax_ibfk_1` FOREIGN KEY (`invtax_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `invoicetax_details`
--
ALTER TABLE `invoicetax_details`
  ADD CONSTRAINT `invoicetax_details_ibfk_1` FOREIGN KEY (`invtaxd_tid`) REFERENCES `invoicetax` (`invtax_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presentation`
--
ALTER TABLE `presentation`
  ADD CONSTRAINT `presentation_ibfk_1` FOREIGN KEY (`present_repid`) REFERENCES `report` (`report_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `presentation_ibfk_2` FOREIGN KEY (`present_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`project_quoid`) REFERENCES `quotation_appraisal` (`quo_id`),
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`project_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_plan`
--
ALTER TABLE `project_plan`
  ADD CONSTRAINT `project_plan_ibfk_1` FOREIGN KEY (`plan_proid`) REFERENCES `project` (`project_id`),
  ADD CONSTRAINT `project_plan_ibfk_2` FOREIGN KEY (`plan_repid`) REFERENCES `report` (`report_id`),
  ADD CONSTRAINT `project_plan_ibfk_3` FOREIGN KEY (`plan_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_tor`
--
ALTER TABLE `project_tor`
  ADD CONSTRAINT `detail` FOREIGN KEY (`projtor_pid`) REFERENCES `project` (`project_id`) ON DELETE CASCADE;

--
-- Constraints for table `quotation_appraisal`
--
ALTER TABLE `quotation_appraisal`
  ADD CONSTRAINT `quotation_appraisal_ibfk_1` FOREIGN KEY (`quo_uid`) REFERENCES `users` (`id`);

--
-- Constraints for table `quotation_appraisal_details`
--
ALTER TABLE `quotation_appraisal_details`
  ADD CONSTRAINT `quotation_appraisal_details_ibfk_1` FOREIGN KEY (`quode_quoid`) REFERENCES `quotation_appraisal` (`quo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `quotation_out_details_ibfk_1` FOREIGN KEY (`quooutde_quooutid`) REFERENCES `quotation_out` (`quoout_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`report_proid`) REFERENCES `project` (`project_id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`report_uid`) REFERENCES `users` (`id`);

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
