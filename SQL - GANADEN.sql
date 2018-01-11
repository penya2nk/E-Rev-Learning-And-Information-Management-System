-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2018 at 05:48 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `engineering`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` int(10) NOT NULL,
  `activity_date_time` bigint(20) NOT NULL,
  `activity_venue` varchar(10) NOT NULL,
  `activity_status` tinyint(4) NOT NULL,
  `activity_description` text NOT NULL,
  `activity_details_id` tinyint(4) NOT NULL,
  `topic_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activity_id`, `activity_date_time`, `activity_venue`, `activity_status`, `activity_description`, `activity_details_id`, `topic_id`) VALUES
(1, 1515640639, 't501', 1, 'This will be our first quiz for the first semester, be prepared!', 1, 1),
(2, 1515727219, 'f605', 1, 'First lecture of this semester, be sure to pack all your things and leave nothing behind! We''re going to have an adventure!', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `activity_details`
--

CREATE TABLE `activity_details` (
  `activity_details_id` tinyint(4) NOT NULL,
  `activity_details_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_details`
--

INSERT INTO `activity_details` (`activity_details_id`, `activity_details_name`) VALUES
(1, 'Quiz'),
(2, 'Lecture');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) NOT NULL,
  `firstname` varchar(225) NOT NULL,
  `middlename` varchar(225) NOT NULL,
  `lastname` varchar(225) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `middlename`, `lastname`, `username`, `password`) VALUES
(1, 'Ange', 'Ecu', 'Gana', 'admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` bigint(20) NOT NULL,
  `announcement_title` varchar(100) NOT NULL,
  `announcement_content` varchar(800) NOT NULL,
  `announcement_created_at` decimal(20,0) NOT NULL,
  `announcement_edited_at` decimal(20,0) NOT NULL,
  `announcement_is_active` decimal(20,0) NOT NULL,
  `announcement_audience` tinyint(4) NOT NULL,
  `announcement_announcer` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `announcement_title`, `announcement_content`, `announcement_created_at`, `announcement_edited_at`, `announcement_is_active`, `announcement_audience`, `announcement_announcer`) VALUES
(1, 'This is an announcement', 'Et nulla magna dolore aute duis dolore ex ex sit ullamco consequat non in id id laborum duis ea aute dolor incididunt do labore nisi anim sed nisi dolor dolore labore ea dolor in incididunt aute esse enim sunt esse sit in laborum aute consequat esse velit consequat cupidatat id voluptate dolor excepteur incididunt anim reprehenderit cillum dolore consequat aute sunt esse minim in excepteur ut culpa pariatur nulla culpa excepteur nisi ut aute aute nulla ad deserunt excepteur amet ex eu ea do enim amet deserunt aliqua pariatur veniam adipisicing ullamco incididunt amet consectetur do amet esse pariatur mollit in qui veniam ex dolore eu id dolore sunt in in aute veniam eiusmod in exercitation mollit fugiat duis minim incididunt commodo veniam sint sit amet anim veniam pariatur ad sunt quis re', '1515589773', '1515608151', '1', 1, 'Ange Gana');

-- --------------------------------------------------------

--
-- Table structure for table `choice`
--

CREATE TABLE `choice` (
  `choice_id` bigint(20) NOT NULL,
  `choice_content` varchar(100) NOT NULL,
  `choice_is_correct` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` bigint(20) NOT NULL,
  `comment_content` varchar(1000) NOT NULL,
  `comment_user_id` bigint(20) NOT NULL,
  `courseware_question_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courseware_file`
--

CREATE TABLE `courseware_file` (
  `courseware_file_id` bigint(20) NOT NULL,
  `courseware_file_path` varchar(100) NOT NULL,
  `topic_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courseware_question`
--

CREATE TABLE `courseware_question` (
  `courseware_question_id` bigint(20) NOT NULL,
  `courseware_question` varchar(500) NOT NULL,
  `courseware_question_reference` varchar(500) DEFAULT NULL,
  `topic_id` bigint(20) NOT NULL,
  `choice_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollment_id` bigint(20) NOT NULL,
  `enrollment_sy` varchar(10) NOT NULL,
  `enrollment_term` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enrollment_id`, `enrollment_sy`, `enrollment_term`) VALUES
(1, '17-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lecturer_id` bigint(20) NOT NULL,
  `lecturer_firstname` varchar(30) NOT NULL,
  `lecturer_midname` varchar(30) NOT NULL,
  `lecturer_lastname` varchar(30) NOT NULL,
  `lecturer_expertise` varchar(200) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `lecturer_email` varchar(30) NOT NULL,
  `lecturer_status` tinyint(4) NOT NULL,
  `lecturer_offering_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lecturer_id`, `lecturer_firstname`, `lecturer_midname`, `lecturer_lastname`, `lecturer_expertise`, `username`, `password`, `lecturer_email`, `lecturer_status`, `lecturer_offering_id`) VALUES
(1, 'mark', 'gatan', 'babaran', 'Trigonometry', 'lecturer', '12345', 'mgta@gmail.com', 1, 1),
(2, 'nikki', 'sarmiento', 'maliwanag', 'general math, trigonometry, physics', 'lecturer2', '12345', 'nsmaliwanag@fit.edu.ph', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_attendance`
--

CREATE TABLE `lecturer_attendance` (
  `lecturer_attendance_id` bigint(20) NOT NULL,
  `lecturer_attendance_date` bigint(20) NOT NULL,
  `lecturer_attendance_in` bigint(20) DEFAULT NULL,
  `lecturer_attendance_out` bigint(20) DEFAULT NULL,
  `offering_id` bigint(20) NOT NULL,
  `lecturer_lecturer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturer_attendance`
--

INSERT INTO `lecturer_attendance` (`lecturer_attendance_id`, `lecturer_attendance_date`, `lecturer_attendance_in`, `lecturer_attendance_out`, `offering_id`, `lecturer_lecturer_id`) VALUES
(1, 1515455338, 1515455338, 1515476979, 1, 1),
(2, 1515479755, 1515479755, 1515503216, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_feedback`
--

CREATE TABLE `lecturer_feedback` (
  `lecturer_feedback_id` bigint(20) NOT NULL,
  `lecturer_feedback_time` bigint(20) NOT NULL,
  `lecturer_feedback_date` bigint(20) NOT NULL,
  `lecturer_feedback_comment` varchar(300) NOT NULL,
  `offering_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offering`
--

CREATE TABLE `offering` (
  `offering_id` bigint(20) NOT NULL,
  `offering_course_code` varchar(20) NOT NULL,
  `offering_course_title` varchar(225) NOT NULL,
  `offering_program` varchar(3) NOT NULL,
  `offering_section` varchar(10) NOT NULL,
  `offering_lecturer_id` bigint(20) NOT NULL,
  `enrollment_id` bigint(20) NOT NULL,
  `professor_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offering`
--

INSERT INTO `offering` (`offering_id`, `offering_course_code`, `offering_course_title`, `offering_program`, `offering_section`, `offering_lecturer_id`, `enrollment_id`, `professor_id`) VALUES
(1, 'Correl1', 'correl intro to solid mensuration', 'ECE', 'X31', 1, 1, 1),
(2, 'correl2', 'intro to physics', 'ce', 'f21', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `professor_id` bigint(20) NOT NULL,
  `professor_firstname` varchar(30) NOT NULL,
  `professor_midname` varchar(30) NOT NULL,
  `professor_lastname` varchar(30) NOT NULL,
  `professor_department` varchar(10) NOT NULL,
  `professor_email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`professor_id`, `professor_firstname`, `professor_midname`, `professor_lastname`, `professor_department`, `professor_email`, `username`, `password`) VALUES
(1, 'angelo', 'ecura', 'ganaden', 'ece', 'aeganaden@fit.edu.ph', 'professor', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` bigint(20) NOT NULL,
  `schedule_start_time` bigint(20) NOT NULL,
  `schedule_end_time` bigint(20) NOT NULL,
  `schedule_venue` varchar(10) NOT NULL,
  `offering_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `schedule_start_time`, `schedule_end_time`, `schedule_venue`, `offering_id`) VALUES
(1, 1515325531, 1515411939, 'TF07', 1),
(2, 1515629373, 1515640185, 't401', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` bigint(20) NOT NULL,
  `student_firstname` varchar(30) NOT NULL,
  `student_midname` varchar(30) NOT NULL,
  `student_lastname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `student_program` varchar(3) NOT NULL,
  `student_email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `enrollment_id` bigint(20) NOT NULL,
  `offering_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_firstname`, `student_midname`, `student_lastname`, `username`, `student_program`, `student_email`, `password`, `enrollment_id`, `offering_id`) VALUES
(201511024, 'Mannie', 'Ecura', 'Caguin', 'student2', 'ce', 'caguin@gmail.com', '12345', 1, 2),
(201512101, 'Angelo', 'Ecura', 'Ganaden', 'student', 'ece', 'aeganaden@fit.edu.ph', '12345', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `topic_id` bigint(20) NOT NULL,
  `topic_name` varchar(50) NOT NULL,
  `topic_description` varchar(500) NOT NULL,
  `topic_done` tinyint(4) DEFAULT NULL,
  `offering_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`topic_id`, `topic_name`, `topic_description`, `topic_done`, `offering_id`) VALUES
(1, 'Trigonometry', 'Introduction to trigonometry', 0, 1),
(2, 'Solid Mensuration', 'I don''t even know what are the topics that they''re tackling in here', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `activity_activity_details_fk` (`activity_details_id`),
  ADD KEY `activity_topic_fk` (`topic_id`);

--
-- Indexes for table `activity_details`
--
ALTER TABLE `activity_details`
  ADD PRIMARY KEY (`activity_details_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `choice`
--
ALTER TABLE `choice`
  ADD PRIMARY KEY (`choice_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_courseware_question_fk` (`courseware_question_id`);

--
-- Indexes for table `courseware_file`
--
ALTER TABLE `courseware_file`
  ADD PRIMARY KEY (`courseware_file_id`),
  ADD KEY `courseware_file_topic_fk` (`topic_id`);

--
-- Indexes for table `courseware_question`
--
ALTER TABLE `courseware_question`
  ADD PRIMARY KEY (`courseware_question_id`),
  ADD KEY `courseware_question_choice_fk` (`choice_id`),
  ADD KEY `courseware_question_topic_fk` (`topic_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollment_id`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecturer_id`);

--
-- Indexes for table `lecturer_attendance`
--
ALTER TABLE `lecturer_attendance`
  ADD PRIMARY KEY (`lecturer_attendance_id`),
  ADD KEY `lecturer_attendance_offering_fk` (`offering_id`);

--
-- Indexes for table `lecturer_feedback`
--
ALTER TABLE `lecturer_feedback`
  ADD PRIMARY KEY (`lecturer_feedback_id`),
  ADD KEY `lecturer_feedback_offering_fk` (`offering_id`),
  ADD KEY `lecturer_feedback_student_fk` (`student_id`);

--
-- Indexes for table `offering`
--
ALTER TABLE `offering`
  ADD PRIMARY KEY (`offering_id`),
  ADD KEY `offering_enrollment_fk` (`enrollment_id`),
  ADD KEY `offering_professor_fk` (`professor_id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`professor_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `schedule_offering_fk` (`offering_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_enrollment_fk` (`enrollment_id`),
  ADD KEY `student_offering_fk` (`offering_id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `topic_offering_fk` (`offering_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_activity_details_fk` FOREIGN KEY (`activity_details_id`) REFERENCES `activity_details` (`activity_details_id`),
  ADD CONSTRAINT `activity_topic_fk` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`topic_id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_courseware_question_fk` FOREIGN KEY (`courseware_question_id`) REFERENCES `courseware_question` (`courseware_question_id`);

--
-- Constraints for table `courseware_file`
--
ALTER TABLE `courseware_file`
  ADD CONSTRAINT `courseware_file_topic_fk` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`topic_id`);

--
-- Constraints for table `courseware_question`
--
ALTER TABLE `courseware_question`
  ADD CONSTRAINT `courseware_question_choice_fk` FOREIGN KEY (`choice_id`) REFERENCES `choice` (`choice_id`),
  ADD CONSTRAINT `courseware_question_topic_fk` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`topic_id`);

--
-- Constraints for table `lecturer_attendance`
--
ALTER TABLE `lecturer_attendance`
  ADD CONSTRAINT `lecturer_attendance_offering_fk` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`);

--
-- Constraints for table `lecturer_feedback`
--
ALTER TABLE `lecturer_feedback`
  ADD CONSTRAINT `lecturer_feedback_offering_fk` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`),
  ADD CONSTRAINT `lecturer_feedback_student_fk` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `offering`
--
ALTER TABLE `offering`
  ADD CONSTRAINT `offering_enrollment_fk` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollment` (`enrollment_id`),
  ADD CONSTRAINT `offering_professor_fk` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`professor_id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_offering_fk` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_enrollment_fk` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollment` (`enrollment_id`),
  ADD CONSTRAINT `student_offering_fk` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_offering_fk` FOREIGN KEY (`offering_id`) REFERENCES `offering` (`offering_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;