-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2019 �?01 �?26 �?17:07
-- 服务器版本: 5.5.53
-- PHP 版本: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `laravel`
--

-- --------------------------------------------------------

--
-- 表的结构 `case_admin`
--

CREATE TABLE IF NOT EXISTS `case_admin` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `admin_name` varchar(20) NOT NULL COMMENT '管理员名称',
  `admin_avatar` varchar(100) DEFAULT NULL COMMENT '管理员头像',
  `admin_password` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `admin_login_time` int(10) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `admin_login_num` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `admin_is_super` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否超级管理员',
  `admin_gid` smallint(6) DEFAULT '0' COMMENT '权限组ID',
  `admin_quick_link` varchar(400) DEFAULT NULL COMMENT '管理员常用操作',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `case_admin`
--

INSERT INTO `case_admin` (`admin_id`, `admin_name`, `admin_avatar`, `admin_password`, `admin_login_time`, `admin_login_num`, `admin_is_super`, `admin_gid`, `admin_quick_link`) VALUES
(1, 'admin', '05489454759309708_sm.jpg', 'e10adc3949ba59abbe56e057f20f883e', 1547263315, 505, 1, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `case_admin_log`
--

CREATE TABLE IF NOT EXISTS `case_admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(50) NOT NULL COMMENT '操作内容',
  `createtime` int(10) unsigned DEFAULT NULL COMMENT '发生时间',
  `admin_name` char(20) NOT NULL COMMENT '管理员',
  `admin_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `ip` char(15) NOT NULL COMMENT 'IP',
  `url` varchar(50) NOT NULL DEFAULT '' COMMENT '来源URL',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员操作日志' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `case_gadmin`
--

CREATE TABLE IF NOT EXISTS `case_gadmin` (
  `gid` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `gname` varchar(50) DEFAULT NULL COMMENT '组名',
  `limits` text COMMENT '权限内容',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限组' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
