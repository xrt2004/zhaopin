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
	<link href="../public/css/common.css" rel="stylesheet" type="text/css" />
	<link href="../public/css/index.css" rel="stylesheet" type="text/css" />
	<link href="../public/css/slider/themes/default/default.css" rel="stylesheet" type="text/css" />
	<link href="../public/css/slider/nivo-slider.css" rel="stylesheet" type="text/css" />
	<script src="../public/js/jquery.common.js" type="text/javascript" language="javascript"></script>
</head>
<body>
<!--顶部小导航 -->
<div class="header_min" id="header">
	<div class="header_min_top">
		<div id="J_header" class="itopl font_gray6 link_gray6">
			<span class="link_yellow">欢迎登录<?php echo C('qscms_site_name');?>！请 <a href="<?php echo U('home/members/login');?>">登录</a> 或 <a href="<?php echo U('home/members/register');?>">免费注册</a></span>
		</div>
		<div class="itopr font_gray9 link_gray6 substring"> <a href="/zhaopin42/" class="home">网站首页</a>|<a href="<?php echo url_rewrite('QS_m');?>" class="m">手机访问</a>|<a href="<?php echo url_rewrite('QS_help');?>" class="help">帮助中心</a>|<?php if(!empty($apply['Mall'])): ?><a href="<?php echo url_rewrite('QS_mall_index');?>" class="shop"><?php echo C("qscms_points_byname");?>商城</a>|<?php endif; ?><a href="<?php echo U('Home/Index/shortcut');?>" class="last">保存到桌面</a> </div>
	    <div class="clear"></div>
	</div>
</div>
<!--logo通栏-->
<div class="index_head">
	<div class="logobox">
		<a href="/zhaopin42/"><img src="<?php if(C('qscms_logo_home')): echo attach(C('qscms_logo_home'),'resource'); else: ?>../public/images/logo.gif<?php endif; ?>" border="0"/></a>
        <?php if($apply['Subsite']): ?><div class="sub-txt-group" id="J-choose-subcity">
	            <div class="stg-txt"><?php echo C('SUBSITE_VAL.s_sitename');?></div>
	            <div class="stg-icon"></div>
	            <div class="clear"></div>
	        </div><?php endif; ?>
    </div>
	<div class="sobox">
		<div class="inputbg">
			<div class="selecttype J_hoverbut">搜职位</div>
			<div class="selecttype_down">
				<div class="down_list J_hoverbut" data-type="QS_resumelist">搜简历</div>
			</div>
			<input type="hidden" id="top_search_type" value="QS_jobslist" />
			<div class="inoputbox"><input id="top_search_input" name="" type="text"  value=""/></div>
			<input id="top_search_btn" type="button" class="sobut J_hoverbut" value="搜索" />
            <input type="hidden" name="lng" id="lng"  value=""/>
            <input type="hidden" name="lat" id="lat"  value=""/>
            <?php if($apply['Subsite'] and $subsite_val['s_id'] > 0): ?><input type="hidden" class="map-lng" value="<?php if($_GET['lng']== ''): echo ((isset($subsite_val["s_map_center_x"]) && ($subsite_val["s_map_center_x"] !== ""))?($subsite_val["s_map_center_x"]):C('qscms_map_center_x')); else: echo ($_GET['lng']); endif; ?>">
                <input type="hidden" class="map-lat" value="<?php if($_GET['lat']== ''): echo ((isset($subsite_val["s_map_center_y"]) && ($subsite_val["s_map_center_y"] !== ""))?($subsite_val["s_map_center_y"]):C('qscms_map_center_y')); else: echo ($_GET['lat']); endif; ?>">
            <?php else: ?>
                <input type="hidden" class="map-lng" value="<?php if($_GET['lng']== ''): echo C('qscms_map_center_x'); else: echo ($_GET['lng']); endif; ?>">
                <input type="hidden" class="map-lat" value="<?php if($_GET['lat']== ''): echo C('qscms_map_center_y'); else: echo ($_GET['lat']); endif; ?>"><?php endif; ?>
		</div>
	    <div class="righttxt link_gray6"><a href="<?php echo url_rewrite('QS_jobs');?>">分类搜索</a> <a href="javascript:;" id="popupBox" class="map">地图找工作</a></div>
	</div>
	<?php if(!empty($apply['Mobile'])): ?><div class="mob">
			<img id="mobile_img" src="../public/images/115.png" border="0"/>
			<img id="mobile_qrcode" src="<?php echo C('qscms_site_dir');?>index.php?m=Home&c=Qrcode&a=index&url=<?php echo urlencode(build_mobile_url());?>" border="0"/>
		</div>
        <script type="text/javascript">
            $('#mobile_img').mouseenter(function() {
                $('#mobile_img').hide();
                $('#mobile_qrcode').toggle();
            });
            $('#mobile_qrcode').mouseleave(function() {
                $('#mobile_qrcode').hide();
                $('#mobile_img').toggle();
            });
        </script><?php endif; ?>
	<div class="clear"></div>
</div>

<div class="index_nav_bg">
  <div class="index_nav">
    <ul class="link_gray6 nowrap">
    	<?php $tag_nav_class = new \Common\qscmstag\navTag(array('列表名'=>'nav','调用名称'=>'QS_top','数量'=>'10','cache'=>'0','type'=>'run',));$nav = $tag_nav_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$nav);?>
    	<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li class="nli J_hoverbut <?php if(MODULE_NAME == C('DEFAULT_MODULE')): if($nav['tag'] == strtolower(CONTROLLER_NAME)): ?>select<?php endif; else: if($nav['tag'] == strtolower(MODULE_NAME)): ?>select<?php endif; endif; ?>"><a href="<?php echo ($nav['url']); ?>" target="<?php echo ($nav["target"]); ?>"><?php echo ($nav["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
	<div class="clear"></div>
  </div>
</div>
<!-- -->
<div class="index_1">
	<div class="leftlogin">
		<div id="J_userWrap" class="shadowbg pie_about">
			<!--未登录 -->
	  		<div class="login">
				<div class="lontit">
					<span class="switch_txt active">会员登录</span>
  					<span class="switch_txt">手机动态码登录</span>
  					<div id="forAccountLogin" class="switch_account link_blue" data-index="0"><a href="javascript:;">切换为账号登录</a></div>
					<?php if(C('qscms_weixin_apiopen') and C('qscms_weixin_scan_login')): ?><div class="code_login" title="切换扫码登录"></div>
						<div class="txt_login"  title="切换到用户名密码登录"></div><?php endif; ?>
				</div>
				<div class="type_box active">
					<div class="errbox J_errbox"></div>
					<div class="j_mob_show">
							<div class="inputbox"><input name="username" type="text" value="" placeholder="请输入邮箱/用户名/手机号" class="input"/></div>
							<div class="inputbox"><input name="password" type="password" value="" placeholder="请输入密码" class="input J_loginword"/></div>
							<div class="memorybox">
								<div class="memory"><label><input name="expire" class="J_expire" type="checkbox" value="0"/> 自动登录</label></div>
								<div class="getpwd link_yellow"><a href="<?php echo U('members/user_getpass');?>">忘记密码？</a></div>
								<div class="clear"></div>
							</div>
							<div class="inputbox">
								<input id="J_do_login_btn" type="button" value="立即登录"  class="index_login_btn"/>
							</div>
							<div class="apptit">
								<div class="t">
									<?php if(!empty($oauth_list)): if(!(count($oauth_list) == 1 AND array_key_exists('weixin',$oauth_list))): ?>使用合作账号登录<?php endif; endif; ?>
								</div>
								<?php if(C('qscms_sms_open') == 1): ?><div class="t link_blue last"><a id="forMobileLogin" href="javascript:;" data-index="1">使用手机动态码登录</a></div><?php endif; ?>
								<div class="clear"></div>
							</div>
							<div class="appsparent">
							    <div class="apps">
							    	<?php if(is_array($oauth_list)): $i = 0; $__LIST__ = $oauth_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oauth): $mod = ($i % 2 );++$i; if($key != 'weixin'): ?><a class="ali <?php echo ($key); ?>" href="<?php echo U('callback/index',array('mod'=>$key,'type'=>'login'));?>" title="<?php echo ($oauth["name"]); ?>账号登录"></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
							<div class="btns">
						  		<a class="addbut a1" href="<?php echo U('members/register',array('utype'=>1));?>">发布职位</a>
			  	              	<a class="addbut a2" href="<?php echo U('members/register',array('utype'=>2));?>">填写简历</a>
			  	            	<div class="clear"></div>
							</div>  
					</div>
				</div>
				<div class="type_box">
					<div class="errbox J_errbox"></div>
					<div class="j_mob_show">
							<div class="inputbox"><input name="mobile" type="text" value="" placeholder="请输入手机号" class="input"/></div>
							<div class="inputbox">
								<input name="verfy_code" type="text" value="" placeholder="请输入手机验证码" class="J_loginword input code"/>
								<input id="getVerfyCode" type="button" value="获取验证码" class="index_login_btn_code"/>
							</div>
							<div class="memorybox">
								<div class="memory"><label><input name="expire_obile" class="J_expire" type="checkbox" value="0"/> 自动登录</label></div>
								<div class="getpwd link_yellow"><a href="<?php echo U('members/user_getpass');?>">忘记密码？</a></div>
								<div class="clear"></div>
							</div>
							<div class="inputbox">
								<input id="J_do_login_bymobile_btn" type="button" value="立即登录"  class="index_login_btn"/>
							</div>
							<div class="apptit">
								<div class="t">其他账户登录</div>
								<div class="t link_blue last"></div>
								<div class="clear"></div>
							</div>
							<div class="appsparent">
							    <div class="apps">
							    	<?php if(is_array($oauth_list)): $i = 0; $__LIST__ = $oauth_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$oauth): $mod = ($i % 2 );++$i; if($key != 'weixin'): ?><a class="ali <?php echo ($key); ?>" href="<?php echo U('callback/index',array('mod'=>$key,'type'=>'login'));?>" title="<?php echo ($oauth["name"]); ?>账号登录"></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
							<div class="btns">
						  		<a class="addbut a1" href="<?php echo U('company/add_jobs');?>">发布职位</a>
			  	              	<a class="addbut a2" href="<?php echo U('personal/add_resume');?>">填写简历</a>
			  	            	<div class="clear"></div>
							</div>  
					</div>
				</div>
				<?php if(C('qscms_weixin_apiopen') and C('qscms_weixin_scan_login')): ?><div class="J_qr_code_show" style="display: none">
					    <div id="J_weixinQrCode" class="codebox"></div>
		                <div class="codetip">请使用微信扫一扫登录</div>
		    		</div><?php endif; ?>
		    	<input type="hidden" id="J_loginType" value="0">
		    	<input type="button" id="btnVerifiCode" style="display:none;">
				<input type="hidden" id="verify_userlogin" value="<?php echo ($verify_userlogin); ?>">
				<input type="hidden" id="J_sendVerifyType" value="0">
                <input type="hidden" id="whetherVisitors" value="<?php if($visitor): ?>1<?php else: ?>0<?php endif; ?>">
			</div>
		</div>
	</div>
	<div class="rben">
		<div class="wrapper">
			<?php $tag_ad_class = new \Common\qscmstag\adTag(array('列表名'=>'ad','广告位名称'=>'QS_indexfocus','广告数量'=>'6','cache'=>'0','type'=>'run',));$ad = $tag_ad_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$ad);?>
			<div class="slider-wrapper theme-default">
				<div id="slider" class="rbanner nivoSlider">
					<?php if(empty($ad['list'])): ?><img src="<?php echo attach('default_ad.png','resource');?>" />
					<?php else: ?>
						<?php if(is_array($ad['list'])): $i = 0; $__LIST__ = $ad['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad_info): $mod = ($i % 2 );++$i; echo ($ad_info["html"]); endforeach; endif; else: echo "" ;endif; endif; ?>
				</div>
			</div>
		</div>
        <div class="emerb">
	 	    <div class="emerico"></div>
	        <div class="more link_gray9"><a href="<?php echo url_rewrite('QS_jobslist',array('emergency'=>1));?>">更多></a></div>
            <div class="slide">
            	<?php $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'emergency_jobs','紧急招聘'=>'1','显示数目'=>'6','cache'=>'0','type'=>'run',));$emergency_jobs = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$emergency_jobs);?>
				<?php if(is_array($emergency_jobs['list'])): $i = 0; $__LIST__ = $emergency_jobs['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><div class="sli">
						<div class="tit substring link_gray6"><a target="_blank" href="<?php echo ($jobs["jobs_url"]); ?>"><?php echo ($jobs["jobs_name"]); ?></a></div>
						<div class="salary substring"><?php echo ($jobs["wage_cn"]); ?></div>
						<div class="clear"></div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
        </div>
		<!--广告位 -->
		<div class="ban_bot_ads">
			<?php $tag_ad_class = new \Common\qscmstag\adTag(array('列表名'=>'ad','广告位名称'=>'QS_indexrecommend','广告数量'=>'4','cache'=>'0','type'=>'run',));$ad = $tag_ad_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$ad);?>
			<?php if(is_array($ad['list'])): $i = 0; $__LIST__ = $ad['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad_info): $mod = ($i % 2 );++$i;?><div class="alist">
					<a target="_blank" href="<?php echo ($ad_info["href"]); ?>" title="<?php echo ($ad_info["title"]); ?>">
						<img src="<?php echo attach($ad_info['content'],'ads');?>" border="0">
					</a>
					<?php if(!empty($ad_info['company']['companyname'])): ?><div class="showname substring link_white pie_about"><a target="_blank" href="<?php echo ($ad_info["href"]); ?>"><?php echo ($ad_info['company']['companyname']); ?></a></div><?php endif; ?>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<!-- -->
		<!--公告 -->
		<div class="notices">
			<div class="noticestab">
				<div class="tli select">公告</div>
				<?php if(!empty($apply['Jobfair'])): ?><div class="tli last">招聘会</div><?php endif; ?>
				<div class="clear"></div>
			</div>
			<div class="notice_showtabs first">
				<ul class="link_gray6">
					<?php $tag_notice_list_class = new \Common\qscmstag\notice_listTag(array('列表名'=>'notice_list','显示数目'=>'3','分类'=>'1','cache'=>'0','type'=>'run',));$notice_list = $tag_notice_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$notice_list);?>
					<?php if(is_array($notice_list['list'])): $i = 0; $__LIST__ = $notice_list['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$notice): $mod = ($i % 2 );++$i;?><li class="substring new"><a href="<?php echo ($notice["url"]); ?>" target="_blank"><?php echo ($notice["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<?php if(!empty($apply['Jobfair'])): ?><div class="notice_showtabs">
					<!--招聘会 -->
					<ul class="link_gray6">
						<?php $tag_jobfair_list_class = new \Common\qscmstag\jobfair_listTag(array('列表名'=>'jobfair_list','显示数目'=>'3','排序'=>'ordid:desc','cache'=>'0','type'=>'run',));$jobfair_list = $tag_jobfair_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$jobfair_list);?>
						<?php if(is_array($jobfair_list['list'])): $i = 0; $__LIST__ = $jobfair_list['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobfair): $mod = ($i % 2 );++$i;?><li class="substring new"><a href="<?php echo ($jobfair['url']); ?>" target="_blank"><?php echo ($jobfair["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div><?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<?php $tag_ad_class = new \Common\qscmstag\adTag(array('列表名'=>'ad','广告位名称'=>'QS_indextopimg','广告数量'=>'2','cache'=>'0','type'=>'run',));$ad = $tag_ad_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$ad);?>
<?php if(!empty($ad['list'])): if(is_array($ad['list'])): $i = 0; $__LIST__ = $ad['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad_info): $mod = ($i % 2 );++$i;?><div class="ad1200_80">
			<a href="<?php echo ($ad_info["href"]); ?>" target="_blank" title="<?php echo ($ad_info["title"]); ?>">
				<img src="<?php echo attach($ad_info['content'],'ads');?>" border="0" />
			</a>
			</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
<?php $tag_ad_class = new \Common\qscmstag\adTag(array('列表名'=>'ad','广告位名称'=>'QS_indexcentreimg','广告数量'=>'2','cache'=>'0','type'=>'run',));$ad = $tag_ad_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$ad);?>
<?php if(!empty($ad['list'])): ?><div class="index_2">
		<?php if(is_array($ad['list'])): $i = 0; $__LIST__ = $ad['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad_info): $mod = ($i % 2 );++$i;?><div class="ad590_80">
				<a href="<?php echo ($ad_info["href"]); ?>" target="_blank" title="<?php echo ($ad_info["title"]); ?>">
					<img src="<?php echo attach($ad_info['content'],'ads');?>" border="0"/>
				</a>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		<div class="clear"></div>
	</div><?php endif; ?>
<?php $tag_ad_class = new \Common\qscmstag\adTag(array('列表名'=>'ad','广告位名称'=>'QS_indexcenterrecommend','职位数量'=>'12','广告数量'=>'12','cache'=>'0','type'=>'run',));$ad = $tag_ad_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$ad);?>
<?php if(!empty($ad['list'])): ?><div class="index_3">
		<?php if(is_array($ad['list'])): $i = 0; $__LIST__ = $ad['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad_info): $mod = ($i % 2 );++$i;?><div class="J_hoverbut ad188_78">
				<div class="imgbox">
					<?php if(!empty($ad_info['company']['companyname'])): ?><div class="showinfo pie_about">
						<div class="comname substring link_yellow"><a target="_blank" href="<?php echo ($ad_info["href"]); ?>"><?php echo ($ad_info['company']['companyname']); ?></a></div>
						<?php if(!empty($ad_info['company']['jobs'])): ?><div class="jobslist link_gray6">
						        <?php if(is_array($ad_info[company]['jobs'])): $i = 0; $__LIST__ = $ad_info[company]['jobs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><div class="jli substring"><a target="_blank" href="<?php echo ($jobs["jobs_url"]); ?>"><?php echo ($jobs["jobs_name"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
							</div><?php endif; ?>
						<?php if(!empty($ad_info['company']['jobs_count'])): ?><div class="count">
					          	<div class="v">共有<?php echo ($ad_info['company']['jobs_count']); ?>个职位</div>
								<div class="more link_blue"><a target="_blank" href="<?php echo url_rewrite('QS_companyjobs',array('id'=>$ad_info['company']['id']));?>">查看全部</a></div>
								<div class="clear"></div>
					        </div><?php endif; ?>
					</div><?php endif; ?>
					<a href="<?php echo ($ad_info["href"]); ?>" target="_blank" title="<?php echo ($ad_info["title"]); ?>">
						<img src="<?php echo attach($ad_info['content'],'ads');?>" border="0"/>
					</a>
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		<div class="clear"></div>
	</div><?php endif; ?>
<div class="index_4">
	<div class="nleft">
	    <div class="ntit">
		  	<div class="lt">名企招聘</div>
		  	<div class="rt no_change link_gray6"><a target="_blank" href="<?php echo url_rewrite('QS_helplist',array('id'=>19));?>">我也要出现在这里</a></div>
			<div class="clear"></div>
		</div>
	    <div class="vipjobs">
			<?php $tag_company_jobs_list_class = new \Common\qscmstag\company_jobs_listTag(array('列表名'=>'company_list','名企'=>'1','显示数目'=>'15','职位数量'=>'2','职位名长度'=>'5','cache'=>'0','type'=>'run',));$company_list = $tag_company_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$company_list);?>
			<?php if(is_array($company_list['list'])): $i = 0; $__LIST__ = $company_list['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$company): $mod = ($i % 2 );++$i;?><div class="comlist">
					<div class="comlogo"><a href="<?php echo ($company["company_url"]); ?>" target="_blank"><img src="<?php if(empty($company['logo'])): echo attach('no_logo.png','resource'); else: echo attach($company['logo'],'company_logo'); endif; ?>" border="0"/></a></div>
					<div class="com link_gray6">
						<div class="comname substring"><a href="<?php echo ($company["company_url"]); ?>" target="_blank"><?php echo ($company["companyname"]); ?></a></div>
						<div class="jobname_box">
							<?php if(!empty($company['jobs'])): if(is_array($company['jobs'])): $i = 0; $__LIST__ = $company['jobs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><a href="<?php echo ($jobs["jobs_url"]); ?>" class="jobname" title="<?php echo ($jobs["jobs_name"]); ?>" target="_blank"><?php echo ($jobs["jobs_name"]); ?></a>&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
							<?php else: ?>
								该公司暂无招聘职位<?php endif; ?>
						</div>
					</div>	
					<div class="clear"></div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<div class="clear"></div>
		</div>
	</div>
	<div class="nright">
		<div class="ntit">
		  	<div class="lt">本周热门职位</div>
		  	<div class="rt txt_right link_gray6"><a href="<?php echo url_rewrite('QS_jobslist',array('settr'=>7,'displayorder'=>'hot'));?>" target="_blank">更多></a></div>
			<div class="clear"></div>
		</div>
		<div class="hotjobs">
			<?php $tag_jobs_list_class = new \Common\qscmstag\jobs_listTag(array('列表名'=>'hot_jobs','日期范围'=>'7','排序'=>'hot','显示数目'=>'3','cache'=>'0','type'=>'run',));$hot_jobs = $tag_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$hot_jobs);?>
			<?php if(is_array($hot_jobs['list'])): $i = 0; $__LIST__ = $hot_jobs['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><div class="hjoslist">
					<div class="hj_l link_yellow substring"><a href="<?php echo ($jobs['jobs_url']); ?>" target="_blank"><?php echo ($jobs["jobs_name"]); ?></a></div>
					<div class="hj_r font_gray9"><?php echo ($jobs["wage_cn"]); ?></div>
					<div class="clear"></div>
					<div class="hj_com link_gray6 substring"><a href="<?php echo ($jobs['company_url']); ?>" target="_blank"><?php echo ($jobs["companyname"]); ?></a></div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		  <!--轮番广告位 -->
		<div class="wrapper">
			<div class="slider-wrapper theme-default">
				<div id="slidersmall" class="ad300_175 nivoSlider">
					<?php $tag_ad_class = new \Common\qscmstag\adTag(array('列表名'=>'ad','广告位名称'=>'QS_indexcentrefocus','广告数量'=>'5','cache'=>'0','type'=>'run',));$ad = $tag_ad_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$ad);?>
					<?php if(is_array($ad['list'])): $i = 0; $__LIST__ = $ad['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad_info): $mod = ($i % 2 );++$i; echo ($ad_info["html"]); endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php $tag_ad_class = new \Common\qscmstag\adTag(array('列表名'=>'ad','广告位名称'=>'QS_indexcenter','广告数量'=>'1','cache'=>'0','type'=>'run',));$ad = $tag_ad_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$ad);?>
<?php if(!empty($ad['list'])): ?><div class="ad1200_80">
		<?php if(is_array($ad['list'])): $i = 0; $__LIST__ = $ad['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad_info): $mod = ($i % 2 );++$i;?><a href="<?php echo ($ad_info["href"]); ?>" title="<?php echo ($ad_info["title"]); ?>" target="_blank">
				<img src="<?php echo attach($ad_info['content'],'ads');?>" border="0"/>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
	</div><?php endif; ?>
<div class="index_5 J_change_parent">
	<div class="ntit">
	  	<div class="lt">最新招聘</div>
		<div class="rt"><div class="refreshbtn J_change_batch" data-url="<?php echo U('AjaxCommon/jobs_list');?>">换一批</div></div>
		<div class="clear"></div>
	</div>
    <div class="jobs">
		<div class="ajax_loading"><div class="ajaxloadtxt"></div></div> 
		<?php $tag_company_jobs_list_class = new \Common\qscmstag\company_jobs_listTag(array('列表名'=>'new_jobs','职位数量'=>'3','排序'=>'rtime','显示数目'=>'20','cache'=>'0','type'=>'run',));$new_jobs = $tag_company_jobs_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$new_jobs);?>
		<div class="J_change_result">
			<?php if(is_array($new_jobs['list'])): $k = 0; $__LIST__ = $new_jobs['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$company): $mod = ($k % 2 );++$k;?><div class="jli j<?php echo ($k); ?>">
					<div class="jcom_name_box link_gray6">
						<a class="line_substring" href="<?php echo ($company["company_url"]); ?>" target="_blank"><?php echo ($company["companyname"]); ?></a>
						<?php if($company['audit'] == 1): ?><img src="<?php echo attach('auth.png','resource');?>" title="认证企业"><?php endif; ?>
						<?php if($company['setmeal_id'] > 1): ?><img src="<?php echo attach($company['setmeal_id'].'.png','setmeal_img');?>" title="<?php echo ($company["setmeal_name"]); ?>"><?php endif; ?>
						<?php if($company['famous'] == 1): ?><img src="<?php if(C('qscms_famous_company_img') == ''): echo attach('famous.png','resource'); else: echo attach(C('qscms_famous_company_img'),'images'); endif; ?>" title="诚聘通企业"/><?php endif; ?>
						<div class="clear"></div>
					</div>
					<div class="jobs_gourp link_gray6">
						<?php if(is_array($company['jobs'])): $i = 0; $__LIST__ = $company['jobs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><a target="_blank" href="<?php echo ($jobs["jobs_url"]); ?>" class="a_job"><?php echo ($jobs["jobs_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
						<div class="clear"></div>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
</div>

<div class="J_change_parent">
	<div class="index_6">
		<div class="ntit">
		  	<div class="lt">推荐简历</div>
			<div class="rt"><div class="refreshbtn J_change_batch" data-url="<?php echo U('AjaxCommon/resume_list');?>">换一批</div></div>
			<div class="clear"></div>
		</div>
	</div>

	<div class="index_6_p">
		<div class="ajax_loading"><div class="ajaxloadtxt"></div></div>
		<?php $tag_resume_list_class = new \Common\qscmstag\resume_listTag(array('列表名'=>'recommend_resume','照片'=>'1','显示数目'=>'5','cache'=>'0','type'=>'run',));$recommend_resume = $tag_resume_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$recommend_resume);?>
		<div class="J_change_result">
			<?php if(is_array($recommend_resume['list'])): $i = 0; $__LIST__ = $recommend_resume['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$resume): $mod = ($i % 2 );++$i;?><div class="rlist">
					<div class="li">
						<div class="photo"><a href="<?php echo ($resume["resume_url"]); ?>" target="_blank"><img src="<?php echo ($resume["photosrc"]); ?>" border="0"/></a></div>
            <div class="photo-blur">
              <img class="p-blur" src="<?php echo ($resume["photosrc"]); ?>" width="226" border="0"/>
            </div>
						<div class="name link_gray6"><a href="<?php echo ($resume["resume_url"]); ?>" target="_blank"><?php echo ($resume["fullname"]); ?></a></div>
						<div class="txt">
							<?php echo ($resume["education_cn"]); ?>,<?php echo ($resume["experience_cn"]); ?><br />
							<div class="ijobs substring"><?php echo ($resume["intention_jobs"]); ?></div>
						</div>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="clear"></div>
	</div>
</div>

<div class="index_7">
	<div class="ntit">
	  	<div class="lt">新闻资讯</div>
		<div class="rt link_gray6"><a href="<?php echo url_rewrite('QS_news');?>" target="_blank">更多></a></div>
		<div class="clear"></div>
	</div>
    <div class="nl">
	  	<div class="topnavbg">
			<div class="topnav">
				<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'article_category','类型'=>'QS_article','id'=>'1','显示数目'=>'7','cache'=>'0','type'=>'run',));$article_category = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$article_category);?>
				<?php if(is_array($article_category)): $i = 0; $__LIST__ = $article_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?><div class="J_news_list_title tl <?php if($i == 1): ?>select<?php endif; ?>" cid="<?php echo ($key); ?>"><?php echo ($category); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="clear"></div>
			</div>
		</div>
		<!--ajax加载 -->
	    <div class="newsbox J_news_content">
			<div class="ajax_loading"><div class="ajaxloadtxt"></div></div>
			<div class="J_news_txt">
				<?php if(is_array($article_category)): $i = 0; $__LIST__ = array_slice($article_category,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i; $tag_news_list_class = new \Common\qscmstag\news_listTag(array('列表名'=>'article_list','显示数目'=>'15','资讯小类'=>$key,'cache'=>'0','type'=>'run',));$article_list = $tag_news_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$article_list); endforeach; endif; else: echo "" ;endif; ?>
			  	<?php if(!empty($article_list)): ?><div class="imgnews">
						<div class="imgs">
							<a href="<?php echo ($article_list['list'][0]['url']); ?>" target="_blank">
								<img src="<?php echo ($article_list['list'][0]['img']); ?>" border="0"/>
							</a>
						</div>
						<div class="txt substring link_yellow">
							<a href="<?php echo ($article_list['list'][0]['url']); ?>" target="_blank"><?php echo ($article_list['list'][0]['title']); ?></a>
						</div>
				  	</div>
				    <div class="txtnews link_gray6">
				    	<?php if(is_array($article_list['list'])): $i = 0; $__LIST__ = array_slice($article_list['list'],1,14,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><div class="nlist substring">
								<a href="<?php echo ($article["url"]); ?>" style="<?php if($article['tit_color']): ?>color:<?php echo ($article["tit_color"]); ?>;<?php endif; if($article['tit_b'] > 0): ?>font-weight:bold<?php endif; ?> target="_blank""><?php echo ($article["title"]); ?></a>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
						<div class="clear"></div>
					</div>
					<div class="clear"></div><?php endif; ?>
			</div>
	    </div>
    </div>

	<div class="nr">
		<div class="newstab">
			<div class="newstli select">热点资讯</div>
			<div class="newstli">焦点新闻</div>
			<div class="clear"></div>
		</div>
		<div class="news_showtabs show link_gray6">
			<?php $tag_news_list_class = new \Common\qscmstag\news_listTag(array('列表名'=>'hot_news','显示数目'=>'9','属性'=>'2','cache'=>'0','type'=>'run',));$hot_news = $tag_news_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$hot_news);?>
			<?php if(is_array($hot_news['list'])): $i = 0; $__LIST__ = $hot_news['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$news): $mod = ($i % 2 );++$i;?><div class="tlist substring">
					<span class="<?php if($i <= 3): ?>sort1_3<?php else: ?>sort4_9<?php endif; ?>"><?php echo ($i); ?></span>
					<a href="<?php echo ($news["url"]); ?>" style="<?php if($news['tit_color']): ?>color:<?php echo ($news["tit_color"]); ?>;<?php endif; if($news['tit_b'] > 0): ?>font-weight:bold<?php endif; ?>" target="_blank"><?php echo ($news["title"]); ?></a>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<div class="news_showtabs show link_gray6" style="display:none">
			<?php $tag_news_list_class = new \Common\qscmstag\news_listTag(array('列表名'=>'hot_news','显示数目'=>'9','属性'=>'3','cache'=>'0','type'=>'run',));$hot_news = $tag_news_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$hot_news);?>
			<?php if(is_array($hot_news['list'])): $i = 0; $__LIST__ = $hot_news['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$news): $mod = ($i % 2 );++$i;?><div class="tlist substring">
					<span class="<?php if($i <= 3): ?>sort1_3<?php else: ?>sort4_9<?php endif; ?>"><?php echo ($i); ?></span>
					<a href="<?php echo ($news["url"]); ?>" style="<?php if($news['tit_color']): ?>color:<?php echo ($news["tit_color"]); ?>;<?php endif; if($news['tit_b'] > 0): ?>font-weight:bold<?php endif; ?>" target="_blank"><?php echo ($news["title"]); ?></a>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="index_8">
	<div class="ntit">
  	<div class="lt">友情链接</div>
	<div class="clear"></div>
</div>
<div class="links link_gray6">
	<?php $tag_link_class = new \Common\qscmstag\linkTag(array('列表名'=>'links','类型'=>'2','cache'=>'0','type'=>'run',));$links = $tag_link_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$links);?>
	<?php if(is_array($links)): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): $mod = ($i % 2 );++$i;?><div class="imglink"><a href="<?php echo ($link["link_url"]); ?>" target="_blank"><img src="<?php echo attach($link['link_logo'],'link_logo');?>" border="0"/></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
	<div class="clear"></div>
	<!--文字链接 -->
	<?php $tag_link_class = new \Common\qscmstag\linkTag(array('列表名'=>'links','类型'=>'1','cache'=>'0','type'=>'run',));$links = $tag_link_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$links);?>
	<?php if(is_array($links)): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): $mod = ($i % 2 );++$i;?><div class="txtlink substring"><a href="<?php echo ($link["link_url"]); ?>" target="_blank"><?php echo ($link["title"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
	<div class="clear"></div>
	</div>
</div>
<div class="foot_lab_bg">
	<div class="foot_lab">
		<div class="ylist y1">快速入职</div>
		<div class="ylist y2">隐私保护</div>
		<div class="ylist y3">薪资透明</div>
		<div class="ylist y4">信息可靠</div>
		<div class="ylist y5">手机找工作</div>
		<div class="clear"></div>
	</div>
</div>
<div class="foot link_gray9">
	<div class="service">
	<div class="tel"><?php echo C('qscms_bootom_tel');?></div>
	<div class="txt">客服热线(服务时间：09:00-19:00)</div>
</div>
  
  
  <div class="about">
  <div class="atit">关于我们</div>
  <?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','显示数目'=>'4','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"骑士PHP高端人才系统(www.74cms.com)","keywords"=>"骑士人才系统，74cms，骑士cms，人才网站源码，php人才网程序","description"=>"骑士CMS是基于PHP+MYSQL的免费网站管理系统，提供完善的人才招聘网站建设方案","header_title"=>""),$list);?>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a target="_blank" href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?></a><br /><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
 <div class="about last">
  <div class="atit">帮助中心</div>
    <a target="_blank" href="<?php echo url_rewrite('QS_helplist',array('id'=>3));?>">求职指南</a><br />
    <a target="_blank" href="<?php echo url_rewrite('QS_helplist',array('id'=>12));?>">招聘帮助</a><br />
    <a target="_blank" href="<?php echo U('Home/Members/user_getpass');?>">找回密码</a><br />
    <a target="_blank" href="<?php echo url_rewrite('QS_suggest');?>">意见建议</a>
  </div> 
  <div class="about">
	<div class="atit">个人求职</div>
	<a target="_blank" href="<?php echo url_rewrite('QS_jobs');?>">找工作</a><br />
    <a target="_blank" href="<?php echo U('Home/Personal/resume_add');?>">创建简历</a><br />
    <a target="_blank" href="<?php echo url_rewrite('QS_jobslist',array('search_cont'=>'setmeal'));?>">名企招聘</a><br />
    <a target="_blank" href="<?php echo url_rewrite('QS_news');?>">职场资讯</a> 
  </div>
  <div class="about">
	<div class="atit">企业招聘</div>
	<a target="_blank" href="<?php echo url_rewrite('QS_resume');?>">招人才</a><br />
    <a target="_blank" href="<?php echo U('Home/Company/jobs_add');?>">发布职位</a><br />
    <a target="_blank" href="<?php echo url_rewrite('QS_helplist',array('id'=>19));?>">招聘服务</a><br />
    <a target="_blank" href="<?php echo url_rewrite('QS_hrtools');?>">HR工具箱</a> 
  </div>
	 
	
  <div class="code"><img src="<?php echo attach(C('qscms_weixin_img'),'resource');?>"></div>
  <div class="clear"></div>
</div>



<!--
<div class="slide_tip pie_about">
  <div class="imgbg"></div>
  <div class="clear"></div>
  <div class="btnboxs">
  <a class="pie_about" href="<?php echo U('members/reg');?>">免费注册</a>
  <a class="pie_about" href="<?php echo U('members/login');?>" class="login">会员登录</a>
  <div class="closs"></div>
  </div>
</div>
-->


<div class="foottxt link_gray9 font_gray9">
联系地址：<?php echo C('qscms_address');?> 联系电话：<?php echo C('qscms_bootom_tel');?> 网站备案：<?php echo C('qscms_icp');?><br />

<?php echo C('qscms_bottom_other');?><br />

Powered by <a href="http://www.74cms.com">74cms</a> v<?php echo C('QSCMS_VERSION');?> <br />
<?php echo htmlspecialchars_decode(C('qscms_statistics'));?>

</div>
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
<script type="text/javascript">
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
</script>
<div id="popup-captcha"></div>
<script type="text/javascript" src="../public/js/jquery.modal.dialog.js"></script>
<script type="text/javascript" src="../public/js/jquery.tooltip.js"></script>
<script type="text/javascript" src="../public/js/jquery.listitem.js"></script>
<script type="text/javascript" src="../public/js/jquery.dropdown.js"></script>
<script type="text/javascript" src="../public/js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="../public/js/jquery.hoverdir.js"></script>
<!--[if lt IE 9]>
	<script type="text/javascript" src="../public/js/PIE.js"></script>
<![endif]-->
<script src="http://static.geetest.com/static/tools/gt.js"></script>
<script type="text/javascript" src="../public/js/jquery.index.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php if(C('SUBSITE_VAL.s_id') > 0 and $subsite_val['s_map_ak']): echo ($subsite_val["s_map_ak"]); else: echo C('qscms_map_ak'); endif; ?>"></script>
<script type="text/javascript" src="../public/js/jquery.mapjob.js"></script>
<?php if($apply['Subsite']): ?><script id="J-sub-dialog-content" type="text/html">
		<div class="sub-dialog-group">
	        <div class="sdg-title">亲爱的用户您好：</div>
	        <div class="sdg-split-20"></div>
	        <div class="sdg-h-tips">请您切换到对应的地区分站，让我们为您提供更准确的职位信息。</div>
	        <div class="sdg-split-30"></div>
	        <div class="sdg-h-line"></div>
	        <div class="sdg-split-20"></div>
	        <div class="sdg-master-group">
	            <?php if($subsite_org): ?><div class="sdg-txt-left">点击进入</div>
		            <a href="<?php echo U('subsite/set',array('sid'=>$subsite_org['s_id']));?>" class="sdg-go"><?php echo ($subsite_org["s_sitename"]); ?></a>
		            <div class="sdg-txt-right">或者切换到以下城市</div>
	            <?php else: ?>
	            	<div class="sdg-txt-right">切换到以下城市</div><?php endif; ?>
	            <div class="clear"></div>
	        </div>
	        <div class="sdg-split-20"></div>
	        <div class="sdg-sub-city-group">
	        	<?php if(is_array($district)): $i = 0; $__LIST__ = array_slice($district,0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dis): $mod = ($i % 2 );++$i;?><a href="<?php echo U('subsite/set',array('sid'=>$dis['s_id']));?>" class="sdg-sub-city"><?php echo ($dis["s_sitename"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	        	<?php if(count($district) > 11): ?><a href="<?php echo U('subsite/index');?>" class="sdg-sub-city more">更多地区</a><?php endif; ?>
	            <div class="clear"></div>
	        </div>
	        <div class="sdg-split-16"></div>
	        <div class="sdg-bottom-tips">如果您在使用中遇到任何问题，请随时联系 <?php if(C('qscms_top_tel')): echo C('qscms_top_tel'); else: echo C('qscms_bootom_tel'); endif; ?> 寻求帮助</div>
	        <div class="sdg-split-11"></div>
	    </div>
	</script>
	<script type="text/javascript">
	    <?php if(!empty($subsite_org)): ?>showSubDialog();<?php endif; ?>
	    $('#J-choose-subcity').click(function () {
	        showSubDialog();
	    });
	    function showSubDialog() {
	        var qsDialog = $(this).dialog({
	            title: '切换地区',
	            showFooter: false,
	            border: false
	        });
	        qsDialog.setContent($('#J-sub-dialog-content').html());
            $('.sdg-sub-city').each(function (index, value) {
                if ((index + 1) % 4 == 0) {
                    $(this).addClass('no-mr');
                }
            });
	    }
	</script><?php endif; ?>
<script type="text/javascript">
    var qsMapUrl = "<?php echo url_rewrite('QS_jobslist',array('lng'=>'lngVal','lat'=>'latVal','wa'=>3000));?>";
</script>
</body>
</html>