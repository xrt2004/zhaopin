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
	var URL = '/zhaopin42/index.php/admin/company',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=company&amp;a=index',
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
  <?php if(!empty($apply['Subsite'])): ?><div class="seltpye_x">
    <div class="left">所属分站</div>
    <?php $tag_subsite_class = new \Common\qscmstag\subsiteTag(array('列表名'=>'subsite_list','cache'=>'0','type'=>'run',));$subsite_list = $tag_subsite_class->run();$frontend = new \Common\Controller\FrontendController;$page_seo = $frontend->_config_seo(array("pname"=>"","title"=>"","keywords"=>"","description"=>"","header_title"=>""),$subsite_list);?>
    <div class="right">
      <a href="<?php echo P(array('subsite_id'=>''));?>" <?php if($_GET['subsite_id']== ''): ?>class="select"<?php endif; ?>>不限</a>
      <?php if($visitor['role_id'] == 1): if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i;?><a href="<?php echo P(array('subsite_id'=>$subsite['s_id']));?>" <?php if($_GET['subsite_id']== $subsite['s_id']): ?>class="select"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
      <?php else: ?>
        <?php if(is_array($subsite_list)): $i = 0; $__LIST__ = $subsite_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subsite): $mod = ($i % 2 );++$i; if(in_array($subsite['s_id'],$visitor['subsite'])): ?><a href="<?php echo P(array('subsite_id'=>$subsite['s_id']));?>" <?php if($_GET['subsite_id']== $subsite['s_id']): ?>class="select"<?php endif; ?>><?php echo ($subsite["s_sitename"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div><?php endif; ?>
  <div class="seltpye_x">
    <div class="left">企业认证</div>
    <div class="right">
      <a href="<?php echo P(array('audit'=>''));?>" <?php if($_GET['audit']== ''): ?>class="select"<?php endif; ?>>不限</a>
      <a href="<?php echo P(array('audit'=>'1'));?>" <?php if($_GET['audit']== '1'): ?>class="select"<?php endif; ?>>已通过</a>
      <a href="<?php echo P(array('audit'=>'2'));?>" <?php if($_GET['audit']== '2'): ?>class="select"<?php endif; ?>>待认证<?php if($count): ?><span>(<?php echo ($count); ?>)</span><?php endif; ?></a>
      <a href="<?php echo P(array('audit'=>'3'));?>" <?php if($_GET['audit']== '3'): ?>class="select"<?php endif; ?>>未通过</a>
      <a href="<?php echo P(array('audit'=>'0'));?>" <?php if($_GET['audit']== '0'): ?>class="select"<?php endif; ?>>未认证</a>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <?php if(C('apply.Sincerity')): ?><div class="seltpye_x">
    <div class="left">诚聘通</div>
    <div class="right">
      <a href="<?php echo P(array('famous'=>'','setmeal_id'=>''));?>" <?php if($_GET['famous']== ''): ?>class="select"<?php endif; ?>>不限</a>
      <a href="<?php echo P(array('famous'=>'1'));?>" <?php if($_GET['famous']== '1'): ?>class="select"<?php endif; ?>>诚聘通</a>
      <a href="<?php echo P(array('famous'=>'0','setmeal_id'=>''));?>" <?php if($_GET['famous']== '0'): ?>class="select"<?php endif; ?>>非诚聘通</a>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div><?php endif; ?>
  <div class="seltpye_x">
      <div class="left">套餐分类</div>    
      <div class="right">
          <a href="<?php echo P(array('setmeal_id'=>''));?>" <?php if($_GET['setmeal_id']== ''): ?>class="select"<?php endif; ?>>不限</a>
          <?php if(is_array($setmeal)): $i = 0; $__LIST__ = $setmeal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo P(array('setmeal_id'=>$key));?>" <?php if($_GET['setmeal_id']== $key): ?>class="select"<?php endif; ?>><?php echo ($vo); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
          <div class="clear"></div>
      </div>
      <div class="clear"></div>
  </div>
  <div class="seltpye_x">
    <div class="left">添加时间</div>
    <div class="right">
      <a href="<?php echo P(array('settr'=>''));?>" <?php if($_GET['settr']== ''): ?>class="select"<?php endif; ?>>不限</a>
      <a href="<?php echo P(array('settr'=>'3'));?>" <?php if($_GET['settr']== '3'): ?>class="select"<?php endif; ?>>三天内</a>
      <a href="<?php echo P(array('settr'=>'7'));?>" <?php if($_GET['settr']== '7'): ?>class="select"<?php endif; ?>>一周内</a>
      <a href="<?php echo P(array('settr'=>'30'));?>" <?php if($_GET['settr']== '30'): ?>class="select"<?php endif; ?>>一月内</a>
      <a href="<?php echo P(array('settr'=>'180'));?>" <?php if($_GET['settr']== '180'): ?>class="select"<?php endif; ?>>半年内</a>
      <a href="<?php echo P(array('settr'=>'360'));?>" <?php if($_GET['settr']== '360'): ?>class="select"<?php endif; ?>>一年内</a>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="seltpye_x">
    <div class="left">套餐到期</div>
    <div class="right">
      <a href="<?php echo P(array('overtime'=>''));?>" <?php if($_GET['overtime']== ''): ?>class="select"<?php endif; ?>>不限</a>
      <a href="<?php echo P(array('overtime'=>'3'));?>" <?php if($_GET['overtime']== '3'): ?>class="select"<?php endif; ?>>三天内</a>
      <a href="<?php echo P(array('overtime'=>'7'));?>" <?php if($_GET['overtime']== '7'): ?>class="select"<?php endif; ?>>一周内</a>
      <a href="<?php echo P(array('overtime'=>'30'));?>" <?php if($_GET['overtime']== '30'): ?>class="select"<?php endif; ?>>一月内</a>
      <a href="<?php echo P(array('overtime'=>'-1'));?>" <?php if($_GET['overtime']== '-1'): ?>class="select"<?php endif; ?>>已到期</a>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  <form id="form1" name="form1" method="post" action="<?php echo U('company/delete_company');?>">
    <table width="100%" border="0" cellpadding="0" cellspacing="0"  id="list" class="link_lan">
      <tr>
        <td  class="admin_list_tit admin_list_first">
          <label id="chkAll"><input type="checkbox" name=" " title="全选/反选" id="chk"/>公司名称</label>
        </td>
        <td class="admin_list_tit">所属会员</td>
		<td width="35" align="center" class="admin_list_tit"></td>
        <td width="10%" class="admin_list_tit">企业认证</td>
        <?php if(C('apply.Sincerity')): ?><td width="10%" align="center" class="admin_list_tit">诚聘通</td><?php endif; ?>
        <td width="10%" align="center" class="admin_list_tit">创建时间</td>
        <td width="10%" align="center" class="admin_list_tit">刷新时间</td>
        <td width="8%" align="center" class="admin_list_tit">套餐名称</td>
        <td width="120" align="center" class="admin_list_tit">操作</td>
      </tr>
     <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr >
        <td class="admin_list admin_list_first" >
          <input name="y_id[]" type="checkbox" value="<?php echo ($vo['uid']); ?>" />
          <a href="<?php echo ($vo['company_url']); ?>" target="_blank"><?php echo ($vo['companyname']); ?></a>
		 <?php if($vo['audit'] == 1): ?>&nbsp;<span style="color: #009900" title="已认证企业">[证]</span><?php endif; ?>
		<?php if($vo['famous'] == 1): ?>&nbsp;<span style="color: #FF9900" title=" 诚聘通企业">[诚]</span><?php endif; ?>
        </td>
        
        <td  class="admin_list">
          <?php echo ($vo['username']); ?>
        <?php if($vo['email']): ?><span class="emailtip ajax_send_email" title="发送邮件" parameter="email=<?php echo ($vo['email']); ?>&uid=<?php echo ($vo['uid']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span><?php endif; ?>
		  
         <?php if($vo['mobile']): ?><span class="smstip ajax_send_sms" title="发送短信" parameter="mobile=<?php echo ($vo['mobile']); ?>&uid=<?php echo ($vo['uid']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span><?php endif; ?>
        </td>
        
        <td  class="admin_list">
		 <?php if($vo['certificate_img']): ?><a href="<?php echo attach($vo['certificate_img'],'certificate_img');?>" target="_blank" title="点击查看">[证件]</a>&nbsp;&nbsp;<?php endif; ?>
		</td>
        <td class="admin_list">
		
          <?php if($vo['audit'] == '0'): ?>未认证<?php endif; ?>
          <?php if($vo['audit'] == '1'): ?><span style="color: #009900">已通过</span><?php endif; ?>
          <?php if($vo['audit'] == '2'): ?><span style="color:#FF3300">待认证</span><?php endif; ?>
          <?php if($vo['audit'] == '3'): ?>未通过<?php endif; ?>
		  <span class="view audit_log" title="查看日志" parameter="type=company_id&id=<?php echo ($vo['id']); ?>&famous=0">&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </td>
        <?php if(C('apply.Sincerity')): ?><td align="center" class="admin_list">
		<?php if($vo['famous'] == 1): ?><span style="color: #FF6600" title=" 诚聘通企业">是</span>
		<?php else: ?>
		<span style="color: #999999">否</span><?php endif; ?>
		
		<span class="view famous_log" title="查看日志" parameter="type=company_id&id=<?php echo ($vo['id']); ?>&famous=1">&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </td><?php endif; ?>
        <td align="center" class="admin_list">
          <?php echo admin_date($vo['addtime']);?>
        </td>
        <td align="center" class="admin_list">
          <?php echo admin_date($vo['refreshtime']);?>
        </td>
        <td align="center" class="admin_list">
          <?php if($vo['setmeal_name']): ?><span  <?php if($vo['setmeal_id'] != '1'): ?>style="color: #FF6600"<?php endif; ?>><?php echo ($vo['setmeal_name']); ?></span><?php else: ?><span style="color:#FF3300">无套餐</span><?php endif; ?>
		  <span class="view setmeal_detail" title="套餐详情" parameter="uid=<?php echo ($vo['uid']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </td>
        <td width="15%" align="center" class="admin_list">

          <a href="<?php echo U('edit_company',array('id'=>$vo['id'],'_k_v'=>$vo['id']));?>">编辑</a>
          &nbsp;
		   <a class="userinfo"  parameter="uid=<?php echo ($vo['uid']); ?>" href="javascript:void(0);" hideFocus="true">管理</a>
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <span id="OpAudit"></span>
    <span id="OpAuditFamous"></span>
    <span id="OpDel"></span>
    <span id="Oprefresh"></span>
  </form>
    <?php if(!$list): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
  
  <table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
    <tr>
      <td>
        <input type="button" name="" value="认证企业" class="admin_submit"  id="ButAudit" />
        <?php if(C('apply.Sincerity')): ?><input type="button" name="" value="诚聘通" class="admin_submit"  id="ButAuditFamous" /><?php endif; ?>
        <input type="button" name="" value="刷新" class="admin_submit"  id="Butrefresh" />
        <input type="button" name="" value="删除" class="admin_submit"   id="ButDel"/>
        
      </td>
      <td width="305" align="right">
        <form id="formseh" name="formseh" method="get" action="?">
              <input type="hidden" name="m" value="<?php echo C('admin_alias');?>">
              <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
              <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
          <div class="seh">
            <div class="keybox"><input name="key" type="text"   value="<?php echo ($_GET['key']); ?>" /></div>
            <div class="selbox">
              <input name="key_type_cn"  id="key_type_cn" type="text" value="<?php echo ((isset($_GET['key_type_cn']) && ($_GET['key_type_cn'] !== ""))?($_GET['key_type_cn']):"公司名"); ?>" readonly="true"/>
              <div>
                <input name="key_type" id="key_type" type="hidden" value="<?php echo ((isset($_GET['key_type']) && ($_GET['key_type'] !== ""))?($_GET['key_type']):"1"); ?>" />
                <div id="sehmenu" class="seh_menu">
                  <ul>
                    <li id="1" title="公司名">公司名</li>
                    <li id="2" title="公司id">公司id</li>
                    <li id="3" title="会员名">会员名</li>
                    <li id="4" title="会员id">会员id</li>
                    <li id="5" title="地址">地址</li>
                    <li id="6" title="电话">电话</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="sbtbox">
              <input type="submit" name="" class="sbt" id="sbt" value="搜索"/>
            </div>
            <div class="clear"></div>
          </div>
        </form>
      </td>
    </tr>
  </table>
  <div class="qspage"><?php echo ($page); ?></div>
</div>
<div style="display:none" id="OpDelLayer">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="6" >
    <tr>
      <td height="30" colspan="2"><strong  style="color:#0066CC; font-size:14px;">你确定要删除吗？</strong></td>
    </tr>
    <tr>
      <td width="20" height="25">&nbsp;</td>
      <td><label>
        <input name="delete_company" type="checkbox" id="delete_company" value="yes" checked="checked" />
      删除企业资料</label></td>
    </tr>
    <tr>
      <td height="25">&nbsp;</td>
      <td><label>
        <input name="delete_jobs" type="checkbox" id="delete_jobs" value="yes" checked="checked"/>
      删除此企业发布的招聘信息</label></td>
    </tr>
    <tr>
      <td height="25">&nbsp;</td>
      <td><input type="submit" name="delete" value="确定" class="admin_submit"    /></td>
    </tr>
  </table>
</div>
<!-- -->
<div style="display:none" id="OprefreshLayer">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="6" >
    <tr>
      <td height="30" colspan="2"><strong  style="color:#0066CC; font-size:14px;">刷新该企业的职位：</strong></td>
    </tr>
    <tr>
      <td width="20" height="25">&nbsp;</td>
      <td><label>
        <input name="refresh_jobs" type="checkbox" id="refresh_jobs" value="yes" checked/>
      同时刷新所选企业的职位</label></td>
    </tr>
    <tr>
      <td height="25">&nbsp;</td>
      <td><input type="button" name="set_refresh" id="set_refresh" value="确定" class="admin_submit"    /></td>
    </tr>
  </table>
</div>
<!-- -->
<div style="display:none" id="OpAuditLayer">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="6" >
    <tr>
      <td width="20" height="30">&nbsp;</td>
      <td height="30"><strong  style="color:#0066CC; font-size:14px;">将所选企业设置为：</strong></td>
    </tr>
    
    <tr>
      <td height="25">&nbsp;</td>
      <td>
        <label >
          <input name="audit" type="radio" value="1" checked="checked"  id="success" />
        认证通过 </label>   </td>
      </tr>
      <tr>
        <td height="25">&nbsp;</td>
        <td><label >
          <input type="radio" name="audit" value="3"  id="fail"/>
        认证未通过</label></td>
      </tr>
      <tr>
        <td height="25">&nbsp;</td>
        <td>
          <label >
            <input type="radio" name="audit" value="2"  id="wait"/>
            等待认证
          </label>  </td>
        </tr>
      <tr id="reason">
        <td width="40" height="25" >备注：</td>
        <td>
          <textarea name="reason" id="reason" cols="50" style="font-size:12px"></textarea>
        </td>
      </tr>
      <tr>
        <td height="25">&nbsp;</td>
        <td><input type="button" name="set_audit" id="set_audit" value="确定" class="admin_submit"    /></td>
      </tr>
    </table>
  </div>
  <div style="display:none" id="OpAuditLayerFamous">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="6" >
    <tr>
      <td width="20" height="30">&nbsp;</td>
      <td height="30"><strong  style="color:#0066CC; font-size:14px;">将所选企业设置为：</strong></td>
    </tr>
    
    <tr>
      <td height="25">&nbsp;</td>
      <td>
        <label >
          <input name="famous" type="radio" value="1" checked="checked"  id="success" />
        是 </label>   </td>
      </tr>
      <tr>
        <td height="25">&nbsp;</td>
        <td><label >
          <input type="radio" name="famous" value="0"  id="fail"/>
        否</label></td>
      </tr>
      <tr id="reason">
        <td width="40" height="25" >备注：</td>
        <td>
          <textarea name="reason" id="reason" cols="50" style="font-size:12px"></textarea>
        </td>
      </tr>
      <tr>
        <td height="25">&nbsp;</td>
        <td><input type="button" name="set_audit_famous" id="set_audit_famous" value="确定" class="admin_submit"    /></td>
      </tr>
    </table>
  </div>
  <!-- -->
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
  $(".ajax_send_sms").QSdialog({
    DialogTitle:"发送短信",
    DialogContentType:"url",
    DialogContent:"<?php echo U('Ajax/ajax_send_sms');?>&"
    });
  $(".ajax_send_email").QSdialog({
    DialogTitle:"发送邮件",
    DialogContentType:"url",
    DialogContent:"<?php echo U('Ajax/ajax_send_email');?>&"
    });
  showmenu("#key_type_cn","#sehmenu","#key_type");
  $("#ButAudit").QSdialog({
  DialogAddObj:"#OpAudit",
  DialogTitle:"请选择",
  DialogContent:"#OpAuditLayer",
  DialogContentType:"id"
  });
  $("#ButAuditFamous").QSdialog({
  DialogAddObj:"#OpAuditFamous",
  DialogTitle:"请选择",
  DialogContent:"#OpAuditLayerFamous",
  DialogContentType:"id"
  });
  $("#ButDel").QSdialog({
  DialogAddObj:"#OpDel",
  DialogTitle:"请选择",
  DialogContent:"#OpDelLayer",
  DialogContentType:"id"
  });
  $("#Butrefresh").QSdialog({
  DialogAddObj:"#Oprefresh",
  DialogTitle:"请选择",
  DialogContent:"#OprefreshLayer",
  DialogContentType:"id"
  });
  $(".userinfo").QSdialog({
  DialogTitle:"管理",
  DialogContentType:"url",
  DialogContent:"<?php echo U('ajax/userinfo');?>&"
  });
  $(".audit_log").QSdialog({
  DialogTitle:"审核日志",
  DialogContentType:"url",
  DialogContent:"<?php echo U('ajax/audit_log');?>&"
  });
  $(".famous_log").QSdialog({
  DialogTitle:"诚聘通",
  DialogContentType:"url",
  DialogContent:"<?php echo U('ajax/famous_log');?>&"
  });
  $(".setmeal_detail").QSdialog({
  DialogTitle:"套餐详情",
  DialogContentType:"url",
  DialogContent:"<?php echo U('ajax/setmeal_detail');?>&"
  });
  $("#set_audit").live('click',function(){
      $("form[name=form1]").attr("action","<?php echo U('company/com_audit');?>");
      $("form[name=form1]").submit()
  });
  $("#set_audit_famous").live('click',function(){
      $("form[name=form1]").attr("action","<?php echo U('Sincerity/Admin/com_audit_famous');?>");
      $("form[name=form1]").submit()
  });
  $("#set_refresh").live('click',function(){
      $("form[name=form1]").attr("action","<?php echo U('company/refresh_company');?>");
      $("form[name=form1]").submit()
  });
});
</script>
</body>
</html>