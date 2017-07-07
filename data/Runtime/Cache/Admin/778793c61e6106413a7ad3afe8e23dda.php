<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7">
<link rel="shortcut icon" href="<?php echo C('qscms_site_dir');?>favicon.ico" />
<meta name="author" content="骑士CMS" />
<meta name="copyright" content="74cms.com" />
<title> Powered by 74CMS</title>
<link href="__ADMINPUBLIC__/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.min.js"></script>
</head>
<body style="background-color:#E0F0FE;">
	<div class="admin_main_nr_dbox">
	<div class="pagetit">
	<div class="ptit">骑士人才系统管理中心</div>
	  <div class="clear"></div>
	</div>
	<div class="toptit">系统提示</div>
	<div class="showmsg">
		  <div class="left <?php if($status == 1): ?>m2<?php else: ?>m1<?php endif; ?>">
		  </div>
		   <div class="right">
		   <h2><?php echo ($message); ?></h2>
		   <div id="redirectionMsg">将在 <span id="spanSeconds"><?php echo ($waitSecond); ?></span> 秒后自动跳转。</div>
		   <ul style="margin:0;list-style:none" >
			<li><a href="<?php echo ($jumpUrl); ?>" ><?php echo ((isset($previous) && ($previous !== ""))?($previous):"返回上一页"); ?></a></li>
			</ul>
		   </div>
		   <div class="clear"></div>
	</div>
	</div>
	<div class="footer link_lan">
Powered by <a href="http://www.74cms.com" target="_blank"><span style="color:#009900">74</span><span style="color: #FF3300">CMS</span></a> </div>
<div class="admin_frameset">
  <div class="open_frame" title="全屏" id="open_frame" style="display: block;"></div>
  <div class="close_frame" title="还原窗口" id="close_frame" style="display: none;"></div>
</div>
</body>
</html>
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.grid.rowSizing.pack.js"></script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/common.js"></script>
<script language="JavaScript">

var seconds = "<?php echo ($waitSecond); ?>";
var defaultUrl = "<?php echo ($jumpUrl); ?>";

onload = function()
{
  if (defaultUrl == 'javascript:history.go(-1)' && window.history.length == 0)
  {
    document.getElementById('redirectionMsg').innerHTML = '';
    return;
  }

  window.setInterval(redirection, 1000);
}
function redirection()
{
  if (seconds <= 0)
  {
    window.clearInterval(redirection);
    return;
  }

  seconds --;
  document.getElementById('spanSeconds').innerHTML = seconds;

  if (seconds == 0)
  {
    window.clearInterval(redirection);
    location.href = defaultUrl;
  }
}
function refresh_affair(){
	window.parent.window.document.getElementById('leftFrame').contentWindow.refresh_affair();
	window.parent.window.document.getElementById('topFrame').contentWindow.refresh_affair();
}
<?php if($status == 1): ?>refresh_affair();<?php endif; ?>
</script>