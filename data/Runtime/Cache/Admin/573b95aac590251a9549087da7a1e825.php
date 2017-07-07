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
		SELF = '/zhaopin42/index.php?m=admin&amp;c=payment&amp;a=index',
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
</p>
</div>
  <table width="100%" border="0" cellpadding="0" cellspacing="0"  class="link_lan" id="list" >
    <tr>
            <td width="15%"  class="admin_list_tit admin_list_first">名称</td>
            <td width="34%" class="admin_list_tit">支付方式简短描述</td>
            <td align="center" class="admin_list_tit">排序</td>
            <td width="15%" align="center" class="admin_list_tit">操作</td>
    </tr>
     <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td class="admin_list admin_list_first" style="color:#3366CC"> <?php echo ($vo["byname"]); ?> </td>
            <td class="admin_list"> <?php echo ($vo["p_introduction"]); ?></td>
            <td align="center" class="admin_list">
      <?php echo ($vo["listorder"]); ?>      </td>
            <td align="center" class="admin_list">
            <?php if($vo['p_install'] == '2'): ?><!-- <a href="<?php echo U('uninstall',array('id'=>$vo['id'],'typename'=>$vo['typename']));?>" onclick="return confirm('你确定要卸载吗？')">卸载</a> &nbsp;&nbsp;&nbsp;&nbsp; -->
            <a href="<?php echo U('edit',array('id'=>$vo['id'],'typename'=>$vo['typename']));?>" >编辑</a>
            <?php else: ?>
            <a href="<?php echo U('edit',array('id'=>$vo['id'],'typename'=>$vo['typename']));?>">安装</a><?php endif; ?>       
          </td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
  <table width="100%" height="100" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
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