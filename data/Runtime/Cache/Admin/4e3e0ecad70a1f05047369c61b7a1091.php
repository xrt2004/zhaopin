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
	var URL = '/zhaopin42/index.php/admin/index',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=index&amp;a=panel',
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
<span id="version"></span>
<?php if(is_array($message)): $i = 0; $__LIST__ = $message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$message): $mod = ($i % 2 );++$i; if($message['type'] == 'warning'): ?><table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#990000"  style=" margin-bottom:6px; color:#FFFFFF">
    <tr>
      <td bgcolor="#CC0000">&nbsp;<?php echo ($message["content"]); ?></td>
    </tr>
  </table>
  <?php else: ?>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#FF9900"  style=" margin-bottom:6px;">
      <tr>
        <td bgcolor="#FFFFCC">&nbsp;<?php echo ($message["content"]); ?></td>
      </tr>
    </table><?php endif; endforeach; endif; else: echo "" ;endif; ?>
<div class="toptit">今日统计</div>
<table width="900" border="0" cellpadding="0" cellspacing="0" class="link_lan" style="padding-left:15px; line-height:220%; margin-bottom:10px; color:#666666">
      <tr>
        <td width="300"  >新增个人会员：&nbsp;<strong id="personal_users">...</strong></td>
        <td width="300"  >新增简历：&nbsp;<strong id="resumes">...</strong></td>
        <td  >简历刷新次数：&nbsp;<strong id="resume_refresh">...</strong></td>
      </tr>
      <tr>
        <td  >新增企业会员：&nbsp;<strong id="company_users">...</strong></td>
        <td  >新增职位：&nbsp;<strong id="jobs">...</strong></td>
        <td  >简历下载量：&nbsp;<strong id="resume_down">...</strong></td>
      </tr>
      <tr>
        <td  >企业新增订单：&nbsp;<strong id="company_order">...</strong>		  </td>
        <td  >个人新增订单：&nbsp; <strong id="personal_order">...</strong> </td>
		<td  >发出面试邀请：&nbsp;<strong id="interview">...</strong></td>
      </tr>
      <tr>
        <td  >简历投递数：&nbsp;<strong id="jobs_apply">...</strong>      </td>
        <td  >职位刷新数：&nbsp; <strong id="jobs_refresh">...</strong> </td>
        <td></td>
      </tr>
</table>
<div class="toptit">昨日统计</div>
<table width="900" border="0" cellpadding="0" cellspacing="0" class="link_lan" style="padding-left:15px; line-height:220%; margin-bottom:10px; color:#666666">
      <tr>
        <td width="300"  >新增个人会员：&nbsp;<strong id="yesterday_personal_users">...</strong></td>
        <td width="300"  >新增简历：&nbsp;<strong id="yesterday_resumes">...</strong></td>
        <td  >简历刷新次数：&nbsp;<strong id="yesterday_resume_refresh">...</strong></td>
      </tr>
      <tr>
        <td  >新增企业会员：&nbsp;<strong id="yesterday_company_users">...</strong></td>
        <td  >新增职位：&nbsp;<strong id="yesterday_jobs">...</strong></td>
        <td  >简历下载量：&nbsp;<strong id="yesterday_resume_down">...</strong></td>
      </tr>
      <tr>
        <td  >企业新增订单：&nbsp;<strong id="yesterday_company_order">...</strong>     </td>
        <td  >个人新增订单：&nbsp; <strong id="yesterday_personal_order">...</strong> </td>
    <td  >发出面试邀请：&nbsp;<strong id="yesterday_interview">...</strong></td>
      </tr>
      <tr>
        <td  >简历投递数：&nbsp;<strong id="yesterday_jobs_apply">...</strong>      </td>
        <td  >职位刷新数：&nbsp; <strong id="yesterday_jobs_refresh">...</strong> </td>
        <td></td>
      </tr>
</table>
<div class="toptit">待处理事务</div>
<table width="900" border="0" cellpadding="0" cellspacing="0" class="link_lan" style="padding-left:15px; line-height:220%; margin-bottom:10px; color:#666666">
      <tr>
        <td width="300"  >待审核职位：&nbsp;<a href="<?php echo U('jobs/index_noaudit');?>" id="jobs_audit">...</a></td>
        <td width="300"  >待认证企业：&nbsp;<a href="<?php echo U('company/index',array('audit'=>2));?>" id="company_audit">...</a></td>
        <td  >举报信息：&nbsp;<a href="<?php echo U('report/index');?>" id="report">...</a></td>
      </tr>
      <tr>
        <td  >待审核简历：&nbsp;<a href="<?php echo U('personal/index_noaudit');?>" id="resume_audit">...</a></td>
        <td  >待审核简历照片/作品：&nbsp;<a href="<?php echo U('ResumeImg/index',array('audit'=>2));?>" id="resume_img_audit">...</a></td>
        <td  >意见/建议：&nbsp; <a href="<?php echo U('feedback/index');?>" id="feedback">...</a> </td>
      </tr>
     
</table>
 
<div class="toptit">最近30天会员注册趋势</div>
<script language="JavaScript" src="__ADMINPUBLIC__/js/FusionCharts.js"></script>
<div id="chartdiv">FusionCharts. </div>
<script type="text/javascript">
   var chart = new FusionCharts("__ADMINPUBLIC__/js/statement/area2D.swf", "ChartId", "800", "150");
   chart.setDataURL("<?php echo ($charts); ?>");
   chart.render("chartdiv");
</script>
<script type="text/javascript">
		var tsTimeStamp= new Date().getTime();
		$.getJSON("<?php echo U('index/total');?>",function(result){
				for(var i in result.data){
				if(result.data[i]==0)
				{
				 $("#"+i).html(result.data[i]);
				}
				else
				{
				 $("#"+i).html('+'+result.data[i]);
				}
         
        }
		});
</script>
<div class="toptit">骑士cms人才系统</div>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td style=" line-height:220%; color:#666666; padding-left:15px;"><table width="900" border="0" cellpadding="0" cellspacing="0" class="link_lan">
      <tr>
        <td width="300">系统当前版本：v<?php echo C('QSCMS_VERSION');?><span id="update_notice"></span></td>
        <td width="300">认证授权：<span id="certification">载入中...</span>        </td>
        <td>官方论坛：<a href="http://www.74cms.com" target="_blank">www.74cms.com</a></td>
      </tr>
      <tr>
        <td  >程序开发：74CMS程序开发组<br /></td>
        <td  >版权所有：骑士CMS</td>
        <td  >官方论坛：<a href="http://www.74cms.com/bbs" target="_blank">www.74cms.com/bbs/</a></td>
      </tr>
      
    </table></td>
  </tr>
</table>
<div class="toptit">系统信息</div>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td style="  color:#666666; padding-left:15px;line-height:220%;">
	<table width="600" border="0" cellpadding="0" cellspacing="0" class="link_lan">
      <tr>
        <td width="300"  >操作系统：<?php echo ($system_info["server_os"]); ?></td>
        <td  >PHP 版本：<?php echo ($system_info["php_version"]); ?></td>
      </tr>
      <tr>
        <td  >服务器软件：<?php echo ($system_info["web_server"]); ?><br /></td>
        <td  >MySQL 版本：<?php echo ($system_info["mysql_version"]); ?></td>
      </tr>
    </table></td>
  </tr>
</table>
<div class="toptit">官方动态</div>
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td style=" line-height:220%; color:#666666; padding-left:15px;">
	<span id="announcement" class="link_lan">载入中...</span>
	</td>
  </tr>
</table>
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
<script src="http://www.74cms.com/plus/external.php?version=<?php echo ($system_info["version"]); ?>&release=<?php echo ($system_info["release"]); ?>&certification=<?php echo C('qscms_site_domain');?>&announcement=1" language="javascript"></script>
</html>