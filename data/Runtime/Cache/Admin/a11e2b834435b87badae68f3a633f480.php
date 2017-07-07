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
		SELF = '/zhaopin42/index.php?m=admin&amp;c=config&amp;a=reg',
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
	<div class="toptit">注册设置</div>
	<form action="<?php echo U('config/edit');?>" method="post"  name="form1" id="form1">
	<table width="100%" border="0" cellspacing="10" cellpadding="1" style=" margin-bottom:3px; margin-top:10px;">
		<tr>
				<td align="right">关闭会员注册：</td>
				<td>
					<label>
					<input name="closereg" type="radio" id="closereg" value="0" <?php if(C('qscms_closereg') == 0): ?>checked="checked"<?php endif; ?>/>否</label>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<label >
					<input type="radio" name="closereg" value="1" <?php if(C('qscms_closereg') == 1): ?>checked="checked"<?php endif; ?>/>是</label>
				</td>
			</tr>
			
			<tr>
				<td align="right">邮件注册会员激活：</td>
				<td>
					<label>
					<input name="check_reg_email" type="radio" id="check_reg_email" value="0" <?php if(C('qscms_check_reg_email') == 0): ?>checked="checked"<?php endif; ?>/>否</label>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<label >
					<input type="radio" name="check_reg_email" value="1" <?php if(C('qscms_check_reg_email') == 1): ?>checked="checked"<?php endif; ?>/>是</label>
					
					<span class="admin_note" >（如选择必须激活，邮箱注册成后系统会发一份邮件到注册邮箱，点击链接激活后才能注册成功）</span>
				</td>
			</tr>
		<tr>
			<td width="180" align="right">手机注册用户名前缀：</td>
			<td > 
				<input name="reg_prefix" type="text"  class="input_text_200" id="reg_prefix" value="<?php echo C('qscms_reg_prefix');?>" maxlength="10"/>
				<span class="admin_note" >（手机注册会自动生成用户名，生成规则：随机字符+手机号，如:user_18636535353）</span>
			</td>
		</tr>
		<tr>
			<td width="180" align="right">邮箱注册用户名前缀：</td>
			<td > 
				<input name="email_reg_prefix" type="text"  class="input_text_200" id="email_reg_prefix" value="<?php echo C('qscms_email_reg_prefix');?>" maxlength="10"/>
				<span class="admin_note" >（邮箱注册会自动生成用户名，生成规则：随机字符+邮箱，如:user_1234qqcom）</span>
			</td>
		</tr>
		<tr>
			<td width="180" align="right">第三方注册生成用户名前缀：</td>
			<td > 
			<input name="third_reg_prefix" type="text"  class="input_text_200" id="third_reg_prefix" value="<?php echo C('qscms_third_reg_prefix');?>" maxlength="10"/> <span class="admin_note" >第三方注册是指微信注册，QQ注册后生成的用户名</span>
			</td>
		</tr>
		<tr>
			<td width="180" align="right">快速注册生成密码：</td>
			<td  id="reg_weixin_password_tpye">
				<label>
					<input name="reg_password_tpye"  type="radio" value="1" <?php if(C('qscms_reg_password_tpye') == 1): ?>checked="checked"<?php endif; ?>/>
					与用户名相同
				</label>&nbsp;&nbsp;&nbsp;
				<label>
					<input name="reg_password_tpye"  type="radio" value="2" <?php if(C('qscms_reg_password_tpye') == 2): ?>checked="checked"<?php endif; ?>/>
					随机密码
				</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label>
					<input name="reg_password_tpye"  type="radio" value="3" <?php if(C('qscms_reg_password_tpye') == 3): ?>checked="checked"<?php endif; ?>/>
					指定密码
				</label>&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
		<tr id="config_reg_password" <?php if(C('qscms_reg_password_tpye') != 3): ?>style="display:none"<?php endif; ?>>
			<td width="180" align="right">输入指定密码：</td>
			<td >
				<input name="reg_weixin_password" type="text"  class="input_text_200" id="reg_weixin_password" value="<?php echo C('qscms_reg_weixin_password');?>" maxlength="16"/> 
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
	$('input[name="reg_password_tpye"]').click(function(){
		if($(this).val() == 3){
			$('#config_reg_password').show();
		}else{
			$('#config_reg_password').hide();
		}
	});
</script>
</body>
</html>