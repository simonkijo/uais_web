-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: fdb12.biz.nf
-- Generation Time: Oct 30, 2016 at 09:39 AM
-- Server version: 5.7.13-log
-- PHP Version: 5.5.38

--
-- Database: `1948040_uais`
--
CREATE DATABASE IF NOT EXISTS `1948040_uais` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `1948040_uais`;

-- --------------------------------------------------------

--
-- Table structure for table `academic_notes`
--

CREATE TABLE `academic_notes` (
  `notes_pk` varchar(12) NOT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `programme` varchar(16) DEFAULT NULL,
  `module` varchar(100) DEFAULT NULL,
  `content_notes` longtext,
  `time_` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assign_pk` varchar(12) NOT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `programme` varchar(16) DEFAULT NULL,
  `module` varchar(100) DEFAULT NULL,
  `content_notes` longtext,
  `sender` varchar(8) DEFAULT NULL,
  `time_` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `cs_pk` varchar(12) NOT NULL,
  `cs_name` varchar(100) DEFAULT NULL,
  `cs_duration` varchar(10) DEFAULT NULL,
  `programme` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `lec_md_title`
--

CREATE TABLE `lec_md_title` (
  `lec_pk` varchar(12) NOT NULL,
  `id_no` varchar(12) DEFAULT NULL,
  `module` varchar(100) DEFAULT NULL,
  `title` varchar(5) DEFAULT NULL,
  `cs` varchar(100) DEFAULT NULL,
  `programme` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `md_pk` varchar(12) NOT NULL,
  `cs` varchar(100) DEFAULT NULL,
  `year` varchar(11) DEFAULT NULL,
  `semester` varchar(15) DEFAULT NULL,
  `module` varchar(100) DEFAULT NULL,
  `programme` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `save_time`
--

CREATE TABLE `save_time` (
  `s_id` varchar(15) NOT NULL,
  `semester_time` varchar(8) DEFAULT NULL,
  `current_time_` varchar(100) DEFAULT NULL,
  `date_` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `sms_delete_time`
--

CREATE TABLE `sms_delete_time` (
  `s_id` varchar(15) NOT NULL,
  `sms_time` varchar(8) DEFAULT NULL,
  `current_time_` varchar(100) DEFAULT NULL,
  `date_` varchar(15) DEFAULT NULL,
  `session_id` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `st_role`
--

CREATE TABLE `st_role` (
  `st_pk` varchar(12) NOT NULL,
  `id_no` varchar(12) DEFAULT NULL,
  `cs` varchar(100) DEFAULT NULL,
  `programme` varchar(16) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `year` varchar(11) DEFAULT NULL,
  `semester` varchar(15) DEFAULT NULL,
  `date_` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_no` varchar(12) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `mname` varchar(45) DEFAULT NULL,
  `sname` varchar(45) DEFAULT NULL,
  `phone_no` varchar(13) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `academic_notes`
--
ALTER TABLE `academic_notes`
  ADD PRIMARY KEY (`notes_pk`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assign_pk`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cs_pk`);

--
-- Indexes for table `lec_md_title`
--
ALTER TABLE `lec_md_title`
  ADD PRIMARY KEY (`lec_pk`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`md_pk`);

--
-- Indexes for table `save_time`
--
ALTER TABLE `save_time`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `sms_delete_time`
--
ALTER TABLE `sms_delete_time`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `st_role`
--
ALTER TABLE `st_role`
  ADD PRIMARY KEY (`st_pk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_no`);