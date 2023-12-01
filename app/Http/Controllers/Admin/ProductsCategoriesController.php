<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsCategories;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductCategoryInterface;
use App\Repositories\Contracts\ProductInterface;
use App\DataTables\ProductCategoryDataTable;
use App\Http\Requests\Product\CreateCategoryProduct;
use App\Http\Requests\Product\UpdateCategoryProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductsCategoriesController extends Controller
{

    protected $productCategoryRepository,$productRepository;

    public function __construct(ProductCategoryInterface $productCategoryRepository,ProductInterface $productRepository )
    {
        $this->middleware('auth');
        $this->productCategoryRepository = $productCategoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.product-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateCategoryProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryProduct $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $data['alias'] = $data['alias']?\Str::slug($data['alias'], '-'):\Str::slug($data['name'], '-');
            if (!empty($data['image'])){
                $data['image'] = $this->productCategoryRepository->saveFileUpload($data['image'],'products-categories');
            }
            $model = $this->productCategoryRepository->create($data);
            DB::commit();
            Session::flash('success', trans('message.create_product_category_success'));
            return redirect()->route('admin.product-category.edit', $model->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_product_category_error'));
            return redirect()->back();
        }
    }

    public function sort()
    {
        $cats = ProductsCategories::where(['published' => 1])->select('id','name','parent_id','alias','_lft','_rgt')->get();
        return view('admin.product-category.sort',compact('cats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductsCategories  $productsCategories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_category = $this->productCategoryRepository->getOneById($id);
        return view('admin.product-category.update', compact('product_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductsCategories  $productsCategories
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateCategoryProduct $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $cat = $this->productCategoryRepository->getOneById($id);
            if (!empty($data['image']) && $cat->image != $data['image']){
                if (File::exists(public_path($cat->image))) {
                    Storage::delete(str_replace('storage','public',$cat->image));
                }
                $data['image'] = $this->productCategoryRepository->saveFileUpload($data['image'],'products-categories');
            }
            if (empty($data['alias'])){
                $data['alias'] = $data['alias']?\Str::slug($data['alias'], '-'):\Str::slug($data['name'], '-');
            }
            $cat->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_product_category_success'));
            return redirect()->route('admin.product-category.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_product_category_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductsCategories  $productsCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = $this->productCategoryRepository->getOneById($id,['products']);

        if (!empty($cat->products)){
            return [
                'status' => false,
                'message' => "Danh mục này vẫn còn sản phẩm"
            ];
        }else{
            Storage::delete(str_replace('storage','public',$cat->image));
            $this->productCategoryRepository->delete($id);
            return [
                'status' => true,
                'message' => trans('message.delete_product_category_success')
            ];
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param updateTree $request
     * @return \Illuminate\Http\Response
     */
    public function updateTree(Request $request)
    {
        $data = $request->data;
        $this->productCategoryRepository->updateTreeRebuild('id', $data);
        return response()->json($data);
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $product_category = ProductsCategories::findOrFail($id);
        $product_category->update(['active' => !$product_category->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_product_category_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeIsHome($id)
    {
        $product_category = ProductsCategories::findOrFail($id);
        $product_category->update(['is_home' => !$product_category->is_home]);
        return [
            'status' => true,
            'message' => trans('message.change_active_product_category_success')
        ];
    }
}
