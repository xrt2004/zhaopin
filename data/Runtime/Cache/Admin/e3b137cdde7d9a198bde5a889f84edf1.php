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
	var URL = '/zhaopin42/index.php/admin/hotword',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=hotword&amp;a=edit&amp;w_id=54',
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
您可以修改关键字搜索次数来改变关键词排序；
</p>
</div>
<div class="toptit">修改关键词</div>
<form id="form1" name="form1" method="post" action="<?php echo U('hotword/edit');?>">
<table width="100%" border="0" cellspacing="6" cellpadding="0" style="border-bottom:1px #93AEDD  dashed">
  <tr>
    <td width="120" align="right">关键词:</td>
    <td><input name="w_word" type="text" class="input_text_200"  value="<?php echo ($info["w_word"]); ?>"/></td>
  </tr>
   <tr>
    <td width="120" align="right">搜索次数:</td>
    <td><input name="w_hot" type="text" class="input_text_200"  value="<?php echo ($info["w_hot"]); ?>"/></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="6" cellpadding="0">
  <tr>
    <td width="120"> </td>
    <td>
      <input type="hidden" name="w_id" value="<?php echo ($info["w_id"]); ?>">
  <input type="submit" name="submit" value="保存" class="admin_submit" />
      <input name="submit22" type="button" class="admin_submit"    value="返 回" onclick="window.location='<?php echo U('hotword/index');?>'"/>
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