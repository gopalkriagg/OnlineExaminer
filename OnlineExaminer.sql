-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: OnlineExaminer
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.12.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `FACULTY`
--

DROP TABLE IF EXISTS `FACULTY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FACULTY` (
  `id` varchar(7) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FACULTY`
--

LOCK TABLES `FACULTY` WRITE;
/*!40000 ALTER TABLE `FACULTY` DISABLE KEYS */;
/*!40000 ALTER TABLE `FACULTY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `QUESTIONS`
--

DROP TABLE IF EXISTS `QUESTIONS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `QUESTIONS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descr` varchar(500) NOT NULL,
  `choiceA` varchar(100) NOT NULL,
  `choiceB` varchar(100) NOT NULL,
  `choiceC` varchar(100) DEFAULT NULL,
  `choiceD` varchar(100) DEFAULT NULL,
  `correctChoice` char(1) NOT NULL,
  `difficultyLevel` int(2) NOT NULL,
  `setBy` varchar(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ques_faculty_id` (`setBy`),
  CONSTRAINT `fk_ques_faculty_id` FOREIGN KEY (`setBy`) REFERENCES `FACULTY` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `QUESTIONS`
--

LOCK TABLES `QUESTIONS` WRITE;
/*!40000 ALTER TABLE `QUESTIONS` DISABLE KEYS */;
/*!40000 ALTER TABLE `QUESTIONS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `QUES_CONTAINED`
--

DROP TABLE IF EXISTS `QUES_CONTAINED`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `QUES_CONTAINED` (
  `testID` varchar(10) NOT NULL DEFAULT '',
  `quesID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`testID`,`quesID`),
  KEY `fk_qc_ques_id` (`quesID`),
  CONSTRAINT `fk_qc_tests_id` FOREIGN KEY (`testID`) REFERENCES `TESTS` (`id`),
  CONSTRAINT `fk_qc_ques_id` FOREIGN KEY (`quesID`) REFERENCES `QUESTIONS` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `QUES_CONTAINED`
--

LOCK TABLES `QUES_CONTAINED` WRITE;
/*!40000 ALTER TABLE `QUES_CONTAINED` DISABLE KEYS */;
/*!40000 ALTER TABLE `QUES_CONTAINED` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `STUDENTS`
--

DROP TABLE IF EXISTS `STUDENTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STUDENTS` (
  `id` varchar(7) NOT NULL DEFAULT '',
  `pwd` varchar(30) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `currentStatus` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `STUDENTS`
--

LOCK TABLES `STUDENTS` WRITE;
/*!40000 ALTER TABLE `STUDENTS` DISABLE KEYS */;
/*!40000 ALTER TABLE `STUDENTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `STU_RECORD`
--

DROP TABLE IF EXISTS `STU_RECORD`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STU_RECORD` (
  `stuID` varchar(7) NOT NULL DEFAULT '',
  `testID` varchar(10) NOT NULL DEFAULT '',
  `marks` int(4) NOT NULL,
  PRIMARY KEY (`stuID`,`testID`),
  KEY `fk_sr_tests_id` (`testID`),
  CONSTRAINT `fk_sr_stu_id` FOREIGN KEY (`stuID`) REFERENCES `STUDENTS` (`id`),
  CONSTRAINT `fk_sr_tests_id` FOREIGN KEY (`testID`) REFERENCES `TESTS` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `STU_RECORD`
--

LOCK TABLES `STU_RECORD` WRITE;
/*!40000 ALTER TABLE `STU_RECORD` DISABLE KEYS */;
/*!40000 ALTER TABLE `STU_RECORD` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TESTS`
--

DROP TABLE IF EXISTS `TESTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TESTS` (
  `id` varchar(10) NOT NULL,
  `given` char(1) NOT NULL DEFAULT 'N',
  `setBy` varchar(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tests_faculty_id` (`setBy`),
  CONSTRAINT `fk_tests_faculty_id` FOREIGN KEY (`setBy`) REFERENCES `FACULTY` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TESTS`
--

LOCK TABLES `TESTS` WRITE;
/*!40000 ALTER TABLE `TESTS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TESTS` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-10 22:51:04
