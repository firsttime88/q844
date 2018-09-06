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
use app\portal\service\PostService;
use app\portal\model\PortalPostModel;
use think\Db;

class ArticleController extends HomeBaseController
{
    public function index()
    {


        $portalCategoryModel = new PortalCategoryModel();
        $postService         = new PostService();

        $articleId  = $this->request->param('id', 0, 'intval');
        $categoryId = $this->request->param('cid', 0, 'intval');


        
        $article    = $postService->publishedArticle($articleId, $categoryId);


        if (empty($article)) {
            abort(404, '文章不存在!');
        }


        $prevArticle = $postService->publishedPrevArticle($articleId, $categoryId);

        $nextArticle = $postService->publishedNextArticle($articleId, $categoryId);

        $tplName = 'article';

        if (empty($categoryId)) {
            $categories = $article['categories'];



            if (count($categories) > 0) {

                $tmp_category = $categories[0];



                $tmp_category_info = $portalCategoryModel->where('id', $tmp_category['id'])->where('status', 1)->find();

                if($tmp_category_info['parent_id'] == 0){
                    $category_list = Db::query('SELECT * FROM `cmf_portal_category` WHERE   (`parent_id` = ? AND `status` = 1 ) order by parent_id asc',[$tmp_category['id']]);

                    $parent_category = $tmp_category_info;

                }else{

                    $category_list = Db::query('SELECT * FROM `cmf_portal_category` WHERE  (`id` = ?  AND `status` = 1 ) OR (`parent_id` = ? AND `status` = 1 ) order by parent_id asc',[$tmp_category['parent_id'],$tmp_category['parent_id']]);
                    $parent_category = array_shift($category_list);
                }
                
                 $this->assign('category_list', $category_list);
                 $this->assign('parent_category', $parent_category);

                $this->assign('category', $categories[0]);
            } else {
                abort(404, '文章未指定分类!');
            }

        } else {
            $category = $portalCategoryModel->where('id', $categoryId)->where('status', 1)->find();

            if (empty($category)) {
                abort(404, '文章不存在!');
            }

            $this->assign('category', $category);

            $tplName = empty($category["one_tpl"]) ? $tplName : $category["one_tpl"];
        }

        Db::name('portal_post')->where(['id' => $articleId])->setInc('post_hits');


        hook('portal_before_assign_article', $article);

        
        //猜你喜欢
        
        $new_list = Db::name('portal_post')->where('post_status',1)->order('post_status desc')->order('create_time desc')->field('id,post_title,post_excerpt')->limit(6)->select();



        //相关内容


        $tmp_list = Db::name('portal_category_post')->where('category_id',$article['categories'][0]['id'])->where('status',1)->order('create_time desc')->limit(5)->column('post_id');
        


        $xgnr_list = Db::name('portal_post')->where('id','in',$tmp_list)->field('id,post_title,post_excerpt,create_time')->select();




        $this->assign('article', $article);
        $this->assign('xgnr_list', $xgnr_list);
        $this->assign('new_list', $new_list);


        $this->assign('prev_article', $prevArticle);
        $this->assign('next_article', $nextArticle);

        $tplName = empty($article['more']['template']) ? $tplName : $article['more']['template'];

        return $this->fetch("/$tplName");
    }

    // 文章点赞
    public function doLike()
    {
        $this->checkUserLogin();
        $articleId = $this->request->param('id', 0, 'intval');


        $canLike = cmf_check_user_action("posts$articleId", 1);

        if ($canLike) {
            Db::name('portal_post')->where(['id' => $articleId])->setInc('post_like');

            $this->success("赞好啦！");
        } else {
            $this->error("您已赞过啦！");
        }
    }

}
