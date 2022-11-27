-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 07, 2022 at 09:00 PM
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
-- Database: `iqraa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `password`) VALUES
(123, 'Hashem', 'Altabbaa', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_first_name` varchar(50) DEFAULT NULL,
  `author_last_name` varchar(50) DEFAULT NULL,
  `about_author` text NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_first_name`, `author_last_name`, `about_author`) VALUES
(1, 'John', 'Koeing', 'John Koenig is a video maker, voice actor, graphic designer, and writer. Born in Idaho and raised in Geneva, Switzerland, he created The Dictionary of Obscure Sorrows in 2009, first as a blog at DictionaryofObscureSorrows.com before expanding the project to YouTube. He lives in Minneapolis with his wife and daughter.'),
(2, 'Guinness', 'World Records', 'Casandra Brene Brown is an American research professor, lecturer, author, and podcast host. Brown is known in particular for her research on shame, vulnerability, and leadership. A long-time researcher and academic, Brown became famous following a widely-viewed TED talk in 2010.'),
(3, 'Brene', 'Brown', 'Casandra Brene Brown is an American research professor, lecturer, author, and podcast host. Brown is known in particular for her research on shame, vulnerability, and leadership. A long-time researcher and academic, Brown became famous following a widely-viewed TED talk in 2010.'),
(4, 'James', 'Clear', 'James Clear is an American author or journalist who is best known for his book Atomic Habits. By profession, James is an author of the New York Times. He has written many books in which Atomic Habits was the best-selling book that sold more than 5 million of its copies worldwide.'),
(5, 'Colleen', 'Hoover', 'Colleen Hoover is an author of young adult fiction and romance novels. She published her first novel, Slammed, in January 2012. In December 2012, she published Hopeless, which rose to the top of the New York Times best seller list.'),
(6, 'James', 'Patterson', 'jamespatterson.com\r\nJames Brendan Patterson is an American author and philanthropist. Among his works are the Alex Cross, Michael Bennett, Women\'s Murder Club, Maximum Ride, Daniel X, NYPD Red, Witch and Wizard, and Private series, as well as many stand-alone thrillers, non-fiction, and romance novels.');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `image` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  PRIMARY KEY (`book_id`),
  KEY `FK1_book` (`category_id`),
  KEY `FK2_book` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `name`, `category_id`, `author_id`, `image`, `description`) VALUES
(1, 'Angela Davis', 7, 1, 'images/booksImages/1.jpg', 'A powerful and commanding account of the life of trailblazing political activist Angela DavisEdited by Toni Morrison and first published in 1974, An Autobiography is a classic of the Black Liberation era which resonates just as powerfully today.'),
(2, 'Guinness World Records 2022', 1, 2, 'images/booksImages/3.jpg', 'Fully revised and updated, and with a bright new design, Guinness World Records 2022 provides a fascinating snapshot of our world today.'),
(3, 'Atlas of Heart', 7, 3, 'images/booksImages/2.jpg', 'Atlas of the Heart is a 2021 non-fiction book written by Brene Brown. The book describes human emotions and experiences and the language used to understand them. It is a USA Today bestseller and developed into an eight episode series for HBO Max.'),
(4, 'It Ends With Us', 1, 3, 'images/booksImages/5.jpg', 'In this brave and heartbreaking novel that digs its claws into you and does not let go, long after you have finished it (Anna Todd, New York Times bestselling author) from the #1 New York Times '),
(5, 'Atomic Habits', 4, 5, 'images/booksImages/4.jpg', 'Google users\r\nThe #1 New York Times bestseller. Over 3 million copies sold!Tiny Changes, Remarkable ResultsNo matter your goals, Atomic Habits offers a proven framework for improving--every day.'),
(6, 'Katt Loves Dogg', 3, 6, 'images/booksImages/6.jpg', 'In this funny and paw-some story, lifelong rivals Molly and Oscar are forced to team up and brave the great outdoors and help their families before it’s too late. Wilderness adventurers and expert trackers Molly the katt and Oscar the dogg go camping with their'),
(7, 'Will', 1, 6, 'images/booksImages/7.jpg', 'Google users The #1 New York Times bestseller. Over 3 million copies sold!Tiny Changes, Remarkable ResultsNo matter your goals, Atomic Habits offers a proven framework for improving--every day.'),
(8, 'Things We Never Got Over', 5, 1, 'images/booksImages/8.jpg', 'In this brave and heartbreaking novel that digs its claws into you and does not let go, long after you have finished it (Anna Todd, New York Times bestselling author) from the #1 New York Times In this brave and heartbreaking novel that digs its claws into you and does not let go, long after you have finished it (Anna Todd, New York Times bestselling author) from the #1 New York Times '),
(9, 'Great Reset', 2, 1, 'images/booksImages/9.jpg', 'In this brave and heartbreaking novel that digs its claws into you and does not let go, long after you have finished it (Anna Todd, New York Times bestselling author) from the #1 New York Times In this brave and '),
(10, 'Sold on a Monday', 2, 4, 'images/booksImages/10.jpg', 'zIn this brave and heartbreaking novel that digs its claws into you and does not let go, long after you have finished it (Anna Todd, New York Times bestselling author) from the #1 New York Times In this brave and '),
(11, 'The Raven Spell', 3, 1, 'images/booksImages/11.jpg', 'Atlas of the Heart is a 2021 non-fiction book written by Brene Brown. The book describes human emotions and experiences and the language used to understand them. It is a USA Today bestseller and developed into an eight episode series for HBO Max.Atlas of '),
(12, 'The Lincoln Highway', 2, 1, 'images/booksImages/12.jpg', 'Atlas of the Heart is a 2021 non-fiction book written by Brene Brown. The book describes human emotions and experiences and the language used to understand them. It is a USA Today bestseller and developed into an eight episode series for HBO Max.'),
(13, 'Harry Potter', 3, 1, 'images/booksImages/13.jpg', 'Atlas of the Heart is a 2021 non-fiction book written by Brene Brown. The book describes human emotions and experiences and the language used to understand them. It is a USA Today bestseller and developed into an eight episode series for HBO Max.'),
(14, 'Deep Sleep', 7, 6, 'images/booksImages/13.jpg', 'Atlas of the Heart is a 2021 non-fiction book written by Brene Brown. The book describes human emotions and experiences and the language used to understand them. It is a USA Today bestseller and developed into an eight episode series for HBO Max.'),
(15, 'Deep Sleep', 4, 5, 'images/booksImages/14.jpg', 'zIn this brave and heartbreaking novel that digs its claws into you and does not let go, long after you have finished it (Anna Todd, New York Times bestselling author) from the #1 New York Times In this brave and heartbreaking novel that digs its claws into you and does not let go, long after you have finished it (Anna Todd, New York Times bestselling author) from the #1 New York Times '),
(16, 'Ugly Love', 6, 4, 'images/booksImages/15.jpg', 'In this brave and heartbreaking novel that digs its claws into you and does not let go, long after you have finished it (Anna Todd, New York Times bestselling author) from the #1 New York Times In this brave and heartbreaking novel that digs its claws into you and does not let go, long after you have finished it (Anna Todd, New York Times bestselling author) from the #1 New York Times '),
(17, 'If You Tell', 4, 3, 'images/booksImages/16.jpg', 'In this brave and heartbreaking novel that digs its claws into you and does not let go, long after you have finished it (Anna Todd, New York Times bestselling author) from the #1 New York Times In this brave and heartbreaking novel that digs its claws into you and does not let go, long after you have finished it (Anna Todd, New York Times bestselling author) from the #1 New York Times '),
(18, 'The Real Anthony Fauci', 5, 3, 'images/booksImages/17.jpg', 'In this brave and heartbreaking novel that digs its claws into you and does not let go, long after you have finished it (Anna Todd, New York Times bestselling author) from the #1 New York Times In this brave and heartbreaking novel that digs its claws into you and does not let go, long after you have finished it (Anna Todd, New York Times bestselling author) from the #1 New York Times ');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(1, 'Novels'),
(2, 'History'),
(3, 'For Children'),
(4, 'Scienctific'),
(5, 'Biography'),
(6, 'Humor & Games'),
(7, 'Poetry');

-- --------------------------------------------------------

--
-- Table structure for table `my_books`
--

DROP TABLE IF EXISTS `my_books`;
CREATE TABLE IF NOT EXISTS `my_books` (
  `book_id` int(11) NOT NULL,
  `refugee_id` int(11) NOT NULL,
  `days` int(50) NOT NULL DEFAULT '5',
  PRIMARY KEY (`book_id`,`refugee_id`) USING BTREE,
  KEY `customer_id` (`refugee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_books`
--

DROP TABLE IF EXISTS `new_books`;
CREATE TABLE IF NOT EXISTS `new_books` (
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_books`
--

INSERT INTO `new_books` (`book_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(10),
(12),
(14),
(15);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `refugee_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `days` int(11) NOT NULL,
  PRIMARY KEY (`refugee_id`,`book_id`,`order_date`),
  KEY `fk2` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`refugee_id`, `book_id`, `order_date`, `days`) VALUES
(123456789, 3, '2022-06-03', 12),
(123456789, 4, '2022-06-03', 6),
(123456789, 5, '2022-06-03', 8);

-- --------------------------------------------------------

--
-- Table structure for table `refugee`
--

DROP TABLE IF EXISTS `refugee`;
CREATE TABLE IF NOT EXISTS `refugee` (
  `refugee_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `refugee_camp` varchar(50) NOT NULL,
  `resident_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`refugee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1234567896 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `refugee`
--

INSERT INTO `refugee` (`refugee_id`, `first_name`, `last_name`, `phone_number`, `password`, `refugee_camp`, `resident_number`) VALUES
(13, 'Hashem', 'Tabbaa', '079845656', '12345678', 'Tla Al Ali', 16),
(14, 'Hashem', 'Tabbaa', '0797308555', '12345678', 'Tla Al Ali', 123),
(123, 'Ø·Ø¨Ø§Ø¹', 'Ù‡Ø§Ø´Ù…', '', '12345678', 'zaatri', NULL),
(1234, 'test', 'test', '', '12345678', 'Ù…Ø®ÙŠÙ… Ø§Ù„Ø²Ø¹ØªØ±ÙŠ', NULL),
(123456789, 'Hashem', 'Tabbaa', '079565849', '123123123', 'zaatri', 45),
(1234567892, 'Ahmad', 'Hasan', '', '123456789', 'zaatri', 123),
(1234567895, 'Hashem', 'Tabbaa', '', '123456789', 'zaatri', 2231);

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

DROP TABLE IF EXISTS `suggestions`;
CREATE TABLE IF NOT EXISTS `suggestions` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suggestions`
--

INSERT INTO `suggestions` (`book_id`) VALUES
(3),
(9);

-- --------------------------------------------------------

--
-- Table structure for table `top_rated`
--

DROP TABLE IF EXISTS `top_rated`;
CREATE TABLE IF NOT EXISTS `top_rated` (
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `top_rated`
--

INSERT INTO `top_rated` (`book_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- Table structure for table `verified_refugees`
--

DROP TABLE IF EXISTS `verified_refugees`;
CREATE TABLE IF NOT EXISTS `verified_refugees` (
  `refugee_id` varchar(15) NOT NULL,
  PRIMARY KEY (`refugee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verified_refugees`
--

INSERT INTO `verified_refugees` (`refugee_id`) VALUES
('1234567891'),
('1234567892'),
('1234567893'),
('1234567894'),
('1234567895'),
('1234567896'),
('1234567897'),
('1234567898'),
('1234567899');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `FK1_book` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `FK2_book` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`);

--
-- Constraints for table `my_books`
--
ALTER TABLE `my_books`
  ADD CONSTRAINT `my_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `my_books_ibfk_2` FOREIGN KEY (`refugee_id`) REFERENCES `refugee` (`refugee_id`);

--
-- Constraints for table `new_books`
--
ALTER TABLE `new_books`
  ADD CONSTRAINT `new_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`refugee_id`) REFERENCES `refugee` (`refugee_id`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD CONSTRAINT `suggestions_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);

--
-- Constraints for table `top_rated`
--
ALTER TABLE `top_rated`
  ADD CONSTRAINT `top_rated_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
