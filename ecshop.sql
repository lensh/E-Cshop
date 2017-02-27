-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 02 月 27 日 09:53
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `ecshop`
--
CREATE DATABASE IF NOT EXISTS `ecshop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ecshop`;

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_admin`
--

CREATE TABLE IF NOT EXISTS `ecshop_admin` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL COMMENT '账号',
  `password` char(32) NOT NULL COMMENT '密码',
  `role_id` varchar(30) NOT NULL COMMENT '所属角色的id',
  `is_use` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用 1：启用0：禁用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ecshop_admin`
--

INSERT INTO `ecshop_admin` (`id`, `username`, `password`, `role_id`, `is_use`) VALUES
(1, 'root', '9467869ceb7268189081f0e615732496', '1,2,3', 1),
(2, '王勇平', '9467869ceb7268189081f0e615732496', '1', 0),
(3, '钟林生', '9467869ceb7268189081f0e615732496', '2', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_attr`
--

CREATE TABLE IF NOT EXISTS `ecshop_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL COMMENT '所在的类型的id',
  `attr_name` varchar(30) NOT NULL COMMENT '属性名',
  `attr_type` tinyint(4) NOT NULL COMMENT '属性的类型0：唯一 1：可选',
  `attr_option_values` varchar(150) NOT NULL COMMENT '属性的可选值，多个可选值用，隔开',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `type_id_2` (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='属性表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `ecshop_attr`
--

INSERT INTO `ecshop_attr` (`id`, `type_id`, `attr_name`, `attr_type`, `attr_option_values`) VALUES
(1, 2, '出版社', 0, ''),
(3, 2, '页数', 0, ''),
(4, 1, '像素', 1, '1600万,1200万'),
(5, 1, '内存', 1, '4G,8G,16G'),
(6, 1, '颜色', 1, '白色,黑色,红色'),
(7, 1, '是否智能', 0, '是,不是');

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_auth`
--

CREATE TABLE IF NOT EXISTS `ecshop_auth` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父级权限的id，0表示顶级权限',
  `auth_name` varchar(30) NOT NULL COMMENT '权限名称',
  `module_name` varchar(30) NOT NULL COMMENT '模块名称',
  `controller_name` varchar(30) NOT NULL COMMENT '控制器名称',
  `action_name` varchar(30) NOT NULL COMMENT '方法名称',
  `auth_level` tinyint(5) NOT NULL DEFAULT '2' COMMENT '权限等级',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='权限表' AUTO_INCREMENT=49 ;

--
-- 转存表中的数据 `ecshop_auth`
--

INSERT INTO `ecshop_auth` (`id`, `pid`, `auth_name`, `module_name`, `controller_name`, `action_name`, `auth_level`) VALUES
(1, 0, '商品管理', 'null', 'null', 'null', 0),
(2, 1, '商品列表', 'Admin', 'Goods', 'lst', 1),
(3, 2, '删除商品', 'Admin', 'Goods', 'delete', 2),
(4, 2, '编辑商品', 'Admin', 'Goods', 'edit', 2),
(5, 2, '添加商品', 'Admin', 'Goods', 'add', 2),
(6, 1, '商品分类列表', 'Admin', 'Category', 'lst', 1),
(7, 6, '添加分类', 'Admin', 'Category', 'add', 2),
(8, 6, '修改分类', 'Admin', 'Category', 'edit', 2),
(9, 6, '删除分类', 'Admin', 'Category', 'delete', 2),
(10, 0, '权限管理', 'null', 'null', 'null', 0),
(11, 10, '权限列表', 'Admin', 'Auth', 'lst', 1),
(12, 11, '添加权限', 'Admin', 'Auth', 'add', 2),
(13, 11, '编辑权限', 'Admin', 'Auth', 'edit', 2),
(14, 11, '删除权限', 'Admin', 'Auth', 'delete', 2),
(15, 10, '角色列表', 'Admin', 'Role', 'lst', 1),
(16, 15, '添加角色', 'Admin', 'Role', 'add', 2),
(17, 15, '编辑角色', 'Admin', 'Role', 'edit', 2),
(18, 15, '删除角色', 'Admin', 'Role', 'delete', 2),
(19, 10, '管理员列表', 'Admin', 'Admin', 'lst', 1),
(20, 19, '添加管理员', 'Admin', 'Admin', 'add', 2),
(21, 19, '编辑管理员', 'Admin', 'Admin', 'edit', 2),
(22, 19, '删除管理员', 'Admin', 'Admin', 'delete', 2),
(23, 19, '禁用管理员', 'Admin', 'Admin', 'setUnuse', 2),
(24, 1, '类型列表', 'Admin', 'Type', 'lst', 1),
(25, 24, '添加类型', 'Admin', 'Type', 'add', 2),
(26, 24, '修改类型', 'Admin', 'Type', 'edit', 2),
(27, 24, '删除类型', 'Admin', 'Type', 'delete', 2),
(28, 24, '属性列表', 'Admin', 'Attr', 'lst', 2),
(29, 28, '添加属性', 'Admin', 'Attr', 'add', 3),
(30, 28, '修改属性', 'Admin', 'Attr', 'edit', 3),
(31, 28, '删除属性', 'Admin', 'Attr', 'delete', 3),
(33, 2, 'ajax获取商品属性', 'Admin', 'Goods', 'ajaxGetAttr', 2),
(34, 1, '品牌列表·', 'Admin', 'Brand', 'lst', 1),
(35, 34, '添加品牌', 'Admin', 'Brand', 'add', 2),
(36, 34, '修改品牌', 'Admin', 'Brand', 'edit', 2),
(37, 34, '删除品牌', 'Admin', 'Auth', 'delete', 2),
(38, 0, '会员管理', 'null', 'null', 'null', 0),
(39, 38, '会员等级列表', 'Admin', 'MemberLevel', 'lst', 1),
(40, 39, '添加会员等级', 'Admin', 'MemberLevel', 'add', 2),
(41, 39, '修改会员等级', 'Admin', 'MemberLevel', 'edit', 2),
(42, 39, '删除会员等级', 'Admin', 'MemberLevel', 'delete', 2),
(43, 2, 'ajax删除商品图片', 'Admin', 'Goods', 'ajaxDeletePic', 2),
(44, 2, 'ajax删除商品属性', 'Admin', 'Goods', 'ajaxDeleteAttr', 2),
(45, 2, '商品放入回收站', 'Admin', 'Goods', 'recycle', 2),
(46, 1, '商品回收站', 'Admin', 'Goods', 'recyclelst', 1),
(47, 46, '还原商品', 'Admin', 'Goods', 'restore', 2),
(48, 2, '库存量', 'Admin', 'Goods', 'number', 2);

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_brand`
--

CREATE TABLE IF NOT EXISTS `ecshop_brand` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(45) NOT NULL COMMENT '品牌名称',
  `site_url` varchar(150) NOT NULL COMMENT '品牌网站地址',
  `logo` varchar(150) NOT NULL DEFAULT '' COMMENT '品牌logo',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='品牌表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ecshop_brand`
--

INSERT INTO `ecshop_brand` (`id`, `brand_name`, `site_url`, `logo`) VALUES
(1, '诺基亚', 'gwe', 'Brand/2016-11-28/583c28eb83516.png'),
(2, '小米', 'www.xiaomi.com', '');

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_cart`
--

CREATE TABLE IF NOT EXISTS `ecshop_cart` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `goods_attr_id` varchar(30) NOT NULL DEFAULT '' COMMENT '选择的商品属性ID，多个用，隔开',
  `goods_number` int(10) unsigned NOT NULL COMMENT '购买的数量',
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员id',
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='购物车' AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_category`
--

CREATE TABLE IF NOT EXISTS `ecshop_category` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(30) NOT NULL COMMENT '分类名称',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类的ID，0：代表顶级',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品分类表' AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `ecshop_category`
--

INSERT INTO `ecshop_category` (`id`, `cat_name`, `pid`) VALUES
(1, '图像、音像、数字商品', 0),
(2, '电子书', 1),
(3, '数字音乐', 1),
(4, '音像', 1),
(5, '免费', 2),
(6, '小说', 2),
(7, '励志与成功', 2),
(8, '两性/婚恋', 2),
(9, '古典音乐', 3),
(10, '流行音乐', 3),
(11, '摇滚音乐', 3),
(12, '音乐', 4),
(13, '影视', 4),
(14, '游戏', 4),
(15, '手机、数码', 0),
(16, '智能手机', 15),
(17, '小米', 16),
(18, '三星', 16),
(19, '苹果', 16),
(20, '华为', 16),
(21, '数码', 15),
(22, '数码相机', 21),
(23, '数码电视', 21),
(24, '家用电器', 0),
(25, '大家电', 24),
(26, '冰箱', 25),
(27, '洗衣机', 25),
(28, '空调', 25),
(29, '饮水机', 25),
(30, '厨房电器', 24),
(31, '电饭煲', 30),
(32, '豆浆机', 30),
(33, '面包机', 30),
(34, '微波炉', 30);

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_clicked_use`
--

CREATE TABLE IF NOT EXISTS `ecshop_clicked_use` (
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员ID',
  `comment_id` mediumint(8) unsigned NOT NULL COMMENT '评论的ID',
  PRIMARY KEY (`member_id`,`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户点击过有用的评论';

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_comment`
--

CREATE TABLE IF NOT EXISTS `ecshop_comment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) NOT NULL COMMENT '评论的内容',
  `star` tinyint(3) unsigned NOT NULL DEFAULT '3' COMMENT '打的分',
  `addtime` int(10) unsigned NOT NULL COMMENT '评论时间',
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员ID',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品的ID',
  `used` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '有用的数量',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='评论' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ecshop_comment`
--

INSERT INTO `ecshop_comment` (`id`, `content`, `star`, `addtime`, `member_id`, `goods_id`, `used`) VALUES
(1, '商品很好', 5, 1480951394, 1, 3, 0),
(2, '真的很好噢', 5, 1481026639, 1, 3, 0),
(3, '是不错', 5, 1481030970, 1, 3, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_goods`
--

CREATE TABLE IF NOT EXISTS `ecshop_goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(45) NOT NULL COMMENT '商品名称',
  `cat_id` smallint(5) unsigned NOT NULL COMMENT '主分类的id',
  `brand_id` smallint(5) unsigned NOT NULL COMMENT '品牌的id',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店价',
  `jifen` int(10) unsigned NOT NULL COMMENT '赠送积分',
  `jyz` int(10) unsigned NOT NULL COMMENT '赠送经验值',
  `jifen_price` int(10) unsigned NOT NULL COMMENT '如果要用积分兑换，需要的积分数',
  `is_promote` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否促销',
  `promote_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '促销价',
  `promote_start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销开始时间',
  `promote_end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销结束时间',
  `logo` varchar(150) NOT NULL DEFAULT '' COMMENT 'logo原图',
  `sm_logo` varchar(150) NOT NULL DEFAULT '' COMMENT 'logo缩略图',
  `is_hot` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否热卖',
  `is_new` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否新品',
  `is_best` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否精品',
  `is_on_sale` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否上架：1：上架，0：下架',
  `seo_keyword` varchar(150) NOT NULL DEFAULT '' COMMENT 'seo优化[搜索引擎【百度、谷歌等】优化]_关键字',
  `seo_description` varchar(150) NOT NULL DEFAULT '' COMMENT 'seo优化[搜索引擎【百度、谷歌等】优化]_描述',
  `type_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品类型id',
  `sort_num` tinyint(3) unsigned NOT NULL DEFAULT '100' COMMENT '排序数字',
  `is_delete` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否放到回收站：1：是，0：否',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  `goods_desc` text COMMENT '商品描述',
  PRIMARY KEY (`id`),
  KEY `shop_price` (`shop_price`),
  KEY `cat_id` (`cat_id`),
  KEY `brand_id` (`brand_id`),
  KEY `is_on_sale` (`is_on_sale`),
  KEY `is_hot` (`is_hot`),
  KEY `is_new` (`is_new`),
  KEY `is_best` (`is_best`),
  KEY `is_delete` (`is_delete`),
  KEY `sort_num` (`sort_num`),
  KEY `promote_start_time` (`promote_start_time`),
  KEY `promote_end_time` (`promote_end_time`),
  KEY `addtime` (`addtime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `ecshop_goods`
--

INSERT INTO `ecshop_goods` (`id`, `goods_name`, `cat_id`, `brand_id`, `market_price`, `shop_price`, `jifen`, `jyz`, `jifen_price`, `is_promote`, `promote_price`, `promote_start_time`, `promote_end_time`, `logo`, `sm_logo`, `is_hot`, `is_new`, `is_best`, `is_on_sale`, `seo_keyword`, `seo_description`, `type_id`, `sort_num`, `is_delete`, `addtime`, `goods_desc`) VALUES
(2, '小米4', 17, 2, '2000.00', '1.00', 120, 200, 60, 1, '1.00', 1480435200, 1482422400, 'Goods/2016-11-30/583ef13350bc1.jpg', 'Goods/2016-11-30/thumb_0_583ef13350bc1.jpg', 0, 0, 0, 1, '小米4', '小米4', 1, 100, 0, 1480519987, '<p>小米4手机</p>'),
(3, '红米3', 17, 2, '1100.00', '1000.00', 2000, 178, 100, 0, '0.00', 1480694400, 1480694400, 'Goods/2016-12-03/5842d059a052b.jpg', 'Goods/2016-12-03/thumb_0_5842d059a052b.jpg', 1, 1, 1, 1, '小米', '小米', 1, 100, 0, 1480773721, '<p>红米</p>'),
(4, '诺基亚', 16, 1, '1100.00', '1000.00', 123, 123, 23435, 0, '0.00', 1480694400, 1480694400, 'Goods/2016-12-03/5842d4fa5abd9.jpg', 'Goods/2016-12-03/thumb_0_5842d4fa5abd9.jpg', 0, 1, 0, 1, '', '', 1, 100, 0, 1480774906, '<p>诺基亚</p>');

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_goods_attr`
--

CREATE TABLE IF NOT EXISTS `ecshop_goods_attr` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品的id',
  `attr_id` mediumint(8) unsigned NOT NULL COMMENT '属性的id',
  `attr_value` varchar(150) NOT NULL DEFAULT '' COMMENT '属性的值',
  `attr_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '属性的价格',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品属性表' AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `ecshop_goods_attr`
--

INSERT INTO `ecshop_goods_attr` (`id`, `goods_id`, `attr_id`, `attr_value`, `attr_price`) VALUES
(1, 2, 4, '1600万', '2100.00'),
(2, 2, 4, '1200万', '2000.00'),
(3, 2, 5, '4G', '1990.00'),
(4, 2, 5, '16G', '2100.00'),
(5, 2, 5, '8G', '2000.00'),
(6, 2, 6, '白色', '2000.00'),
(7, 2, 6, '红色', '2000.00'),
(8, 2, 6, '黑色', '2000.00'),
(9, 2, 7, '是', '0.00'),
(10, 3, 4, '1600万', '1200.00'),
(11, 3, 4, '1200万', '1100.00'),
(12, 3, 5, '8G', '1100.00'),
(13, 3, 5, '4G', '1000.00'),
(14, 3, 6, '白色', '1000.00'),
(15, 3, 7, '是', '0.00'),
(16, 4, 4, '1600万', '1000.00'),
(17, 4, 4, '1200万', '900.00'),
(18, 4, 5, '4G', '1233.00'),
(19, 4, 6, '请选择', '0.00'),
(20, 4, 6, '白色', '1000.00'),
(21, 4, 7, '是', '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_goods_cat`
--

CREATE TABLE IF NOT EXISTS `ecshop_goods_cat` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `cat_id` smallint(5) unsigned NOT NULL COMMENT '分类id',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品扩展分类表' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `ecshop_goods_cat`
--

INSERT INTO `ecshop_goods_cat` (`id`, `goods_id`, `cat_id`) VALUES
(8, 2, 16),
(7, 3, 16),
(9, 4, 16);

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_goods_number`
--

CREATE TABLE IF NOT EXISTS `ecshop_goods_number` (
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品的id',
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_number` int(10) unsigned NOT NULL COMMENT '库存量',
  `goods_attr_id` varchar(150) NOT NULL COMMENT 'goods_attr表里的id，并且要满足该goods_attr表的attr_id是可选的属性id，即属性表里的attr_type为1',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品库存量表' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `ecshop_goods_number`
--

INSERT INTO `ecshop_goods_number` (`goods_id`, `id`, `goods_number`, `goods_attr_id`) VALUES
(3, 5, 899, '10,12'),
(2, 6, 1228, '1,4,6'),
(2, 7, 1100, '1,5,7'),
(2, 8, 1230, '2,5,6'),
(2, 9, 1100, '2,3,7');

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_goods_pics`
--

CREATE TABLE IF NOT EXISTS `ecshop_goods_pics` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品的id',
  `pic` varchar(150) NOT NULL COMMENT '图片',
  `sm_pic` varchar(150) NOT NULL COMMENT '缩略图',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品相册表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `ecshop_goods_pics`
--

INSERT INTO `ecshop_goods_pics` (`id`, `goods_id`, `pic`, `sm_pic`) VALUES
(1, 2, 'Goods/2016-11-30/583ef133aa449.jpg', 'Goods/2016-11-30/thumb_0_583ef133aa449.jpg'),
(2, 2, 'Goods/2016-11-30/583ef133cfd64.jpg', 'Goods/2016-11-30/thumb_0_583ef133cfd64.jpg'),
(3, 3, 'Goods/2016-12-03/5842d05a01a4c.jpg', 'Goods/2016-12-03/thumb_0_5842d05a01a4c.jpg'),
(4, 3, 'Goods/2016-12-03/5842d05a2dbcb.jpg', 'Goods/2016-12-03/thumb_0_5842d05a2dbcb.jpg'),
(5, 4, 'Goods/2016-12-03/5842d4fa92dc2.jpg', 'Goods/2016-12-03/thumb_0_5842d4fa92dc2.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_impression`
--

CREATE TABLE IF NOT EXISTS `ecshop_impression` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `imp_name` varchar(30) NOT NULL COMMENT '印象的标题',
  `imp_count` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '印象出现的次数',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='印象' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ecshop_impression`
--

INSERT INTO `ecshop_impression` (`id`, `imp_name`, `imp_count`, `goods_id`) VALUES
(1, '质量好', 1, 3),
(2, '问问', 1, 3),
(3, '很好', 1, 3);

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_member`
--

CREATE TABLE IF NOT EXISTS `ecshop_member` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL COMMENT '会员账号',
  `password` char(32) NOT NULL COMMENT '密码',
  `face` varchar(150) NOT NULL DEFAULT '' COMMENT '头像',
  `addtime` int(10) unsigned NOT NULL COMMENT '注册时间',
  `email_code` char(32) NOT NULL DEFAULT '' COMMENT '邮件验证的验证码，当会员验证通过之后，会把这个字段清空，所以如果这个字段为空就说明会员已经通过email验证了',
  `jifen` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `jyz` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '经验值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ecshop_member`
--

INSERT INTO `ecshop_member` (`id`, `email`, `password`, `face`, `addtime`, `email_code`, `jifen`, `jyz`) VALUES
(1, '986992484@qq.com', '4bc26ff76fc3ecffd96f385246725ec3', '', 1480693714, '', 0, 60000),
(2, '3021555169@qq.com', '4bc26ff76fc3ecffd96f385246725ec3', '', 1480943072, '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_member_level`
--

CREATE TABLE IF NOT EXISTS `ecshop_member_level` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(30) NOT NULL COMMENT '级别名称',
  `bottom_num` int(10) unsigned NOT NULL COMMENT '积分下限',
  `top_num` int(10) unsigned NOT NULL COMMENT '积分上限',
  `rate` tinyint(4) NOT NULL DEFAULT '100' COMMENT '折扣率，90为9折',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COMMENT='会员级别表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `ecshop_member_level`
--

INSERT INTO `ecshop_member_level` (`id`, `level_name`, `bottom_num`, `top_num`, `rate`) VALUES
(1, '注册会员', 0, 2000, 100),
(2, '中级会员', 2001, 8000, 98),
(3, '高级会员', 8001, 20000, 95),
(4, '白金会员', 20001, 50000, 92),
(5, '黄金会员', 50001, 100000, 90);

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_member_price`
--

CREATE TABLE IF NOT EXISTS `ecshop_member_price` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(9) NOT NULL COMMENT '商品id',
  `level_id` mediumint(9) NOT NULL COMMENT '级别id',
  `price` decimal(10,0) NOT NULL COMMENT '这个级别的价格',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `level_id` (`level_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员价格表' AUTO_INCREMENT=46 ;

--
-- 转存表中的数据 `ecshop_member_price`
--

INSERT INTO `ecshop_member_price` (`id`, `goods_id`, `level_id`, `price`) VALUES
(40, 2, 5, '1600'),
(39, 2, 4, '1700'),
(38, 2, 3, '1808'),
(37, 2, 2, '1900'),
(36, 2, 1, '2000'),
(35, 3, 5, '900'),
(34, 3, 4, '920'),
(33, 3, 3, '950'),
(32, 3, 2, '980'),
(31, 3, 1, '1000'),
(41, 4, 1, '1200'),
(42, 4, 2, '1100'),
(43, 4, 3, '1000'),
(44, 4, 4, '950'),
(45, 4, 5, '900');

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_order`
--

CREATE TABLE IF NOT EXISTS `ecshop_order` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员id',
  `addtime` int(10) unsigned NOT NULL COMMENT '下单时间',
  `shr_name` varchar(30) NOT NULL COMMENT '收货人姓名',
  `shr_province` varchar(30) NOT NULL COMMENT '省',
  `shr_city` varchar(30) NOT NULL COMMENT '市',
  `shr_area` varchar(30) NOT NULL COMMENT '地区',
  `shr_tel` varchar(30) NOT NULL COMMENT '收货人电话',
  `shr_address` varchar(30) NOT NULL COMMENT '收货人地址',
  `total_price` decimal(10,2) NOT NULL COMMENT '定单总价',
  `post_method` varchar(30) NOT NULL COMMENT '发货方式',
  `pay_method` varchar(30) NOT NULL COMMENT '支付方式',
  `pay_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '支付状态，0：未支付 1：已支付',
  `post_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发货状态，0：未发货 1：已发货 2：已收到货',
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='定单基本信息' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ecshop_order`
--

INSERT INTO `ecshop_order` (`id`, `member_id`, `addtime`, `shr_name`, `shr_province`, `shr_city`, `shr_area`, `shr_tel`, `shr_address`, `total_price`, `post_method`, `pay_method`, `pay_status`, `post_status`) VALUES
(1, 1, 1481201743, '钟林生', '上海', '东城区', '西二旗', '18296764976', '江西省', '2.00', '顺风', '支付宝', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_order_goods`
--

CREATE TABLE IF NOT EXISTS `ecshop_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` mediumint(8) unsigned NOT NULL COMMENT '定单id',
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员id',
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品ID',
  `goods_attr_id` varchar(30) NOT NULL DEFAULT '' COMMENT '选择的属性的ID，如果有多个用，隔开',
  `goods_attr_str` varchar(150) NOT NULL DEFAULT '' COMMENT '选择的属性的字符串',
  `goods_price` decimal(10,2) NOT NULL COMMENT '商品的价格',
  `goods_number` int(10) unsigned NOT NULL COMMENT '购买的数量',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `goods_id` (`goods_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='定单商品' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ecshop_order_goods`
--

INSERT INTO `ecshop_order_goods` (`id`, `order_id`, `member_id`, `goods_id`, `goods_attr_id`, `goods_attr_str`, `goods_price`, `goods_number`) VALUES
(1, 1, 1, 2, '1,4,6', '像素:1600万<br />内存:16G<br />颜色:白色', '1.00', 2);

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_reply`
--

CREATE TABLE IF NOT EXISTS `ecshop_reply` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) NOT NULL COMMENT '回复的内容',
  `addtime` int(10) unsigned NOT NULL COMMENT '回复时间',
  `member_id` mediumint(8) unsigned NOT NULL COMMENT '会员ID',
  `comment_id` mediumint(8) unsigned NOT NULL COMMENT '评论的ID',
  PRIMARY KEY (`id`),
  KEY `comment_id` (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='回复' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_role`
--

CREATE TABLE IF NOT EXISTS `ecshop_role` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL COMMENT '角色名称',
  `auth_id` varchar(500) NOT NULL COMMENT '拥有的权限的id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='角色表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ecshop_role`
--

INSERT INTO `ecshop_role` (`id`, `role_name`, `auth_id`) VALUES
(1, '商品管理员', '1,2,3,4,5,6,7,8,9'),
(2, '商品分类管理员', '1,6,7,8,9'),
(3, '超级管理员', '1,2,3,4,5,33,43,44,45,48,6,7,8,9,24,25,26,27,28,29,30,31,34,35,36,37,46,47,10,11,12,13,14,15,16,17,18,19,20,21,22,23,38,39,40,41,42');

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_type`
--

CREATE TABLE IF NOT EXISTS `ecshop_type` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) NOT NULL COMMENT '商品类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='类型表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ecshop_type`
--

INSERT INTO `ecshop_type` (`id`, `type_name`) VALUES
(1, '手机'),
(2, '书'),
(3, '光盘');

-- --------------------------------------------------------

--
-- 表的结构 `ecshop_youhui_price`
--

CREATE TABLE IF NOT EXISTS `ecshop_youhui_price` (
  `goods_id` mediumint(8) unsigned NOT NULL COMMENT '商品id',
  `youhui_num` int(10) unsigned NOT NULL COMMENT '数量',
  `youhui_price` decimal(10,2) NOT NULL COMMENT '优惠价格',
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品的优惠价格';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
