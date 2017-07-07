<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class PersonalController extends FrontendController{
    public function _initialize() {
        parent::_initialize();
        //访问者控制
        if (!$this->visitor->is_login) {
            IS_AJAX && $this->ajaxReturn(0, L('login_please'),'',1);
            //非ajax的跳转页面
            $this->redirect('members/login');
        }
        if(C('visitor.utype') !=2){
            IS_AJAX && $this->ajaxReturn(0,'请登录个人帐号！');
            $this->redirect('members/index');
        }
        !IS_AJAX && $this->_global_variable();
    }
    protected function _global_variable() {
        // 帐号状态 为暂停
        if (C('visitor.status') == 2 && !in_array(ACTION_NAME, array('index'))){
            $this->error('您的账号处于暂停状态，请联系管理员设为正常后进行操作！',U('Personal/index'));
        }
        // 短信必须验证
        if (C('qscms_sms_open')==1 && C('qscms_login_per_audit_mobile')==1 && C('visitor.mobile_audit') == 0 && !in_array(ACTION_NAME, array('user_safety','resume_add'))){
            $this->error('您的手机未认证，认证后才能进行其他操作！',U('Personal/user_safety'));
        }
        $resume_count = D('Resume')->count_resume(array('uid'=>C('visitor.uid')));//当前用户简历份数
    	if(!$resume_count && !in_array(ACTION_NAME,array('resume_add'))) $this->redirect('personal/resume_add');
        if(!S('personal_login_first_'.C('visitor.uid'))){
            S('personal_login_first_'.C('visitor.uid'),1,86400-(time()-strtotime("today")));
            if($resume_count>0){
                $resume = M('Resume')->where(array('uid'=>C('visitor.uid')))->order('def desc')->limit(1)->find();//当前用户默认简历内容
                $this->assign('resume',$resume);//当前用户简历内容
            }
        }
        $this->assign('personal_nav',ACTION_NAME);
    }
    /**
     * [_is_resume 检测简历是否存在]
     * @return boolean [false || 简历信息(按需要添加字段)]
     */
    protected function _is_resume($pid){
        !$pid && $pid = I('request.pid',0,'intval');
        if(!$pid){
            IS_AJAX && $this->ajaxReturn(0,'请正确选择简历！');
            $this->error('请正确选择简历！');
        }
        //$field = 'id,uid,title,fullname,sex,nature,nature_cn,trade,trade_cn,birthdate,residence,height,marriage_cn,experience_cn,district_cn,wage_cn,householdaddress,education_cn,major_cn,tag,tag_cn,telephone,email,intention_jobs,photo_img,complete_percent,current,current_cn,word_resume';
        if(!$reg = M('Resume')->field()->where(array('id'=>$pid,'uid'=>C('visitor.uid')))->find()) return false;
        $reg['height'] = $reg['height']==0?'':$reg['height'];
        $this->assign('resume',$reg);
        return $reg;
    }
    /*
    **保存到桌面
    */
    /*public function shortcut(){
        $Shortcut = "[InternetShortcut]
        URL=".C('qscms_site_domain').C('qscms_site_dir')."?lnk
        IDList= 
        IconFile=".C('qscms_site_domain').C('qscms_site_dir')."favicon.ico
        IconIndex=100
        [{000214A0-0000-0000-C000-000000000046}]
        Prop3=19,2";
        header("Content-type: application/octet-stream"); 
        header("Content-Disposition: attachment; filename=".C('qscms_site_name').".url;"); 
        exit($Shortcut);
    }*/
    /*
    **个人会员中心首页
    */
    public function index(){
        session('error_login_count',0);
        $uid=C('visitor.uid');
        $resume_list = D('Resume')->get_resume_list(array('where'=>array('uid'=>$uid),'order'=>'def desc','countinterview'=>true,'countdown'=>true,'countapply'=>true,'views'=>true,'stick'=>true));
        $this->assign('points',D('MembersPoints')->get_user_points($uid));//当前用户积分数
        $resume_info = $resume_list[0];
        if($resume_info['intention_jobs_id']){
            $jobcategory = explode(',',$resume_info['intention_jobs_id']);
            $jobcategory = explode('.',$jobcategory[0]);
            $jobcategory = $jobcategory[2] ? $jobcategory[2] : $jobcategory[1];
            if(false === $result = F('jobs_cate_list')) $result = D('CategoryJobs')->jobs_cate_cache();
            $resume_info['jobcategory'] = $result['id'][$jobcategory]['spell'];
        }
        $this->assign('resume_info',$resume_info);
        if($resume_info['level']==1){
            $points_rule = D('Task')->get_task_cache(2,12);
        }else if($resume_info['level']==2){
            $points_rule = D('Task')->get_task_cache(2,11);
        }else{
            $points_rule = D('Task')->get_task_cache(2,4);
        }
        $this->assign('points_rule',$points_rule);
        $this->ajax_get_interest_jobs('recommend_jobs');
        //微信扫描绑定
        $user_bind = M('MembersBind')->where(array('uid'=>$uid))->limit('1')->getfield('type,keyid');
        if(C('qscms_weixin_apiopen')==1 && C('qscms_weixin_scan_bind')==1){
            if(!$user_bind['weixin']){
            	$html = \Common\qscmslib\weixin::qrcode_img('bind',100,100);
            	$this->assign('qrcode',$html);
            }
        }else{
        	$this->assign('wx_status');
        }
        $this->assign('hidden_perfect_notice',cookie($uid.'_hidden_perfect_notice'));
        $issign = D('MembersHandsel')->check_members_handsel_day(array('uid'=>$uid,'htype'=>'task_sign'));
        $this->assign('issign',$issign ? 1 : 0);
        $this->assign('current',D('Category')->get_category_cache('QS_current'));
        $this->_config_seo(array('title'=>'首页 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    /**
     * [ajax_get_interest_jobs ajax推荐职位]
     * type recommend_jobs,nearby_jobs,new_jobs
     */
    public function ajax_get_interest_jobs($type=''){
        $type = $type ? $type : I('get.type','','trim,badword');
        !$type && IS_AJAX && $this->ajaxReturn(0,'数据类型错误！');
        if(!in_array($type, array('recommend_jobs','nearby_jobs','new_jobs'))) $this->ajaxReturn(0,'数据类型错误！');
        $where = array(
            '显示数目' => '12',
            '分页显示' => 1
        );
        if($type=='recommend_jobs'){
            $jobcategory = M('Resume')->where(array('uid'=>C('visitor.uid')))->getField('intention_jobs_id',true);
            $where['职位分类'] = $jobcategory;
            $where['排序'] = 'stickrtime';
            $msg = "没有合适的推荐职位！";
        }elseif($type=='nearby_jobs'){
            $where['经度'] = I('get.lng','0','trim,badword');//112.732929
            $where['纬度'] = I('get.lat','0','trim,badword');//37.714684
            $msg = "没有找到附近的职位！";
        }else{
            $where['排序'] = 'rtime';
            $msg = "没有找到最新的职位！";
        }
        $jobs_mod = new \Common\qscmstag\jobs_listTag($where);
        $jobs_list = $jobs_mod->run();
        $this->assign('msg',$msg);
        $this->assign('jobs_list',$jobs_list['list']);
        if(IS_AJAX){
            $data['html'] = $this->fetch('Personal/ajax_tpl/ajax_jobs_list');
            $data['isfull'] = $jobs_list['page_params']['nowPage'] >= $jobs_list['page_params']['totalPages'];
            $this->ajaxReturn(1,'职位信息获取成功！',$data);
        }
    }
    /*
    **个人会员中心刷新简历弹窗
    */
    public function ajax_refresh_resume(){
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'简历不存在！');
        $current = D('Category')->get_category_cache('QS_current');
        $this->assign('current',$current);
        $tpl=$this->fetch('Personal/ajax_tpl/ajax_refresh_resume');
        $this->ajaxReturn(1,'',$tpl);
    }
    /**
     * [refresh_resume 刷新简历]
     */
    public function refresh_resume(){
        if(IS_AJAX){
            $pid = I('post.pid',0,'intval');
            !$pid && $pid = M('Resume')->where(array('uid'=>C('visitor.uid')))->order('def desc')->limit(1)->getField('id');
            $uid = C('visitor.uid');
            $r = D('Resume')->get_resume_list(array('where'=>array('uid'=>$uid,'id'=>$pid),'field'=>'id,title,audit,display'));
            !$r && $this->ajaxReturn(0,"选择的简历不存在！");
            $r[0]['_audit'] != 1 && $this->ajaxReturn(0,"审核中或未通过的简历无法刷新！");
            $r[0]['display'] != 1 && $this->ajaxReturn(0,"简历已关闭，无法刷新！");
            $refresh_log = M('RefreshLog');
            $refrestime = $refresh_log->where(array('uid'=>$uid,'type'=>2001))->order('addtime desc')->getfield('addtime');
            $duringtime=time()-$refrestime;
            $space = C('qscms_per_refresh_resume_space')*60;
            $today = strtotime(date('Y-m-d'));
            $tomorrow = $today+3600*24;
            $count = $refresh_log->where(array('uid'=>$uid,'type'=>2001,'addtime'=>array('BETWEEN',array($today,$tomorrow))))->count();
            if(C('qscms_per_refresh_resume_time')!=0&&($count>=C('qscms_per_refresh_resume_time'))){
                $this->ajaxReturn(0,"每天最多可刷新 ".C('qscms_per_refresh_resume_time')." 次，您今天已达到最大刷新次数！");
            }elseif($duringtime<=$space && $space!=0){
                $this->ajaxReturn(0,C('qscms_per_refresh_resume_space')." 分钟内不允许重复刷新简历！");
            }else{
                //修改目前状态
                $resume = D('Resume');
                if($current = I('post.current',0,'intval')){
                    $data['current'] = $current;
                }
                if($mobile = I('post.mobile','','trime')){
                    $data['telephone'] = $mobile;
                    if(C('visitor.mobile_audit')){
                        $verifycode = I('post.verifycode','','trim');
                        $verify = session('verify_mobile');
                        if (!$verifycode || !$verify['rand'] || $verifycode<>$verify['rand']) $this->ajaxReturn(0,'验证码错误!');
                    }
                }
                if($data){
                    if(true !== $reg = D('Members')->update_user_info($data,C('visitor'),array('id'=>$pid))) $this->ajaxReturn(0,$reg);
                }
                $r = $resume->refresh_resume($pid,C('visitor'));
                $this->ajaxReturn(1,'刷新简历成功！',$r['data']);
            }
        }
    }
    /**
     * [jobs_matching_list 匹配职位]
     */
    public function jobs_matching_list(){
        $this->_config_seo(array('title'=>'匹配职位 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    /**
     * [save_shield_company 添加屏蔽企业关健字]
     */
    public function save_shield_company(){
        $keyword = I('post.comkeyword','','trim,badword');
        !$keyword && $this->ajaxReturn(0,'企业关健字不能为空！');
        $data['uid'] = C('visitor.uid');
        if(10 <= $count = M('PersonalShieldCompany')->where($data)->count()) $this->ajaxReturn(0,'您最多屏蔽 10 个企业关键词！');
        $data['comkeyword'] = $keyword;
        $shield_mod = D('PersonalShieldCompany');
        if(false === $shield_mod->create($data)) $this->ajaxReturn(0,$shield_mod->getError());
        if(false === $data['id'] = $shield_mod->add()) $this->ajaxReturn(0,'企业关健字添加失败，请重新添加！');
        //写入会员日志
        write_members_log(C('visitor'),2002,$keyword);
        $this->ajaxReturn(1,'企业关健字添加成功！',$data);
    }
    /**
     * [del_shield_company 删除屏蔽企业关健字]
     */
    public function del_shield_company(){
        $keyword_id = I('request.keyword_id',0,'intval');
        !$keyword_id && $this->ajaxReturn(0,'请选择关健字！');
        $uid = C('visitor.uid');
        if(IS_POST){
            if($reg = M('PersonalShieldCompany')->where(array('id'=>$keyword_id,'uid'=>C('visitor.uid')))->delete()){
                //写入会员日志
                write_members_log(C('visitor'),2003,$keyword_id);
                $this->ajaxReturn(1,'关健字删除成功！');
            } 
            $reg === false && $this->ajaxReturn(0,'关健字删除失败！');
            $this->ajaxReturn(0,'关健字不存在或已经删除！');
        }else{
            $tip='删除后无法恢复，您确定要删除该关键字吗？';
            $this->ajax_warning($tip);
        }
    }
    /*
    **隐私设置
    */
    public function resume_privacy(){
        $resume_list=M('Resume')->field('id,title,display,audit,level,complete_percent')->where(array('uid'=>C('visitor.uid')))->select();
        $keywords=M('PersonalShieldCompany')->where(array('uid'=>C('visitor.uid')))->select();
        $this->assign('resume_list',$resume_list);
        $this->assign('keywords',$keywords);
        $this->_config_seo(array('title'=>'隐私设置 - 个人会员中心 - '.C('qscms_site_name')));
        $this->assign('personal_nav','resume_list');
        $this->display();
    }
    /*
    **隐私设置更新数据库
    */
    public function save_resume_privacy(){
        $pid = I('post.pid',0,'intval');
        !$pid && $this->ajaxReturn(0,'请选择简历!');
        $setsqlarr['display']=I('post.display',0,'intval');
        // $setsqlarr['display_name']=I('post.display_name',0,'intval');
        // $setsqlarr['photo_display']=I('post.photo_display',0,'intval');
        $uid=C('visitor.uid');
        $where = array('id'=>$pid,'uid'=>$uid);
        if(false !== M('Resume')->where($where)->save($setsqlarr)){
            $reg = D('Resume')->resume_index($pid);
            if(!$reg['state']) $this->ajaxReturn(0,$reg['error']);
            //写入会员日志
            write_members_log(C('visitor'),2004,$pid);
            $this->ajaxReturn(1,'隐私设置成功!');
        }else{
            $this->ajaxReturn(0,'隐私设置失败，请重新操作!');
        }
    }
    /*
    **委托简历选择弹窗
    */
    public function entrust(){
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'简历不存在！');
        $data['entrust'] = $resume['entrust'];
        if($data['entrust']>0){
            $entrust_info = D('ResumeEntrust')->where(array('resume_id'=>$resume['id']))->find();
            $this->assign('entrust_info',$entrust_info);
            $data['html'] = $this->fetch('Personal/ajax_tpl/ajax_entrust_resume_cancel');
        }else{
            $data['html'] = $this->fetch('Personal/ajax_tpl/ajax_entrust_resume');
        }
        $this->ajaxReturn(1,'',$data);
    }
    /*
    **委托简历更新数据库
    */
    public function set_entrust(){
        $uid=C('visitor.uid');
        $pid = I('post.pid',0,'intval');
        !$pid && $this->ajaxReturn(0,'您没有选择简历!');
        $setsqlarr['entrust']=I('post.entrust',0,'intval');
        $setsqlarr['entrust_start']=time();
        switch ($setsqlarr['entrust']) {
             case '3':
                $setsqlarr['entrust_end']=strtotime("+3 day");
                break;
            case '7':
                $setsqlarr['entrust_end']=strtotime("+7 day");
                break;
            case '14':
                $setsqlarr['entrust_end']=strtotime("+14 day");
                break;
            case '30':
                $setsqlarr['entrust_end']=strtotime("+30 day");
                break;
            default:
                $this->ajaxReturn(0,'请正确选择委托时间!');
        }
        //设置简历委托
        if(D('ResumeEntrust')->set_resume_entrust($pid,$uid,$setsqlarr)){
            M('Resume')->where(array('id'=>$pid,'uid'=>$uid))->setfield('entrust',$setsqlarr['entrust']);
            //写入会员日志
            write_members_log(C('visitor'),2005,$pid);
            $this->ajaxReturn(1,'委托成功!');
        }else{
            $this->ajaxReturn(0,'委托失败!');
        }
    }
    /*
    **取消委托简历更新数据库
    */
    public function set_entrust_del(){
        $pid = I('post.pid',0,'intval');
        !$pid && $this->ajaxReturn(0,'您没有选择简历！!');
        $uid = C('visitor.uid');
        if(false !== M('ResumeEntrust')->where(array('resume_id'=>$pid,'uid'=>$uid))->delete()){
            M('Resume')->where(array('id'=>$pid,'uid'=>$uid))->setfield('entrust',0);
            //写入会员日志
            write_members_log(C('visitor'),2006,$pid);
            $this->ajaxReturn(1,'取消委托成功！');
        }else{
            $this->ajaxReturn(0,'取消委托失败！');
        }
    }
    /**
     * [resume_tpl 获取简历模板]
     */
    public function resume_tpl(){
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'简历不存在！');
        $tplid_list = D('ResumeTpl')->where(array('uid'=>C('visitor.uid')))->field('tplid')->select();
        $tplid_arr = array();
        foreach ($tplid_list as $key => $value) {
            $tplid_arr[] = $value['tplid'];
        }
        if($tplid_arr){
            $tpl_list = D('Tpl')->where(array('tpl_id'=>array('in',$tplid_arr)))->select();
        }else{
            $tpl_list = array();
        }
        foreach ($tpl_list as $key => $value) {
            $tpl_list[$key]['thumb_dir'] = __RESUME__.'/'.$value['tpl_dir'];
        }
        $this->assign('tpl_list',$tpl_list);
        $resume['tpl'] = $resume['tpl']==''?'default':$resume['tpl'];
        $this->assign('resume',$resume);
        $data['html'] = $this->fetch('Personal/ajax_tpl/ajax_change_resume_tpl');
        $this->ajaxReturn(1,'',$data);
    }
    public function set_tpl(){
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'简历不存在！');
        $tpl = I('post.tpl','','trim');
        $reg = D('Tpl')->resume_tpl($tpl,C('visitor'));
        if($reg['state']){
            //写入会员日志
            write_members_log(C('visitor'),2007,$resume['id'],$tpl);
            $this->ajaxReturn(1,'简历模板更换成功！');
        } 
        $this->ajaxReturn(0,$reg['error']);
    }
    /*
    **删除简历更新数据库
    */
    public function set_del_resume(){
        $id = I('request.id',0,'intval');
        !$id && $this->ajaxReturn(0,'您没有选择简历！');
        $resume_num = D('Resume')->count_resume(array('uid'=>C('visitor.uid')));
        if(IS_POST){
            if($resume_num==1){
                $this->ajaxReturn(0,'删除失败，您至少要保留一份简历！');
            }
            $current = D('Resume')->get_resume_one($id);
            if(true === $reg = D('Resume')->del_resume(C('visitor'),$id)){
                if($current['def']==1){
                    D('Resume')->where(array('uid'=>C('visitor.uid')))->order('complete_percent desc')->limit(1)->setField('def',1);
                }
                $this->ajaxReturn(1,'简历删除成功！');
            }else{
                $this->ajaxReturn(0,'删除失败！');
            }
        }else{
            if($resume_num==1){
                $tip='该简历无法删除，请至少保留一份简历！';
                $could = 0;
            }else{
                $tip='您确定要删除该份简历吗？';
                $could = 1;
            }
            $description = '如果您目前暂无求职意向，将简历状态设置为【保密】即可免受企业骚扰。';
            $this->ajax_warning($tip,$description,$could);
        }
    }
    /**
     * [set_default 默认简历设置]
     */
    public function set_default(){
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'简历不存在！');
        if(!$resume['def']){
            $reg = M('Resume')->where(array('uid'=>C('visitor.uid'),'def'=>1))->setfield('def',0);
            false === $reg && $this->ajaxReturn(0,'默认简历设置失败，请重新操作！');
            M('Resume')->where(array('id'=>$resume['id']))->setfield('def',1);
            //写入会员日志
            write_members_log(C('visitor'),2009,$resume['id']);
        }
        $this->ajaxReturn(1,'默认简历设置成功！');
    }
    /*
    **创建简历-基本信息
    */
    public function resume_add(){
        $uid=C('visitor.uid');
        if(C('qscms_resume_max') <= $resume_count = M('Resume')->where(array('uid'=>$uid))->count('id')){
            IS_AJAX && $this->ajaxReturn(0,'您最多可以创建'.C('qscms_resume_max').'份简历,已经超出了最大限制！');
            $this->error('您最多可以创建'.C('qscms_resume_max').'份简历,已经超出了最大限制！');
        }
        if(IS_POST && IS_AJAX){
            if(C('qscms_sms_open')==1 && C('qscms_login_per_audit_mobile')==1 && !C('visitor.mobile_audit')){
                $this->ajaxReturn(0,'您的手机未认证，认证后才能进行其他操作！',1);
            }
            $ints = array('display_name','sex','birthdate','education','major','experience','email_notify','height','marriage','nature','current','wage');
            $trims = array('telephone','title','fullname','residence','email','householdaddress','intention_jobs','intention_jobs_id','trade','district','qq','weixin');
            foreach ($ints as $val) {
                $setsqlarr[$val] = I('post.'.$val,0,'intval');
            }
            foreach ($trims as $val) {
                $setsqlarr[$val] = I('post.'.$val,'','trim,badword');
            }
            $resume_count == 0 && $setsqlarr['def'] = 1;
            $rst=D('Resume')->add_resume($setsqlarr,C('visitor'));
            if(!$rst['state']) $this->ajaxReturn(0,$rst['error']);
            $add_tag = I('post.add_tag',0,'intval');
            session('add_tag',$add_tag);
            $this->ajaxReturn(1,'简历创建成功！',array('url'=>U('personal/resume_check',array('pid'=>$rst['id']))));
        }else{
            $category = D('Category')->get_category_cache();
            $get_userprofile=D('MembersInfo')->get_userprofile(array('uid'=>$uid));
            $this->assign('userprofile',$get_userprofile);
            $this->assign('education',$category['QS_education']);//最高学历
            $this->assign('experience',$category['QS_experience']);//工作经验
            $this->assign('current',$category['QS_current']);//目前状态
            $this->assign('jobs_nature',$category['QS_jobs_nature']);//工作性质
            $this->assign('wage',$category['QS_wage']);//期望薪资
            $this->_config_seo(array('title'=>'创建简历 - 个人会员中心 - '.C('qscms_site_name')));
            $this->display();
        }
    }
    /*
    **创建简历成功
    */
    public function resume_check(){
        if(false === $resume = $this->_is_resume()) $this->error('简历不存在或已经删除!');
        $this->_config_seo(array('title'=>'创建简历 - 个人会员中心 - '.C('qscms_site_name')));
        $add_tag = session('add_tag');
        session('add_tag',0);
        $this->assign('add_tag',$add_tag);
        $this->display();
    }
    /*
    **简历管理
    */
    public function resume_list(){
    	$def=D('Resume')->get_resume_list(array('where'=>array('uid'=>C('visitor.uid')),'limit'=>1,'order'=>'def desc,id asc','countinterview'=>true,'countdown'=>true,'countapply'=>true,'views'=>true,'stick'=>true,'strong_tag'=>true));
    	$where = array('uid'=>C('visitor.uid'));
        $def && $where['id'] = array('neq',$def[0]['id']);
        $resume_list=D('Resume')->get_resume_list(array('where'=>$where,'order'=>'id asc','stick'=>true,'strong_tag'=>true));
        $total = count($resume_list)+count($def);
        $surplus = C('qscms_resume_max') - $total;
        $surplus = $surplus<0?0:$surplus;
        $def_resume = $def[0] ? $def[0] : $resume_list[0];
        $this->assign('def_resume',$def_resume);
        $this->assign('resume_list',$resume_list);
        $this->assign('total',$total);
        $this->assign('surplus',$surplus);
        $this->_config_seo(array('title'=>'我的简历 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    /**
     * [resume_create_type 添加简历前，选择简历创建方式]
     */
    public function resume_create_type(){
        $resume_list=D('Resume')->get_resume_list(array('where'=>array('uid'=>C('visitor.uid')),'order'=>'def desc'));
        count($resume_list) >= C('qscms_resume_max') && $this->ajaxReturn(0,'您最多可以创建'.C('qscms_resume_max').'份简历,已经超出了最大限制！');
        $this->assign('resume_list',$resume_list);
        $tpl=$this->fetch('Personal/ajax_tpl/ajax_create_resume');
        $this->ajaxReturn(1,'简历创建方式弹窗获取成功！',$tpl);
    }
    /**
     * [copy_resume 复制简历内容并创建新简历]
     */
    public function copy_resume(){
        $pid = I('get.pid',0,'intval');
        !$pid && $this->error('您没有选择简历！!');
        $reg = D('Resume')->copy_resume($pid,C('visitor'));
        if(!$reg['state']) $this->error($reg['error'],'resume_list');
        $this->redirect('personal/resume_edit',array('pid'=>$reg['id']));
    }
    /*
    **简历修改
    */
    public function resume_edit(){
        if(false === $resume = $this->_is_resume()) $this->error('简历不存在或已经删除!');
        $make = I('request.make',0,'intval');
        $uid=C('visitor.uid');
        if(IS_POST){
            if(1 == $auto_refresh =I('post.auto_refresh',0,'intval')){// 3天内自动刷新
                $auto_mod = M('QueueAutoRefresh');
                $time=time();
                $refreshtime = $time+3600*24*3;
                if(!$auto_mod->where(array('pid'=>$resume['id'],'type'=>2,'refreshtime'=>array('gt',$time)))->getfield('id')){
                    $auto_mod->add(array('uid'=>$uid,'pid'=>$resume['id'],'type'=>2,'refreshtime'=>$refreshtime));
                }else{
                    $auto_mod->where(array('pid'=>$resume['id'],'type'=>2))->setfield('refreshtime',$refreshtime);
                }
            }
            if(1 == $auto_apply=I('post.auto_apply',0,'intval')){// 3天内 自动投递
                if(true !== $reg = D('ResumeEntrust')->set_resume_entrust($resume['id'],$uid)) $this->error($reg);
                D('Resume')->where(array('id'=>$resume['id']))->setfield('entrust',1);
            }
            D('Resume')->check_resume($uid,$resume['id']);//更新简历完成状态
            if(!I('post.make',0,'intval')){
                $this->redirect('personal/resume_list');
            }
            $this->redirect('personal/resume_check',array('pid'=>$resume['id']));
        }
        $resume['tag_key'] = $resume['tag']?explode(',',$resume['tag']):array();
        $resume['tag_cn'] = $resume['tag_cn']?explode(',',$resume['tag_cn']):array();
        $this->assign('resume',$resume);
        $category=D('Category')->get_category_cache();
        $get_resume_img=M('ResumeImg')->where(array('resume_id'=>$resume['id']))->select();//获取简历附件图片
        if($make){
            $title="创建简历";
            $this->assign('make',$make);
        }else{
            $title="修改简历";
        }
        $percent = array('basic'=>35,'intention'=>0,'education'=>15,'work'=>15,'training'=>5,'language'=>5,'credent'=>5,'specialty'=>5,'tag'=>5,'img'=>5,'word'=>0,'photo'=>5);
        $this->assign('h_title',$title);
        $this->assign('category',$category);
        $this->assign('resume_img',$get_resume_img);//获取简历附件图片
        $this->assign('percent',$percent);//撞历完整度列表
        $this->_config_seo(array('title'=>$title.' - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    /**
     * [ajax_save_title 修改简历标题]
     */
    public function ajax_save_title(){
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'简历不存在或已经删除!');
        $title = I('post.title','','trim,badword');
        $rst=D('Resume')->save_resume(array('title'=>$title),$resume['id'],C('visitor'));
        if($rst['state']) $this->ajaxReturn(1,'数据保存成功！');
        $this->ajaxReturn(0,$rst['error']);
    }
    /**
     * [ajax_save_basic_info ajax修改简历基本信息]
     */
    public function ajax_save_basic_info(){
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'简历不存在或已经删除!');
        $ints = array('display_name','sex','birthdate','education','major','experience','email_notify','height','marriage');
        $trims = array('telephone','fullname','residence','email','householdaddress','qq','weixin');
        foreach ($ints as $val) {
            $setsqlarr[$val] = I('post.'.$val,0,'intval');
        }
        foreach ($trims as $val) {
            $setsqlarr[$val] = I('post.'.$val,'','trim,badword');
        }
        $uid=C('visitor.uid');
        if(C('qscms_audit_edit_resume')!="-1") D('ResumeEntrust')->set_resume_entrust($resume['id'],$uid);//添加简历自动投递功能
        $rst=D('Resume')->save_resume($setsqlarr,$resume['id'],C('visitor'));
        if($rst['state']) $this->ajaxReturn(1,'数据保存成功！');
        $this->ajaxReturn(0,$rst['error']);
    }
    /*
    **修改求职意向
    */
    public function ajax_save_basic(){
        $uid=C('visitor.uid');
        $pid = I('post.pid',0,'intval');
        !$pid && $this->ajaxReturn(0,'请选择简历！');
        $setsqlarr['intention_jobs_id']=I('post.intention_jobs_id','','trim,badword');
        $setsqlarr['trade']=I('post.trade','','trim,badword');//期望行业
        $setsqlarr['district']=I('post.district','','trim,badword');//工作地区
        $setsqlarr['nature']=I('post.nature',0,'intval');//工作性质
        $setsqlarr['current']=I('post.current',0,'intval');
        $setsqlarr['wage']=I('post.wage',0,'intval');//期望薪资
        if(C('qscms_audit_edit_resume')!="-1") D('ResumeEntrust')->set_resume_entrust($pid,$uid);//添加简历自动投递功能
        $rst=D('Resume')->save_resume($setsqlarr,$pid,C('visitor'));
        if($rst['state']) $this->ajaxReturn(1,'求职意向修改成功！');
        $this->ajaxReturn(0,$rst['error']);
    }
    /**
     * [_edit_data AJAX获取被修改数据]
     */
    protected function _edit_data($type){
        $id=I('get.id',0,'intval');
        !$id && $this->ajaxReturn(0,'请求缺少参数！');
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'请先填写简历基本信息！');
        $data = M($type)->where(array('id'=>$id,'uid'=>C('visitor.uid'),'pid'=>$resume['id']))->find();
        !$data && $this->ajaxReturn(0,'数据不存在或已经删除！');
        $this->ajaxReturn(1,'数据获取成功！',$data);
    }
    //修改教育经历
    public function edit_education(){
        $this->_edit_data('ResumeEducation');
    }
    //修改工作经历
    public function edit_work(){
        $this->_edit_data('ResumeWork');
    }
    //修改培训经历
    public function edit_training(){
        $this->_edit_data('ResumeTraining');
    }
    //修改语言
    public function edit_language(){
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'请先填写简历基本信息！');
        $uid = C('visitor.uid');
        $language_list = M('ResumeLanguage')->where(array('pid'=>$resume['id'],'uid'=>$uid))->select();
        !$language_list && $language_list = array(array('id'=>0));
        $category=D('Category')->get_category_cache();
        $this->assign('language',$category['QS_language']);
        $this->assign('language_level',$category['QS_language_level']);
        $this->assign('list',$language_list);
        $data['html'] = $this->fetch('Personal/ajax_tpl/ajax_language_edit_list');
        $this->ajaxReturn(1,'语言能力获取成功！',$data);
    }
    //修改证书
    public function edit_credent(){
        $this->_edit_data('resume_credent');
    }
    /**
     * [_del_data 删除简历信息]
     */
    protected function _del_data($type){
        $id = I('request.id',0,'intval');
        $pid = I('request.pid',0,'intval');
        if(!$pid || !$id) $this->ajaxReturn(0,'请求缺少参数！');
        if(IS_POST){
            $uid = C('visitor.uid');
            $user = D('Members')->find($uid);
            if (M($type)->where(array('id'=>$id,'uid'=>$uid,'pid'=>$pid))->delete()){
                switch($type){
                    case 'ResumeEducation':
                        write_members_log($user,2013,$pid);break;
                    case 'ResumeWork':
                        write_members_log($user,2014,$pid);break;
                    case 'ResumeTraining':
                        write_members_log($user,2015,$pid);break;
                    case 'ResumeLanguage':
                        write_members_log($user,2016,$pid);break;
                    case 'ResumeCredent':
                        write_members_log($user,2017,$pid);break;
                }
                $resume_mod = D('Resume');
                $resume_mod->check_resume($uid,$pid);//更新简历完成状态
                $this->ajaxReturn(1,'删除成功！');
            }else{
                $this->ajaxReturn(0,'删除失败！');
            }
        }else{
            switch($type){
                case 'ResumeEducation':
                    $s = '教育经历';break;
                case 'ResumeWork':
                    $s = '工作经历';break;
                case 'ResumeTraining':
                    $s = '培训经历';break;
                case 'ResumeLanguage':
                    $s = '语言能力';break;
                case 'ResumeCredent':
                    $s = '证书';break;
            }
            $tip='删除后将无法恢复，您确定要删除该'.$s.'吗？';
            $this->ajax_warning($tip);
        }
    }
    //删除教育经历
    public function del_education(){
        $this->_del_data('ResumeEducation');
    }
    //删除工作经历
    public function del_work(){
        $this->_del_data('ResumeWork');
    }
    //删除培训经历
    public function del_training(){
        $this->_del_data('ResumeTraining');
    }
    //删除语言能力
    public function del_language(){
        $this->_del_data('ResumeLanguage');
    }
    //删除证书
    public function del_credent(){
        $this->_del_data('ResumeCredent'); 
    }
    /**
    * [_ajax_list ajax获取简历信息列表]
    * @param  [type] $type  [要查的数据表名]
    * @param  [type] $field [要附加的字段名称]
    */
    protected function _ajax_list($type,$fields){
        $pid = I('get.pid',0,'intval');
        !$pid && $this->ajaxReturn(0,'请选择简历！');
        $uid=C('visitor.uid');
        $field=$fields ? 'id,pid,'.$fields : 'id,pid';
        if($dataInfo=M($type)->field($field)->where(array('pid'=>$pid,'uid'=>$uid))->select()){
            $this->assign('list',$dataInfo);
            $data['list'] = 1;
        }
        $data['html'] = $this->fetch('Personal/ajax_tpl/'.strtolower(ACTION_NAME));
        $this->ajaxReturn(1,'数据读取成功！',$data);
    }
    //获取教育经历列表
    public function ajax_get_education_list(){
        $this->_ajax_list('resume_education','startyear,startmonth,endyear,endmonth,school,speciality,education_cn,todate');
    }
    //工作经历
    public function ajax_get_work_list(){
        $this->_ajax_list('resume_work','companyname,jobs,achievements,startyear,startmonth,endyear,endmonth,todate');
    }
    //培训经历
    public function ajax_get_training_list(){
        $this->_ajax_list('resume_training','startyear,startmonth,endyear,endmonth,agency,course,description,todate');
    }
    //语言能力
    public function ajax_get_language_list(){
        $this->_ajax_list('resume_language','language_cn,level_cn');
    }
    //获得证书
    public function ajax_get_credent_list(){
        $this->_ajax_list('resume_credent','name,year,month');
    }
    //添加||修改教育经历
    public function save_education(){
        $setsqlarr['uid'] = C('visitor.uid');
        $setsqlarr['school'] = I('post.school','','trim,badword');
        $setsqlarr['speciality'] = I('post.speciality','','trim,badword');
        $setsqlarr['education'] = I('post.education',0,'intval');
        $setsqlarr['startyear'] = I('post.startyear',0,'intval');
        $setsqlarr['startmonth'] = I('post.startmonth',0,'intval');
        $setsqlarr['endyear'] = I('post.endyear',0,'intval');
        $setsqlarr['endmonth'] = I('post.endmonth',0,'intval');
        $setsqlarr['todate'] = I('post.todate',0,'intval'); // 至今
        // 选择至今就不判断结束时间了
        if ($setsqlarr['todate'] == 1) {
            if(!$setsqlarr['startyear'] || !$setsqlarr['startmonth']) $this->ajaxReturn(0,'请选择就读时间！');
            if($setsqlarr['startyear'] > intval(date('Y'))) $this->ajaxReturn(0,'就读开始时间不允许大于毕业时间！');
            if($setsqlarr['startyear'] == intval(date('Y')) && $setsqlarr['startmonth'] >= intval(date('m'))) $this->ajaxReturn(0,'就读开始时间需小于毕业时间！');
        } else {
            if(!$setsqlarr['startyear'] || !$setsqlarr['startmonth'] || !$setsqlarr['endyear'] || !$setsqlarr['endmonth']) $this->ajaxReturn(0,'请选择就读时间！');

            if($setsqlarr['startyear'] > intval(date('Y'))) $this->ajaxReturn(0,'就读开始时间不允许大于当前时间！');
            if($setsqlarr['startyear'] == intval(date('Y')) && $setsqlarr['startmonth'] >= intval(date('m'))) $this->ajaxReturn(0,'就读开始时间需小于当前时间！');
            if($setsqlarr['endyear'] > intval(date('Y'))) $this->ajaxReturn(0,'就读结束时间不允许大于当前时间！');
            if($setsqlarr['endyear'] == intval(date('Y')) && $setsqlarr['endmonth'] > intval(date('m'))) $this->ajaxReturn(0,'就读结束时间不允许大于当前时间！');

            if($setsqlarr['startyear'] > $setsqlarr['endyear']) $this->ajaxReturn(0,'就读开始时间不允许大于毕业时间！');
            if($setsqlarr['startyear'] == $setsqlarr['endyear'] && $setsqlarr['startmonth'] >= $setsqlarr['endmonth']) $this->ajaxReturn(0,'就读开始时间需小于毕业时间！');
        }
        $education=D('Category')->get_category_cache('QS_education');
        $setsqlarr['education_cn'] = $education[$setsqlarr['education']];
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'请先填写简历基本信息！');
        $setsqlarr['pid'] = $resume['id'];
        $education=M('ResumeEducation')->where(array('pid'=>$setsqlarr['pid'],'uid'=>$setsqlarr['uid']))->count();//获取教育经历数量
        if (count($education)>=6) $this->ajaxReturn(0,'教育经历不能超过6条！');
        if($id=I('post.id',0,'intval')){
            $setsqlarr['id'] = $id;
            $name = 'save_resume_education';
        }else{
            $name = 'add_resume_education';
        }
        $reg = D('ResumeEducation')->$name($setsqlarr,C('visitor'));
        if($reg['state']) {
        	$setsqlarr['id'] = $reg['id'];
        	$this->assign('list',array($setsqlarr));
        	$data['html'] = $this->fetch('Personal/ajax_tpl/ajax_get_education_list');
        	$this->ajaxReturn(1,'教育经历保存成功！',$data);
        }else{
            $this->ajaxReturn(0,$reg['error']);
        }
    }
    //添加||修改工作经历
    public function save_work(){
        $setsqlarr['uid'] = C('visitor.uid');
        $setsqlarr['companyname'] = I('post.companyname','','trim,badword');
        $setsqlarr['achievements'] = I('post.achievements','','trim,badword');
        $setsqlarr['jobs'] = I('post.jobs','','trim,badword');
        $setsqlarr['startyear'] = I('post.startyear',0,'intval');
        $setsqlarr['startmonth'] = I('post.startmonth',0,'intval');
        $setsqlarr['endyear'] = I('post.endyear',0,'intval');
        $setsqlarr['endmonth'] = I('post.endmonth',0,'intval');
        $setsqlarr['todate'] = I('post.todate',0,'intval'); // 至今
        // 选择至今就不判断结束时间了
        if ($setsqlarr['todate'] == 1) {
            if(!$setsqlarr['startyear'] || !$setsqlarr['startmonth']) $this->ajaxReturn(0,'请选择工作时间！');
            if($setsqlarr['startyear'] > intval(date('Y'))) $this->ajaxReturn(0,'工作开始时间不允许大于当前时间！');
            if($setsqlarr['startyear'] == intval(date('Y')) && $setsqlarr['startmonth'] >= intval(date('m'))) $this->ajaxReturn(0,'工作开始时间需小于当前时间！');
        } else {
            if(!$setsqlarr['startyear'] || !$setsqlarr['startmonth'] || !$setsqlarr['endyear'] || !$setsqlarr['endmonth']) $this->ajaxReturn(0,'请选择工作时间！');

            if($setsqlarr['startyear'] > intval(date('Y'))) $this->ajaxReturn(0,'工作开始时间不允许大于当前时间！');
            if($setsqlarr['startyear'] == intval(date('Y')) && $setsqlarr['startmonth'] >= intval(date('m'))) $this->ajaxReturn(0,'工作开始时间需小于当前时间！');
            if($setsqlarr['endyear'] > intval(date('Y'))) $this->ajaxReturn(0,'工作结束时间不允许大于当前时间！');
            if($setsqlarr['endyear'] == intval(date('Y')) && $setsqlarr['endmonth'] > intval(date('m'))) $this->ajaxReturn(0,'工作结束时间不允许大于当前时间！');

            if($setsqlarr['startyear'] > $setsqlarr['endyear']) $this->ajaxReturn(0,'工作开始时间不允许大于结束时间！');
            if($setsqlarr['startyear'] == $setsqlarr['endyear'] && $setsqlarr['startmonth'] >= $setsqlarr['endmonth']) $this->ajaxReturn(0,'工作开始时间需小于结束时间！');
        }
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'请先填写简历基本信息！');
        $setsqlarr['pid'] = $resume['id'];
        $work=M('ResumeWork')->where(array('pid'=>$setsqlarr['pid'],'uid'=>$setsqlarr['uid']))->count();//获取教育经历数量
        if(count($work)>=6) $this->ajaxReturn(0,'工作经历不能超过6条！');
        if($id=I('post.id',0,'intval')){
            $setsqlarr['id'] = $id;
            $name = 'save_resume_work';
        }else{
            $name = 'add_resume_work';
        }
        $reg=D('ResumeWork')->$name($setsqlarr,C('visitor'));
        if($reg['state']) {
        	$setsqlarr['id'] = $reg['id'];
        	$this->assign('list',array($setsqlarr));
        	$data['html'] = $this->fetch('Personal/ajax_tpl/ajax_get_work_list');
        	$this->ajaxReturn(1,'工作经历保存成功！',$data);
        }else{
            $this->ajaxReturn(0,$reg['error']);
        }
    }
    //添加||修改培训经历
    public function save_training(){
        $setsqlarr['uid'] = C('visitor.uid');
        $setsqlarr['agency'] = I('post.agency','','trim,badword');
        $setsqlarr['course'] = I('post.course','','trim,badword');
        $setsqlarr['description'] = I('post.description','','trim,badword');
        $setsqlarr['startyear'] = I('post.startyear',0,'intval');
        $setsqlarr['startmonth'] = I('post.startmonth',0,'intval');
        $setsqlarr['endyear'] = I('post.endyear',0,'intval');
        $setsqlarr['endmonth'] = I('post.endmonth',0,'intval');
        $setsqlarr['todate'] = I('post.todate',0,'intval'); // 至今
        // 选择至今就不判断结束时间了
        if ($setsqlarr['todate'] == 1) {
            if(!$setsqlarr['startyear'] || !$setsqlarr['startmonth']) $this->ajaxReturn(0,'请选择培训时间！');
            if($setsqlarr['startyear'] > intval(date('Y'))) $this->ajaxReturn(0,'培训开始时间不允许大于毕业时间！');
            if($setsqlarr['startyear'] == intval(date('Y')) && $setsqlarr['startmonth'] >= intval(date('m'))) $this->ajaxReturn(0,'培训开始时间需小于毕业时间！');
        } else {
            if(!$setsqlarr['startyear'] || !$setsqlarr['startmonth'] || !$setsqlarr['endyear'] || !$setsqlarr['endmonth']) $this->ajaxReturn(0,'请选择培训时间！');
            if($setsqlarr['startyear'] > intval(date('Y'))) $this->ajaxReturn(0,'培训开始时间不允许大于当前时间！');
            if($setsqlarr['startyear'] == intval(date('Y')) && $setsqlarr['startmonth'] >= intval(date('m'))) $this->ajaxReturn(0,'培训开始时间需小于当前时间！');
            if($setsqlarr['endyear'] > intval(date('Y'))) $this->ajaxReturn(0,'培训结束时间不允许大于当前时间！');
            if($setsqlarr['endyear'] == intval(date('Y')) && $setsqlarr['endmonth'] > intval(date('m'))) $this->ajaxReturn(0,'培训结束时间不允许大于当前时间！');
            if($setsqlarr['startyear'] > $setsqlarr['endyear']) $this->ajaxReturn(0,'培训开始时间不允许大于毕业时间！');
            if($setsqlarr['startyear'] == $setsqlarr['endyear'] && $setsqlarr['startmonth'] >= $setsqlarr['endmonth']) $this->ajaxReturn(0,'培训开始时间需小于毕业时间！');
        }
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'请先填写简历基本信息！');
        $setsqlarr['pid'] = $resume['id'];
        $training=M('ResumeTraining')->where(array('pid'=>$setsqlarr['pid'],'uid'=>$setsqlarr['uid']))->count();//获取教育经历数量
        if(count($training)>=6) $this->ajaxReturn(0,'培训经历不能超过6条！');
        if($id=I('post.id',0,'intval')){
            $setsqlarr['id'] = $id;
            $name = 'save_resume_training';
        }else{
            $name = 'add_resume_training';
        }
        $reg=D('ResumeTraining')->$name($setsqlarr,C('visitor'));
        if($reg['state']) {
        	$setsqlarr['id'] = $reg['id'];
        	$this->assign('list',array($setsqlarr));
        	$data['html'] = $this->fetch('Personal/ajax_tpl/ajax_get_training_list');
        	$this->ajaxReturn(1,'培训经历保存成功！',$data);
        }else{
            $this->ajaxReturn(0,$reg['error']);
        }
    }
    //添加修改语言能力
    public function save_language(){
    	if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'请先填写简历基本信息！');
    	$uid = C('visitor.uid');
    	$language = I('post.language');
    	if (count($language)>6) $this->ajaxReturn(0,'语言能力不能超过6条！');
        M('ResumeLanguage')->where(array('pid'=>$resume['id'],'uid'=>$uid))->delete();
    	$category=D('Category')->get_category_cache();
        foreach ($language as $key=>$val){
            $language['language'] = intval($val);
        	if($language_list[$language['language']]) continue;
            $language['uid'] = $uid;
        	$language['pid'] = $resume['id'];
        	$language['level'] = intval($_POST['level'][$key]);
        	$language['language_cn'] = $category['QS_language'][$language['language']];
        	$language['level_cn'] = $category['QS_language_level'][$language['level']];
        	if(!$language['id']=D('ResumeLanguage')->add_resume_language($language,C('visitor'))) {
        		$this->ajaxReturn(0,'语言能力保存失败！');
        	}
            $language_list[$language['language']] = $language;
        }
        $this->assign('list',$language_list);
        $data['html'] = $this->fetch('Personal/ajax_tpl/ajax_get_language_list');
        $this->ajaxReturn(1,'语言能力保存成功！',$data);
    }
    //添加||修改获得证书
    public function save_credent(){
        $setsqlarr['uid'] = C('visitor.uid');
        $setsqlarr['name'] = I('post.name','','trim,badword');
        $setsqlarr['year'] = I('post.year','','trim,badword');
        $setsqlarr['month'] = I('post.month','','trim,badword');
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'请先填写简历基本信息！');

        if(!$setsqlarr['year'] || !$setsqlarr['month']) $this->ajaxReturn(0,'请选择获得证书时间！');
        if($setsqlarr['year'] > intval(date('Y'))) $this->ajaxReturn(0,'获得证书时间不能大于当前时间！');
        if($setsqlarr['year'] == intval(date('Y')) && $setsqlarr['month'] > intval(date('m'))) $this->ajaxReturn(0,'获得证书时间不能大于当前时间！');
       
        $setsqlarr['pid'] = $resume['id'];
        $credent=M('ResumeCredent')->where(array('pid'=>$setsqlarr['pid'],'uid'=>$setsqlarr['uid']))->count();//获取证书数量
        if(count($credent)>=6) $this->ajaxReturn(0,'证书不能超过6条！');
        if($id=I('post.id',0,'intval')){
            $setsqlarr['id'] = $id;
            $name = 'save_resume_credent';
        }else{
            $name = 'add_resume_credent';
        }
        $reg=D('ResumeCredent')->$name($setsqlarr,C('visitor'));
        if($reg['state']) {
        	$setsqlarr['id'] = $reg['id'];
        	$this->assign('list',array($setsqlarr));
        	$data['html'] = $this->fetch('Personal/ajax_tpl/ajax_get_credent_list');
        	$this->ajaxReturn(1,'证书保存成功！',$data);
        }else{
            $this->ajaxReturn(0,$reg['error']);
        }
    }
    /*
    **自我描述
    */
    public function ajax_save_specialty(){
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'请先填写简历基本信息！');
        $specialty = I('post.specialty','','trim,badword');
        !$specialty && $this->ajaxReturn(0,'请输入自我描述!');
        $rst=D('Resume')->save_resume(array('specialty'=>$specialty),$resume['id'],C('visitor'));
        if(!$rst['state']) $this->ajaxReturn(0,$rst['error']);
        write_members_log(C('visitor'),2027,$pid);
        $this->ajaxReturn(1,'简历自我描述修改成功');
    }
    /*
    **特长标签start
    */
    public function ajax_save_tag(){
        $pid = I('post.pid',0,'intval');
        !$pid && $this->ajaxReturn(0,'请正确选择简历！');
        $uid=C('visitor.uid');
        $tag_cn = I('post.tag_cn','','badword');
        $setarr['tag_cn']=$tag_cn?implode(",", $tag_cn):'';
        $tag=I('post.tag','','badword');
        $setarr['tag']=$tag?implode(",", $tag):'';
        $tags=D('Category')->get_category_cache('QS_resumetag');
        foreach ($tag as $key => $val) {
            $setarr['tag_cn'].=",{$tags[$val]}";
        }
        $setarr['tag_cn'] = ltrim($setarr['tag_cn'],',');
        if(!$setarr['tag_cn']) $s = 2;
        $resume_mod = D('Resume');
        if(false !== $resume_mod->where(array('id'=>$pid,'uid'=>$uid))->save($setarr)){
            $resume_mod->check_resume($uid,$pid);//更新简历完成状态
            //写入会员日志
            write_members_log(C('visitor'),2028,$pid);
            $this->ajaxReturn(1,'简历特长标签修改成功！');
        } 
        $this->ajaxReturn(0,'保存失败！');
    }
    /*
    **删除简历附件
    */
    public function ajax_resume_img_del(){
        if(IS_POST){
            $img_id = I('request.id',0,'intval');
            !$img_id && $this->ajaxReturn(0,'请选择要删除的图片！');
            $uid = C('visitor.uid');
            $img_mod = M('ResumeImg');
            $row=$img_mod->where(array('id'=>$img_id,'uid'=>$uid))->field('img,resume_id')->find();
            $size = explode(',',C('qscms_resume_img_size'));
            if(strpos($row['img'], '..') !== false) $this->ajaxReturn(0,'参数错误！');
            @unlink(C('qscms_attach_path')."photo/".$row['img']);
            foreach ($size as $val) {
                @unlink(C('qscms_attach_path')."photo/{$row['img']}_{$val}x{$val}.jpg");
            }
            if(false === $img_mod->where(array('id'=>$img_id,'uid'=>$uid))->delete()) $this->ajaxReturn(0,'删除失败！');
            //写入会员日志
            write_members_log(C('visitor'),2029,intval($row['resume_id']));
            D('Resume')->check_resume(C('visitor.uid'),intval($row['resume_id']));//更新简历完成状态
            $this->ajaxReturn(1,'删除成功！');
        }else{
            $tip='删除后将无法恢复，您确定要删除该条数据吗？';
            $this->ajax_warning($tip);
        }
    }
    /**
     * [ajax_resume_attach 保存附件]
     */
    public function ajax_resume_attach(){
        if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'简历不存在！');
        $img_mod = M('ResumeImg');
        $data['resume_id'] = $resume['id'];
        $data['id'] = I('post.id',0,'intval');
        $data['uid'] = C('visitor.uid');
        $img = $img_mod->where(array('uid'=>$data['uid'],'id'=>$data['id'],'resume_id'=>$data['resume_id']))->find();
        if(!$img){
            $this->ajaxReturn(0,'作品不存在！');
        }
        $data['title'] = I('post.title','','trim,badword');
        $data['img'] = $img['img'];
        
        // if($data['id']==0){
        //     $count = M('ResumeImg')->where(array('resume_id'=>$resume['id'],'uid'=>C('visitor.uid')))->count('id');
        //     if($count >= 6) $this->ajaxReturn(0,'简历附件最多只可上传6张！');
        // }
        $reg = D('ResumeImg')->save_resume_img($data);
        if($reg['state'])
        {
            D('Resume')->check_resume(C('visitor.uid'),intval($data['resume_id']));//更新简历完成状态
            $this->ajaxReturn(1,'附件添加成功！',$reg['id']);
        }
        $this->ajaxReturn(0,$reg['error']);
    }
    /*
    **删除word简历
    */
    public function ajax_word_del(){
        $warning = I('request.warning',0,'intval');
        if($warning){
            $tip='删除后将无法恢复，您确定要删除该word简历吗？';
            $this->ajax_warning($tip);
        }else{
            if(false === $resume = $this->_is_resume()) $this->ajaxReturn(0,'简历不存在！');
            if($resume['word_resume']){
                @unlink(C('qscms_attach_path')."word_resume/".$resume['word_resume']);
                $resume_mod = D('Resume');
                if(false === $resume_mod->where(array('id'=>$resume['id']))->setfield('word_resume','')) $this->ajaxReturn(1,'删除失败！');
                //写入会员日志
                write_members_log(C('visitor'),2031,intval($resume['id']));
                $resume_mod->check_resume(C('visitor.uid'),$resume['id']);//更新简历完成状态
                $this->ajaxReturn(1,'删除成功！');
            }
            $this->ajaxReturn(0,'word简历已删除或不存在！');
        }
    }
    /**
     * [resume_outward 简历外发]
     */
    public function resume_outward(){
        $resume_list = D('Resume')->get_resume_list(array('where'=>array('uid'=>C('visitor.uid')),'field'=>'id,title,audit','_audit'=>1));
        $this->assign('resume_list',$resume_list);
        $this->_config_seo(array('title'=>'外发简历 - 个人会员中心 - '.C('qscms_site_name')));
        $this->assign('personal_nav','resume_list');
        $this->display();
    }
    /**
     * [outward_save 简历外发 保存]
     */
    public function outward_save(){
        //保存外发记录
        $setsqlarr['resume_id'] = I('post.resume_id',0,'intval');
        if(false === $resume = $this->_is_resume($setsqlarr['resume_id'])) $this->ajaxReturn(0,'简历不存在或已经删除!');
        $setsqlarr['resume_title'] = $resume['title'];
        $setsqlarr['email']=I('post.email','','trim,badword');
        $setsqlarr['companyname']=I('post.companyname','','trim,badword');
        $setsqlarr['jobs_name']=I('post.jobs_name','','trim,badword');

        //验证邮箱是否正确
        $resume_tpl = D('Resume')->get_outward_resumes_tpl(C('visitor.uid'),$setsqlarr['resume_id']);
        $error = 0;
        $success = 0;
        $setsqlarr['uid']=C('visitor.uid');
        $setsqlarr['addtime']=time();
        $send_mail['sendto_email']=$setsqlarr['email'];
        $send_mail['subject']=$setsqlarr['resume_title'];
        $send_mail['body']=$resume_tpl;
        $reg = D('Mailconfig')->send_mail($send_mail);
        if($reg===false){
            $this->ajaxReturn(0,'发送失败！');
        }else{
            //添加简历外发记录
            $oid=M('ResumeOutward')->add($setsqlarr);
            if($oid){
                //写入会员日志
                write_members_log(C('visitor'),2032,$setsqlarr['resume_id'],$setsqlarr['email']);
                $this->ajaxReturn(1,'发送成功！');
            }
        }
    }
    /**
     * [outward_save 简历外发记录列表]
     */
    public function outward(){
        $uid=C('visitor.uid');
        $whereo['uid']=$uid;
        //筛选 相关简历
        $resume_id =I('get.resume_id',0,'intval');
        if($resume_id>0) $whereo['resume_id']=$resume_id;
        //筛选 发送时间
        $settr=I('get.settr',0,'intval');
        if($settr>0){
            $settr_val=strtotime("-".$settr." day");
            $whereo['addtime']=array('gt',$settr_val);
        }
        $perpage=10;
        $resume_outward=M('ResumeOutward');
        $total_val=$resume_outward->where($whereo)->count();
        $pager =  pager($total_val, $perpage);
        $rst['list'] = $resume_outward->where($whereo)->limit($pager->firstRow . ',' . $pager->listRows)->select();
        $rst['page'] = $pager->fshow();
        $this->assign('outward',$rst);
        $resume_list=$resume_outward->where(array('uid'=>$uid))->group('resume_id')->getfield('resume_id,resume_title');
        $this->assign('resume_list',$resume_list);
        $this->assign('personal_nav','resume_list');
        $this->assign('resume_id',$resume_id);
        $this->display();
    }
    /**
     * [del_outward 删除外发简历记录]
     */
    public function del_outward(){
        if(IS_AJAX){
            $tip='删除后将无法恢复，您确定要删除选中的外发记录吗？';
            $this->ajax_warning($tip);
        }else{
            $yid =I('request.y_id',0,'trim');
            !$yid && $this->error('你没有选择项目！',U('outward'));
            $yid = is_array($yid)?implode(',',$yid):$yid;
            if (!fieldRegex($yid,'in')) $this->error('请正确选简历外发记录!',U('outward'));
            $num = M('ResumeOutward')->where(array('id'=>array('in',$yid)))->delete();
            if (!$num) $this->error('删除失败！',U('outward'));
            //写入会员日志
            write_members_log(C('visitor'),2033,$yid);
            $this->success("删除成功！共删除 {$num} 行",U('outward'));
        }
    }
    /*
        面试邀请 start
    */
    public function jobs_interview()
    {
        $this->check_params();
        $where['resume_uid']= C('visitor.uid');
        $look=I('get.look',0,'intval');
        $look && $where['personal_look'] = $look;
        $resume_id = I('get.resume_id',0,'intval');
        $resume_id && $where['resume_id'] =$resume_id;
        $settr = I('get.settr',0,'intval');
        if($settr > 0)
        {
            $settr_val=strtotime("-{$settr} day");
            $where['interview_addtime']=array('EGT',$settr_val);
        }
        $company_interview_mod = D('CompanyInterview');
        $interview = $company_interview_mod->get_invitation_pre($where);
        // 最近三天收到的面试邀请数
        $count_three_day = $company_interview_mod->where(array('resume_uid'=>C('visitor.uid'),'interview_addtime'=>array('egt',strtotime('-3 day'))))->count();

        $this->assign('count_three_day',$count_three_day);
        $this->assign('resume_list',M('Resume')->where(array('uid'=>C('visitor.uid')))->group('id')->getfield('id,title'));
        $this->assign('interview',$interview);
        $this->assign('resume_id',$resume_id);
        $this->assign('look',$look);
        $this->assign('settr',$settr);
        $this->assign('personal_nav','apply');
        $this->_config_seo(array('title'=>'收到的面试邀请 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    // ajax 获取面试邀请 详情 
    public function ajax_interview_detail(){
        if(IS_AJAX){
            $id = I('get.id',0,'intval');
            !$id && $this->ajaxReturn(0,'请正确选择面试信息！');
            $interview = M('CompanyInterview')->where(array('did'=>$id,'resume_uid'=>C('visitor.uid')))->find();
            !$interview && $this->ajaxReturn(0,'面试信息不存在！');
            M('CompanyInterview')->where(array('did'=>$id,'resume_uid'=>C('visitor.uid')))->setField('personal_look',2);
            $this->assign('interview',$interview);
            $html = $this->fetch('Company/ajax_tpl/ajax_show_interview');
            $this->ajaxReturn(1,'面试信息获取成功！',$html);
        }
    }
    // 删除面试邀请
    public function interview_del()
    {
        if(IS_AJAX)
        {
            $tip='删除后将无法恢复，您确定要删除选中的面试邀请吗？';
            $this->ajax_warning($tip);
        }
        else
        {
            $yid= I('request.y_id','','trim,badword');
            !$yid && $this->error("你没有选择项目！");
            $rst = D('CompanyInterview')->del_interview($yid,C('visitor'));
            if(intval($rst['state']) == 1)
            {
                $this->success("删除成功！共删除 ".$rst['num']." 行！",U('personal/jobs_interview'));
            }
            else
            {
                $this->error("删除失败！",U('personal/jobs_interview'));
            }
        }
    }
    // 面试邀请设为已看
    public function set_interview(){
        $yid= I('request.y_id','','trim,badword');
        !$yid && $this->error("你没有选择项目！");
        $jobs_type = I('get.jobs_type',0,'intval');
        $rst=D('CompanyInterview')->set_invitation($yid,C('visitor'),2);
        if(!$rst['state']) $this->ajaxReturn(0,$rst['error']);
        $this->ajaxReturn(1,'设置成功！');
    }
    /*
        已申请的职位 start
    */
    public function jobs_apply()
    {
        $this->check_params();
        $where['personal_uid']=C('visitor.uid');
        $resume_id =I('get.resume_id',0,'intval');
        $resume_id && $where['resume_id']=$resume_id; //筛选简历
        $settr=I('get.settr',0,'intval');
        $settr && $where['apply_addtime']=array('gt',strtotime("-".$settr." day")); //筛选 申请时间
        //筛选 反馈
        $feedbackArr = array(1=>'企业未查看',2=>'待反馈',3=>'合适',4=>'不合适',5=>'待定',6=>'未接通');
        $feedback=I('get.feedback',0,'intval');
        switch ($feedback) 
        {
            case 1:
                $where['personal_look']=1;
                break;
            case 2:
                $where['personal_look']=2;
                $where['is_reply']=0;
                break;
            case 3:
                $where['personal_look']=2;
                $where['is_reply']=1;
                break;
            case 4:
                $where['personal_look']=2;
                $where['is_reply']=2;
                break;
            case 5:
                $where['personal_look']=2;
                $where['is_reply']=3;
                break;
            case 6:
                $where['personal_look']=2;
                $where['is_reply']=4;
                break;
            default:
                break;
        }
        $personal_apply_mod = D('PersonalJobsApply');
        $apply_list = $personal_apply_mod->get_apply_jobs($where);
        $this->assign('feedback',$feedback);
        $this->assign('settr',$settr);
        $this->assign('resume_id',$resume_id);
        $this->assign('feedbackArr',$feedbackArr);
        $this->assign('resume_list',M('Resume')->where(array('uid'=>C('visitor.uid')))->getfield('id,title'));
        $this->assign('apply_list',$apply_list);
        $this->assign('resume_id',$resume_id);
        $this->assign('personal_nav','apply');
        $this->_config_seo(array('title'=>'已申请的职位 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    // 删除已申请职位
    public function del_jobs_apply()
    {
        if(IS_AJAX){
            $tip='删除后将无法恢复，您确定要删除选中的职位吗？';
            $this->ajax_warning($tip);
        }else{
            $yid= I('request.y_id','','trim,badword');
            !$yid && $this->error("你没有选择项目！");
            $n=D('PersonalJobsApply')->del_jobs_apply($yid,C('visitor'));
            if($n['state']==1)
            {
                $this->success("删除成功！");
            }
            else
            {
                $this->error("删除失败！");
            }
        }
    }
    /**
     *  职位收藏夹
     */
    public function jobs_favorites(){
        $this->check_params();
        $where['personal_uid']=C('visitor.uid');
        $settr=I('get.settr',0,'intval');
        $settr && $where['addtime']=array('gt',strtotime("-".$settr." day")); //筛选 收藏时间
        $favorites = D('PersonalFavorites')->get_favorites($where);
        $this->assign('favorites',$favorites);
        $this->_config_seo(array('title'=>'职位收藏夹 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    /**
     * 删除收藏 职位
     */
    public function del_favorites(){
        if(IS_AJAX){
            $tip='删除后将无法恢复，您确定要删除选中的职位吗？';
            $this->ajax_warning($tip);
        }else{
            $did= I('request.did','','trim,badword');
            !$did && $this->error("你没有选择项目！");
            $reg=D('PersonalFavorites')->del_favorites($did,C('visitor'));
            if($reg['state']===true){
                $this->success("删除成功！",U('jobs_favorites'));
            }else{
                $this->error($reg['error']);
            }
        }
    }
    /**
     * 简历被查看/谁在关注我
     */
    public function attention_me()
    {
        $this->check_params();
        $resume_list = M('Resume')->where(array('uid'=>C('visitor.uid')))->getfield('id,title');
        $resume_id =I('get.resume_id',0,'intval');
        if($resume_id){
            $where['resumeid']=$resume_id; //筛选简历
        }else{
            $where['resumeid']=array('in',array_keys($resume_list));
        }
        $settr=I('get.settr',0,'intval');
        $settr && $where['addtime']=array('gt',strtotime("-".$settr." day")); //筛选 查看时间
        $view_list = D('ViewResume')->get_view_resume($where);//获取列表
        $this->assign('view_list',$view_list);
        $this->assign('resume_id',$resume_id);   
        $this->assign('settr',$settr);  
        $this->assign('personal_nav','apply');
        $this->assign('resume_list',$resume_list);
        $this->_config_seo(array('title'=>'简历被查看 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    /**
     * 删除谁在关注我
     */
    public function del_view_resume()
    {
        if(IS_AJAX){
            $tip='删除后将无法恢复，您确定要删除被关注记录吗？';
            $this->ajax_warning($tip);
        }else{
            $yid= I('request.y_id','','trim,badword');
            !$yid && $this->error("你没有选择项目！");
            $reg=D('ViewResume')->del_view_resume($yid);
            if($reg['state']==1){
                //写入会员日志
                $yid = is_array($yid)?implode(",", $yid):$yid;
                write_members_log(C('visitor'),2036,$yid);
                $this->success("删除成功！",U('attention_me'));
            }else{
                $this->error("删除失败！",U('attention_me'));
            }
        }
    }
    /**
     *  浏览过的职位
     */
    public function attention_jobs()
    {
        $this->check_params();
        $where['uid']=C('visitor.uid');
        $settr=I('get.settr',0,'intval');
        $settr && $where['addtime']=array('gt',strtotime("-".$settr." day")); //筛选 查看时间
        $jobs_list = D('ViewJobs')->get_view_jobs($where);//获取列表
        $this->assign('jobs_list',$jobs_list);
        $this->assign('settr',$settr);  
        $this->assign('personal_nav','apply');
        $this->_config_seo(array('title'=>'浏览记录 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    /**
     * 删除浏览过的职位
     */
    public function del_view_jobs(){
        if(IS_AJAX){
            $tip='删除后将无法恢复，您确定要删除选中的职位吗？';
            $this->ajax_warning($tip);
        }else{
            $yid= I('request.y_id','','trim,badword');
            !$yid && $this->error("你没有选择项目！");
            $reg = D('ViewJobs')->del_view_jobs($yid);
            if($reg['state']==1){
                //写入会员日志
                $yid = is_array($yid)?implode(",", $yid):$yid;
                write_members_log(C('visitor'),2037,$yid);
                $this->success("删除成功！",U('attention_jobs'));
            }else{
                $this->error("删除失败！",U('attention_jobs'));
            }
        }
    }

    /**
     * [userprofile 基本信息]
     */
    public function user_info(){
        $uid = C('visitor.uid');
        $userprofile=D('MembersInfo')->get_userprofile(array('uid'=>$uid));
        if(IS_POST){
        	$setsqlarr['__hash__'] = I('post.__hash__');
        	$ints = array('sex','birthday','residence','education','major','experience','height','marriage','display_name','photo_display');
            $trims = array('phone','email','realname','residence','householdaddress','qq','weixin');
            foreach ($ints as $val) {
                $setsqlarr[$val] = I('post.'.$val,0,'intval');
            }
            foreach ($trims as $val) {
                $setsqlarr[$val] = I('post.'.$val,'','trim,badword');
            }
            $sex = array('1'=>'男','2'=>'女');
            $marriage = array('1'=>'未婚','2'=>'已婚','3'=>'保密');
            $setsqlarr['sex_cn']=$sex[$setsqlarr['sex']];
            $setsqlarr['marriage_cn']=$marriage[$setsqlarr['marriage']];
            $category = D('Category')->get_category_cache();
            $setsqlarr['education_cn']=$category['QS_education'][$setsqlarr['education']];
            $setsqlarr['experience_cn']=$category['QS_experience'][$setsqlarr['experience']];
            if($setsqlarr['major']){
                $major_category = D('CategoryMajor')->get_major_list();
                $setsqlarr['major_cn'] = $major_category[$setsqlarr['major']]['categoryname'];
            }
            $setsqlarr['uid']=$uid;
            if(!C('visitor.mobile_audit')){
                $setsqlarr['phone']=I('post.phone','','trim');
            }
            if(!C('visitor.email_audit')){
                $setsqlarr['email']=I('post.email','','trim');
            }
            if($setsqlarr['photo_display'] == 1){
                $setsqlarr['photo'] = 1;
            }else{
                $setsqlarr['photo'] = 0;
            }
            $name = $userprofile ? 'save_userprofile' : 'add_userprofile';
            $reg = D('MembersInfo')->$name($setsqlarr,C('visitor'));
            if(!$reg['state']) $this->ajaxReturn(0,$reg['error']);
            if(true !== $reg = D('Members')->update_user_info($setsqlarr,C('visitor'))) $this->ajaxReturn(0,$reg);
            write_members_log(C('visitor'),2043);
            $this->ajaxReturn(1,'个人资料保存成功！');
        }else{
            $category=D('Category')->get_category_cache();
            $this->assign('userprofile',$userprofile);
            $this->assign('education',$category['QS_education']);//最高学历
            $this->assign('experience',$category['QS_experience']);//工作经验
            $this->_config_seo(array('title'=>'个人资料 - 个人会员中心 - '.C('qscms_site_name')));
            $this->display();
        }
    }
    /**
     * [authenticate 账号安全]
     */
    public function user_safety(){
        $uid=C('visitor.uid');
        $user_bind = M('MembersBind')->where(array('uid'=>$uid))->limit('10')->getfield('type,keyid,info');
        foreach($user_bind as $key=>$val){
        	$user_bind[$key] = unserialize($val['info']);
        }
        if(false === $oauth_list = F('oauth_list')){
            $oauth_list = D('Oauth')->oauth_cache();
        }
        $this->assign('members_info',D('Members')->get_user_one(array('uid'=>$uid)));
        $this->assign('user_bind',$user_bind);
        $this->assign('oauth_list',$oauth_list);
        $this->assign('personal_nav','user_info');
        $this->_config_seo(array('title'=>'账号安全 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    /**
     * [avatar 头像修改]
     */
    public function user_avatar(){
        $this->_config_seo(array('title'=>'个人头像 - 个人会员中心 - '.C('qscms_site_name')));
        $this->assign('personal_nav','user_info');
        $this->display();
    }
    /*
    **登录日志
    */
    public function user_loginlog(){
        $where = array('log_uid'=>C('visitor.uid'),'log_type'=>1001);
        $loginlog = D('MembersLog')->get_members_log($where,15);
        $this->assign('loginlog',$loginlog);
        $this->assign('personal_nav','user_info');
        $this->_config_seo(array('title'=>'会员登录日志 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    /**
     * 关注的企业
     */
    public function attention_com(){
        $this->check_params();
    	$company = D('PersonalFocusCompany')->get_focus_company(array('uid'=>C('visitor.uid')),10,true);
    	$this->assign('company',$company);
    	$this->assign('personal_nav','jobs_favorites');
    	$this->_config_seo(array('title'=>'关注的企业 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    /**
     * 删除关注的企业
     */
    public function del_focus_company(){
    	if(IS_POST){
    		$id = I('request.id',0,'intval');
    		!$id && $this->ajaxReturn(0,'请选择要删除的企业！');
    		$reg = M('PersonalFocusCompany')->where(array('uid'=>C('visitor.uid'),'company_id'=>$id))->delete();
            if($reg===false){
                $this->ajaxReturn(0,'删除失败，请重新操作！');
            }
            //写入会员日志
            write_members_log(C('visitor'),2038,$id);
    		$this->ajaxReturn(1,'成功删除关注的企业！');
    	}else{
            $tip='取消关注后将不再接收该企业的招聘动态，您确定要取消关注吗？';
            $this->ajax_warning($tip);
        }
    }
    /**
     * 职位订阅器
     */
    public function jobs_subscribe(){
    	$subscribe = D('PersonalJobsSubscribe')->get_subscribe(array('uid'=>C('visitor.uid')));
    	$this->assign('subscribe',$subscribe);
    	$this->assign('total',count($subscribe['list']));
    	$this->assign('personal_nav','jobs_favorites');
        $this->_config_seo(array('title'=>'职位订阅器 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    /**
     * 添加职位订阅器
     */
    public function jobs_subscribe_edit(){
    	if(IS_POST && IS_AJAX){
    		$reg = D('PersonalJobsSubscribe')->edit_subscribe(C('visitor'),I('request.id',0,'intval'));
    		if(false === $reg['state']) $this->ajaxReturn(0,$reg['error']);
            $this->ajaxReturn(1,'职位订阅器保存成功！');
    	}else{
    		if($id = I('get.id',0,'intval')){
    			$subscribe = M('PersonalJobsSubscribe')->where(array('id'=>$id,'uid'=>C('visitor.uid')))->find();
    			$this->assign('subscribe',$subscribe);
    		}
    		$wage=D('Category')->get_category_cache('QS_wage');
    		$this->assign('wage',$wage);
    		$this->assign('personal_nav','jobs_favorites');
    		$this->_config_seo(array('title'=>'职位订阅器 - 个人会员中心 - '.C('qscms_site_name')));
    		$this->display();
    	}
    }
    /**
     * 退订职位订阅器
     */
    public function subscribe_del(){
    	if(!IS_POST){
            $tip='删除后将无法恢复，您确定要删除该订阅器吗？';
            $this->ajax_warning($tip);
        }else{
    		$id = I('request.id',0,'intval');
    		!$id && $this->ajaxReturn(0,'请选择订阅器！');
    		$reg = M('PersonalJobsSubscribe')->where(array('id'=>$id,'uid'=>C('visitor.uid')))->delete();
            if($reg){
                //写入会员日志
                write_members_log(C('visitor'),2040,$id);
                $this->ajaxReturn(1,'删除成功!');
            }
    		false === $reg && $this->ajaxReturn(0,'删除失败，请重新操作！');
    		$this->ajaxReturn(0,'订阅器不存在或已经删除！');
    	}
    }
    /**
     * 订阅职位订阅器
     */
    public function subscribe_switch(){
    	if(IS_AJAX){
    		$id = I('get.id',0,'intval');
    		!$id && $this->ajaxReturn(0,'请选择订阅器！');
    		$switch = I('get.switchs',0,'intval');
    		$reg = M('PersonalJobsSubscribe')->where(array('id'=>$id,'uid'=>C('visitor.uid')))->setfield('status',$switch);
            if($reg){
                //写入会员日志
                write_members_log(C('visitor'),2041,$id);
                $this->ajaxReturn(1,'操作成功!');
            }
    		false === $reg && $this->ajaxReturn(0,'操作失败，请重新操作！');
    		$this->ajaxReturn(0,'订阅器不存在或已经删除！');
    	}
    }
    /**
     * 系统消息提醒
     */
    public function msg_pms(){
        $settr = I('get.settr',0,'intval');
        $new = I('get.new',0,'intval');
        $map = array();
        if($settr>0){
            $tmp_addtime = strtotime('-'.$settr.' day');
            $map['dateline'] = array('egt',$tmp_addtime);
        }
        if($new>0){
            $map['new'] = $new;
        }
        $msg = D('Pms')->update_pms_read(C('visitor'),10,$map);
        $this->assign('msg',$msg);
        $this->_config_seo(array('title'=>'消息提醒 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    /**
     * [msg_check 系统消息查看]
     */
    public function msg_check(){
        $ids = I('request.id','','trim');
        $reg = D('Pms')->msg_check($ids,C('visitor'));
        if($reg['state']){
            $this->assign('msg',$reg['data']);
            $html = $this->fetch('Personal/ajax_tpl/ajax_show_message');
            $this->ajaxReturn(1,'系统信息获取成功！',$html);
        }else{
            $this->ajaxReturn(0,$reg['error']);
        }
    }
    /**
     * [msg_del 系统消息删除]
     */
    public function msg_del(){
        if(!IS_POST){
            $tip='删除后将无法恢复，您确定要删除选择的系统消息吗？';
            $this->ajax_warning($tip);
        }else{
            $ids = I('request.id',0,'intval');
            $reg = D('Pms')->msg_del($ids,C('visitor'));
            if($reg['state']){
                IS_AJAX && $this->ajaxReturn(1,'删除成功！');
                $this->success('删除成功！');
            }else{
                IS_AJAX && $this->ajaxReturn(0,'删除失败！');
                $this->error('删除失败！');
            }
        }
    }
    /**
     * 咨询反馈
     */
    public function msg_feedback(){
        $msg_list = D('Msg')->msg_list(C('visitor'));
        $this->assign('msg_list',$msg_list);
        $this->_config_seo(array('title'=>'咨询反馈 - 个人会员中心 - '.C('qscms_site_name')));
        $this->display();
    }
    /**
     * [msg_feedback_send 发送咨询反馈]
     */
    public function msg_feedback_send(){
        if(IS_AJAX){
            $data['pid'] = I('post.pid',0,'intval');
            $data['touid'] = I('post.touid',0,'intval');
            $data['message'] = I('post.message','','trim');
            $reg = D('Msg')->msg_send($data,C('visitor'));
            if($reg['state']) $this->ajaxReturn(1,'消息发送成功！',$reg['data']);
            $this->ajaxReturn(0,$reg['error']);
        }
    }
    /**
     * [msg_feedback_del 删除咨询反馈]
     */
    public function msg_feedback_del(){
        if(!IS_POST){
            $tip='删除后将无法恢复，您确定要删除选择的咨询消息吗？';
            $this->ajax_warning($tip);
        }else{
            $ids = I('post.id',0,'intval');
            $reg = D('Msg')->msg_del($ids,C('visitor'));
            $this->ajaxReturn($reg['state'],$reg['tip']);
        }
    }
}
?>