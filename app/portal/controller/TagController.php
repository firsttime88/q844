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
use app\portal\model\PortalTagModel;
use think\Db;

class TagController extends HomeBaseController
{
    public function index()
    {


    

        $id             = $this->request->param('id');

        $page                  = $this->request->param('page', 1, 'intval');


        $portalTagModel = new PortalTagModel();

        if(is_numeric($id)){
            $tag = $portalTagModel->where('id', $id)->where('status', 1)->find();
        }else{
            $tag = $portalTagModel->where('name', $id)->where('status', 1)->find();
        }

        if (empty($tag)) {
            abort(404, '标签不存在!');
        }

        $total_count = Db::name('portal_tag_post')->where('tag_id',$id)->where('status',1)->order('tag_id desc')->count();

        //$total_count = Db::name('portal_tag_post')->where('status',1)->order('tag_id desc')->count();


        $perpage = 10;

        $start = ($page-1) * $perpage;

        $tmp_lists = Db::name('portal_tag_post')->where('tag_id',$id)->where('status',1)->order('tag_id desc')->limit($start,$perpage)->column('post_id');

        //$tmp_lists = Db::name('portal_tag_post')->where('status',1)->order('tag_id desc')->limit($start,$perpage)->column('post_id');

         
        if(count($tmp_lists) > 0){
            $lists = Db::query('SELECT `id`,`post_title`,`post_excerpt`,`create_time` FROM `cmf_portal_post`  WHERE `id` in ('.join(',',$tmp_lists).') and  `post_status` = 1' );
        }else{
            $lists = array();
        }
        

       
        $totalPage = ceil($total_count/$perpage);

        $pageUrl = cmf_url('portal/Tag/index',array('id'=>$id));




        if($this->ismobile == 0){

            $new_list = Db::name('portal_post')->where('post_status',1)->order('post_status desc')->order('create_time desc')->field('id,post_title,post_excerpt')->limit(21)->select();

            $this->assign('new_list',$new_list);

            $page_str = cmf_pc_showpage($page,$totalPage,$pageUrl);
        }else{
            $page_str = cmf_showpage($page,$totalPage,$pageUrl);
        }

        $this->assign('page_str', $page_str);
        $this->assign('tag', $tag);
        $this->assign('lists', $lists);

        return $this->fetch('/tag');
    }

}
