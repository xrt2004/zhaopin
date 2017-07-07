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
	var URL = '/zhaopin42/index.php/admin/clearcache',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=clearcache&amp;a=index',
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
  <p>当进行了数据恢复、升级或者工作出现异常的时候，您可以使用本功能重新生成缓存。<br />
数据缓存：更新网站设置、<?php echo C('qscms_points_byname');?>规则、邮件设置等缓存 <br />
模板缓存：更新模板、风格等缓存文件，当您修改了模板或者风格，但是没有立即生效的时候使用 </p>
  </div>
<div class="toptit">更新选项</div>
  <form id="form1" name="form1" method="post" action="<?php echo U('index');?>"> 
  <table width="100%" border="0" cellspacing="0" cellpadding="4">
      <td height="60" style=" line-height:220%; color:#666666;">
    <table width="600" height="100" border="0" cellpadding="2" cellspacing="2" id="selecttplcache">
        <tr>
          <td height="45">
          <label><input  type="checkbox" checked="checked" value="datacache" name="type[]"/> 数据缓存</label> 
          <label><input id="tplcache" type="checkbox"   value="tplcache" name="type[]" checked="checked"/> 模板缓存</label>
          <label><input id="logcache" type="checkbox"   value="logcache" name="type[]" checked="checked"/> 日志缓存</label></td>
        </tr>
        <tr>
          <td height="45"><input name="submit" type="submit" class="admin_submit"    value="清除缓存" onclick="document.getElementById('selecttplcache').style.display='none';document.getElementById('hide').style.display='block';"/></td>
        </tr>
      </table>      
        <table width="600" height="100" border="0" cellpadding="5" cellspacing="0" id="hide" style="display:none">
          <tr>
            <td align="center" valign="bottom"><img src="__ADMINPUBLIC__/images/ajax_loader.gif"  border="0" /></td>
          </tr>
          <tr>
            <td align="center" valign="top" style="color: #009900">正在清除缓存，请稍候......</td>
          </tr>
        </table></td>
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