/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50617
Source Host           : 127.0.0.1:3366
Source Database       : odi_new_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-04-07 19:31:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `role`
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` smallint(2) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) DEFAULT NULL,
  `role_status` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', 'Admin', '1', '2016-03-22 09:44:34', '2016-03-22 09:44:39');
INSERT INTO `role` VALUES ('2', 'Training Management', '1', '2016-03-22 09:44:34', '2016-03-22 09:46:39');
INSERT INTO `role` VALUES ('3', 'Recruitment Management', '1', '2016-03-23 09:48:06', '2016-03-23 09:48:06');
INSERT INTO `role` VALUES ('4', 'Member', '1', '2016-03-22 09:46:52', '2016-03-22 09:44:34');

-- ----------------------------
-- Table structure for `tbl_candidate_cv`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_candidate_cv`;
CREATE TABLE `tbl_candidate_cv` (
  `cv_id` bigint(18) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `job_title` varchar(225) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `document` varchar(100) DEFAULT NULL,
  `comment` varchar(350) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`cv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_candidate_cv
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category` (
  `cat_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(100) DEFAULT NULL,
  `cat_front` tinyint(1) DEFAULT '0',
  `cat_status` tinyint(1) DEFAULT NULL,
  `cat_sequense` smallint(3) DEFAULT NULL,
  `cat_image` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_category
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_category_detail`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category_detail`;
CREATE TABLE `tbl_category_detail` (
  `ctd_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `cat_id` smallint(3) DEFAULT NULL,
  `ctd_title` varchar(225) DEFAULT NULL,
  `ctd_image` varchar(100) DEFAULT NULL,
  `ctd_status` tinyint(1) DEFAULT NULL,
  `ctd_sequense` smallint(5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ctd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_category_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_category_detail_translate`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category_detail_translate`;
CREATE TABLE `tbl_category_detail_translate` (
  `ctdt_id` smallint(8) NOT NULL AUTO_INCREMENT,
  `ctd_id` smallint(5) DEFAULT NULL,
  `lang_id` smallint(2) DEFAULT NULL,
  `ctdt_title` varchar(250) DEFAULT NULL,
  `ctdt_des` text,
  PRIMARY KEY (`ctdt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_category_detail_translate
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_category_translate`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category_translate`;
CREATE TABLE `tbl_category_translate` (
  `catt_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `cat_id` smallint(3) DEFAULT NULL,
  `catt_title` varchar(225) DEFAULT NULL,
  `lang_id` smallint(2) DEFAULT NULL,
  `catt_des` text,
  PRIMARY KEY (`catt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_category_translate
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_content`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_content`;
CREATE TABLE `tbl_content` (
  `con_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `cnt_id` smallint(2) DEFAULT NULL,
  `con_title` varchar(100) DEFAULT NULL,
  `con_remark` varchar(500) DEFAULT NULL,
  `con_front` smallint(1) DEFAULT '0',
  `meta_key` varchar(500) DEFAULT NULL,
  `meta_des` varchar(750) DEFAULT NULL,
  `img_id` smallint(5) DEFAULT NULL,
  `con_plus` tinyint(1) DEFAULT NULL,
  `con_sequense` smallint(5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_content
-- ----------------------------
INSERT INTO `tbl_content` VALUES ('1', '1', 'Home', null, '1', 'Young Shopping Mall, Cambodia, Khmer, Supper markert, Phnom Penh Shopping Mall', 'Musashi Advertising Provice services Mobile Truck Advertising, Indoor IDP Advertising, Graphic Design, Web Design, TV Commercials and Documentaries, Event Management: Press Conference, Post Production, Products Launching, Products Trade Show, Concerts, Grand Opening etc.', null, null, null, '2016-03-09 15:03:25', '2016-03-09 08:03:25');
INSERT INTO `tbl_content` VALUES ('2', '5', 'Contact Us', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.737584325613!2d104.91415691525862!3d11.570660247193569!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31095141f09813f7%3A0x91454b780c8bf512!2sBayon+Super+Market!5e0!3m2!1sen!2skh!4v1459399446782\" width=\"100%\" height=\"500\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0', 'contact my company', '', null, null, null, '2016-03-17 08:32:01', '2016-04-07 04:15:26');
INSERT INTO `tbl_content` VALUES ('3', '1', 'Link for out site', null, '0', null, null, null, null, null, '2016-03-09 10:25:52', '2016-03-09 10:25:52');
INSERT INTO `tbl_content` VALUES ('4', '1', 'Content was remove', null, '0', 'ds', 'sdf', '1', null, null, '2016-03-20 10:10:38', '2016-03-20 10:10:38');
INSERT INTO `tbl_content` VALUES ('5', '4', 'Recruitment', null, '0', '', '', '2', null, null, '2016-03-20 09:58:58', '2016-04-07 05:05:27');
INSERT INTO `tbl_content` VALUES ('7', '4', 'About Us', null, '0', '', '', '3', null, null, '2016-03-19 10:10:18', '2016-04-07 06:33:46');
INSERT INTO `tbl_content` VALUES ('8', '4', 'Submit CV', null, '0', '', '', null, null, null, '2016-04-07 07:13:54', '2016-04-07 07:14:16');
INSERT INTO `tbl_content` VALUES ('9', '4', 'Job Vacancy', null, '0', '', '', null, null, null, '2016-04-07 07:18:42', '2016-04-07 07:18:42');
INSERT INTO `tbl_content` VALUES ('10', '4', 'Outsourcing', null, '0', '', '', null, null, null, '2016-04-07 08:12:49', '2016-04-07 08:12:49');
INSERT INTO `tbl_content` VALUES ('11', '4', 'Training Course', null, '0', '', '', null, null, null, '2016-04-07 09:02:37', '2016-04-07 11:00:33');
INSERT INTO `tbl_content` VALUES ('12', '4', 'HR Advisory', null, '0', '', '', null, null, null, '2016-04-07 10:50:52', '2016-04-07 10:50:52');
INSERT INTO `tbl_content` VALUES ('13', '4', 'Labor Law', null, '0', '', '', null, null, null, '2016-04-07 10:52:15', '2016-04-07 10:52:15');
INSERT INTO `tbl_content` VALUES ('14', '4', 'Upcoming Course', null, '0', '', '', null, null, null, '2016-04-07 11:48:11', '2016-04-07 12:12:00');
INSERT INTO `tbl_content` VALUES ('15', '4', 'Team Building', null, '0', '', '', null, null, null, '2016-04-07 11:50:36', '2016-04-07 12:28:56');
INSERT INTO `tbl_content` VALUES ('16', '4', 'Register Online', null, '0', '', '', null, null, null, '2016-04-07 11:55:05', '2016-04-07 12:29:26');
INSERT INTO `tbl_content` VALUES ('17', '4', 'Customize Training', null, '0', '', '', null, null, null, '2016-04-07 12:23:11', '2016-04-07 12:23:11');

-- ----------------------------
-- Table structure for `tbl_content_translate`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_content_translate`;
CREATE TABLE `tbl_content_translate` (
  `ctt_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `con_id` smallint(3) DEFAULT NULL,
  `ctt_title` varchar(225) DEFAULT NULL,
  `lang_id` smallint(2) DEFAULT NULL,
  `ctt_des` text,
  PRIMARY KEY (`ctt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_content_translate
-- ----------------------------
INSERT INTO `tbl_content_translate` VALUES ('1', '2', 'Contact Us', '1', '<ul class=\"info-odi\">\r\n	<li>: Bayoun Building 4th Floor, No. 33-34, George Dimitrov (St.114),<br />\r\n	Sangkat Monorom, Khan 7 Makara, 12251 Phnom Penh, Cambodia.</li>\r\n	<li>: (855) 23 722 431</li>\r\n	<li>: (855) 77 333 423 / (855) 77 333 424 (Recruitment &amp; Selection),</li>\r\n	<li>: (855) 77 333 534 (Training &amp; Development),</li>\r\n	<li>: (855) 12 754 744 (HR Consulting)</li>\r\n	<li>: odi@odi-asia.com</li>\r\n	<li>: www.odi-asia.com</li>\r\n</ul>\r\n');
INSERT INTO `tbl_content_translate` VALUES ('2', '5', 'Recruitment', '1', '<h3>To our valued client:</h3>\r\n\r\n<p>If you are looking to recruit talented professionals to help strengthen your company, ODI Asia will be your best business partner in staffing assistance.We understand that people are critical assets to the current and future growth of any organization.</p>\r\n\r\n<p><img alt=\"\" src=\"/public/images/1/thumnail-2.jpg\" style=\"float:right\" /> We are here to help fill your vacancies whether they are permanent, fixed-term or temporary. Our recruiting experts use their local and international knowledge, skills, experience, and networks to help you to attract and recruit the best staff. Our expertise allows us to source the right talent at all levels including directors, managers, officers, generalists and specialists for you. We are also able to provide customized service to cater the need of our clients which include sourcing the candidates, screening, administer testing, conducting interview and assessment center.</p>\r\n\r\n<p>We are here to help fill your vacancies whether they are permanent, fixed-term or temporary. Our recruiting experts use their local and international knowledge, skills, experience, and networks to help you to attract and recruit the best staff. Our expertise allows us to source the right talent at all levels including directors, managers, officers, generalists and specialists for you. We are also able to provide customized service to cater the need of our clients which include sourcing the candidates, screening, administer testing, conducting interview and assessment center. Our expertise allows us to source the right talent at all levels including directors, managers, officers, generalists and specialists for you. We are also able to provide customized service to cater the need of our clients which include sourcing the candidates, screening, administer testing, conducting interview and assessment center.</p>\r\n\r\n<p><img alt=\"\" src=\"/public/images/1/thumbnail-1.jpg\" style=\"float:right\" /> We are here to help fill your vacancies whether they are permanent, fixed-term or temporary. Our recruiting experts use their local and international knowledge, skills, experience, and networks to help you to attract and recruit the best staff. Our expertise allows us to source the right talent at all levels including directors, managers, officers, generalists and specialists for you. We are also able to provide customized service to cater the need of our clients which include sourcing the candidates, screening, administer testing, conducting interview and assessment center. Our expertise allows us to source the right talent at all levels including directors, managers, officers, generalists and specialists for you. We are also able to provide customized service to cater the need of our clients which include sourcing the candidates, screening, administer testing, conducting interview and assessment center.</p>\r\n\r\n<p>We are here to help fill your vacancies whether they are permanent, fixed-term or temporary. Our recruiting experts use their local and international knowledge, skills, experience, and networks to help you to attract and recruit the best staff. Our expertise allows us to source the right talent at all levels including directors, managers, officers, generalists and specialists for you. We are also able to provide customized service to cater the need of our clients which include sourcing the candidates, screening, administer testing, conducting interview and assessment center. Our expertise allows us to source the right talent at all levels including directors, managers, officers, generalists and specialists for you. We are also able to provide customized service to cater the need of our clients which include sourcing the candidates, screening, administer testing, conducting interview and assessment center.</p>\r\n\r\n<h3>To our potential candidate:</h3>\r\n\r\n<p><img alt=\"\" src=\"/public/images/1/thumbnail-1.jpg\" style=\"float:left\" /> If you are looking for new career or more challenging job, ODI Asia will be your best partner to assist you in job hunting. We understand how critical it is to find a suitable job that meets your ability, expectation and career aspiration.</p>\r\n\r\n<p>Our recruitment team will get to know you, your abilities, your experience and your preferences. Then they will use their local and international knowledge, skills and network to help you to find the role that suit you best.</p>\r\n');
INSERT INTO `tbl_content_translate` VALUES ('3', '7', 'About Us', '1', '<p>ODI Asia is a business consultancy firm specialized in Human Resources Management. ODI Asia offers quality, professional &amp; expert services: the three key characteristics our clients identified to help them best meet their challenges. We help our clients achieve commercial success through unlocking their people potential. ODI Asia has extensive experience,&nbsp;servicing local and international &nbsp;private companies,​​​ non-government organizations (NGOs), community-based &nbsp; organizations (CBOs), donors and&nbsp;governments.&nbsp;</p>\r\n\r\n<p>At ODI Asia we listen, analyze and advise our clients - we assess our clients&rsquo; needs and develop solutions with our talented staff, advisers and trainers. We have an excellent track record of &nbsp; developing long-standing relationships with leading companies and NGOs to:</p>\r\n\r\n<p><img alt=\"\" src=\"/public/images/1/thumbnail-1.jpg\" style=\"float:right; height:200px; width:300px\" /> Work in partnership with our clients to assess our client&#39;s needs, learn from each other, and develop an ongoing relationship.<br />\r\nCombine our expertise with a pragmatic, down-to-earth approach to deliver solutions that meet the unique needs of each client.<br />\r\nBe accountable to our clients and deliver what we promise &ndash; that is why our clients come back to us again and again.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Our team is comprised of professionals deeply committed to enhancing the organizational &nbsp; &nbsp; &nbsp; &nbsp;capacity and professional lives of our clients. Our rich and varied operational experience within a broad range of business and development sectors means not only can we coach and &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;encourage the growth and development of our clients but we can also take a holistic approach.</p>\r\n\r\n<p><strong>Our Vision:</strong> &ldquo;To be the country leading provider in Human Resource solutions&rdquo;</p>\r\n\r\n<p><strong>Our Mission:</strong> &ldquo;We committed to deliver a quality, professional &amp; expert services to every clients&nbsp;</p>\r\n');
INSERT INTO `tbl_content_translate` VALUES ('4', '8', 'Submit CV', '1', '<P>Welcome to ODI Asia Submit CV Page. Form here you can email to ask our consultant\r\na questtion, apply for specific position you\'ve seen advaertised or register your CV with us for future oppo</p>\r\n<P>By applying or expressin you are plaing us in a position of trust It is a responsilily</p>\r\n');
INSERT INTO `tbl_content_translate` VALUES ('5', '9', 'Job Vacancy', '1', '<p>Welcome to ODI Asia Job&#39;s Page. From here you can view, search and download the detail information of specific role.</p>\r\n');
INSERT INTO `tbl_content_translate` VALUES ('6', '10', 'Outsourcing', '1', '<p>We manage all the administration and legal burdens on behalf of our clients so that they focus on strategic priorities in order to increase market share, proϐit and build shareholders equity. Our outsourcing options can be tailor made to meet unique requirements of each client.</p>\r\n\r\n<h2>Staff Outsourcing</h2>\r\n\r\n<ul>\r\n	<li>Drivers</li>\r\n	<li>Sales and Marketing Field Staff (Junior &ndash; Senior Level)</li>\r\n	<li>Ofϐice Staff (Junior &ndash; Senior Level in all ϐield)</li>\r\n</ul>\r\n\r\n<h2>Payroll Outsourcing</h2>\r\n\r\n<ul>\r\n	<li>Payroll calculation and processing</li>\r\n	<li>NSSF calculation and declaration to NSSF Department Business&nbsp;Process Outsourcing (BPO)</li>\r\n	<li>Tax on salary and fringe beneϐits calculation and declaration to Tax Department</li>\r\n</ul>\r\n\r\n<h2>Business Process Outsourcing (BPO)</h2>\r\n\r\n<ul>\r\n	<li>We handle your day-to-day operations while our client focuses on the big picture</li>\r\n	<li>Finance and Accounting</li>\r\n	<li>Sales Administration</li>\r\n	<li>Staff Performance Management</li>\r\n</ul>\r\n');
INSERT INTO `tbl_content_translate` VALUES ('7', '11', 'Training Course', '1', '<p><img alt=\"\" src=\"/public/images/1/666.jpg\" style=\"float:right; height:180px; margin-left:20px; margin-right:20px; width:350px\" />If you are looking for a quality oriented training course, ODI Asia wills the right training provider to&nbsp;help you develop your staff capacity in order to contribute in your business success. We offer wide&nbsp;range of training course to meet the need of the clients. Our courses are developed and delivered by subject matter experts who provide expertise to<br />\r\nour clients. Our mission is to help you achieve commercial success through unlocking your people potential.</p>\r\n\r\n<p>The training courses are available as both customized and public training. We train in small groups to meet the needs of individual participants and use a variety of learning methods to stimulate interests and meet different learning styles. Participatory techniques include interactive presentations, practical problem-solving activities, case studies that provide a compelling and more comprehensive experience for the participants&mdash;producing a greater return-on-investment for the employers and the participants.</p>\r\n\r\n<p><img alt=\"\" src=\"/public/images/1/555.jpg\" style=\"float:right; height:180px; margin-left:20px; margin-right:20px; width:350px\" />Our team committed to offer an excellence service to ensure the quality of the training and to fulϐill the needs of our clients.</p>\r\n\r\n<p>The Training courses are classiϐied into following categories:</p>\r\n\r\n<ul>\r\n	<li>Leaderships</li>\r\n	<li>Management</li>\r\n	<li>Human Resource</li>\r\n	<li>Sales and Marketing</li>\r\n</ul>\r\n');
INSERT INTO `tbl_content_translate` VALUES ('8', '12', 'HR Advisory', '1', '<p><!--StartFragment --></p>\r\n\r\n<p>ODI Asia provides A-Z HR consulting which all catered to meet the need of each individual client. Our service includes but not limited to:</p>\r\n\r\n<ul>\r\n	<li>Setting up HR department, policies and procedures Staff Manual</li>\r\n	<li>Workforce Planning</li>\r\n	<li>Recruitment Strategy</li>\r\n	<li>Design Test and Assessment Tools</li>\r\n	<li>Employee On-boarding Program</li>\r\n	<li>Training Need Assessment</li>\r\n	<li>Talent Development Program</li>\r\n	<li>Fast Track Development Program</li>\r\n	<li>Mentoring and Coaching Program</li>\r\n	<li>Career Development Program</li>\r\n	<li>Talent Strategy</li>\r\n	<li>Performance Management System</li>\r\n	<li>Performance Improvement Plan</li>\r\n	<li>Reward Strategy</li>\r\n	<li>Salary and Beneϐits Survey</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Job Design, Job Analysis and Job Evaluation Pension / Provident Fund Development Organizational Restructuring<br />\r\nEmployee Relations / Industrial Relations Employee Retention and Succession Planning Employee Engagement Program</p>\r\n');
INSERT INTO `tbl_content_translate` VALUES ('9', '13', 'Labor Law', '1', '<p><!--StartFragment --></p>\r\n\r\n<p>Our expert team can free you up from the challenges and complexity in complying with law requirements.</p>\r\n\r\n<p><!--StartFragment --></p>\r\n\r\n<ul>\r\n	<li>Foreign Employment Book (Work Permit)</li>\r\n	<li>Extend Foreign Employment Book (Work Permit)</li>\r\n	<li>Quota Request (Employment of Foreign Employees)</li>\r\n	<li>Employment Card for Cambodian (Work Book)</li>\r\n	<li>Declaration of Opening and Closing Enterprise</li>\r\n	<li>Staff Declaration (Opening Enterprise)</li>\r\n	<li>Declaration on Staff Movement</li>\r\n	<li>Internal Rules Development and Registration</li>\r\n	<li>NSSF Registration</li>\r\n	<li>AIDS Committee Registration</li>\r\n	<li>Shop Steward / Worker Representative Election</li>\r\n</ul>\r\n');
INSERT INTO `tbl_content_translate` VALUES ('10', '14', 'Upcoming Course', '1', '<p>Below is the public training schedule 2015. For registration or further information on the courses, please contact us through email at training2@odi-asia.com or contact our Training Team via 077 333 534.</p>\r\n\r\n<p><img alt=\"\" src=\"/public/images/1/banner.png\" style=\"height:211px; width:1200px\" /></p>\r\n');
INSERT INTO `tbl_content_translate` VALUES ('11', '15', 'Team Building', '1', '<p><!--StartFragment --></p>\r\n\r\n<p>ODI Asia will work with you to meet the needs of your team in helping the members in your team to create bonds and improve the spirit within your team. We offer you the team building events that will help your teams build cooperation, work together towards common goals and incorporate tools and strategies that can continue to use back at work. All team building activities and events are created.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><!--StartFragment --></p>\r\n\r\n<p>Our facilitator team will guide you through each team building event, keep your teams on track and assist in any and every way necessary to insure your participants get the most out of every team building event and activity.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Our service includes:</h3>\r\n\r\n<ul>\r\n	<li>Outdoor and Indoor team building</li>\r\n	<li>Staff retreat/ Annual Conference</li>\r\n	<li>Amazing Race</li>\r\n</ul>\r\n');
INSERT INTO `tbl_content_translate` VALUES ('12', '16', 'Register Online', '1', '<p><!--StartFragment --></p>\r\n\r\n<p>If you would like to register with ODI Asia public training courses, please complete the following registration form.</p>\r\n');
INSERT INTO `tbl_content_translate` VALUES ('13', '17', 'Customize Training', '1', '<p><!--StartFragment --></p>\r\n\r\n<p>ODI Asia offers diverse training course to meet the needs of the clients. The following training offered by ODI Asia can be conducted over one, two or five days depending on the depth and intensity of the course.</p>\r\n\r\n<p><img alt=\"\" src=\"/public/images/1/training_thumbnail_1.jpg\" style=\"float:right; height:221px; margin-left:10px; margin-right:10px; width:300px\" />ODI Asia conducts training needs assessment<br />\r\nand participant assessments to ensure the appropriate training is conducted at the appropriate level to maximize results. We also<br />\r\nmeet with the participants and/or the company<br />\r\nto customize case studies.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"/public/images/1/training_thumbnail_2.jpg\" style=\"float:left; height:224px; margin-left:10px; margin-right:10px; width:300px\" />Our customized training can be designed and delivered on a wide range of format and location such as training that held in venue outside of town or during company retreat. The training is available in English and Khmer though usually our training material is available in English.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Below are some of our training courses:</p>\r\n');

-- ----------------------------
-- Table structure for `tbl_content_type`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_content_type`;
CREATE TABLE `tbl_content_type` (
  `cnt_id` smallint(2) NOT NULL AUTO_INCREMENT,
  `cnt_title` varchar(50) DEFAULT NULL,
  `cnt_des` varchar(150) DEFAULT NULL,
  `cnt_status` smallint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`cnt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_content_type
-- ----------------------------
INSERT INTO `tbl_content_type` VALUES ('1', 'Home', null, '0', '2016-03-07 17:07:37', '2016-03-07 17:07:37');
INSERT INTO `tbl_content_type` VALUES ('2', 'Category', null, '0', '2016-03-22 10:16:31', '2016-03-22 10:16:31');
INSERT INTO `tbl_content_type` VALUES ('3', 'Gallery', null, '0', '2016-03-22 10:16:37', '2016-03-22 10:16:37');
INSERT INTO `tbl_content_type` VALUES ('4', 'Article', null, '1', '2016-03-08 10:58:27', '2016-03-08 10:58:27');
INSERT INTO `tbl_content_type` VALUES ('5', 'Contact', null, '1', '2016-03-03 08:38:53', '2016-03-03 08:38:38');
INSERT INTO `tbl_content_type` VALUES ('6', 'Slideshow', null, '0', '2016-03-21 15:24:50', '2016-03-21 15:24:50');

-- ----------------------------
-- Table structure for `tbl_gallery`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_gallery`;
CREATE TABLE `tbl_gallery` (
  `gal_id` smallint(10) NOT NULL AUTO_INCREMENT,
  `gal_title` varchar(450) DEFAULT NULL,
  `gal_status` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`gal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_gallery
-- ----------------------------
INSERT INTO `tbl_gallery` VALUES ('1', 'Partners', '1', '2016-04-06 04:30:47', '2016-04-06 04:30:50');

-- ----------------------------
-- Table structure for `tbl_image`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_image`;
CREATE TABLE `tbl_image` (
  `img_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `conditional_id` smallint(5) DEFAULT NULL,
  `img_title` varchar(100) DEFAULT NULL,
  `img_name` varchar(150) DEFAULT NULL,
  `img_content` text,
  `img_position` tinyint(1) DEFAULT NULL,
  `img_status` tinyint(1) DEFAULT NULL,
  `conditional_type` smallint(2) DEFAULT NULL,
  `img_sequense` smallint(5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_image
-- ----------------------------
INSERT INTO `tbl_image` VALUES ('1', null, 'Training', 's_12166341.jpg', '<h1>TRAINING and CAPACITY BUILDING</h1>\r\n\r\n<p>We bring out the best in you for your sustainable development!</p>\r\n', '2', '1', '6', '1', '2016-04-06 01:53:04', null);
INSERT INTO `tbl_image` VALUES ('2', null, 'Recruitment', 's_42586262.jpg', '<h1>Recruitment and Selection</h1>\r\n\r\n<p>We commit to help our clients achieve a competitive&nbsp;advantage<br />\r\nthrough their people.</p>\r\n', '4', '1', '6', '2', '2016-04-06 02:32:39', '2016-04-06 02:36:25');
INSERT INTO `tbl_image` VALUES ('3', null, 'About Us', 's_60112847.jpg', '', '0', '0', '6', '7', '2016-04-06 02:39:02', '2016-04-06 03:14:52');
INSERT INTO `tbl_image` VALUES ('4', null, 'HR Advisory', 's_21720377.jpg', '<h1>HR Advisory</h1>\r\n\r\n<p>We understand our client businesses and needs,<br />\r\nand we offer practical and tested solutions that<br />\r\ndeliver mesurable value.</p>\r\n', '2', '1', '6', '4', '2016-04-06 02:51:39', null);
INSERT INTO `tbl_image` VALUES ('5', null, 'Labor Law Compliance', 's_69064670.jpg', '<h1>Labor Law Compliance</h1>\r\n\r\n<p>We help you to comply with Cambodian Labor Law!</p>\r\n', '4', '1', '6', '5', '2016-04-06 02:54:26', null);
INSERT INTO `tbl_image` VALUES ('6', null, 'Outsourcing', 's_22648111.jpg', '<h1>Outsourcing</h1>\r\n\r\n<p>Let us bear all&nbsp;<br />\r\nthe burdenfor you!</p>\r\n', '2', '1', '6', '3', '2016-04-06 03:00:56', null);
INSERT INTO `tbl_image` VALUES ('7', null, 'Team Building', 's_68614366.jpg', '<h1>Team Building</h1>\r\n\r\n<p>Teamwork makes the dream work.<br />\r\nLet us help you make your dream work!</p>\r\n', '2', '1', '6', '6', '2016-04-06 03:19:02', null);
INSERT INTO `tbl_image` VALUES ('8', '1', null, 'g_1459917206.png', null, null, null, '3', null, '2016-04-06 04:33:26', null);
INSERT INTO `tbl_image` VALUES ('9', '1', null, 'g_1459917219.png', null, null, null, '3', null, '2016-04-06 04:33:39', null);
INSERT INTO `tbl_image` VALUES ('10', '1', null, 'g_1459917230.png', null, null, null, '3', null, '2016-04-06 04:33:50', null);
INSERT INTO `tbl_image` VALUES ('11', '1', null, 'g_1459917240.png', null, null, null, '3', null, '2016-04-06 04:34:00', null);
INSERT INTO `tbl_image` VALUES ('12', '1', null, 'g_1459917249.png', null, null, null, '3', null, '2016-04-06 04:34:09', null);
INSERT INTO `tbl_image` VALUES ('13', '1', null, 'g_1459917287.png', null, null, null, '3', null, '2016-04-06 04:34:47', null);
INSERT INTO `tbl_image` VALUES ('15', null, 'Contact Us', 's_45928276.jpg', '', '0', '0', '6', '8', '2016-04-07 03:50:05', '2016-04-07 03:50:09');

-- ----------------------------
-- Table structure for `tbl_job_alert`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_job_alert`;
CREATE TABLE `tbl_job_alert` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `can_id` int(11) DEFAULT NULL,
  `can_email` varchar(80) DEFAULT NULL,
  `cat_id` varchar(20) DEFAULT NULL,
  `frequency` tinyint(1) DEFAULT '1',
  `job_title` varchar(225) DEFAULT NULL,
  `set_time` varchar(50) DEFAULT NULL,
  `set_salary` int(11) DEFAULT NULL,
  `set_nego` tinyint(1) DEFAULT '0',
  `list_job_id` longtext,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_job_alert
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_job_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_job_category`;
CREATE TABLE `tbl_job_category` (
  `cat_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(225) DEFAULT NULL,
  `sequence` int(6) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `cat_img` varchar(225) NOT NULL,
  `num_view` smallint(11) DEFAULT '0',
  `num_active` smallint(11) DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_job_category
-- ----------------------------
INSERT INTO `tbl_job_category` VALUES ('1', 'Accounting  / Financial', '10', '1', 'accounting-finance.jpg', '84', null);
INSERT INTO `tbl_job_category` VALUES ('2', 'Administrative', '20', '1', 'administrative.jpg', '41', null);
INSERT INTO `tbl_job_category` VALUES ('3', 'Advertising / Media', '30', '1', 'advertising-media.jpg', '3', null);
INSERT INTO `tbl_job_category` VALUES ('4', 'Architecture', '40', '1', 'architecture.jpg', '14', null);
INSERT INTO `tbl_job_category` VALUES ('5', 'Arts / Creative Design', '50', '1', 'art-creative-designer.jpg', '15', null);
INSERT INTO `tbl_job_category` VALUES ('6', 'Assistant / Secretary', '60', '1', 'assistant-secretary.jpg', '11', null);
INSERT INTO `tbl_job_category` VALUES ('7', 'Audit / Taxation', '70', '1', 'audit.jpg', '3', null);
INSERT INTO `tbl_job_category` VALUES ('8', 'Automotive / Vehicle', '80', '1', 'automotive.jpg', '1', null);
INSERT INTO `tbl_job_category` VALUES ('9', 'Banking / Insurance', '90', '1', 'banking-insurance.jpg', '6', null);
INSERT INTO `tbl_job_category` VALUES ('10', 'Catering / Fast Food / Restaurant', '100', '1', 'catering-fast-food.jpg', '6', null);
INSERT INTO `tbl_job_category` VALUES ('11', 'Consultancy', '110', '1', 'consultancy.jpg', '4', null);
INSERT INTO `tbl_job_category` VALUES ('12', 'Construction / Engineering', '120', '1', 'construction-engineering.jpg', '21', null);
INSERT INTO `tbl_job_category` VALUES ('13', 'Cosmetic Services', '130', '1', 'cosmetic-service.jpg', '2', null);
INSERT INTO `tbl_job_category` VALUES ('14', 'Customer Service', '140', '1', 'customer-service.jpg', '39', null);
INSERT INTO `tbl_job_category` VALUES ('15', 'Doctor / Diagnosis', '150', '1', 'doctor.jpg', '0', null);
INSERT INTO `tbl_job_category` VALUES ('16', 'Education / Teaching', '160', '1', 'education-teaching.jpg', '21', null);
INSERT INTO `tbl_job_category` VALUES ('17', 'Electronic / Electrical / Equipment', '170', '1', 'electronic-electric-equipment.jpg', '1', null);
INSERT INTO `tbl_job_category` VALUES ('18', 'Energy / Oil / Gasoline', '180', '1', 'energy-oil-gasoline.jpg', '0', null);
INSERT INTO `tbl_job_category` VALUES ('19', 'Entertainment', '190', '1', 'entertainment.jpg', '1', null);
INSERT INTO `tbl_job_category` VALUES ('20', 'Food & Beverages', '200', '1', 'food-beverage.jpg', '11', null);
INSERT INTO `tbl_job_category` VALUES ('21', 'Freight / Shipping / Delivery', '210', '1', 'freight-shipping-delivery.jpg', '10', null);
INSERT INTO `tbl_job_category` VALUES ('22', 'General Business Services', '220', '1', 'general-business.jpg', '4', null);
INSERT INTO `tbl_job_category` VALUES ('23', 'Government', '230', '1', 'government.jpg', '0', null);
INSERT INTO `tbl_job_category` VALUES ('24', 'Human Resources / Consultant', '240', '1', 'human-resource.jpg', '21', null);
INSERT INTO `tbl_job_category` VALUES ('25', 'Information Technology', '250', '1', 'information-technology.jpg', '35', null);
INSERT INTO `tbl_job_category` VALUES ('26', 'Jewellery / Gems / Watches', '260', '1', 'jewelry-gems-watch.jpg', '0', null);
INSERT INTO `tbl_job_category` VALUES ('27', 'Journalist / Editor / Publishing', '270', '1', 'journalist-editor-publishing.jpg', '5', null);
INSERT INTO `tbl_job_category` VALUES ('28', 'Lawyer / Legal Services', '280', '1', 'law-legal-service.jpg', '2', null);
INSERT INTO `tbl_job_category` VALUES ('29', 'Management', '290', '1', 'management.jpg', '30', null);
INSERT INTO `tbl_job_category` VALUES ('30', 'Manufacturing', '300', '1', 'manufactory.jpg', '18', null);
INSERT INTO `tbl_job_category` VALUES ('31', 'Marketing', '310', '1', 'marketing.jpg', '54', null);
INSERT INTO `tbl_job_category` VALUES ('32', 'Medical / Health / Nursing', '320', '1', 'medical-health-nurse.jpg', '10', null);
INSERT INTO `tbl_job_category` VALUES ('33', 'Merchandising / Purchasing', '330', '1', 'marchandise.jpg', '8', null);
INSERT INTO `tbl_job_category` VALUES ('34', 'Operation', '340', '1', 'operation.jpg', '12', null);
INSERT INTO `tbl_job_category` VALUES ('35', 'Project Management', '350', '1', 'project-management.jpg', '7', null);
INSERT INTO `tbl_job_category` VALUES ('36', 'Property / Real Estate', '360', '1', 'property-real-estate.jpg', '1', null);
INSERT INTO `tbl_job_category` VALUES ('37', 'Quality Control', '370', '1', 'quality-control.jpg', '12', null);
INSERT INTO `tbl_job_category` VALUES ('38', 'Restaurant / Hotel / Casino', '380', '1', 'restaurant-hotel-casina.jpg', '17', null);
INSERT INTO `tbl_job_category` VALUES ('39', 'Sale', '390', '1', 'sales.jpg', '147', null);
INSERT INTO `tbl_job_category` VALUES ('40', 'Security guard / Driver', '400', '1', 'security.jpg', '13', null);
INSERT INTO `tbl_job_category` VALUES ('41', 'Technician', '410', '1', 'technician.jpg', '13', null);
INSERT INTO `tbl_job_category` VALUES ('42', 'Telecommunication', '420', '1', 'telecommunication.jpg', '2', null);
INSERT INTO `tbl_job_category` VALUES ('43', 'Tourism / Guide', '430', '1', 'tourism-guide.jpg', '1', null);
INSERT INTO `tbl_job_category` VALUES ('44', 'Trading / Import-Export', '440', '1', 'trading-import-export.jpg', '3', null);
INSERT INTO `tbl_job_category` VALUES ('45', 'Training / Development', '450', '1', 'training-development.jpg', '10', null);
INSERT INTO `tbl_job_category` VALUES ('46', 'Translation / Interpretation', '460', '1', 'translate-interpreter.jpg', '26', null);
INSERT INTO `tbl_job_category` VALUES ('47', 'Travel Agent / Ticket Sales', '470', '1', 'travel-agency.jpg', '6', null);
INSERT INTO `tbl_job_category` VALUES ('48', 'Volunteer', '480', '1', 'volunteer.jpg', '1', null);
INSERT INTO `tbl_job_category` VALUES ('49', 'Other', '490', '1', 'others.jpg', '93', null);

-- ----------------------------
-- Table structure for `tbl_job_location`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_job_location`;
CREATE TABLE `tbl_job_location` (
  `loc_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `loc_name` varchar(225) DEFAULT NULL,
  `sequence` smallint(6) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `num_view` smallint(11) DEFAULT '0',
  `num_active` smallint(11) DEFAULT '0',
  PRIMARY KEY (`loc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_job_location
-- ----------------------------
INSERT INTO `tbl_job_location` VALUES ('1', 'Phnom Penh', '10', '1', '777', '0');
INSERT INTO `tbl_job_location` VALUES ('2', 'Province', '20', '1', '12', '0');
INSERT INTO `tbl_job_location` VALUES ('3', 'Siem Reap', '30', '1', '12', '0');
INSERT INTO `tbl_job_location` VALUES ('4', 'Preah Sihanouk', '40', '1', '9', '0');
INSERT INTO `tbl_job_location` VALUES ('5', 'Banlung', '50', '1', '0', '0');
INSERT INTO `tbl_job_location` VALUES ('6', 'Banteay Meanchey', '60', '1', '2', '0');
INSERT INTO `tbl_job_location` VALUES ('7', 'Battambang', '70', '1', '2', '0');
INSERT INTO `tbl_job_location` VALUES ('8', 'Bavet', '80', '1', '3', '0');
INSERT INTO `tbl_job_location` VALUES ('9', 'Kampong Cham', '90', '1', '2', '0');
INSERT INTO `tbl_job_location` VALUES ('10', 'Kampong Chhnang', '100', '1', '3', '0');
INSERT INTO `tbl_job_location` VALUES ('11', 'Kampong Speu', '110', '1', '4', '0');
INSERT INTO `tbl_job_location` VALUES ('12', 'Kampong Thom', '120', '1', '2', '0');
INSERT INTO `tbl_job_location` VALUES ('13', 'Kampot', '130', '1', '3', '0');
INSERT INTO `tbl_job_location` VALUES ('14', 'Kandal', '140', '1', '2', '0');
INSERT INTO `tbl_job_location` VALUES ('15', 'Kep', '150', '1', '1', '0');
INSERT INTO `tbl_job_location` VALUES ('16', 'Koh Kong', '160', '1', '1', '0');
INSERT INTO `tbl_job_location` VALUES ('17', 'Takhmao', '170', '1', '1', '0');
INSERT INTO `tbl_job_location` VALUES ('18', 'Kratie', '180', '1', '1', '0');
INSERT INTO `tbl_job_location` VALUES ('19', 'Mondulkiri', '190', '1', '2', '0');
INSERT INTO `tbl_job_location` VALUES ('20', 'Oddor Meanchey', '200', '1', '2', '0');
INSERT INTO `tbl_job_location` VALUES ('21', 'Pailin', '210', '1', '2', '0');
INSERT INTO `tbl_job_location` VALUES ('22', 'Poipet', '220', '1', '2', '0');
INSERT INTO `tbl_job_location` VALUES ('23', 'Preah Vihear', '230', '1', '2', '0');
INSERT INTO `tbl_job_location` VALUES ('24', 'Prey Veng', '240', '1', '0', '0');
INSERT INTO `tbl_job_location` VALUES ('25', 'Pursat', '250', '1', '1', '0');
INSERT INTO `tbl_job_location` VALUES ('26', 'Rattanakiri', '260', '1', '1', '0');
INSERT INTO `tbl_job_location` VALUES ('27', 'Sre Ambel', '270', '1', '0', '0');
INSERT INTO `tbl_job_location` VALUES ('28', 'Stung Treng', '280', '1', '0', '0');
INSERT INTO `tbl_job_location` VALUES ('29', 'Svay Rieng', '290', '1', '8', '0');
INSERT INTO `tbl_job_location` VALUES ('30', 'Takeo', '300', '1', '1', '0');
INSERT INTO `tbl_job_location` VALUES ('31', 'Tboung Khum', '310', '1', '1', '0');

-- ----------------------------
-- Table structure for `tbl_job_vacancy`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_job_vacancy`;
CREATE TABLE `tbl_job_vacancy` (
  `job_id` bigint(12) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(100) DEFAULT NULL,
  `job_des` text,
  `job_required` text,
  `post_date` date DEFAULT NULL,
  `close_date` date DEFAULT NULL,
  `cat_id` smallint(2) DEFAULT NULL,
  `loc_id` smallint(2) DEFAULT NULL,
  `created_by` smallint(3) DEFAULT NULL,
  `expired_status` tinyint(1) DEFAULT '0',
  `how_apply` varchar(500) DEFAULT NULL,
  `publish` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_job_vacancy
-- ----------------------------
INSERT INTO `tbl_job_vacancy` VALUES ('1', 'Accountant', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Serve clients in terms of marketing and advertising supports in order to build clients&rsquo; brands in the market successfully</li>\r\n	<li>Co-operate both internal and external parties to complete services</li>\r\n	<li>Follow up job progress and control time schedule</li>\r\n	<li>Present effective marketing and advertising support activities to clients</li>\r\n	<li>Evaluate and Report result of marketing and advertising support activities as well as movement of competitors to clients</li>\r\n	<li>Report current situation/ performance quarterly to Client&rsquo;s Top executives</li>\r\n	<li>Arrange meeting with clients outside/inside the office</li>\r\n	<li>Maintain good relationship with clients</li>\r\n</ul>\r\n</div>\r\n', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Bachelor or Master Degree in Business Administration, Marketing, Mass Communication</li>\r\n	<li>Advertising or other related fields</li>\r\n	<li>1-3 year work experiences for Account Executive in Advertising Agencies Company</li>\r\n	<li>A good understanding on IMC (all of knowledge of ATL and BTL) and brand concept to coordinate across working team between online and offline team</li>\r\n	<li>Good command of reading, writing and speaking English</li>\r\n	<li>Proficiency in computer skills program MS Office (Word, Excel and PowerPoint)</li>\r\n	<li>Excellent communication skills</li>\r\n	<li>Energetic able to work under pressure</li>\r\n	<li>Pleasant personality and service mind</li>\r\n	<li>Strong communication and presentation skills</li>\r\n	<li>Energetic, well handle with pressure, self-motivated, and looking for a challenge</li>\r\n</ul>\r\n</div>\r\n', '2016-04-07', '2016-05-07', '1', '1', '1', '0', '<p>Interested applicants meeting the above requirements should send their CV and cover letter to <strong style=\"color:#00ADEF\">recruitment@odi-asia.com </strong>with the expected salary before <strong>07 May, 2016</strong>. Please kindly state.</p>\r\n', '1', '2016-04-07 07:46:28', null);
INSERT INTO `tbl_job_vacancy` VALUES ('2', 'Administrator Supervisor', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Serve clients in terms of marketing and advertising supports in order to build clients&rsquo; brands in the market successfully</li>\r\n	<li>Co-operate both internal and external parties to complete services</li>\r\n	<li>Follow up job progress and control time schedule</li>\r\n	<li>Present effective marketing and advertising support activities to clients</li>\r\n	<li>Evaluate and Report result of marketing and advertising support activities as well as movement of competitors to clients</li>\r\n	<li>Report current situation/ performance quarterly to Client&rsquo;s Top executives</li>\r\n	<li>Arrange meeting with clients outside/inside the office</li>\r\n	<li>Maintain good relationship with clients</li>\r\n</ul>\r\n</div>\r\n', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Bachelor or Master Degree in Business Administration, Marketing, Mass Communication</li>\r\n	<li>Advertising or other related fields</li>\r\n	<li>1-3 year work experiences for Account Executive in Advertising Agencies Company</li>\r\n	<li>A good understanding on IMC (all of knowledge of ATL and BTL) and brand concept to coordinate across working team between online and offline team</li>\r\n	<li>Good command of reading, writing and speaking English</li>\r\n	<li>Proficiency in computer skills program MS Office (Word, Excel and PowerPoint)</li>\r\n	<li>Excellent communication skills</li>\r\n	<li>Energetic able to work under pressure</li>\r\n	<li>Pleasant personality and service mind</li>\r\n	<li>Strong communication and presentation skills</li>\r\n	<li>Energetic, well handle with pressure, self-motivated, and looking for a challenge</li>\r\n</ul>\r\n</div>\r\n', '2016-04-07', '2016-05-07', '1', '1', '1', '0', '<p>Interested applicants meeting the above requirements should send their CV and cover letter to <strong style=\"color:#00ADEF\">recruitment@odi-asia.com </strong>with the expected salary before <strong>07 May, 2016</strong>. Please kindly state.</p>\r\n', '1', '2016-04-07 07:47:15', null);
INSERT INTO `tbl_job_vacancy` VALUES ('3', 'Electrical Engineer', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Serve clients in terms of marketing and advertising supports in order to build clients&rsquo; brands in the market successfully</li>\r\n	<li>Co-operate both internal and external parties to complete services</li>\r\n	<li>Follow up job progress and control time schedule</li>\r\n	<li>Present effective marketing and advertising support activities to clients</li>\r\n	<li>Evaluate and Report result of marketing and advertising support activities as well as movement of competitors to clients</li>\r\n	<li>Report current situation/ performance quarterly to Client&rsquo;s Top executives</li>\r\n	<li>Arrange meeting with clients outside/inside the office</li>\r\n	<li>Maintain good relationship with clients</li>\r\n</ul>\r\n</div>\r\n', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Bachelor or Master Degree in Business Administration, Marketing, Mass Communication</li>\r\n	<li>Advertising or other related fields</li>\r\n	<li>1-3 year work experiences for Account Executive in Advertising Agencies Company</li>\r\n	<li>A good understanding on IMC (all of knowledge of ATL and BTL) and brand concept to coordinate across working team between online and offline team</li>\r\n	<li>Good command of reading, writing and speaking English</li>\r\n	<li>Proficiency in computer skills program MS Office (Word, Excel and PowerPoint)</li>\r\n	<li>Excellent communication skills</li>\r\n	<li>Energetic able to work under pressure</li>\r\n	<li>Pleasant personality and service mind</li>\r\n	<li>Strong communication and presentation skills</li>\r\n	<li>Energetic, well handle with pressure, self-motivated, and looking for a challenge</li>\r\n</ul>\r\n</div>\r\n', '2016-04-07', '2016-05-07', '17', '1', '1', '0', '<p>Interested applicants meeting the above requirements should send their CV and cover letter to <strong style=\"color:#00ADEF\">recruitment@odi-asia.com </strong>with the expected salary before <strong>07 May, 2016</strong>. Please kindly state.</p>\r\n', '1', '2016-04-07 07:47:50', null);
INSERT INTO `tbl_job_vacancy` VALUES ('4', 'Recruitment Officer', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Serve clients in terms of marketing and advertising supports in order to build clients&rsquo; brands in the market successfully</li>\r\n	<li>Co-operate both internal and external parties to complete services</li>\r\n	<li>Follow up job progress and control time schedule</li>\r\n	<li>Present effective marketing and advertising support activities to clients</li>\r\n	<li>Evaluate and Report result of marketing and advertising support activities as well as movement of competitors to clients</li>\r\n	<li>Report current situation/ performance quarterly to Client&rsquo;s Top executives</li>\r\n	<li>Arrange meeting with clients outside/inside the office</li>\r\n	<li>Maintain good relationship with clients</li>\r\n</ul>\r\n</div>\r\n', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Bachelor or Master Degree in Business Administration, Marketing, Mass Communication</li>\r\n	<li>Advertising or other related fields</li>\r\n	<li>1-3 year work experiences for Account Executive in Advertising Agencies Company</li>\r\n	<li>A good understanding on IMC (all of knowledge of ATL and BTL) and brand concept to coordinate across working team between online and offline team</li>\r\n	<li>Good command of reading, writing and speaking English</li>\r\n	<li>Proficiency in computer skills program MS Office (Word, Excel and PowerPoint)</li>\r\n	<li>Excellent communication skills</li>\r\n	<li>Energetic able to work under pressure</li>\r\n	<li>Pleasant personality and service mind</li>\r\n	<li>Strong communication and presentation skills</li>\r\n	<li>Energetic, well handle with pressure, self-motivated, and looking for a challenge</li>\r\n</ul>\r\n</div>\r\n', '2016-04-07', '2016-05-07', '24', '1', '1', '0', '<p>Interested applicants meeting the above requirements should send their CV and cover letter to <strong style=\"color:#00ADEF\">recruitment@odi-asia.com </strong>with the expected salary before <strong>07 May, 2016</strong>. Please kindly state.</p>\r\n', '1', '2016-04-07 07:48:20', null);
INSERT INTO `tbl_job_vacancy` VALUES ('5', 'Marketing Officer', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Serve clients in terms of marketing and advertising supports in order to build clients&rsquo; brands in the market successfully</li>\r\n	<li>Co-operate both internal and external parties to complete services</li>\r\n	<li>Follow up job progress and control time schedule</li>\r\n	<li>Present effective marketing and advertising support activities to clients</li>\r\n	<li>Evaluate and Report result of marketing and advertising support activities as well as movement of competitors to clients</li>\r\n	<li>Report current situation/ performance quarterly to Client&rsquo;s Top executives</li>\r\n	<li>Arrange meeting with clients outside/inside the office</li>\r\n	<li>Maintain good relationship with clients</li>\r\n</ul>\r\n</div>\r\n', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Bachelor or Master Degree in Business Administration, Marketing, Mass Communication</li>\r\n	<li>Advertising or other related fields</li>\r\n	<li>1-3 year work experiences for Account Executive in Advertising Agencies Company</li>\r\n	<li>A good understanding on IMC (all of knowledge of ATL and BTL) and brand concept to coordinate across working team between online and offline team</li>\r\n	<li>Good command of reading, writing and speaking English</li>\r\n	<li>Proficiency in computer skills program MS Office (Word, Excel and PowerPoint)</li>\r\n	<li>Excellent communication skills</li>\r\n	<li>Energetic able to work under pressure</li>\r\n	<li>Pleasant personality and service mind</li>\r\n	<li>Strong communication and presentation skills</li>\r\n	<li>Energetic, well handle with pressure, self-motivated, and looking for a challenge</li>\r\n</ul>\r\n</div>\r\n', '2016-04-07', '2016-05-07', '31', '1', '1', '0', '', '1', '2016-04-07 07:48:56', null);
INSERT INTO `tbl_job_vacancy` VALUES ('6', 'IT Manager', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Serve clients in terms of marketing and advertising supports in order to build clients&rsquo; brands in the market successfully</li>\r\n	<li>Co-operate both internal and external parties to complete services</li>\r\n	<li>Follow up job progress and control time schedule</li>\r\n	<li>Present effective marketing and advertising support activities to clients</li>\r\n	<li>Evaluate and Report result of marketing and advertising support activities as well as movement of competitors to clients</li>\r\n	<li>Report current situation/ performance quarterly to Client&rsquo;s Top executives</li>\r\n	<li>Arrange meeting with clients outside/inside the office</li>\r\n	<li>Maintain good relationship with clients</li>\r\n</ul>\r\n</div>\r\n', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Bachelor or Master Degree in Business Administration, Marketing, Mass Communication</li>\r\n	<li>Advertising or other related fields</li>\r\n	<li>1-3 year work experiences for Account Executive in Advertising Agencies Company</li>\r\n	<li>A good understanding on IMC (all of knowledge of ATL and BTL) and brand concept to coordinate across working team between online and offline team</li>\r\n	<li>Good command of reading, writing and speaking English</li>\r\n	<li>Proficiency in computer skills program MS Office (Word, Excel and PowerPoint)</li>\r\n	<li>Excellent communication skills</li>\r\n	<li>Energetic able to work under pressure</li>\r\n	<li>Pleasant personality and service mind</li>\r\n	<li>Strong communication and presentation skills</li>\r\n	<li>Energetic, well handle with pressure, self-motivated, and looking for a challenge</li>\r\n</ul>\r\n</div>\r\n', '2016-04-07', '2016-05-07', '25', '1', '1', '0', '', '1', '2016-04-07 07:49:30', null);
INSERT INTO `tbl_job_vacancy` VALUES ('7', 'Assistant to Finance & Accounting Manager', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Serve clients in terms of marketing and advertising supports in order to build clients&rsquo; brands in the market successfully</li>\r\n	<li>Co-operate both internal and external parties to complete services</li>\r\n	<li>Follow up job progress and control time schedule</li>\r\n	<li>Present effective marketing and advertising support activities to clients</li>\r\n	<li>Evaluate and Report result of marketing and advertising support activities as well as movement of competitors to clients</li>\r\n	<li>Report current situation/ performance quarterly to Client&rsquo;s Top executives</li>\r\n	<li>Arrange meeting with clients outside/inside the office</li>\r\n	<li>Maintain good relationship with clients</li>\r\n</ul>\r\n</div>\r\n', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Bachelor or Master Degree in Business Administration, Marketing, Mass Communication</li>\r\n	<li>Advertising or other related fields</li>\r\n	<li>1-3 year work experiences for Account Executive in Advertising Agencies Company</li>\r\n	<li>A good understanding on IMC (all of knowledge of ATL and BTL) and brand concept to coordinate across working team between online and offline team</li>\r\n	<li>Good command of reading, writing and speaking English</li>\r\n	<li>Proficiency in computer skills program MS Office (Word, Excel and PowerPoint)</li>\r\n	<li>Excellent communication skills</li>\r\n	<li>Energetic able to work under pressure</li>\r\n	<li>Pleasant personality and service mind</li>\r\n	<li>Strong communication and presentation skills</li>\r\n	<li>Energetic, well handle with pressure, self-motivated, and looking for a challenge</li>\r\n</ul>\r\n</div>\r\n', '2016-04-07', '2016-05-07', '1', '1', '1', '0', '', '1', '2016-04-07 07:50:15', null);
INSERT INTO `tbl_job_vacancy` VALUES ('8', 'Internal Audit Manager', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Serve clients in terms of marketing and advertising supports in order to build clients&rsquo; brands in the market successfully</li>\r\n	<li>Co-operate both internal and external parties to complete services</li>\r\n	<li>Follow up job progress and control time schedule</li>\r\n	<li>Present effective marketing and advertising support activities to clients</li>\r\n	<li>Evaluate and Report result of marketing and advertising support activities as well as movement of competitors to clients</li>\r\n	<li>Report current situation/ performance quarterly to Client&rsquo;s Top executives</li>\r\n	<li>Arrange meeting with clients outside/inside the office</li>\r\n	<li>Maintain good relationship with clients</li>\r\n</ul>\r\n</div>\r\n', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Bachelor or Master Degree in Business Administration, Marketing, Mass Communication</li>\r\n	<li>Advertising or other related fields</li>\r\n	<li>1-3 year work experiences for Account Executive in Advertising Agencies Company</li>\r\n	<li>A good understanding on IMC (all of knowledge of ATL and BTL) and brand concept to coordinate across working team between online and offline team</li>\r\n	<li>Good command of reading, writing and speaking English</li>\r\n	<li>Proficiency in computer skills program MS Office (Word, Excel and PowerPoint)</li>\r\n	<li>Excellent communication skills</li>\r\n	<li>Energetic able to work under pressure</li>\r\n	<li>Pleasant personality and service mind</li>\r\n	<li>Strong communication and presentation skills</li>\r\n	<li>Energetic, well handle with pressure, self-motivated, and looking for a challenge</li>\r\n</ul>\r\n</div>\r\n', '2016-04-07', '2016-05-07', '7', '1', '1', '0', '', '1', '2016-04-07 07:51:15', null);
INSERT INTO `tbl_job_vacancy` VALUES ('9', 'Purchasing Officer', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Serve clients in terms of marketing and advertising supports in order to build clients&rsquo; brands in the market successfully</li>\r\n	<li>Co-operate both internal and external parties to complete services</li>\r\n	<li>Follow up job progress and control time schedule</li>\r\n	<li>Present effective marketing and advertising support activities to clients</li>\r\n	<li>Evaluate and Report result of marketing and advertising support activities as well as movement of competitors to clients</li>\r\n	<li>Report current situation/ performance quarterly to Client&rsquo;s Top executives</li>\r\n	<li>Arrange meeting with clients outside/inside the office</li>\r\n	<li>Maintain good relationship with clients</li>\r\n</ul>\r\n</div>\r\n', '<div class=\"listdown-odi\">\r\n<ul>\r\n	<li>Bachelor or Master Degree in Business Administration, Marketing, Mass Communication</li>\r\n	<li>Advertising or other related fields</li>\r\n	<li>1-3 year work experiences for Account Executive in Advertising Agencies Company</li>\r\n	<li>A good understanding on IMC (all of knowledge of ATL and BTL) and brand concept to coordinate across working team between online and offline team</li>\r\n	<li>Good command of reading, writing and speaking English</li>\r\n	<li>Proficiency in computer skills program MS Office (Word, Excel and PowerPoint)</li>\r\n	<li>Excellent communication skills</li>\r\n	<li>Energetic able to work under pressure</li>\r\n	<li>Pleasant personality and service mind</li>\r\n	<li>Strong communication and presentation skills</li>\r\n	<li>Energetic, well handle with pressure, self-motivated, and looking for a challenge</li>\r\n</ul>\r\n</div>\r\n', '2016-04-07', '2016-05-07', '33', '1', '1', '0', '', '1', '2016-04-07 07:52:28', null);

-- ----------------------------
-- Table structure for `tbl_join_training`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_join_training`;
CREATE TABLE `tbl_join_training` (
  `id` bigint(18) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) DEFAULT NULL,
  `company` varchar(225) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `trc_id` smallint(8) DEFAULT NULL,
  `phone_paticipant` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `description` varchar(300) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_join_training
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_language`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_language`;
CREATE TABLE `tbl_language` (
  `lang_id` smallint(2) NOT NULL AUTO_INCREMENT,
  `lang_title` varchar(50) DEFAULT NULL,
  `lang_alias` varchar(5) DEFAULT NULL,
  `lang_flag` varchar(50) DEFAULT NULL,
  `lang_sequense` smallint(3) DEFAULT NULL,
  `lang_status` smallint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_language
-- ----------------------------
INSERT INTO `tbl_language` VALUES ('1', 'English', 'en', 'en-flag.png', '1', '1', '2014-08-11 10:28:34', '2014-10-02 11:05:43');
INSERT INTO `tbl_language` VALUES ('2', 'Khmer', 'km', 'km-flag.png', '2', '0', '2014-08-11 10:28:34', '2014-10-02 16:23:35');
INSERT INTO `tbl_language` VALUES ('3', 'Japanese', 'ja', 'jp-flag.png', '3', '0', '2014-08-11 10:28:34', '2014-08-11 10:28:38');
INSERT INTO `tbl_language` VALUES ('4', 'Chinese', 'zh', 'zh-flag.png', '4', '0', '2014-08-11 10:28:38', '2014-08-11 10:28:38');
INSERT INTO `tbl_language` VALUES ('5', 'Korean', 'kr', 'kr-flag.png', '5', '0', '2014-08-11 10:28:38', '2014-08-11 10:28:38');
INSERT INTO `tbl_language` VALUES ('6', 'Vietnamese', 'vn', 'vn-flag.png', '6', '0', '2014-08-11 10:54:25', '2015-01-30 13:48:02');
INSERT INTO `tbl_language` VALUES ('7', 'French', 'fr', 'fr-flag.png', '7', '0', '2015-05-19 08:00:16', '2015-05-19 09:00:25');

-- ----------------------------
-- Table structure for `tbl_menu`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menu`;
CREATE TABLE `tbl_menu` (
  `m_id` smallint(3) NOT NULL AUTO_INCREMENT,
  `m_parent` smallint(3) DEFAULT NULL,
  `m_title` varchar(100) DEFAULT NULL,
  `m_post` tinyint(1) DEFAULT NULL,
  `m_sequense` smallint(3) DEFAULT NULL,
  `m_link` varchar(50) DEFAULT NULL,
  `m_link_type` varchar(10) DEFAULT NULL,
  `m_status` tinyint(1) DEFAULT NULL,
  `m_image` varchar(100) DEFAULT NULL,
  `m_image_hover` varchar(100) DEFAULT NULL,
  `cnt_id` smallint(2) DEFAULT NULL,
  `con_id` smallint(3) DEFAULT NULL,
  `enable_list` varchar(100) DEFAULT NULL,
  `block_search` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_menu
-- ----------------------------
INSERT INTO `tbl_menu` VALUES ('1', '0', 'Home', '1', '1', null, 'internal', '1', 'i_1459850074.png', 'a_1459850074.png', null, null, '3,5,6,7,8,9,10,11,12,2', '0', '2016-03-23 11:15:17', '2016-04-07 03:25:05');
INSERT INTO `tbl_menu` VALUES ('2', '0', 'Contact Us', '1', '10', 'contact', 'internal', '1', 'i_1459850125.png', 'a_1459850125.png', '5', '2', '1,7,8,9,2', '0', '2016-03-23 11:15:10', '2016-04-07 11:35:18');
INSERT INTO `tbl_menu` VALUES ('3', '0', 'About Us', '1', '1', 'about', 'internal', '1', 'i_1459850150.png', 'a_1459850150.png', '4', '7', '3,5,6,7,8,9,10,11,12,2', '1', '2016-03-23 11:22:57', '2016-04-07 05:06:57');
INSERT INTO `tbl_menu` VALUES ('5', '0', 'Training', '1', '2', 'training', 'internal', '1', 'i_1459850219.png', 'a_1459850219.png', '4', '11', '1,5,10,11,2,15,16', '0', '2016-04-05 09:56:59', '2016-04-07 11:21:58');
INSERT INTO `tbl_menu` VALUES ('6', '0', 'Recruitment', '1', '3', 'recruitment', 'internal', '1', 'i_1459850310.png', 'a_1459850310.png', '4', '5', '6,1', '0', '2016-04-05 09:58:30', '2016-04-05 11:02:30');
INSERT INTO `tbl_menu` VALUES ('7', '0', 'HR Advisory', '1', '8', 'hr-advisory', 'internal', '1', 'i_1459850365.png', 'a_1459850365.png', '4', '7', '1,7,8,9,2', '0', '2016-04-05 09:59:25', '2016-04-07 11:37:17');
INSERT INTO `tbl_menu` VALUES ('8', '0', 'Labor Law Compliance', '1', '9', 'labor-law-compliance', 'internal', '1', 'i_1459850427.png', 'a_1459850427.png', '4', '13', '1,9,7,8,2', '0', '2016-04-05 10:00:27', '2016-04-07 11:45:19');
INSERT INTO `tbl_menu` VALUES ('9', '0', 'Outsourcing', '1', '6', 'outsourcing', 'internal', '1', 'i_1459850490.png', 'a_1459850490.png', '4', '10', '1,9,7,8,2', '0', '2016-04-05 10:01:31', '2016-04-07 11:44:57');
INSERT INTO `tbl_menu` VALUES ('10', '0', 'Team Building', '1', '9', 'team-building', 'internal', '1', 'i_1459851071.png', 'a_1459851071.png', '4', '15', '1,5,11,15,10,16,2', '0', '2016-04-05 10:11:11', '2016-04-07 11:50:50');
INSERT INTO `tbl_menu` VALUES ('11', '0', 'Upcoming Course', '1', '7', 'upcoming-course', 'internal', '1', 'i_1459851624.png', 'a_1459851624.png', '4', '14', '1,5,11,15,10,16,2', '0', '2016-04-05 10:20:24', '2016-04-07 11:48:26');
INSERT INTO `tbl_menu` VALUES ('12', '0', 'Job Vacancy', '1', '9', 'job-vacancy', 'internal', '1', 'i_1459851841.png', 'a_1459851841.png', '4', '9', '1,6,12,2,13', '0', '2016-04-05 10:24:01', '2016-04-07 11:53:26');
INSERT INTO `tbl_menu` VALUES ('13', '0', 'Submit CV', '1', '11', 'submit-cv', 'internal', '1', 'i_1460013787.png', 'a_1460013787.png', '4', '8', '1,6,12,2,13', '0', '2016-04-07 07:23:07', '2016-04-07 11:32:32');
INSERT INTO `tbl_menu` VALUES ('15', '0', 'Customize Training', '1', '8', 'customize-training', 'internal', '1', 'i_1460027582.png', 'a_1460027582.png', '4', '11', '5,6,11,2,13,15', '0', '2016-04-07 11:13:02', '2016-04-07 11:28:09');
INSERT INTO `tbl_menu` VALUES ('16', '0', 'Register Online', '1', '9', 'register-online', 'internal', '1', 'i_1460027690.png', 'a_1460027690.png', '4', '16', '1,5,11,15,10,16,2', '0', '2016-04-07 11:14:50', '2016-04-07 11:55:25');

-- ----------------------------
-- Table structure for `tbl_menu_translate`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menu_translate`;
CREATE TABLE `tbl_menu_translate` (
  `mnt_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `m_id` smallint(3) DEFAULT NULL,
  `mnt_title` varchar(225) DEFAULT NULL,
  `lang_id` smallint(2) DEFAULT NULL,
  PRIMARY KEY (`mnt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_menu_translate
-- ----------------------------
INSERT INTO `tbl_menu_translate` VALUES ('1', '1', 'Home', '1');
INSERT INTO `tbl_menu_translate` VALUES ('2', '2', 'Contact Us', '1');
INSERT INTO `tbl_menu_translate` VALUES ('3', '3', 'About Us', '1');
INSERT INTO `tbl_menu_translate` VALUES ('5', '5', 'Training', '1');
INSERT INTO `tbl_menu_translate` VALUES ('6', '6', 'Recruitment', '1');
INSERT INTO `tbl_menu_translate` VALUES ('7', '7', 'HR Advisory', '1');
INSERT INTO `tbl_menu_translate` VALUES ('8', '8', 'Labor Law Compliance', '1');
INSERT INTO `tbl_menu_translate` VALUES ('9', '9', 'Outsourcing', '1');
INSERT INTO `tbl_menu_translate` VALUES ('10', '10', 'Team Building', '1');
INSERT INTO `tbl_menu_translate` VALUES ('11', '11', 'Upcoming Course', '1');
INSERT INTO `tbl_menu_translate` VALUES ('12', '12', 'Job Vacancy', '1');
INSERT INTO `tbl_menu_translate` VALUES ('13', '13', 'Submit CV', '1');
INSERT INTO `tbl_menu_translate` VALUES ('14', '15', 'Customize Training', '1');
INSERT INTO `tbl_menu_translate` VALUES ('15', '16', 'Register Online', '1');

-- ----------------------------
-- Table structure for `tbl_resource`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_resource`;
CREATE TABLE `tbl_resource` (
  `res_id` smallint(8) NOT NULL AUTO_INCREMENT,
  `res_title` varchar(300) DEFAULT NULL,
  `parent_id` smallint(8) DEFAULT NULL,
  `res_file` varchar(100) DEFAULT NULL,
  `res_status` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`res_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_resource
-- ----------------------------
INSERT INTO `tbl_resource` VALUES ('1', 'Tax', '0', null, '1', '2016-04-07 09:09:53', null);
INSERT INTO `tbl_resource` VALUES ('2', 'Labor Law', '0', null, '1', '2016-04-07 09:10:08', null);
INSERT INTO `tbl_resource` VALUES ('3', 'NSSF', '0', null, '1', '2016-04-07 09:10:15', null);
INSERT INTO `tbl_resource` VALUES ('4', 'Prakas on Foreign Work Permit and Foreign Employment - EN', '1', '957_project-plan.xlsx', '1', '2016-04-07 09:16:48', null);
INSERT INTO `tbl_resource` VALUES ('5', 'Joint Prakas on Labor Inspectioin for foreign Worker - EN', '2', '809_ODI-project-plan.pdf', '1', '2016-04-07 09:18:01', null);
INSERT INTO `tbl_resource` VALUES ('6', 'Mol\'s Slide - EN', '3', '743_project-plan.xlsx', '1', '2016-04-07 09:18:25', null);
INSERT INTO `tbl_resource` VALUES ('7', 'NSSF Notification No 10 on the procedure of Contribution - EN', '3', '453_revise-project-plan.pdf', '1', '2016-04-07 09:19:11', null);

-- ----------------------------
-- Table structure for `tbl_training_course`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_training_course`;
CREATE TABLE `tbl_training_course` (
  `trc_id` smallint(8) NOT NULL AUTO_INCREMENT,
  `trc_title` varchar(150) DEFAULT NULL,
  `trc_content` text,
  `parent_id` smallint(8) DEFAULT NULL,
  `trc_price` float DEFAULT NULL,
  `customize` tinyint(1) DEFAULT NULL,
  `created_by` smallint(3) DEFAULT NULL,
  `started_from` date DEFAULT NULL,
  `started_to` date DEFAULT NULL,
  `trc_status` tinyint(1) DEFAULT '1',
  `publish` tinyint(1) DEFAULT '1',
  `trc_language` varchar(50) DEFAULT NULL,
  `trc_banner` varchar(100) DEFAULT NULL,
  `trc_place` varchar(225) DEFAULT NULL,
  `trc_discount` varchar(225) DEFAULT NULL,
  `last_register` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`trc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_training_course
-- ----------------------------
INSERT INTO `tbl_training_course` VALUES ('1', 'Communication', null, '0', null, null, null, null, null, '1', '1', null, null, null, null, null, '2016-04-06 10:38:36', null);
INSERT INTO `tbl_training_course` VALUES ('2', 'Computer Skill', null, '0', null, null, null, null, null, '1', '1', null, null, null, null, null, '2016-04-06 10:38:36', null);
INSERT INTO `tbl_training_course` VALUES ('3', 'Tax', null, '0', null, null, null, null, null, '1', '1', null, null, null, null, null, '2016-04-06 10:38:36', null);
INSERT INTO `tbl_training_course` VALUES ('4', 'Labor Law', null, '0', null, null, null, null, null, '1', '1', null, null, null, null, null, '2016-04-06 10:38:36', null);
INSERT INTO `tbl_training_course` VALUES ('5', 'Administration and Office Management Skills', '<div style=\"display:block; float:left; width:50%\">\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Course Overview</h3>\r\n\r\n<p>This training course will strengthen your knowledge and practices in the Cambodian Labour Law and workingconditions in HR/employee management. Understand how the Cambodian Labour Law works in relation to your company or organization to ensure you meet the minimum requirements.</p>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Course Objectives</h3>\r\n\r\n<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n	<li>Be fully competent in practices of Labour Law and Working Conditions in HR/Employee Management</li>\r\n	<li>Design an internal Labour Law Auditing Tool, and conduct internal audit on your internal mechanisms</li>\r\n	<li>Implement the Cambodian Labour Law to ensure your company meets the minimum requirements</li>\r\n	<li>Improve employee management to solve issues using the Labour Law</li>\r\n	<li>Get answers to your questions in a pro-active environment</li>\r\n</ul>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Who should attend?</h3>\r\n\r\n<p>Business owners, business managers, directors, finance and accounting professional and those whose works deal with taxation</p>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Sepcial Features</h3>\r\n\r\n<p>ODI Asia training approach is highly practical, participatory and often fun! We focus on real issues and help participants to use the tools covered. We train in small groups to meet the needs of individual participants and use a variety of learning methods to stimulate interest and meet different learning styles.Courses are supported by extensive materials for participants to take away and apply after the course, including a detailed course manual. We also offer a free follow-up service by email or phone to all trainees.</p>\r\n</div>\r\n\r\n<div style=\"display:block; float:right; width:48%\">\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Course Content</h3>\r\n\r\n<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 1:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">\r\n	<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n		<li>Introduction to Labour Law</li>\r\n		<li>Scope of Application Employers and Employee</li>\r\n		<li>Connection between Labour Law, Work Condition, and Human Resource Management</li>\r\n		<li>Staff recruitment</li>\r\n		<li>Application for Enterprise Establishment</li>\r\n	</ul>\r\n	</li>\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 2:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">\r\n	<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n		<li>Labour Contract and Labour Contract Termination</li>\r\n		<li>Written Labour Contract</li>\r\n		<li>Verbal Labour Contract</li>\r\n		<li>Other types of Labour Contract</li>\r\n		<li>Labour Contract Termination</li>\r\n	</ul>\r\n	</li>\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 3:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">Rights and Working Conditions\r\n	<ol>\r\n		<li>Salaries and Wages</li>\r\n		<li>Working Hour</li>\r\n		<li>OverTime</li>\r\n		<li>Paid Holiday</li>\r\n		<li>Annual Leave</li>\r\n		<li>Special Leave</li>\r\n		<li>Sick Leave</li>\r\n		<li>Women Labor</li>\r\n		<li>Work related accident</li>\r\n	</ol>\r\n	</li>\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 4:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">\r\n	<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n		<li>Conflict Resolution Labour Conflict</li>\r\n		<li>Types of Labour Conflict</li>\r\n		<li>Definition of Labour Conflict</li>\r\n		<li>Process of Labour Conflict Resolution</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Trainer</h3>\r\n\r\n<p>Our trainer is an expert in Cambodia Labour Law, having worked for Ministry of Labour for more than ten years. He has conducted may training related to labour law to thousand workers and employees as well as employers. He is an expert with in-depth understanding of Cambodia Labour Law and practices at different companies and organizations.</p>\r\n</div>\r\n', '2', '195', '0', '1', '2016-04-08', '2016-04-13', '1', '1', 'Khmer', null, 'ODI Training Center', '20% off for Early bird registration ( before  April -01, 2016)', '2016-04-06', '2016-04-06 04:21:10', null);
INSERT INTO `tbl_training_course` VALUES ('6', 'Cambodian Labor Law and HR Compliance', '<div style=\"display:block; float:left; width:50%\">\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Course Overview</h3>\r\n\r\n<p>This training course will strengthen your knowledge and practices in the Cambodian Labour Law and workingconditions in HR/employee management. Understand how the Cambodian Labour Law works in relation to your company or organization to ensure you meet the minimum requirements.</p>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Course Objectives</h3>\r\n\r\n<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n	<li>Be fully competent in practices of Labour Law and Working Conditions in HR/Employee Management</li>\r\n	<li>Design an internal Labour Law Auditing Tool, and conduct internal audit on your internal mechanisms</li>\r\n	<li>Implement the Cambodian Labour Law to ensure your company meets the minimum requirements</li>\r\n	<li>Improve employee management to solve issues using the Labour Law</li>\r\n	<li>Get answers to your questions in a pro-active environment</li>\r\n</ul>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Who should attend?</h3>\r\n\r\n<p>Business owners, business managers, directors, finance and accounting professional and those whose works deal with taxation</p>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Sepcial Features</h3>\r\n\r\n<p>ODI Asia training approach is highly practical, participatory and often fun! We focus on real issues and help participants to use the tools covered. We train in small groups to meet the needs of individual participants and use a variety of learning methods to stimulate interest and meet different learning styles.Courses are supported by extensive materials for participants to take away and apply after the course, including a detailed course manual. We also offer a free follow-up service by email or phone to all trainees.</p>\r\n</div>\r\n\r\n<div style=\"display:block; float:right; width:48%\">\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Course Content</h3>\r\n\r\n<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 1:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">\r\n	<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n		<li>Introduction to Labour Law</li>\r\n		<li>Scope of Application Employers and Employee</li>\r\n		<li>Connection between Labour Law, Work Condition, and Human Resource Management</li>\r\n		<li>Staff recruitment</li>\r\n		<li>Application for Enterprise Establishment</li>\r\n	</ul>\r\n	</li>\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 2:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">\r\n	<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n		<li>Labour Contract and Labour Contract Termination</li>\r\n		<li>Written Labour Contract</li>\r\n		<li>Verbal Labour Contract</li>\r\n		<li>Other types of Labour Contract</li>\r\n		<li>Labour Contract Termination</li>\r\n	</ul>\r\n	</li>\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 3:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">Rights and Working Conditions\r\n	<ol>\r\n		<li>Salaries and Wages</li>\r\n		<li>Working Hour</li>\r\n		<li>OverTime</li>\r\n		<li>Paid Holiday</li>\r\n		<li>Annual Leave</li>\r\n		<li>Special Leave</li>\r\n		<li>Sick Leave</li>\r\n		<li>Women Labor</li>\r\n		<li>Work related accident</li>\r\n	</ol>\r\n	</li>\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 4:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">\r\n	<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n		<li>Conflict Resolution Labour Conflict</li>\r\n		<li>Types of Labour Conflict</li>\r\n		<li>Definition of Labour Conflict</li>\r\n		<li>Process of Labour Conflict Resolution</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Trainer</h3>\r\n\r\n<p>Our trainer is an expert in Cambodia Labour Law, having worked for Ministry of Labour for more than ten years. He has conducted may training related to labour law to thousand workers and employees as well as employers. He is an expert with in-depth understanding of Cambodia Labour Law and practices at different companies and organizations.</p>\r\n</div>\r\n', '4', '200', '0', '1', '2016-04-09', '2016-04-10', '1', '1', 'Khmer', null, 'ODI Training Center', '', '2016-04-06', '2016-04-06 04:25:29', null);
INSERT INTO `tbl_training_course` VALUES ('7', 'Time Management and Personal Effectiveness', '<div style=\"display:block; float:left; width:50%\">\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Course Overview</h3>\r\n\r\n<p>This training course will strengthen your knowledge and practices in the Cambodian Labour Law and workingconditions in HR/employee management. Understand how the Cambodian Labour Law works in relation to your company or organization to ensure you meet the minimum requirements.</p>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Course Objectives</h3>\r\n\r\n<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n	<li>Be fully competent in practices of Labour Law and Working Conditions in HR/Employee Management</li>\r\n	<li>Design an internal Labour Law Auditing Tool, and conduct internal audit on your internal mechanisms</li>\r\n	<li>Implement the Cambodian Labour Law to ensure your company meets the minimum requirements</li>\r\n	<li>Improve employee management to solve issues using the Labour Law</li>\r\n	<li>Get answers to your questions in a pro-active environment</li>\r\n</ul>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Who should attend?</h3>\r\n\r\n<p>Business owners, business managers, directors, finance and accounting professional and those whose works deal with taxation</p>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Sepcial Features</h3>\r\n\r\n<p>ODI Asia training approach is highly practical, participatory and often fun! We focus on real issues and help participants to use the tools covered. We train in small groups to meet the needs of individual participants and use a variety of learning methods to stimulate interest and meet different learning styles.Courses are supported by extensive materials for participants to take away and apply after the course, including a detailed course manual. We also offer a free follow-up service by email or phone to all trainees.</p>\r\n</div>\r\n\r\n<div style=\"display:block; float:right; width:48%\">\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Course Content</h3>\r\n\r\n<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 1:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">\r\n	<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n		<li>Introduction to Labour Law</li>\r\n		<li>Scope of Application Employers and Employee</li>\r\n		<li>Connection between Labour Law, Work Condition, and Human Resource Management</li>\r\n		<li>Staff recruitment</li>\r\n		<li>Application for Enterprise Establishment</li>\r\n	</ul>\r\n	</li>\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 2:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">\r\n	<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n		<li>Labour Contract and Labour Contract Termination</li>\r\n		<li>Written Labour Contract</li>\r\n		<li>Verbal Labour Contract</li>\r\n		<li>Other types of Labour Contract</li>\r\n		<li>Labour Contract Termination</li>\r\n	</ul>\r\n	</li>\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 3:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">Rights and Working Conditions\r\n	<ol>\r\n		<li>Salaries and Wages</li>\r\n		<li>Working Hour</li>\r\n		<li>OverTime</li>\r\n		<li>Paid Holiday</li>\r\n		<li>Annual Leave</li>\r\n		<li>Special Leave</li>\r\n		<li>Sick Leave</li>\r\n		<li>Women Labor</li>\r\n		<li>Work related accident</li>\r\n	</ol>\r\n	</li>\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 4:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">\r\n	<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n		<li>Conflict Resolution Labour Conflict</li>\r\n		<li>Types of Labour Conflict</li>\r\n		<li>Definition of Labour Conflict</li>\r\n		<li>Process of Labour Conflict Resolution</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Trainer</h3>\r\n\r\n<p>Our trainer is an expert in Cambodia Labour Law, having worked for Ministry of Labour for more than ten years. He has conducted may training related to labour law to thousand workers and employees as well as employers. He is an expert with in-depth understanding of Cambodia Labour Law and practices at different companies and organizations.</p>\r\n</div>\r\n', '1', '185', '0', '1', '2016-04-21', '2016-04-22', '1', '1', 'Khmer', null, 'ODI Training Center', '', '2016-04-18', '2016-04-06 04:28:11', null);
INSERT INTO `tbl_training_course` VALUES ('8', 'Professional Writing Report for NGO', '<div style=\"display:block; float:left; width:50%\">\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Course Overview</h3>\r\n\r\n<p>This training course will strengthen your knowledge and practices in the Cambodian Labour Law and workingconditions in HR/employee management. Understand how the Cambodian Labour Law works in relation to your company or organization to ensure you meet the minimum requirements.</p>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Course Objectives</h3>\r\n\r\n<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n	<li>Be fully competent in practices of Labour Law and Working Conditions in HR/Employee Management</li>\r\n	<li>Design an internal Labour Law Auditing Tool, and conduct internal audit on your internal mechanisms</li>\r\n	<li>Implement the Cambodian Labour Law to ensure your company meets the minimum requirements</li>\r\n	<li>Improve employee management to solve issues using the Labour Law</li>\r\n	<li>Get answers to your questions in a pro-active environment</li>\r\n</ul>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Who should attend?</h3>\r\n\r\n<p>Business owners, business managers, directors, finance and accounting professional and those whose works deal with taxation</p>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Sepcial Features</h3>\r\n\r\n<p>ODI Asia training approach is highly practical, participatory and often fun! We focus on real issues and help participants to use the tools covered. We train in small groups to meet the needs of individual participants and use a variety of learning methods to stimulate interest and meet different learning styles.Courses are supported by extensive materials for participants to take away and apply after the course, including a detailed course manual. We also offer a free follow-up service by email or phone to all trainees.</p>\r\n</div>\r\n\r\n<div style=\"display:block; float:right; width:48%\">\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Course Content</h3>\r\n\r\n<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 1:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">\r\n	<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n		<li>Introduction to Labour Law</li>\r\n		<li>Scope of Application Employers and Employee</li>\r\n		<li>Connection between Labour Law, Work Condition, and Human Resource Management</li>\r\n		<li>Staff recruitment</li>\r\n		<li>Application for Enterprise Establishment</li>\r\n	</ul>\r\n	</li>\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 2:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">\r\n	<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n		<li>Labour Contract and Labour Contract Termination</li>\r\n		<li>Written Labour Contract</li>\r\n		<li>Verbal Labour Contract</li>\r\n		<li>Other types of Labour Contract</li>\r\n		<li>Labour Contract Termination</li>\r\n	</ul>\r\n	</li>\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 3:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">Rights and Working Conditions\r\n	<ol>\r\n		<li>Salaries and Wages</li>\r\n		<li>Working Hour</li>\r\n		<li>OverTime</li>\r\n		<li>Paid Holiday</li>\r\n		<li>Annual Leave</li>\r\n		<li>Special Leave</li>\r\n		<li>Sick Leave</li>\r\n		<li>Women Labor</li>\r\n		<li>Work related accident</li>\r\n	</ol>\r\n	</li>\r\n	<li style=\"display:inline-block; margin-left:0; margin-right:5px; padding-left:0; vertical-align:top; width:18%\">Module 4:</li>\r\n	<li style=\"display:inline-block; margin-left:0; padding-left:0; vertical-align:top; width:80%\">\r\n	<ul style=\"list-style:none; margin-left:0; padding-left:0\">\r\n		<li>Conflict Resolution Labour Conflict</li>\r\n		<li>Types of Labour Conflict</li>\r\n		<li>Definition of Labour Conflict</li>\r\n		<li>Process of Labour Conflict Resolution</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<h3 style=\"color:#00ADEF; font-size:16px; font-wight:bold\">Trainer</h3>\r\n\r\n<p>Our trainer is an expert in Cambodia Labour Law, having worked for Ministry of Labour for more than ten years. He has conducted may training related to labour law to thousand workers and employees as well as employers. He is an expert with in-depth understanding of Cambodia Labour Law and practices at different companies and organizations.</p>\r\n</div>\r\n', '2', '150', '0', '1', '2016-04-14', '2016-04-15', '1', '1', 'English', 'b_82899305.jpg', 'ODI Training Center', '', '2016-04-12', '2016-04-06 09:24:59', null);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` smallint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Admin', 'admin.odi@system.com', '$2y$10$kWD1aiEKjc2jVGxPGqckZ.n0M718i6z4dyP6obbACoHdi9kFXEn4K', 'Aqkyhky0xsEIjPQ9wVygggjz5iWv8zQKThrPXTGzUOvROG9rxWskavA8EFZm', '1', '2016-03-15 07:28:54', '2016-04-05 09:50:00');
