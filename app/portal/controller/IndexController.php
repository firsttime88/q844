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
            //最新22篇文章

            $new_list = Db::name('portal_post')->where('post_status',1)->order('post_status desc')->order('create_time desc')->field('id,post_title,post_excerpt')->limit(22)->select();

            $this->assign('new_list',$new_list);


            //励志语录
        
            $lzyl_id_list = Db::name('portal_category_post')->where('category_id','in',[1,10,11,12,13,14])->where('status',1)->order('create_time desc')->limit(23)->column('category_id','post_id');


            $lzyl_cat_list = Db::name('portal_category')->where('id','in',[1,10,11,12,13,14])->column('name','id');



            $lzyl_list = Db::name('portal_post')->where('id','in',array_keys($lzyl_id_list))->field('id,post_title,post_excerpt')->select();
            

             $this->assign('lzyl_list',$lzyl_list);
             $this->assign('lzyl_cat_list',$lzyl_cat_list);
             $this->assign('lzyl_id_list',$lzyl_id_list);



             //励志影视
        

            $lzys_id_list = Db::name('portal_category_post')->where('category_id','in',[2,15,16,17,18,19])->where('status',1)->order('create_time desc')->limit(23)->column('category_id','post_id');

            

            $lzys_cat_list = Db::name('portal_category')->where('id','in',[2,15,16,17,18,19])->column('name','id');



            $lzys_list = Db::name('portal_post')->where('id','in',array_keys($lzys_id_list))->field('id,post_title,post_excerpt')->select();
            

             $this->assign('lzys_list',$lzys_list);
             $this->assign('lzys_cat_list',$lzys_cat_list);
             $this->assign('lzys_id_list',$lzys_id_list);



             //励志文章
        

             $lzwz_id_list = Db::name('portal_category_post')->where('category_id','in',[3,20,21,22,23,24,25,26,27])->where('status',1)->order('create_time desc')->limit(14)->column('category_id','post_id');

            


            $lzwz_cat_list = Db::name('portal_category')->where('id','in',[3,20,21,22,23,24,25,26,27])->column('name','id');



            $lzwz_list = Db::name('portal_post')->where('id','in',array_keys($lzwz_id_list))->field('id,post_title,post_excerpt')->select();
            

             $this->assign('lzwz_list',$lzwz_list);
             $this->assign('lzwz_cat_list',$lzwz_cat_list);
             $this->assign('lzwz_id_list',$lzwz_id_list);




             //励志人群
        

            $lzrq_id_list = Db::name('portal_category_post')->where('category_id','in',[4,28,29,30,31,32,33,34,35,36])->where('status',1)->order('create_time desc')->limit(7)->column('category_id','post_id');

            
           


            $lzrq_cat_list = Db::name('portal_category')->where('id','in',[4,28,29,30,31,32,33,34,35,36])->column('name','id');



            $lzrq_list = Db::name('portal_post')->where('id','in',array_keys($lzrq_id_list))->field('id,post_title,post_excerpt')->select();
            

             $this->assign('lzrq_list',$lzrq_list);
             $this->assign('lzrq_cat_list',$lzrq_cat_list);
             $this->assign('lzrq_id_list',$lzrq_id_list);




             //语录短信
        
            $yldx_id_list = Db::name('portal_category_post')->where('category_id','in',[5,37,38,39,40,41])->where('status',1)->order('create_time desc')->limit(17)->column('category_id','post_id');

            
            $yldx_cat_list = Db::name('portal_category')->where('id','in',[5,37,38,39,40,41])->column('name','id');


            $yldx_list = Db::name('portal_post')->where('id','in',array_keys($yldx_id_list))->field('id,post_title,post_excerpt')->select();
            

             $this->assign('yldx_list',$yldx_list);
             $this->assign('yldx_cat_list',$yldx_cat_list);
             $this->assign('yldx_id_list',$yldx_id_list);




            //励志短句


            $lzdj_id_list = Db::name('portal_category_post')->where('category_id','in',[6,42,43,44])->where('status',1)->order('create_time desc')->limit(18)->column('category_id','post_id');

            
            $lzdj_cat_list = Db::name('portal_category')->where('id','in',[6,42,43,44])->column('name','id');


            $lzdj_list = Db::name('portal_post')->where('id','in',array_keys($lzdj_id_list))->field('id,post_title,post_excerpt')->select();
            
             $this->assign('lzdj_list',$lzdj_list);
             $this->assign('lzdj_cat_list',$lzdj_cat_list);
             $this->assign('lzdj_id_list',$lzdj_id_list);




             //文言古诗


             $wygs_id_list = Db::name('portal_category_post')->where('category_id','in',[7,45,46,47,48,49,50])->where('status',1)->order('create_time desc')->limit(5)->column('category_id','post_id');

            

            $wygs_cat_list = Db::name('portal_category')->where('id','in',[7,45,46,47,48,49,50])->column('name','id');



            $wygs_list = Db::name('portal_post')->where('id','in',array_keys($wygs_id_list))->field('id,post_title,post_excerpt')->select();
            

             $this->assign('wygs_list',$wygs_list);
             $this->assign('wygs_cat_list',$wygs_cat_list);
             $this->assign('wygs_id_list',$wygs_id_list);



              //范文大全

            $fwdq_id_list = Db::name('portal_category_post')->where('category_id','in',[8,51,52,53,54,55,56])->where('status',1)->order('create_time desc')->limit(6)->column('category_id','post_id');

            


            $fwdq_cat_list = Db::name('portal_category')->where('id','in',[8,51,52,53,54,55,56])->column('name','id');



            $fwdq_list = Db::name('portal_post')->where('id','in',array_keys($fwdq_id_list))->field('id,post_title,post_excerpt')->select();
            

            $this->assign('fwdq_list',$fwdq_list);
            $this->assign('fwdq_cat_list',$fwdq_cat_list);
            $this->assign('fwdq_id_list',$fwdq_id_list);



            //网名大全
        
            $wmdq_id_list = Db::name('portal_category_post')->where('category_id','in',[9,57,58,59])->where('status',1)->order('create_time desc')->limit(15)->column('category_id','post_id');

            
            $wmdq_cat_list = Db::name('portal_category')->where('id','in',[9,57,58,59])->column('name','id');



            $wmdq_list = Db::name('portal_post')->where('id','in',array_keys($wmdq_id_list))->field('id,post_title,post_excerpt')->select();
            

            $this->assign('wmdq_list',$wmdq_list);
            $this->assign('wmdq_cat_list',$wmdq_cat_list);
            $this->assign('wmdq_id_list',$wmdq_id_list);











    	}


         //友情链接
        $yqlj_list = Db::name('link')->where('status',1)->select();

        $this->assign('yqlj_list',$yqlj_list);
        
        return $this->fetch(':index');
    }


    public function gywm()
    {
       

        return $this->fetch(':gywm');
    }



     public function map()
    {
       
        $lists = Db::name('portal_category')->where('parent_id','in',[1,2,3,4,5,6,7,8,9])->select();
        $all_list = array();

        foreach ($lists as $key => $value) {
            
            $all_list[$value['parent_id']][] = $lists[$key];

        }

        $this->assign('all_list',$all_list);
      
        return $this->fetch(':map');
    }


    public function taglist(){

        $new_list = Db::name('portal_tag')->where('status',1)->order('id desc')->limit(100)->select();

        $hot_list = Db::name('portal_tag')->where('status',1)->order('recommended desc')->limit(100)->select();

        $rand_list = Db::name('portal_tag')->where('status',1)->orderRaw('rand()')->limit(100)->select();


        $this->assign('rand_list',$rand_list);
        $this->assign('hot_list',$hot_list);
        $this->assign('new_list',$new_list);

        return $this->fetch(':taglist');
    }




    private function _wapindex(){
        //echo 1%2;die;
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
        
        $lzyl_id_list = Db::name('portal_category_post')->where('category_id','in',[1,10,11,12,13,14])->where('status',1)->order('create_time desc')->limit(7)->column('category_id','post_id');

        
        $lzyl_catid_list = array_unique(array_values($lzyl_id_list));


        $lzyl_cat_list = Db::name('portal_category')->where('id','in',$lzyl_catid_list)->column('name','id');



        $lzyl_list = Db::name('portal_post')->where('id','in',array_keys($lzyl_id_list))->field('id,post_title,post_excerpt')->select();
        

         $this->assign('lzyl_list',$lzyl_list);
         $this->assign('lzyl_cat_list',$lzyl_cat_list);
         $this->assign('lzyl_id_list',$lzyl_id_list);
        //励志影视
        

        $lzys_id_list = Db::name('portal_category_post')->where('category_id','in',[2,15,16,17,18,19])->where('status',1)->order('create_time desc')->limit(7)->column('category_id','post_id');

        
        $lzys_catid_list = array_unique(array_values($lzys_id_list));


        $lzys_cat_list = Db::name('portal_category')->where('id','in',$lzys_catid_list)->column('name','id');



        $lzys_list = Db::name('portal_post')->where('id','in',array_keys($lzys_id_list))->field('id,post_title,post_excerpt')->select();
        

         $this->assign('lzys_list',$lzys_list);
         $this->assign('lzys_cat_list',$lzys_cat_list);
         $this->assign('lzys_id_list',$lzys_id_list);



        //励志文章
        

         $lzwz_id_list = Db::name('portal_category_post')->where('category_id','in',[3,20,21,22,23,24,25,26,27])->where('status',1)->order('create_time desc')->limit(7)->column('category_id','post_id');

        
        $lzwz_catid_list = array_unique(array_values($lzwz_id_list));


        $lzwz_cat_list = Db::name('portal_category')->where('id','in',$lzwz_catid_list)->column('name','id');



        $lzwz_list = Db::name('portal_post')->where('id','in',array_keys($lzwz_id_list))->field('id,post_title,post_excerpt')->select();
        

         $this->assign('lzwz_list',$lzwz_list);
         $this->assign('lzwz_cat_list',$lzwz_cat_list);
         $this->assign('lzwz_id_list',$lzwz_id_list);


       

        //励志人群
        

        $lzrq_id_list = Db::name('portal_category_post')->where('category_id','in',[4,28,29,30,31,32,33,34,35,36])->where('status',1)->order('create_time desc')->limit(7)->column('category_id','post_id');

        
        $lzrq_catid_list = array_unique(array_values($lzrq_id_list));


        $lzrq_cat_list = Db::name('portal_category')->where('id','in',$lzrq_catid_list)->column('name','id');



        $lzrq_list = Db::name('portal_post')->where('id','in',array_keys($lzrq_id_list))->field('id,post_title,post_excerpt')->select();
        

         $this->assign('lzrq_list',$lzrq_list);
         $this->assign('lzrq_cat_list',$lzrq_cat_list);
         $this->assign('lzrq_id_list',$lzrq_id_list);




        //语录短信
        
         $yldx_id_list = Db::name('portal_category_post')->where('category_id','in',[5,37,38,39,40,41])->where('status',1)->order('create_time desc')->limit(7)->column('category_id','post_id');

        
        $yldx_catid_list = array_unique(array_values($yldx_id_list));


        $yldx_cat_list = Db::name('portal_category')->where('id','in',$yldx_catid_list)->column('name','id');



        $yldx_list = Db::name('portal_post')->where('id','in',array_keys($yldx_id_list))->field('id,post_title,post_excerpt')->select();
        

         $this->assign('yldx_list',$yldx_list);
         $this->assign('yldx_cat_list',$yldx_cat_list);
         $this->assign('yldx_id_list',$yldx_id_list);




        //励志短句


        $lzdj_id_list = Db::name('portal_category_post')->where('category_id','in',[6,42,43,44])->where('status',1)->order('create_time desc')->limit(7)->column('category_id','post_id');

        
        $lzdj_catid_list = array_unique(array_values($lzdj_id_list));


        $lzdj_cat_list = Db::name('portal_category')->where('id','in',$lzdj_catid_list)->column('name','id');



        $lzdj_list = Db::name('portal_post')->where('id','in',array_keys($lzdj_id_list))->field('id,post_title,post_excerpt')->select();
        

         $this->assign('lzdj_list',$lzdj_list);
         $this->assign('lzdj_cat_list',$lzdj_cat_list);
         $this->assign('lzdj_id_list',$lzdj_id_list);




        //文言古诗


         $wygs_id_list = Db::name('portal_category_post')->where('category_id','in',[7,45,46,47,48,49,50])->where('status',1)->order('create_time desc')->limit(7)->column('category_id','post_id');

        
        $wygs_catid_list = array_unique(array_values($wygs_id_list));


        $wygs_cat_list = Db::name('portal_category')->where('id','in',$wygs_catid_list)->column('name','id');



        $wygs_list = Db::name('portal_post')->where('id','in',array_keys($wygs_id_list))->field('id,post_title,post_excerpt')->select();
        

         $this->assign('wygs_list',$wygs_list);
         $this->assign('wygs_cat_list',$wygs_cat_list);
         $this->assign('wygs_id_list',$wygs_id_list);




        //范文大全

        $fwdq_id_list = Db::name('portal_category_post')->where('category_id','in',[8,51,52,53,54,55,56])->where('status',1)->order('create_time desc')->limit(7)->column('category_id','post_id');

        
        $fwdq_catid_list = array_unique(array_values($fwdq_id_list));


        $fwdq_cat_list = Db::name('portal_category')->where('id','in',$fwdq_catid_list)->column('name','id');



        $fwdq_list = Db::name('portal_post')->where('id','in',array_keys($fwdq_id_list))->field('id,post_title,post_excerpt')->select();
        

        $this->assign('fwdq_list',$fwdq_list);
        $this->assign('fwdq_cat_list',$fwdq_cat_list);
        $this->assign('fwdq_id_list',$fwdq_id_list);



        //网名大全
    	
        $wmdq_id_list = Db::name('portal_category_post')->where('category_id','in',[9,57,58,59])->where('status',1)->order('create_time desc')->limit(7)->column('category_id','post_id');

        
        $wmdq_catid_list = array_unique(array_values($wmdq_id_list));


        $wmdq_cat_list = Db::name('portal_category')->where('id','in',$wmdq_catid_list)->column('name','id');



        $wmdq_list = Db::name('portal_post')->where('id','in',array_keys($wmdq_id_list))->field('id,post_title,post_excerpt')->select();
        

        $this->assign('wmdq_list',$wmdq_list);
        $this->assign('wmdq_cat_list',$wmdq_cat_list);
        $this->assign('wmdq_id_list',$wmdq_id_list);



       
    	
    	

    }
}
