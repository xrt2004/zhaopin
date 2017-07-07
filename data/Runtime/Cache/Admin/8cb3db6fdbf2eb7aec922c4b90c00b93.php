<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=7">
	<link rel="shortcut icon" href="<?php echo C('qscms_site_dir');?>favicon.ico" />
	<title> Powered by 74CMS</title>
	<link href="__ADMINPUBLIC__/css/common.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".admin_top_nav>a").click(function(){
				$(".admin_top_nav>a").removeClass("select");
				$(this).addClass("select");
				$(this).blur();
				window.parent.frames["leftFrame"].location.href =  "<?php echo U('Index/left_menu');?>&menuid="+$(this).attr('data-id');
			});
		});
	</script>
</head>
<body>
	<div class="admin_top_bg">
		<table width="1400" height="70" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="200" rowspan="2" align="right" valign="middle" ><div align="center"><img src="__ADMINPUBLIC__/images/logo_in.png" width="160" height="25" /></div>
				</td>
				<td height="39" align="right" valign="middle" class="link_w">
					欢迎<?php echo ($admin_rank); ?>：<strong style="color: #99FF00"><?php echo ($visitor["username"]); ?></strong>&nbsp; 登录&nbsp;&nbsp;&nbsp;&nbsp;  <a href="<?php echo U('index/logout');?>" target="_top">[退出]</a>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo C('qscms_site_domain'); echo C('qscms_site_dir');?>" target="_blank">网站首页</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.74cms.com/bbs/" target="_blank">官方论坛</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.74cms.com/" target="_blank">官方网站</a>
				</td>
			</tr>
			<tr>
				<td height="31" valign="bottom" class="admin_top_nav">
					<a href="<?php echo U('index/panel');?>" class="select" target="mainFrame" id="index" data-id="0">首页</a>
					<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><a href="<?php echo U($menu['module_name'].'/'.$menu['controller_name'].'/'.$menu['action_name'],array('menuid'=>$menu['id'],'child'=>1)); echo ($menu["data"]); ?>" target="mainFrame" data-id="<?php echo ($menu["id"]); ?>" title="<?php echo ($menu["name"]); ?>" <?php if($menu['stat']): ?>stat="<?php echo ($menu["stat"]); ?>"<?php endif; ?>><?php echo ($menu["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="clear"></div>
			  </td>
			</tr>
		</table>
	</div>
</body>
<script type="text/javascript">
	function refresh_affair(){
		var affair = $('.admin_top_bg a[stat]').map(function(){
				return $(this).attr('stat');
			}).get();
		$.post("<?php echo U('Ajax/affair');?>",{affair:affair},function(result){
			if(result.status == 1){
				result.data = result.data || {};
				$('.admin_top_bg a[stat]').each(function(){
					var h = result.data[$(this).attr('stat')];
					h = h ? '<div class="count"></div>' : '';
					$(this).html($(this).attr('title')+h);
				});
			}
		},'json');
	}
	refresh_affair();
</script>
</html>