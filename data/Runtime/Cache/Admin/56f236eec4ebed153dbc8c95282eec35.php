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
	var URL = '/zhaopin42/index.php/admin/mail_queue',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=mail_queue&amp;a=mailqueue_add',
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
你可以用HTML美化邮件内容。
</p>
</div> 
 <div class="toptit">新增邮件任务</div>
    <form id="form1" name="form1" method="post"   action="<?php echo U('mailqueue_add');?>" >
  <table width="100%" border="0" cellpadding="4" cellspacing="0"   >
    <tr>
      <td width="120" height="30" align="right"  >收件人：</td>
      <td  ><input name="m_mail" type="text" class="input_text_200"   maxlength="100" value=""/>
       </td>
    </tr>
  <tr>
      <td width="120" height="30" align="right"  >邮件标题：</td>
      <td  ><input name="m_subject" type="text" id="m_subject" class="input_text_400"   maxlength="100" value=""/>
       </td>
    </tr>
   <tr>
      <td   height="30" align="right"  ></td>
      <td  >
    <?php if(is_array($label)): $i = 0; $__LIST__ = $label;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><div id="<?php echo ($li[0]); ?>" class="sellabel"><?php echo ($li[1]); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="clear"></div>
       </td>
    </tr>
      <tr>
      <td height="30" align="right" valign="top"  >邮件内容：</td>
      <td   >
    <textarea name="m_body" id="m_body" style="width:700px; height:200px; font-size:12px; line-height:180%" ></textarea>
    
    </td>
    </tr>
        <tr>
      <td height="30" align="right"  >&nbsp;</td>
      <td height="50"  > 
            <input name="submit3" type="submit" class="admin_submit"    value="添加"/>
        <input name="submit22" type="button" class="admin_submit"    value="返回" onclick="Javascript:window.history.go(-1)"/>
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
<script type="text/javascript" src="../public/js/jquery.caretInsert.js"></script>
<link rel="stylesheet" href="../public/js/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="../public/js/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="../public/js/kindeditor/lang/zh_CN.js"></script>
<script language="JavaScript" type="text/javascript"> 
var editor;
  KindEditor.ready(function(K) {
    editor = K.create('textarea[name="m_body"]', {
      uploadJson : "?m=admin&c=upload&a=index",
      allowFileManager : true
    });
  });
(function($)
{
  $(".sellabel").hover(function(){$(this).css("background-color","#ffffff");},function()  {$(this).css("background-color","#F4FAFF");});

    
     $('.sellabel[align!="left"]').unbind("click").click(function(){ 
       $('#m_subject').setCaret();
       $('#m_subject').insertAtCaret($(this).attr("id"));
     });

  

     $('.sellabel[align="left"]').unbind("click").click(function(){ 
     $('#m_subject').unbind();
       editor.insertHtml($(this).attr("id"));
       //$('#templates_value').insertAtCaret($(this).attr("id"));
  });
})($);   
</script> 
</body>
</html>