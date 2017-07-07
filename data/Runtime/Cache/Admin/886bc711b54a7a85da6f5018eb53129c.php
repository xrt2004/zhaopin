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
	var URL = '/zhaopin42/index.php/admin/mail_templates',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=mail_templates&amp;a=index',
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
		<p>你可以用HTML美化邮件内容模板。</p>
		<p>当默认模板库有更新时，你可以点击“模板同步”按钮更新当前模板。默认模板库文件目录：/Application/Common/qscmslib/mailtpl/</p>
	</div>
	<div class="toptit">邮件发送模板</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td height="30" style="font-size:12px;padding-left:20px;">
				<form action="<?php echo U('sync');?>" method="post"   name="form1" id="form1">
					<table width="242" border="0" cellspacing="7" cellpadding="1" style=" margin-bottom:3px;" class="link_lan">
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
								<td width="137" align="right"><?php echo ($list["name"]); ?>：</td>
								<td width="80"><a href="<?php echo U('MailTemplates/edit',array('id'=>$list['id']));?>">[编辑模板]</a>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="alias[]" value="<?php echo ($list["alias"]); ?>"></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						<tr>
							<td width="137" align="right">&nbsp;</td>
							<td width="80"><input name="save" type="submit" class="admin_submit" value="模板同步" onclick="javascript:confirm('模板同步将会覆盖你自定义的内容，确定要进行此操作吗？');"/></td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
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