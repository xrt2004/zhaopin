<?php
namespace Mobile\Controller;
use Mobile\Controller\MobileController;
class jobsController extends MobileController
{
    // 初始化函数
    public function _initialize()
    {
        parent::_initialize();
        if(I('get.code','','trim')){
            $reg = $this->get_weixin_openid(I('get.code','','trim'));
            $reg && $this->redirect('members/apilogin_binding');
        }
    }
    public function index()
    {
        $citycategory = I('get.citycategory','','trim');
        $where = array(
            '类型' => 'QS_citycategory',
            '地区分类' => (C('SUBSITE_VAL.s_id') > 0 && !$citycategory) ? C('SUBSITE_VAL.s_district') : $citycategory
        );
        $classify = new \Common\qscmstag\classifyTag($where);
        $city = $classify->run();       
        $seo = array('citycategory'=>$city['select']['categoryname'],'key'=>I('request.key'));
        $page_seo = D('Page')->get_page();
        $this->_config_seo($page_seo[strtolower(MODULE_NAME).'_'.strtolower(CONTROLLER_NAME).'_'.strtolower(ACTION_NAME)],$seo);
        $this->assign('search_type','jobs');
        $this->display();
    }

    /**
     * 公司详情
     */
    public function comshow()
    {
        $this->wx_share();
        $this->display();
    }

    /**
     * 职位详情
     */
    public function show()
    {
        $this->wx_share();
        $this->display();
    }
    
}

?>