<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Mail\QuoteMail;
use App\Models\Attribute;
use App\Models\Banners;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductsCategories;
use App\Models\ProductsContacts;
use App\Models\ProductsImages;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductCategoryInterface;
use App\Repositories\Contracts\ProductInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Order\CreateOrder;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{

    protected $productCategoryRepository,$productRepository ;
    public function __construct(ProductCategoryInterface $productCategoryRepository,ProductInterface $productRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->productRepository = $productRepository;
    }

    public function cat($slug){
        if (preg_match('/^(.+)-page(\d+)/', $slug, $matches)) {
            $page = $matches[2];
            $slug = $matches[1];
            return Redirect::route('catProduct', ['slug' => $slug, 'page' => $page], 301);
        }
        $cat = $this->productCategoryRepository->getOneBySlug($slug);
        if (!$cat) {
            \Log::info([
                'message' => 'pro-cat:'.$slug,
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            abort(404);
        }
        $products = Product::where(['active' => 1])->where('category_id_wrapper','like','%'.$cat->id.'%')
            ->select('id','name','image','image_after','price','alias')
            ->limit(10)->paginate(30 ?? config('data.limit', 20));
        $cat_product_home = ProductsCategories::where(['active' => 1,'is_home' => 1])->select('id','name','alias')->withDepth()->defaultOrder()->get()->toTree();
        $banners = Banners::where(['active' => 1])->select('id','name','alias','image','link','content','type')->get();

        SEOTools::setTitle($cat->seo_title?$cat->seo_title:$cat->name);
        SEOTools::setDescription($cat->seo_description?$cat->seo_description:$cat->description);
        SEOTools::addImages($cat->image?asset($cat->image):null);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite(\Request::root());
        SEOMeta::setKeywords($cat->seo_keyword?$cat->seo_keyword:$cat->name);

        return view('web.product.cat',compact('cat','products','cat_product_home','banners'));
    }

    public function detail ($cat_slug,$slug){
        $product = Product::where(['alias' => $slug])->with(['category'])->first();
        if (!$product) {
            \Log::info([
                'message' => 'pro-detail:'.$slug,
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            return Redirect::route('home');
        }
        $product_images = ProductsImages::where('record_id', $product->id)->get();
        $product_related = Product::select('id','name','alias', 'category_id' ,'image','category_alias','created_at','image_after')->where(['category_id' => $product->category_id,'active' => 1])->limit(6)->get();
        $cat_product_home = ProductsCategories::where(['active' => 1,'is_home' => 1])->select('id','name','alias')->withDepth()->defaultOrder()->get()->toTree();
        $banners = Banners::where(['active' => 1])->select('id','name','alias','image','link','content','type')->get();

        SEOTools::setTitle($product->seo_title?$product->seo_title:$product->name);
        SEOTools::setDescription($product->seo_description?$product->seo_description:$product->name);
        SEOTools::addImages($product->image?asset($product->image):null);
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite(\Request::root());
        SEOMeta::setKeywords($product->seo_keyword?$product->seo_keyword:$product->name);

        return view('web.product.detail',compact('product','cat_product_home','banners','product_related','cat_slug','product_images'));
    }

    public function is_new(){
        $products = Product::where(['active' => 1,'is_new' => 1])
            ->select('id','title','image','brand','hot_deal','sku','slug')
            ->with(['productOption' => function($query){
                $query->where(['is_default' => 1,'active' => 1])
                    ->select('id','sku', 'title', 'parent_id','price','slug','images');
            }])->limit(10)->paginate(12);
        return view('web.product.new',compact('products'));
    }

    public function addToCart (Request $req){
        $productId = $req['id'];
        $quantity = $req['quantity'];
        $product = Product::where(['id' => $productId])->first();;

        if (!$product) {
            abort(404);
        }

        $cart = Session::get('cart', []);

        if (array_key_exists($product->id, $cart)) {
            // Sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng
            $cart[$product->id]['quantity'] = $cart[$product->id]['quantity']+$quantity;
        } else {
            // Sản phẩm chưa tồn tại trong giỏ hàng, thêm mới
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        Session::put('cart', $cart);

        $totalQuantity = 0;
        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }

        return response()->json(array(
            'success' => true,
            'total'   => $totalQuantity
        ));
    }

    public function showCart()
    {
        $cart = Session::get('cart', []);

        // Duyệt qua các sản phẩm trong giỏ hàng để lấy thông tin sản phẩm
        $cartItems = [];
        $total_price = 0;
        if (!$cart){
            Session::flash('danger', 'Chưa có sản phẩm nào trong giỏ hàng');
            return redirect()->route('home');
        }
        foreach ($cart as $productId => $item) {
            $product = Product::where(['id' => $productId])->first();
            $quantity = $item['quantity']; // Số lượng
            // Thêm thông tin sản phẩm vào danh sách
            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product->price * $quantity, // Tính tổng tiền cho mỗi sản phẩm
            ];
            $total_price = $total_price + $product->price * $quantity;
        }

        return view('web.cart.cart', compact('cart','cartItems','total_price'));
    }

    public function updateCart(Request $request)
    {
        $productId = $request->input('id');
        $quantity = $request->input('quantity');

        // Lấy giỏ hàng hiện tại từ Session
        $cart = Session::get('cart', []);

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (array_key_exists($productId, $cart)) {
            // Cập nhật số lượng sản phẩm
            $cart[$productId]['quantity'] = $quantity;

            // Lưu giỏ hàng vào Session
            Session::put('cart', $cart);

            // Trả về thông báo cập nhật thành công hoặc redirect đến trang giỏ hàng
            $totalQuantity = 0;

            $total_price = 0;
            foreach ($cart as $id => $item) {
                $totalQuantity += $item['quantity'];

                $product = $this->productRepository->getOneById($id);
                $quantity = $item['quantity']; // Số lượng

                // Thêm thông tin sản phẩm vào danh sách
//                $cartItems[] = [
//                    'product' => $product,
//                    'quantity' => $quantity,
//                    'subtotal' => $product->price * $quantity, // Tính tổng tiền cho mỗi sản phẩm
//                ];
                $total_price = $total_price + $product->price * $quantity;
            }

            return response()->json(array(
                'success' => true,
                'total'   => $totalQuantity
            ));
        } else {
            // Sản phẩm không tồn tại trong giỏ hàng, xử lý lỗi
        }
    }

    public function removeItem(Request $request, $productId)
    {
        // Lấy giỏ hàng hiện tại từ Session
        $cart = Session::get('cart', []);

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (array_key_exists($productId, $cart)) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($cart[$productId]);

            // Lưu giỏ hàng vào Session
            Session::put('cart', $cart);

            // Trả về thông báo xóa thành công hoặc redirect đến trang giỏ hàng
            Session::flash('success', 'Xóa sản phẩm trong giỏ hàng thành công');
            return redirect()->back();
        } else {
            // Sản phẩm không tồn tại trong giỏ hàng, xử lý lỗi
            Session::flash('danger', 'Chưa xóa được sản phẩm trong giỏ hàng');
            return redirect()->back();
        }
    }

    public function order (CreateOrder $req){
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $data['payment'] = $data['method_pay'];
            $order = Order::create($data);

            $cart = Session::get('cart', []);
            foreach ($cart as $productId => $item) {
                $product = $this->productRepository->getOneById($productId);
                if (empty($product)){
                    unset($cart[$productId]);
                    Session::flash('danger', 'Có sản phẩm không còn tồn tại');
                    return redirect()->back();
                }
                $quantity = $item['quantity']; // Số lượng
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_title' => $product->name,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'total' => $product->price*$quantity,
                ]);
            }
            DB::commit();
            Session::forget('cart');
            $getEmail = Setting::where('key', 'admin_email')->first();
            $listEmail = explode(',',$getEmail->value);
            Mail::to($listEmail)->send(new OrderMail($data));
            Session::flash('success', trans('message.create_order_success'));
            return redirect()->route('home');
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);

            Session::flash('danger', trans('message.create_order_error'));
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function contactProduct(Request $request){
        $product_id = $request->input('id');
        $router = $request->input('saveQuote');
        return view('web.product.ajax.formQuote', compact('product_id','router'));
    }

    public function saveQuote(Request $request)
    {
        $id_product =  $request->input('id');
        $product = null;
        if ($id_product){
            $product = Product::findOrFail($id_product);
        }
        DB::beginTransaction();
        try {
            ProductsContacts::create(
                [
                    'fullname' => $request->input('name_contact'),
                    'telephone' => $request->input('phone_contact'),
                    'email' => $request->input('email_contact'),
                    'id_product' => $id_product?$id_product:null,
                    'name_product' => $product?$product->name:null,
                    'number_product' => $request->input('number_contact'),
                ]
            );
            DB::commit();
            $getEmail = Setting::where('key', 'admin_email')->first();
            $listEmail = explode(',',$getEmail->value);
            Mail::to($listEmail)->send(new QuoteMail($request));
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
