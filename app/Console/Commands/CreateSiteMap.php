<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\ArticlesCategories;
use App\Models\AttributeValues;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductOptions;
use App\Models\ProductsCategories;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = App::make('sitemap');
        // add home pages
        $sitemap->add(route('home'), Carbon::now(), 1, 'daily');

        //product_cat
        $product_cats = ProductsCategories::select('id','alias')->where(['published' => 1,'parent_id'=>null])->orderBy('id', 'desc')->get();
        foreach ($product_cats as $cat) {
            $name = $cat->alias;
            $sitemap->add(route('home').'/sitemaps/'.$name.'.xml', Carbon::now(), 1, 'daily');
            $product_site = App::make('sitemap');
            // cat
            $product_site->add(route('catProduct',['slug'=>$cat->alias]), Carbon::now(), 1, 'daily');
            $product_sub_cats = ProductsCategories::select('id','alias')->where(['published' => 1,'parent_id'=>$cat->id])->orderBy('id', 'desc')->get();
            foreach ($product_sub_cats as $sub_cat){
                $product_site->add(route('catProduct',['slug'=>$sub_cat->alias]), Carbon::now(), 1, 'daily');
            }
            //product in cat
            $products = Product::select('id', 'alias')->where('published',1)->where('category_id_wrapper', 'LIKE', '%'.$cat->id.'%')->orderBy('id', 'DESC')->get();
            foreach ($products as $item){
                $product_site->add(route('detailProduct',['cat_slug'=>$cat->alias,'slug'=>$item->alias]), Carbon::now(), 1, 'daily');
            }
            $product_site->store('xml', 'sitemaps/'.$name);
            if (File::exists(public_path('sitemaps/'.$name.'.xml'))) {
                chmod(public_path('sitemaps/'.$name.'.xml'), 0777);
            }
        }

        //article
        $sitemap->add(route('home').'/sitemaps/tin-tuc.xml', Carbon::now(), 1, 'daily');
        $sitemap_blog = App::make('sitemap');
        $article_cats = ArticlesCategories::select('id','alias')->where('published', 1)->orderBy('id','DESC')->get();
        foreach ($article_cats as $article_cat){
            $sitemap_blog->add(route('catArticle',['slug'=>$article_cat->alias]), Carbon::now(), 1, 'daily');
            $articles = Article::select('id','alias')->where('published', 1)->where('category_id_wrapper', 'LIKE', '%'.$article_cat->id.'%')->orderBy('id','DESC')->get();
            foreach ($articles as $article){
                $sitemap_blog->add(route('detailArticle',['cat_slug'=>$article_cat->alias,'slug'=>$article->alias]), Carbon::now(), 1, 'daily');
            }
        }
        $sitemap_blog->store('xml', 'sitemaps/tin-tuc');
        if (File::exists(public_path('sitemaps/tin-tuc.xml'))) {
            chmod(public_path('sitemaps/tin-tuc.xml'), 0777);
        }

        //trang tinb
        $sitemap->add(route('home').'/sitemaps/trang-tinh.xml', Carbon::now(), 1, 'daily');
        $sitemap_page = App::make('sitemap');
        $pages = Page::select('id','alias')->where('published', 1)->orderBy('id','DESC')->get();
        foreach ($pages as $page){
            $sitemap_page->add(route('detailPage',['slug'=>$page->alias]), Carbon::now(), 1, 'daily');
        }
        $sitemap_page->store('xml', 'sitemaps/trang-tinh');
        if (File::exists(public_path('sitemaps/trang-tinh.xml'))) {
            chmod(public_path('sitemaps/trang-tinh.xml'), 0777);
        }

        // add contact pages
        $sitemap->add(route('contact'), Carbon::now(), 1, 'daily');

        // save file and permission
        $sitemap->store('xml', 'sitemap');
        if (File::exists(public_path('sitemap.xml'))) {
            chmod(public_path('sitemap.xml'), 0777);
        }
    }
}
