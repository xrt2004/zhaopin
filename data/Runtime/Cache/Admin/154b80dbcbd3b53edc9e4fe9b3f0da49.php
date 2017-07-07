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
		SELF = '/zhaopin42/index.php?m=admin&amp;c=config&amp;a=index',
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
        <p>页面标题设置以及关键字设置等请在页面管理中设置。<br/>
              网站域名和网站安装目录填写错误可导致网站部分功能不能使用。</p>
    </div>
    <div class="toptit">网站配置</div>
	<form action="<?php echo U('config/edit');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
		<table width="100%" border="0" cellspacing="5" cellpadding="5">
			<tr>
				<td width="120" align="right">网站名称：</td>
				<td><input name="site_name" type="text"  class="input_text_200" id="site_name" value="<?php echo C('qscms_site_name');?>" maxlength="30"/></td>
			</tr>
			<tr>
				<td align="right">网站域名：</td>
				<td><input name="site_domain" type="text"  class="input_text_200" id="site_domain" value="<?php echo C('qscms_site_domain');?>" maxlength="100"/>
				结尾不要加 &quot; / &quot;</td>
			</tr>
			 
			<tr>
				<td align="right">安装目录：</td>
				<td><input name="site_dir" type="text"  class="input_text_200" id="site_dir" value="<?php echo C('qscms_site_dir');?>" maxlength="40"/>
				( 以 " / " 开头和结尾, 如果安装在根目录，则为" / ")
				</td>
			</tr>
			<tr>
				<td align="right">联系电话(顶部)：</td>
				<td><input name="top_tel" type="text"  class="input_text_400" id="top_tel" value="<?php echo C('qscms_top_tel');?>" maxlength="80"/></td>
			</tr>
			<tr>
				<td align="right">联系电话(底部)：</td>
				<td><input name="bootom_tel" type="text"  class="input_text_400" id="bootom_tel" value="<?php echo C('qscms_bootom_tel');?>" maxlength="80"/></td>
			</tr>
			<tr>
				<td align="right">联系邮箱：</td>
				<td><input name="contact_email" type="text"  class="input_text_400" id="contact_email" value="<?php echo C('qscms_contact_email');?>" maxlength="80"/></td>
			</tr>
			<tr>
				<td align="right">网站底部联系地址：</td>
				<td>
					<input name="address" type="text"  class="input_text_400" id="address" value="<?php echo C('qscms_address');?>" maxlength="120"/>
				</td>
			</tr>
			<tr>
				<td align="right">网站底部其他说明：</td>
				<td><input name="bottom_other" type="text"  class="input_text_400" id="bottom_other" value="<?php echo C('qscms_bottom_other');?>" maxlength="200"/></td>
			</tr>
			<tr>
				<td align="right">网站备案号(ICP)：</td>
				<td>
					<input name="icp" type="text"  class="input_text_400" id="icp" value="<?php echo C('qscms_icp');?>" maxlength="30"/>
				</td>
			</tr>
			<tr>
				<td align="right">网站首页Logo： </td>
				<td>
					<input name="logo_home" type="file" id="web_logo" style="width:300px; font-size:12px; padding:3px;" onKeyDown="alert('请点击右侧“浏览”选择您电脑上的图片！');return false"/>&nbsp;&nbsp;&nbsp;
					<input type="button" name="Submit" value="查看Logo" class="vtip" title="<img src=<?php if(C('qscms_logo_home')): echo attach(C('qscms_logo_home'),'resource'); else: ?>__HOMEPUBLIC__/images/logo.gif<?php endif; ?>  border=0  align=absmiddle>" style="font-size:12px;"/>
				</td>
			</tr>
			<tr>
				<td align="right">网站会员中心Logo： </td>
				<td>
					<input name="logo_user" type="file" id="web_logo" style="width:300px; font-size:12px; padding:3px;" onKeyDown="alert('请点击右侧“浏览”选择您电脑上的图片！');return false"/>&nbsp;&nbsp;&nbsp;
					<input type="button" name="Submit" value="查看Logo" class="vtip" title="<img src=<?php if(C('qscms_logo_user')): echo attach(C('qscms_logo_user'),'resource'); else: ?>__HOMEPUBLIC__/images/logo_user.png<?php endif; ?>  border=0  align=absmiddle>" style="font-size:12px;"/>
				</td>
			</tr>
			<tr>
				<td align="right">网站其它页Logo： </td>
				<td>
					<input name="logo_other" type="file" id="web_logo" style="width:300px; font-size:12px; padding:3px;" onKeyDown="alert('请点击右侧“浏览”选择您电脑上的图片！');return false"/>&nbsp;&nbsp;&nbsp;
					<input type="button" name="Submit" value="查看Logo" class="vtip" title="<img src=<?php if(C('qscms_logo_other')): echo attach(C('qscms_logo_other'),'resource'); else: ?>__HOMEPUBLIC__/images/logo_other.png<?php endif; ?>  border=0  align=absmiddle>" style="font-size:12px;"/>
				</td>
			</tr>
			<tr>
				<td align="right">暂时关闭网站：</td>
				<td>
					<label><input name="isclose" type="radio" id="isclose" value="0" <?php if(C('qscms_isclose') == 0): ?>checked="checked"<?php endif; ?>/>否</label>
					&nbsp;&nbsp;&nbsp;&nbsp; 
					<label ><input type="radio" name="isclose" value="1" id="isclose1" <?php if(C('qscms_isclose') == 1): ?>checked="checked"<?php endif; ?>/>是</label>
				</td>
			</tr>
			<tr>
				<td align="right" valign="top">暂时关闭原因：</td>
				<td>
					<textarea name="close_reason" class="input_text_400" id="close_reason" style="height:60px;"><?php echo C('qscms_close_reason');?></textarea>
				</td>
			</tr>
			<tr>
              <td width="150" align="right">seo_title：</td>
              <td><input name="site_title" type="text"  class="input_text_400" value="<?php echo C('qscms_site_title');?>"/></td>
            </tr>
            <tr>
              <td width="150" align="right">seo_keywords：</td>
              <td><textarea name="site_keyword" class="input_text_400" style="height:60px;"><?php echo C('qscms_site_keyword');?></textarea></td>
            </tr>
            <tr>
              <td width="150" align="right">seo_description：</td>
              <td><textarea name="site_description" class="input_text_400" style="height:60px;"><?php echo C('qscms_site_description');?></textarea></td>
            </tr>
			<tr>
				<td align="right" valign="top">第三方流量统计代码：</td>
				<td>
					<textarea name="statistics" class="input_text_400" id="statistics" style="height:60px;"><?php echo C('qscms_statistics');?></textarea>
				</td>
			</tr>
		
	 
			<tr>
				<td align="right">&nbsp;</td>
				<td height="50"> 
					<input name="submit" type="submit" class="admin_submit"    value="保存修改"/>
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