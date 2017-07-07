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
	<link href="../public/css/common_ajax_dialog.css" rel="stylesheet" type="text/css" />
	<link href="../public/css/resume.css" rel="stylesheet" type="text/css" />
	<script src="../public/js/jquery.common.js" type="text/javascript" language="javascript"></script>
	<?php $tag_load_class = new \Common\qscmstag\loadTag(array('type'=>'category','search'=>'1','cache'=>'0','列表名'=>'list',));$list = $tag_load_class->category();?>
	<?php if(C('SUBSITE_VAL.s_id') > 0 and !$_GET['citycategory']): $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'city','类型'=>'QS_citycategory','地区分类'=>$subsite_val['s_district'],'显示数目'=>'100','cache'=>'0','type'=>'run',));$city = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$city);?>
	<?php else: ?>
		<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'city','类型'=>'QS_citycategory','地区分类'=>$_GET['citycategory'],'显示数目'=>'100','cache'=>'0','type'=>'run',));$city = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$city); endif; ?>
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
<div class="alltop_nav" id="nav">
	<div class="tnav">
  		<div class="tlogo"><a href="/zhaopin42/"><img src="<?php if(C('qscms_logo_other')): echo attach(C('qscms_logo_other'),'resource'); else: ?>__HOMEPUBLIC__/images/logo_other.png<?php endif; ?>" border="0"/></a></div>
		<div class="tl">
			<ul class="link_gray6 nowrap">
				<?php $tag_nav_class = new \Common\qscmstag\navTag(array('列表名'=>'nav','调用名称'=>'QS_top','显示数目'=>'10','cache'=>'0','type'=>'run',));$nav = $tag_nav_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$nav);?>
				<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li class="nli J_hoverbut <?php if(MODULE_NAME == C('DEFAULT_MODULE')): if($nav['tag'] == strtolower(CONTROLLER_NAME)): ?>select<?php endif; else: if($nav['tag'] == strtolower(MODULE_NAME)): ?>select<?php endif; endif; ?>"><a href="<?php echo ($nav['url']); ?>" target="<?php echo ($nav["target"]); ?>"><?php echo ($nav["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="tr"></div>
		<div class="clear"></div>
	</div>
</div>
<!--搜索 -->
<div class="page_so">
	<div class="sobox">
		<div class="selecttype">
		<?php if(C('qscms_resumesearch_key_first_choice') == 1): ?><div class="J_sli sli <?php if($_GET['search_type']== 'precise' or $_GET['search_type']== ''): ?>select<?php endif; ?>" data-type="precise">精准</div>
			<div class="J_sli sli <?php if($_GET['search_type']== 'full'): ?>select<?php endif; ?>" data-type="full">全文</div>
		<?php else: ?>
		<div class="J_sli sli <?php if($_GET['search_type']== 'full' or $_GET['search_type']== ''): ?>select<?php endif; ?>" data-type="full">全文</div>
		<div class="J_sli sli <?php if($_GET['search_type']== 'precise'): ?>select<?php endif; ?>" data-type="precise">精准</div><?php endif; ?>
		<div class="clear"></div>
		</div>
		<div class="inputbg">
			<div id="showSearchModal" title="" class="selecttype J_hoverbut" data-title="请选择地区" data-multiple="false" data-maxnum="0" data-width="520">选择地区</div>
			<form id="ajax_search_location" action="<?php echo U('ajaxCommon/ajax_search_location',array('type'=>'QS_resumelist'));?>" method="get">
				<div class="inoputbox">
					<input name="key" type="text" data-original="<?php echo (urldecode(urldecode($_GET['key']))); ?>" value="<?php echo (urldecode(urldecode($_GET['key']))); ?>" placeholder="请输入关键字" />
					<input type="hidden" name="search_type" value="<?php echo ($_GET['search_type']); ?>" />
					<input id="searchCityModalCode" type="hidden" name="citycategory" value="<?php echo ($city['select']['citycategory']); ?>" />
					<input id="recoverSearchCityModalCode" type="hidden" name="" value="" />
					<input class="J_forclear" type="hidden" name="jobcategory" value="<?php if(C('qscms_resumesearch_key_open_jobcategory') == 1): echo ($_GET['jobcategory']); endif; ?>" />
					<input class="J_forclear" type="hidden" name="resumetag" value="<?php echo ($_GET['resumetag']); ?>" />
					<input class="J_forclear" type="hidden" name="experience" value="<?php echo ($_GET['experience']); ?>" />
					<input class="J_forclear" type="hidden" name="sex" value="<?php echo ($_GET['sex']); ?>" />
					<input class="J_forclear" type="hidden" name="age" value="<?php echo ($_GET['age']); ?>" />
					<input class="J_forclear" type="hidden" name="trade" value="<?php echo ($_GET['trade']); ?>" />
					<input class="J_forclear" type="hidden" name="major" value="<?php echo ($_GET['major']); ?>" />
					<input class="J_forclear" type="hidden" name="education" value="<?php echo ($_GET['education']); ?>" />
					<input class="J_forclear" type="hidden" name="nature" value="<?php echo ($_GET['nature']); ?>" />
					<input class="J_forclear" type="hidden" name="wage" value="<?php echo ($_GET['wage']); ?>" />
					<input class="J_forclear" type="hidden" name="settr" value="<?php echo ($_GET['settr']); ?>" />
				</div>
				<input type="submit" class="sobut J_hoverbut" value="搜索" />
			</form>
		</div>
		<div class="righttxt link_gray6"><a href="<?php echo url_rewrite('QS_resume');?>">分类搜索</a></div>
		<div class="clear"></div>
	</div>
    <div class="hotword link_gray9 font_gray9 nowrap">
    	您是不是想找：
    	<?php $tag_hotword_class = new \Common\qscmstag\hotwordTag(array('列表名'=>'hotword_list','显示数目'=>'5','cache'=>'0','type'=>'run',));$hotword_list = $tag_hotword_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$hotword_list);?>
    	<?php if(is_array($hotword_list)): $i = 0; $__LIST__ = $hotword_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotword): $mod = ($i % 2 );++$i; if(C('qscms_key_urlencode') == 1): ?><a href="<?php echo url_rewrite('QS_resumelist',array('key'=>urlencode($hotword['w_word_code']),'search_type'=>$_GET['search_type']));?>"><?php echo ($hotword["w_word"]); ?></a>
			<?php else: ?>
			<a href="<?php echo url_rewrite('QS_resumelist',array('key'=>$hotword['w_word_code'],'search_type'=>$_GET['search_type']));?>"><?php echo ($hotword["w_word"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </div>
	<div class="so_condition_show">
		<div class="J_showbtn showbtn unfold none">打开筛选</div> 
		<div class="J_showbtn showbtn">收起筛选</div>
		<div class="clear"></div>
	</div>
</div>
<div class="so_condition J_so_condition">
	<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'jobsCate','类型'=>'QS_jobs','cache'=>'0','type'=>'run',));$jobsCate = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$jobsCate);?>
	<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'jobs_cate_info','类型'=>'QS_jobs_info','cache'=>'0','type'=>'run',));$jobs_cate_info = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$jobs_cate_info);?>
	<?php if(C('qscms_resumesearch_key_open_jobcategory') == 1): ?><div class="lefttit">职位分类</div>
		<?php if($_GET['jobcategory']== '' or C('qscms_category_jobs_level') == 2): ?><div class="rs">
				<div class="J_jobConditions">
					<div class="wli <?php if(empty($_GET['jobcategory'])): ?>select<?php endif; ?>"><a href="<?php echo P(array('jobcategory'=>''));?>">全部</a></div>
					<?php if(is_array($jobsCate[0])): $i = 0; $__LIST__ = $jobsCate[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$scate): $mod = ($i % 2 );++$i; if(is_array($jobsCate[$key])): $i = 0; $__LIST__ = $jobsCate[$key];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><div class="wli <?php if(($cate['spell']) == $_GET['jobcategory']): ?>select<?php endif; ?>"><a href="<?php echo P(array('jobcategory'=>$cate['spell']));?>"><?php echo ($cate["categoryname"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
					<div class="clear"></div>
				</div>
			</div>
			<div class="more">
				<div class="J_showJobConditions mbtn close">收起</div>
				<div class="J_showJobConditions mbtn none">更多</div>
			</div>
		<?php else: ?>
			<div class="rs_classify">
				<div class="wli_y" onclick="window.location='<?php echo P(array('jobcategory'=>''));?>';">
					<?php if(!empty($jobsCate[$jobs_cate_info['spell'][$_GET['jobcategory']]['id']])): echo ($jobs_cate_info['spell'][$_GET['jobcategory']]['categoryname']); ?>
						<?php $category = $jobs_cate_info['spell'][$_GET['jobcategory']]['id']; ?>
					<?php else: ?>
						<?php echo ($jobs_cate_info['id'][$jobs_cate_info['spell'][$_GET['jobcategory']]['parentid']]['categoryname']); ?>
						<?php $category = $jobs_cate_info['spell'][$_GET['jobcategory']]['parentid']; endif; ?>
				</div>
				<div class="clear"></div>
		        <div class="showclassify">
					<div class="toparrow"></div>
					<div class="wli <?php if(($jobs_cate_info['spell'][$_GET['jobcategory']]['id']) == $category): ?>select<?php endif; ?>">
						<a href="<?php echo P(array('jobcategory'=>$jobs_cate_info['id'][$category]['spell']));?>">全部</a>
					</div>
					<?php if(is_array($jobsCate[$category])): $i = 0; $__LIST__ = $jobsCate[$category];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><div class="wli <?php if(($cate['spell']) == $_GET['jobcategory']): ?>select<?php endif; ?>">
							<a href="<?php echo P(array('jobcategory'=>$cate['spell']));?>"><?php echo ($cate["categoryname"]); ?></a>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="clear"></div>
				</div>
			</div><?php endif; ?>
		<div class="clear"></div><?php endif; ?>
	<?php if($_GET['citycategory']!= ''): if(!empty($city['list'])): ?><div class="lefttit">地标地段</div>
			<div class="rs">
				<div class="li <?php if($city['parent']['id'] == $city['select']['id']): ?>select<?php endif; ?>"><a href="<?php echo P(array('citycategory'=>$city['parent']['citycategory']));?>">不限</a></div>
				<?php if(is_array($city['list'])): $i = 0; $__LIST__ = $city['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$district): $mod = ($i % 2 );++$i;?><div class="li <?php if($city['select']['id'] == $key): ?>select<?php endif; ?>"><a href="<?php echo P(array('citycategory'=>$district['citycategory']));?>"><?php echo ($district['categoryname']); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div><?php endif; endif; ?>
	<div class="lefttit">工作经验</div>
	<div class="rs">
		<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'experience_list','类型'=>'QS_experience','显示数目'=>'100','cache'=>'0','type'=>'run',));$experience_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$experience_list);?>
		<div class="li <?php if($_GET['experience']== ''): ?>select<?php endif; ?>"><a href="<?php echo P(array('experience'=>''));?>">不限</a></div>
		<?php if(is_array($experience_list)): $i = 0; $__LIST__ = $experience_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$experience): $mod = ($i % 2 );++$i;?><div class="li <?php if($_GET['experience']== $key): ?>select<?php endif; ?>"><a href="<?php echo P(array('experience'=>$key));?>"><?php echo ($experience); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	 
	<div class="lefttit">简历标签</div>
	<div class="rs">
		<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'tag_list','类型'=>'QS_resumetag','显示数目'=>'100','cache'=>'0','type'=>'run',));$tag_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$tag_list);?>
		<div class="li <?php if($_GET['resumetag']== ''): ?>select<?php endif; ?>"><a href="<?php echo P(array('resumetag'=>''));?>">不限</a></div>
		<?php if(is_array($tag_list)): $i = 0; $__LIST__ = $tag_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><div class="li <?php if($_GET['resumetag']== $key): ?>select<?php endif; ?>"><a href="<?php echo P(array('resumetag'=>$key));?>"><?php echo ($tag); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>

	<div class="lefttit">更多筛选</div>
	<div class="rs">
		<div class="bli J_dropdown">
			<span class="txt">性别</span>
			<div class="dropdowbox1 J_dropdown_menu">
	            <div class="dropdow_inner1">
	                <ul class="nav_box">
	                	<li><a class="<?php if($_GET['sex']== 1): ?>select<?php endif; ?>" href="<?php echo P(array('sex'=>1));?>" data-code="1">男</a></li>
	                	<li><a class="<?php if($_GET['sex']== 2): ?>select<?php endif; ?>" href="<?php echo P(array('sex'=>2));?>" data-code="2">女</a></li>
	                </ul>
	            </div>
	        </div>
			<div class="clear"></div>
		</div>
		
		<div class="bli J_dropdown">
			<span>年龄</span>
			<div class="dropdowbox1 J_dropdown_menu">
	            <div class="dropdow_inner1">
	                <ul class="nav_box">
	                	<li><a class="<?php if($_GET['age']== 24): ?>select<?php endif; ?>" href="<?php echo P(array('age'=>''));?>">全部</a></li>
	                	<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'age_list','类型'=>'QS_age','cache'=>'0','type'=>'run',));$age_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$age_list);?>
	                	<?php if(is_array($age_list)): $i = 0; $__LIST__ = $age_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$age): $mod = ($i % 2 );++$i;?><li><a class="<?php if($_GET['age']== $key): ?>select<?php endif; ?>" href="<?php echo P(array('age'=>$key));?>"><?php echo ($age); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	                </ul>
	            </div>
	        </div>
			<div class="clear"></div>
		</div>
		<div class="bli J_dropdown">
			<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'trade_list','类型'=>'QS_trade','显示数目'=>'100','cache'=>'0','type'=>'run',));$trade_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$trade_list);?>
			<span class="txt" title="<?php echo ((isset($trade_list[$_GET['trade']]) && ($trade_list[$_GET['trade']] !== ""))?($trade_list[$_GET['trade']]):'行业类别'); ?>"><?php echo ((isset($trade_list[$_GET['trade']]) && ($trade_list[$_GET['trade']] !== ""))?($trade_list[$_GET['trade']]):'行业类别'); ?></span>
			<div class="dropdowbox2 J_dropdown_menu">
	            <div class="dropdow_inner2">
	                <ul class="nav_box">
	                	<?php if(is_array($trade_list)): $i = 0; $__LIST__ = $trade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$trade): $mod = ($i % 2 );++$i;?><li><a class="<?php if($_GET['trade']== $key): ?>select<?php endif; ?>" href="<?php echo P(array('trade'=>$key));?>" data-code="<?php echo ($key); ?>"><?php echo ($trade); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
						<div class="clear"></div>
	                </ul>
	            </div>
	        </div>
			<div class="clear"></div>
		</div>
		<div class="bli J_dropdown">
			<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'major_list','类型'=>'QS_major','显示数目'=>'100','cache'=>'0','type'=>'run',));$major_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$major_list);?>
			<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'major_info','类型'=>'QS_major_info','id'=>$_GET['major'],'cache'=>'0','type'=>'run',));$major_info = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$major_info);?>
			<span class="txt" title="<?php echo ((isset($major_list[$_GET['major']]) && ($major_list[$_GET['major']] !== ""))?($major_list[$_GET['major']]):'所学专业'); ?>"><?php echo ((isset($major_list[$_GET['major']]) && ($major_list[$_GET['major']] !== ""))?($major_list[$_GET['major']]):'所学专业'); ?></span>
			<div class="dropdowbox3 J_dropdown_menu">
	            <div class="dropdow_inner3">
	                <ul class="nav_box">
						<div class="tabnav">
							<?php if(is_array($major_list[0])): $i = 0; $__LIST__ = $major_list[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$major): $mod = ($i % 2 );++$i;?><div class="tab_list <?php if($major_info['parentid'] == $key): ?>select<?php endif; ?>"><?php echo ($major); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
                            <div class="clear"></div>
                        </div>
                        <?php if(is_array($major_list[0])): $i = 0; $__LIST__ = $major_list[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$smajor): $mod = ($i % 2 );++$i;?><div class="tab_content" data-code="<?php echo ($key); ?>">
	                            <?php if(is_array($major_list[$key])): $i = 0; $__LIST__ = $major_list[$key];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$major): $mod = ($i % 2 );++$i;?><div class="content_list">
	                                <li><a class="<?php if($_GET['major']== $key): ?>select<?php endif; ?>" href="<?php echo P(array('major'=>$key));?>" data-code="<?php echo ($key); ?>"><?php echo ($major); ?></a></li>
	                                </div><?php endforeach; endif; else: echo "" ;endif; ?>
	                            <div class="clear"></div>
	                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
	                </ul>
	            </div>
	        </div>
			<div class="clear"></div>
		</div>
		<div class="bli J_dropdown">
			<span>学历要求</span>
			<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'education_list','类型'=>'QS_education','显示数目'=>'100','cache'=>'0','type'=>'run',));$education_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$education_list);?>
			<div class="dropdowbox1 J_dropdown_menu">
	            <div class="dropdow_inner1">
	                <ul class="nav_box">
	                	<?php if(is_array($education_list)): $i = 0; $__LIST__ = $education_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$education): $mod = ($i % 2 );++$i;?><li><a class="<?php if($_GET['education']== $key): ?>select<?php endif; ?>" href="<?php echo P(array('education'=>$key));?>" data-code="<?php echo ($key); ?>"><?php echo ($education); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	                </ul>
	            </div>
	        </div>
			<div class="clear"></div>
		</div>
		<div class="bli J_dropdown">
			<span>工作性质</span>
			<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'nature_list','类型'=>'QS_jobs_nature','显示数目'=>'100','cache'=>'0','type'=>'run',));$nature_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$nature_list);?>
			<div class="dropdowbox1 J_dropdown_menu">
	            <div class="dropdow_inner1">
	                <ul class="nav_box">
	                	<?php if(is_array($nature_list)): $i = 0; $__LIST__ = $nature_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nature): $mod = ($i % 2 );++$i;?><li><a class="<?php if($_GET['nature']== $key): ?>select<?php endif; ?>" href="<?php echo P(array('nature'=>$key));?>" data-code="<?php echo ($key); ?>"><?php echo ($nature); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	                </ul>
	            </div>
	        </div>
			<div class="clear"></div>
		</div>
		<div class="bli J_dropdown">
			<span class="txt">期望薪资</span>
			<?php $tag_classify_class = new \Common\qscmstag\classifyTag(array('列表名'=>'wage_list','类型'=>'QS_wage','显示数目'=>'100','cache'=>'0','type'=>'run',));$wage_list = $tag_classify_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$wage_list);?>
			<div class="dropdowbox4 J_dropdown_menu">
	            <div class="dropdow_inner4">
	                <ul class="nav_box">
	                	<?php if(is_array($wage_list)): $i = 0; $__LIST__ = $wage_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$wage): $mod = ($i % 2 );++$i;?><li><a class="<?php if($_GET['wage']== $key): ?>select<?php endif; ?>" href="<?php echo P(array('wage'=>$key));?>" data-code="<?php echo ($key); ?>"><?php echo ($wage); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	                </ul>
	            </div>
	        </div>
			<div class="clear"></div>
		</div>
		<div class="bli J_dropdown">
			<span>更新时间</span>
			<div class="dropdowbox1 J_dropdown_menu">
	            <div class="dropdow_inner1">
	                <ul class="nav_box">
	                	<li><a class="<?php if($_GET['settr']== 3): ?>select<?php endif; ?>" href="<?php echo P(array('settr'=>3));?>" data-code="3">3天内</a></li>
	                	<li><a class="<?php if($_GET['settr']== 7): ?>select<?php endif; ?>" href="<?php echo P(array('settr'=>7));?>" data-code="7">7天内</a></li>
	                	<li><a class="<?php if($_GET['settr']== 15): ?>select<?php endif; ?>" href="<?php echo P(array('settr'=>15));?>" data-code="15">15天内</a></li>
	                	<li><a class="<?php if($_GET['settr']== 30): ?>select<?php endif; ?>" href="<?php echo P(array('settr'=>30));?>" data-code="30">30天内</a></li>
	                </ul>
	            </div>
	        </div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>

	<!--已选条件，当没有条件的时候不显示下面的DIV -->
	<?php if($_GET): ?><div class="selected J_selected">
			<div class="stit">已选条件</div>
		    <div class="sc">
		    	<?php if($_GET['key']!= ''): ?><div class="slist" onclick="window.location='<?php echo P(array('key'=>''));?>';"><span>关键字：</span><?php echo (urldecode(urldecode($_GET['key']))); ?></div><?php endif; ?>
				<?php if($_GET['jobcategory']!= ''): ?><div class="slist" onclick="window.location='<?php echo P(array('jobcategory'=>''));?>';">
						<span>职位分类：</span>
						<?php echo ($jobs_cate_info['spell'][$_GET['jobcategory']]['categoryname']); ?>
					</div><?php endif; ?>
				<?php if($_GET['citycategory']!= ''): ?><div class="slist" onclick="window.location='<?php echo P(array('citycategory'=>''));?>';">
						<span>地区类别：</span>
						<?php echo ($city['select']['categoryname']); ?>
					</div><?php endif; ?>
				<?php if($_GET['resumetag']!= ''): ?><div class="slist" onclick="window.location='<?php echo P(array('resumetag'=>''));?>';"><span>简历标签：</span><?php echo ($tag_list[$_GET['resumetag']]); ?></div><?php endif; ?>
				<?php if($_GET['experience']!= ''): ?><div class="slist" onclick="window.location='<?php echo P(array('experience'=>''));?>';"><span>工作经验：</span><?php echo ($experience_list[$_GET['experience']]); ?></div><?php endif; ?>
				<?php if(!empty($_GET['sex'])): ?><div class="slist" onclick="window.location='<?php echo P(array('sex'=>''));?>';">
						<span>性别：</span>
						<?php if($_GET['sex']== 1): ?>男<?php else: ?>女<?php endif; ?>
					</div><?php endif; ?>
				<?php if($_GET['age']!= ''): ?><div class="slist" onclick="window.location='<?php echo P(array('age'=>''));?>';"><span>年龄：</span><?php echo ($age_list[$_GET['age']]); ?></div><?php endif; ?>
				<?php if($_GET['trade']!= ''): ?><div class="slist" onclick="window.location='<?php echo P(array('trade'=>''));?>';">
						<span>行业类别：</span>
						<?php echo ($trade_list[$_GET['trade']]); ?>
					</div><?php endif; ?>
				<?php if($_GET['major']!= ''): ?><div class="slist" onclick="window.location='<?php echo P(array('major'=>''));?>';"><span>所学专业：</span><?php echo ($major_info['categoryname']); ?></div><?php endif; ?>
				<?php if($_GET['education']!= ''): ?><div class="slist" onclick="window.location='<?php echo P(array('education'=>''));?>';"><span>学历要求：</span><?php echo ($education_list[$_GET['education']]); ?></div><?php endif; ?>
				<?php if($_GET['nature']!= ''): ?><div class="slist" onclick="window.location='<?php echo P(array('nature'=>''));?>';"><span>工作性质：</span><?php echo ($nature_list[$_GET['nature']]); ?></div><?php endif; ?>
				<?php if($_GET['wage']!= ''): ?><div class="slist" onclick="window.location='<?php echo P(array('wage'=>''));?>';"><span>期望薪资：</span><?php echo ($wage_list[$_GET['wage']]); ?></div><?php endif; ?>
				<?php if($_GET['settr']!= ''): ?><div class="slist" onclick="window.location='<?php echo P(array('settr'=>''));?>';">
						<span>更新时间：</span>
						<?php switch($_GET['settr']): case "3": ?>3天内<?php break;?>
							<?php case "7": ?>7天内<?php break;?>
							<?php case "15": ?>15天内<?php break;?>
							<?php case "30": ?>30天内<?php break; endswitch;?>
					</div><?php endif; ?>
				<div class="clear"></div>
			</div>
			<div class="sr">
				<div class="empty" onclick="window.location='<?php echo url_rewrite('QS_resumelist');?>';">清空</div>
			</div>
			<div class="clear"></div>
		</div><?php endif; ?>
</div>
<?php $tag_resume_list_class = new \Common\qscmstag\resume_listTag(array('列表名'=>'resumelist','搜索类型'=>$_GET['search_type'],'显示数目'=>'15','分页显示'=>'1','关键字'=>$_GET['key'],'职位分类'=>$_GET['jobcategory'],'地区分类'=>$_GET['citycategory'],'日期范围'=>$_GET['settr'],'学历'=>$_GET['education'],'工作经验'=>$_GET['experience'],'工资'=>$_GET['wage'],'工作性质'=>$_GET['nature'],'标签'=>$_GET['resumetag'],'手机认证'=>$_GET['mobile_audit'],'照片'=>$_GET['photo'],'所学专业'=>$_GET['major'],'行业'=>$_GET['trade'],'年龄'=>$_GET['age'],'性别'=>$_GET['sex'],'特长描述长度'=>'100','排序'=>$_GET['sort'],'cache'=>'0','type'=>'run',));$resumelist = $tag_resume_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$resumelist);?>
<div class="plist">
	<div class="pl">
			<div class="toptitle">
			<div class="ltype">
				<div class="typeli <?php if($_GET['sort']== ''): ?>select<?php endif; ?>" onclick="window.location='<?php echo P(array('sort'=>''));?>';">综合排序</div>
				<div class="typeli <?php if($_GET['sort']== 'rtime'): ?>select<?php endif; ?>" onclick="window.location='<?php echo P(array('sort'=>'rtime'));?>';">更新时间</div>
				<div class="clear"></div>
				<?php if($search_type == 'full'): ?><div class="typeli <?php if($_GET['sort']== 'score'): ?>select<?php endif; ?>" onclick="window.location='<?php echo P(array('sort'=>'rtime'));?>';">相关度</div><?php endif; ?>
				<div class="clear"></div>
			</div>
			<div class="ts">
				<div class="l1"></div>
				<div class="l2 <?php if($_GET['photo']== 1): ?>select<?php endif; ?>" <?php if($_GET['photo']== 1): ?>onclick="window.location='<?php echo P(array('photo'=>''));?>';"<?php else: ?>onclick="window.location='<?php echo P(array('photo'=>1));?>';"<?php endif; ?>>
					<div class="radiobox"></div>
					<div class="radiotxt">有照片</div>
					<div class="clear"></div>
				</div>
				<div class="l2 <?php if($_GET['mobile_audit']== 1): ?>select<?php endif; ?>" <?php if($_GET['mobile_audit']== 1): ?>onclick="window.location='<?php echo P(array('mobile_audit'=>''));?>';"<?php else: ?>onclick="window.location='<?php echo P(array('mobile_audit'=>1));?>';"<?php endif; ?>>
					<div class="radiobox"></div>
					<div class="radiotxt">手机已认证</div>
					<div class="clear"></div>
				</div>
				<div class="J_detailList l3 <?php if($_COOKIE['resume_show_type']== ''): ?>select<?php endif; ?>" title="切换到详细列表"></div>
				<div class="J_detailList l4 <?php if($_COOKIE['resume_show_type']== 1): ?>select<?php endif; ?>" title="切换到简易列表" show_type="1"></div>
				<div class="l5">
					<?php if($resumelist['page_params']['nowPage'] > 1): ?><div class="prev" title="上一页" onclick="window.location='<?php echo P(array('p'=>$resumelist['page_params']['nowPage']-1));?>';"><</div><?php endif; ?>
				  	<?php if($resumelist['page_params']['nowPage'] < $resumelist['page_params']['totalPages']): ?><div class="next"  title="下一页" onclick="window.location='<?php echo P(array('p'=>$resumelist['page_params']['nowPage']+1));?>';">></div><?php endif; ?>
					<?php if($resumelist['page_params']['totalRows'] > 0): ?><span><?php echo ($resumelist["page_params"]["nowPage"]); ?></span>/<?php echo ($resumelist["page_params"]["totalPages"]); ?>页<?php endif; ?>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="listb J_allListBox">
			<?php if(!empty($resumelist['list'])): if(is_array($resumelist['list'])): $i = 0; $__LIST__ = $resumelist['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$resume): $mod = ($i % 2 );++$i;?><div class="J_resumeList yli" data-rid="<?php echo ($resume["id"]); ?>">
					<div class="td1"><div class="J_allList radiobox"></div></div>
					<div class="td2 link_blue substring link_visited"><a href="<?php echo ($resume["resume_url"]); ?>" target="_blank"><?php echo ($resume["fullname"]); ?></a><?php if($resume['strong_tag']): ?><span><?php echo ($resume['strong_tag']); ?></span><?php endif; ?></div>
					<div class="td3 substring"><?php echo ($resume["sex_cn"]); ?><span>|</span><?php echo ($resume["age"]); ?>岁<span>|</span><?php echo ($resume["education_cn"]); ?><span>|</span><?php echo ($resume["experience_cn"]); ?></div>
					<div class="td4 substring"><?php echo ($resume["intention_jobs"]); ?></div>
					<div class="td5 substring"><?php echo ($resume["district_cn"]); ?></div>
					<div class="td6"><?php if($resume['stick'] == 1 && !$_GET['sort']): ?><img src="../public/images/stick.png"><?php else: echo ($resume['refreshtime_cn']); endif; ?></div>
					<div class="td7"><div class="J_resumeStatus hide <?php if($_COOKIE['resume_show_type']== 1): ?>show<?php endif; ?>"></div></div>
					<div class="clear"></div>
					<div class="detail" <?php if($_COOKIE['resume_show_type']== 1): ?>style="display:none"<?php endif; ?>>
						<div class="ltx">
			   				<div class="photo"><img src="<?php echo ($resume["photosrc"]); ?>" border="0"/></div>
						    <div class="tcent">
								<div class="txt font_gray6"><?php echo ($resume["nature_cn"]); if($resume['major_cn']): ?><span>|</span>专业：<?php echo ($resume["major_cn"]); endif; ?><span>|</span><?php echo ($resume["wage_cn"]); ?><span>|</span><?php echo ($resume["current_cn"]); ?></div>
								<div class="dlabs">
								<?php if($resume['tag_cn'] || $resume['specialty']): if(empty($resume['tag_cn'])): echo ($resume["specialty"]); ?>
									<?php else: ?>
										<?php if(is_array($resume['tag_cn'])): $i = 0; $__LIST__ = $resume['tag_cn'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><div class="dl"><?php echo ($tag); ?></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
								<?php else: ?>
									该简历没有填写自我描述<?php endif; ?>
									<div class="clear"></div>
								</div>
			       			</div>
							<div class="clear"></div> 
						</div>
						<div class="rbtn">
							<div class="deliver J_downResume" data-batch="false" data-url="<?php echo U('CompanyService/resume_download',array('to_detail'=>1));?>">下载简历</div>
							<div class="favorites J_collectForResume" data-batch="false" data-url="<?php echo U('AjaxCompany/resume_favor');?>">收藏</div>
						</div>
						<div class="clear"></div>
					</div>	
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<div class="listbtn">
				<div class="td1"><div class="radiobox J_allSelected"></div></div>
				<div class="td2">
					<div class="lbts J_collectForResume" data-batch="true" data-url="<?php echo U('AjaxCompany/resume_favor');?>">收藏简历</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="qspage"><?php echo ($resumelist["page"]); ?></div>
			<?php else: ?>
			<div class="list_empty_group">
				<div class="list_empty">
					<div class="list_empty_left"></div>
					<div class="list_empty_right">
						<div class="sorry_box">对不起，没有找到符合您条件的简历！</div>
						<div class="stips_box">放宽您的查找条件也许有更多合适您的简历哦~</div>
					</div>
					<div class="clear"></div>
				</div>
			</div><?php endif; ?>
		</div>
		<?php if($_GET['citycategory']!= ''): ?><div class="bot_info link_gray6">
				<div class="topnavbg">
					<div class="topnav">
						<?php if($_GET['key'] != '' or $_GET['jobcategory'] != ''): ?><div class="tl J_resume_hotnear select">周边人才</div><?php endif; ?>
						<div class="tl J_resume_hotnear">热门人才</div>
						<div class="clear"></div>
					</div>
				</div>
				<?php if($_GET['key'] != ''): ?><div class="showbotinfo J_resume_hotnear_show show">
			        	<?php if(is_array($city['list'])): $i = 0; $__LIST__ = array_slice($city['list'],0,21,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$district): $mod = ($i % 2 );++$i;?><div class="ili"><a href="<?php echo P(array('citycategory'=>$district['citycategory'],'key'=>$_GET['key']));?>"><?php echo ($district["categoryname"]); echo (urldecode(urldecode($_GET['key']))); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<div class="clear"></div>
					</div>
				<?php elseif($_GET['jobcategory'] != ''): ?>
					<div class="showbotinfo J_resume_hotnear_show show">
			        	<?php if(is_array($city['list'])): $i = 0; $__LIST__ = array_slice($city['list'],0,21,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$district): $mod = ($i % 2 );++$i;?><div class="ili"><a href="<?php echo P(array('citycategory'=>$district['citycategory'],'jobcategory'=>$_GET['jobcategory']));?>"><?php echo ($district["categoryname"]); echo ($jobs_cate_info[$_GET['jobcategory']]['categoryname']); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
						<div class="clear"></div>
					</div><?php endif; ?>
				<div class="showbotinfo J_resume_hotnear_show">
					<?php $tag_hotword_class = new \Common\qscmstag\hotwordTag(array('列表名'=>'hotword_list','显示数目'=>'22','cache'=>'0','type'=>'run',));$hotword_list = $tag_hotword_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$hotword_list);?>
					<?php if(is_array($hotword_list)): $i = 0; $__LIST__ = $hotword_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotword): $mod = ($i % 2 );++$i; if(C('qscms_key_urlencode') == 1): ?><div class="ili"><a href="<?php echo P(array('citycategory'=>$city['select']['citycategory'],'key'=>urlencode($hotword['w_word_code'])));?>"><?php echo ($city['select']['categoryname']); echo ($hotword["w_word"]); ?></a></div>
						<?php else: ?>
						<div class="ili"><a href="<?php echo P(array('citycategory'=>$city['select']['citycategory'],'key'=>$hotword['w_word_code']));?>"><?php echo ($city['select']['categoryname']); echo ($hotword["w_word"]); ?></a></div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					<div class="clear"></div>
				</div>
			</div><?php endif; ?>
	</div>
	<div class="clear"></div>
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
  <?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','显示数目'=>'4','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"简历列表  - {site_name}","keywords"=>"","description"=>"","header_title"=>""),$list);?>
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
<script type="text/javascript" src="../public/js/jquery.resumelist.js"></script>
<script type="text/javascript" src="../public/js/jquery.modal.dialog.js"></script>
<script type="text/javascript" src="../public/js/jquery.modal.search.js"></script>
<script type="text/javascript" src="../public/js/jquery.dropdown.js"></script>
<script type="text/javascript" src="../public/js/jquery.listitem.js"></script>
<script type="text/javascript" src="../public/js/jquery.highlight-3.js"></script>
<script src="http://static.geetest.com/static/tools/gt.js"></script>
<script type="text/javascript">
	var city_select = <?php echo json_encode($city['select']);?>;
	var city_parent = <?php echo json_encode($city['parent']);?>;
	
	if (city_parent) {
		if (app_spell) {
			$('#showSearchModal').text(city_parent['categoryname']);
			$('#recoverSearchCityModalCode').val(city_parent['spell']);
		} else {
			$('#showSearchModal').text(city_parent['categoryname']);
			$('#recoverSearchCityModalCode').val(city_parent['citycategory']);
		}
	} else if(city_select) {
		if (app_spell) {
			$('#showSearchModal').text(city_select['categoryname']);
			$('#recoverSearchCityModalCode').val(city_select['spell']);
		} else {
			$('#showSearchModal').text(city_select['categoryname']);
			$('#recoverSearchCityModalCode').val(city_select['citycategory']);
		}
	}
	

	if ($('.J_selected .slist').length) {
		$('.J_selected').show();
	}

	$('.J_jobConditions .wli').each(function(index, el) {
		if (index > 6) {
			$(this).addClass('for_up');
		};
	});

	// 关键字高亮
	var keyWords = $('input[name="key"]').val();
	if (keyWords.length) {
		$('.J_resumeList').highlight(keyWords);
	}
</script>
</body>
</html>