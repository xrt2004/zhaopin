<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<link rel="shortcut icon" href="<?php echo C('qscms_site_dir');?>favicon.ico" />
	<title>网站后台管理中心 </title>
</head>
	<frameset rows="70,*" frameborder="no" border="0" framespacing="0" >
	        <frame src="<?php echo U('index/top_menu');?>" name="topFrame" id="topFrame" scrolling="no" frameborder="NO" border="0" framespacing="0">
	        <frameset cols="200,*"  name="bodyFrame" id="bodyFrame" frameborder="no" border="0" framespacing="0">
	            <frame src="<?php echo U('index/left_menu');?>" name="leftFrame" frameborder="no" scrolling="no" noresize id="leftFrame">
	            <frame src="<?php echo U('index/panel');?>" name="mainFrame" frameborder="no" scrolling="auto" noresize id="mainFrame">
	        </frameset>
	</frameset>
    <noframes>
        <body>你的浏览器不支持框架</body>
    </noframes>

</html>