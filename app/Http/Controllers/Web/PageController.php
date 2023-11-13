<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\Page;
use App\Models\ProductsCategories;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($slug){

        $page = Page::where('alias', $slug)->first();
        if (!$page) {
            abort(404);
        }
        $banners = Banners::where(['published' => 1])->select('id','name','alias','image','link')->get();
        $cat_product_home = ProductsCategories::where(['published' => 1,'show_in_homepage' => 1])->select('id','name','alias')->withDepth()->defaultOrder()->get()->toTree();

        SEOTools::setTitle($page->seo_title?$page->seo_title:$page->title);
        SEOTools::setDescription($page->seo_description?$page->seo_description:$page->description);
        SEOTools::addImages($page->image?asset($page->image):null);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite(\Request::root());
        SEOMeta::setKeywords($page->seo_keyword?$page->seo_keyword:$page->title);

        return view('web.page.home', compact('page','banners','cat_product_home'));
    }
}
