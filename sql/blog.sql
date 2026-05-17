-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 06, 2021 at 04:13 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `first_name`, `last_name`) VALUES
(1, 'Amie', 'Browning'),
(2, 'Derry', 'Lammerding');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(1, 'Food'),
(2, 'Entertainment'),
(3, 'Dining'),
(4, 'Music'),
(5, 'Beer'),
(6, 'Wine'),
(7, 'Vacation');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `content` varchar(4096) NOT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `date`, `content`, `author`) VALUES
(1, 'Post No. 1', '2021-05-04', 'I\'m baby jean shorts before they sold out fashion axe try-hard XOXO thundercats ennui yuccie. Occupy yr jianbing sustainable listicle mustache tbh. Pop-up tilde fanny pack polaroid humblebrag. Semiotics poutine celiac tbh pinterest organic coloring book. Pickled deep v salvia quinoa, heirloom farm-to-table kickstarter banjo VHS neutra jean shorts iceland.', 1),
(2, 'Post No. 2', '2021-05-06', 'Taiyaki franzen food truck typewriter 8-bit blue bottle, DIY lumbersexual cloud bread vexillologist XOXO flexitarian listicle single-origin coffee ethical. Adaptogen lumbersexual beard iPhone plaid 8-bit af kinfolk godard. Pabst unicorn fashion axe fam literally. Raw denim godard coloring book, chillwave literally gochujang poutine bicycle rights iPhone mustache af truffaut plaid succulents PBR&B. Vape swag man bun waistcoat literally tofu.', 1),
(3, 'Post No. 3', '2021-05-05', 'Bitters cold-pressed synth pop-up hexagon single-origin coffee, master cleanse semiotics helvetica ennui authentic selvage butcher. Distillery +1 ethical woke keffiyeh. Skateboard hella vinyl, leggings farm-to-table vexillologist venmo poke. Franzen tumeric dreamcatcher drinking vinegar, adaptogen iceland aesthetic occupy chartreuse vinyl art party lyft kombucha plaid.\r\n\r\n', 2),
(4, 'Post No. 4', '2021-05-27', 'Before they sold out green juice enamel pin, VHS YOLO single-origin coffee cliche paleo hexagon live-edge. Neutra vexillologist cold-pressed farm-to-table, la croix kogi etsy pug mustache raclette single-origin coffee coloring book subway tile. Lomo tote bag poutine man bun DIY bicycle rights distillery keffiyeh williamsburg af pabst. Tacos kitsch artisan, everyday carry pitchfork poke shaman swag literally godard. Celiac artisan fanny pack heirloom actually. Cloud bread hammock kogi try-hard, raclette normcore etsy.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `post_category_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`post_category_id`, `post_id`, `category_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 4),
(5, 3, 3),
(6, 4, 3),
(7, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `post_tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`post_tag_id`, `post_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(5, 2, 2),
(6, 2, 4),
(7, 2, 5),
(8, 3, 6),
(9, 3, 7),
(10, 3, 8),
(11, 3, 9),
(12, 4, 1),
(13, 4, 2),
(14, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `tag`) VALUES
(1, 'food'),
(2, 'dining'),
(3, 'breakfast'),
(4, 'play'),
(5, 'show'),
(6, 'concert'),
(7, 'outdoors'),
(8, 'music'),
(9, 'live-show');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`post_category_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`post_tag_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `post_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `post_tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
