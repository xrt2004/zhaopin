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
	<link href="../public/css/news.css" rel="stylesheet" type="text/css" />
	<script src="../public/js/jquery.common.js" type="text/javascript" language="javascript"></script>
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
				<?php $tag_nav_class = new \Common\qscmstag\navTag(array('列表名'=>'nav','调用名称'=>'QS_top','显示数目'=>'10','cache'=>'0','type'=>'run',));$nav = $tag_nav_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"新闻资讯","keywords"=>"","description"=>"","header_title"=>""),$nav);?>
				<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li class="nli J_hoverbut <?php if(MODULE_NAME == C('DEFAULT_MODULE')): if($nav['tag'] == strtolower(CONTROLLER_NAME)): ?>select<?php endif; else: if($nav['tag'] == strtolower(MODULE_NAME)): ?>select<?php endif; endif; ?>"><a href="<?php echo ($nav['url']); ?>" target="<?php echo ($nav["target"]); ?>"><?php echo ($nav["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="tr"></div>
		<div class="clear"></div>
	</div>
</div>
<div class="news">
  <div class="l">
  		<?php $tag_ad_class = new \Common\qscmstag\adTag(array('列表名'=>'ad','广告位名称'=>'QS_news_index_top','广告数量'=>'1','cache'=>'0','type'=>'run',));$ad = $tag_ad_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"新闻资讯","keywords"=>"","description"=>"","header_title"=>""),$ad);?>
  		<?php if(is_array($ad['list'])): $i = 0; $__LIST__ = $ad['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad_info): $mod = ($i % 2 );++$i;?><div class="newsbanner">
				<a href="<?php echo ($ad_info["href"]); ?>" title="<?php echo ($ad_info["title"]); ?>">
					<img class="lazy" data-original="<?php echo attach($ad_info['content'],'ads');?>" src="../public/images/transparent.gif" border="0">
				</a>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		<?php $tag_news_category_class = new \Common\qscmstag\news_categoryTag(array('列表名'=>'category','显示数目'=>'8','资讯大类'=>'1','cache'=>'0','type'=>'run',));$category = $tag_news_category_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"新闻资讯","keywords"=>"","description"=>"","header_title"=>""),$category);?>
        <div class="newsnav">
        <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a target="_blank" href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title_']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
		<div class="clear"></div>
	</div>
        <div class="newslist">
		    <div class="tit"></div>
		    <?php $tag_news_list_class = new \Common\qscmstag\news_listTag(array('列表名'=>'list','显示数目'=>'5','填补字符'=>'…','摘要长度'=>'160','cache'=>'0','type'=>'run',));$list = $tag_news_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"新闻资讯","keywords"=>"","description"=>"","header_title"=>""),$list);?>
		    <div id="news_list">
		    <?php if(is_array($list['list'])): $i = 0; $__LIST__ = $list['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="listb">
	  			<div class="bl">
				    <div class="pic"><img src="<?php echo ($vo['img']); ?>" border="0"/></div>
				</div>
				<div class="br link_gray6">
			  		<div class="t substring"><a target="_blank" href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?></a></div>
		            <div class="time substring"><?php echo date('Y-m-d',$vo['addtime']); if($vo['author']): ?>&nbsp;/&nbsp;作者：<?php echo ($vo['author']); endif; if($vo['source']): ?>&nbsp;/&nbsp;来源：<?php echo ($vo['source']); endif; ?></div>
		            <div class="summary"><?php echo ($vo['briefly']); ?></div>
				</div>
				<div class="clear"></div>
		    </div><?php endforeach; endif; else: echo "" ;endif; ?>
		    </div>
		  <!-- -->
		  <div class="more" page="1">查看更多</div>
        </div>
  </div>
  
  <div class="r">
  	<div class="newsso">
		<form id="form" action="<?php echo U('ajaxCommon/ajax_search_location',array('type'=>'QS_newslist'));?>">
			<input name="key" type="text" class="soinpu" value=""/>
			<input type="submit" value="" id="so_btn" class="btn"/>
		</form>
	</div>
	<?php $tag_news_list_class = new \Common\qscmstag\news_listTag(array('列表名'=>'hot_list','显示数目'=>'5','属性'=>'3','cache'=>'0','type'=>'run',));$hot_list = $tag_news_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"新闻资讯","keywords"=>"","description"=>"","header_title"=>""),$hot_list);?>
	<?php if(!empty($hot_list['list'])): ?><div class="listbox">
			<div class="ntit"><div class="tlh">热门资讯</div></div>
			<ul class="link_gray6">
			<?php if(is_array($hot_list['list'])): $i = 0; $__LIST__ = $hot_list['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a target="_blank" href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div><?php endif; ?>

	<?php $tag_ad_class = new \Common\qscmstag\adTag(array('列表名'=>'ad','广告位名称'=>'QS_news_right','广告数量'=>'2','cache'=>'0','type'=>'run',));$ad = $tag_ad_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"新闻资讯","keywords"=>"","description"=>"","header_title"=>""),$ad);?>
	<?php if(is_array($ad['list'])): $i = 0; $__LIST__ = $ad['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ad_info): $mod = ($i % 2 );++$i;?><div class="ad313_165">
	    	<a href="<?php echo ($ad_info["href"]); ?>" title="<?php echo ($ad_info["title"]); ?>">
				<img class="lazy" data-original="<?php echo attach($ad_info['content'],'ads');?>" src="../public/images/transparent.gif" border="0">
			</a>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	
	<?php $tag_news_list_class = new \Common\qscmstag\news_listTag(array('列表名'=>'recommend_list','显示数目'=>'5','属性'=>'4','cache'=>'0','type'=>'run',));$recommend_list = $tag_news_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"新闻资讯","keywords"=>"","description"=>"","header_title"=>""),$recommend_list);?>
	<?php if(!empty($recommend_list['list'])): ?><div class="listbox">
			<div class="ntit"><div class="tlh">推荐资讯</div></div>
			<ul class="link_gray6">
			<?php if(is_array($recommend_list['list'])): $i = 0; $__LIST__ = $recommend_list['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a target="_blank" href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div><?php endif; ?>
  </div>
  <div class="clear"></div>
</div>
<div class="footer_min" id="footer">
	<div class="links link_gray6">
	<a target="_blank" href="<?php echo url_rewrite('QS_index');?>">网站首页</a>   
	<?php $tag_explain_list_class = new \Common\qscmstag\explain_listTag(array('列表名'=>'list','cache'=>'0','type'=>'run',));$list = $tag_explain_list_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"新闻资讯","keywords"=>"","description"=>"","header_title"=>""),$list);?>
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
<script type="text/javascript" src="../public/js/jquery.lazyload.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".more").click(function(){
			var page = $(this).attr('page');
			$.getJSON("<?php echo U('ajax_new_article_list');?>",{page:page},function(result){
				if(result.status==1){
					$("#news_list").append(result.data);
					$(".more").attr('page',parseInt(page)+1);
				}else{
					$(".more").html('没有更多最新资讯了');
				}
			});
		});

		// 广告位图片延迟加载
		$("img.lazy").lazyload({
	        effect : "fadeIn"
	    });
		$('#form').submit(function(){
			var data = $('#form').serialize();
			if(qscms.keyUrlencode==1){
				data = encodeURI(data);
			}
			$.post($('#form').attr('action'),data,function(result){
				window.location=result.data;
			},'json');
			return false;
		});
	});
</script>
</body>
</html>