<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<link rel="shortcut icon" href="<?php echo C('qscms_site_dir');?>favicon.ico" />
	<meta name="author" content="骑士CMS" />
	<meta name="copyright" content="74cms.com" />
	<title>网站后台管理中心- 学生管理系统</title>
	<link href="__ADMINPUBLIC__/css/common.css" rel="stylesheet" type="text/css" />
</head>
<body style="background-color:#FFFFFF">
	<div class="login_top" >
	  <div class="logo"><img src="__ADMINPUBLIC__/images/login_logo.gif" /></div>
	</div>
	<form id="form1" name="form1" method="post" action="<?php echo U('index/login');?>">
	<div class="login_main">
	
		<?php if(!empty($err)): ?><div class="ce">
		   <div class="err" id="J_errbox" ><?php echo ($err); ?></div>
		 </div><?php endif; ?>
		 
	  <div class="ce"><div class="imgbg"></div><input name="username" type="text" maxlength="16" id="username" class="linput" placeholder="请输入用户名"/></div>
	   <div class="ce"><div class="imgbg pwd"></div><input name="password" type="password" id="admin_pwd" value="" class="linput pwd" placeholder="请输入密码"/></div>
	    <div class="ce"><input class="btn" type="button" name="Submit" id="J_dologin" value="登录" />
		<input type="button" id="btnCheck" style="display:none;">
		</div>
	
	</div>
	<div id="popup-captcha"></div>
</form>
		
		
	<div class="login_foot link_lan">高效人才系统解决方案 <a href="http://www.74cms.com/bbs" target="_blank">技术论坛</a><br />
				Powered by <a href="http://www.74cms.com/" target="_blank"><em> v <?php echo C('QSCMS_VERSION');?></em></a> Copyright &copy;2017
				
				
</div>
	 
<script src="__ADMINPUBLIC__/js/jquery.min.js"></script>
<script src="http://static.geetest.com/static/tools/gt.js"></script>
<script language ="javascript">    
		function init(){    
			var ctrl=document.getElementById("username");    
			ctrl.focus();    
		}  
		init(); 
		$(document).ready(function(){
			$('#admin_pwd').bind('keypress', function(event) {
				if (event.keyCode == "13") {
					$("#J_dologin").click();
				}
			});
			$('#J_dologin').live('click', function() {
				if("<?php echo ($verify_userlogin_admin); ?>"==1){
					$("#btnCheck").click();
				}else{
				 	doLogin();
				}
			});
			$.ajax({
		        // 获取id，challenge，success（是否启用failback）
		        url: "<?php echo U('home/captcha/index');?>?t=" + (new Date()).getTime(), // 加随机数防止缓存
		        type: "get",
		        dataType: "json",
		        success: function (data) {
		            // 使用initGeetest接口
		            // 参数1：配置参数
		            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
		            initGeetest({
		                gt: data.gt,
		                challenge: data.challenge,
		                product: "popup", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
		                offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
		            }, handler);
		        },
		        error:function(data){
		        	$('#J_errbox').text(data['responseText']).show();
		        	// $('#J_dologin').die().removeClass('J_hoverbut').addClass('btn_disabled').val('无法完成登录');
		        }
		    });
		    function doLogin() {
		    	// 提交表单
				$("#form1").submit();
		    }
			var handler = function(captchaObj) {
				captchaObj.appendTo("#popup-captcha");
				captchaObj.bindOn("#btnCheck");
				captchaObj.onSuccess(function() {
					doLogin();
				});
				captchaObj.onFail(function() {
					$('#J_errbox').text("滑动验证失败！").show();
				});
				captchaObj.onError(function() {
					$('#J_errbox').text("网络错误，请稍候再试！").show();
				});
				captchaObj.getValidate()
			};
		}); 
	</script>
</body>
</html>