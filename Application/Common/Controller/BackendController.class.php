<?php
/**
 * 后台控制器基类
 *
 * @author andery
 */
namespace Common\Controller;
use Common\Controller\BaseController;
class BackendController extends BaseController{
    protected $_name = '';
    protected $_map = array();
    protected $menuid = 0;
    protected $pid = 0;
    public function _initialize() {
        parent::_initialize();
        $this->_name = $this->getActionName();
        
       
        $this->check_priv();
        if(!$this->menuid){ 
            $this->menuid = I('request.menuid',0,'intval');
           
        }
      //  dump($this->menuid);  为什么是6 不是1
        if($this->menuid) {
            
            $sub_menu = $this->get_menus($this->menuid);
            if($sub_menu['menu']){//默认页面导航选中样式
                foreach($sub_menu['menu'] as $key=>$val) {
                    if((MODULE_NAME == $val['module_name'] && CONTROLLER_NAME == $val['controller_name'] && ACTION_NAME == $val['action_name']) || $val['id'] == $this->pid) {
                        $sub_menu['menu'][$key]['class'] = 'select';
                        break;
                    }
                }
                $this->assign('isget',$this->isget);
            }
            $this->assign('sub_menu', $sub_menu);
        }
        C('visitor',session('admin'));
        C('backend',1);
        $this->assign('visitor',session('admin'));
        $this->assign('menuid', $this->menuid);
        if(C('URL_MODULE_MAP')){
            foreach (C('URL_MODULE_MAP') as $key => $value) {
                if('admin'==$value){
                    C('admin_alias',$key);
                }
            }
        }else{
            C('admin_alias','Admin');
        }
    }
    /**
     * 列表页面
     */
    public function index() {
        $map = $this->_search();//调用本类下面的_search方法生成查询条件
        if(method_exists($this,'_before_search')) {
            $map = $this->_before_search($map);
        }else{
            $this->where && $map = array_merge($map,$this->where);
        }
        $mod = D($this->_name);
        !empty($mod) && $this->_list($mod, $map);
        if(method_exists($this,'_after_search')) {
            $this->_after_search();
        }
        $this->display($this->_tpl);
    }
    /**
     * 添加
     */
    public function add() {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        if(IS_POST){
            if(false === $data = $mod->create()){
                IS_AJAX && $this->ajaxReturn(0,$mod->getError());
                $this->error($mod->getError());
            }
            if(method_exists($this,'_before_insert')) {
                $data = $this->_before_insert($data);
            }
            $field = $mod->getDbFields();
            if($this->apply['Subsite'] && in_array('subsite_id',$field) && D('Subsite')->get_subsite_domain()){
                $subsites = I('request.subsite_id');
                if($subsites == ''){
                    IS_AJAX && $this->ajaxReturn(0, '请选择站点！');
                    $this->error('请选择站点！');
                }
                $subsites = is_array($subsites)? $subsites : array($subsites);
                foreach ($subsites as $val) {
                    $data['subsite_id'] = intval($val);
                    if($id = $mod->add($data)){
                        if(method_exists($this,'_after_insert')){
                            $data[$pk] = $id;
                            $this->_after_insert($id,$data);
                        }
                        //统一写日志
                        $this->admin_write_log_unify($id);
                    }else{
                        $reg = true;
                        break;
                    }
                }
                if(!$reg){
                    IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'add');
                    $this->success(L('operation_success'));
                }else{
                    IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                    $this->error(L('operation_failure'));
                }
            }else{
                if($id = $mod->add($data)){
                    if(method_exists($this,'_after_insert')){
                        $data[$pk] = $id;
                        $this->_after_insert($id,$data);
                    }
                    //统一写日志
                    $this->admin_write_log_unify($id);
                    IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'add');
                    $this->success(L('operation_success'));
                }else{
                    IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                    $this->error(L('operation_failure'));
                }
            }
        }else{
            $this->assign('open_validator',true);
            if(IS_AJAX){
                $response = $this->fetch();
                $this->ajaxReturn(1,'',$response);
            }else{
                $this->display($this->_tpl);
            }
        }
    }
    /**
     * 修改
     */
    public function edit(){
        $mod = D($this->_name);
        $pk = $mod->getPk();
        if (IS_POST) {
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_update')) {
                $data = $this->_before_update($data);
            }
            if (false !== $mod->save($data)) {
                if( method_exists($this, '_after_update')){
                    $id = $data['id'];
                    $this->_after_update($id,$data);
                }
                //统一写日志
                $this->admin_write_log_unify($data['id']);
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'edit');
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
			$id = I('get.'.$pk,0,'intval');
            $info = $mod->find($id);
            if( method_exists($this, '_after_select')){
                if($data = $this->_after_select($info)) $info = $data;
            }
            $this->assign('info', $info);
            if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
                $this->display($this->_tpl);
            }
        }
    }
    /**
     * ajax修改单个字段值
     */
    public function ajax_edit(){
        //AJAX修改数据
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $id = I('get.'.$pk,0,'intval');
        $field = I('get.field','','trim');
        $val = I('get.val','','trim');
        //允许异步修改的字段列表  放模型里面去 TODO
        $mod->where(array($pk=>$id))->setField($field, $val);
        $this->ajaxReturn(1);
    }
    /**
     * 删除
     */
    public function delete(){
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = I('request.'.$pk);
        $ids = is_array($ids)?implode(",",$ids):$ids;
        if ($ids) {
            $map[$pk] = array('in',$ids);
            $this->_map && $map = array_merge($map,$this->_map);
            if( method_exists($this, '_before_del')){
                $after_data = $mod->where($map)->select();
                $this->_before_del($after_data);
            }
            if (false !== $reg = $mod->where($map)->delete()) {
                if( method_exists($this, '_after_del')){
                    $this->_after_del($ids);
                }
                //统一写日志
                $this->admin_write_log_unify($ids);
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, '请选择要删除的内容！');
            $this->error('请选择要删除的内容！');
        }
    }
    /**
     * 获取请求参数生成条件数组
     */
    protected function _search() {
        //生成查询条件
        $mod = D($this->_name);
        $map = array();
        $field = $mod->getDbFields();
        $tablename = $mod->getTableName();
        foreach ($field as $key => $val) {//getDbFields函数用于获得数据表的所有字段名称
            if (substr($key, 0, 1) == '_') {
                continue;//continue方法用于跳出单次循环
            }
            if ('' != I('request.'.$val)) {
                $t = $this->join ? $tablename.'.'.$val : $val;
                $map[$t] = I('request.'.$val);
            }
        }
        if($this->apply['Subsite'] && in_array('subsite_id',$field) && C('visitor.subsite')){
            $t = $this->join ? $tablename.'.subsite_id' : 'subsite_id';
            $subsite_id = '' != I('request.subsite_id')?intval(I('request.subsite_id')):array('in',C('visitor.subsite'));
            $map[$t] = $subsite_id;
        }
        return $map;
    }
    /**
     * 列表处理
     *
     * @param obj $model  实例化后的模型
     * @param array $map  条件数据（默认为空））
     * @param string $order_by  排序（默认为降序）
     * @param string $field_list 显示字段（默认为'*'，全部显示）
     * @param string $union     union查询sql
     * @param string $join     join连表，传入join字句的数组
     * @param intval $pagesize 每页数据行数（默认为40条计录）
     * @param string $custom_fun 自定义方法名称
     */
    protected function _list($model, $map = array(), $order='', $field_list='', $union='', $join=array(),$pagesize_by=10,$custom_fun){
        //排序
        $mod_pk = $model->getPk();//getPK函数用于获得实例化对象后的数据表主健的字段名称
        if (I("request.sort")) {
            $sort = I("request.sort");
            if (I("request.order")) {
                $order = I("request.order");
                $order_by = $sort.' '.$order;
            }else{
                $order_by = $sort.' desc';
            }
        }elseif($order){
            $order_by = $order;
        }elseif($this->order){
            $order_by = $this->order;
        }elseif (empty($order_by)){
            $order_by = $mod_pk.' desc';
        }

        // if (I("request.sort")) {
        //     $sort = I("request.sort");
        // } else if (!empty($sort_by)) {
        //     $sort = $sort_by;
        // } else if ($this->sort) {
        //     $sort = $this->sort;
        // } else {
        //     $sort = $mod_pk;
        // }
        // if (I("request.order")) {
        //     $order = I("request.order");
        // } else if (!empty($order_by)) {
        //     $order = $order_by;
        // } else if ($this->order) {
        //     $order = $this->order;
        // } else {
        //     $order = 'DESC';//DESC数据为降序
        // }
        if($field_list){
            $field = $field_list;
        }elseif($this->field){
            $field = $this->field;
        }else{
            $field = '*';
        }
        //如果需要分页
        if(I('request.pagesize',0,'intval')){
            $pagesize = I('request.pagesize',0,'intval');
        }else if(isset($this->pagesize)){
            $pagesize = $this->pagesize;
        }else{
            $pagesize = $pagesize_by;
        }
        if(!$join && $this->join) $join = $this->join;
        if(!is_array($join)) $join = array($join);
        if(!$union && $this->union) $union = $this->union;
        if($this->group) $group = $this->group;
        if ($pagesize) {
            $count = $model->where($map);//获得数据表查询结果的总条数
            if(!empty($join)){
                foreach ($join as $key => $value) {
                    $count = $count->join($value);
                }
            }
            $distinct = $this->distinct ? 'distinct '.$this->distinct : '*';
            if($union){
                $count = $model->query('select count('.$distinct.') as tp_count from('.$count->buildSql().' union all '.$union.') as tp_t');
                $count = $count[0]['tp_count'];
            }else{
                $count = $count->count($distinct);
            }
            $pager = pager($count, $pagesize);//实例化thinkphp内置的分页显示类
        }
        $select = $model->field($field)->where($map)->order($order_by);
        if($union){
            $select = $select->union($union,true);
        }
        if(!empty($join)){
            foreach ($join as $key => $value) {
                $select = $select->join($value);
            }
        }
        $this->list_relation && $select->relation(true);
        if ($pagesize) {
            $select->limit($pager->firstRow.','.$pager->listRows);
            $page = $pager->fshow();
            $this->assign("page", $page);
        }
        $list = $select->group($this->distinct)->select();
        if($custom_fun){
            $fun = $custom_fun;
        }elseif($this->custom_fun){
            $fun = $this->custom_fun;
        }else{
            $fun = '_custom_fun';
        }
        if(method_exists($this,$fun)) {
            $list = $this->$fun($list);
        }
        $this->assign('list', $list);
        $this->assign('total', $count?$count:count($list));
        $this->assign('pagesize',$pagesize);
        $this->assign('list_table', true);
    }
    /**
     * [pending 待处理事件统计]
     */
    protected function _pending($mod,$where,$distinct){
        $field = M($mod)->getDbFields();
        if($this->apply['Subsite'] && in_array('subsite_id',$field) && C('visitor.subsite')){
            $subsite_id = I('request.subsite_id');
            if($subsite_id != '' && in_array($subsite_id, C('visitor.subsite'))){
                $where['subsite_id'] = intval($subsite_id);
            }else{
                $where['subsite_id'] = array('in',C('visitor.subsite'));
            }
        }
        $distinct && $distinct = 'distinct '.$distinct;
        return M($mod)->where($where)->count($distinct);
    }
    protected function check_priv(){
        if(false === $authList = F("admin_menu/{$_SESSION['admin']['role_id']}/auth")){
            $authList = D('Menu')->auth_cache($_SESSION['admin']['role_id']);
        }
        if($child = I('request.child',0,'intval')){
            $this->menuid = I('request.menuid',0,'intval');
           
            $sub_menu = $this->get_menus($this->menuid);
            if($sub_menu['menu']){
                $menu = $sub_menu['menu'][0];
                $this->redirect($menu['module_name'].'/'.$menu['controller_name'].'/'.$menu['action_name']);
            }
        }
       
        if(!session('admin') && !in_array(ACTION_NAME, array('login','verify_code'))) 
        {
            exit('<script type="text/javascript">top.location="'.U('index/login').'";</script>');
        }
        if(CONTROLLER_NAME == 'attachment') return true;
        if (in_array(CONTROLLER_NAME, explode(',', 'Index'))) return true;
        $f = $_REQUEST['_k_v'] ? '_isget' : '';
        $reg = $authList[MODULE_NAME.'_'.CONTROLLER_NAME.'_'.ACTION_NAME.$f];
        //dump($authList);
        !$reg && $reg = $authList[MODULE_NAME.'_'.CONTROLLER_NAME.'_'.ACTION_NAME];
        if($reg){
            $this->menuid = $reg['id'];
            $this->pid = $reg['pid'];
            $this->isget = $reg['isget'];
            return true;
        }
        if($_SESSION['admin']['role_id'] == 1) return true;
        IS_AJAX && $this->ajaxReturn(0,L('_VALID_ACCESS_'));
        $this->error(L('_VALID_ACCESS_'));
    }
    protected function get_menus($pid){
        if(false === $auth_menu = F("admin_menu/{$_SESSION['admin']['role_id']}/auth_menu")){

             //  读取管理员角色权限下，具有所有子菜单的可见菜列表  mods!=1
            $auth_menu = D('Menu')->auth_menu_cache();
           
        }
        if(isset($auth_menu[$pid])){
            if(false === $sub_menu = F("admin_menu/{$_SESSION['admin']['role_id']}/sub_menu_{$pid}")) 
            {
                $sub_menu = D('Menu')->sub_menu_cache($pid);
            }
            $sub_menu['pageheader'] = $auth_menu[$pid];
            return $sub_menu;
        }
        return false;
    }
    public function update_config($new_config, $config_file = '') {
        !is_file($config_file) && $config_file = HOME_CONFIG_PATH . 'config.php';
        if (is_writable($config_file)) {
            $config = require $config_file;
            $config = multimerge($config, $new_config);
            file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
            @unlink(RUNTIME_FILE);
            return true;
        } else {
            return false;
        }
    }
}