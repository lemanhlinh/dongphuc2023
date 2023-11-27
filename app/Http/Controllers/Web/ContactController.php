<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\ProductsCategories;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\Contact\CreateContact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat_product_home = ProductsCategories::where(['published' => 1,'is_home' => 1])->select('id','name','alias')->withDepth()->defaultOrder()->get()->toTree();
        $banners = Banners::where(['published' => 1])->select('id','name','alias','image','link','content','type')->get();

        $logo = Setting::where('name', 'logo')->first();
        $title = Setting::where('name', 'title')->first();
        $meta_des = Setting::where('name', 'meta_des')->first();
        $meta_key = Setting::where('name', 'meta_key')->first();

        SEOTools::setTitle('Liên hệ - '.$title->value);
        SEOTools::setDescription($meta_des->value);
        SEOMeta::setKeywords($meta_key->value);
        SEOTools::addImages(asset($logo->value));
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite(\Request::root());

        return view('web.contact.detail', compact('cat_product_home','banners'));
    }

    /**
     * Display a home of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateContact $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            Contact::create(
                [
                    'full_name' => $data['full_name'],
                    'content' => $data['content'],
                    'telephone' => $data['phone'],
                    'email' => $data['email'],
                ]
            );
            DB::commit();
            Session::flash('success', trans('message.create_contact_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_contact_error'));
            return redirect()->back();
        }
        return redirect()->back();
    }
}
