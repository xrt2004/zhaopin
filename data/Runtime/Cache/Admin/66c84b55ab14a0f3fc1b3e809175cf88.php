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
	var URL = '/zhaopin42/index.php/admin/mail_queue',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=mail_queue&amp;a=index',
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
    <p>
发送邮件请确认您的邮件配置正确，具体请在 “系统 > 邮件设置”中设置。<br />
</p>
</div>
<div class="seltpye_x">
    <div class="left">每页显示</div>    
    <div class="right">
    <a href="<?php echo P(array('pagesize'=>10));?>" <?php if(!$_GET['pagesize']|| $_GET['pagesize']== '10'): ?>class="select"<?php endif; ?>>10</a>
    <a href="<?php echo P(array('pagesize'=>20));?>" <?php if($_GET['pagesize']== '20'): ?>class="select"<?php endif; ?>>20</a>
    <a href="<?php echo P(array('pagesize'=>30));?>" <?php if($_GET['pagesize']== '30'): ?>class="select"<?php endif; ?>>30</a>
    <a href="<?php echo P(array('pagesize'=>60));?>" <?php if($_GET['pagesize']== '60'): ?>class="select"<?php endif; ?>>60</a>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<div class="seltpye_x">
    <div class="left">筛选类型</div>    
    <div class="right">
    <a href="<?php echo P(array('m_type'=>0));?>" <?php if($_GET['m_type']== "" || $_GET['m_type']== 0): ?>class="select"<?php endif; ?>>不限</a>
    <a href="<?php echo P(array('m_type'=>1));?>" <?php if($_GET['m_type']== 1): ?>class="select"<?php endif; ?>>等待发送</a>
    <a href="<?php echo P(array('m_type'=>2));?>" <?php if($_GET['m_type']== 2): ?>class="select"<?php endif; ?>>发送成功</a>
    <a href="<?php echo P(array('m_type'=>3));?>" <?php if($_GET['m_type']== 3): ?>class="select"<?php endif; ?>>发送失败</a>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
   <form id="form1" name="form1" method="post" action="<?php echo U('del');?>">
    <table width="100%" border="0" cellpadding="0" cellspacing="0"  id="list" class="link_lan">
    <tr>
      <td  width="120" class="admin_list_tit admin_list_first">
     <label id="chkAll"><input type="checkbox" name="" title="全选/反选" id="chk"/>类型</label>    </td>
      <td class="admin_list_tit" width="13%">收件地址</td>
      <td  class="admin_list_tit">邮件主题</td>
      <td  class="admin_list_tit">邮件内容</td>
      <td width="110"  align="center"  class="admin_list_tit">添加时间</td>   
      <td width="110"  align="center"  class="admin_list_tit">发送时间</td>
      <td width="10%" align="center"  class="admin_list_tit">操作</td>
    </tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td   class="admin_list admin_list_first">
     <input type="checkbox" name="id[]"  value="<?php echo ($vo["m_id"]); ?>"/>
     <?php if($vo['m_type'] == 1): ?><span style="color:#FF6600">等待发送</span><?php endif; ?>
     <?php if($vo['m_type'] == 2): ?><span style="color:#009900">发送成功</span><?php endif; ?>
     <?php if($vo['m_type'] == 3): ?><span style="color:#666666">发送失败</span><?php endif; ?>
      </td>
      <td class="admin_list"><?php echo ($vo["m_mail"]); ?></td>
      <td class="admin_list vtip" title="<?php echo (nl2br($vo['m_subject'])); ?>" ><?php echo ($vo['m_subject_']); ?></td>
      <td class="admin_list vtip" title="<?php echo (nl2br($vo['m_body'])); ?>" ><?php echo ($vo['m_body_']); ?></td>
      <td align="center"  class="admin_list"><?php echo admin_date($vo['m_addtime']);?></td>     
      <td align="center"  class="admin_list">
      <?php if($vo['m_sendtime'] == 0): ?>----
       <?php else: ?>
       <?php echo admin_date($vo['m_sendtime']); endif; ?>
      </td>
      <td align="center"  class="admin_list">
      <a href="<?php echo U('mailqueue_edit',array('m_id'=>$vo['m_id']));?>">修改</a>
    </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
    <?php if(!$list): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
    <span id="OpDel">
    </span>
    <span id="OpSend">
    </span>
  </form>   
   <table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
    <tr>
      <td>
      <input type="button" name="Submit22" value="发送" class="admin_submit" id="ButSend"/>
       <input type="button" name="Submit22" value="添加任务" class="admin_submit"    onclick="window.location='<?php echo U('mailqueue_add');?>'"/>
       <input type="button" name="Submit22" value="批量添加" class="admin_submit"    onclick="window.location='<?php echo U('mailqueue_batchadd');?>'"/>
        <input type="button" name="ButDel" id="ButDel" value="删除" class="admin_submit" />
      </td>
      <td width="305">
        <form id="formseh" name="formseh" method="get" action="?">  
              <input type="hidden" name="m" value="<?php echo C('admin_alias');?>">
              <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
              <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
            <div class="seh">
                <div class="keybox"><input name="key" type="text"   value="<?php echo ($_GET['key']); ?>" /></div>
                <div class="selbox">
                    <input name="key_type_cn"  id="key_type_cn" type="text" value="<?php echo ((isset($_GET['key_type_cn']) && ($_GET['key_type_cn'] !== ""))?($_GET['key_type_cn']):"邮件主题"); ?>" readonly="true"/>
                        <div>
                                <input name="key_type" id="key_type" type="hidden" value="<?php echo ((isset($_GET['key_type']) && ($_GET['key_type'] !== ""))?($_GET['key_type']):"1"); ?>" />
                                                <div id="sehmenu" class="seh_menu">
                                                        <ul>
                                                        <li id="1" title="邮件主题">邮件主题</li>
                                                        <li id="2" title="收件地址">收件地址</li>
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
<div style="display:none" id="SendDiv">
<table width="400" border="0" align="center" cellpadding="0" cellspacing="6">
 <tr>
      <td  width="100"  align="right">发送选择：</td>
      <td>
      
      <label><input name="sendtype" type="radio" value="1" checked="checked"  />      
       已选项目
       </label>
       &nbsp;
       &nbsp;
       <label><input name="sendtype" type="radio" value="2"  />      
       所有等待发送的
       </label>
       &nbsp;
       &nbsp;
       <label><input name="sendtype" type="radio" value="3"   />      
       所有发送失败的
       </label>
                      
        </td>
    </tr>
    <tr>
      <td align="right">发送间隔时间：</td>
      <td>
      <input name="intervaltime" type="text" class="input_text_150"  value="3" maxlength="3" /> 
      秒
      </td>
    </tr>
    <tr>
      <td align="right">最大发送数量：</td>
      <td>
      <input name="sendmax" type="text" class="input_text_150"  value="500" maxlength="3" /> 
      
      0为不限制  
      </td>
    </tr>
     <tr>
      <td align="right">发送失败时：</td>
      <td>
                      <label><input type="radio" name="senderr" value="1"  checked="checked" />
                       跳过继续</label>
                       <label><input type="radio" name="senderr" value="2"  />
                       停止发送</label>
                       </td>
    </tr>
    <tr>
      <td height="70">&nbsp;</td>
      <td>
      <input type="button" name="submitdel"  value="确定" class="admin_submit submitsend"/>
 </td>
    </tr>
  </table>
</div>
<div style="display:none" id="DelDiv">
<table width="400" border="0" align="center" cellpadding="0" cellspacing="6">
 <tr>
      <td  width="30">&nbsp;</td>
      <td>
                      <label><input name="deltype" type="radio" value="1" checked="checked"  />
                      已选项目</label></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td>
                      <label><input type="radio" name="deltype" value="2"  />
                       所有等待发送项目</label></td>
    </tr>
     <tr>
      <td >&nbsp;</td>
      <td>
                      <label><input type="radio" name="deltype" value="3"  />
                       所有发送成功项目</label></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td>
                      <label><input type="radio" name="deltype" value="4"  />
                       所有发布失败项目</label></td>
    </tr>
    
    <tr>
      <td  >&nbsp;</td>
      <td>
                      <label><input type="radio" name="deltype" value="5"  />
                       清空所有列队</label></td>
    </tr>
    <tr>
      <td height="70">&nbsp;</td>
      <td>
      <input type="submit" name="submitdel"  value="确定" class="admin_submit submitdel"/>
 </td>
    </tr>
  </table>
</div>    
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
$(document).ready(function()
{
    showmenu("#key_type_cn","#sehmenu","#key_type");
    $("#ButSend").QSdialog({
    DialogAddObj:"#OpSend",
    DialogTitle:"请选择",
    DialogContent:"#SendDiv",
    DialogContentType:"id",
    DialogWidth:500 
    });
    $("#ButDel").QSdialog({
    DialogAddObj:"#OpDel",
    DialogTitle:"您要删除哪些信息?",
    DialogContent:"#DelDiv",
    DialogContentType:"id",
    DialogWidth:300 
    });
    //发送
    $(".submitsend").live('click',function(){
            $("form[name=form1]").attr("action","<?php echo U('totalsend');?>");
            $("form[name=form1]").submit()
    });
});
</script>
</body>
</html>