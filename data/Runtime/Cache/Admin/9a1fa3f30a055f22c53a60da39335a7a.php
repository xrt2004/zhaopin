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
	var URL = '/zhaopin42/index.php/admin/sms',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=sms&amp;a=config_edit',
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
	<div class="toptip link_g">
		<h2>提示：</h2>
		<p>
		短信模块属收费模块，需申请开通后才能使用，请点击 <a href="http://www.74cms.com/sms.php" target="_blank">这里</a> 申请开通。
		<br />
		资费标准请联系骑士销售获取，更多介绍请进入 <a href="http://www.74cms.com" target="_blank">骑士人才系统官方网站</a></p>
		<p><font color="red">开启短信发送服务前，请确认短信服务商已正确配置！</font></p>
	</div>
	<div class="toptit">设置</div>
	<form action="<?php echo U('sms/config_edit');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
			<tr>
				<td width="121" align="right">开启短信发送：</td>
				<td>
					<label>
						<input name="sms_open" class="J_sms_open" id="J_sms_open_1" type="radio" value="1" <?php if(C('qscms_sms_open') == 1): ?>checked="checked"<?php endif; ?>/> 开启
					</label>&nbsp;&nbsp;&nbsp;
				<label>
					<input name="sms_open"  class="J_sms_open" type="radio" value="0" <?php if(C('qscms_sms_open') == 0): ?>checked="checked"<?php endif; ?>/>关闭</label>			  </td>
			</tr>
			</table>
			<table width="100%" border="0" cellspacing="5" cellpadding="5" id="j_show" <?php if(C('qscms_sms_open') == 0): ?>style="display:none"<?php endif; ?>>
			<tr>
				<td width="120" height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">默认短信服务商：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<select name="sms_default_service" style="width:200px">
						<option value="" <?php if(C('qscms_sms_default_service') == ''): ?>selected="selected"><?php endif; ?>>请选择短信服务商</option>
						<?php if(is_array($sms_list)): $i = 0; $__LIST__ = $sms_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sms): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($key == C('qscms_sms_default_service')): ?>selected="selected"<?php endif; ?>><?php echo ($sms["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					（请在“服务商接入”栏目下安装短信接口）
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">验证码类短信服务商：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<select name="sms_captcha_service" style="width:200px">
						<option value="" <?php if(C('qscms_sms_captcha_service') == ''): ?>selected="selected"><?php endif; ?>>请选择短信服务商</option>
						<?php if(is_array($sms_list)): $i = 0; $__LIST__ = $sms_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sms): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($key == C('qscms_sms_captcha_service')): ?>selected="selected"<?php endif; ?>><?php echo ($sms["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					（请在“服务商接入”栏目下安装短信接口）
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">通知类短信服务商：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<select name="sms_notice_service" style="width:200px">
						<option value="" <?php if(C('qscms_sms_notice_service') == ''): ?>selected="selected"><?php endif; ?>>请选择短信服务商</option>
						<?php if(is_array($sms_list)): $i = 0; $__LIST__ = $sms_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sms): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($key == C('qscms_sms_notice_service')): ?>selected="selected"<?php endif; ?>><?php echo ($sms["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					（请在“服务商接入”栏目下安装短信接口）
				</td>
			</tr>
			<tr>
				<td height="30" align="right" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed">其它类短信服务商：</td>
				<td bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed" >
					<select name="sms_other_service" style="width:200px">
						<option value="" <?php if(C('qscms_sms_other_service') == ''): ?>selected="selected"<?php endif; ?>>请选择短信服务商</option>
						<?php if(is_array($sms_list)): $i = 0; $__LIST__ = $sms_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sms): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($key == C('qscms_sms_other_service')): ?>selected="selected"<?php endif; ?>><?php echo ($sms["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					（请在“服务商接入”栏目下安装短信接口）
				</td>
			</tr>
			<table width="100%" border="0" cellspacing="5" cellpadding="5" >
			<tr>
				<td align="right" width="120" >&nbsp;</td>
				<td height="50"> 
					<input type="submit" class="admin_submit"    value="保存修改"/>
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
  $(".J_sms_open").click(function(){
    if($("#J_sms_open_1").is(':checked')){
      $("#j_show").show();
    }else{
      $("#j_show").hide();
    }
  });
</script>
</body>
</html>