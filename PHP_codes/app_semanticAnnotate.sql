-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2013 年 10 月 15 日 10:46
-- 服务器版本: 5.5.23
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `app_semanticannotate`
--
CREATE DATABASE app_semanticannotate;
USE app_semanticannotate;
-- --------------------------------------------------------

--
-- 表的结构 `charge`
--

CREATE TABLE IF NOT EXISTS `charge` (
  `sent` varchar(300) NOT NULL,
  `tagsent` varchar(300) NOT NULL,
  `annoter` varchar(50) NOT NULL,
  `tagtime` varchar(30) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `chargetime` varchar(30) NOT NULL,
  `result` int(11) NOT NULL,
  `adminname` varchar(50) NOT NULL,
  `chargecomment` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `charge`
--


--
-- 表的结构 `dependancy`
--

CREATE TABLE IF NOT EXISTS `dependancy` (
  `sentid` int(11) NOT NULL,
  `sent` varchar(1500) CHARACTER SET gbk NOT NULL,
  `dep_sent` varchar(1500) CHARACTER SET gbk NOT NULL,
  `res_sent` varchar(1500) CHARACTER SET gbk NOT NULL,
  `tag` char(2) CHARACTER SET gbk DEFAULT NULL,
  `annoter` varchar(50) CHARACTER SET gbk NOT NULL,
  `time` varchar(30) CHARACTER SET gbk NOT NULL,
  `skip` int(11) NOT NULL,
  `comment` varchar(50) CHARACTER SET gbk NOT NULL,
  PRIMARY KEY (`sentid`,`annoter`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dependancy`
--


--
-- 表的结构 `dep_charge`
--

CREATE TABLE IF NOT EXISTS `dep_charge` (
  `sentid` int(11) NOT NULL,
  `sent` varchar(300) CHARACTER SET gbk NOT NULL,
  `res_sent` varchar(1000) CHARACTER SET gbk NOT NULL,
  `annoter` varchar(50) CHARACTER SET gbk NOT NULL,
  `res_time` varchar(50) CHARACTER SET gbk NOT NULL,
  `comment` varchar(500) CHARACTER SET gbk NOT NULL,
  `chargetime` varchar(50) CHARACTER SET gbk NOT NULL,
  `result` int(11) NOT NULL,
  `adminname` varchar(30) CHARACTER SET gbk NOT NULL,
  `chargecomment` varchar(500) CHARACTER SET gbk NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `dep_charge`
--

--
-- 表的结构 `dep_sentence`
--

CREATE TABLE IF NOT EXISTS `dep_sentence` (
  `sentid` int(11) NOT NULL AUTO_INCREMENT,
  `sent` varchar(1500) CHARACTER SET gbk NOT NULL,
  `proto_depsent` varchar(1500) CHARACTER SET gbk NOT NULL,
  `done` int(11) NOT NULL,
  PRIMARY KEY (`sentid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102904 ;

--
-- 转存表中的数据 `dep_sentence`
--

--
-- 表的结构 `fillout`
--

CREATE TABLE IF NOT EXISTS `signup` (
  `uid` varchar(20) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `times` int(11) NOT NULL,
  `regtime` char(40) DEFAULT NULL,
  `complete` int(11) NOT NULL,
  `firstweek` int(11) DEFAULT NULL,
  `secondweek` int(11) DEFAULT NULL,
  `fourweek` int(11) DEFAULT NULL,
  `dep_compelete` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `signup`
--

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh" lang="zh" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <title>phpMyAdmin</title>
    <link rel="stylesheet" type="text/css" href="phpmyadmin.css.php?token=a33601048e3089fdca998aca4e76236e&amp;js_frame=right&amp;nocache=4123446157" />
    <link rel="stylesheet" type="text/css" href="print.css" media="print" />
    <meta name="robots" content="noindex,nofollow" />
<script type="text/javascript">
//<![CDATA[
try {
    // can't access this if on a different domain
    var topdomain = top.document.domain;
    // double-check just for sure
    if (topdomain != self.document.domain) {
        alert("Redirecting...");
        top.location.replace(self.document.URL.substring(0, self.document.URL.lastIndexOf("/")+1));
    }
}
catch(e) {
    alert("Redirecting... (error: " + e);
    top.location.replace(self.document.URL.substring(0, self.document.URL.lastIndexOf("/")+1));
}
//]]>
</script>
<script src="./js/tooltip.js" type="text/javascript"></script>
<script type="text/javascript">
// <![CDATA[
// Updates the title of the frameset if possible (ns4 does not allow this)
if (typeof(parent.document) != 'undefined' && typeof(parent.document) != 'unknown'
    && typeof(parent.document.title) == 'string') {
    parent.document.title = 'pma.tools.sinaapp.com / w.rdc.sae.sina.com.cn / app_semanticannotate / sentence | phpMyAdmin 3.3.8.1';
}

var PMA_messages = new Array();
window.parent.addEvent(window, 'load', PMA_TT_init);
// ]]>
</script>
    <meta name="OBGZip" content="true" />
        <!--[if IE 6]>
    <style type="text/css">
    /* <![CDATA[ */
    html {
        overflow-y: scroll;
    }
    /* ]]> */
    </style>
    <![endif]-->
</head>

<body>
    <div id="serverinfo">
<a href="main.php?token=a33601048e3089fdca998aca4e76236e" class="item">        <img class="icon" src="./themes/original/img/s_host.png" width="16" height="16" alt="" /> 
w.rdc.sae.sina.com.cn:3307</a>
        <span class="separator"><img class="icon" src="./themes/original/img/item_ltr.png" width="5" height="9" alt="-" /></span>
<a href="db_structure.php?db=app_semanticannotate&amp;token=a33601048e3089fdca998aca4e76236e" class="item">        <img class="icon" src="./themes/original/img/s_db.png" width="16" height="16" alt="" /> 
app_semanticannotate</a>
        <span class="separator"><img class="icon" src="./themes/original/img/item_ltr.png" width="5" height="9" alt="-" /></span>
<a href="sql.php?db=app_semanticannotate&amp;table=sentence&amp;token=a33601048e3089fdca998aca4e76236e" class="item">        <img class="icon" src="./themes/original/img/s_tbl.png" width="16" height="16" alt="" /> 
sentence</a>
</div>
<!-- PMA-SQL-ERROR -->
    <div class="error"><h1>错误</h1>
    <p><strong>SQL 查询:</strong>
<a href="tbl_sql.php??sql_query=SHOW+TABLE+STATUS+FROM+%60app_semanticannotate%60+LIKE+%27sentence%27&amp;show_query=1&amp;db=app_semanticannotate&amp;table=sentence&amp;token=a33601048e3089fdca998aca4e76236e"><img src="./themes/original/img/b_edit.png" title="编辑" alt="编辑" class="icon" width="16" height="16" /></a>    </p>
    <p>
        <span class="syntax"><span class="syntax_alpha syntax_alpha_reservedWord">SHOW</span>  <span class="syntax_alpha syntax_alpha_reservedWord">TABLE</span>  <span class="syntax_alpha syntax_alpha_reservedWord">STATUS</span>  <span class="syntax_alpha syntax_alpha_reservedWord">FROM</span>  <span class="syntax_quote syntax_quote_backtick">`app_semanticannotate`</span>  <span class="syntax_alpha syntax_alpha_reservedWord">LIKE</span>  <span class="syntax_quote syntax_quote_single">'sentence'</span></span>
    </p>
<p>
    <strong>MySQL 返回：</strong><a href="http://dev.mysql.com/doc/refman/5.1/zh/error-messages-server.html" target="mysql_doc"><img class="icon" src="./themes/original/img/b_help.png" width="11" height="11" alt="文档" title="文档" /></a>
</p>
<code>
#2006 - MySQL server has gone away
</code><br />
</div><script type="text/javascript">
//<![CDATA[
// updates current settings
if (window.parent.setAll) {
    window.parent.setAll('zh-utf-8', 'utf8_general_ci', '1', 'app_semanticannotate', 'sentence', 'a33601048e3089fdca998aca4e76236e');
}
    // set current db, table and sql query in the querywindow
if (window.parent.reload_querywindow) {
    window.parent.reload_querywindow(
        'app_semanticannotate',
        'sentence',
        '');
}
    
if (window.parent.frame_content) {
    // reset content frame name, as querywindow needs to set a unique name
    // before submitting form data, and navigation frame needs the original name
    if (typeof(window.parent.frame_content.name) != 'undefined'
     && window.parent.frame_content.name != 'frame_content') {
        window.parent.frame_content.name = 'frame_content';
    }
    if (typeof(window.parent.frame_content.id) != 'undefined'
     && window.parent.frame_content.id != 'frame_content') {
        window.parent.frame_content.id = 'frame_content';
    }
    //window.parent.frame_content.setAttribute('name', 'frame_content');
    //window.parent.frame_content.setAttribute('id', 'frame_content');
}
//]]>
</script>
</body>
</html>