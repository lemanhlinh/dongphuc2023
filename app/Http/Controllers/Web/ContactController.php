<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\ProductsCategories;
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
        $cat_product_home = ProductsCategories::where(['published' => 1,'show_in_homepage' => 1])->select('id','name','alias')->withDepth()->defaultOrder()->get()->toTree();
        $banners = Banners::where(['published' => 1])->select('id','name','alias','image','link')->get();
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
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'title' =>  $data['title'],
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
