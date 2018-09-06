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
use app\portal\model\PortalCategoryModel;
use think\Db;

class ListController extends HomeBaseController
{
    public function index()
    {


        $id                  = $this->request->param('id', 0, 'intval');
        $page                  = $this->request->param('page', 1, 'intval');
        
        $portalCategoryModel = new PortalCategoryModel();

        $category = $portalCategoryModel->where('id', $id)->where('status', 1)->find();

        $this->assign('category', $category);
        $this->assign('category_id', $id);



        $parent_category_id = $category['parent_id'];


        if($parent_category_id == 0){

            $child_category = Db::query('SELECT * FROM `cmf_portal_category` WHERE   (`parent_id` = ? AND `status` = 1 ) order by parent_id asc',[$id]);

            $this->assign('child_category', $child_category);

            $child_category_articles = array();
            
            foreach($child_category as $key => $value) {
                $tmp_list = Db::name('portal_category_post')->where('category_id',$value['id'])->where('status',1)->order('create_time desc')->limit(7)->column('post_id');
                

                $article_list = Db::name('portal_post')->where('id','in',$tmp_list)->field('id,post_title,post_excerpt,create_time')->select();

                if(count($article_list) > 0){
                   $child_category_articles[$value['id']] = array(

                        'category_name'=>$value['name'],
                        'articles'=>$article_list
                    ); 
                }
                
            }

            $this->assign('child_category_articles', $child_category_articles);

            return $this->fetch('/category');

        }else{

            $relation_category = Db::query('SELECT * FROM `cmf_portal_category` WHERE  (`id` = ?  AND `status` = 1 ) OR (`parent_id` = ? AND `status` = 1 ) order by parent_id asc',[$parent_category_id,$parent_category_id]);

            $parent_category = array_shift($relation_category);
            

            $total_count = Db::query('SELECT COUNT(*) AS tp_count FROM `cmf_portal_category_post` WHERE `category_id` = ? and status = 1 LIMIT 1',[$id]);

            
            $total_count = $total_count[0]['tp_count'];

           
            $perpage = 10;

            $start = ($page-1) * $perpage;

            $lists = Db::query('SELECT `a`.*,b.id AS post_category_id,`b`.`category_id` FROM `cmf_portal_post` `a` INNER JOIN `cmf_portal_category_post` `b` ON `a`.`id`=`b`.`post_id` WHERE `b`.`category_id` = ? and `b`.`status` = 1 ORDER BY `a`.`create_time` DESC,`b`.`post_id` DESC LIMIT ?,?' ,[$id,$start,$perpage]);

           $totalPage = ceil($total_count/$perpage);

           $pageUrl = cmf_url('portal/List/index',array('id'=>$id));

           $page_str = cmf_showpage($page,$totalPage,$pageUrl);

           
           $this->assign('lists', $lists);
           $this->assign('parent_category', $parent_category);
           $this->assign('relation_category', $relation_category);
           $this->assign('page_str', $page_str);
           

            $listTpl = empty($category['list_tpl']) ? 'list' : $category['list_tpl'];

            return $this->fetch('/' . $listTpl);



        }



        
    }

}
