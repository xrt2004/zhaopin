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
	var URL = '/zhaopin42/index.php/admin/crons',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=crons&amp;a=index',
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
计划任务是一项使系统在规定时间自动执行某些特定任务的功能，在需要的情况下，您也可以方便的将其用于功能的扩展。<br />
计划任务是与系统核心紧密关联的功能特性，不当的设置可能造成功能的隐患，严重时可能导致网站无法正常运行。
</p>
</div>
  <form id="form1" name="form1" method="post" action="<?php echo U('crons/delete');?>">
  <table width="100%" border="0" cellpadding="0" cellspacing="0"  id="list" class="link_lan">
    <tr>
      <td  class="admin_list_tit admin_list_first">
      <label id="chkAll"><input type="checkbox" name="chkAll"  id="chk" title="全选/反选" />名称</label>
    </td>
      <td   align="center" class="admin_list_tit"  width="10%"> 可用 </td>
      <td   align="center" class="admin_list_tit"  width="10%">类型</td>
    <td   align="center"   class="admin_list_tit"  width="160">下次执行时间</td>
      <td width="210" align="center"  class="admin_list_tit" >操作</td>
    </tr>
   <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td   class="admin_list admin_list_first">
    <input name="cronid[]" type="checkbox"  value="<?php echo ($vo["cronid"]); ?>" />
    <?php echo ($vo["name"]); ?>
   </td>
      <td align="center"  class="admin_list">
        <?php if($vo['available'] == '1'): ?>可用
        <?php else: ?>
          <span style="color:#999999">不可用</span><?php endif; ?>
   </td>
     <td align="center"  class="admin_list"> 
      <?php if($vo['admin_set'] == '1'): ?>内置
      <?php else: ?>
        自定义<?php endif; ?>
     </td>
      <td align="center"   class="admin_list">
        <?php if($cache[$vo['cronid']]): echo date('Y-m-d H:i',$cache[$vo['cronid']]['start']);?>
        <?php else: ?>
          0<?php endif; ?>
      </td>
      <td align="center"   class="admin_list">
    <a href="<?php echo U('crons/edit',array('cronid'=>$vo['cronid']));?>">编辑</a>&nbsp;&nbsp;&nbsp;
    <a href="<?php echo U('crons/execution',array('cronid'=>$vo['cronid']));?>"  class="exe">执行</a>&nbsp;&nbsp;&nbsp;
    <!-- <a href="<?php echo U('crons/log',array('cronid'=>$vo['cronid']));?>">历史记录</a> -->
    </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
  </form>
  <?php if(!$list): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
<table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
      <tr>
        <td>
<input type="button" class="admin_submit" id="ButAudit" value="添加任务"  onclick="window.location='<?php echo U('crons/add');?>'"/>
<input type="button" class="admin_submit" id="ButDel" value="删除所选"/>
    </td>
        <td width="305" align="right">
      </td>
      </tr>
  </table>
<div class="qspage"><?php echo ($page); ?></div>
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
  
  $(".exe").QSdialog({
  DialogTitle:"系统提示",
  DialogContent:"计划任务正在执行，请等待...",
  DialogContentType:"text",
  DialogAddObj:"body"
  });
  //点击批量取消  
  $("#ButDel").click(function(){
    if (confirm('你确定要删除吗？'))
    {
      $("form[name=form1]").submit()
    }
  });
    
});
</script>
</body>
</html>