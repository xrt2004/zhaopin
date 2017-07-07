<?php
namespace Admin\Controller;
use Common\Controller\BackendController;
class AdController extends BackendController{
	public function _initialize() {
        parent::_initialize();
        $this->_mod = D('Ad');
    }
    public function _before_index(){
        if($this->apply['Subsite']){
            $subsite_id = I('request.subsite_id',0,'intval');
            $subsite_list = D('Subsite')->get_subsite_domain();
            $tpl = $subsite_list[$subsite_id]['s_tpl']?:C('qscms_template_dir');
            $cache = '_'.$subsite_id;
            $_GET['theme'] = $tpl;
        }else{
            $tpl = C('qscms_template_dir');
        }
        $this->order = 'show_order desc';
    	if(false === $category_list = F('ad_cate_list_'.$tpl.$cache)) $category_list = D('AdCategory')->ad_cate_cache($tpl,$subsite_id);
    	$this->assign('category_list',$category_list);
    }
    public function _before_add(){
        if($this->apply['Subsite']){
            $subsite_id = I('request.subsite_id',0,'intval');
            $subsite_list = D('Subsite')->get_subsite_domain();
            foreach ($subsite_list as $key => $val) {
                if(false === $data = F('ad_cate_list_'.$val['s_tpl'].'_'.$val['s_id'])) $data = D('AdCategory')->ad_cate_cache($val['s_tpl'],$val['s_id']);
                $category_list[$val['s_id']] = $data;
            }
        }else{
            if(false === $category_list = F('ad_cate_list_'.$tpl.$cache)) $category_list = D('AdCategory')->ad_cate_cache($tpl,$subsite_id);
        }
        $this->assign('category_list',$category_list);
    }
    public function _before_insert($data){
		if($_FILES['attach_file']['name']){
			$date = date('y/m/d/');
			$result = $this->_upload($_FILES['attach_file'], 'ads/' . $date, array(
					'maxSize' => 2*1024,//图片最大2M
					'uploadReplace' => true,
					'attach_exts' => 'bmp,png,gif,jpeg,jpg'
			));
			if ($result['error']) {
				$data['content'] = $date.$result['info'][0]['savename'];
			} else {
				$this->ajaxReturn(0, $result['info']);
			}
		}else{
			$data['content'] = I('post.attach_path','','trim');
		}
        if($this->apply['Subsite']){
            $subsite_list = D('Subsite')->get_subsite_domain();
            $data['theme'] = $subsite_list[$subsite_id]['s_tpl']?:C('qscms_template_dir');
        }else{
            $data['theme'] = C('qscms_template_dir');
        }
    	return $data;
    }
    public function _before_edit(){
        $this->_before_add();
    }
    public function _before_update($data){
        return $this->_before_insert($data);
    }
    /**
     * [_before_search 查询条件]
     */
    public function _before_search($data){
        $key_type = I('request.key_type',0,'intval');
        $key = I('request.key','','trim');
        if($key_type && $key){
            switch ($key_type){
                case 1:
                    $data['title'] = array('like','%'.$key.'%');
                    break;
            }
        }
        return $data;
    }
    /**
     * [category 广告位管理]
     */
    public function category(){
        $this->_name = 'AdCategory';
        if($this->apply['Subsite']){
            $subsite_id = I('request.subsite_id',0,'intval');
            $subsite_list = D('Subsite')->get_subsite_domain();
            $tpl = $subsite_list[$subsite_id]['s_tpl']?:C('qscms_template_dir');
            $this->where = array('theme'=>$tpl);
        }
        $this->index();
    }
    /**
     * [category_add 广告位添加]
     */
    public function category_add(){
        if(IS_POST){
            $this->_name = 'AdCategory';
            $this->add();
        }else{
            $this->display();
        }
    }
    /**
     * [category_edit 广告位编辑]
     */
    public function category_edit(){
        $this->_name = 'AdCategory';
        $this->edit();
    }
    /**
     * [category_del 广告位删除]
     */
    public function category_del(){
        $this->_name = 'AdCategory';
        $this->delete();
    }
}
?>