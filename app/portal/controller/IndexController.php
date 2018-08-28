<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class IndexController extends HomeBaseController
{
    public function index()
    {
    	if($this->ismobile == 1){
    		$this->_wapindex();
    	}else{

    	}
        return $this->fetch(':index');
    }

    private function _wapindex(){

        //最新更新
        $new_list = Db::name('portal_post')->where('post_status',1)->order('post_status desc')->order('create_time desc')->field('id,post_title')->limit(8)->select();

        $this->assign('new_list',$new_list);
       

    	//友情链接
        $yqlj_list = Db::name('link')->where('status',1)->select();

        $this->assign('yqlj_list',$yqlj_list);
    	
    	

    }
}
