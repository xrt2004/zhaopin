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
	var URL = '/zhaopin42/index.php/admin/safety',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=safety&amp;a=badword_index',
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
<div class="toptit">关键词过滤</div>
 <form action="<?php echo U('safety/badword_index');?>" method="post"  name="form1" id="form1">
    <table width="700" border="0" cellspacing="10" cellpadding="1" style=" margin-bottom:3px;">
        <tr>
          <td width="162" align="right">是否开启：</td>
          <td>
      
      <label>
        <input name="badword_status" type="radio" id="badword_status" value="1"  <?php if(C('qscms_badword_status') == '1'): ?>checked=checked<?php endif; ?>/>开启</label>
&nbsp;&nbsp;&nbsp;&nbsp;
<label >
<input type="radio" name="badword_status" value="0" id="badword_status"  <?php if(C('qscms_badword_status') == '0'): ?>checked=checked<?php endif; ?>/>关闭</label>
      </td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>
            <input name="submit2" type="submit" class="admin_submit"    value="保存修改"/>          </td>
        </tr>
      </table>
  </form>
     <form id="form1" name="form1" method="post" action="<?php echo U('safety/badword_delete');?>">
      <table width="100%" border="0" cellpadding="0" cellspacing="0"  id="list" class="link_lan" >
        <tr>
          <td    class="admin_list_tit admin_list_first">
         <label id="chkAll">
         <input name=" " type="checkbox" id="chk" title="全选/反选" checked="checked"/>
         关键词</label>
         </td>
          <td class="admin_list_tit"  width="18%" align="center">替换词</td>           
        <td class="admin_list_tit" width="18%" align="center">状态</td>
        <td class="admin_list_tit" width="18%"  align="center">添加时间</td> 
        <td width="18%" align="center" class="admin_list_tit"> 操作</td>
        </tr>
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td class="admin_list admin_list_first">   
       <label> <input name="tables[]" type="checkbox"   value="<?php echo ($vo["id"]); ?>" checked="checked"/><?php echo ($vo["badword"]); ?></label>
         </td>
            <td class="admin_list" align="center"><?php echo ($vo["replace"]); ?></td>        
        <td class="admin_list"  align="center">
        <?php echo ($vo["status"]); ?>
        </td>   
        <td class="admin_list" align="center" ><?php echo admin_date($vo['add_time']);?></td>     
        <td align="center" class="admin_list">
            <a href="<?php echo U('safety/badword_edit',array('id'=>$vo['id']));?>">编辑</a>
            <a href="<?php echo U('safety/badword_delete',array('id'=>$vo['id']));?>" onclick="return confirm('你确定要删除吗？')">删除</a>
        </td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
   <?php if(!$list): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
  <table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
      <tr>
        <td>
          <input name="ButAudit" type="button" class="admin_submit" id="ButAdd"  value="添加关键词"  onclick="javascript:location.href='<?php echo U('safety/badword_add',array('menuid'=>$menuid));?>'"/>
          <input name="ButAudit" type="submit" class="admin_submit" id="ButDel"  value="删除关键词"  />
    </td>
        <td width="305" align="right">
   
      </td>
      </tr>
  </table>
  </form>
 <div class="qspage"><?php echo ($page); ?></div>
</div>
<script type="text/javascript">
$(document).ready(function()
{
  $("#selectAll").click(function()
  { 
    $("form :checkbox").attr("checked",true);
    setbg();
  });
  $("#uncheckAll").click(function()
  { 
    $("form :checkbox").attr("checked",false);
    setbg();
  });
  $("#opposite").click(function()
  { 
    $("form :checkbox").each(function()
    {
    $(this).attr("checked")?$(this).attr("checked",false):$(this).attr("checked",true);
    });
    setbg();
  });
});
</script>
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