<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\AttributeValues;
use App\Models\Banners;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Sliders;
use App\Models\Student;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
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
        $logo = Setting::where('name', 'logo')->first();
        $title = Setting::where('name', 'title')->first();
        $meta_des = Setting::where('name', 'meta_des')->first();
        $meta_key = Setting::where('name', 'meta_key')->first();

        SEOTools::setTitle($title->value);
        SEOTools::setDescription($meta_des->value);
        SEOMeta::setKeywords($meta_key->value);
        SEOTools::addImages(asset($logo->value));
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite(\Request::root());

        $articles = Article::where(['published' => 1])->select('id','title','alias','image','category_id')
            ->with(['category' => function($query){
                $query->select('id','name','alias');
            }])->orderBy('id','DESC')->limit(10)->get();
        $slider = Sliders::where(['published' => 1])->select('id','name','image','url','summary')->get();
        $students = Student::where(['published' => 1])->select('id','title','image','content','creator')->get();
        $partner = Partner::where(['published' => 1])->select('id','name','url','image')->get();
        $cats = ProductsCategories::where(['is_home' => 1,'published' => 1])->where('parent_id','!=',null)->select('id','name','alias')
            ->orderBy('ordering', 'ASC')->limit(6)->get();
        $productsInCategories = [];
        foreach ($cats as $category) {
            $products = Product::where(['published' => 1, 'show_in_homepage' => 1])->where('category_id_wrapper', 'like', '%' . $category->id . '%')
                ->select('id','image','alias','image_after','name','category_id')
                ->with(['category' => function($query){
                    $query->select('id','name','alias');
                }])->orderBy('ordering','DESC')
                ->take(10)->get();
            $productsInCategories[$category->id] = $products;
        }

        return view('web.home', compact('slider','students','cats','productsInCategories','partner','articles'));
    }

}
