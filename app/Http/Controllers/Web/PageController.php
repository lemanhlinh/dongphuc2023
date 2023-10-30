<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\Page;
use App\Models\ProductsCategories;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($slug){

        $page = Page::where('alias', $slug)->select('id','title','alias','image','content')->first();
        if (!$page) {
            abort(404);
        }
        $banners = Banners::where(['published' => 1])->select('id','name','alias','image','link')->get();
        $cat_product_home = ProductsCategories::where(['published' => 1,'show_in_homepage' => 1])->select('id','name','alias')->withDepth()->defaultOrder()->get()->toTree();
        return view('web.page.home', compact('page','banners','cat_product_home'));
    }
}
