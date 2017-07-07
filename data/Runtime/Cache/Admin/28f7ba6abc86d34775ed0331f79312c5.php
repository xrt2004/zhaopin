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
	var URL = '/zhaopin42/index.php/admin/weixin',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=weixin&amp;a=index',
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
        <p>网站接入微信公众平台后，用户只需要使用微信扫描二维码就可登录，简化用户登录注册流程，更有效率的提高转化用户流量；<br />
		设置微信公众平台前，网站需首先进行申请，获得对应的AppToken、AppId、AppSecret，以保证后续流程中可正确对网站与用户进行验证与授权。 
		现在就去<a href="https://mp.weixin.qq.com/" target="_blank">申请</a><br />
		创建自定义菜单后，由于微信客户端缓存，需要24小时微信客户端才会展现出来。建议测试时可以尝试取消关注公众账号后再次关注，则可以看到创建后的效果。
		</p>
    </div>
    <div class="toptit">微信公众平台设置</div>
	<form action="<?php echo U('weixin/index');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="700" border="0" cellspacing="6" cellpadding="1" style=" margin-bottom:3px;">
			<tr>
			  <td width="200" align="right">开启微信公众平台：</td>
			  <td  >
			  <label>
			    <input name="weixin_apiopen" type="radio"  value="1" <?php if(C('qscms_weixin_apiopen') == 1): ?>checked="checked"<?php endif; ?>/>开启</label>
			&nbsp;&nbsp;
			<label>
			    <input name="weixin_apiopen" type="radio"  value="0" <?php if(C('qscms_weixin_apiopen') == 0): ?>checked="checked"<?php endif; ?>/>关闭</label>
				&nbsp;&nbsp;
			</td>
			</tr>
			<tr>
			  <td width="200" align="right">开启微信扫描登录：</td>
			  <td  >
			<label>
			    <input name="weixin_scan_login" type="radio"  value="1" <?php if(C('qscms_weixin_scan_login') == 1): ?>checked="checked"<?php endif; ?>/>开启</label>
			&nbsp;&nbsp;
			<label>
			    <input name="weixin_scan_login" type="radio"  value="0" <?php if(C('qscms_weixin_scan_login') == 0): ?>checked="checked"<?php endif; ?>/>关闭</label>
			&nbsp;&nbsp;
			</td>
			</tr>
			<tr>
			  <td width="200" align="right">开启微信扫描注册：</td>
			  <td  >
			<label>
			    <input name="weixin_scan_reg" type="radio"  value="1" <?php if(C('qscms_weixin_scan_reg') == 1): ?>checked="checked"<?php endif; ?>/>开启</label>
			&nbsp;&nbsp;
			<label>
			    <input name="weixin_scan_reg" type="radio"  value="0" <?php if(C('qscms_weixin_scan_reg') == 0): ?>checked="checked"<?php endif; ?>/>关闭</label>
			&nbsp;&nbsp;
			</td>
			</tr>
			<tr>
			  <td width="200" align="right">开启微信扫描绑定账户：</td>
			  <td  >
			<label>
			    <input name="weixin_scan_bind" type="radio"  value="1" <?php if(C('qscms_weixin_scan_bind') == 1): ?>checked="checked"<?php endif; ?>/>开启</label>
			&nbsp;&nbsp;
			<label>
			    <input name="weixin_scan_bind" type="radio"  value="0" <?php if(C('qscms_weixin_scan_bind') == 0): ?>checked="checked"<?php endif; ?>/>关闭</label>
			&nbsp;&nbsp;
			</td>
			</tr>
			<tr>
			  <td width="200" align="right">AppToken：</td>
			  <td  >
			 	<input name="weixin_apptoken" type="text"  class="input_text_400"  value="<?php echo C('qscms_weixin_apptoken');?>"  />
			  </td>
			</tr>
			<tr>
			  <td width="200" align="right">AppId：</td>
			  <td  >
			<input name="weixin_appid" type="text"  class="input_text_400"  value="<?php echo C('qscms_weixin_appid');?>"  />
			</td>
			</tr>
			<tr>
			  <td width="200" align="right">AppSecret：</td>
			  <td  >
			<input name="weixin_appsecret" type="text"  class="input_text_400"  value="<?php echo C('qscms_weixin_appsecret');?>"  />
			</td>
			</tr>
			<tr>
			  <td width="230" align="right">EncodingAESKey(消息加解密密钥)：</td>
			  <td  >
			<input name="weixin_encoding_aes_key" type="text"  class="input_text_400"  value="<?php echo C('qscms_weixin_encoding_aes_key');?>"  />
			</td>
			</tr>
			<tr>
			  <td width="200" align="right">名称：</td>
			  <td  >
			<input name="weixin_mpname" type="text"  class="input_text_400"  value="<?php echo C('qscms_weixin_mpname');?>"  />
			</td>
			</tr>
			<tr>
			  <td width="200" align="right">微信号：</td>
			  <td  >
			<input name="weixin_mpnumber" type="text"  class="input_text_400"  value="<?php echo C('qscms_weixin_mpnumber');?>"  />
			</td>
			</tr>
			<tr>
			  <td align="right">微信二维码图片： </td>
			  <td><input name="weixin_img" type="file" id="weixin_img" style="width:150px; font-size:12px; padding:3px;" onKeyDown="alert('请点击右侧“浏览”选择您电脑上的图片！');return false"/>&nbsp;&nbsp;&nbsp;<?php if(C('qscms_weixin_img')): ?><input type="button" name="Submit" value="查看二维码" class="vtip" title="<img src=<?php echo attach(C('qscms_weixin_img'),'resource');?>  border=0 width=120 height=120  align=absmiddle>"  style=" font-size:12px;"/><?php endif; ?>         </td>
			</tr>
			<tr>
			  <td align="right">微信头条信息大图： </td>
			  <td><input name="weixin_first_pic" type="file" id="weixin_first_pic" style="width:150px; font-size:12px; padding:3px;" onKeyDown="alert('请点击右侧“浏览”选择您电脑上的图片！');return false"/>&nbsp;&nbsp;&nbsp;<?php if(C('qscms_weixin_first_pic')): ?><input type="button" name="Submit" value="查看" class="vtip" title="<img src=<?php echo attach(C('qscms_weixin_first_pic'),'resource');?>  border=0  align=absmiddle>"  style=" font-size:12px;"/><?php endif; ?>         
				<span class="admin_note" style="color: rgb(153, 153, 153);">（建议尺寸：360 x 200）</span>
			  </td>
			</tr>
			<!-- <tr>
			  <td align="right">微信列表小图： </td>
			  <td><input name="weixin_default_pic" type="file" id="weixin_default_pic" style="width:150px; font-size:12px; padding:3px;" onKeyDown="alert('请点击右侧“浏览”选择您电脑上的图片！');return false"/>&nbsp;&nbsp;&nbsp;<?php if(C('qscms_weixin_default_pic')): ?><input type="button" name="Submit" value="查看" class="vtip" title="<img src=<?php echo attach(C('qscms_weixin_default_pic'),'resource');?>  border=0  align=absmiddle>"  style=" font-size:12px;"/><?php endif; ?>         </td>
			</tr> -->
			<tr>
			  <td align="right" valign="top">&nbsp;</td>
			  <td> 
			    <input type="submit" class="admin_submit" value="保存"/>
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