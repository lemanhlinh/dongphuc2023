<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Scopes\ProductDataTableScope;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductsImages;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductInterface;
use App\Repositories\Contracts\ProductCategoryInterface;
use App\DataTables\ProductDataTable;
use App\Http\Requests\Product\CreateProduct;
use App\Http\Requests\Product\UpdateProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    protected $productResponstory, $productCategoryResponstory;

    function __construct(ProductCategoryInterface $productCategoryResponstory,ProductInterface $productResponstory)
    {
        $this->middleware('auth');
        $this->productCategoryResponstory = $productCategoryResponstory;
        $this->productResponstory = $productResponstory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $dataTable)
    {
        $data = request()->all();
        $categories = $this->productCategoryResponstory->getAll();
        if ($categories->count() === 0){
            Session::flash('danger', 'Chưa có danh mục nào');
            return redirect()->route('admin.product-category.index');
        }
        return $dataTable->addScope(new ProductDataTableScope())->render('admin.product.index', compact('data', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->productCategoryResponstory->getAll();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProduct $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $data['alias'] = $data['alias']?\Str::slug($data['alias'], '-'):\Str::slug($data['name'], '-');
            if (!empty($data['image'])){
                $data['image'] = $this->productResponstory->saveFileUpload($data['image'],'products');
            }
            if (!empty($data['image_after'])){
                $data['image_after'] = $this->productResponstory->saveFileUpload($data['image_after'],'products');
            }
            $model = $this->productResponstory->create($data);
            $sortedIds = explode(',', $data['sortedIds']);
            if (!empty($sortedIds)){
                foreach ($sortedIds as $item){
                    ProductsImages::create([
                        'image' => $item,
                        'record_id' => $model->id,
                    ]);
                }
            }
            DB::commit();
            Session::flash('success', trans('message.create_product_success'));
            return redirect()->route('admin.product.edit', $model->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_product_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->productCategoryResponstory->getAll();
        $product = $this->productResponstory->getOneById($id,['productsImages']);
        $images = $product->productsImages;
        $listImages = [];
        foreach ($images as $item){
            $listImages[] = $item->image;
        }
        return view('admin.product.update', compact('product','categories','images','listImages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateProduct $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $product = $this->productResponstory->getOneById($id);
            if (!empty($data['image']) && $product->image != $data['image']){
                if (File::exists(public_path($product->image))) {
                    Storage::delete(str_replace('storage','public',$product->image));
                }
                $data['image'] = $this->productResponstory->saveFileUpload($data['image'],'products');
            }

            if (!empty($data['image_after']) && $product->image_after != $data['image_after']){
                if (File::exists(public_path($product->image_after))) {
                    Storage::delete(str_replace('storage','public',$product->image_after));
                }
                $data['image_after'] = $this->productResponstory->saveFileUpload($data['image_after'],'products');
            }

            if (empty($data['alias'])){
                $data['alias'] = $data['alias']?\Str::slug($data['alias'], '-'):\Str::slug($data['name'], '-');
            }

            if (!empty($data['sortedIds'])){
                $sortedIds = explode(',',$data['sortedIds']);
                if (!empty($sortedIds)){
                    ProductsImages::where('record_id',$id)->delete();
                    foreach ($sortedIds as $item){
                        ProductsImages::create([
                            'image' => $item,
                            'record_id' => $id,
                        ]);
                    }
                }
            }

            $product->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_product_success'));
            return redirect()->route('admin.product.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_product_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = $this->productResponstory->getOneById($id);
        Storage::delete(str_replace('storage','public',$data->image));
        Storage::delete(str_replace('storage','public',$data->image_after));
        $this->productResponstory->delete($id);
        return [
            'status' => true,
            'message' => trans('message.delete_product_success')
        ];
    }
}
