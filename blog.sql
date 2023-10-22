-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2023 at 03:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(3) NOT NULL,
  `category_name` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(2, 'Bug Bounty'),
(10, 'Hack'),
(11, 'SQL'),
(16, 'Pentest');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(5) NOT NULL,
  `comment_post_id` int(5) NOT NULL,
  `comment_date` date NOT NULL,
  `comment_author` varchar(20) NOT NULL,
  `comment_email` varchar(64) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_status` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_date`, `comment_author`, `comment_email`, `comment_text`, `comment_status`) VALUES
(1, 1, '2023-10-09', 'xssPro', 'xssPro8989@gmail.com', 'Hi, This is a comment ', 'yes'),
(2, 2, '2020-10-23', 'xan', 'xxx@gmail.com', 'salam\r\n', 'yes'),
(7, 1, '2020-10-23', 'aga', 'aga1999@gmail.com', 'salam tanis olmaq isteyen dm ', 'yes'),
(8, 5, '2020-10-23', 'salam', 'salam@gmail.com', 'salam 1', 'yes'),
(9, 5, '2020-10-23', 'mayk', 's1212@gmail.com', 'veriy cool post', 'yes'),
(10, 2, '2021-10-23', '77root', '77root@toor.com', 'I&#039;m here', 'yes'),
(11, 2, '2021-10-23', 'mayk', 's1212@gmail.com', 'Salam', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `portfolio_id` int(11) NOT NULL,
  `portfolio_name` varchar(31) NOT NULL,
  `portfolio_category` varchar(31) NOT NULL,
  `portfolio_img_sm` text NOT NULL,
  `portfolio_img_bg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`portfolio_id`, `portfolio_name`, `portfolio_category`, `portfolio_img_sm`, `portfolio_img_bg`) VALUES
(10, 'I love golang.', 'GOLANG', 'comany.jpg', '06-thumbnail.jpg'),
(15, 'py5thon', 'PYTHON', '05-thumbnail.jpg', '05-full.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(10) NOT NULL,
  `post_category` varchar(30) NOT NULL,
  `post_title` varchar(100) NOT NULL,
  `post_author` varchar(50) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_comment_number` int(5) NOT NULL,
  `post_image` text NOT NULL,
  `post_text` text NOT NULL,
  `post_tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category`, `post_title`, `post_author`, `post_date`, `post_comment_number`, `post_image`, `post_text`, `post_tags`) VALUES
(1, 'GOLANG', 'My firs post. XSS attack ', 'x0xsec777', '2021-10-23 00:00:00', 8, 'ZiyXX.png', 'Here are common exam$_POST[&#039;post_text&#039;]$_POST[&#039;post_text&#039;]Cross-site scripting (XSS) is a type of injection attack in which a threat actor inserts data, such as a malicious script, into content from trusted websites. The malicious code is then included with dynamic content delivered to a victim&#039;s browser.\r\n\r\nXSS is one of the most common cyber attack types. Malicious scripts are often delivered in the form of bits of JavaScript code that the victim&#039;s browser executes. Exploits can incorporate malicious executable code in many other languages, including Java, Ajax and Hypertext Markup Language (HTML). Although XSS attacks can be serious, preventing the vulnerabilities that enable them is relatively easy.\r\n\r\nXSS enables an attacker to execute malicious scripts in another user&#039;s browser. However, instead of attacking the victim directly, the attacker exploits a vulnerability in a website the victim visits and gets the website to deliver the malicious script.Cross-site scripting (XSS) is a type of injection attack in which a threat actor inserts data, such as a malicious script, into content from trusted websites. The malicious code is then included with dynamic content delivered to a victim&#039;s browser.\r\n\r\nXSS is one of the most common cyber attack types. Malicious scripts are often delivered in the form of bits of JavaScript code that the victim&#039;s browser executes. Exploits can incorporate malicious executable code in many other languages, including Java, Ajax and Hypertext Markup Language (HTML). Although XSS attacks can be serious, preventing the vulnerabilities that enable them is relatively easy.\r\n\r\nXSS enables an attacker to execute malicious scripts in another user&#039;s browser. However, instead of attacking the victim directly, the attacker exploits a vulnerability in a website the victim visits and gets the website to deliver the malicious script.', 'xss, bug, XSS'),
(2, 'SQL', 'My second post. SQLi attack ', 'd33vil_199', '2021-10-23 00:00:00', 8, 'injection-910x554.jpg', 'SQL injection attacks allow attackers to spoof identity, tamper with existing data, cause repudiation issues such as voiding transactions or changing balances, allow the complete disclosure of all data on the system, destroy the data or make it otherwise unavailable, and become administrators of the database server.', 'sqli, bug, sql'),
(15, 'Hack', 'RCE exploit', 'prefessorxss', '2021-10-23 00:00:00', 8, '6275065bd4a769dc2e3c3739_Remote code execution.jpg', 'What is remote code execution (RCE)?\r\nRemote code execution (RCE) is when an attacker accesses a target computing device and makes changes remotely, no matter where the device is located. RCE is a broad category of attacks can have minor effects of victim systems, but they can also be quite serious.\r\n\r\nTwo of the well-known RCE attacks are the WannaCry ransomware exploit and the Log4j exploit.\r\n\r\nHow does RCE work?\r\nRCE attackers scan the internet for vulnerable applications. Once they spot a remote code vulnerability, they attack it over a network. Attackers often create a remote command shell that lets them control some aspect of the target system remotely.\r\n\r\nRemote code security vulnerabilities provide attackers with the ability to execute malicious code, or malware, and take over an affected system. After gaining access to the system, attackers will often attempt to elevate their privileges from user to admin.', '#RCE #hack'),
(18, 'Hack', 'Python Xss Scanner', 'prefessorxss', '2021-10-23 00:00:00', 8, 'What-is-Cross-Site-Scripting-XSS-1080x628.png', 'Cross-site scripting (XSS) is an attack in which an attacker injects malicious executable scripts into the code of a trusted application or website. Attackers often initiate an XSS attack by sending a malicious link to a user and enticing the user to click it. If the app or website lacks proper data sanitization, the malicious link executes the attacker&rsquo;s chosen code on the user&rsquo;s system. As a result, the attacker can steal the user&rsquo;s active session cookie.', 'hack, python, bug'),
(19, 'Pentest', 'SMB Enumeration', 'h4ck3r1918', '2021-10-23 00:00:00', 8, '17.png', 'SMB( Server Message Block protocol) is a client-server communication protocol that is used for sharing access to files, devices, serial ports, and other resources on a network. SMB enumeration is a multipart process in which we enumerate the host or target system for different information like Hostnames, List shares, null sessions, checking for vulnerabilities, etc.\r\n\r\n', 'hack'),
(20, 'Bug Bounty', 'CRLF Injection - OWASP Foundation', 'admin', '2021-10-23 00:00:00', 8, 'crlf-http-header-768x403.jpg', 'What Are CRLF Injection Attacks\r\nA CRLF injection attack is one of several types of injection attacks. It can be used to escalate to more malicious attacks such as Cross-site Scripting (XSS), page injection, web cache poisoning, cache-based defacement, and more. A CRLF injection vulnerability exists if an attacker can inject the CRLF characters into a web application, for example using a user input form or an HTTP request.\r\n\r\nThe CRLF abbreviation refers to Carriage Return and Line Feed. CR and LF are special characters (ASCII 13 and 10 respectively, also referred to as \r\n) that are used to signify the End of Line (EOL). The CRLF sequence is used in operating systems including Windows (but not Linux/UNIX) and Internet protocols including HTTP.\r\n\r\nThere are two most common uses of CRLF injection attacks: log poisoning and HTTP response splitting. In the first case, the attacker falsifies log file entries by inserting an end of a line and an extra line. This can be used to hide other attacks or to confuse system administrators. In the second case, CRLF injection is used to add HTTP headers to the HTTP response and, for example, perform an XSS attack that leads to information disclosure. A similar technique, called Email Header Injection, may be used to add SMTP headers to emails.\r\n--------------------------------------------\r\nThe following simplified example uses CRLF to:\r\n\r\nAdd a fake HTTP response header: Content-Length: 0. This causes the web browser to treat this as a terminated response and begin parsing a new response.\r\nAdd a fake HTTP response: HTTP/1.1 200 OK. This begins the new response.\r\nAdd another fake HTTP response header: Content-Type: text/html. This is needed for the web browser to properly parse the content.\r\nAdd yet another fake HTTP response header: Content-Length: 25. This causes the web browser to only parse the next 25 bytes.\r\nAdd page content with an XSS: &lt;script&gt;alert(1)&lt;/script&gt;. This content has exactly 25 bytes.\r\nBecause of the Content-Length header, the web browser ignores the original content that comes from the web server.', 'crlf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(31) NOT NULL,
  `password` varchar(31) NOT NULL,
  `email` varchar(64) NOT NULL,
  `reg_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `reg_date`) VALUES
(1, 'admin', 'admin123', 'admin@pentester.com', '2023-10-03 00:00:00'),
(3, 'salam', '12345', 'salam@gmail.com', '2021-10-23 00:00:00'),
(5, 'vusal', '!vusal!1918', 'vusal@gmail.com', '2021-10-23 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`portfolio_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `portfolio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
