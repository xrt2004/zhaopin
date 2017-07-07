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
	var URL = '/zhaopin42/index.php/admin/dataclear',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=dataclear&amp;a=index',
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
<div class="toptip link_lan"  >
  <h2>提示：</h2>
  <p>
数据清理可有效提升数据读写效率，从而提升网站的用户体验。站长可根据自身情况，选择定期删除老旧数据</p>
</div>

<div class="toptit">清理内容</div>
 
    <form action="<?php echo U('index');?>" method="post" name="form1" id="form1">
    <table width="800" border="0" cellspacing="6" cellpadding="5" style=" margin-bottom:3px;">
    <tr>
      <td width="120" align="right">清理项目：</td>
        <td>
        <label><input type="checkbox" checked="checked" value="PersonalJobsApply|apply_addtime" name="type[]"/> 职位申请记录</label>
		&nbsp;&nbsp;&nbsp;&nbsp;
        <label><input type="checkbox" value="CompanyInterview|interview_addtime" name="type[]" checked="checked"/> 面试邀请记录</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label><input type="checkbox" value="CompanyDownResume|down_addtime" name="type[]" checked="checked"/> 下载简历记录</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label><input type="checkbox" value="CompanyFavorites|favorites_addtime" name="type[]" checked="checked"/> 收藏简历记录</label>&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
      </tr>
      <tr>
      <td align="right">&nbsp;</td>
        <td>
        <label><input type="checkbox" value="ViewResume|addtime" name="type[]" checked="checked"/> 浏览简历记录</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label><input type="checkbox" value="ViewJobs|addtime" name="type[]" checked="checked"/> 浏览职位记录</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label><input type="checkbox" value="MembersLog|log_addtime" name="type[]" checked="checked"/> 会员日志</label>&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
      </tr>
    <tr>
      <td align="right">选择时间：</td>
      <td  >
        <label><input name="settr" type="radio"  value="360" checked=checked/>一年前</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label><input name="settr" type="radio"  value="180"/>半年前</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label><input name="settr" type="radio"  value="90"/>三个月前</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label><input name="settr" type="radio"  value="60"/>两个月前</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label><input name="settr" type="radio"  value="30"/>一个月前</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
    </tr>
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td> 
      <input name="submit" type="submit" class="admin_submit" value="清除"/>
    </td>
    </tr>
  </table>
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