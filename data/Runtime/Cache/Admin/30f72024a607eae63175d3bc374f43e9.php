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
	var URL = '/zhaopin42/index.php/admin/mailconfig',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=mailconfig&amp;a=rule',
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
	  <p>过多的项目设置邮件通知会消耗系统资源。<br />
	  </p>
	</div>
	<div class="toptit">邮件发送规则</div>
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
       <tr>
        <td height="30" style="font-size:12px;padding-left:20px;">
    <form action="<?php echo U('mailconfig/rule');?>" method="post"   name="form1" id="form1">
    <table width="700" border="0" cellspacing="7" cellpadding="1" style=" margin-bottom:3px;" class="link_lan">
            <tr>
              <td width="137" align="right">注册会员：</td>
              <td width="150">
        <label>
                <input name="set_reg" type="radio" value="1" <?php if($info['set_reg'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="set_reg" value="0" <?php if($info['set_reg'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(注册会员成功后发送邮件通知)</td>
            </tr>
            <tr>
              <td align="right">申请职位：</td>
              <td>
         <label>
                <input name="set_applyjobs" type="radio" value="1" <?php if($info['set_applyjobs'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="set_applyjobs" value="0" <?php if($info['set_applyjobs'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(个人申请了职位是否通知企业)</td>
            </tr>
            <tr>
              <td align="right">邀请面试：</td>
              <td>
        <label>
                <input name="set_invite" type="radio" value="1" <?php if($info['set_invite'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                <input name="set_invite" type="radio"  value="0" <?php if($info['set_invite'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(企业邀请个人面试是否通知个人)</td>
            </tr>
            <tr>
              <td align="right">新增订单：</td>
              <td>
          <label>
                <input name="set_order" type="radio" value="1" <?php if($info['set_order'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                <input name="set_order" type="radio"  value="0" <?php if($info['set_order'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(会员下充值订单是否邮件通知)</td>
            </tr>
            <tr>
              <td align="right">付款成功：</td>
              <td>
         <label>
                <input name="set_payment" type="radio" value="1" <?php if($info['set_payment'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                <input name="set_payment" type="radio"  value="0" <?php if($info['set_payment'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(会员订单付款完成是否邮件通知)</td>
            </tr>
            <tr>
              <td align="right">修改密码：</td>
              <td>
        <label>
                <input name="set_editpwd" type="radio" value="1" <?php if($info['set_editpwd'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                <input name="set_editpwd" type="radio"  value="0" <?php if($info['set_editpwd'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(会员修改密码后是否邮件通知)</td>
            </tr>
            <tr>
              <td align="right">职位审核通过：</td>
              <td>
          <label>
                <input name="set_jobsallow" type="radio" value="1" <?php if($info['set_jobsallow'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                <input name="set_jobsallow" type="radio"  value="0" <?php if($info['set_jobsallow'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(职位审核通过是否邮件通知)</td>
            </tr>
            <tr>
              <td align="right">职位审核未通过：</td>
              <td>
          <label>
                <input name="set_jobsnotallow" type="radio" value="1" <?php if($info['set_jobsnotallow'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                <input name="set_jobsnotallow" type="radio"  value="0" <?php if($info['set_jobsnotallow'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(职位审核未通过是否邮件通知)</td>
            </tr>
            <tr>
              <td align="right">营业执照审核通过：</td>
              <td>
        <label>
                <input name="set_licenseallow" type="radio" value="1" <?php if($info['set_licenseallow'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                <input name="set_licenseallow" type="radio"  value="0" <?php if($info['set_licenseallow'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(营业执照审核通过是否邮件通知)</td>
            </tr>
            <tr>
              <td align="right">营业执照审核未通过：</td>
              <td>
          <label>
                <input name="set_licensenotallow" type="radio" value="1" <?php if($info['set_licensenotallow'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                <input name="set_licensenotallow" type="radio"  value="0" <?php if($info['set_licensenotallow'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(营业执照审核未通过是否邮件通知)</td>
            </tr>
         
            <tr>
              <td align="right">简历审核通过：</td>
              <td>
        <label>
                <input name="set_resumeallow" type="radio" value="1" <?php if($info['set_resumeallow'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                <input name="set_resumeallow" type="radio"  value="0" <?php if($info['set_resumeallow'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(个人简历审核通过是否邮件通知)</td>
            </tr>
            <tr>
              <td align="right">简历审核未通过：</td>
              <td>
          <label>
                <input name="set_resumenotallow" type="radio" value="1" <?php if($info['set_resumenotallow'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                <input name="set_resumenotallow" type="radio"  value="0" <?php if($info['set_resumenotallow'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(个人简历审核未通过是否邮件通知)</td>
            </tr>
            
            <tr>
              <td align="right">简历头像审核通过：</td>
              <td>
        <label>
                <input name="set_resume_photoallow" type="radio" value="1" <?php if($info['set_resume_photoallow'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                <input name="set_resume_photoallow" type="radio"  value="0" <?php if($info['set_resume_photoallow'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(个人简历头像审核通过是否邮件通知)</td>
            </tr>
            <tr>
              <td align="right">简历头像审核未通过：</td>
              <td>
          <label>
                <input name="set_resume_photonotallow" type="radio" value="1" <?php if($info['set_resume_photonotallow'] == 1): ?>checked="checked"<?php endif; ?>/>
                通知</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>
                <input name="set_resume_photonotallow" type="radio"  value="0" <?php if($info['set_resume_photonotallow'] == 0): ?>checked="checked"<?php endif; ?>/>
              不通知</label>       </td>
              <td  style="color:#999999">(个人简历头像审核未通过是否邮件通知)</td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td height="55"><span style="font-size:14px;">
                <input type="submit" class="admin_submit" value="保存修改"/>
              </span></td>
              <td>&nbsp;</td>
            </tr>
          </table>
      </form>
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
</html>