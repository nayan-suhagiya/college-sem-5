-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2023 at 05:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
DROP EVENT IF EXISTS daily_status_check;
DROP TRIGGER IF EXISTS  update_campaign_status_before_insert ;
DROP TRIGGER IF EXISTS  update_campaign_status_before_update ;
DROP TABLE IF EXISTS saved_posts;
DROP TABLE IF EXISTS campaigns;
DROP TABLE IF EXISTS Comments;
DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS blog_Posts;
DROP TABLE IF EXISTS Categories;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS promotion_package;
--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `like_count` int(11) DEFAULT NULL,
  `comment_count` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`post_id`, `user_id`, `title`, `content`, `like_count`, `comment_count`, `image`, `category_id`, `created_at`) VALUES
(1, 2, 'Reprehenderit aut sed doloribus blanditiis, aspernatur magni? ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?\r\n\r\nDolorum, incidunt! Adipisci harum itaque maxime dolores doloremque porro eligendi quis, doloribus vel sit rerum sunt obcaecati nam suscipit nulla vitae alias blanditiis aliquam debitis atque illo modi et placeat. Ratione iure eveniet provident. Culpa laboriosam sed ad quia. Corrupti, earum, perferendis dolore cupiditate sint nihil maiores iusto tempora nobis porro itaque est. Ut laborum culpa assumenda pariatur et perferendis?', 2, NULL, './upload/post/1692519526.png', 1, '2023-08-02 19:08:03'),
(2, 3, 'Demo Post', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque molestiae hic necessitatibus illo odit porro ipsa praesentium atque accusamus incidunt excepturi minima, modi voluptatibus neque exercitationem assumenda iure consectetur. Itaque!', 2, NULL, './upload/post/1692519534.png', 9, '2023-08-04 21:56:00'),
(28, 11, 'Clipping (morphology)', 'According to Hans Marchand, clippings are not coined as words belonging to the core lexicon of a language.[2] They originate as jargon or slang of an in-group, such as schools, army, police, and the medical profession. For example, exam(ination), math(ematics), and lab(oratory) originated in school slang; spec(ulation) and tick(et = credit) in stock-exchange slang; and vet(eran) and cap(tain) in army slang. Clipped forms can pass into common usage when they are widely useful, becoming part of standard English, which most speakers would agree has happened with math/maths, lab, exam, phone (from telephone), fridge (from refrigerator), and various others. When their usefulness is limited to narrower contexts, they remain outside the standard register. Many, such as mani and pedi for manicure and pedicure or mic/mike for microphone, occupy a middle ground in which their appropriate register is a subjective judgment, but succeeding decades tend to see them become more widely used.', 1, NULL, './upload/post/169531280400100-1059586531.png', 1, '2023-08-12 23:17:38'),
(29, 11, 'Choose the perfect design', 'Create a beautiful blog that fits your style. Choose from a selection of easy-to-use templates – all with flexible layouts and hundreds of background images – or design something new.', 1, NULL, './upload/post/1692519550.png', 1, '2023-08-13 01:25:13'),
(30, 11, 'Earn money', 'Get paid for your hard work. Google AdSense can automatically display relevant targeted ads on your blog so that you can earn income by posting about your passion.', 1, NULL, './upload/post/1692519557.png', 1, '2023-08-13 01:26:15'),
(31, 11, 'Know your audience', 'Find out which posts are a hit with Blogger’s built-in analytics. You’ll see where your audience is coming from and what they’re interested in. You can even connect your blog directly to Google Analytics for a more detailed look.\r\n\r\n', 0, NULL, './upload/post/1692519568.png', 1, '2023-08-13 01:26:37'),
(33, 11, 'Protecting the public’s right to free expression', 'On X, people are free to be their true selves. We believe people of all backgrounds and beliefs should have the right to freely express themselves, so long as they do so within the bounds of the law.\r\n\r\n', 0, NULL, './upload/post/1692519593.png', 1, '2023-08-13 01:35:50');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `campaign_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('pending','running','close') NOT NULL DEFAULT 'pending',
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='as';

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`campaign_id`, `name`, `status`, `post_id`, `user_id`, `package_id`, `start_date`, `end_date`, `total_amount`) VALUES
(16, 'Utsav paramr', 'running', 28, 11, 13, '2023-08-15', '2023-08-16', 200),
(17, 'demo', 'running', 29, 11, 14, '2023-08-18', '2023-09-17', 9000),
(18, 'first env', 'running', 1, 2, 14, '2023-09-22', '2023-10-22', 9000);

--
-- Triggers `campaigns`
--
DELIMITER $$
CREATE TRIGGER `update_campaign_status_before_insert` BEFORE INSERT ON `campaigns` FOR EACH ROW BEGIN
    IF NEW.start_date <= CURDATE() AND NEW.end_date >= CURDATE() THEN
        SET NEW.status = 'running';
    ELSEIF NEW.start_date > CURDATE() THEN
        SET NEW.status = 'pending';
    ELSE
        SET NEW.status = 'close';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(9, 'Dish'),
(1, 'Food'),
(10000, 'other');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `content`, `created_at`) VALUES
(7, 1, 11, 'Nice', '2023-09-20 01:30:17'),
(8, 1, 11, 'Awsome', '2023-09-20 01:32:25'),
(9, 1, 11, 'Super', '2023-09-20 01:33:40'),
(10, 1, 2, 'Awwwwwww', '2023-09-20 01:52:33'),
(11, 28, 11, 'Nice', '2023-09-22 03:13:32'),
(12, 28, 11, 'Nice', '2023-09-22 03:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `post_id`, `user_id`) VALUES
(12, 1, 2),
(13, 2, 2),
(96, 29, 11),
(116, 30, 11),
(142, 2, 11),
(155, 28, 11),
(161, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `promotion_package`
--

CREATE TABLE `promotion_package` (
  `package_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `total_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promotion_package`
--

INSERT INTO `promotion_package` (`package_id`, `name`, `price`, `description`, `total_days`) VALUES
(13, 'BASIC', 200, 'Eleifend cursus volutpat risus convallis nam sed quam sollicitudin eget leo at erat cursus justo', 1),
(14, 'SUPER', 300, 'Eleifend cursus volutpat risus convallis nam sed quam sollicitudin eget leo at erat cursus justo', 30),
(15, 'ENTERPRISE', 400, 'Eleifend cursus volutpat risus convallis nam sed quam sollicitudin eget leo at erat cursus justo', 365);

-- --------------------------------------------------------

--
-- Table structure for table `saved_posts`
--

CREATE TABLE `saved_posts` (
  `save_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` enum('client','admin') NOT NULL DEFAULT 'client',
  `image` varchar(100) DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `user_type`, `image`, `token`) VALUES
(1, 'Nayan Suhagiya', 'nayan@example.com', '$2y$10$MkDzkb.70GdsPJdr1FB4K.F2HVnNgxTpBlv7bXdFmAv91OMIwtmIK', 'admin', './upload/profile/1695329786WhatsApp Image 2023-09-07 at 1.24.41 PM.jpeg', NULL),
(2, 'Utsav Parmar', 'utsav@gmail.com', '$2y$10$8/C9ZLYPHC3QcB.UpqlDZ.Q1LAXLbLtLskS9QN8CVUROgfPuMfclO', 'client', './upload/profile/169251963600002-6000.png', NULL),
(3, 'Tom', 'Utsavparmar72@gmail.com', '$2y$10$iAshvjK9kGjVTnF6vFDcC.VhfDLT1iOlv/CuivtB4u1U6vVxO9oei', 'admin', './upload/profile/169251964600034-5002.png', '6520ba51ddbd45058b2d40d52ec621272318364e4f23e75b446cc8c86f6296ec'),
(11, 'demo', 'demo@gmail.com', '$2y$10$zH/n8SyqV.SurBy2MSXeJ./YmNor3FX2HD9G0mlGXJCL2dkcdCShS', 'client', './upload/profile/169515289900000-322487942.png', NULL),
(21, 'satyam', 'satyamgangani@gmail.com', '$2y$10$N0QMJ9YLirULSZtE508GDuVi.iggIqP6bz9rr5BrTMhaR1WVUYVLC', 'client', './upload/profile/169614943027426-1256817394-Naruto,1boy, black_background, fire, 9 fox tails,.jpeg', '59f086f704f39285bb39fbacbb7569f070d2c07b5f02529532281da50795a2c4'),
(22, 'kreract', 'Kreract@gmail.com', '$2y$10$/HIqDMH.O8rrGph/xZZArOj6wThQ3VKFIGn/ibPvPnrWedDVPyDPi', 'client', './upload/profile/169614972427426-1256817394-Naruto,1boy, black_background, fire, 9 fox tails,.jpeg', '81eea5afe856c7573208999c0c610553a2fb6b1a5bf9d1a76d8d1f08e42298df');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`campaign_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `promotion_package`
--
ALTER TABLE `promotion_package`
  ADD PRIMARY KEY (`package_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `saved_posts`
--
ALTER TABLE `saved_posts`
  ADD PRIMARY KEY (`save_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10001;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `promotion_package`
--
ALTER TABLE `promotion_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `saved_posts`
--
ALTER TABLE `saved_posts`
  MODIFY `save_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `blog_posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`post_id`),
  ADD CONSTRAINT `campaigns_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `campaigns_ibfk_3` FOREIGN KEY (`package_id`) REFERENCES `promotion_package` (`package_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`post_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`post_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `saved_posts`
--
ALTER TABLE `saved_posts`
  ADD CONSTRAINT `saved_posts_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_posts` (`post_id`),
  ADD CONSTRAINT `saved_posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
