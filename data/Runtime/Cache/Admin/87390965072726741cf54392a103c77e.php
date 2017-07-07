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
	var URL = '/zhaopin42/index.php/admin/apply',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=apply&amp;a=index',
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
		骑士人才系统核心模块是基础模块，任何周边模块需在核心模块的基础上安装。
		<br />
		卸载应用将会清空与此模块相关的数据，并且不可恢复，请谨慎卸载。
		<br />
		安装更多应用请点击 <a href="http://www.74cms.com" target="_blank">获取更多应用</a>，我们将不断更新更多优秀应用，如果您是开发者，欢迎您上传自己的应用。</p>
	</div>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_lan">
		<tr>
			<td class="admin_list_tit admin_list_first">应用名称</td>
			<td width="240" align="center" colspan="2" class="admin_list_tit">当前版本号</td>
			<td width="140" align="center" class="admin_list_tit">安装时间</td>
			<td width="120" align="center" class="admin_list_tit">操作</td>
		</tr>
		<tr class="J_mod" m="<?php echo ($base["module"]); ?>" v="<?php echo ($base["version"]["version"]); ?>">
			<td class="admin_list admin_list_first apply_list">
				<a class="ico" href="<?php echo U('apply/details',array('mod'=>$base['module']));?>">
					<img src="<?php echo ($base["ico"]); ?>">
				</a>
				<div class="info">
					<p><a class="title" href="<?php echo U('apply/details',array('mod'=>$base['module']));?>"><?php echo ($base["version"]["module_name"]); ?></a>（<?php echo ($base["module"]); ?>）</p>
					<p><?php echo ($base["version"]["explain"]); ?></p>
				</div>
			</td>
			<td align="right" class="admin_list apply_list">
				<p>版本号：</p>
				<p>更新时间：</p>
			</td>
			<td align="left" class="admin_list apply_list">
				<p class="J_v"><?php echo ($base["version"]["version"]); ?></p>
				<p class="J_t"><?php echo ($base["version"]["update_time"]); ?></p>
			</td>
			<td align="center" class="admin_list"><?php echo date("Y-m-d H:i",$base['setup_time']);?></td>
			<td align="center" class="admin_list">
				<?php if($Think.APP_UPDATER): ?><a class="J_updater" href="<?php echo U('apply/updater',array('mod'=>$base['module']));?>" >升级</a>
					&nbsp;<?php endif; ?>
				<a href="<?php echo U('apply/details',array('mod'=>$base['module']));?>" >详情</a>
			</td>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr class="J_mod" m="<?php echo ($list["module"]); ?>" v="<?php echo ($list["version"]["version"]); ?>">
				<td class="admin_list admin_list_first apply_list">
					<a class="ico" href="<?php echo U('apply/details',array('mod'=>$list['module']));?>">
						<img src="<?php echo ($list["ico"]); ?>">
					</a>
					<div class="info">
						<p><a class="title" href="<?php echo U('apply/details',array('mod'=>$list['module']));?>"><?php echo ($list["version"]["module_name"]); ?></a>（<?php echo ($list["module"]); ?>）</p>
						<p><?php echo ($list["version"]["explain"]); ?></p>
					</div>
				</td>
				<td align="right" class="admin_list apply_list">
					<p>版本号：</p>
					<p>更新时间：</p>
				</td>
				<td align="left" class="admin_list apply_list">
					<p class="J_v"><?php echo ($list["version"]["version"]); ?></p>
					<p class="J_t"><?php echo ($list["version"]["update_time"]); ?></p>
				</td>
				<td align="center" class="admin_list"><?php if($list['is_setup'] != 0): echo date("Y-m-d H:i",$list['setup_time']); else: ?>未安装<?php endif; ?></td>
				<td align="center" class="admin_list">
					<?php if($list['is_setup'] != 0): ?><a href="<?php echo U('apply/unload',array('mod'=>$list['module']));?>" >卸载</a>
					<?php else: ?>
						<a href="<?php echo U('apply/setup',array('mod'=>$list['module']));?>" >安装</a><?php endif; ?>
					&nbsp;
					<?php if($Think.APP_UPDATER): if($apply[$list['module']]): ?><a class="J_updater" href="<?php echo U('apply/updater',array('mod'=>$list['module']));?>" >升级</a>
						<?php else: ?>
							升级<?php endif; ?>
						&nbsp;<?php endif; ?>
					<a href="<?php echo U('apply/details',array('mod'=>$list['module']));?>" >详情</a>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<div class="qspage"><?php echo ($page); ?></div>
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
	function callback(a){
		$.each(a.data,function(k,v){
			var version = $('.J_mod[m="'+k+'"]').attr('v'),h='';
			if(v.version){
				if(version != v.version){
					v.update_time = v.update_time ? v.update_time : '未发布';
					$('.J_mod[m="'+k+'"] .J_v').append('<a href="http://www.74cms.com/app/list-1.html" target="_blank" class="newsv">有新版</a>');
					$('.J_mod[m="'+k+'"] .J_t').html(v.update_time);
				}else{
					$('.J_mod[m="'+k+'"] .J_updater').replaceWith('升级');
				}
			}
		});
	}
</script>
<script src="http://www.74cms.com/plus/check_module.php?module_name=<?php echo ($module_name); ?>" language="javascript"></script>
</body>
</html>