<?php if (!defined('THINK_PATH')) exit();?>      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	var URL = '/zhaopin42/index.php/admin/personal',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=personal&amp;a=index',
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
      可见简历是指：审核通过、审核中等能正常显示的简历。<br />
	  不可见简历指：审核未通过等网站前台不显示的简历。<br />
</p>
  </div>
<div class="seltpye_y">
  <div class="tit link_lan">
    <strong>简历列表</strong><span>(共找到<?php echo ($total); ?>条)</span>
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
    <div class="t">可见状态</div>
    <div class="txt link_lan">
      <a href="<?php echo P(array('tabletype'=>0));?>" <?php if($_GET['tabletype']== '' || $_GET['tabletype']== '0'): ?>class="select"<?php endif; ?>>不限<span>(<?php echo ($count[0]); ?>)</span></a>
      <a href="<?php echo P(array('tabletype'=>1));?>" <?php if($_GET['tabletype']== 1): ?>class="select"<?php endif; ?>>可见简历<span>(<?php echo ($count[1]); ?>)</span></a>
      <a href="<?php echo P(array('tabletype'=>2));?>" <?php if($_GET['tabletype']== 2): ?>class="select"<?php endif; ?>>非可见简历<span>(<?php echo ($count[2]); ?>)</span></a>
    </div>
  </div>
  
  <div class="list">
    <div class="t">审核状态</div>
    <div class="txt link_lan">
      <a href="<?php echo P(array('audit'=>''));?>" <?php if($_GET['audit']== ''): ?>class="select"<?php endif; ?>>不限</a>
	    <a href="<?php echo P(array('audit'=>'2'));?>" <?php if($_GET['audit']== '2'): ?>class="select"<?php endif; ?>>等待审核<span <?php if($count[4] > 0): ?>style="color:#FF0000"<?php endif; ?>>(<?php echo ($count[4]); ?>)</span></a>
      <a href="<?php echo P(array('audit'=>'1'));?>" <?php if($_GET['audit']== '1'): ?>class="select"<?php endif; ?>>审核通过<span>(<?php echo ($count[3]); ?>)</span></a>
    
	  <?php if($_GET['tabletype']!= '1'): ?><a href="<?php echo P(array('audit'=>'3'));?>" <?php if($_GET['audit']== '3'): ?>class="select"<?php endif; ?>>审核未通过<span>(<?php echo ($count[5]); ?>)</span></a><?php endif; ?>
    </div>
  </div>
 
<div class="list" >
    <div class="t">照片</div>
    <div class="txt link_lan">
      <a href="<?php echo P(array('photos'=>''));?>" <?php if($_GET['photos']== ''): ?>class="select"<?php endif; ?>>不限</a>
      <a href="<?php echo P(array('photos'=>'1'));?>" <?php if($_GET['photos']== '1'): ?>class="select"<?php endif; ?>>有</a>
      <a href="<?php echo P(array('photos'=>'2'));?>" <?php if($_GET['photos']== '2'): ?>class="select"<?php endif; ?>>无</a>
    </div>
  </div>
  <div class="list" >
    <div class="t">添加时间</div>
    <div class="txt link_lan">
      <a href="<?php echo P(array('addtimesettr'=>''));?>" <?php if($_GET['addtimesettr']== ''): ?>class="select"<?php endif; ?>>不限</a>
      <a href="<?php echo P(array('addtimesettr'=>'3'));?>" <?php if($_GET['addtimesettr']== '3'): ?>class="select"<?php endif; ?>>三天内</a>
      <a href="<?php echo P(array('addtimesettr'=>'7'));?>" <?php if($_GET['addtimesettr']== '7'): ?>class="select"<?php endif; ?>>一周内</a>
      <a href="<?php echo P(array('addtimesettr'=>'30'));?>" <?php if($_GET['addtimesettr']== '30'): ?>class="select"<?php endif; ?>>一月内</a>
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
    <div class="t">是否委托</div>
    <div class="txt link_lan">
      <a href="<?php echo P(array('entrust'=>''));?>" <?php if($_GET['entrust']== ''): ?>class="select"<?php endif; ?>>不限</a>
      <a href="<?php echo P(array('entrust'=>'1'));?>" <?php if($_GET['entrust']== '1'): ?>class="select"<?php endif; ?>>一周</a>
      <a href="<?php echo P(array('entrust'=>'2'));?>" <?php if($_GET['entrust']== '2'): ?>class="select"<?php endif; ?>>二周</a>
      <a href="<?php echo P(array('entrust'=>'3'));?>" <?php if($_GET['entrust']== '3'): ?>class="select"<?php endif; ?>>一个月</a>
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
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="<?php echo U('set_audit');?>">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="link_lan">
    <tr>
      <td class="admin_list_tit admin_list_first" >
        <label id="chkAll"><input type="checkbox" name="" title="全选/反选" id="chk"/>姓名</label>   </td>
        <td   align="center"  width="140" class="admin_list_tit">完整指数 </td>
        <td align="center"  width="12%"  class="admin_list_tit">审核状态</td>
        <td   align="center" width="12%" class="admin_list_tit">公开</td>
        <td align="center" width="12%"  class="admin_list_tit">添加时间</td>
        <td align="center"  width="12%"  class="admin_list_tit">刷新时间</td>
        <td align="center"  width="100"  class="admin_list_tit">委托状态</td>
        <td  align="center"  width="200" class="admin_list_tit">操作</td>
    </tr>
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
        <td  class="admin_list admin_list_first" >
          <input name="id[]" type="checkbox" id="id" value="<?php echo ($vo['id']); ?>"  />
          <a href="<?php echo ($vo['resume_url']); ?>" target="_blank"><?php echo ($vo['fullname']); ?></a>
      
          <?php if($vo['photo_img'] != ''): ?><span class="pictip vtip" title="<img src='<?php echo attach($vo['photo_img'],'avatar');?>'  border=0  align=absmiddle>">&nbsp;&nbsp;&nbsp;&nbsp;</span><?php endif; ?>
         
		  
        </td>
        <td align="center"  class="admin_list">
          <div style="width:100px;text-align:left; background-color:#CCCCCC; position:relative; font-size:0px">
            <div style="background-color: #99CC00; height:13px; color:#990000;width:<?php echo ($vo['complete_percent']); ?>%;font-size:0px"></div>
            <div style="position:absolute;top:0px; left:40%; font-size:9px;"><?php echo ($vo['complete_percent']); ?>%</div>
          </div> </td>
          <td align="center"  class="admin_list">
            <?php if($vo['audit'] == '1'): ?>审核通过<?php endif; ?>
            <?php if($vo['audit'] == '2'): ?><span style="color: #FF6600">等待审核</span><?php endif; ?>
            <?php if($vo['audit'] == '3'): ?><span style="color: #666666">审核未通过</span><?php endif; ?>
			<span class="view audit_log" title="查看日志" parameter="type=resume_id&id=<?php echo ($vo['id']); ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span>
          </td>
          <td align="center"  class="admin_list">
            <?php if($vo['display'] == '1'): ?>公开
            <?php else: ?>
            保密<?php endif; ?>
          </td>
          <td align="center"  class="admin_list"><?php echo admin_date($vo['addtime']);?></td>
          <td align="center"  class="admin_list"><?php echo admin_date($vo['refreshtime']);?></td>
		  <td align="center"  class="admin_list">
		  
          <?php if($vo['entrust'] == '0'): ?>无
		   <?php elseif($vo['entrust'] == '1'): ?>
		   <span class="entrustinfo" uid="<?php echo ($vo['uid']); ?>" rid="<?php echo ($vo['id']); ?>">一周</span>
		   <?php elseif($vo['entrust'] == '2'): ?>
		   <span class="entrustinfo" uid="<?php echo ($vo['uid']); ?>" rid="<?php echo ($vo['id']); ?>">二周</span>
		    <?php else: ?>
			<span class="entrustinfo" uid="<?php echo ($vo['uid']); ?>" rid="<?php echo ($vo['id']); ?>">一个月</span><?php endif; ?>
        </td>
          <td align="center"  class="admin_list">
            <a href="<?php echo U('resume_show',array('id'=>$vo['id']));?>" >查看</a>
            &nbsp;
            <a class="userinfo"  parameter="uid=<?php echo ($vo['uid']); ?>" href="javascript:void(0);" hideFocus="true">管理</a>
            &nbsp;
            <a href="<?php echo U('Personal/resume_delete',array('id'=>$vo['id']));?>" onClick="return confirm('您确定删除吗?')">删除</a>
            &nbsp;
            <?php if($vo['entrust'] != '0'): ?><a href="<?php echo U('match',array('id'=>$vo['id'],'uid'=>$vo['uid']));?>">匹配</a>
            <?php else: ?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php endif; ?>
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
      <span id="OpAudit"></span>
      <span id="OpPhotoresume"></span>
      <span id="OpImportresume"></span>
    </form>
    <?php if(!$list): ?><div class="admin_list_no_info">没有任何信息！</div><?php endif; ?>
    <table width="100%" border="0" cellspacing="10" cellpadding="0" class="admin_list_btm">
      <tr>
        <td>
          <input type="button" class="admin_submit" id="ButAudit" value="审核简历" />
          <input type="button" class="admin_submit" id="Butrefresh" value="刷新"/>
          <input type="button" class="admin_submit" id="ButDel" value="删除"/>
		  <?php if(!empty($apply['Resumeimport'])): ?><input type="button" class="admin_submit xianshi" id="ButImportresume" value="导入简历"/>
            <input type="button" class="admin_submit xianshi" id="excelmodel" value="下载简历模板" onclick="javascript:location.href='<?php echo attach('excelmodel.xls','resumeimport');?>'"/><?php endif; ?>
        </td>
        <td width="305" align="right">
          <form id="formseh" name="formseh" method="get" action="?">
          <input type="hidden" name="m" value="<?php echo C('admin_alias');?>">
          <input type="hidden" name="c" value="<?php echo CONTROLLER_NAME;?>">
          <input type="hidden" name="a" value="<?php echo ACTION_NAME;?>">
            <div class="seh">
              <div class="keybox"><input name="key" type="text"   value="<?php echo ($_GET['key']); ?>" /></div>
              <div class="selbox">
                <input name="key_type_cn"  id="key_type_cn" type="text" value="<?php echo ((isset($_GET['key_type_cn']) && ($_GET['key_type_cn'] !== ""))?($_GET['key_type_cn']):'姓名'); ?>" readonly="true"/>
                <div>
                  <input name="key_type" id="key_type" type="hidden" value="<?php echo ((isset($_GET['key_type']) && ($_GET['key_type'] !== ""))?($_GET['key_type']):'1'); ?>" />
                  <div id="sehmenu" class="seh_menu">
                    <ul>
                      <li id="1" title="姓名">姓名</li>
                      <li id="2" title="ID">ID</li>
                      <li id="3" title="UID">UID</li>
                      <li id="4" title="电话">电话</li>
                      <!--<li id="5" title="QQ">QQ</li>-->
                      <li id="6" title="地址">地址</li>
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
  <div id="AuditSet" style="display: none" >
    <table width="400" border="0" align="center" cellpadding="0" cellspacing="6" >
      <tr>
        <td height="30">&nbsp;</td>
        <td height="30"><strong  style="color:#0066CC; font-size:14px;">将所选简历设置为：</strong></td>
      </tr>
      <tr>
        <td width="40" height="25">&nbsp;</td>
        <td>
          <label >
            <input name="audit" type="radio" value="1" checked="checked" id="success" />
          审核通过 </label>   </td>
        </tr>
        <tr>
          <td width="40" height="25">&nbsp;</td>
          <td width="400"><label >
            <input type="radio" name="audit" value="3"  id="fail"/>
          审核未通过</label></td>
        </tr>
        <tr>
          <td width="50" height="25">&nbsp;</td>
          <td>
            <label><input type="checkbox" name="pms_notice" value="1"  checked="checked"/>
            站内信通知
          </label></td>
        </tr>
        <tr id="reason">
          <td width="40" height="25" >备注：</td>
          <td>
            <textarea name="reason" id="reason" cols="40" style="font-size:12px"></textarea>
          </td>
        </tr>
        <tr>
          <td height="25">&nbsp;</td>
          <td><span style="border-top: 1px #A3C7DA solid;">
            <input type="submit" name="set_audit" value="确定" class="admin_submit">
          </span></td>
        </tr>
      </table>
    </div>
    <div id="ImportSet" style="display: none" >
      <table width="400" border="0" align="center" cellpadding="0" cellspacing="6" >
        <tr>
          <input type="file" name="wbmb"  id="wbmb" style="height:21px; width:210px; border:1px #999999 solid" />
        </tr>
        <tr>
          <td height="25">&nbsp;</td>
          <td><span style="border-top: 1px #A3C7DA solid;">
            <input type="button" name="set_import" id="set_import" value="确定" class="admin_submit">
          </span></td>
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
    
    <script type="text/javascript" src="__ADMINPUBLIC__/js/jquery.entrustinfotip-min.js"></script>
    <script type="text/javascript">
    $(document).ready(function()
    {
		<?php if(!empty($apply['Resumeimport'])): ?>//导入简历
			$("#set_import").live('click',function(){
				$("form[name=form1]").attr("action","<?php echo U('Resumeimport/Resumeimport/import');?>");
				$("form[name=form1]").submit()
			});
			//导入简历
			$("#ButImportresume").QSdialog({
				DialogTitle:"请选择",
				DialogContent:"#ImportSet",
				DialogContentType:"id",
				DialogAddObj:"#OpImportresume",	
				DialogAddType:"html"	
			});<?php endif; ?>
		
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
		DialogContent:"#AuditSet",
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
		
		//点击批量删除
		$("#ButDel").click(function(){
			if (confirm('你确定要删除吗？'))
			{
				$("form[name=form1]").attr("action","<?php echo U('resume_delete');?>");
				$("form[name=form1]").submit()
			}
		});
		$("#Butrefresh").click(function(){
			$("form[name=form1]").attr("action","<?php echo U('refresh');?>");
			$("form[name=form1]").submit()
		});
		//纵向列表排序
		$(".listod .txt").each(function(i){
			var li=$(this).children(".select");
			var htm="<a href=\""+li.attr("href")+"\" class=\""+li.attr("class")+"\">"+li.text()+"</a>";
			li.detach();
			$(this).prepend(htm);
			});
			$("#not_audit").click(function(){
			$("#is_del_img").show();
			});
			$("#yes_audit").click(function(){
			$("#is_del_img").hide();
		});
    });
    </script>
  </body>
</html>