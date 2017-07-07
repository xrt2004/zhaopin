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
	var URL = '/zhaopin42/index.php/admin/config',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=config&amp;a=other',
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
	<div class="toptit">搜索设置</div>
	<form action="<?php echo U('config/edit');?>" method="post"  name="form1" id="form1">
	<table width="100%" border="0" cellspacing="10" cellpadding="1" style=" margin-bottom:3px; margin-top:10px;">
		<tr>
				<td align="right" width="200">开启关键词URL编码：</td>
				<td>
					<label>
					<input name="key_urlencode" type="radio" id="key_urlencode" value="0" <?php if(C('qscms_key_urlencode') == 0): ?>checked="checked"<?php endif; ?>/>否</label>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<label >
					<input type="radio" name="key_urlencode" value="1" <?php if(C('qscms_key_urlencode') == 1): ?>checked="checked"<?php endif; ?>/>是</label>
					<span class="admin_note" >（当关键词搜索出现乱码时，请开启此项）</span>
				</td>
			</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td height="50">
				<span style="font-size:14px;">
					<input name="submit2" type="submit" class="admin_submit" value="保存修改"/>
				</span>
			</td>
		</tr>
	</table>
	</form>
	<div class="toptit">薪资单位设置</div>
	<form action="<?php echo U('config/edit');?>" method="post"  name="form1" id="form1">
	<table width="100%" border="0" cellspacing="10" cellpadding="1" style=" margin-bottom:3px; margin-top:10px;">
		<tr>
				<td align="right" width="200">薪资单位：</td>
				<td>
					<label>
					<input name="wage_unit" type="radio" id="key_urlencode" value="1" <?php if(C('qscms_wage_unit') == 1): ?>checked="checked"<?php endif; ?>/>K</label>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<label >
					<input type="radio" name="wage_unit" value="2" <?php if(C('qscms_wage_unit') == 2): ?>checked="checked"<?php endif; ?>/>千</label>
					<span class="admin_note" >（如：1.5K~3K ，8千5~1万）</span>
				</td>
			</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td height="50">
				<span style="font-size:14px;">
					<input type="submit" class="admin_submit" value="保存修改"/>
				</span>
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