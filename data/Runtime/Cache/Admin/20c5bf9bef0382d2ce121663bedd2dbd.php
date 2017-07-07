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
	var URL = '/zhaopin42/index.php/admin/admin_role',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=admin_role&amp;a=auth&amp;id=1',
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
    <script type="text/javascript">
    $(document).ready(function()
    {
        $("#selectAll").click(function()
        {   
            $("form :checkbox").attr("checked",true);
            setbg();
        });
        $("#uncheckAll").click(function()
        {   
            $("form :checkbox").attr("checked",false);
            setbg();
        });
        $("#opposite").click(function()
        {   
            $("form :checkbox").each(function()
            {
            $(this).attr("checked")?$(this).attr("checked",false):$(this).attr("checked",true);
            });
            setbg();
        }); 
    });
    </script>
    <div class="toptip">
        <h2>提示：</h2>
        <p>通过管理员角色设置，您可以进行编辑管理员角色权限以及删除管理员角色等操作；</p>
    </div>
    <div class="toptit">修改管理员角色
    <span style="color: #FF3300">(<?php echo ($role["name"]); ?>)</span>
          &nbsp;&nbsp;&nbsp;
          <span id="selectAll" style="color:#0066CC; cursor:pointer">[全选]</span>
          &nbsp;&nbsp;&nbsp;
          <span id="uncheckAll" style="color:#0066CC; cursor:pointer">[全不选]</span>
          &nbsp;&nbsp;&nbsp;
          <span id="opposite" style="color:#0066CC; cursor:pointer">[反选]</span>
    </div>
    <form id="form1" name="form1" method="post" action="<?php echo U('AdminRole/auth');?>">
        <?php if($_GET['id']!= 1): if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$parent): $mod = ($i % 2 );++$i;?><table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
                    <tr>
                        <td height="25" bgcolor="#FFFFFF" style=" border-bottom:1px #CCCCCC dashed; padding-left:20px;"><strong><?php echo ($parent["name"]); ?>：</strong></td>
                    </tr>
                    <tr>
                        <td  bgcolor="#FFFFFF" style="  padding-left:14px;">
                            <ul style="margin:0px; padding:3px; list-style:none">       
                                <?php if(is_array($auth_group[$parent['id']])): $i = 0; $__LIST__ = $auth_group[$parent['id']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><li  class="user_box_li user_box_li_new_length">
                                        <label>
                                            <?php if($group['msid'] == 0): ?><input name="group_id[]" type="checkbox"  value="<?php echo ($group["id"]); ?>" <?php if(in_array($group['id'],$role['groups'])): ?>checked="checked"<?php endif; ?>/><?php echo ($group["name"]); ?>
                                            <?php else: ?>
                                                <input name="group_msid[]" type="checkbox"  value="<?php echo ($group["msid"]); ?>" <?php if(in_array($group['msid'],$role['mids'])): ?>checked="checked"<?php endif; ?>/><?php echo ($group["name"]); endif; ?>
                                        </label>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                <li class="clear" style="list-style:none; display:none"></li>
                            </ul>   
                        </td>
                    </tr>
                </table><?php endforeach; endif; else: echo "" ;endif; ?>
            <table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo ($role["id"]); ?>"></input>
                        <input name="ButSave" type="submit" class="admin_submit" id="ButSave" value="提交"/>
                        <input name="ButADD" type="button" class="admin_submit" id="ButADD" value="返回" <?php if($_GET['url']!= ''): ?>onclick="window.location='<?php echo ($_GET['url']); ?>'"<?php else: ?>onclick="window.location='<?php echo U('AdminRole/index');?>'"<?php endif; ?>/>
                    </td>
                    <td width="305" align="right"></td>
                </tr>
            </table>
        <?php else: ?>
            <div  style="color:#009900; padding:24px;">系统超级管理员权限不允许修改！</div>
            <table width="100%" border="0" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF"  >
                <tr>
                    <td bgcolor="#FFFFFF"  style="padding-left:24px;" > 
                        <input name="ButADD" type="button" class="admin_submit" id="ButADD" value="返回" <?php if($_GET['url']!= ''): ?>onclick="window.location='<?php echo ($_GET['url']); ?>'"<?php else: ?>onclick="window.location='<?php echo U('AdminRole/index');?>'"<?php endif; ?>/>
                    </td>
                </tr>
            </table><?php endif; ?>
    </form>
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
</body>
</html>