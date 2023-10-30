<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Banners;
use App\Models\Product;
use App\Models\ProductsCategories;
use App\Repositories\Contracts\ArticleCategoryInterface;
use App\Repositories\Contracts\ArticleInterface;
use Illuminate\Http\Request;
use App\Models\ArticlesCategories;

class ArticleController extends Controller
{
    protected $articleCategoryRepository;
    protected $articleRepository;

    public function __construct(ArticleCategoryInterface $articleCategoryRepository, ArticleInterface $articleRepository)
    {
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cat($slug)
    {
        $category = ArticlesCategories::where(['alias'=> $slug,'published'=> 1])
            ->select('id','name','alias','seo_title','seo_keyword','seo_description')
            ->first();
        if (!$category) {
            abort(404);
        }
        $article = $this->articleRepository->paginate(10,['id','alias','image','summary','title','published','created_at'],['published'=>1,'category_id'=>$category->id],['category']);
        $cat_product_home = ProductsCategories::where(['published' => 1,'show_in_homepage' => 1])->select('id','name','alias')->withDepth()->defaultOrder()->get()->toTree();
        $banners = Banners::where(['published' => 1])->select('id','name','alias','image','link')->get();
        return view('web.article.cat', compact('article','category','cat_product_home','banners'));
    }

    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($cat_slug, $slug)
    {
        $article = $this->articleRepository->getOneBySlug($slug);
        if (!$article) {
            abort(404);
        }
        $cat_product_home = ProductsCategories::where(['published' => 1,'show_in_homepage' => 1])->select('id','name','alias')->withDepth()->defaultOrder()->get()->toTree();
        $banners = Banners::where(['published' => 1])->select('id','name','alias','image','link')->get();
        $relate_news_list = Article::where(['published' => 1,'category_id' => $article->category_id])->select('id','title','alias','image')->limit(4)->get();
        return view('web.article.detail', compact('article','cat_product_home','banners','relate_news_list','cat_slug'));
    }
}
