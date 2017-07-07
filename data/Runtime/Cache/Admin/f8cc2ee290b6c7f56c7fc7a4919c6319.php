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
	var URL = '/zhaopin42/index.php/admin/mailconfig',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=mailconfig&amp;a=index',
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
  		<p>您可以通过发送测试邮件来调试配置信息。<br />
  		通过连接 SMTP 服务器发送邮件需邮箱账户开通SMTP服务。
  		<br />
  		您可以添加多个SMTP账户，系统将随机使用SMTP账户。
  		</p>
	  </div>
    <div class="toptit">设置</div>
    <form action="<?php echo U('mailconfig/index');?>" method="post"   name="form1" id="form1">
    <table width="100%" border="0" cellspacing="8" cellpadding="0" style="padding-left:15px;" id="methodsel">
      <tr>
        <td>
    	<label>
    	<input name="method" type="radio" value="1" <?php if($info['method'] == 1): ?>checked="checked"<?php endif; ?>/>
          通过连接 SMTP 服务器发送邮件
    	  </label>
    	  </td>
        </tr>
      <tr>
        <td>
    	<label>
    	<input type="radio" name="method" value="2" <?php if($info['method'] == 2): ?>checked="checked"<?php endif; ?>/>
          通过sendmail 发送邮件
    	  </label>
    	</td>
        </tr>
      <tr>
        <td>
    	<label>
    	<input type="radio" name="method" value="3" <?php if($info['method'] == 3): ?>checked="checked"<?php endif; ?>/>
         通过 PHP 函数 SMTP 发送邮件
    	  </label>
    	</td>
        </tr>
    </table>
<div style=" display:none1"  id="method_sendmail">
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="html_tpl">
    <table width="700" border="0" cellspacing="8" cellpadding="1" style=" margin-bottom:3px; border-bottom:1px #CCCCCC solid" >
          <tr>
            <td width="121" align="right">SMTP服务器地址：</td>
            <td><input name="smtpservers[]" type="text"  class="input_text_200" id="smtpservers" value="<?php echo ($list["smtpservers"]); ?>" maxlength="30"/>
              如：smtp.qq.com</td>
            <td><span style="color:#0066CC; cursor:pointer" class="delsmtp">X 删除此账户</span></td>
          </tr>
          <tr>
            <td align="right">SMTP服务帐户名：</td>
            <td><input name="smtpusername[]" type="text"  class="input_text_200" id="smtpusername" value="<?php echo ($list["smtpusername"]); ?>" maxlength="100"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right">SMTP服务密码：</td>
            <td><input name="smtppassword[]" type="password"  class="input_text_200" id="smtppassword" value="<?php echo ($list["smtppassword"]); ?>" maxlength="40"/></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right">发信人邮件地址：</td>
            <td><input name="smtpfrom[]" type="text"  class="input_text_200" id="site_title" value="<?php echo ($list["smtpfrom"]); ?>" maxlength="60"/>            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right">SMTP 端口：</td>
            <td><input name="smtpport[]" type="text"  class="input_text_200" id="smtpport" value="<?php echo ($list["smtpport"]); ?>" maxlength="60"/>
默认：25</td>
            <td>&nbsp;</td>
          </tr>
      </table>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>  
	 <div id="html"></div>
    </div>
	  <table width="700" border="0" cellspacing="8" cellpadding="1"  >
          <tr>
            <td width="120" align="right">&nbsp;</td>
            <td> 
              <input name="save" type="submit" class="admin_submit"    value="保存修改"/>
			        <input type="button" name="add_form" id="add_form" value="继续添加" class="admin_submit" />
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
<script id="J_email" type="text/html">
  <div class="html_tpl">
  <table width="700" border="0" cellspacing="8" cellpadding="1" style=" margin-bottom:3px; border-bottom:1px #CCCCCC solid" >
        <tr>
          <td width="121" align="right">SMTP服务器地址：</td>
          <td><input name="smtpservers[]" type="text"  class="input_text_200" id="smtpservers" value="" maxlength="30"/>
            如：smtp.qq.com</td>
          <td><span style="color:#0066CC; cursor:pointer" class="delsmtp">X 删除此账户</span></td>
        </tr>
        <tr>
          <td align="right">SMTP服务帐户名：</td>
          <td><input name="smtpusername[]" type="text"  class="input_text_200" id="smtpusername" value="" maxlength="100"/></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">SMTP服务密码：</td>
          <td><input name="smtppassword[]" type="password"  class="input_text_200" id="smtppassword" value="" maxlength="40"/></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">发信人邮件地址：</td>
          <td><input name="smtpfrom[]" type="text"  class="input_text_200" id="site_title" value="" maxlength="60"/>            </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">SMTP 端口：</td>
          <td><input name="smtpport[]" type="text"  class="input_text_200" id="smtpport" value="25" maxlength="60"/>
默认：25</td>
          <td>&nbsp;</td>
        </tr>
    </table>
  </div>
</script>
<script type="text/javascript">
$(document).ready(function()
{
  setsendmailshow();
  $("#methodsel :radio").click(function () {setsendmailshow();});
  function setsendmailshow()
  {
    var stlval=$("#methodsel :radio[checked]").val();
    if (stlval=="1")
    {
    $("#method_sendmail,#add_form").show();
    $("#add_form").show();
    }
    else
    {
    $("#method_sendmail,#add_form").hide();
    }
  }
  $("#add_form").click(function()
  {
    $("#html").append($("#J_email").html());
  });
  
  $(".delsmtp").hover(function(){
  $(this).parentsUntil('div').css('background-color','#F3F3F3');
  },function(){
  $(this).parentsUntil('div').css('background-color','');
  });
  
  $('.delsmtp').live('click', function()
  {
    if ($("#method_sendmail div:nth-child(2)").text()=='')
    {
    alert('至少留一个SMTP账户！');
    }
    else
    {
    $(this).closest('div').empty();
    }
  });
});
</script>
</body>
</html>