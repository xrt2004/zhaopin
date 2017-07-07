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
		SELF = '/zhaopin42/index.php?m=admin&amp;c=safety&amp;a=index&amp;type=captcha',
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
<div class="toptip link_g">
  <h2>提示：</h2>
  <p>
  骑士人才系统集成《极验》安全验证，用户仅需1.82秒即可完成验证，使用前必须获取<a href="http://www.geetest.com" target="_blank">极验密钥</a></p>
</div>
<div class="toptit">PC端极验设置</div>
    <form id="form1" name="form1" method="post"   action="<?php echo U('safety/index');?>" >
	  <table width="100%" border="0" cellpadding="4" cellspacing="0"   >
    <tr>
      <td width="120" height="30" align="right"  >开启验证：</td>
      <td > <label><input type="radio" class="J_type" name="captcha_open" id="J_type_open" value="1" <?php if(C('qscms_captcha_open') == '1'): ?>checked="checked"<?php endif; ?>/>开启</label>
         &nbsp;&nbsp;&nbsp;&nbsp; 
       <label ><input type="radio" class="J_type" name="captcha_open" id="job_mode_2" value="0" <?php if(C('qscms_captcha_open') == '0'): ?>checked="checked"<?php endif; ?>/>关闭</label>
       </td>
     </tr>
  </table>
  <table width="100%" border="0" cellpadding="4" cellspacing="0"  class="captcha_show">
    <tr>
      <td width="120" height="30" align="right"  >极验ID：</td>
      <td  ><input name="captcha[id]" type="text" class="input_text_300" value="<?php echo C('qscms_captcha.id');?>"/>
       </td>
    </tr>
     <tr>
      <td width="120" height="30" align="right"  >极验KEY：</td>
      <td  ><input name="captcha[key]" type="text" class="input_text_300" value="<?php echo C('qscms_captcha.key');?>"/>
       </td>
    </tr>
  </table>
   <table width="100%" border="0" cellpadding="4" cellspacing="0"   >
    
    <tr>
      <td width="120" height="30" align="right"  >&nbsp;</td>
      <td height="50"  > 
            <input name="submit3" type="submit" class="admin_submit"    value="保存"/>
      </td>
    </tr>
  
  </table>
    </form>
<div class="toptit captcha_show">验证项目</div>
    <form id="form2" name="form2" method="post"   action="<?php echo U('safety/index');?>" >
  <table width="100%" border="0" cellpadding="4" cellspacing="0"   class="captcha_show" >
    <tr>
      <td width="120" height="30" align="right"  >注册验证：</td>
      <td  >
       <label><input name="captcha_config[varify_reg]" type="radio" value="1" <?php if(C('qscms_captcha_config.varify_reg') == 1): ?>checked<?php endif; ?>/> 开启</label>
       <label><input name="captcha_config[varify_reg]" type="radio" value="0" <?php if(C('qscms_captcha_config.varify_reg') == 0): ?>checked<?php endif; ?>/> 关闭</label>
       <span class="admin_note" >（开启后，用户在注册时发起验证）</span>
       </td>
    </tr>
  <tr>
      <td width="120" height="30" align="right"  >手机验证：</td>
      <td  >
       <label><input name="captcha_config[varify_mobile]" type="radio" value="1" <?php if(C('qscms_captcha_config.varify_mobile') == 1): ?>checked<?php endif; ?>/> 开启</label>
       <label><input name="captcha_config[varify_mobile]" type="radio" value="0" <?php if(C('qscms_captcha_config.varify_mobile') == 0): ?>checked<?php endif; ?>/> 关闭</label>
       <span class="admin_note" >（开启后，用户在注册、验证手机号发送短信时发起验证）</span>
       </td>
    </tr>
  <tr>
      <td width="120" height="30" align="right"  >意见/建议：</td>
      <td  >
       <label><input name="captcha_config[varify_suggest]" type="radio" value="1" <?php if(C('qscms_captcha_config.varify_suggest') == 1): ?>checked<?php endif; ?>/> 开启</label>
       <label><input name="captcha_config[varify_suggest]" type="radio" value="0" <?php if(C('qscms_captcha_config.varify_suggest') == 0): ?>checked<?php endif; ?>/> 关闭</label>
       <span class="admin_note" >（开启后，用户在提交意见建议时发起验证）</span>
       </td>
    </tr>
    <tr>
      <td width="120" height="30" align="right"  >会员登录：</td>
      <td  >
	  <input name="captcha_config[user_login]" type="text" class="input_text_100" value="<?php echo C('qscms_captcha_config.user_login');?>"/> 次
	  <span class="admin_note" >（填写数字，0为开启验证码，如设置为3，则错误3次才发起验证）</span>
       </td>
    </tr>
     <tr>
      <td width="120" height="30" align="right"  >后台登录：</td>
      <td  ><input name="captcha_config[admin_login]" type="text" class="input_text_100" value="<?php echo C('qscms_captcha_config.admin_login');?>"/> 次
	  <span class="admin_note" >（填写数字，0为开启验证码，如设置为3，则错误3次才发起验证）</span>
       </td>
    </tr>
    
    <tr>
      <td height="30" align="right"  >&nbsp;</td>
      <td height="50"  > 
            <input name="submit3" type="submit" class="admin_submit"    value="保存"/>
    
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
<script src="http://static.geetest.com/static/tools/gt.jss"></script>
<script type="text/javascript">
  $(".J_type").click(function(){
    if($("#J_type_open").is(':checked')){
      $(".captcha_show").show();
    }else{
      $(".captcha_show").hide();
    }
  });
  $("#btnCheck").click(function(){
    $("#test").show();
  });
      
<?php if(C('qscms_captcha_open') == 0): ?>$(".captcha_show").hide();<?php endif; ?>
</script>
</body>
</html>