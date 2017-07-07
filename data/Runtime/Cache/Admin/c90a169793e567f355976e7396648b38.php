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
		SELF = '/zhaopin42/index.php?m=admin&amp;c=config&amp;a=map',
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
	<div class="toptip link_lan">
		<h2>提示：</h2>
		<p>
	电子地图API的服务是由<a href="http://developer.baidu.com/" target="_blank"><strong>百度</strong></a>提供，任何非盈利性网站均可使用。请参阅<a href="http://developer.baidu.com/" target="_blank"><strong>使用条款</strong></a>获得详细信息。<br />
	        如用于商业用途，需要同百度地图另行达成协议或获得百度地图的书面许可
	        使用电子地图，百度地图相应的ak。 现在就去<a href="http://developer.baidu.com/" target="_blank">申请</a>
		</p>
	</div>
	<div class="toptit">电子地图设置</div>
	<form action="<?php echo U('config/edit');?>" method="post"  name="form1" id="form1">
		<table width="100%" border="0" cellspacing="5" cellpadding="0">
			<tr>
			<td valign="top">
				<table width="100%" border="0" cellpadding="1" cellspacing="5"  class="link_lan" style=" margin-bottom:3px;">
					<!-- -->
					<tr>
						<td width="120" align="right">百度地图AK:</td>
						<td width="200" height="25"><input name="map_ak" type="text" value="<?php echo C('qscms_map_ak');?>"  id="map_ak"  class="input_text_200"  style="color:#009900; font-weight:bold"/></td>
					</tr>
					<tr>
						<td width="120" align="right">默认中心点X坐标：</td>
						<td width="200" height="25"><input name="map_center_x" type="text" value="<?php echo C('qscms_map_center_x');?>"  id="map_center_x"  class="input_text_200"  style="color:#009900; font-weight:bold"/></td>
						<td>推动电子地图，系统将自动获取坐标</td>
					</tr>
					<tr>
						<td align="right">默认中心点Y坐标：</td>
						<td height="25"><input name="map_center_y" type="text" value="<?php echo C('qscms_map_center_y');?>"  id="map_center_y"  class="input_text_200" style="color:#009900; font-weight:bold"/></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td align="right">默认缩放级别：</td>
						<td height="25"><input name="map_zoom" type="text" value="<?php echo C('qscms_map_zoom');?>" id="map_zoom"   class="input_text_200" style="color: #009900; font-weight:bold"/></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td align="right">&nbsp;</td>
						<td height="25">
							<input type="hidden" name="type" value="map">
							<input type="submit" class="admin_submit" value="保存修改"/></td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
			</tr>
			<tr>
				<td valign="top">
					<div style="width:600px;height:400px; border:1px #CCCCCC solid" id="container"></div>
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
<script src="http://api.map.baidu.com/api?v=1.2" type="text/javascript"></script>
<script type="text/javascript">
	var map = new BMap.Map("container");       // 创建地图实例   
	var point = new BMap.Point(<?php echo C('qscms_map_center_x');?>,<?php echo C('qscms_map_center_y');?>);  // 创建点坐标   
	map.centerAndZoom(point, <?php echo C('qscms_map_zoom');?>); 
	map.addControl(new BMap.NavigationControl());   
	map.addEventListener("moveend", function(){   
	var center = map.getCenter();
	document.getElementById("map_center_x").value=center.lng; 
	document.getElementById("map_center_y").value= center.lat; 
	document.getElementById("map_zoom").value=map.getZoom();
});   
</script>
</body>
</html>