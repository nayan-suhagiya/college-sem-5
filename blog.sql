-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 18, 2023 at 03:22 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

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
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `like_count` int(11) DEFAULT NULL,
  `comment_count` int(11) DEFAULT NULL,
  `image` text,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`post_id`, `user_id`, `title`, `content`, `like_count`, `comment_count`, `image`, `category_id`, `created_at`) VALUES
(1, 2, 'Reprehenderit aut sed doloribus blanditiis, aspernatur magni? ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?\r\n\r\nDolorum, incidunt! Adipisci harum itaque maxime dolores doloremque porro eligendi quis, doloribus vel sit rerum sunt obcaecati nam suscipit nulla vitae alias blanditiis aliquam debitis atque illo modi et placeat. Ratione iure eveniet provident. Culpa laboriosam sed ad quia. Corrupti, earum, perferendis dolore cupiditate sint nihil maiores iusto tempora nobis porro itaque est. Ut laborum culpa assumenda pariatur et perferendis?', 2, NULL, './upload/post/16918241649.jpeg', 1, '2023-08-02 19:08:03'),
(2, 3, 'Demo Post', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque molestiae hic necessitatibus illo odit porro ipsa praesentium atque accusamus incidunt excepturi minima, modi voluptatibus neque exercitationem assumenda iure consectetur. Itaque!', 2, NULL, './upload/post/1691853271.jpg', 9, '2023-08-04 21:56:00'),
(28, 11, 'Clipping (morphology)', 'According to Hans Marchand, clippings are not coined as words belonging to the core lexicon of a language.[2] They originate as jargon or slang of an in-group, such as schools, army, police, and the medical profession. For example, exam(ination), math(ematics), and lab(oratory) originated in school slang; spec(ulation) and tick(et = credit) in stock-exchange slang; and vet(eran) and cap(tain) in army slang. Clipped forms can pass into common usage when they are widely useful, becoming part of standard English, which most speakers would agree has happened with math/maths, lab, exam, phone (from telephone), fridge (from refrigerator), and various others. When their usefulness is limited to narrower contexts, they remain outside the standard register. Many, such as mani and pedi for manicure and pedicure or mic/mike for microphone, occupy a middle ground in which their appropriate register is a subjective judgment, but succeeding decades tend to see them become more widely used.', 1, NULL, './upload/post/1692278615.png', 1, '2023-08-12 23:17:38'),
(29, 11, 'Choose the perfect design', 'Create a beautiful blog that fits your style. Choose from a selection of easy-to-use templates – all with flexible layouts and hundreds of background images – or design something new.', 1, NULL, './upload/post/169187011300043.jpg', 1, '2023-08-13 01:25:13'),
(30, 11, 'Earn money', 'Get paid for your hard work. Google AdSense can automatically display relevant targeted ads on your blog so that you can earn income by posting about your passion.', 1, NULL, './upload/post/169187017500012.png', 1, '2023-08-13 01:26:15'),
(31, 11, 'Know your audience', 'Find out which posts are a hit with Blogger’s built-in analytics. You’ll see where your audience is coming from and what they’re interested in. You can even connect your blog directly to Google Analytics for a more detailed look.\r\n\r\n', 1, NULL, './upload/post/169187019700041.jpg', 1, '2023-08-13 01:26:37'),
(32, 11, 'How to Start a Blog That Makes You Money', 'Are you looking for an easy guide on how to start a blog?\r\n\r\nThe step-by-step guide on this page will show you how to create a blog in 20 minutes with just the most basic computer skills.\r\n\r\nAfter completing this guide you will have a beautiful blog that is ready to share with the world.\r\n\r\n', 1, NULL, './upload/post/169187028300044.jpg', 9, '2023-08-13 01:28:03'),
(33, 11, 'Protecting the publicï¿½s right to free expression', 'On X, people are free to be their true selves. We believe people of all backgrounds and beliefs should have the right to freely express themselves, so long as they do so within the bounds of the law.\r\n\r\n', 1, NULL, './upload/post/1692278625.png', 1, '2023-08-13 01:35:50'),
(34, 11, 'An update on Twitter Transparency Reporting', 'As we review our approach to transparency reporting in light of innovations in content moderation and changes in the regulatory landscape, we believe itï¿½s important to share data from H1 2022 on our health & safety efforts. We wonï¿½t be publishing a formal transparency report for this period (January 1 - June 30, 2022) in our previous format.', NULL, NULL, './upload/post/1692278675blog2.png', 9, '2023-08-13 01:36:16'),
(35, 2, 'Cheerful Loving Couple Bakers Drinking Coffee', 'Itâ€™s no secret that the digital industry is booming. From exciting startups to global brands, companies are reaching out to digital agencies, responding to the new possibilities available. However, the industry is fast becoming overcrowded, heaving with agencies offering similar services â€” on the surface, at least.\r\n\r\nProducing creative, fresh projects is the key to standing out. Unique side projects are the best place to innovate, but balancing commercially and creatively lucrative work is tricky. So, this article looks at how to make side projects work and why theyâ€™re worthwhile, drawing on lessons learned from our development of the ux ompanion app.\r\n\r\nWhy Integrate Side Projects?\r\nBeing creative within the constraints of client briefs, budgets and timelines is the norm for most agencies. However, investing in research and development as a true, creative outlet is a powerful addition. In these side projects alone, your team members can pool their expertise to create and shape their own vision â€” a powerful way to develop motivation, interdisciplinary skills and close relationships.', 1, NULL, './upload/post/1692279642couple.jpeg', 1, '2023-08-17 19:10:42');

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
(118, 32, 11),
(120, 31, 11),
(149, 1, 11),
(150, 33, 11),
(151, 2, 11),
(152, 35, 2),
(153, 28, 11);

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
(13, 'BASIC', 200, 'Compaign your post for 1 day in just 200/- only', 1),
(14, 'SUPER', 300, 'Compaign your post for 1 month in just 300/- only [Special Offer]', 30),
(15, 'ENTERPRISE', 400, 'Compaign your post for 1 year in just 400/- only [Loot Offer]	', 365);

-- --------------------------------------------------------

--
-- Table structure for table `saved_posts`
--

CREATE TABLE `saved_posts` (
  `save_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saved_posts`
--

INSERT INTO `saved_posts` (`save_id`, `post_id`, `user_id`) VALUES
(1, 1, 11),
(2, 31, 11),
(5, 35, 2);

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
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
(1, 'Nayan Suhagiya', 'nayan@example.com', 'nayan@123', 'admin', './upload/profile/169131863000036.png'),
(2, 'Utsav Parmar', 'utsav@example.com', '1234', 'client', './upload/profile/16918448108.jpeg'),
(3, 'Tom', 'Utsavparmar72@gmail.com', '123', 'admin', './upload/profile/169131950200048.jpg'),
(11, 'demo', 'demo@gmail.com', 'demo', 'client', './upload/profile/1692278554modi.png');

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
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10001;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `promotion_package`
--
ALTER TABLE `promotion_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `saved_posts`
--
ALTER TABLE `saved_posts`
  MODIFY `save_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `daily_status_check` ON SCHEDULE EVERY 1 DAY STARTS '2023-08-15 17:52:14' ENDS '2023-09-30 17:52:14' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE campaigns
    SET status =
        CASE
            WHEN start_date > CURDATE() THEN 'pending'
            WHEN start_date <= CURDATE() AND end_date >= CURDATE() THEN 'running'
            WHEN end_date < CURDATE() THEN 'close'
            ELSE status
        END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
