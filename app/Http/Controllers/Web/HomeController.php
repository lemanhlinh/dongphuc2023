<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\AttributeValues;
use App\Models\Banners;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Sliders;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ArticleInterface;
use App\Repositories\Contracts\SlideInterface;
use App\Repositories\Contracts\PageInterface;
use App\Models\ProductsCategories;

class HomeController extends Controller
{
    protected $articleRepository;

    public function __construct(
        ArticleInterface $articleRepository,
        SlideInterface $slideRepository,
        PageInterface $pageRepository
    )
    {
        $this->articleRepository = $articleRepository;
        $this->slideRepository = $slideRepository;
        $this->pageRepository = $pageRepository;
        $this->pageRepository = $pageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::where(['published' => 1])->select('id','title','alias','image','category_id')
            ->with(['category' => function($query){
                $query->select('id','name','alias');
            }])->oderBy('id','DESC')->get();
        $slider = Sliders::where(['published' => 1])->select('id','name','image','url','summary')->get();
        $students = Student::where(['published' => 1])->select('id','title','image','content','creator')->get();
        $partner = Partner::where(['published' => 1])->select('id','name','url','image')->get();
        $cats = ProductsCategories::where(['show_in_homepage' => 1,'published' => 1])->select('id','name','alias')
            ->orderBy('id', 'DESC')->limit(6)->get();
        $productsInCategories = [];
        foreach ($cats as $category) {
            $products = Product::where(['published' => 1])->where('category_id_wrapper', 'like', '%' . $category->id . '%')
                ->select('id','image','alias','image_after','name','category_id')
                ->with(['category' => function($query){
                    $query->select('id','name','alias');
                }])
                ->take(10)->get();
            $productsInCategories[$category->id] = $products;
        }

        return view('web.home', compact('slider','students','cats','productsInCategories','partner','articles'));
    }

}
