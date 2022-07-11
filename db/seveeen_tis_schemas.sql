-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2019 at 04:00 PM
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
-- Database: `seveeen_tis_schemas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_password` varchar(30) NOT NULL,
  `admin_status` text NOT NULL,
  `admin_date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tis_academic_calendar`
--

CREATE TABLE `tis_academic_calendar` (
  `ac_id` int(11) NOT NULL,
  `ac_school` int(11) NOT NULL,
  `ac_acyear` varchar(15) NOT NULL,
  `ac_semester_index` varchar(5) NOT NULL,
  `ac_sem_start` date NOT NULL,
  `ac_sem_end` date NOT NULL,
  `status` varchar(15) NOT NULL,
  `delete_status` tinyint(1) NOT NULL,
  `delete_reason` varchar(255) NOT NULL,
  `delete_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `done_by` int(11) NOT NULL,
  `regdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tis_academic_calendar`
--

INSERT INTO `tis_academic_calendar` (`ac_id`, `ac_school`, `ac_acyear`, `ac_semester_index`, `ac_sem_start`, `ac_sem_end`, `status`, `delete_status`, `delete_reason`, `delete_date`, `done_by`, `regdate`) VALUES
(1, 1, '2019', 'I', '2019-01-01', '2019-03-30', 'active', 0, '', '2019-01-03 21:07:26', 1, '2019-01-03 21:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `tis_archives`
--

CREATE TABLE `tis_archives` (
  `arch_id` int(11) NOT NULL,
  `arch_owner` varchar(25) NOT NULL,
  `arch_ownertype` varchar(11) NOT NULL,
  `arch_identifier` varchar(50) NOT NULL,
  `arch_name` text NOT NULL,
  `arch_type` varchar(255) NOT NULL,
  `arch_size` varchar(15) NOT NULL,
  `arch_description` varchar(255) NOT NULL,
  `reset_status` varchar(15) NOT NULL,
  `delete_status` tinyint(1) NOT NULL,
  `delete_reason` varchar(255) NOT NULL,
  `doneby` int(11) NOT NULL,
  `delete_date` datetime NOT NULL,
  `regdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tis_classes`
--

CREATE TABLE `tis_classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(20) NOT NULL,
  `class_xkul` int(11) NOT NULL,
  `class_status` varchar(5) NOT NULL,
  `class_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tis_classes`
--

INSERT INTO `tis_classes` (`class_id`, `class_name`, `class_xkul`, `class_status`, `class_date`) VALUES
(1, 'S1 ', 1, 'E', '2019-01-03 18:15:40'),
(2, 'S2 ', 1, 'E', '2019-01-03 18:15:46'),
(3, 'S3 ', 1, 'E', '2019-01-03 18:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `tis_count_loogs`
--

CREATE TABLE `tis_count_loogs` (
  `log_id` int(11) NOT NULL,
  `log_usr` int(11) NOT NULL,
  `log_xkul` int(11) NOT NULL,
  `log_type` varchar(20) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tis_count_loogs`
--

INSERT INTO `tis_count_loogs` (`log_id`, `log_usr`, `log_xkul`, `log_type`, `log_date`) VALUES
(1, 1, 1, 'School', '2019-01-03 18:15:00'),
(2, 4, 1, 'Teacher', '2019-01-03 19:09:17'),
(3, 3, 1, 'Teacher', '2019-01-03 19:11:10'),
(4, 1, 1, 'School', '2019-01-03 19:16:30'),
(5, 4, 1, 'Teacher', '2019-01-03 19:36:43'),
(6, 1, 1, 'School', '2019-01-03 19:43:44'),
(7, 1, 1, 'School', '2019-01-04 17:16:31'),
(8, 1, 1, 'School', '2019-01-04 20:12:56'),
(9, 1, 1, 'School', '2019-01-04 20:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `tis_count_teacher_tasks`
--

CREATE TABLE `tis_count_teacher_tasks` (
  `count_tt_id` int(11) NOT NULL,
  `count_task_teacher` int(11) NOT NULL,
  `count_tt_count` int(11) NOT NULL,
  `count_tt_marked` int(11) NOT NULL,
  `count_tt_last_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `count_task_xkul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tis_count_teacher_tasks`
--

INSERT INTO `tis_count_teacher_tasks` (`count_tt_id`, `count_task_teacher`, `count_tt_count`, `count_tt_marked`, `count_tt_last_date`, `count_task_xkul`) VALUES
(1, 3, 4, 4, '2019-01-03 19:11:31', 1),
(2, 4, 4, 2, '2019-01-03 19:37:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tis_courses`
--

CREATE TABLE `tis_courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(20) NOT NULL,
  `course_marks` int(11) NOT NULL,
  `course_class` int(11) NOT NULL,
  `course_teacher` int(11) NOT NULL,
  `course_xkul` int(11) NOT NULL,
  `course_status` text NOT NULL,
  `course_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tis_courses`
--

INSERT INTO `tis_courses` (`course_id`, `course_name`, `course_marks`, `course_class`, `course_teacher`, `course_xkul`, `course_status`, `course_date`) VALUES
(1, 'Mathematics', 60, 1, 3, 1, 'E', '2019-01-03 18:20:37'),
(2, 'Geography', 40, 1, 2, 1, 'E', '2019-01-03 18:27:23'),
(3, 'Biology', 60, 1, 4, 1, 'E', '2019-01-03 18:28:33'),
(4, 'Mathematics', 60, 2, 0, 1, 'E', '2019-01-03 18:28:57'),
(5, 'Geography', 40, 2, 2, 1, 'E', '2019-01-03 18:29:09'),
(6, 'Biology', 60, 2, 0, 1, 'E', '2019-01-03 18:29:20'),
(7, 'Mathematics', 60, 3, 0, 1, 'E', '2019-01-03 18:29:46'),
(8, 'Biology', 60, 3, 0, 1, 'E', '2019-01-03 18:29:57'),
(9, 'Physics', 40, 3, 4, 1, 'E', '2019-01-03 18:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `tis_general_courses`
--

CREATE TABLE `tis_general_courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `course_accr` varchar(5) NOT NULL,
  `course_level` varchar(30) NOT NULL,
  `regdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tis_general_courses`
--

INSERT INTO `tis_general_courses` (`course_id`, `course_name`, `course_accr`, `course_level`, `regdate`) VALUES
(1, 'Kinyarwanda', 'Kinya', '', '2019-01-02'),
(2, 'Mathematics', 'Math', '', '2019-01-02'),
(3, 'Social and Religious Studies', 'Socia', '', '2019-01-02'),
(4, 'Science and Elementary Technology', 'EST', '', '2019-01-02'),
(5, 'Music', '', '', '2019-01-02'),
(6, 'Fine Art', '', '', '2019-01-02'),
(7, 'Craft', '', '', '2019-01-02'),
(8, 'Physical Education', 'Sport', '', '2019-01-02'),
(9, 'French', '', '', '2019-01-02'),
(10, 'Physics', '', '', '2019-01-02'),
(11, 'Chemistry', '', '', '2019-01-02'),
(12, 'Biology', '', '', '2019-01-02'),
(13, 'ICT', '', '', '2019-01-02'),
(14, 'History', '', '', '2019-01-02'),
(15, 'Geography', '', '', '2019-01-02'),
(16, 'Entrepreneurship', '', '', '2019-01-02'),
(17, 'Kiswahili', '', '', '2019-01-02'),
(18, 'Literature', '', '', '2019-01-02'),
(19, 'Religion and Ethics', '', '', '2019-01-02'),
(20, 'Farming', '', '', '2019-01-02'),
(21, 'Library and Clubs', '', '', '2019-01-02'),
(22, 'Economics', '', '', '2019-01-02'),
(23, 'General Studies and Communication', '', '', '2019-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `tis_issues`
--

CREATE TABLE `tis_issues` (
  `iss_id` int(11) NOT NULL,
  `iss_owner_id` int(11) NOT NULL,
  `iss_owner_type` varchar(50) NOT NULL,
  `iss_title` varchar(50) NOT NULL,
  `iss_status` varchar(25) DEFAULT NULL,
  `delete_status` tinyint(1) DEFAULT NULL,
  `delete_reason` varchar(255) NOT NULL,
  `regdate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tis_issues_chat`
--

CREATE TABLE `tis_issues_chat` (
  `isc_id` int(11) NOT NULL,
  `isc_issueid` int(11) NOT NULL,
  `isc_from_id` int(11) NOT NULL,
  `isc_from_type` varchar(50) NOT NULL,
  `isc_message` text NOT NULL,
  `isc_receiver_id` int(11) NOT NULL,
  `isc_receiver_type` varchar(50) NOT NULL,
  `isc_status` varchar(15) NOT NULL,
  `delete_status` tinyint(1) DEFAULT NULL,
  `delete_reason` varchar(255) NOT NULL,
  `regdate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tis_schools`
--

CREATE TABLE `tis_schools` (
  `school_id` int(11) NOT NULL,
  `school_full_name` varchar(50) NOT NULL,
  `school_username` varchar(30) NOT NULL,
  `school_password` varchar(255) NOT NULL,
  `school_status` varchar(5) NOT NULL,
  `school_abbreviation` varchar(30) DEFAULT 'NO',
  `school_category` varchar(3) NOT NULL,
  `church_based` varchar(3) NOT NULL DEFAULT 'NO',
  `school_phone` varchar(15) NOT NULL,
  `school_location` varchar(12) NOT NULL,
  `school_email` varchar(30) NOT NULL,
  `school_brt_by` varchar(100) NOT NULL,
  `school_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tis_schools`
--

INSERT INTO `tis_schools` (`school_id`, `school_full_name`, `school_username`, `school_password`, `school_status`, `school_abbreviation`, `school_category`, `church_based`, `school_phone`, `school_location`, `school_email`, `school_brt_by`, `school_date`) VALUES
(1, 'groupe scolaire gihinga', '2785317', '123', 'E', 'G.S.Gihinga', 'PU', 'def', '0782785317', 'Kamomyi', 'gsgihinga@gmail.com', 'BFG', '2019-01-03 17:53:57'),
(2, 'ecole secondaire de nyarutovu', 'Ecosenya', 'Vkd4U2FtVkJQVDA9', 'E', 'Ecosenya', 'PU', 'def', '0782123922', 'Gakenke', 'ecosenya@reb.ac.rw', 'BFG', '2019-01-03 18:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `tis_seveeen_ltd`
--

CREATE TABLE `tis_seveeen_ltd` (
  `seveeen_ltd_id` int(11) NOT NULL,
  `seveeen_ltd_name` varchar(35) NOT NULL,
  `seveeen_ltd_user` varchar(35) NOT NULL,
  `seveeen_ltd_pass` varchar(35) NOT NULL,
  `seveeen_ltd_permisssion_status` varchar(5) NOT NULL,
  `seveeen_ltd_main_status` varchar(5) NOT NULL,
  `seveeen_ltd_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tis_seveeen_ltd`
--

INSERT INTO `tis_seveeen_ltd` (`seveeen_ltd_id`, `seveeen_ltd_name`, `seveeen_ltd_user`, `seveeen_ltd_pass`, `seveeen_ltd_permisssion_status`, `seveeen_ltd_main_status`, `seveeen_ltd_date`) VALUES
(1, 'VlRKV01scFhWbXhpYVVKTlpFZFJQUT09', '759195cde7eacf00d192aebafc07d0e2', 'ec9eff718386d3881d23d05be52b0cc7', 'A', 'E', '2018-10-07 13:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `tis_students`
--

CREATE TABLE `tis_students` (
  `student_id` int(11) NOT NULL,
  `student_fullname` varchar(40) NOT NULL,
  `student_sex` text NOT NULL,
  `student_father` varchar(50) NOT NULL,
  `student_father_phone` varchar(12) NOT NULL,
  `student_mother` varchar(50) NOT NULL,
  `student_mother_phone` varchar(12) NOT NULL,
  `student_guardian` varchar(50) NOT NULL,
  `student_guardian_relation` varchar(30) NOT NULL,
  `student_guardian_phone` varchar(12) NOT NULL,
  `student_class` int(11) NOT NULL,
  `student_xkul` int(11) NOT NULL,
  `student_status` text NOT NULL,
  `student_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tis_students`
--

INSERT INTO `tis_students` (`student_id`, `student_fullname`, `student_sex`, `student_father`, `student_father_phone`, `student_mother`, `student_mother_phone`, `student_guardian`, `student_guardian_relation`, `student_guardian_phone`, `student_class`, `student_xkul`, `student_status`, `student_date`) VALUES
(1, 'John James Kamana', 'M', '', '', '', 'm_phone', '', '', 'g_phone', 1, 1, 'E', '2019-01-03 19:03:16'),
(2, 'BYIRINGIRO  Nepomscene', 'M', '', '', '', '', '', '', '', 1, 1, 'E', '2019-01-03 19:03:16'),
(3, 'ISHIMWE Claudinne', 'F', '', '', '', '', '', '', '', 1, 1, 'E', '2019-01-03 19:03:16'),
(4, 'KEZA Cyntia', 'F', '', '', '', '', '', '', '', 1, 1, 'E', '2019-01-03 19:03:16'),
(5, 'MUHIRE Jean Claude', 'M', '', '', '', '', '', '', '', 1, 1, 'E', '2019-01-03 19:03:16'),
(6, 'MUKUNZI Noeline', 'F', '', '', '', '', '', '', '', 1, 1, 'E', '2019-01-03 19:03:17'),
(7, 'UWERA  Sandrine', 'F', '', '', '', '', '', '', '', 1, 1, 'E', '2019-01-03 19:03:17'),
(8, 'James gashumba', 'M', '', '78942232', '', '', '', '', '', 2, 1, 'E', '2019-01-03 19:32:15'),
(9, 'ISHIMWE Claudine', 'F', '', '72342981', '', '', '', '', '', 2, 1, 'E', '2019-01-03 19:32:15'),
(10, 'Manishimwe Cyntia', 'F', '', '78940912', '', '', '', '', '', 2, 1, 'E', '2019-01-03 19:32:15'),
(11, 'MUHIRE James', 'M', '', '78801235', '', '', '', '', '', 2, 1, 'E', '2019-01-03 19:32:15'),
(12, 'Ingabire Pauline', 'F', '', '73942201', '', '', '', '', '', 2, 1, 'E', '2019-01-03 19:32:15'),
(13, 'Kaneza Juliene', 'F', '', '78902252', '', '', '', '', '', 2, 1, 'E', '2019-01-03 19:32:15'),
(14, 'Diana Keza', 'F', '', '78293284', '', '', '', '', '', 3, 1, 'E', '2019-01-03 19:36:00'),
(15, 'Kanyaan Clemence', 'F', '', '72373744', '', '', '', '', '', 3, 1, 'E', '2019-01-03 19:36:00'),
(16, 'Iranzi Jean', 'M', '', '78126363', '', '', '', '', '', 3, 1, 'E', '2019-01-03 19:36:00'),
(17, 'Marina Charlote', 'F', '', '73934948', '', '', '', '', '', 3, 1, 'E', '2019-01-03 19:36:00'),
(18, 'Landord Hope', 'M', '', '78236464', '', '', '', '', '', 3, 1, 'E', '2019-01-03 19:36:00'),
(19, 'Klyian Mike', 'M', '', '72287474', '', '', '', '', '', 3, 1, 'E', '2019-01-03 19:36:00'),
(20, 'Murenzi Ernest', 'M', '', '730123890', '', '', '', '', '', 2, 1, 'E', '2019-01-03 20:15:41'),
(21, ' ', '', '', '', '', '', '', '', '', 2, 1, 'E', '2019-01-03 20:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `tis_st_t_evaluation`
--

CREATE TABLE `tis_st_t_evaluation` (
  `st_t_id` int(11) NOT NULL,
  `st_t_class` int(11) NOT NULL,
  `st_t_course` int(11) NOT NULL,
  `st_t_teacher` int(11) NOT NULL,
  `st_t_period` varchar(15) NOT NULL,
  `st_t_mark_1` int(11) NOT NULL,
  `st_t_mark_2` int(11) NOT NULL,
  `st_t_mark_3` int(11) NOT NULL,
  `st_t_mark_4` int(11) NOT NULL,
  `st_t_mark_5` int(11) NOT NULL,
  `st_t_mark_total` int(11) NOT NULL,
  `st_t_mark_comment` varchar(50) NOT NULL,
  `st_t_xkul` int(11) NOT NULL,
  `st_t_status` varchar(5) NOT NULL DEFAULT 'E',
  `st_t_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tis_st_t_evaluation`
--

INSERT INTO `tis_st_t_evaluation` (`st_t_id`, `st_t_class`, `st_t_course`, `st_t_teacher`, `st_t_period`, `st_t_mark_1`, `st_t_mark_2`, `st_t_mark_3`, `st_t_mark_4`, `st_t_mark_5`, `st_t_mark_total`, `st_t_mark_comment`, `st_t_xkul`, `st_t_status`, `st_t_date`) VALUES
(1, 1, 1, 3, '2019-I-1', 100, 100, 90, 65, 90, 445, 'He is good in everything,understand course content', 1, 'E', '2019-01-03 19:59:39'),
(2, 1, 1, 3, '2019-I-1', 65, 65, 90, 100, 90, 410, 'He is good in everything,understand course content', 1, 'E', '2019-01-03 19:59:59'),
(3, 1, 1, 3, '2019-I-1', 100, 90, 65, 65, 50, 370, 'not good in english he is no proficient', 1, 'E', '2019-01-03 20:00:28'),
(4, 1, 1, 3, '2019-I-1', 100, 90, 65, 50, 50, 355, 'He is good in everything,understand course content', 1, 'E', '2019-01-03 20:01:33'),
(5, 3, 9, 4, '2019-I-1', 90, 100, 65, 90, 65, 410, 'not really bad,but also not an expert', 1, 'E', '2019-01-03 20:02:06'),
(6, 3, 9, 4, '2019-I-1', 90, 65, 90, 100, 100, 445, 'not really bad,but also not an expert', 1, 'E', '2019-01-03 20:02:26'),
(7, 3, 9, 4, '2019-I-1', 50, 40, 100, 50, 65, 305, 'not well understand the course', 1, 'E', '2019-01-03 20:02:56'),
(8, 3, 9, 4, '2019-I-1', 90, 100, 100, 100, 65, 455, 'not well understand the course', 1, 'E', '2019-01-03 20:03:15'),
(9, 3, 9, 4, '2019-I-1', 50, 90, 65, 90, 90, 385, 'not well understand the course', 1, 'E', '2019-01-03 20:03:38');

-- --------------------------------------------------------

--
-- Table structure for table `tis_tasks`
--

CREATE TABLE `tis_tasks` (
  `task_id` int(11) NOT NULL,
  `task_course` int(11) NOT NULL,
  `task_class` int(11) NOT NULL,
  `task_teacher` int(11) NOT NULL,
  `task_xkul` int(11) NOT NULL,
  `task_overall` int(11) NOT NULL,
  `task_title` varchar(50) NOT NULL,
  `task_type` text NOT NULL,
  `task_status` text NOT NULL,
  `task_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `task_temp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tis_tasks`
--

INSERT INTO `tis_tasks` (`task_id`, `task_course`, `task_class`, `task_teacher`, `task_xkul`, `task_overall`, `task_title`, `task_type`, `task_status`, `task_date`, `task_temp`) VALUES
(1, 1, 1, 3, 1, 10, 'Algebra', 'workss', 'Md', '2019-01-03 19:11:31', 7847),
(2, 1, 1, 3, 1, 15, 'Simple Equations', 'quizess', 'Md', '2019-01-03 19:12:47', 9936),
(3, 1, 1, 3, 1, 15, 'Mathematics First CAT', 'testss', 'Md', '2019-01-03 19:13:50', 9579),
(4, 1, 1, 3, 1, 30, 'First Term Exam', 'examss', 'Md', '2019-01-03 19:14:51', 4726),
(8, 9, 3, 4, 1, 20, 'Physics Exam 1', 'examss', 'Md', '2019-01-03 19:38:32', 5250),
(9, 9, 3, 4, 1, 20, 'CAT First Term', 'testss', 'Md', '2019-01-03 19:42:14', 6727);

-- --------------------------------------------------------

--
-- Table structure for table `tis_task_marks`
--

CREATE TABLE `tis_task_marks` (
  `task_marks_id` int(11) NOT NULL,
  `task_mark_student` int(11) NOT NULL,
  `task_marks_marks` float NOT NULL,
  `task_marks_overall` int(11) NOT NULL,
  `task_marks_task` int(11) NOT NULL,
  `task_marks_class` int(11) NOT NULL,
  `task_marks_teacher` int(11) NOT NULL,
  `task_marks_xkul` int(11) NOT NULL,
  `task_marks_status` text NOT NULL,
  `task_marks_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tis_task_marks`
--

INSERT INTO `tis_task_marks` (`task_marks_id`, `task_mark_student`, `task_marks_marks`, `task_marks_overall`, `task_marks_task`, `task_marks_class`, `task_marks_teacher`, `task_marks_xkul`, `task_marks_status`, `task_marks_date`) VALUES
(1, 1, 9, 10, 1, 1, 3, 1, 'E', '2019-01-03 19:11:31'),
(2, 2, 7, 10, 1, 1, 3, 1, 'E', '2019-01-03 19:11:31'),
(3, 3, 3, 10, 1, 1, 3, 1, 'E', '2019-01-03 19:11:31'),
(4, 4, 7, 10, 1, 1, 3, 1, 'E', '2019-01-03 19:11:31'),
(5, 5, 8, 10, 1, 1, 3, 1, 'E', '2019-01-03 19:11:31'),
(6, 6, 6, 10, 1, 1, 3, 1, 'E', '2019-01-03 19:11:31'),
(7, 7, 5, 10, 1, 1, 3, 1, 'E', '2019-01-03 19:11:31'),
(8, 1, 8, 15, 2, 1, 3, 1, 'E', '2019-01-03 19:12:47'),
(9, 2, 11, 15, 2, 1, 3, 1, 'E', '2019-01-03 19:12:47'),
(10, 3, 10, 15, 2, 1, 3, 1, 'E', '2019-01-03 19:12:47'),
(11, 4, 12, 15, 2, 1, 3, 1, 'E', '2019-01-03 19:12:47'),
(12, 5, 14, 15, 2, 1, 3, 1, 'E', '2019-01-03 19:12:47'),
(13, 6, 8, 15, 2, 1, 3, 1, 'E', '2019-01-03 19:12:47'),
(14, 7, 10, 15, 2, 1, 3, 1, 'E', '2019-01-03 19:12:47'),
(15, 1, 11, 15, 3, 1, 3, 1, 'E', '2019-01-03 19:13:50'),
(16, 2, 13, 15, 3, 1, 3, 1, 'E', '2019-01-03 19:13:50'),
(17, 3, 12, 15, 3, 1, 3, 1, 'E', '2019-01-03 19:13:50'),
(18, 4, 13, 15, 3, 1, 3, 1, 'E', '2019-01-03 19:13:50'),
(19, 5, 9, 15, 3, 1, 3, 1, 'E', '2019-01-03 19:13:50'),
(20, 6, 12, 15, 3, 1, 3, 1, 'E', '2019-01-03 19:13:50'),
(21, 7, 8, 15, 3, 1, 3, 1, 'E', '2019-01-03 19:13:50'),
(22, 1, 20, 30, 4, 1, 3, 1, 'E', '2019-01-03 19:14:51'),
(23, 2, 17, 30, 4, 1, 3, 1, 'E', '2019-01-03 19:14:51'),
(24, 3, 23, 30, 4, 1, 3, 1, 'E', '2019-01-03 19:14:51'),
(25, 4, 22, 30, 4, 1, 3, 1, 'E', '2019-01-03 19:14:51'),
(26, 5, 25, 30, 4, 1, 3, 1, 'E', '2019-01-03 19:14:51'),
(27, 6, 17, 30, 4, 1, 3, 1, 'E', '2019-01-03 19:14:51'),
(28, 7, 19, 30, 4, 1, 3, 1, 'E', '2019-01-03 19:14:51'),
(47, 14, 7, 20, 8, 3, 4, 1, 'E', '2019-01-03 19:38:32'),
(48, 15, 9, 20, 8, 3, 4, 1, 'E', '2019-01-03 19:38:32'),
(49, 16, 10, 20, 8, 3, 4, 1, 'E', '2019-01-03 19:38:32'),
(50, 17, 19, 20, 8, 3, 4, 1, 'E', '2019-01-03 19:38:32'),
(51, 18, 13, 20, 8, 3, 4, 1, 'E', '2019-01-03 19:38:32'),
(52, 19, 15, 20, 8, 3, 4, 1, 'E', '2019-01-03 19:38:32'),
(53, 14, 12.4, 20, 9, 3, 4, 1, 'E', '2019-01-03 19:42:14'),
(54, 15, 13.2, 20, 9, 3, 4, 1, 'E', '2019-01-03 19:42:14'),
(55, 16, 10, 20, 9, 3, 4, 1, 'E', '2019-01-03 19:42:14'),
(56, 17, 11, 20, 9, 3, 4, 1, 'E', '2019-01-03 19:42:14'),
(57, 18, 10.8, 20, 9, 3, 4, 1, 'E', '2019-01-03 19:42:14'),
(58, 19, 16.2, 20, 9, 3, 4, 1, 'E', '2019-01-03 19:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `tis_teachers`
--

CREATE TABLE `tis_teachers` (
  `teacher_id` int(11) NOT NULL,
  `teacher_fullname` varchar(40) NOT NULL,
  `teacher_username` varchar(30) NOT NULL,
  `teacher_phone` varchar(12) NOT NULL,
  `teacher_email` varchar(50) NOT NULL,
  `teacher_sex` varchar(10) NOT NULL,
  `teacher_badge` varchar(50) NOT NULL,
  `teacher_password` varchar(30) NOT NULL,
  `teacher_school` int(11) NOT NULL,
  `teacher_status` varchar(5) NOT NULL,
  `teacher_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tis_teachers`
--

INSERT INTO `tis_teachers` (`teacher_id`, `teacher_fullname`, `teacher_username`, `teacher_phone`, `teacher_email`, `teacher_sex`, `teacher_badge`, `teacher_password`, `teacher_school`, `teacher_status`, `teacher_date`) VALUES
(1, 'Ngabo Egide', 'ngabo.egide', '', '', '', 'NG10', 'groupe scolaire gihinga123', 1, 'Nw', '2019-01-03 20:30:44'),
(2, 'Muneza James', 'muneza.james', '', '', '', 'NG10', 'groupe scolaire gihinga123', 1, 'Nw', '2019-01-03 20:30:54'),
(3, 'Kanani Orest', 'kanani.orest', '', '', '', 'OL1', '87654321', 1, 'E', '2019-01-03 20:31:17'),
(4, 'Murenzi Ernest', 'murenzi.ernest', '', '', '', 'K10', '87654321', 1, 'E', '2019-01-03 20:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `tis_user_comments`
--

CREATE TABLE `tis_user_comments` (
  `com_id` int(11) NOT NULL,
  `com_sender` int(11) NOT NULL,
  `com_xkul` int(11) NOT NULL,
  `com_message` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `com_topic` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `com_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tis_user_messages`
--

CREATE TABLE `tis_user_messages` (
  `message_id` int(11) NOT NULL,
  `message_sender` int(11) NOT NULL,
  `message_sender_xkul` int(11) NOT NULL,
  `message_message` varchar(255) NOT NULL,
  `message_status` varchar(5) NOT NULL DEFAULT 'Un',
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tis_academic_calendar`
--
ALTER TABLE `tis_academic_calendar`
  ADD PRIMARY KEY (`ac_id`);

--
-- Indexes for table `tis_archives`
--
ALTER TABLE `tis_archives`
  ADD PRIMARY KEY (`arch_id`);

--
-- Indexes for table `tis_classes`
--
ALTER TABLE `tis_classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `tis_count_loogs`
--
ALTER TABLE `tis_count_loogs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tis_count_teacher_tasks`
--
ALTER TABLE `tis_count_teacher_tasks`
  ADD PRIMARY KEY (`count_tt_id`);

--
-- Indexes for table `tis_courses`
--
ALTER TABLE `tis_courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tis_general_courses`
--
ALTER TABLE `tis_general_courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tis_issues`
--
ALTER TABLE `tis_issues`
  ADD PRIMARY KEY (`iss_id`);

--
-- Indexes for table `tis_issues_chat`
--
ALTER TABLE `tis_issues_chat`
  ADD PRIMARY KEY (`isc_id`);

--
-- Indexes for table `tis_schools`
--
ALTER TABLE `tis_schools`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `tis_seveeen_ltd`
--
ALTER TABLE `tis_seveeen_ltd`
  ADD PRIMARY KEY (`seveeen_ltd_id`);

--
-- Indexes for table `tis_students`
--
ALTER TABLE `tis_students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tis_st_t_evaluation`
--
ALTER TABLE `tis_st_t_evaluation`
  ADD PRIMARY KEY (`st_t_id`);

--
-- Indexes for table `tis_tasks`
--
ALTER TABLE `tis_tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `tis_task_marks`
--
ALTER TABLE `tis_task_marks`
  ADD PRIMARY KEY (`task_marks_id`);

--
-- Indexes for table `tis_teachers`
--
ALTER TABLE `tis_teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `tis_user_comments`
--
ALTER TABLE `tis_user_comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `tis_user_messages`
--
ALTER TABLE `tis_user_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tis_academic_calendar`
--
ALTER TABLE `tis_academic_calendar`
  MODIFY `ac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tis_archives`
--
ALTER TABLE `tis_archives`
  MODIFY `arch_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tis_classes`
--
ALTER TABLE `tis_classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tis_count_loogs`
--
ALTER TABLE `tis_count_loogs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tis_count_teacher_tasks`
--
ALTER TABLE `tis_count_teacher_tasks`
  MODIFY `count_tt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tis_courses`
--
ALTER TABLE `tis_courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tis_general_courses`
--
ALTER TABLE `tis_general_courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tis_issues`
--
ALTER TABLE `tis_issues`
  MODIFY `iss_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tis_issues_chat`
--
ALTER TABLE `tis_issues_chat`
  MODIFY `isc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tis_schools`
--
ALTER TABLE `tis_schools`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tis_seveeen_ltd`
--
ALTER TABLE `tis_seveeen_ltd`
  MODIFY `seveeen_ltd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tis_students`
--
ALTER TABLE `tis_students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tis_st_t_evaluation`
--
ALTER TABLE `tis_st_t_evaluation`
  MODIFY `st_t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tis_tasks`
--
ALTER TABLE `tis_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tis_task_marks`
--
ALTER TABLE `tis_task_marks`
  MODIFY `task_marks_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `tis_teachers`
--
ALTER TABLE `tis_teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tis_user_comments`
--
ALTER TABLE `tis_user_comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tis_user_messages`
--
ALTER TABLE `tis_user_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
