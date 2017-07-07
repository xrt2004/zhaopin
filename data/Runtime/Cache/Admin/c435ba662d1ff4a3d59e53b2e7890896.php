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
	var URL = '/zhaopin42/index.php/admin/jobs',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=jobs&amp;a=index',
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
      有效职位是指：审核通过、审核中、服务未到期等网站能正常显示的职位。<br />
	  无效职位是指：审核未通过、服务到期等网站前台不显示的职位。<br />
</p>
  </div>
  <div class="seltpye_y">
    <div class="tit link_lan">
      <strong>职位列表</strong><span>(共找到<?php echo ($total); ?>条)</span>
      <a href="<?php echo U('index');?>">[恢复默认]</a>
      <div class="pli link_bk"><u>每页显示：</u>
        <a href="<?php echo P(array('pagesize'=>10));?>" <?php if(!$_GET['pagesize']|| $_GET['pagesize']== '10'): ?>class="select"<?php endif; ?>>10</a>
        <a href="<?php echo P(array('pagesize'=>20));?>" <?php if($_GET['pagesize']== '20'): ?>class="select"<?php endif; ?>>20</a>
        <a href="<?php echo P(array('pagesize'=>30));?>" <?php if($_GET['pagesize']== '30'): ?>class="select"<?php endif; ?>>30</a>
        <a href="<?php echo P(array('pagesize'=>60));?>" <?php if($_GET['pagesize']== '60'): ?>class="select"<?php endif; ?>>60</a>
        <div class="clear"></div>
      </div>
    </div>
    <div class="list">
      <div class="t">有效状态</div>
      <div class="txt link_lan">
        <a href="<?php echo P(array('jobtype'=>0));?>" <?php if($_GET['jobtype']== '0' || $_GET['jobtype']== ''): ?>class="select"<?php endif; ?>>不限<span>(<?php echo ($count[0]); ?>)</span></a>
        <a href="<?php echo P(array('jobtype'=>1));?>" <?php if($_GET['jobtype']== '1'): ?>class="select"<?php endif; ?>>有效职位<span>(<?php echo ($count[1]); ?>)</span></a>
        <a href="<?php echo P(array('jobtype'=>2));?>" <?php if($_GET['jobtype']== '2'): ?>class="select"<?php endif; ?>>无效职位<span>(<?php echo ($count[2]); ?>)</span></a>
      </div>
    </div>
    
    <div class="list">
      <div class="t">审核状态</div>
      <div class="txt link_lan">
        <a href="<?php echo P(array('audit'=>''));?>" <?php if($_GET['audit']== ''): ?>class="select"<?php endif; ?>>不限</a>
		 <a href="<?php echo P(array('audit'=>'2'));?>" <?php if($_GET['audit']== '2'): ?>class="select"<?php endif; ?>>等待审核<span <?php if($count[4] > 0): ?>style="color:#FF0000"<?php endif; ?>>(<?php echo ($count[4]); ?>)</span></a>
        <a href="<?php echo P(array('audit'=>'1'));?>" <?php if($_GET['audit']== '1'): ?>class="select"<?php endif; ?>>审核通过<span>(<?php echo ($count[3]); ?>)</span></a>
       
		<?php if($_GET['jobtype']!= 1): ?><a href="<?php echo P(array('audit'=>'3'));?>" <?php if($_GET['audit']== '3'): ?>class="select"<?php endif; ?>>审核未通过<span>(<?php echo ($count[5]); ?>)</span></a><?php endif; ?>
      </div>
    </div>
	
	<?php if($_GET['jobtype']== '2'): ?><div class="list listod">
      <div class="t">无效原因</div>
      <div class="txt link_lan">
        <a href="<?php echo P(array('invalid'=>'0'));?>" <?php if(!$_GET['invalid']|| $_GET['invalid']== '0'): ?>class="select"<?php endif; ?>>不限</a>
        <a href="<?php echo P(array('invalid'=>'2'));?>" <?php if($_GET['invalid']== '2'): ?>class="select"<?php endif; ?>>套餐到期</a>
        <a href="<?php echo P(array('invalid'=>'3'));?>" <?php if($_GET['invalid']== '3'): ?>class="select"<?php endif; ?>>职位暂停</a>
        <a href="<?php echo P(array('invalid'=>'4'));?>" <?php if($_GET['invalid']== '4'): ?>class="select"<?php endif; ?>>非审核通过</a>
      </div>
    </div><?php endif; ?>
    
    
    <div class="list listod" >
      <div class="t">服务到期</div>
      <div class="txt link_lan">
        <a href="<?php echo P(array('deadline'=>''));?>" <?php if($_GET['deadline']== ''): ?>class="select"<?php endif; ?>>不限</a>
        <?php if($_GET['jobtype']== '2'): ?><a href="<?php echo P(array('deadline'=>'1'));?>" <?php if($_GET['deadline']== '1'): ?>class="select"<?php endif; ?>>已到期</a>
        <a href="<?php echo P(array('deadline'=>'2'));?>" <?php if($_GET['deadline']== '2'): ?>class="select"<?php endif; ?>>未到期</a><?php endif; ?>
        <a href="<?php echo P(array('deadline'=>'3'));?>" <?php if($_GET['deadline']== '3'): ?>class="select"<?php endif; ?>>三天内</a>
        <a href="<?php echo P(array('deadline'=>'7'));?>" <?php if($_GET['deadline']== '7'): ?>class="select"<?php endif; ?>>一周内</a>
        <a href="<?php echo P(array('deadline'=>'30'));?>" <?php if($_GET['deadline']== '30'): ?>class="select"<?php endif; ?>>一月内</a>
      </div>
    </div>
    
    <div class="list listod" >
      <div class="t">推广类型</div>
      <div class="txt link_lan">
        <a href="<?php echo P(array('promote'=>''));?>" <?php if($_GET['promote']== ''): ?>class="select"<?php endif; ?>>不限</a>
        <a href="<?php echo P(array('promote'=>'-1'));?>" <?php if($_GET['promote']== '-1'): ?>class="select"<?php endif; ?>>未推广</a>
        <a href="<?php echo P(array('promote'=>1));?>" <?php if($_GET['promote']== 1): ?>class="select"<?php endif; ?>>置顶</a>
        <a href="<?php echo P(array('promote'=>2));?>" <?php if($_GET['promote']== 2): ?>class="select"<?php endif; ?>>紧急</a>
      </div>
    </div>
    
    
    
    <div class="list" >
      <div class="t">添加时间</div>
      <div class="txt link_lan">
        <a href="<?php echo P(array('addsettr'=>''));?>" <?php if($_GET['addsettr']== ''): ?>class="select"<?php endif; ?>>不限</a>
        <a href="<?php echo P(array('addsettr'=>'3'));?>" <?php if($_GET['addsettr']== '3'): ?>class="select"<?php endif; ?>>三天内</a>
        <a href="<?php echo P(array('addsettr'=>'7'));?>" <?php if($_GET['addsettr']== '7'): ?>class="select"<?php endif; ?>>一周内</a>
        <a href="<?php echo P(array('addsettr'=>'30'));?>" <?php if($_GET['addsettr']== '30'): ?>class="select"<?php endif; ?>>一月内</a>
      </div>
    </div>
    
    <div class="list" >
      <div class="t">刷新时间</div>
      <div class="txt link_lan">
        <a href="<?php echo P(array('settr'=>''));?>" <?php if($_GET['settr']== ''): ?>class="select"<?php endif; ?>>不限</a>
        <a href="<?php echo P(array('settr'=>'3'));?>" <?php if($_GET['settr']== '3'): ?>class="select"<?php endif; ?>>三天内</a>
        <a href="<?php echo P(array('settr'=>'7'));?>" <?php if($_GET['settr']== '7'): ?>class="select"<?php endif; ?>>一周内</a>
        <a href="<?php echo P(array('settr'=>'30'));?>" <?php if($_GET['settr']== '30'): ?>class="select"<?php endif; ?>>一月内</a>
      </div>
    </div>
    <div class="list" >
      <div class="t">排序方式</div>
      <div class="txt link_lan">
        <a href="<?php echo P(array('orderby'=>'addtime'));?>" <?php if($_GET['orderby']== '' || $_GET['orderby']== 'addtime'): ?>class="select"<?php endif; ?>>添加时间倒序</a>
        <a href="<?php echo P(array('orderby'=>'refreshtime'));?>" <?php if($_GET['orderby']== 'refreshtime'): ?>class="select"<?php endif; ?>>刷新时间倒序</a>
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
      <div class="clear"></div>
    </div>
  <form id="form1" name="form1" method="post" action="<?php echo U('set_audit');?>">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="list" class="link_lan">
      <tr>
        <td   class="admin_list_tit admin_list_first">
          <label id="chkAll"><input type="checkbox" name=" " title="全选/反选" id="chk"/>职位名称</label></td>
          <td  class="admin_list_tit"> 发布公司 </td>
          <td align="center"  width="10%" class="admin_list_tit">审核状态</td>
          <td align="center" width="10%" class="admin_list_tit">来源</td>
          <td align="center"  width="10%" class="admin_list_tit">添加时间</td>
          <td align="center" width="10%"  class="admin_list_tit">刷新时间</td>
          <td align="center" width="10%" class="admin_list_tit">点击</td>
          <td    width="100" align="center"  class="admin_list_tit">操作</td>
      </tr>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td  class="admin_list admin_list_first">
            <input name="id[]" type="checkbox" value="<?php echo ($vo['id']); ?>"  />
            <a href="<?php echo ($vo['jobs_url']); ?>" target="_blank" <?php if(($vo['deadline'] < $now && $vo['deadline'] != 0) || $vo['display'] == '2'): ?>style="color:#999999"<?php endif; ?>><?php echo ($vo['jobs_name']); ?></a>
            <?php if($vo['emergency'] == '1'): ?>&nbsp;<span style="color: #FF6600">[急聘]</span><?php endif; ?>
            <?php if($vo['recommend'] == '1'): ?>&nbsp;<span style="color: #339900">[推荐]</span><?php endif; ?>
            <?php if($vo['stick'] == '1'): ?>&nbsp;<span style="color: #FF3399">[置顶]</span><?php endif; ?>
            <?php if($vo['highlight'] != ''): ?>&nbsp;<span style="color: #6633CC">[变色]</span><?php endif; ?>
            <?php if($vo['display'] == '2'): ?>&nbsp;<span style="color: #999999">[已暂停]</span><?php endif; ?> 
			
			
			<span class="view jobs_log" title="职位日志" parameter="id=<?php echo ($vo['id']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span>
			</td>
          <td class="admin_list">
            
			<a href="<?php echo ($vo['company_url']); ?>" target="_blank" style="color: #000000" title="<?php echo ($vo['companyname']); ?>"><?php echo ($vo['companyname']); ?></a>          <?php if($vo['company_audit'] == 1): ?>&nbsp;<span style="color: #009900" title="已认证企业">[已认证]</span><?php endif; ?>
			<?php if($vo['famous'] == 1): ?>&nbsp;<span style="color: #FF6600" title=" 诚聘通企业">[诚]</span><?php endif; ?>
			</td>
          <td class="admin_list" align="center">
            <?php if($vo['audit'] == '1'): ?><span style="color: #009900">审核通过 </span>
            <?php elseif($vo['audit'] == '2'): ?>
            <span style="color:#FF0000">等待审核</span>
            <?php elseif($vo['audit'] == '3'): ?>
            审核未通过<?php endif; ?>
			<span class="view audit_log" title="查看日志" parameter="type=jobs_id&id=<?php echo ($vo['id']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span>
			</td>
          <td class="admin_list"align="center" >
            <?php if($vo['robot'] == '0'): ?>人工<?php endif; ?>
            <?php if($vo['robot'] == '1'): ?>采集<?php endif; ?>          </td>
          <td class="admin_list" align="center" >
            <?php echo admin_date($vo['addtime']);?>          </td>
          <td class="admin_list" align="center" >
            <?php echo admin_date($vo['refreshtime']);?>          </td>
          <td class="admin_list" align="center" >
            <?php echo ($vo['click']); ?>          </td>
          <td class="admin_list" align="center" >
        	<a href="<?php echo U('jobs/edit',array('id'=>$vo['id']));?>">编辑</a>&nbsp;            
            <a class="userinfo"  parameter="uid=<?php echo ($vo['uid']); ?>" href="javascript:void(0);" hideFocus="true">管理</a>&nbsp;
            <a href="<?php echo U('delete_jobs',array('id'=>$vo['id']));?>" >删除</a>
		  </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
      <span id="OpAudit"></span>
</form>
    <?php if(!$list): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
    <table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
      <tr>
        <td>
          <input name="ButAudit" type="button" class="admin_submit" id="ButAudit"    value="审核"  />
          <input type="button" name="Butrefresh"  id="Butrefresh" value="刷新" class="admin_submit"/>
          <input type="button" name="ButDel"  id="ButDel" value="删除" class="admin_submit"/>
        </td>
        <td width="305" align="right">
          <form id="formseh" name="formseh" method="get" action="?">
          <input type="hidden" name="m" value="<?php echo C('admin_alias');?>">
          <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
          <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
            <div class="seh">
              <div class="keybox"><input name="key" type="text"   value="<?php echo ($_GET['key']); ?>" /></div>
              <div class="selbox">
                <input name="key_type_cn"  id="key_type_cn" type="text" value="<?php echo ((isset($_GET['key_type_cn']) && ($_GET['key_type_cn'] !== ""))?($_GET['key_type_cn']):'职位名'); ?>" readonly="true"/>
                <div>
                  <input name="key_type" id="key_type" type="hidden" value="<?php echo ((isset($_GET['key_type']) && ($_GET['key_type'] !== ""))?($_GET['key_type']):'1'); ?>" />
                  <div id="sehmenu" class="seh_menu">
                    <ul>
                      <li id="1" title="职位名">职位名</li>
                      <li id="2" title="公司名">公司名</li>
                      <li id="3" title="职位ID">职位ID</li>
                      <li id="4" title="公司ID">公司ID</li>
                      <li id="5" title="会员ID">会员ID</li>
                      <li id="6" title="手机号">手机号</li>
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
    <div style="display:none" id="AuditSet">
      <table width="400" border="0" align="center" cellpadding="0" cellspacing="6">
        <tr>
          <td width="20" height="30">&nbsp;</td>
          <td height="30"><strong  style="color:#0066CC; font-size:14px;">将所选职位置为：</strong></td>
        </tr>
        
        <tr>
          <td width="40" height="25">&nbsp;</td>
          <td>
            <label><input name="audit" type="radio" value="1" checked="checked"  id="success" />
          审核通过</label></td>
        </tr>
        <tr>
          <td width="40" height="25">&nbsp;</td>
          <td>
            <label><input type="radio" name="audit" value="3"  id="fail"/>
          审核未通过</label></td>
        </tr>
        <tr id="reason">
          <td width="40" height="25" >备注：</td>
          <td>
            <textarea name="reason" id="reason" cols="50" style="font-size:12px"></textarea>
          </td>
        </tr>
        <tr>
          <td height="25">&nbsp;</td>
          <td>
            <input type="submit" name="set_audit" value="确定" class="admin_submit"/>
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
  $("#ButAudit").QSdialog({
  DialogAddObj:"#OpAudit",
  DialogTitle:"请选择",
  DialogContent:"#AuditSet",
  DialogContentType:"id"
  });
  
  $(".userinfo").QSdialog({
  DialogTitle:"管理",
  DialogContentType:"url",
  DialogContent:"<?php echo U('ajax/userinfo');?>&"
  });
  
   $(".jobs_log").QSdialog({
  DialogTitle:"职位日志",
  DialogContentType:"url",
  DialogContent:"<?php echo U('ajax/jobs_log');?>&"
  });
   $(".audit_log").QSdialog({
  DialogTitle:"审核日志",
  DialogContentType:"url",
  DialogContent:"<?php echo U('ajax/audit_log');?>&"
  });
    //点击批量删除
  $("#ButDel").click(function(){
    if (confirm('你确定要删除吗？'))
    {
       $("form[name=form1]").attr("action","<?php echo U('delete_jobs');?>");
      $("form[name=form1]").submit()
    }
  });
  //刷新
  $("#Butrefresh").click(function(){
      $("form[name=form1]").attr("action","<?php echo U('refresh_jobs');?>");
      $("form[name=form1]").submit()
  });
  
  //纵向列表排序
  $(".listod .txt").each(function(i){
  var li=$(this).children(".select");
  var htm="<a href=\""+li.attr("href")+"\" class=\""+li.attr("class")+"\">"+li.text()+"</a>";
  li.detach();
  $(this).prepend(htm);
  });
    
  
});
</script>
</body>
</html>