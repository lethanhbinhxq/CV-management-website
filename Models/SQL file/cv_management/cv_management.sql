-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2024 at 01:27 PM
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
-- Database: `cv_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `cv_id` int(11) NOT NULL,
  `province_id` char(2) NOT NULL,
  `district_id` char(3) NOT NULL,
  `commune_id` char(5) NOT NULL,
  `street_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `cv_id`, `province_id`, `district_id`, `commune_id`, `street_address`) VALUES
(1, 1, '79', '784', '27589', '28 Pham Van Sang'),
(2, 2, '01', '001', '00007', '123 Nguyen Chi Thanh'),
(3, 3, '79', '760', '26740', '20 Nguyen Hue'),
(4, 4, '48', '492', '20233', '10 Hoang Van Thu'),
(5, 5, '31', '304', '11350', '25 Lach Tray'),
(6, 6, '92', '916', '31150', '30 Nguyen Trai'),
(7, 7, '01', '005', '00166', '35 Tran Duy Hung'),
(8, 8, '79', '770', '27139', '12 Pasteur'),
(9, 9, '48', '493', '20278', '50 Vo Nguyen Giap'),
(10, 10, '31', '303', '11296', '5 Le Loi'),
(11, 11, '92', '918', '31180', '15 Nguyen Van Cu'),
(12, 12, '01', '002', '00079', '18 Ba Trieu'),
(13, 13, '79', '760', '26740', '102 Nguyen Hue'),
(16, 16, '48', '492', '20246', '32 Nguyen Van Linh'),
(17, 17, '01', '005', '00166', '45 Xuan Thuy'),
(18, 18, '79', '770', '27151', '12 Vo Van Tan'),
(19, 19, '01', '009', '00343', '80 Le Van Luong'),
(20, 20, '79', '767', '27019', '25/1 Le Sat');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `cv_id` int(11) NOT NULL,
  `certificate_title` varchar(255) NOT NULL,
  `field` varchar(255) NOT NULL,
  `issue_year` int(11) NOT NULL CHECK (`issue_year` >= 1970 and `issue_year` <= 2024),
  `issuing_organization` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `cv_id`, `certificate_title`, `field`, `issue_year`, `issuing_organization`) VALUES
(1, 1, 'IELTS', 'English', 2020, 'British Council'),
(2, 2, 'TOEIC', 'English', 2019, 'ETS'),
(3, 3, 'Data Science Professional Certificate', 'Data Science', 2022, 'Coursera'),
(4, 4, 'UI-UX Design Certificate', 'UI-UX Design', 2021, 'Google'),
(5, 5, 'Google Ads Certification', 'Marketing', 2020, 'Google'),
(6, 6, 'Certified Ethical Hacker', 'Information Security', 2021, 'EC-Council'),
(7, 7, 'AWS Certified Solutions Architect', 'Cloud Network', 2023, 'Amazon'),
(8, 8, 'TensorFlow Developer Certificate', 'Machine Learning', 2021, 'Google'),
(9, 9, 'Adobe Certified Professional', 'Graphic Design', 2019, 'Adobe'),
(10, 10, 'Google Analytics Certification', 'Data Analytics', 2020, 'Google'),
(11, 11, 'Cisco Certified Network Associate', 'Computer Networking', 2021, 'Cisco'),
(12, 12, 'Microsoft Certified - Azure Database Administrator', 'Database Management', 2022, 'Microsoft'),
(13, 13, 'Adobe Certified Professional', 'Graphic Design', 2021, 'Adobe'),
(16, 16, 'AWS Certified Developer', 'Software Development', 2021, 'AWS'),
(17, 17, 'Google Professional Data Engineer', 'Data Engineering', 2022, 'Google'),
(18, 18, 'Certified Information Systems Security Professional', 'Information Security', 2020, 'ISC'),
(19, 19, 'Tableau Desktop Specialist', 'Data Analysis', 2021, 'Tableau'),
(20, 20, 'IELTS', 'English', 2020, 'British Council'),
(21, 20, 'Deep Learning Specialization', 'Deep Learning', 2023, 'Coursera');

-- --------------------------------------------------------

--
-- Table structure for table `cvs`
--

CREATE TABLE `cvs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `gender` char(1) NOT NULL,
  `objective` text NOT NULL,
  `visibility` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cvs`
--

INSERT INTO `cvs` (`id`, `user_id`, `full_name`, `email`, `job_title`, `gender`, `objective`, `visibility`) VALUES
(1, 1, 'Le Thanh Binh', 'binh.lethanh@hcmut.edu.vn', 'Web Developer', 'F', 'As a web developer, I aim to create user-friendly, responsive websites using HTML, CSS, JavaScript, and PHP. Focused on clean code and best practices, I strive to deliver seamless user experiences and high-performance web applications while continuously expanding my skills and tackling new challenges.', 'Public'),
(2, 7, 'Nguyen Van H', 'nguyen.vh@fpt.edu.vn', 'Software Engineer', 'M', 'As a software engineer, I enjoy creating scalable backend systems and APIs. Proficient in Python, Java, and Docker, I am passionate about optimizing processes and exploring cloud technologies.', 'Custom Us'),
(3, 3, 'Tran Thi C', 'tran.thic@example.com', 'Data Scientist', 'F', 'Passionate about turning data into actionable insights and delivering value through advanced analytics and machine learning.', 'Private'),
(4, 4, 'Vo Van D', 'vo.vand@example.com', 'UX Designer', 'M', 'Strive to design intuitive and user-friendly interfaces to enhance user satisfaction and product engagement.', 'Public'),
(5, 5, 'Hoang Thi E', 'hoang.thie@example.com', 'Marketing Specialist', 'F', 'Highly motivated marketing professional with a focus on strategic planning, digital campaigns, and audience engagement.', 'Custom Us'),
(6, 6, 'Ly Van G', 'ly.vang@example.com', 'Cybersecurity Analyst', 'M', 'Dedicated to securing IT infrastructure through innovative strategies and risk management.', 'Private'),
(7, 2, 'Nguyen Van A', 'nguyen.vana@company.com', 'Backend Developer', 'M', 'Focused on building robust backend systems, ensuring performance optimization, and integrating APIs effectively.', 'All Users'),
(8, 3, 'Tran Thi C', 'tran.thic@techhub.com', 'Machine Learning Engineer', 'F', 'Passionate about building machine learning models to solve real-world problems and enhance decision-making processes.', 'All Users'),
(9, 4, 'Vo Van D', 'vo.vand@designlab.com', 'Graphic Designer', 'M', 'Specialized in visual storytelling through creative designs, brand identity, and digital illustrations.', 'Public'),
(10, 5, 'Hoang Thi E', 'hoang.thie@marketinghub.com', 'SEO Specialist', 'F', 'Dedicated to improving website rankings, driving organic traffic, and analyzing SEO metrics for better results.', 'Private'),
(11, 6, 'Ly Van G', 'ly.vang@cybersafe.com', 'Network Engineer', 'M', 'Focused on designing, implementing, and maintaining secure and reliable network infrastructure.', 'All Users'),
(12, 2, 'Nguyen Van A', 'nguyen.vana@dataconsult.com', 'Database Administrator', 'M', 'Passionate about managing and optimizing large-scale databases to ensure data integrity and availability.', 'Private'),
(13, 3, 'Tran Thi C', 'tran.c@datadesign.vn', 'UI-UX Designer', 'F', 'Dedicated to crafting intuitive and visually appealing user interfaces and experiences for web and mobile applications.', 'All Users'),
(16, 4, 'Vo Van D', 'vo.d@algodev.com', 'Software Engineer', 'M', 'A passionate developer focused on building scalable and efficient backend systems.', 'Custom Us'),
(17, 5, 'Hoang Thi E', 'hoang.e@fintechhub.vn', 'Data Scientist', 'F', 'Leveraging data to uncover insights and drive decision-making in fintech applications.', 'Public'),
(18, 6, 'Ly Van G', 'ly.g@itsecure.vn', 'Cybersecurity Specialist', 'M', 'Focused on securing enterprise systems from cyber threats and ensuring data privacy.', 'Private'),
(19, 7, 'Pham Van H', 'pham.h@datavizpro.vn', 'Data Analyst', 'M', 'Transforming raw data into actionable insights for business decision-making.', 'Public'),
(20, 1, 'Le Thanh Binh', 'ltb@hcmut.edu.vn', 'Computer Vision Engineer', 'F', 'As a computer vision engineer, I am passionate about applying machine learning and AI algorithms to analyze and interpret visual data. My goal is to create systems that enable machines to understand the world in ways that are comparable to human vision. I am focused on delivering innovative solutions and tackling complex problems in areas such as image recognition, object detection, and video analysis.', 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `cv_id` int(11) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `start_month` int(11) NOT NULL CHECK (`start_month` >= 1 and `start_month` <= 12),
  `start_year` int(11) NOT NULL CHECK (`start_year` >= 1970 and `start_year` <= 2024),
  `end_month` int(11) NOT NULL CHECK (`end_month` >= 1 and `end_month` <= 12),
  `end_year` int(11) NOT NULL CHECK (`end_year` >= 1970 and `end_year` <= 2024)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `cv_id`, `degree`, `major`, `school`, `start_month`, `start_year`, `end_month`, `end_year`) VALUES
(1, 1, 'Bachelor', 'Computer Science', 'Ho Chi Minh City University of Technology', 9, 2021, 11, 2024),
(2, 2, 'Master\'s', 'Software Engineering', 'FPT University', 8, 2018, 7, 2020),
(3, 3, 'Bachelor', 'Statistics', 'University of Science - HCM', 9, 2017, 6, 2021),
(4, 4, 'Bachelor', 'Graphic Design', 'Danang University', 8, 2016, 6, 2020),
(5, 5, 'Bachelor', 'Marketing', 'Hanoi University of Business', 9, 2015, 6, 2019),
(6, 6, 'Bachelor', 'Information Security', 'Can Tho University', 8, 2017, 6, 2021),
(7, 7, 'Bachelor', 'Information Technology', 'Hanoi University of Science and Technology', 9, 2016, 6, 2020),
(8, 7, 'Master', 'Software Engineering', 'HUST', 8, 2021, 7, 2023),
(9, 8, 'Bachelor', 'Data Science', 'HCMUT', 9, 2016, 6, 2020),
(10, 9, 'Bachelor', 'Graphic Design', 'University of Arts', 9, 2014, 6, 2018),
(11, 10, 'Bachelor', 'Marketing', 'Foreign Trade University', 9, 2015, 6, 2019),
(12, 11, 'Bachelor', 'Network Engineering', 'Can Tho University', 8, 2016, 6, 2020),
(13, 12, 'Bachelor', 'Information Systems', 'HUST', 9, 2015, 6, 2019),
(14, 13, 'Bachelor', 'Graphic Design', 'RMIT University Vietnam', 7, 2016, 12, 2020),
(17, 16, 'Bachelor', 'Computer Science', 'University of Danang', 8, 2015, 6, 2019),
(18, 17, 'Master', 'Data Science', 'HUST', 9, 2017, 6, 2020),
(19, 18, 'Bachelor', 'Information Security', 'UIT', 8, 2014, 6, 2018),
(20, 19, 'Bachelor', 'Business Analytics', 'Foreign Trade University', 9, 2016, 6, 2020),
(21, 20, 'Bachelor', 'Computer Science', 'HCMUT', 9, 2021, 11, 2024);

-- --------------------------------------------------------

--
-- Table structure for table `other_information`
--

CREATE TABLE `other_information` (
  `id` int(11) NOT NULL,
  `cv_id` int(11) NOT NULL,
  `other_title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `other_information`
--

INSERT INTO `other_information` (`id`, `cv_id`, `other_title`, `description`) VALUES
(1, 1, 'Interests', 'Artificial Intelligence'),
(2, 2, 'Achievements', 'Winner of Hackathon 2020'),
(3, 3, 'Interests', 'Deep Learning'),
(4, 4, 'Interests', 'Human-Centered Design'),
(5, 5, 'Interests', 'Brand Management'),
(6, 6, 'Interests', 'Cyber Forensics'),
(7, 7, 'Interests', 'Cloud Computing'),
(8, 8, 'Interests', 'Natural Language Processing'),
(9, 9, 'Interests', 'Photography'),
(10, 10, 'Interests', 'Web Analytics'),
(11, 11, 'Interests', 'Network Security'),
(12, 12, 'Interests', 'Big Data'),
(13, 13, 'Interests', 'Design Thinking'),
(16, 16, 'Interests', 'Cloud Computing'),
(17, 17, 'Interests', 'Artificial Intelligence'),
(18, 18, 'Interests', 'Ethical Hacking'),
(19, 19, 'Interests', 'Data Visualization'),
(20, 20, 'Interests', 'Artificial Intelligence, Image Recognition, Autonomous Vehicles');

-- --------------------------------------------------------

--
-- Table structure for table `phone_numbers`
--

CREATE TABLE `phone_numbers` (
  `id` int(11) NOT NULL,
  `cv_id` int(11) NOT NULL,
  `phone_number` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phone_numbers`
--

INSERT INTO `phone_numbers` (`id`, `cv_id`, `phone_number`) VALUES
(1, 1, '0886085576'),
(2, 1, '0942998140'),
(3, 2, '0901234567'),
(4, 2, '0901234576'),
(5, 3, '0909876543'),
(6, 4, '0934567890'),
(7, 5, '0945678912'),
(8, 6, '0956789123'),
(9, 6, '0956789321'),
(10, 6, '0956789213'),
(11, 7, '0908123456'),
(12, 8, '0912345678'),
(13, 9, '0932123456'),
(14, 10, '0938123456'),
(15, 11, '0949123456'),
(16, 12, '0937123456'),
(17, 12, '0933123456'),
(18, 13, '0918234567'),
(21, 16, '0927345678'),
(22, 17, '0968456789'),
(23, 18, '0989567890'),
(24, 19, '0910678901'),
(25, 20, '0886085577');

-- --------------------------------------------------------

--
-- Table structure for table `professional_experience`
--

CREATE TABLE `professional_experience` (
  `id` int(11) NOT NULL,
  `cv_id` int(11) NOT NULL,
  `skill` varchar(255) NOT NULL,
  `years_of_experience` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professional_experience`
--

INSERT INTO `professional_experience` (`id`, `cv_id`, `skill`, `years_of_experience`) VALUES
(1, 1, 'HTML', 2),
(2, 1, 'JavaScript', 2),
(3, 1, 'CSS', 2),
(4, 2, 'Python', 4),
(5, 2, 'Docker', 3),
(6, 2, 'Java', 3),
(7, 3, 'Python', 3),
(8, 3, 'R Programming', 3),
(9, 3, 'Machine Learning', 2),
(10, 4, 'Adobe XD', 3),
(11, 4, 'Figma', 4),
(12, 4, 'User Research', 2),
(13, 5, 'SEO', 5),
(14, 5, 'Social Media Marketing', 3),
(15, 5, 'Content Creation', 2),
(16, 6, 'Network Security', 5),
(17, 6, 'Penetration Testing', 4),
(18, 6, 'Threat Analysis', 4),
(19, 7, 'Java', 6),
(20, 7, 'Spring Boot', 2),
(21, 7, 'PostgreSQL', 5),
(22, 8, 'Python', 7),
(23, 8, 'TensorFlow', 6),
(24, 8, 'Pandas', 5),
(25, 9, 'Photoshop', 10),
(26, 9, 'Illustrator', 10),
(27, 9, 'Typography', 11),
(28, 10, 'SEO Optimization', 6),
(29, 10, 'Content Marketing', 7),
(30, 10, 'Google Analytics', 5),
(31, 11, 'Network Troubleshooting', 8),
(32, 11, 'Firewall Configuration', 6),
(33, 11, 'Cisco IOS', 5),
(34, 12, 'MySQL', 6),
(35, 12, 'Oracle', 6),
(36, 12, 'Database Optimization', 5),
(37, 13, 'Figma', 5),
(38, 13, 'Adobe XD', 5),
(39, 13, 'User Research', 4),
(44, 16, 'Java', 7),
(45, 17, 'Python', 6),
(46, 17, 'Machine Learning', 5),
(47, 17, 'Data Visualization', 4),
(48, 18, 'Network Security', 6),
(49, 18, 'Penetration Testing', 6),
(50, 18, 'Risk Assessment', 5),
(51, 19, 'Tableau', 5),
(52, 19, 'SQL', 5),
(53, 19, 'Excel', 7),
(54, 20, 'OpenCV', 2),
(55, 20, 'Python', 3),
(56, 20, 'Pytorch', 1),
(57, 20, 'Machine Learning', 2),
(58, 20, 'Image Processing', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `id` int(11) NOT NULL,
  `cv_id` int(11) NOT NULL,
  `referee_name` varchar(255) NOT NULL,
  `relationship` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `workplace` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reference`
--

INSERT INTO `reference` (`id`, `cv_id`, `referee_name`, `relationship`, `position`, `workplace`, `phone_number`, `email`) VALUES
(1, 1, 'Pro. Nguyen Van A', 'Academic advisor', 'Head of Faculty', 'HCMUT', '0123456789', 'nva@abc.com'),
(2, 2, 'Tran Thi B', 'Manager', 'Project Leader', 'VNG', '0987654321', 'ttb@xyz.com'),
(3, 3, 'Dr. Nguyen Thi D', 'Mentor', 'Chief Data Officer', 'BigData Analytics', '0912345678', 'ntd@example.com'),
(4, 4, 'Pro. Le Van E', 'Professor', 'Head of Design', 'Danang University', '0938765432', 'lve@example.com'),
(5, 5, 'Ms. Pham Thi F', 'Manager', 'Marketing Director', 'AdVision Ltd.', '0987654321', 'ptf@example.com'),
(6, 6, 'Pro. Do Van H', 'Mentor', 'Cybersecurity Expert', 'Can Tho University', '0976543210', 'dvh@example.com'),
(7, 7, 'Dr. Pham Van I', 'Advisor', 'Software Architect', 'TechBridge Co.', '0989123456', 'pvi@example.com'),
(8, 8, 'Dr. Vu Thi J', 'Mentor', 'Senior Data Scientist', 'AIPro Solutions', '0918765432', 'vtj@example.com'),
(9, 9, 'Ms. Le Thi K', 'Manager', 'Creative Director', 'Brandify Studio', '0945123456', 'ltk@example.com'),
(10, 10, 'Mr. Tran Van L', 'Manager', 'SEO Manager', 'MarketReach', '0932123456', 'tvl@example.com'),
(11, 11, 'Dr. Do Thi M', 'Mentor', 'Network Specialist', 'SafeLink Corp.', '0956123456', 'dtm@example.com'),
(12, 12, 'Mr. Pham Van N', 'Supervisor', 'Head of Database Operations', 'DataConsult Group', '0948123456', 'pvn@example.com'),
(13, 13, 'Ms. Le Thi H', 'Manager', 'Lead Designer', 'DataDesign.vn', '0988234567', 'lethih@datadesign.vn'),
(16, 16, 'Mr. Nguyen Minh K', 'Senior Engineer', 'Technical Lead', 'AlgoDev Co', '0939345678', 'nguyenmk@algodev.com'),
(17, 17, 'Dr. Pham Minh L', 'Advisor', 'Head of AI Research', 'HUST', '0987456789', 'phamml@hust.edu.vn'),
(18, 18, 'Ms. Tran Thanh M', 'Supervisor', 'Chief Information Security Officer', 'ITSecure.vn', '0909567890', 'ttm@itsecure.vn'),
(19, 19, 'Mr. Le Trung T', 'Mentor', 'Senior Data Analyst', 'DataVizPro', '0911678901', 'lettr@datavizpro.vn'),
(20, 20, 'Nguyen Minh L', 'Former colleague', 'Senior Data Scientist', 'TechVision Corp.', '0912345678', 'nguyenminhl@techvision.com'),
(21, 20, 'Le Thi H', 'Academic advisor', 'Head of AI Department', 'Smart Robotics Solutions', '0908765432', 'lethi.h@smartrobotics.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `username`, `password`) VALUES
(1, 'Le Thanh Binh', 'binh.lethanh@hcmut.edu.vn', 'ltb', '$2y$10$TCWbWNk0lPlZBRbTMmTKCuOJzb.xR4HA8ypApHO9FLmZfdSsrFp3O'),
(2, 'Nguyen Van A', 'nva@email.con', 'nva', '$2y$10$qIraQfNzYQDplbC3hNH0H.h8Wb0lPLv8/lzXdcMbXUuEM4aTB1fgm'),
(3, 'Tran Thi C', 'ttc@email.com', 'ttc', '$2y$10$TCWbWNk0lPlZBRbTMmTKCuOJzb.xR4HA8ypApHO9FLmZfdSsrFp3O'),
(4, 'Vo Van D', 'vvd@email.com', 'vvd', '$2y$10$s7ubDw8kgh8/IoAFucrE2e.mMNoEzdLsnSECJ3FK99q.uWKpCnqHa'),
(5, 'Hoang Thi E', 'hte@email.com', 'hte', '$2y$10$MyXCQ/BGk.DUrxhDAk7pE.bcTTC2IGxe1VvyYi8a.LXF9Ti6Scbiu'),
(6, 'Ly Van G', 'lvg@email.com', 'lvg', '$2y$10$bezEMMbpM7xcZqPKy4tgdOIUvqgU7jNuFOD94guo9s6sXGhCNYZiW'),
(7, 'Nguyen Van H', 'nguyen.vh@fpt.edu.vn', 'nvh', '$2y$10$hLkvIhASDHTWU48tTWsIZOnzQHbeckpwPfLhDrEfEDN.ReSGcHqtG');

-- --------------------------------------------------------

--
-- Table structure for table `viewers`
--

CREATE TABLE `viewers` (
  `id` int(11) NOT NULL,
  `cv_id` int(11) NOT NULL,
  `viewer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `viewers`
--

INSERT INTO `viewers` (`id`, `cv_id`, `viewer_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 5, 1),
(6, 5, 2),
(7, 5, 3),
(8, 5, 4),
(9, 5, 5),
(10, 5, 6),
(11, 5, 7),
(12, 16, 1),
(13, 16, 3),
(14, 16, 5);

-- --------------------------------------------------------

--
-- Table structure for table `work_history`
--

CREATE TABLE `work_history` (
  `id` int(11) NOT NULL,
  `cv_id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `start_month` int(11) NOT NULL CHECK (`start_month` >= 1 and `start_month` <= 12),
  `start_year` int(11) NOT NULL CHECK (`start_year` >= 1970 and `start_year` <= 2024),
  `end_month` int(11) NOT NULL CHECK (`end_month` >= 1 and `end_month` <= 12),
  `end_year` int(11) NOT NULL CHECK (`end_year` >= 1970 and `end_year` <= 2024)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_history`
--

INSERT INTO `work_history` (`id`, `cv_id`, `company`, `position`, `start_month`, `start_year`, `end_month`, `end_year`) VALUES
(1, 1, 'Cube System Co. Ltd', 'Web Developer', 6, 2024, 8, 2024),
(2, 2, 'VNG Corporation', 'Backend Developer', 3, 2021, 7, 2023),
(3, 3, 'DataTech Corp', 'Junior Data Scientist', 8, 2021, 12, 2023),
(4, 3, 'BigData Analytics', 'Data Scientist', 1, 2024, 12, 2024),
(5, 4, 'DesignCo Studio', 'UX Designer', 7, 2020, 3, 2023),
(6, 4, 'Creative Minds Ltd', 'Senior UX Designer', 4, 2023, 12, 2024),
(7, 5, 'GreenLeaf Agency', 'Marketing Intern', 7, 2019, 9, 2019),
(8, 5, 'AdVision Ltd', 'Marketing Specialist', 1, 2020, 12, 2024),
(9, 6, 'SecureIT Co', 'Cybersecurity Intern', 7, 2021, 12, 2021),
(10, 6, 'CyberProtect Solutions', 'Cybersecurity Analyst', 1, 2022, 12, 2024),
(11, 7, 'TechBridge Co', 'Junior Backend Developer', 8, 2020, 2, 2022),
(12, 7, 'DataNet Solutions', 'Backend Developer', 3, 2022, 12, 2024),
(13, 8, 'InsightAI', 'Machine Learning Intern', 7, 2020, 12, 2020),
(14, 8, 'AIPro Solutions', 'Machine Learning Engineer', 1, 2021, 12, 2024),
(15, 9, 'Brandify Studio', 'Senior Graphic Designer', 2, 2021, 12, 2024),
(16, 10, 'DigitalBoost Agency', 'SEO Intern', 7, 2019, 12, 2019),
(17, 10, 'MarketReach', 'SEO Specialist', 1, 2020, 12, 2024),
(18, 11, 'NetSecure Ltd', 'Network Support Intern', 7, 2020, 12, 2020),
(19, 11, 'SafeLink Corp', 'Network Engineer', 1, 2021, 12, 2024),
(20, 12, 'DataSolutions Ltd', 'Database Administrator Intern', 8, 2019, 2, 2020),
(21, 12, 'DataConsult Group', 'Database Administrator', 3, 2020, 12, 2024),
(22, 13, 'PixelWorks Studio', 'UI-UX Design Intern', 1, 2021, 6, 2021),
(23, 13, 'DataDesign.vn', 'UI-UX Designer', 7, 2021, 12, 2024),
(27, 16, 'TechSolutions Inc', 'Backend Developer', 8, 2019, 12, 2022),
(28, 17, 'FinTechHub', 'Data Scientist', 7, 2020, 12, 2024),
(29, 18, 'ITSecure.vn', 'Cybersecurity Analyst', 8, 2018, 12, 2021),
(30, 18, 'ITSecure.vn', 'Cybersecurity Specialist', 1, 2022, 12, 2024),
(31, 19, 'BizInsights Co', 'Data Analyst Intern', 10, 2020, 12, 2020),
(32, 19, 'DataVizPro', 'Data Analyst', 1, 2021, 12, 2024),
(33, 20, 'AI Innovations Inc', 'Computer Vision Engineer', 1, 2024, 12, 2024);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cv_id` (`cv_id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cv_id` (`cv_id`);

--
-- Indexes for table `cvs`
--
ALTER TABLE `cvs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cv_id` (`cv_id`);

--
-- Indexes for table `other_information`
--
ALTER TABLE `other_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cv_id` (`cv_id`);

--
-- Indexes for table `phone_numbers`
--
ALTER TABLE `phone_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cv_id` (`cv_id`);

--
-- Indexes for table `professional_experience`
--
ALTER TABLE `professional_experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cv_id` (`cv_id`);

--
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cv_id` (`cv_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `viewers`
--
ALTER TABLE `viewers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cv_id` (`cv_id`),
  ADD KEY `viewer_id` (`viewer_id`);

--
-- Indexes for table `work_history`
--
ALTER TABLE `work_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cv_id` (`cv_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cvs`
--
ALTER TABLE `cvs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `other_information`
--
ALTER TABLE `other_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `phone_numbers`
--
ALTER TABLE `phone_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `professional_experience`
--
ALTER TABLE `professional_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `viewers`
--
ALTER TABLE `viewers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `work_history`
--
ALTER TABLE `work_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cvs` (`id`);

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cvs` (`id`);

--
-- Constraints for table `cvs`
--
ALTER TABLE `cvs`
  ADD CONSTRAINT `cvs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cvs` (`id`);

--
-- Constraints for table `other_information`
--
ALTER TABLE `other_information`
  ADD CONSTRAINT `other_information_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cvs` (`id`);

--
-- Constraints for table `phone_numbers`
--
ALTER TABLE `phone_numbers`
  ADD CONSTRAINT `phone_numbers_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cvs` (`id`);

--
-- Constraints for table `professional_experience`
--
ALTER TABLE `professional_experience`
  ADD CONSTRAINT `professional_experience_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cvs` (`id`);

--
-- Constraints for table `reference`
--
ALTER TABLE `reference`
  ADD CONSTRAINT `reference_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cvs` (`id`);

--
-- Constraints for table `viewers`
--
ALTER TABLE `viewers`
  ADD CONSTRAINT `viewers_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cvs` (`id`),
  ADD CONSTRAINT `viewers_ibfk_2` FOREIGN KEY (`viewer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `work_history`
--
ALTER TABLE `work_history`
  ADD CONSTRAINT `work_history_ibfk_1` FOREIGN KEY (`cv_id`) REFERENCES `cvs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
