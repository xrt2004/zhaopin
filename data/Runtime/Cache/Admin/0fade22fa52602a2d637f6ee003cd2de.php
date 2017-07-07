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
	var URL = '/zhaopin42/index.php/admin/database',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=database&amp;a=index',
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
数据备份功能根据您的选择备份网站数据库的数据，导出的数据文件可用“数据恢复”功能导入。<br />
        全部备份均不包含模板文件和附件文件。模板、附件的备份只需通过 FTP 等下载，74cms 不提供单独备份。
</p>
</div>
<div class="toptit">生成备份数据库</div>
      <form id="form1" name="form1" method="post" action="<?php echo U('database/index');?>">
        <input type="hidden" name="initBackup" value="1">
    <table width="100%" border="0" cellspacing="0" cellpadding="4" id="backupshow">
    <tr>
      <td style=" line-height:180%; color:#666666; padding-left:20px;">
      <ul style="margin:0px; padding:3px;">
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style=" list-style:none; padding:0px; margin:0px; float:left; width:260px; height:26px; display:block">
     <label>
      <input name="tables[<?php echo ($vo); ?>]" type="checkbox" style=" vertical-align: middle" value="-1" checked="checked"/> 
     <?php echo ($vo); ?>
     </label>
     </li><?php endforeach; endif; else: echo "" ;endif; ?>
      <li class="clear" style="list-style:none"></li>
      </ul> 
      </td>
    </tr>
    <tr>
      <td height="30" bgcolor="#F1F8FA" style=" line-height:180%; color:#666666; padding-left:20px;border-bottom:1px  #DFEDF7 solid;border-top:1px #DFEDF7 solid;">
      &nbsp;&nbsp;&nbsp;
      <span id="selectAll" style="color:#0066CC; cursor:pointer">[全选]</span>
      &nbsp;&nbsp;&nbsp;
      <span id="uncheckAll" style="color:#0066CC; cursor:pointer">[全不选]</span>
      &nbsp;&nbsp;&nbsp;
 <span id="opposite" style="color:#0066CC; cursor:pointer">[反选]</span>
  &nbsp;&nbsp;&nbsp;
      分卷备份：
          <input name="sizelimit" type="text" id="sizelimit"   value="<?php echo ((isset($sizelimit) && ($sizelimit !== ""))?($sizelimit):1024); ?>" maxlength="20" onkeyup="if(event.keyCode !=37 && event.keyCode != 39) value=value.replace(/\D/g,'');"  onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/\D/g,''))" class="input_text_100"/> K
      </td>
    </tr>
    <tr>
      <td height="80" align="center"  >
       <input type="submit" name="Submit22" value="开始备份" class="admin_submit" onclick="document.getElementById('backupshow').style.display='none';document.getElementById('hide').style.display='block';"></td>
      </tr>
  </table>
   <table width="600" height="100" border="0" cellpadding="5" cellspacing="0" id="hide" style="display:none">
          <tr>
            <td align="center" valign="bottom"><img src="__ADMINPUBLIC__/images/ajax_loader.gif"  border="0" /></td>
          </tr>
          <tr>
            <td align="center" valign="top" style="color: #009900">正在备份，请稍候......</td>
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
<script type="text/javascript">
function CheckAll(form)
{
for (var i=0;i<form.elements.length;i++)
{
var e = form.elements[i];
if (e.Name != "chkAll"&&e.disabled!=true)
e.checked = form.chkAll.checked;
}
}
</script>
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
</body>
</html>