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
	var URL = '/zhaopin42/index.php/admin/sys_email_log',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=sys_email_log&amp;a=index',
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
		<p>此列表为您系统发送的邮件列表</p>
	</div>
	<div class="seltpye_x">
		<div class="left">筛选类型</div>	
		<div class="right">
			<a href="<?php echo P(array('state'=>''));?>" <?php if($_GET['state']== ''): ?>class="select"<?php endif; ?>>不限</a>
			<a href="<?php echo P(array('state'=>1));?>" <?php if($_GET['state']== 1): ?>class="select"<?php endif; ?>>发送成功</a>
			<a href="<?php echo P(array('state'=>2));?>" <?php if($_GET['state']== 2): ?>class="select"<?php endif; ?>>发送失败</a>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<form method="post">
	    <table width="100%" border="0" cellpadding="0" cellspacing="0"  id="list" class="link_lan">
			<tr>
				<td  width="120" class="admin_list_tit admin_list_first">
					<label id="chkAll"><input type="checkbox" name="" title="全选/反选" id="chk"/>状态</label>
				</td>
				<td class="admin_list_tit" width="13%">发送帐号</td>
				<td class="admin_list_tit" width="13%">收件地址</td>
				<td  class="admin_list_tit">邮件主题</td>
				<td width="110"  align="center"  class="admin_list_tit">发送时间</td>
				<td width="110"  align="center"  class="admin_list_tit">操作</td>
			</tr>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
					<td class="admin_list admin_list_first">
						<input type="checkbox" name="id[]"  value="<?php echo ($list["id"]); ?>"/>
						<?php if($list['state'] == 1): ?><span style="color: #009900">发送成功</span><?php endif; ?>
						<?php if($list['state'] == 2): ?><span style="color: #666666">发送失败</span><?php endif; ?>
					</td>
					<td  class="admin_list"><?php echo ($list["send_from"]); ?></td>
					<td  class="admin_list"><?php echo ($list["send_to"]); ?></td>
					<td  class="admin_list vtip" title="<?php echo (nl2br($list["subject"])); ?>" ><?php echo ($list["subject"]); ?></td>
					<td  align="center"  class="admin_list"><?php echo admin_date($list['sendtime']);?></td>
					<td  align="center"  class="admin_list">
						<a href="<?php echo U('show',array('id'=>$list['id']));?>">查看</a>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		<?php if(empty($list)): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
	</form>	
	<table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
		<tr>
			<td>&nbsp;</td>
	    	<td width="305">
		      	<form id="formseh" name="formseh" method="get" action="">
		      		<input type="hidden" name="m" value="<?php echo C('admin_alias');?>">
	                <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
	                <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
					<div class="seh">
					    <div class="keybox">
					    	<input name="key" type="text"   value="<?php echo ($_GET['key']); ?>" />
					    </div>
					    <div class="selbox">
							<input id="key_type_cn" type="text" value="<?php echo ((isset($_GET['key_type_cn']) && ($_GET['key_type_cn'] !== ""))?($_GET['key_type_cn']):"邮件主题"); ?>" readonly="true"/>
							<div>
								<input name="key_type" id="key_type" type="hidden" value="<?php echo ((isset($_GET['key_type']) && ($_GET['key_type'] !== ""))?($_GET['key_type']):'1'); ?>"/>
								<div id="sehmenu" class="seh_menu">
									<ul>
										<li id="1" title="邮件主题">邮件主题</li>
										<li id="2" title="收件地址">收件地址</li>
										<li id="3" title="发送帐号">发送帐号</li>
									</ul>
								</div>
							</div>				
						</div>
						<div class="sbtbox">
							<input type="submit" class="sbt" id="sbt" value="搜索"/>
						</div>
						<div class="clear"></div>
					</div>
				</form>
			</td>
    	</tr>
	</table>
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
<script type="text/javascript">
	$(document).ready(function(){
		showmenu("#key_type_cn","#sehmenu","#key_type");
	});
</script>
</body>
</html>