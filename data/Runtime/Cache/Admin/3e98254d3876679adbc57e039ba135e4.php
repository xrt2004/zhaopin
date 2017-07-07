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
	var URL = '/zhaopin42/index.php/admin/category',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=category&amp;a=group_list',
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
系统默认分类不能删除！<br />
删除分类组将同时删除此组下的所有分类。
</p>
</div>
  <form id="form1" name="form1" method="post" action="<?php echo U('group_delete');?>">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_lan"  >
    <tr>
      <td height="26" class="admin_list_tit admin_list_first" >
      <label id="chkAll"><input type="checkbox" name=" " title="全选/反选" id="chk"/>分类组名称</label></td>
    <td  class="admin_list_tit">调用名</td>
    <td   align="center"  class="admin_list_tit">类型</td>
      <td width="20%"   class="admin_list_tit">操作</td>
    </tr>
  <?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><tr>
      <td   class="admin_list admin_list_first" >
      <input type="checkbox" name="alias[]" value="<?php echo ($li["g_alias"]); ?>"  <?php if($li['g_sys'] == 1): ?>disabled="disabled"<?php endif; ?> />
    <a href="<?php echo U('show_category',array('alias'=>$li['g_alias']));?>"><?php echo ($li["g_name"]); ?></a>
    </td>
     <td  class="admin_list"><?php echo ($li["g_alias"]); ?></td>
     <td align="center"  class="admin_list">
     <?php if($li['g_sys'] == 1): ?>系统分类
     <?php else: ?>
     自定义分类组<?php endif; ?>
     </td>
      <td class="admin_list">
    <a href="<?php echo U('show_category',array('alias'=>$li['g_alias']));?>">查看</a>&nbsp;&nbsp;
        <?php if($li['g_sys'] != 1): ?><a href="<?php echo U('group_edit',array('alias'=>$li['g_alias']));?>">修改</a>&nbsp;&nbsp;      
       <a onclick="return confirm('删除后无法恢复，你确定要删除吗？')" href="<?php echo U('group_delete',array('alias'=>$li['g_alias']));?>">删除</a><?php endif; ?>
    </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
  <table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
<tr>
        <td>
        <input name="ButADD" type="button" class="admin_submit" id="ButADD" value="添加分类组"  onclick="window.location='<?php echo U('group_add');?>'"/>
    <input name="ButDel" type="submit" class="admin_submit" id="ButDel"  value="删除所选" onclick="return confirm('删除分类组同时也会删除此分类组下个分类，你确定要删除吗？')"/>
    </td>
        <td width="305" align="right">
    
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