-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 20, 2021 at 02:18 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mealplan`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `searchCalories`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `searchCalories` (IN `recipename` VARCHAR(50))  NO SQL
select DISTINCT recipe.calorie from recipe join instructions join ingredients join recIngredient on recipe.recID=instructions.recID and recipe.reciD=recIngredient.recID and ingredients.ingriD=recIngredient.ingredientID where recipe.recName=recipename$$

DROP PROCEDURE IF EXISTS `searchDate`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `searchDate` (IN `recipename` VARCHAR(50))  NO SQL
select DISTINCT recipe.recDate from recipe join instructions join ingredients join recIngredient on recipe.recID=instructions.recID and recipe.reciD=recIngredient.recID and ingredients.ingriD=recIngredient.ingredientID where recipe.recName=recipename$$

DROP PROCEDURE IF EXISTS `searchIngredient`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `searchIngredient` (IN `recipename` VARCHAR(50))  NO SQL
select DISTINCT ingredients.ingrName, recIngredient.measurement from recipe join instructions join ingredients join recIngredient on recipe.recID=instructions.recID and recipe.reciD=recIngredient.recID and ingredients.ingriD=recIngredient.ingredientID where recipe.recName=recipename$$

DROP PROCEDURE IF EXISTS `searchInstruction`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `searchInstruction` (IN `recipename` VARCHAR(50))  NO SQL
select DISTINCT instructions.instructID, instructions.direction from recipe join instructions join ingredients join recIngredient on recipe.recID=instructions.recID and recipe.reciD=recIngredient.recID and ingredients.ingriD=recIngredient.ingredientID where recipe.recName=recipename order by instructions.instructID$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `uName` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`uName`),
  UNIQUE KEY `uName` (`uName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bimages`
--

DROP TABLE IF EXISTS `bimages`;
CREATE TABLE IF NOT EXISTS `bimages` (
  `mealID` int(11) NOT NULL,
  `uName` varchar(30) NOT NULL,
  `images` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`mealID`,`uName`),
  KEY `uName` (`uName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `breakfast`
--

DROP TABLE IF EXISTS `breakfast`;
CREATE TABLE IF NOT EXISTS `breakfast` (
  `mealID` int(11) NOT NULL AUTO_INCREMENT,
  `recID` int(11) NOT NULL,
  `servings` int(11) NOT NULL,
  `calories` varchar(50) NOT NULL,
  `uName` varchar(30) NOT NULL,
  PRIMARY KEY (`mealID`,`uName`),
  KEY `recID` (`recID`),
  KEY `uName` (`uName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dimages`
--

DROP TABLE IF EXISTS `dimages`;
CREATE TABLE IF NOT EXISTS `dimages` (
  `mealID` int(11) NOT NULL,
  `uName` varchar(30) NOT NULL,
  `images` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`mealID`,`uName`),
  KEY `uName` (`uName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dinner`
--

DROP TABLE IF EXISTS `dinner`;
CREATE TABLE IF NOT EXISTS `dinner` (
  `mealID` int(11) NOT NULL AUTO_INCREMENT,
  `recID` int(11) NOT NULL,
  `servings` int(11) NOT NULL,
  `calories` varchar(50) NOT NULL,
  `uName` varchar(30) NOT NULL,
  PRIMARY KEY (`mealID`,`uName`),
  KEY `recID` (`recID`),
  KEY `uName` (`uName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `ingrID` int(11) NOT NULL AUTO_INCREMENT,
  `ingrName` varchar(15) NOT NULL,
  PRIMARY KEY (`ingrID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

DROP TABLE IF EXISTS `instructions`;
CREATE TABLE IF NOT EXISTS `instructions` (
  `recID` int(11) NOT NULL,
  `instructID` int(11) NOT NULL,
  `direction` varchar(50) NOT NULL,
  PRIMARY KEY (`recID`,`instructID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kitchen`
--

DROP TABLE IF EXISTS `kitchen`;
CREATE TABLE IF NOT EXISTS `kitchen` (
  `uName` varchar(30) NOT NULL,
  `ingredID` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` varchar(15) NOT NULL,
  `ingredName` varchar(15) NOT NULL,
  PRIMARY KEY (`ingredID`,`uName`) USING BTREE,
  KEY `uName` (`uName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `limages`
--

DROP TABLE IF EXISTS `limages`;
CREATE TABLE IF NOT EXISTS `limages` (
  `mealID` int(11) NOT NULL,
  `uName` varchar(30) NOT NULL,
  `images` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`mealID`,`uName`),
  KEY `uName` (`uName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lunch`
--

DROP TABLE IF EXISTS `lunch`;
CREATE TABLE IF NOT EXISTS `lunch` (
  `mealID` int(11) NOT NULL AUTO_INCREMENT,
  `recID` int(11) NOT NULL,
  `servings` int(11) NOT NULL,
  `calories` varchar(50) NOT NULL,
  `uName` varchar(30) NOT NULL,
  PRIMARY KEY (`mealID`,`uName`),
  KEY `recID` (`recID`),
  KEY `uName` (`uName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

DROP TABLE IF EXISTS `meals`;
CREATE TABLE IF NOT EXISTS `meals` (
  `mealID` int(11) NOT NULL AUTO_INCREMENT,
  `totalCal` int(11) NOT NULL,
  `uName` varchar(30) NOT NULL,
  PRIMARY KEY (`mealID`,`uName`),
  KEY `uName` (`uName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `measurement`
--

DROP TABLE IF EXISTS `measurement`;
CREATE TABLE IF NOT EXISTS `measurement` (
  `measureID` int(11) NOT NULL AUTO_INCREMENT,
  `measure` varchar(15) NOT NULL,
  PRIMARY KEY (`measureID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recingredient`
--

DROP TABLE IF EXISTS `recingredient`;
CREATE TABLE IF NOT EXISTS `recingredient` (
  `recID` int(11) NOT NULL,
  `ingredientID` int(11) NOT NULL,
  `measurement` varchar(15) NOT NULL,
  PRIMARY KEY (`recID`,`ingredientID`),
  KEY `ingredientID` (`ingredientID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
  `recID` int(11) NOT NULL AUTO_INCREMENT,
  `recDate` date NOT NULL,
  `recName` varchar(30) NOT NULL,
  `calorie` int(11) NOT NULL,
  PRIMARY KEY (`recID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
