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

use sphinx\sphinxapi;
class SearchController extends HomeBaseController
{
    public function index()
    {

    	

    	
        $keyword = $this->request->param('keyword');
        $page                  = $this->request->param('page', 1, 'intval');

        if($page <= 0) $page = 1;

        if (empty($keyword)) {
            $this -> error("关键词不能为空！请重新输入！");
        }


        vendor('sphinx.sphinxapi');
    	$s = new \SphinxClient ();

    	$perpage = 10;

    	$s->SetServer('localhost' , 9312);
		$s->SetLimits(($page - 1) * $perpage , $perpage , 3000);
		$s->SetMaxQueryTime(3000);
		$result = $s->Query($keyword , 'q844');

		$ids = array();

		if(empty($result) || $result['total_found'] == 0) {
			$total_count = 0;
			
		} else {
			$total_count = $result['total_found'];
			if(isset($result['matches'])){
				$ids = array_keys($result['matches']);
			}	
		}


		if(count($ids) > 0){

			$lists = Db::name('portal_post')->field('id,post_title,post_excerpt,create_time')->where('id','in',join(',',$ids))->select();

			
			$totalPage = ceil($total_count/$perpage);

			$pageUrl = cmf_url('portal/Search/index',array('keyword'=>$keyword));


			$page_str = cmf_pc_showpage($page,$totalPage,$pageUrl);

			$this->assign('lists', $lists);

			$this->assign('page_str', $page_str);

		}


        $new_list = Db::name('portal_post')->where('post_status',1)->order('post_status desc')->order('create_time desc')->field('id,post_title,post_excerpt')->limit(21)->select();

        $this->assign('new_list',$new_list);

        $this -> assign("keyword", $keyword);
        return $this->fetch('/search');
    }
}
