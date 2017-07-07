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
<script>
	var URL = '/zhaopin42/index.php/admin/oauth',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=oauth&amp;a=sina',
		ROOT_PATH = '/zhaopin42/index.php/admin',
		APP	 =	 '/zhaopin42/index.php';
</script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.QSdialog.js"></script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.vtip-min.js"></script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.grid.rowSizing.pack.js"></script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="__ADMINPUBLIC__/js/common.js"></script>
</head>
<body style="background-color:#E0F0FE">
	<div class="admin_main_nr_dbox">
	    <div class="pagetit">
	        <div class="ptit"> <?php if($sub_menu['pageheader']): echo ($sub_menu["pageheader"]); else: ?>欢迎登录 <?php echo C('qscms_site_name');?> 管理中心！<?php endif; ?></div>
	        <?php if(!empty($sub_menu['menu'])): ?><div class="topnav">
			        <?php if(is_array($sub_menu['menu'])): $i = 0; $__LIST__ = $sub_menu['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><a href="<?php echo U($val['module_name'].'/'.$val['controller_name'].'/'.$val['action_name']); echo ($val["data"]); if($isget and $_GET): echo get_first(); endif; ?>
				            <?php if($_GET['_k_v']): ?>&_k_v=<?php echo ($_GET['_k_v']); endif; ?>" class="<?php echo ($val["class"]); ?>"><u><?php echo ($val["name"]); ?></u></a><?php endforeach; endif; else: echo "" ;endif; ?>
				    <div class="clear"></div>
				</div><?php endif; ?>
	        <div class="clear"></div>
	    </div>
<div class="toptip link_lan"  >
  <h2>提示：</h2>
 <p>
网站接入新浪微博帐号登录后，用户只需要使用微博账号密码就可登录，简化用户注册流程，更有效率的提高转化用户流量；
<br />
接入新浪微博登录前，网站需首先进行申请，获得对应的AppKey与AppSecret，以保证后续流程中可正确对网站与用户进行验证与授权。 
现在就去<a href="http://open.weibo.com/" target="_blank">申请</a></p>
</div>

<div class="toptit">新浪微博帐号登录设置</div>
 
    <form action="<?php echo U('oauth/sina');?>" method="post" name="form1" id="form1">
    <table width="700" border="0" cellspacing="6" cellpadding="1" style=" margin-bottom:3px;">
  <tr>
      <td width="150" align="right">开启微博帐号登录：</td>
      <td  >
    <label>
        <input name="status" type="radio"  value="1"  <?php if($info['status'] == '1'): ?>checked=checked<?php endif; ?>/>开启</label>
&nbsp;&nbsp;
<label>
        <input name="status" type="radio"  value="0"  <?php if($info['status'] == '0'): ?>checked=checked<?php endif; ?>/>关闭</label>
    &nbsp;&nbsp;
</td>
    </tr>
  <tr>
      <td width="150" align="right">AppKey：</td>
      <td  >
   <input name="config[app_key]" type="text"  class="input_text_400"  value="<?php echo ($info['config']['app_key']); ?>"  />
</td>
    </tr>
  <tr>
      <td width="150" align="right">AppSecret：</td>
      <td  >
   <input name="config[app_secret]" type="text"  class="input_text_400"  value="<?php echo ($info['config']['app_secret']); ?>"  />
</td>
    </tr>
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td> 
      <input type="hidden" name="id" value="<?php echo ($info['id']); ?>">
      <input name="submit" type="submit" class="admin_submit"    value="保存"/>
    </td>
    </tr>
  </table>
    </form>
</div>
<div class="footer link_lan">
Powered by <a href="http://www.74cms.com" target="_blank"><span style="color:#009900">74</span><span style="color: #FF3300">CMS</span></a> <?php echo C('QSCMS_VERSION');?>
</div>
<div class="admin_frameset" >
  <div class="open_frame" title="全屏" id="open_frame"></div>
  <div class="close_frame" title="还原窗口" id="close_frame"></div>
</div>
</body>
</html>
</body>
</html>