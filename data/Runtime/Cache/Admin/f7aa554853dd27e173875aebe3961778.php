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
	var URL = '/zhaopin42/index.php/admin/admin',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=admin&amp;a=add',
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
			        <?php if(is_array($sub_menu['menu'])): $i = 0; $__LIST__ = $sub_menu['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><a href="<?php echo U($val['module_name'].'/'.$val['controller_name'].'/'.$val['action_name']); echo ($val["data"]); if($isget and $_GET): echo get_first(); endif; if($_GET['_k_v']): ?>&_k_v=<?php echo ($_GET['_k_v']); endif; ?>" class="<?php echo ($val["class"]); ?>"><u><?php echo ($val["name"]); ?></u></a><?php endforeach; endif; else: echo "" ;endif; ?>
				    <div class="clear"></div>
				</div><?php endif; ?>
	        <div class="clear"></div>
	    </div>
    <div class="toptip">
        <h2>提示：</h2>
        <p>通过管理员设置，您可以进行编辑管理员资料、角色、密码以及删除管理员等操作；</p>
    </div>
    <div class="toptit">新增管理员</div>
	<form id="form1" name="form1" method="post" action="<?php echo U('admin/add');?>">
		<table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
			<tr>
				<td width="120" height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">用户名：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">
					<input name="username" type="text" class="input_text_200" id="admin_name" maxlength="25" value=""/>
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">电子邮件：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<input name="email" type="text" class="input_text_200" id="old_emailpwd" maxlength="25" value=""/>
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">密码：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<input name="password" type="password" class="input_text_200" id="password" maxlength="25" value=""/>
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">再次输入密码：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<input name="repassword" type="password" class="input_text_200" id="password1" maxlength="25" value=""/>
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">所属角色：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<select name="role_id">
						<?php if(is_array($roles)): $i = 0; $__LIST__ = $roles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($role); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<a onclick="link(this);" href="javascript:;" url="<?php echo U('AdminRole/auth',array('id'=>'qscms','url'=>"/zhaopin42/index.php?m=admin&amp;c=admin&amp;a=add"));?>" style="color:#003399">查看权限</a>
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" >&nbsp;</td>
				<td height="50" bgcolor="#FFFFFF" > 
					<input name="submit3" type="submit" class="admin_submit"    value="添加"/>
					<input name="submit22" type="button" class="admin_submit"    value="返回" onclick="window.location='<?php echo U('admin/index');?>'"/>
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
<script type="text/javascript">
	function link(a){
		var id = $('select[name="role_id"]').val(),
			a = $(a).attr('url');
		a = a.replace('qscms',id);
		window.location=a;
	}
</script>
</body>
</html>