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
	var URL = '/zhaopin42/index.php/admin/navigation',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=navigation&amp;a=index',
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
			        <?php if(is_array($sub_menu['menu'])): $i = 0; $__LIST__ = $sub_menu['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><a href="<?php echo U($val['module_name'].'/'.$val['controller_name'].'/'.$val['action_name']); echo ($val["data"]); if($isget and $_GET): echo get_first(); endif; if($_GET['_k_v']): ?>&_k_v=<?php echo ($_GET['_k_v']); endif; ?>" class="<?php echo ($val["class"]); ?>"><u><?php echo ($val["name"]); ?></u></a><?php endforeach; endif; else: echo "" ;endif; ?>
				    <div class="clear"></div>
				</div><?php endif; ?>
	        <div class="clear"></div>
	    </div>
    <div class="toptip">
        <h2>提示：</h2>
		<p>
			页面关联标记与导航关联标记相同时(导航关联标记请在页面管理中查看)，与之关联的页面将高亮显示；        例如：在页面管理中，首页的导航关联标记为homepage,在自定义导航中增加网站首页栏目，页面关联标为homepage，那么打开网站首页页面，则此栏目高亮显示。
		</p>
    </div>
    <div class="seltpye_x">
		<div class="left">导航分类</div>	
		<div class="right">
			<?php if(is_array($categroy)): $i = 0; $__LIST__ = $categroy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$categroy): $mod = ($i % 2 );++$i;?><a href="<?php echo P(array('alias'=>$key));?>" <?php if($_REQUEST['alias']== $key): ?>class="select"<?php endif; ?>><?php echo ($categroy); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<form action="<?php echo U('navigation/navAllSave');?>" method="post" enctype="multipart/form-data"  name="FormData" id="FormData" >
		<table width="100%" border="0" cellpadding="0" cellspacing="0"  id="list" class="link_lan">
			<tr>
				<td  class="admin_list_tit  admin_list_first">
					<label id="chkAll"><input type="checkbox" id="chk" title="全选/反选" />名称</label>
				</td>
				<td width="8%"  class="admin_list_tit" >显示</td>
				<td width="15%" align="center" class="admin_list_tit">页面关联标记</td>
				<td width="8%" align="center" class="admin_list_tit">位置</td>
				<td width="15%" align="center" class="admin_list_tit">打开方式</td>
				<td width="8%" align="center" class="admin_list_tit">排序</td>
				<td width="12%" align="center" class="admin_list_tit">编辑</td>
			</tr>
			<?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><tr>
						<td class="admin_list admin_list_first">
							<input type="checkbox" name="id[]" value="<?php echo ($li["id"]); ?>"/>
							<input name="save_id[]" type="hidden" value="<?php echo ($li["id"]); ?>"/>
							<input name="title[]" type="text"  class="input_text_200" id="title" value="<?php echo ($li["title"]); ?>"   />
						</td>
						<td  class="admin_list">
							<?php if($li['display'] == 1): ?><span style="color: #FF3300">显示</span>
							<?php else: ?>
								<span style="color:#999999">不显示</span><?php endif; ?>
						</td>
						<td align="center"    class="admin_list"><?php echo ($li["tag"]); ?>&nbsp;</td>
						<td align="center"   class="admin_list"><?php echo ($li["categoryname"]); ?></td>
						<td align="center"   class="admin_list">
							<?php if($li['target'] == '_blank'): ?>新窗口<?php endif; ?>
							<?php if($li['target'] == '_self'): ?><span style="color:#666666">原窗口</span><?php endif; ?>	
						</td>
						<td align="center"  class="admin_list" >
							<input name="navigationorder[]" type="text"  class="input_text_50" value="<?php echo ($li["navigationorder"]); ?>"   />
						</td>
						<td align="center"  class="admin_list" >
							<a href="<?php echo U('navigation/edit',array('id'=>$li['id'],'url'=>"/zhaopin42/index.php?m=admin&amp;c=navigation&amp;a=index"));?>">修改</a>
							<?php if($li['systemclass'] != 1): ?><a href="<?php echo U('navigation/delete',array('id'=>$li['id']));?>"  onclick="return confirm('你确定要删除吗？')">删除</a><?php endif; ?>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			<?php else: ?>
				<tr>
					<td colspan = " 7 " class="admin_list admin_list_first">
						没有任何信息！
					</td>
				</tr><?php endif; ?>
		</table>
		<table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
			<tr>
				<td>
					<input type="submit" value="保存修改" class="admin_submit"   />
					<input type="button" class="admin_submit" id="add"    value="添加栏目"  onclick="window.location='<?php echo U('navigation/add');?>'"/>
					<input id="ButDel" type="submit" value="删除栏目" class="admin_submit"   />
				</td>
				<td width="305" align="right">		
				</td>
			</tr>
		</table>
	</form>
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
	$("#chk").live('click',function(){
	     $("#list").find("input[type=checkbox]").attr("checked",this.checked);
	});
	$("#ButDel").click(function(){
	    if(confirm('确定删除选中的分类吗？')){
	      $("#FormData").attr("action","<?php echo U('navigation/delete');?>");
	      $("#FormData").submit();
	    }
	});
</script>
</body>
</html>