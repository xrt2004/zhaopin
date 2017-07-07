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
	var URL = '/zhaopin42/index.php/admin/page',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=page&amp;a=index',
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
<div class="toptip link_g">
  <h2>提示：</h2>
  <p>
你可以通过全选来设置所有页面的链接方式和缓存时间<br />
        职位列表页，人才列表页，会员中心页面均不能开启缓存
    <br />系统内内置页面无法删除！
    <br />强烈建议开启页面缓存，缓存让系统性能显著提高！<br />
骑士人才系统支持多种URL样式，无论您是<strong>asp , aspx , jsp ，shtml , ......</strong>程序都可以完美转换为骑士系统，且URL可以保持不变，具体请咨询<a href="http://www.74cms.com" target="_blank">骑士客服</a>
</p>
</div>
  <?php if(!empty($apply['Subsite'])): ?><div class="seltpye_x">
      <div class="left">所属分站</div>
      <?php $tag_subsite_class = new \Common\qscmstag\subsiteTag(array('列表名'=>'subsite_list','cache'=>'0','type'=>'run',));$subsite_list = $tag_subsite_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"","keywords"=>"","description"=>"","header_title"=>""),$subsite_list);?>
      <div class="right">
        <?php if($visitor['role_id'] == 1): if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i;?><a href="<?php echo P(array('subsite_id'=>$subsite['s_id']));?>" <?php if($_GET['subsite_id']== $subsite['s_id'] or ($_GET['subsite_id']== 0 and $subsite['s_id'] == 0)): ?>class="select"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php else: ?>
          <?php if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i; if(in_array($subsite['s_id'],$visitor['subsite'])): ?><a href="<?php echo P(array('subsite_id'=>$subsite['s_id']));?>" <?php if($_GET['subsite_id']== $subsite['s_id']): ?>class="select"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
  </div><?php endif; ?>
  <form action="<?php echo U('set_url');?>" method="post"  name="form1" id="form1">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="link_lan"   id="list">
     <tr>
      <td   class="admin_list_tit admin_list_first">
      <label id="chkAll"><input type="checkbox" name="chkAll"  id="chk" title="全选/反选" />页面名称</label>
    </td>
      <td class="admin_list_tit"> 调用名 </td>
      <td   align="center" class="admin_list_tit">类型</td>
      <td   align="center"  class="admin_list_tit">链接</td>
      <td   align="center"   class="admin_list_tit">缓存</td>
      <td width="130" align="center"  class="admin_list_tit" >编辑</td>
    </tr>
   <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td class="admin_list admin_list_first">  
    <input type="checkbox" name="id[]" value="<?php echo ($vo['id']); ?>"/>   
   <?php echo ($vo['pname']); ?>
    </td>
      <td class="admin_list"> 
    <?php echo ($vo['alias']); ?>    </td>
      <td   align="center" class="admin_list">
      <?php if($vo['systemclass'] == 1): ?><span style="color: #FF6600">系统内置</span>
    <?php else: ?>
    自定义页面<?php endif; ?>
    </td>
      <td   align="center"  class="admin_list">
     <?php if($vo['url'] == 0): ?>原始链接<?php endif; ?>
     <?php if($vo['url'] == 1): ?>伪静态<?php endif; ?>
    </td>
      <td   align="center"   class="admin_list">
    <?php if($vo['caching'] == 0): ?><span style="color:#999999">已关闭</span>
    <?php else: ?>
    <em><?php echo ($vo['caching']); ?></em> 分<?php endif; ?>
    </td>
      <td   align="center"  class="admin_list" >
    <a href="<?php echo U('edit',array('id'=>$vo['id']));?>">修改</a><?php if($vo['systemclass'] != 1): ?>&nbsp;&nbsp;<a href="<?php echo U('delete',array('id'=>$vo['id']));?>" onclick="return confirm('你确定要删除吗？')">删除</a><?php endif; ?>
    </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table> 
    <table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
      <tr>
        <td>
<input name="add" type="button" class="admin_submit" id="add" value="添加页面"  onclick="window.location='<?php echo U('add');?>'"/>
<input type="button" name="open" value="设置链接" class="admin_submit"  id="SetUrl"/>
<input type="button" name="open1" value="设置缓存" class="admin_submit"  id="SetCaching"/>
<input type="button" name="ButDel" id="ButDel" value="删除页面" class="admin_submit"   />
    </td>
        <td width="305" align="right">
    
      </td>
      </tr>
  </table>
  <span id="OpUrl"></span>
  <span id="OpCaching"></span>
   </form>
<div class="qspage"><?php echo ($page); ?></div>
</div>
  <!--弹出层的内容-->
<div id="UrlHtml" style="display: none" >
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="6" >
    <tr>
      <td width="20" height="30">&nbsp;</td>
      <td height="30"><strong  style="color:#0066CC; font-size:14px;">将所选页面链接设置为：</strong></td>
    </tr>
        <tr>
      <td height="25">&nbsp;</td>
      <td>
    <label >
                      <input name="url" type="radio" value="0" checked="checked"  />
                      原始链接 </label>   </td>
    </tr>
    <tr>
      <td height="25">&nbsp;</td>
      <td><label >
                      <input type="radio" name="url" value="1"  />
                      伪静态</label></td>
    </tr>

    <tr>
      <td height="25">&nbsp;</td>
      <td><input type="submit" name="set_url" id="set_url" value="确定" class="admin_submit"    /></td>
      </tr>
  </table>
</div>
<!--弹出层的内容结束--> 
<div id="CachingHtml" style="display: none" >
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="6" >
    <tr>
      <td height="30">&nbsp;</td>
      <td height="30"><strong  style="color:#0066CC; font-size:14px;">将所选页面缓存设置为：</strong></td>
    </tr>
        <tr>
      <td width="20" height="25">&nbsp;</td>
      <td>
   <input name="caching" type="text"  class="input_text_200" id="caching" value="0" maxlength="30"/>

            分钟 <br /><br />

      <span style="color:#666666">(0为不缓存,建议设为180 以上) </span></td>
    </tr>
 
        <tr>
          <td height="25">&nbsp;</td>
          <td><input type="button" name="set_caching" id="set_caching" value="确定" class="admin_submit"></td>
    </tr>
  </table>
</div>
<!--弹出层的内容结束-->
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
$(document).ready(function()
{
  $("#SetUrl").QSdialog({
  DialogAddObj:"#OpUrl",
  DialogTitle:"请选择",
  DialogContent:"#UrlHtml",
  DialogContentType:"id"
  });
  $("#SetCaching").QSdialog({
  DialogAddObj:"#OpCaching",
  DialogTitle:"请选择",
  DialogContent:"#CachingHtml",
  DialogContentType:"id" 
  }); 
  //点击批量删除  
  $("#ButDel").click(function(){
    if (confirm('你确定要删除吗？'))
    {
      $("form[name=form1]").attr("action","<?php echo U('delete');?>");
      $("form[name=form1]").submit()
    }
  });
  $("#set_caching").live('click',function(){
      $("form[name=form1]").attr("action","<?php echo U('set_caching');?>");
      $("form[name=form1]").submit()
  });
    
});
</script>
</body>
</html>