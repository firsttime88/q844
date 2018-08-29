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
        $new_list = Db::name('portal_post')->where('post_status',1)->order('post_status desc')->order('create_time desc')->field('id,post_title,post_excerpt')->limit(8)->select();
        // $new_list_ids = array();
        // foreach ($new_list as $key => $value) {
        //     array_push($new_list_ids,$value['id']);
        // }
        
        //$new_list_catinfos = Db::name('portal_category_post')->where('post_id','in',$new_list_ids)->column('id','post_id');

        $this->assign('new_list',$new_list);
        //$this->assign('new_list_catinfos',$new_list_catinfos);
        

        //励志语录
        
        //$lzyl_list = ;
        


        //励志影视
        

        //励志文章
       

        //励志人群


        //语录短信


        //励志短句


        //文言古诗


        //范文大全


        //网名大全
    	


        //友情链接
        $yqlj_list = Db::name('link')->where('status',1)->select();

        $this->assign('yqlj_list',$yqlj_list);
    	
    	

    }
}
