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
	var URL = '/zhaopin42/index.php/admin/tpl',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=tpl&amp;a=index',
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
新增模板只需将模板文件上传至 /Application/Home/View/目录下，更多模版请到 <a href="http://www.74cms.com/bbs" target="_blank" style="color:#009900">[论坛]</a> 获取。<br />
      使用与骑士CMS不同版本的模板易产生错误<br />
      如果您熟悉html语法，则可以参考 <a href="http://www.74cms.com/handbook" target="_blank" style="color:#009900">[模版开发手册]</a> 自定义风格模版。
</p>
</div>
<div class="toptit">当前模板</div>
<table width="460" border="0" cellspacing="12" cellpadding="0" class="link_lan"  >
    <tr>
      <td width="225">
	  <img src="<?php echo ($templates["thumb_dir"]); ?>/Config/thumbnail.jpg" alt="<?php echo ($templates["info"]["name"]); ?>" width="225" height="136" border="1"  style="border: #CCCCCC;" />
	  </td>
      <td width="220" class="link_lan" style="line-height:180%">
	  名称：<?php echo ($templates["info"]["name"]); ?><br />
        版本：<?php echo ($templates["info"]["version"]); ?><br />
        作者：<a href="<?php echo ($templates["info"]["authorurl"]); ?>" target="_blank"><?php echo ($templates["info"]["author"]); ?></a><br />
		模版ID：<?php echo ($templates["dir"]); ?>
		<br />
	  <input type="button" name="Submit22" value="备份此模板" class="admin_submit"    onclick="window.location='<?php echo U('tpl/backup',array('tpl_name'=>$templates['dir']));?>'"  style="margin-top:10px;"/>
	  </td>
    </tr>
  </table>
	<div class="toptit">可用模板</div>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><div style="float:left; width:240px;  text-align:center; padding:15px; line-height:180%"  class="link_lan tpl_list">
	  <a href="<?php echo U('set',array('tpl_dir'=>$li['dir']));?>" onclick="return confirm('你确定要使用此模板吗？(提示：频繁更换模版会影响网站排名)')">
	  <img src="<?php echo ($li["thumb_dir"]); ?>/Config/thumbnail.jpg" alt="<?php echo ($li["info"]["name"]); ?>" width="225" height="136" border="1"  style="border: #CCCCCC;"/>
	  </a>
	  <br />
	 <strong><?php echo ($li["info"]["name"]); ?></strong>
	 <br />
	<?php echo ($li["info"]["version"]); ?> (作者:<a href="<?php echo ($li["info"]["authorurl"]); ?>" target="_blank"><?php echo ($li["info"]["author"]); ?></a>)
	 <br />
	模版ID：<?php echo ($li["dir"]); ?>
	 </div><?php endforeach; endif; else: echo "" ;endif; ?>
	<div class="clear"></div>
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
$(document).ready(function()
{
	$(".tpl_list").hover(
  function () {
    $(this).css("background-color","#E4F4FC");
  },
  function () {
    $(this).css("background-color","");
  }
);
});
</script>
</body>
</html>