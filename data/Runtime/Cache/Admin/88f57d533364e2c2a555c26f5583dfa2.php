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
	var URL = '/zhaopin42/index.php/admin/payment',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=payment&amp;a=edit&amp;id=2&amp;typename=wxpay',
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
  <p>
安装在线支付插件需申请对应在线支付服务公司的服务账户。
<?php if($_GET['typename']== 'wxpay'): ?><br />
<font color="red">微信支付回调地址要求必须支持伪静态，如需使用微信支付，请保证服务器环境开启伪静态！</font><?php endif; ?>
</p>
</div>
<div class="toptit">
编辑支付方式
</div>
<form action="<?php echo U('edit');?>" method="post" name="form1" id="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="6"  >
<tr>
<td align="right" style="border:0px;">插件名称：</td>
 <td style="border:0px; color: #0066CC">
 <input name="id" type="hidden" value="<?php echo ($info["id"]); ?>" />
 <input name="p_install" type="hidden" value="2" />
 <strong><?php echo ($info["byname"]); ?></strong>
 </td>
 </tr>
<?php if($pay['p_introduction']): ?><tr>
<td align="right"><?php echo ($pay["p_introduction"]); ?></td>
 <td><input name="p_introduction" type="text" class="input_text_400"  value="<?php echo ($info["p_introduction"]); ?>"/></td>
 </tr><?php endif; ?>
<?php if($pay['notes']): ?><tr>
<td align="right" valign="top"><?php echo ($pay["notes"]); ?></td>
 <td>
 <textarea name="notes" id="notes" class="input_textarea_400" style="width:700px;height: 250px; "><?php echo ($info["notes"]); ?></textarea>
 </td>
 </tr><?php endif; ?>
<?php if($pay['partnerid']): ?><tr>
<td align="right"><?php echo ($pay["partnerid"]); ?></td>
 <td><input name="partnerid" type="text" class="input_text_400" value="<?php echo ($info["partnerid"]); ?>" /></td>
 </tr><?php endif; ?>
<?php if($pay['ytauthkey']): ?><tr>
<td align="right"><?php echo ($pay["ytauthkey"]); ?></td>
 <td><input name="ytauthkey" type="text" class="input_text_400" value="<?php echo ($info["ytauthkey"]); ?>"/></td>
 </tr><?php endif; ?>
<?php if($pay['parameter1']): ?><tr>
<td align="right"><?php echo ($pay["parameter1"]); ?></td>
 <td><input name="parameter1" type="text" class="input_text_400"  value="<?php echo ($info["parameter1"]); ?>"/></td>
 </tr><?php endif; ?>
<?php if($pay['parameter2']): ?><tr>
<td align="right"><?php echo ($pay["parameter2"]); ?></td>
 <td><input name="parameter2" type="text" class="input_text_400"  value="<?php echo ($info["parameter2"]); ?>"/></td>
 </tr><?php endif; ?>
<?php if($pay['parameter3']): ?><tr>
<td align="right"><?php echo ($pay["parameter3"]); ?></td>
 <td><input name="parameter3" type="text" class="input_text_400"  value="<?php echo ($info["parameter3"]); ?>" /></td>
 </tr><?php endif; ?>
<tr>
<td align="right">显示顺序：</td>
 <td><input name="listorder" type="text" class="input_text_400" value="<?php echo ($info["listorder"]); ?>" /></td>
 </tr>
 <tr>
<td width="180" align="right"></td>
 <td>
 <input name="submit" type="submit" class="admin_submit"    value="提交"/>
<input name="submit222" type="button" class="admin_submit"    value="返回列表" onclick="Javascript:window.history.go(-1)"/>
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
<link rel="stylesheet" href="__ADMINPUBLIC__/js/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="__ADMINPUBLIC__/js/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="__ADMINPUBLIC__/js/kindeditor/lang/zh_CN.js"></script>
<script>
  var editor;
  KindEditor.ready(function(K) {
    editor = K.create('textarea[name="notes"]', {
      allowFileManager : true,
      filterMode:false
    });
  });
</script>
</body>
</html>