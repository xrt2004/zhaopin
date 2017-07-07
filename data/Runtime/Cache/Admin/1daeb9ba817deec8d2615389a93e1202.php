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
	var URL = '/zhaopin42/index.php/admin/syslog',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=syslog&amp;a=index',
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
    <div class="toptip">
		<h2>提示：</h2>
		<p>您可以通过错误日志查看系统运行错误信息。</p>
	</div>
	<div class="seltpye_x">
		<div class="left">日志类型</div>	
		<div class="right">
			<a href="<?php echo P(array('type_id'=>'','l_type'=>''));?>" <?php if($_GET['l_type']== ''): ?>class="select"<?php endif; ?>>不限</a>
			<a href="<?php echo P(array('type_id'=>'','l_type'=>1));?>" <?php if($_GET['l_type']== 1): ?>class="select"<?php endif; ?>>MYSQL</a>
			<a href="<?php echo P(array('type_id'=>'','l_type'=>2));?>" <?php if($_GET['l_type']== 2): ?>class="select"<?php endif; ?>>MAIL</a> 
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="seltpye_x">
		<div class="left">创建时间</div>	
		<div class="right">
			<a href="<?php echo P(array('settr'=>''));?>" <?php if($_GET['settr']== ''): ?>class="select"<?php endif; ?>>不限</a>
			<a href="<?php echo P(array('settr'=>3));?>" <?php if($_GET['settr']== 3): ?>class="select"<?php endif; ?>>三天内</a>
			<a href="<?php echo P(array('settr'=>7));?>" <?php if($_GET['settr']== 7): ?>class="select"<?php endif; ?>>一周内</a>
			<a href="<?php echo P(array('settr'=>30));?>" <?php if($_GET['settr']== 30): ?>class="select"<?php endif; ?>>一月内</a>
			<a href="<?php echo P(array('settr'=>180));?>" <?php if($_GET['settr']== 180): ?>class="select"<?php endif; ?>>半年内</a>
			<a href="<?php echo P(array('settr'=>360));?>" <?php if($_GET['settr']== 360): ?>class="select"<?php endif; ?>>一年内</a>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<form id="form1" name="form1" method="post" action="<?php echo U('syslog/delete');?>">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_lan">
		    <tr>
		      <td height="26" width="90"  class="admin_list_tit admin_list_first" >
		      <label id="chkAll"><input type="checkbox" name=" " title="全选/反选" id="chk"/>类型</label></td>
		      <td width="120"  align="center"   class="admin_list_tit">创建时间</td>
		      <td width="100" align="center"  class="admin_list_tit"> IP </td>
		      <td width="100" align="center"  class="admin_list_tit"> IP归属地</td>
		      <td width="300"     class="admin_list_tit">文件</td>
		      <td   class="admin_list_tit" >错误描述</td>
		    </tr>
		    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
		      <td  class="admin_list admin_list_first">
		        <input name="l_id[]" type="checkbox" id="id" value="<?php echo ($list["l_id"]); ?>"/>
				<?php echo ($list["l_type_name"]); ?>
		 	    </td>
				 <td  align="center" class="admin_list" >
				 <?php echo admin_date($list['l_time']);?>
			    </td>
		        <td align="center"  class="admin_list"><?php echo ($list["l_ip"]); ?></td>
		        <td align="center"  class="admin_list"><?php echo ((isset($list["l_address"]) && ($list["l_address"] !== ""))?($list["l_address"]):"未知"); ?></td>
		         <td  class="admin_list vtip"   title="<?php echo urldecode($list['l_page']);?>"><?php echo urldecode($list['l_page']);?></td>
		        <td   class="admin_list"  title="<?php echo ($list["l_str"]); ?>"><?php echo ($list["l_str"]); ?></td>
		      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    	</table>
		<?php if(empty($list)): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
		<table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
			<tr>
				<td>
					<input type="submit" class="admin_submit" id="ButDel"  value="删除所选"/>
					<input type="button" class="admin_submit" id="ButPidel"  value="批量删除" onClick="window.location='<?php echo U('syslog/pidel_syslog');?>'"/>
				</td>
				<td width="305" align="right">
				</td>
			</tr>
		</table>
	</form>
	<div class="qspage"><?php echo ($page); ?></div>
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