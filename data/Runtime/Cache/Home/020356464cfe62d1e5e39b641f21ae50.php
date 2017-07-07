<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo ($page_seo["title"]); ?></title>
<meta name="keywords" content="<?php echo ($page_seo["keywords"]); ?>"/>
<meta name="description" content="<?php echo ($page_seo["description"]); ?>"/>
<meta name="author" content="骑士CMS"/>
<meta name="copyright" content="74cms.com"/>
<?php if($apply['Subsite']): ?><base href="<?php echo C('SUBSITE_DOMAIN');?>"/><?php endif; ?>
<link rel="shortcut icon" href="<?php echo C('qscms_site_dir');?>favicon.ico"/>
<script src="__HOMEPUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript">
	var app_spell = "<?php echo APP_SPELL;?>";
	var qscms = {
		base : "<?php echo C('SUBSITE_DOMAIN');?>",
		keyUrlencode:"<?php echo C('qscms_key_urlencode');?>",
		domain : "http://<?php echo ($_SERVER['HTTP_HOST']); ?>",
		root : "/zhaopin42/index.php",
		companyRepeat:"<?php echo C('qscms_company_repeat');?>",
		is_subsite : <?php if($apply['Subsite'] and C('SUBSITE_VAL.s_id') > 0): ?>1<?php else: ?>0<?php endif; ?>,
		subsite_level : "<?php echo C('SUBSITE_VAL.s_level');?>",
		smsTatus: "<?php echo C('qscms_sms_open');?>"
	};
	$(function(){
		$.getJSON("<?php echo U('Home/AjaxCommon/get_header_min');?>",function(result){
			if(result.status == 1){
				$('#J_header').html(result.data.html);
			}
		});
	})
</script>
<?php echo ($synlogin); ?>
	<link href="../public/css/members/common.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="header_min" id="header">
	<div class="header_min_top">
		<div id="J_header" class="itopl font_gray6 link_gray6">
			<span class="link_yellow">欢迎登录<?php echo C('qscms_site_name');?>！请 <a href="<?php echo U('home/members/login');?>">登录</a> 或 <a href="<?php echo U('home/members/register');?>">免费注册</a></span>
		</div>
		<div class="itopr font_gray9 link_gray6 substring"> <a href="/zhaopin42/" class="home">网站首页</a>|<a href="<?php echo url_rewrite('QS_m');?>" class="m">手机访问</a>|<a href="<?php echo url_rewrite('QS_help');?>" class="help">帮助中心</a>|<?php if(!empty($apply['Mall'])): ?><a href="<?php echo url_rewrite('QS_mall_index');?>" class="shop"><?php echo C("qscms_points_byname");?>商城</a>|<?php endif; ?><a href="<?php echo U('Home/Index/shortcut');?>" class="last">保存到桌面</a> </div>
	    <div class="clear"></div>
	</div>
</div>
<div class="user_head_bg">
	<div class="user_head">
		<div class="logobox">
			<a href="/zhaopin42/"><img src="<?php if(C('qscms_logo_home')): echo attach(C('qscms_logo_home'),'resource'); else: ?>../public/images/logo.gif<?php endif; ?>" border="0"/></a>
		</div>
		<div class="logotxt">
			|&nbsp;&nbsp;
			<?php if(ACTION_NAME == 'login'): ?>会员登录
			<?php else: ?>
				<?php if($utype == 0): ?>会员注册<?php endif; ?>
				<?php if($utype == 1): ?>企业会员注册<?php endif; ?>
				<?php if($utype == 2): ?>个人会员注册<?php endif; endif; ?>
		</div>
		<div class="reg">
			<?php if(ACTION_NAME == 'login'): ?>还没有账号？ <a href="<?php echo U('members/register');?>" class="btn_blue J_hoverbut btn_inline">立即注册</a>
			<?php else: ?>
				已经有账号？ <a href="<?php echo U('members/login');?>" class="btn_blue J_hoverbut btn_inline">立即登录</a><?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
</div>
	<div class="ban_box">
		<div class="banner_list banner_list2"></div>
		<div class="banner_list banner_list3"></div>
		<div class="banner_list banner_list1"></div>
		<div class="maind">
			<div class="login">
				<!--用户名密码登录 -->
				<div class="mob j_mob_show">
					<?php if(C('qscms_weixin_apiopen') and C('qscms_weixin_scan_login')): ?><div class="righttab J_hoverbut J_mob" title="微信扫码登录"></div><?php endif; ?>
  					<div class="tit">
  						<span class="switch_txt active">会员登录</span>
  						<?php if(C('qscms_sms_open') == 1): ?><span class="switch_txt">手机动态码登录</span><?php endif; ?>
  						<div id="forAccountLogin" class="switch_account link_blue" data-index="0"><a href="javascript:;">切换为账号登录</a></div>
  					</div>
					<div class="type_box active">
				    	<div class="err J_errbox"></div>
				        <div class="inputbox J_focus">
							<div class="imgbg"></div>
				        	<input type="text" class="input_login" name="username" id="username" placeholder="手机号/会员名/邮箱"/> 
				        </div>
						<div class="inputbox J_focus">
						    <div class="imgbg pwd"></div>
							<input type="password" class="input_login pwd J_loginword" name="password" id="password" placeholder="请输入密码"  />
						</div>
						<div class="txtbox link_gray6">
							<div class="td1"><label><input name="expire" class="J_expire" checked="checked" type="checkbox" value="1" /> 7天内自动登录</label></div>				
							<div class="td2"><a href="<?php echo U('members/user_getpass');?>">忘记密码?</a></div>
						</div>
		 		        <div class="btnbox">
		 		        	<input class="btn_login J_hoverbut" type="button" id="J_dologin" value="登录" />
		 		        </div>
	        			<div class="qqbox">
						  	<div class="qtit">
							  		<div class="qtit_left">
										<?php if(!empty($oauth_list)): if(!(count($oauth_list) == 1 AND array_key_exists('weixin',$oauth_list))): ?>使用合作账号登录<?php endif; endif; ?>
									</div>
								<?php if(C('qscms_sms_open') == 1): ?><div class="qtit_right link_blue"><a id="forMobileLogin" href="javascript:;" data-index="1">使用手机动态码登录</a></div><?php endif; ?>
								<div class="clear"></div>
						  	</div>
						  	<div class="appsparent">
							    <div class="apps">
							    	<?php if(is_array($oauth_list)): $i = 0; $__LIST__ = $oauth_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oauth): $mod = ($i % 2 );++$i; if($key != 'weixin'): ?><a class="ali <?php echo ($key); ?>" href="<?php echo U('callback/index',array('mod'=>$key,'type'=>'login'));?>" title="<?php echo ($oauth["name"]); ?>账号登录"></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
					  		<div class="clear"></div>
						</div>
					</div>
					<div class="type_box">
				    	<div class="err J_errbox"></div>
				        <div class="inputbox J_focus">
							<div class="imgbg"></div>
				        	<input type="text" class="input_login" name="mobile" id="mobile" placeholder="请输入手机号"/> 
				        </div>
						<div class="inputbox J_focus">
						    <div class="imgbg pwd"></div>
							<input type="text" class="input_login pwd code J_loginword" name="verfy_code" id="verfy_code" placeholder="请输入手机验证码"  />
							<input class="btn_login code J_hoverbut" type="button" id="getVerfyCode" value="获取验证码" />
						</div>
						<div class="txtbox link_gray6">
							<div class="td1"><label><input name="expire_obile" class="J_expire" checked="checked" type="checkbox" value="1" /> 7天内自动登录</label></div>					
							<div class="td2"><a href="<?php echo U('members/user_getpass');?>">忘记密码?</a></div>
						</div>
		 		        <div class="btnbox">
		 		        	<input class="btn_login J_hoverbut" type="button" id="J_dologinByMobile" value="登录" />
		 		        </div>
	        			<div class="qqbox">
						  	<div class="qtit">
						  		<div class="qtit_left">使用合作账号登录</div>
						  		<div class="qtit_right link_blue"></div>
						  		<div class="clear"></div>
						  	</div>
					  		<div class="appsparent">
							    <div class="apps">
							    	<?php if(is_array($oauth_list)): $i = 0; $__LIST__ = $oauth_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oauth): $mod = ($i % 2 );++$i; if($key != 'weixin'): ?><a class="ali <?php echo ($key); ?>" href="<?php echo U('callback/index',array('mod'=>$key,'type'=>'login'));?>" title="<?php echo ($oauth["name"]); ?>账号登录"></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
					  		<div class="clear"></div>
						</div>
					</div>
				</div>
				<!--二维码的登录 -->
				<?php if(C('qscms_weixin_apiopen') and C('qscms_weixin_scan_login')): ?><div class="qr_code J_qr_code_show">
					    <div class="righttab J_hoverbut J_qr_code" title="账号密码登录"></div>
						<div class="tit">微信扫码，安全登录</div>
					    <div id="J_weixinQrCode" class="code"></div>
					    <div class="txt">打开 手机微信 <br /> 扫一扫登录</div>
					</div><?php endif; ?>
			</div>
		</div>
	</div>
	<input type="hidden" id="J_loginType" value="0">
	<input type="hidden" id="verify_userlogin" value="<?php echo ($verify_userlogin); ?>">
    <input type="hidden" id="J_captcha_open" value="<?php if(C('qscms_captcha_open') == 1 && C('qscms_captcha_config.varify_mobile') == 1): ?>1<?php else: ?>0<?php endif; ?>" />
	<input type="button" id="btnCheck" style="display:none;">
	<input type="hidden" id="J_sendVerifyType" value="0">
	<div id="popup-captcha"></div>
	<div class="footer_min" id="footer">
	<div class="links link_gray6">
	<a target="_blank" href="<?php echo url_rewrite('QS_index');?>">网站首页</a>   
	<?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"会员登录","keywords"=>"","description"=>"","header_title"=>""),$list);?>
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>|   <a target="_blank" href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	|   <a target="_blank" href="<?php echo url_rewrite('QS_suggest');?>">意见建议</a> 
	</div>
	<div class="txt">
		
		联系地址：<?php echo C('qscms_address');?>      联系电话：<?php echo C('qscms_bootom_tel');?><br />
		
		<?php echo C('qscms_bottom_other');?>     <?php echo C('qscms_icp');?>
		<?php echo htmlspecialchars_decode(C('qscms_statistics'));?>
		
	</div>
</div>

<div class="">
	<div class=""></div>
</div>
<!--[if lt IE 9]>
	<script type="text/javascript" src="__HOMEPUBLIC__/js/PIE.js"></script>
  <script type="text/javascript">
    (function($){
        $.pie = function(name, v){
            // 如果没有加载 PIE 则直接终止
            if (! PIE) return false;
            // 是否 jQuery 对象或者选择器名称
            var obj = typeof name == 'object' ? name : $(name);
            // 指定运行插件的 IE 浏览器版本
            var version = 9;
            // 未指定则默认使用 ie10 以下全兼容模式
            if (typeof v != 'number' && v < 9) {
                version = v;
            }
            // 可对指定的多个 jQuery 对象进行样式兼容
            if ($.browser.msie && obj.size() > 0) {
                if ($.browser.version*1 <= version*1) {
                    obj.each(function(){
                        PIE.attach(this);
                    });
                }
            }
        }
    })(jQuery);
    if ($.browser.msie) {
      $.pie('.pie_about');
    };
  </script>
<![endif]-->
<script type="text/javascript" src="__HOMEPUBLIC__/js/jquery.disappear.tooltip.js"></script>
<div class="floatmenu">
<?php if(($show_backtop) == "1"): ?><div class="item mobile">
    <a class="blk"></a>
    <?php if(($show_backtop_app) == "1"): ?><div class="popover <?php if($show_backtop_weixin == 1): ?>popover1<?php endif; ?>">
      <div class="popover-bd">
        <label>手机APP</label>
        <span class="img-qrcode img-qrcode-mobile"><img src="<?php echo C('qscms_site_dir');?>index.php?m=Home&c=Qrcode&a=index&url=<?php echo urlencode(C('qscms_site_domain').U('Mobile/Index/app_download'));?>" alt=""></span>
      </div>
    </div><?php endif; ?>
    <?php if(($show_backtop_weixin) == "1"): ?><div class="popover">
      <div class="popover-bd">
        <label class="wx">企业微信</label>
        <span class="img-qrcode img-qrcode-wechat"><img src="<?php echo attach(C('qscms_weixin_img'),'resource');?>" alt=""></span>
      </div>
      <div class="popover-arr"></div>
    </div><?php endif; ?>
  </div><?php endif; ?>
  <div class="item ask">
    <a class="blk" target="_blank" href="<?php echo url_rewrite('QS_suggest');?>"></a>
  </div>
  <div id="backtop" class="item backtop" style="display: none;"><a class="blk"></a></div>
</div>
<SCRIPT LANGUAGE="JavaScript">

var global = {
    h:$(window).height(),
    st: $(window).scrollTop(),
    backTop:function(){
      global.st > (global.h*0.5) ? $("#backtop").show() : $("#backtop").hide();
    }
  }
  $('#backtop').on('click',function(){
    $("html,body").animate({"scrollTop":0},500);
  });
  global.backTop();
  $(window).scroll(function(){
      global.h = $(window).height();
      global.st = $(window).scrollTop();
      global.backTop();
  });
  $(window).resize(function(){
      global.h = $(window).height();
      global.st = $(window).scrollTop();
      global.backTop();
  })
</SCRIPT>
	<script type="text/javascript" src="../public/js/jquery.login.js"></script>
	<script src="../public/js/members/jquery.common.js" type="text/javascript" language="javascript"></script>
	<script src="http://static.geetest.com/static/tools/gt.js"></script>
</body>
</html>