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
	var URL = '/zhaopin42/index.php/admin/category_district',
		SELF = '/zhaopin42/index.php?m=admin&amp;c=category_district&amp;a=index',
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
    正式使用后删除分类会导致与此分类关联的信息类别丢失，修改不会受影响。<br />
    删除顶级级分类将会自动删除此分类下的子分类。<br />
    </p>
  </div>
  <div class="toptit">地区层级配置</div>
  <form action="<?php echo U('config/edit');?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <table width="100%" border="0" cellspacing="5" cellpadding="5">
      <tr>
        <td width="120" align="right">地区层级：</td>
        <td>
          <label><input name="category_district_level" type="radio" value="2" <?php if(C('qscms_category_district_level') == 2): ?>checked="checked"<?php endif; ?>/>2级</label>
          &nbsp;&nbsp;&nbsp;&nbsp; 
          <label ><input type="radio" name="category_district_level" value="3" <?php if(C('qscms_category_district_level') == 3): ?>checked="checked"<?php endif; ?>/>3级</label>
          <span class="admin_note">（切换地区层级将使已有数据地区错乱，请谨慎操作！)</span>
        </td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td height="50"> 
          <input name="submit" type="submit" class="admin_submit" value="保存修改"/>
        </td>
      </tr>
    </table>
  </form>
    <div class="classification_th">
    <div class="th1">
    <label><input type="checkbox" name=" " title="全选/反选" id="J_checkall" />地区分类</label>
    </div>
    
    <div class="th2">
        <div class="thorder">排序</div>
      <div class="thedit">操作</div>
       <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
    <form id="form1" name="form1" method="post" action="<?php echo U('CategoryDistrict/districtAllSave');?>">
<div class="classification">

<?php if(is_array($district)): $i = 0; $__LIST__ = $district;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="menubg">
    <div class="linput">
      <div class="td1"><input type="checkbox" name="id[]" value="<?php echo ($list["id"]); ?>" id="<?php echo ($list["id"]); ?>" class="J_select"/></div>
     <input name="save_id[]" type="hidden" value="<?php echo ($list["id"]); ?>"/>
    <div class="J_show td2" id="<?php echo ($list["id"]); ?>" level="1"></div>
    <div class="td3"><input name="categoryname[]" type="text" value="<?php echo ($list["categoryname"]); ?>" class="input_text_150"  /></div>
    <div class="td4">(id:<?php echo ($list["id"]); ?>,别名:<?php if($list['spell']): echo ($list["spell"]); else: ?>--<?php endif; ?>)</div>
    <div class="clear"></div>
    </div>
    <div class="edit">
        <div class="order"><input name="category_order[]" type="text"  value="<?php echo ((isset($list["category_order"]) && ($list["category_order"] !== ""))?($list["category_order"]):"0"); ?>" class="input_text_50"/></div>
        <div class="edittxt link_lan">
              <a href="<?php echo U('CategoryDistrict/add',array('pid'=>$list['id']));?>">此类下加子类</a>
              <a href="<?php echo U('CategoryDistrict/edit',array('id'=>$list['id']));?>">修改</a>
              <a onclick="return confirm('你确定要删除吗？')" href="<?php echo U('CategoryDistrict/delete',array('id'=>$list['id']));?>">删除</a>
        </div>
        <div class="clear"></div>
    </div>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="menubg">
  <div class="add J_add"  level="1" parentid="0">添加顶级分类</div>
</div>


</div>
 <table width="100%" border="0" cellspacing="10"  class="admin_list_btm">
<tr>
        <td>
    <input name="ButSave" type="submit" class="admin_submit" id="ButSave" value="保存分类"/>
        <input name="ButADD" type="button" class="admin_submit" id="ButADD" value="添加分类"  onclick="window.location='<?php echo U('CategoryDistrict/add');?>'"/>
    </td>
        <td width="305" align="right">
    
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
<script type="text/javascript">
$(document).ready(function(){
var Maxlevel="<?php echo C('qscms_category_district_level');?>";//最多分类层数
//打开子菜单 
$(".J_show").live('click',function()
        {
      var infobox=$(this).closest(".menubg").next('.j_smalldiv');
      var level=$(this).attr('level');
      infobox.is(':visible')?$(this).removeClass("close"):$(this).addClass("close");  
      if (infobox.length == 0 && level<Maxlevel)
      {
       get_menu($(this).attr('id'),$(this).closest(".menubg"),level);
      }
      else
      {
      infobox.toggle();   
      }
          
});
//子菜单全选
$(".J_select").live('click',function()
{
  var infobox=$(this).closest(".menubg,.j_smalldiv").next('.j_smalldiv');
  if (infobox.length > 0)
  {
   infobox.find("input[type=checkbox]").attr("checked",this.checked);
   }
});
//全选所有项目
$("#J_checkall").live('click',function()
{
   $(".classification").find("input[type=checkbox]").attr("checked",this.checked);
});
//添加分类
$(".J_add").live('click',function()
{
  var level=$(this).attr('level');
  var parentid=$(this).attr('parentid');
  var html='';
  html+="<div class=\"menubg\">"; 
  html+="<div class=\"linput\">";
  if (level>1)
  {
  html+="<div class=\"sbg l"+level+"\"></div>";
  }
  html+="<div class=\"td1\"><input type=\"checkbox\" name=\"id[]\" value=\"\"/></div>"; 
  html+="<div class=\"J_show td2\"></div>"; 
  html+="<div class=\"td3\"><input name=\"add_categoryname[]\" type=\"text\"  class=\"input_text_150\"   /></div>";
  html+="<input name=\"add_parentid[]\" type=\"hidden\" value=\""+parentid+"\"/>";  
  html+="<div class=\"td4\"></div>"; 
  html+="<div class=\"clear\"></div>"; 
  html+="</div>"; 
  html+="<div class=\"edit\">"; 
  html+="<div class=\"order\"><input name=\"add_category_order[]\" type=\"text\"  class=\"input_text_50\"/></div>"; 
  html+="<div class=\"edittxt link_lan\">"; 
  html+="</div>"; 
  html+="<div class=\"clear\"></div>"; 
  html+="</div>"; 
  html+="</div>";
  $(this).parent().before(html);
});
//生成分类
function get_menu(pid,thisobj,level)
{
            var tsTimeStamp= new Date().getTime();
            $.getJSON("<?php echo U('index');?>", {"pid":pid},function(result){  
                    if (result.status==1){
           var html="";
           var leftbg="";
                     var i=1;
           level++;
                        for (x in result.data)
            {
                        html+="<div class=\"menubg\">"; 
              html+="<div class=\"linput\">";
              html+="<div class=\"sbg l"+level+"\"></div>";
              html+="<div class=\"td1\"><input type=\"checkbox\" name=\"id[]\" value=\""+result.data[x]['id']+"\" id=\""+result.data[x]['id']+"\"  class=\"J_select\"/></div>"; 
              html+="<input name=\"save_id[]\" type=\"hidden\" value=\""+result.data[x]['id']+"\"/>"; 
              html+="<div class=\"J_show td2\" id=\""+result.data[x]['id']+"\" level=\""+level+"\"></div>"; 
              html+="<div class=\"td3\"><input name=\"categoryname[]\" type=\"text\" value=\""+result.data[x]['categoryname']+"\" class=\"input_text_150\"  /></div>"; 
              html+="<div class=\"td4\">(id:"+result.data[x]['id']+",别名:"+(result.data[x]['spell']?result.data[x]['spell']:'--')+")</div>"; 
              html+="<div class=\"clear\"></div>"; 
              html+="</div>"; 
              html+="<div class=\"edit\">"; 
              html+="<div class=\"order\"><input name=\"category_order[]\" type=\"text\"  value=\""+result.data[x]['category_order']+"\" class=\"input_text_50\"/></div>"; 
              html+="<div class=\"edittxt link_lan\">"; 
              if(level < Maxlevel){
                html+="<a href=\"<?php echo U('add');?>&pid="+result.data[x]['id']+"\">此类下加子类</a>"; 
              }
              html+="<a href=\"<?php echo U('edit');?>&id="+result.data[x]['id']+"\">修改</a>"; 
              html+="<a onclick=\"return confirm('你确定要删除吗？')\" href=\"<?php echo U('delete');?>&id="+result.data[x]['id']+"\">删除</a>"; 
              html+="</div>"; 
              html+="<div class=\"clear\"></div>"; 
              html+="</div>"; 
              html+="</div>";
                            i++;
                        }
              if(level < Maxlevel){
                html+="<div class=\"smalladd l"+level+"\"><div class=\"J_add adds \" level=\""+level+"\" parentid=\""+pid+"\">添加分类</div></div>";
              }
            thisobj.after('<div class="j_smalldiv">'+html+'</div>');  
        
              
                    }
                 }
            );
}
});
</script>
</body>
</html>