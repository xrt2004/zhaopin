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
	var URL = '/zhaopin42/index.php/admin/members_log',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=members_log&amp;a=index',
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
		<p>系统将会自动清除一个月前的会员日志。</p>
	</div>
	<div class="seltpye_y">
		<div class="tit link_lan">
			<strong><?php echo ($sub_menu["pageheader"]); ?></strong>
			<span>(共找到<?php echo ($total); ?>条)</span>
			<a href="<?php echo U('MembersLog/index');?>">[恢复默认]</a>
			<div class="pli link_bk">
				<u>每页显示：</u>
				<a href="<?php echo P(array('pagesize'=>10));?>" <?php if($pagesize == 10): ?>class="select"<?php endif; ?>>10</a>
				<a href="<?php echo P(array('pagesize'=>20));?>" <?php if($pagesize == 20): ?>class="select"<?php endif; ?>>20</a>
				<a href="<?php echo P(array('pagesize'=>30));?>" <?php if($pagesize == 30): ?>class="select"<?php endif; ?>>30</a>
				<a href="<?php echo P(array('pagesize'=>60));?>" <?php if($pagesize == 60): ?>class="select"<?php endif; ?>>60</a>
				<div class="clear"></div>
			</div>
		</div>	
		<?php if(!empty($apply['Subsite'])): ?><div class="list" >
	      <div class="t">所属分站</div>
	      <?php $tag_subsite_class = new \Common\qscmstag\subsiteTag(array('列表名'=>'subsite_list','cache'=>'0','type'=>'run',));$subsite_list = $tag_subsite_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"","keywords"=>"","description"=>"","header_title"=>""),$subsite_list);?>
	      <div class="txt link_lan">
	        <a href="<?php echo P(array('subsite_id'=>''));?>" <?php if($_GET['subsite_id']== ''): ?>class="select"<?php endif; ?>>不限</a>
	        <?php if($visitor['role_id'] == 1): if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i;?><a href="<?php echo P(array('subsite_id'=>$subsite['s_id']));?>" <?php if($_GET['subsite_id']== $subsite['s_id']): ?>class="select"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
	        <?php else: ?>
	          <?php if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i; if(in_array($subsite['s_id'],$visitor['subsite'])): ?><a href="<?php echo P(array('subsite_id'=>$subsite['s_id']));?>" <?php if($_GET['subsite_id']== $subsite['s_id']): ?>class="select"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
	      </div>
	    </div><?php endif; ?>
		<div class="list">
			<div class="t">日志类型</div>	  
			<div class="txt link_lan">
				<a href="<?php echo P(array('log_utype'=>''));?>" <?php if($_GET['log_utype']== ''): ?>class="select"<?php endif; ?>>不限</a>
				<a href="<?php echo P(array('log_utype'=>1));?>" <?php if($_GET['log_utype']== 1): ?>class="select"<?php endif; ?>>企业会员</a>
				<a href="<?php echo P(array('log_utype'=>2));?>" <?php if($_GET['log_utype']== 2): ?>class="select"<?php endif; ?>>个人会员</a>
			</div>
		</div>
		<div class="list">
			<div class="t">创建时间</div>	  
			<div class="txt link_lan">
				<a href="<?php echo P(array('settr'=>''));?>" <?php if($_GET['settr']== ''): ?>class="select"<?php endif; ?>>不限</a>
				<a href="<?php echo P(array('settr'=>3));?>" <?php if($_GET['settr']== 3): ?>class="select"<?php endif; ?>>三天内</a>
				<a href="<?php echo P(array('settr'=>7));?>" <?php if($_GET['settr']== 7): ?>class="select"<?php endif; ?>>一周内</a>
				<a href="<?php echo P(array('settr'=>30));?>" <?php if($_GET['settr']== 30): ?>class="select"<?php endif; ?>>一月内</a>
				<a href="<?php echo P(array('settr'=>180));?>" <?php if($_GET['settr']== 180): ?>class="select"<?php endif; ?>>半年内</a>
				<a href="<?php echo P(array('settr'=>360));?>" <?php if($_GET['settr']== 360): ?>class="select"<?php endif; ?>>一年内</a>
			</div>
		</div>
		<div class="list">
			<div class="t">日志类型</div>	  
			<div class="txt link_lan">
				<a href="<?php echo P(array('log_type'=>''));?>" <?php if($_GET['log_type']== ''): ?>class="select"<?php endif; ?>>不限</a>
				<?php if(is_array($type_arr)): $i = 0; $__LIST__ = $type_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo P(array('log_type'=>$key));?>" <?php if($_GET['log_type']== $key): ?>class="select"<?php endif; ?>><?php echo ($vo['type']); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
    	</div>
		<div class="clear"></div>
	</div>
	<form id="form1" name="form1" method="post" action="<?php echo U('MembersLog/delete');?>">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_lan">
			<tr>
			<td height="26"  class="admin_list_tit admin_list_first"  width="200">
			<label id="chkAll"><input type="checkbox" name=" " title="全选/反选" id="chk"/>会员名</label></td>
			<td width="100" align="center" class="admin_list_tit">类型</td>
			<td width="13%" align="center" class="admin_list_tit">创建时间</td>
			<td width="10%" align="center" class="admin_list_tit"> IP </td>
			<td width="10%" align="center" class="admin_list_tit"> 地址 </td>
			<td class="admin_list_tit" >描述</td>
			</tr>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td  class="admin_list admin_list_first">
				<input name="log_id[]" type="checkbox" id="id" value="<?php echo ($vo["log_id"]); ?>"/>
				<?php echo ($vo["log_username"]); ?><span style="color: #CCCCCC">[uid:<?php echo ($vo["log_uid"]); ?>]</span>
				</td>
				<td  class="admin_list" align="center">
				<?php switch($vo['log_utype']): case "1": ?>企业会员<?php break;?>
					<?php case "2": ?>个人会员<?php break; endswitch;?>
				</td>
				<td class="admin_list" align="center"><?php echo admin_date($vo['log_addtime']);?></td>
				<td class="admin_list" align="center"><?php echo ((isset($vo["log_ip"]) && ($vo["log_ip"] !== ""))?($vo["log_ip"]):'&nbsp;'); ?></td>
				<td class="admin_list" align="center"><?php echo ((isset($vo["log_address"]) && ($vo["log_address"] !== ""))?($vo["log_address"]):'&nbsp;'); ?></td>
				<td class="admin_list vtip" title="<?php echo ($vo["log_value"]); ?>"><?php echo ($vo["log_value"]); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		<?php if(empty($list)): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
		<span id="OpPi"></span>
	</form>
	<table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
		<tr>
	        <td>
			</td>
	        <td width="305" align="right">
				<form id="formseh" name="formseh" method="get" action="">	
					<div class="seh">
					    <div class="keybox">
					    	<input name="key" type="text"   value="<?php echo ($_GET['key']); ?>" />
					    </div>
					    <div class="selbox">
							<input id="key_type_cn" type="text" value="<?php echo ((isset($_GET['key_type_cn']) && ($_GET['key_type_cn'] !== ""))?($_GET['key_type_cn']):"会员名"); ?>" readonly="true"/>
							<div>
								<input name="key_type" id="key_type" type="hidden" value="<?php echo ((isset($_GET['key_type']) && ($_GET['key_type'] !== ""))?($_GET['key_type']):1); ?>" />
								<div id="sehmenu" class="seh_menu">
									<ul>
										<li id="1" title="会员名">会员名</li>
										<li id="2" title="UID">UID</li>
									</ul>
								</div>
							</div>				
						</div>
						<div class="sbtbox">
							<input type="hidden" name="m" value="<?php echo C('admin_alias');?>">
	                        <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
	                        <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
							<input type="submit" class="sbt" id="sbt" value="搜索"/>
						</div>
						<div class="clear"></div>
					</div>
				</form>
		    </td>
	    </tr>
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
	$(document).ready(function(){
		//点击批量取消	
		$("#ButDel").click(function(){
			if (confirm('你确定要删除吗？')){
				$("form[name=form1]").submit()
			}
		});
		//纵向列表排序
		$(".list .txt").each(function(i){
			var li=$(this).children(".select");
			var htm="<a href=\""+li.attr("href")+"\" class=\""+li.attr("class")+"\">"+li.text()+"</a>";
			li.detach();
			$(this).prepend(htm);
		});
		showmenu("#key_type_cn","#sehmenu","#key_type");
	});
</script>
</body>
</html>