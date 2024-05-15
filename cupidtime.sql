-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2024-05-01 23:03:19
-- 服务器版本： 5.7.44-log
-- PHP 版本： 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `cupidtime`
--

-- --------------------------------------------------------

--
-- 表的结构 `ybc_admin_user`
--

CREATE TABLE `ybc_admin_user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL COMMENT '用户名称',
  `pwd` varchar(255) NOT NULL COMMENT '密码',
  `salt` varchar(10) NOT NULL COMMENT '密码盐',
  `last_time` varchar(20) NOT NULL COMMENT '最后登录时间',
  `mobile` varchar(20) NOT NULL COMMENT '手机号码'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员表' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `ybc_admin_user`
--

INSERT INTO `ybc_admin_user` (`id`, `user_name`, `pwd`, `salt`, `last_time`, `mobile`) VALUES
(1, 'admin', '0e0b7aa994b79af3119e985f6c950c19', '7985', '1714573813', '13123123123');

-- --------------------------------------------------------

--
-- 表的结构 `ybc_info`
--

CREATE TABLE `ybc_info` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '参数名称',
  `value` varchar(255) NOT NULL DEFAULT '' COMMENT '参数值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站信息表' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `ybc_info`
--

INSERT INTO `ybc_info` (`id`, `title`, `value`) VALUES
(1, 'title', 'CupidTime'),
(2, 'fen_img', 'public/upload/ad/bc4b295644ffe040618cc8df0ec251a0.png'),
(3, 'audio_type', 'mp3|wma|rm'),
(4, 'video_type', 'mp4'),
(5, 'file_type', 'txt|pdf'),
(6, 'center', '限时优惠,预约从速!限时优惠,预约从速!限时优惠,预约从速!限时优惠,预约从速!限时优惠,预约从速!限时优惠,预约从速!限时优惠,预约从速!限时优惠,预约从速!限时优惠,预约从速!'),
(12, 'address', 'address|address|address'),
(13, 'mobile', '110110110'),
(14, 'email', 'test123@qq.com'),
(15, 'fax', '0451 - 88888888'),
(16, 'contacts', '王富贵'),
(17, 'index1', 'public/upload/ad/f6eaeb9a7dc1ac71f30491eba12a2e83._SX3000_'),
(18, 'index2', 'public/upload/ad/7784030e5a4244b63eb7ed04c303d2e7._SX3000_'),
(19, 'index3', 'public/upload/ad/62841657e78195a83cdf4a17b75ded0c._SX3000_'),
(20, 'code', 'public/upload/ad/6b8b373d5211082f0a07199548182639.jpeg');

-- --------------------------------------------------------

--
-- 表的结构 `ybc_like`
--

CREATE TABLE `ybc_like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `like_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `ybc_like`
--

INSERT INTO `ybc_like` (`id`, `user_id`, `like_id`, `created_at`) VALUES
(1, 5, 4, '2024-04-27 07:50:37'),
(2, 10, 4, '2024-04-27 07:50:40'),
(3, 6, 4, '2024-04-27 07:50:44'),
(4, 13, 4, '2024-04-29 10:27:20'),
(5, 15, 6, '2024-04-29 10:31:19'),
(6, 15, 12, '2024-04-29 10:31:32'),
(7, 12, 13, '2024-04-30 01:50:39'),
(8, 12, 14, '2024-04-30 01:50:53'),
(9, 20, 4, '2024-04-30 04:08:42'),
(10, 12, 12, '2024-04-30 11:10:37'),
(11, 28, 27, '2024-04-30 14:37:02'),
(12, 29, 14, '2024-05-01 05:57:04'),
(13, 31, 28, '2024-05-01 09:45:59'),
(14, 31, 13, '2024-05-01 09:46:27'),
(15, 32, 16, '2024-05-01 09:52:29'),
(16, 28, 32, '2024-05-01 09:59:09'),
(17, 30, 27, '2024-05-01 10:43:08'),
(18, 33, 33, '2024-05-01 11:15:51'),
(19, 33, 17, '2024-05-01 11:15:57'),
(20, 33, 31, '2024-05-01 11:16:00'),
(21, 33, 11, '2024-05-01 11:16:02'),
(22, 33, 20, '2024-05-01 11:16:05'),
(23, 33, 6, '2024-05-01 11:16:15'),
(24, 33, 12, '2024-05-01 11:16:21'),
(25, 36, 27, '2024-05-01 12:24:38'),
(26, 35, 14, '2024-05-01 12:59:54'),
(27, 35, 31, '2024-05-01 12:59:57'),
(28, 35, 20, '2024-05-01 12:59:59'),
(29, 35, 29, '2024-05-01 13:00:02'),
(30, 35, 27, '2024-05-01 13:00:04'),
(31, 35, 28, '2024-05-01 13:00:07'),
(35, 40, 12, '2024-05-01 14:39:36'),
(36, 40, 40, '2024-05-01 14:39:58'),
(37, 27, 28, '2024-05-01 14:48:43'),
(38, 28, 12, '2024-05-01 14:50:47'),
(39, 28, 30, '2024-05-01 14:51:12');

-- --------------------------------------------------------

--
-- 表的结构 `ybc_news`
--

CREATE TABLE `ybc_news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `con` text COMMENT '内容',
  `add_time` varchar(20) DEFAULT NULL COMMENT '创建时间',
  `img` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `author_img` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `ybc_news`
--

INSERT INTO `ybc_news` (`id`, `title`, `con`, `add_time`, `img`, `author`, `author_img`, `link`, `description`) VALUES
(1, 'OkCupid and Opendoor break down post-breakup behaviors', NULL, '2024-04-27 12:25:27', 'https://miro.medium.com/v2/resize:fit:1100/format:webp/1*FVtPf9go3NBYe9yjzAUILg.jpeg', 'CupidTime', 'https://r2.fivemanage.com/pub/m25hp7mmktyd.jpg', 'https://theblog.okcupid.com/okcupid-and-opendoor-breaks-down-post-breakup-behaviors-86907f87b323', 'OkCupid data reveals how daters’ answers to matching questions expose their likelihood to ghost'),
(2, 'OkCupid Celebrates Two Decades of Connections', NULL, '2024-04-27 12:25:27', 'https://miro.medium.com/v2/resize:fit:2000/format:webp/1*F78-zgDi2ZlpCQNI7y-Fmw.jpeg', 'CupidTime', 'https://r2.fivemanage.com/pub/m25hp7mmktyd.jpg', 'https://theblog.okcupid.com/okcupid-celebrates-two-decades-of-connections-c25db41bec1e', 'Twenty years of data shows what’s next for dating and relationships around the world'),
(3, '6 safety tips to help avoid scammers', NULL, '2024-04-27 12:25:27', 'https://miro.medium.com/v2/resize:fit:2000/format:webp/0*_ez-RvxIUS3ytscy', 'CupidTime', 'https://r2.fivemanage.com/pub/m25hp7mmktyd.jpg', 'https://theblog.okcupid.com/6-safety-tips-to-help-avoid-scammers-173f59022121', 'Damona Hoffman, author of F the Fairy Tale, shares tips on how to spot the signs once you’ve matched\nOkCupid\nOkCupid Dating Blog\n'),
(4, '7 safety tips to keep in mind year-round', NULL, '2024-04-27 12:25:27', 'https://miro.medium.com/v2/resize:fit:1100/format:webp/1*eHXn0VEHEHK0k-TEQ6mjGA.png', 'CupidTime', 'https://r2.fivemanage.com/pub/m25hp7mmktyd.jpg', 'https://theblog.okcupid.com/7-safety-tips-to-keep-in-mind-year-round-b4405e55697f', 'Love abounds during the holidays! Meet someone new & stay safe this season'),
(5, 'How to spot a ghoster', NULL, '2024-04-27 12:25:27', 'https://miro.medium.com/v2/resize:fit:2000/format:webp/1*CFcv-ikxKhT-uN03aZc6MA.jpeg', 'CupidTime', 'https://r2.fivemanage.com/pub/m25hp7mmktyd.jpg', 'https://theblog.okcupid.com/how-to-spot-a-ghoster-f8cd88a1a5a8', 'OkCupid data reveals how daters’ answers to matching questions expose their likelihood to ghost'),
(6, 'Let’s celebrate every single person', NULL, '2024-04-27 12:25:27', 'https://miro.medium.com/v2/resize:fit:2000/format:webp/1*g7ADs3C-PcvBqS6kZ9s_Bg.png', 'CupidTime', 'https://r2.fivemanage.com/pub/m25hp7mmktyd.jpg', 'https://theblog.okcupid.com/lets-celebrate-every-single-person-bd135a7c7e1d', 'OkCupid’s latest brand campaign encourages ALL daters to embrace the new normal of dating'),
(7, 'HOW I PULLED A BOYFRIEND OUT OF THE TRASH!', NULL, '2024-04-27 12:25:27', 'https://i.postimg.cc/kGkdZLxw/How-I-Pulled-a-Boyfriend-2.jpg', 'CupidTime', 'https://r2.fivemanage.com/pub/m25hp7mmktyd.jpg', 'https://michellejacoby.com/online-dating-advice/dating-advice-how-i-pulled-a-boyfriend/', 'OkCupid’s latest brand campaign encourages ALL daters to embrace the new normal of dating'),
(8, 'HOD SELECT: Dating Apps, Lust, and Window Shopping?\n', NULL, '2024-04-27 12:25:27', 'https://i.postimg.cc/g08FXMb6/hihi.png', 'CupidTime', 'https://r2.fivemanage.com/pub/m25hp7mmktyd.jpg', 'HOD SELECT: Online Dating 101', 'Join JJ as he dives into dating apps from a Christian perspective. He talks about glorifying God in the choices you’re making \n\n'),
(9, 'HOD SELECT: Online Dating 101', NULL, '2024-04-27 12:25:27', 'https://i.postimg.cc/Cx86mzP3/22.png', 'CupidTime', 'https://r2.fivemanage.com/pub/m25hp7mmktyd.jpg', 'https://www.heartofdating.com/podcast/hod-select-online-dating-101', 'Kat discusses being a single woman in her 30s, online dating, dating apps, and debunking myths of christians using dating platforms.\n\n‍');

-- --------------------------------------------------------

--
-- 表的结构 `ybc_users`
--

CREATE TABLE `ybc_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `bio` longtext,
  `img` varchar(100) DEFAULT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_vip` tinyint(1) NOT NULL DEFAULT '0',
  `expire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `ybc_users`
--

INSERT INTO `ybc_users` (`id`, `name`, `sex`, `age`, `email`, `password`, `region`, `height`, `bio`, `img`, `salt`, `created_at`, `is_vip`, `expire_date`) VALUES
(4, 'Mary Lam', 'female', 29, 'marylam@gmail.com', '7e13f69e7fcd5e52e056768b719d2c16', 'USA', '172', 'Tech geek, stargazer, and ultimate frisbee champion. Searching for a partner to share tech talks and starry nights.\"', 'https://i.postimg.cc/Wb1Wdtyk/4.jpg', '9521', '2024-04-25 11:33:40', 1, '2024-05-30'),
(5, 'Jason Lu', 'male', 18, 'jasonlu@test.com', '58d15623eaae71f4e9de73196c4932ab', 'HongKong', '180', '\"Enthusiastic traveler and amateur photographer. Love exploring new cultures. Looking for someone with a passion for adventure and a zest for life.\"', 'https://i.postimg.cc/MHmTMq9s/13.jpg', '2789', '2024-04-25 11:55:15', 0, NULL),
(6, 'Emma Williams', 'female', 18, 'emma@test.com', '67fe960235d1c386e1cb6deeacd59db2', 'Macau', '164', '\"Coffee enthusiast, avid reader, and part-time yoga instructor. Seeking a kindred spirit who loves deep conversations and lazy Sunday mornings.\"', 'https://i.postimg.cc/BvRtRh8C/7.jpg', '7581', '2024-04-25 12:05:31', 0, NULL),
(8, 'Robert Moore', 'male', 20, 'robert@test.com', 'ec90ca0fa7a6cdef74af7d54f23a0280', 'California', '180', '\"Health and fitness coach. Dedicated to a healthy lifestyle and looking for someone who values fitness and wellness as much as I do.\"', 'https://i.postimg.cc/GhRTcSX7/3.jpg', '1744', '2024-04-25 12:10:41', 0, NULL),
(10, 'Hannah Davis', 'female', 26, 'hannah@test.com', '0f2bcb5fa2927eae035766bace868279', 'Macau', '172', '\"Musician at heart, I play guitar and write songs. Would love to find someone who appreciates music and creative arts.\"', 'https://i.postimg.cc/1z8fCxzt/12.jpg', '6953', '2024-04-25 12:12:38', 0, NULL),
(11, 'Simon Wang', 'male', 11, 'simon@test.com', '341f589756a6a8437ca8e196d97130c7', 'Macau', '180', '\"Aspiring entrepreneur, always buzzing with new ideas. I’d love to meet a fellow dreamer to build a future with.\"', 'https://i.postimg.cc/hjxhn9TR/9.jpg', '5000', '2024-04-25 12:21:57', 0, NULL),
(12, 'Phoebe Wang', 'female', 22, 'phoebewang003@gmail.com', '036e8a584b09f2feb2a05cdee80bf5ca', 'Asia Pacific', '', 'I\'m the group leader of Group 3!', 'public/upload/ad/319502b788b91ad0fcb3a73b9f549e63.jpg', '9238', '2024-04-27 22:20:02', 1, '2024-05-31'),
(13, 'Anthony', 'male', 38, 'anthony@test.com', '74ee7186bac62f8c969bb29134e388aa', 'Macau', '170', '\"Professional baker specializing in sweets. Searching for someone sweet to share in the simple joys of life and dessert!\"', 'https://i.postimg.cc/BQCLtcyq/5.jpg', '5987', '2024-04-28 14:22:35', 0, NULL),
(14, 'Ashley Smith', 'female', 27, 'ashely@test.com', '34d6c925724d58cead49fab7a86c6c70', 'Macau', '160', '\"Globe-trotter and polyglot. I thrive in diverse environments and am looking for someone who is curious about the world and different cultures.\"', 'https://i.postimg.cc/3J3WM0wz/15.jpg', '8166', '2024-04-28 14:26:29', 0, NULL),
(16, 'Alexander Nicholson', 'male', 23, 'alexander@gmail.com', 'a6dc4bad5bc589a2a7236486f96f14c2', 'Macau', '189', '\"Budding chef who loves experimenting in the kitchen. Looking for a taste tester and partner to explore the world of flavors together.\"', 'https://i.postimg.cc/FKpdfb1Y/28.jpg', '7123', '2024-04-29 13:03:02', 1, '2024-05-30'),
(17, 'Sean Vaughn', 'male', 29, 'sean@test.com', 'e1d59eec7e77d0f1c35f702324e55145', 'HongKong', '187', '\"Film aficionado and aspiring filmmaker. If you love dissecting plots and discussing character arcs, we might just be a match made in cinema heaven.\"', 'https://i.postimg.cc/9MNDbWdV/29.jpg', '3666', '2024-04-29 13:10:08', 1, '2024-05-30'),
(18, 'Laura Garcia', 'female', 21, 'laura@test.com', '455e2d9191c0d559d2595fb99837c38c', 'Macau', '162', '\"Passionate gardener with a love for outdoor life. Looking for someone to cultivate a beautiful relationship with, one day at a time.\"', 'https://i.postimg.cc/jjtnd3qV/27.jpg', '4850', '2024-04-30 03:43:49', 1, '2024-05-31'),
(20, 'Eric Cooper', 'male', 21, 'eric@test.com', 'e0a2b94da14b2225dadf59115271fb0b', 'Macau', '180', 'Avid hiker and nature enthusiast. Seeking an adventurous soul who’s ready to hit the trails and explore the great outdoors together.\"', 'https://i.postimg.cc/FHjJvX4g/24.jpg', '3535', '2024-04-30 03:52:20', 1, '2024-05-31'),
(27, 'Alvin Ho', 'male', 20, 'callmealvinho@gmail.com', '4b449f23f8ec22288294f0306e242dc9', 'Macau', '189', 'Hi I am a group member of Group 3', 'public/upload/ad/d176c0b08e99d7b0593e8bc415e96a80.jpg', '9971', '2024-04-30 09:49:59', 1, '2024-06-01'),
(28, 'testing', 'male', 21, 'hochanhou@foxmail.com', '16b4762cbc801bbc36b68c257c7a6c57', 'Macau', '180', '111', 'public/upload/ad/668c0005172147cba016557c8f98683a.pic', '9106', '2024-04-30 14:36:45', 1, '2024-06-01'),
(29, 'TSZ CHING WANG', 'other', 18, 'tszching003@outlook.com', '1907b497abc9602d8eaf89422383b17f', '', '', '我系大靓女', 'public/upload/ad/40612ab215af6b8082fb7e7a0e344126.PNG', '6177', '2024-05-01 05:55:07', 0, NULL),
(30, '池昌民', 'male', 28, 'Q@test.com', 'ef3744e4633c16e4dbc117bb0e0dc748', 'Korea', '185', 'Hi I am Q', 'public/upload/ad/aecc4c3e0852c3c4dec92d0353970047.pic', '3792', '2024-05-01 08:38:06', 0, NULL),
(39, 'testing', 'male', 21, 'bc10236@um.edu.mo', 'cb22e792e606f0594d42f147729afa68', NULL, NULL, NULL, 'public/upload/ad/9cb39fb2b989640558b9e4f714ee0a93.pic', '3230', '2024-05-01 13:48:59', 1, '2024-06-01');

-- --------------------------------------------------------

--
-- 表的结构 `ybc_vip`
--

CREATE TABLE `ybc_vip` (
  `id` int(11) NOT NULL,
  `credit_number` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cvv` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `ybc_vip`
--

INSERT INTO `ybc_vip` (`id`, `credit_number`, `name`, `cvv`, `created_at`, `user_id`, `email`) VALUES
(3, '324234234', 'chongqi', '134123', '2024-04-26 03:10:37', 4, '389258742@qq.com'),
(4, '1234512345123456', 'WANG TSZ CHING', '534', '2024-04-28 15:38:07', 12, 'phoebewang003@gmail.com'),
(5, '1234123412341234', 'HO CHAN HOU', '111', '2024-04-28 20:17:26', 15, 'hochanhou@foxmail.com'),
(6, '4324234', 'chongqi', '324324', '2024-04-29 09:14:51', 4, '389258742@qq.com'),
(7, '1234123412341234', 'HOCHANHOU', '111', '2024-04-29 09:31:13', 15, 'hochanhou@foxmail.com'),
(8, '1234123412341234', 'HO CHAN HOU', '333', '2024-04-29 13:06:30', 16, 'bc10236@um.edu.mo'),
(9, '1234123412341234', 'HOCHANHOU', '333', '2024-04-29 13:10:34', 17, '805327309@qq.com'),
(10, '1234567812345678', 'HOCHANHOU', '600', '2024-04-30 03:44:21', 18, 'hochanhou@foxmail.com'),
(11, '1234567812345678', 'HOCHANHOU', '600', '2024-04-30 03:47:46', 19, 'callmealvinho@gmail.com'),
(12, '1234123412341234', 'HOCHANHOU', '500', '2024-04-30 03:52:57', 20, 'callmealvinho@gmail.com'),
(13, '1234123412341234', 'HOCHANHOU', '211', '2024-04-30 05:59:31', 22, 'hochanhou@foxmail.com'),
(14, '23423', '423432', '43242', '2024-04-30 06:01:29', 23, '389258742@qq.com'),
(15, '321432', '432432', '423432', '2024-04-30 06:04:38', 23, '389258742@qq.com'),
(16, '13213', '12312', '21312', '2024-04-30 06:13:16', 23, '389258742@qq.com'),
(17, '13213', '12312', '21312', '2024-04-30 06:15:17', 23, '389258742@qq.com'),
(18, '123', '12312', '3123', '2024-04-30 06:33:26', 24, '389258742@qq.com'),
(19, '123', '12312', '3123', '2024-04-30 06:38:49', 24, '389258742@qq.com'),
(20, '123', '12312', '3123', '2024-04-30 06:39:38', 24, '389258742@qq.com'),
(21, '123', '12312', '3123', '2024-04-30 06:40:27', 24, '389258742@qq.com'),
(22, '1234123412341234', '12', '122', '2024-04-30 06:58:25', 25, 'callmealvinho@gmail.com'),
(23, '1234567812345678', 'HOCHANHOU', '123', '2024-04-30 08:18:01', 26, 'hochanhou@foxmail.com'),
(24, '1234512345123456', 'WANG TSZ CHING', '345', '2024-04-30 11:09:45', 12, 'phoebewang003@gmail.com'),
(25, '1234567812345678', 'Hochanhou', '900', '2024-05-01 03:50:55', 27, 'callmealvinho@gmail.com'),
(26, '12346789', 'abc', '32', '2024-05-01 09:39:03', 31, 'ab@123.com'),
(27, '1234567812345678', 'WANG TSZ CHING', '123', '2024-05-01 10:10:27', 32, 'bc10262@um.edu.mo'),
(28, '135', 'vae', '32/439', '2024-05-01 11:17:28', 33, 'rakirid607@goulink.com'),
(29, '123', 'abc', '123', '2024-05-01 13:09:52', 37, 'io@io.com'),
(30, '111', '111', '1111', '2024-05-01 13:11:38', 38, '111@testing.com'),
(31, '1234567812345678', 'hochanhou', '111', '2024-05-01 13:49:39', 39, 'bc10236@um.edu.mo'),
(32, '1234567812345678', 'HOCHANHOU', '121', '2024-05-01 14:54:12', 28, 'hochanhou@foxmail.com');

--
-- 转储表的索引
--

--
-- 表的索引 `ybc_admin_user`
--
ALTER TABLE `ybc_admin_user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `ybc_info`
--
ALTER TABLE `ybc_info`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `ybc_like`
--
ALTER TABLE `ybc_like`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `ybc_news`
--
ALTER TABLE `ybc_news`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `ybc_users`
--
ALTER TABLE `ybc_users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 表的索引 `ybc_vip`
--
ALTER TABLE `ybc_vip`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ybc_admin_user`
--
ALTER TABLE `ybc_admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `ybc_info`
--
ALTER TABLE `ybc_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用表AUTO_INCREMENT `ybc_like`
--
ALTER TABLE `ybc_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- 使用表AUTO_INCREMENT `ybc_news`
--
ALTER TABLE `ybc_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `ybc_users`
--
ALTER TABLE `ybc_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- 使用表AUTO_INCREMENT `ybc_vip`
--
ALTER TABLE `ybc_vip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
