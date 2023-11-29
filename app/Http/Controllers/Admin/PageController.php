<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use App\DataTables\PageDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Repositories\Contracts\PageInterface;
use App\Http\Requests\Page\CreatePage;
use App\Http\Requests\Page\UpdatePage;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{

    protected $pageRepository;
    protected $resizeImage;

    public function __construct(PageInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->resizeImage = $this->pageRepository->resizeImage();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PageDataTable $dataTable)
    {
        return $dataTable->render('admin.page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePage $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $image_root = '';
            $data['alias'] = $req->input('alias')?\Str::slug($req->input('alias'), '-'):\Str::slug($data['title'], '-');
            $model = $this->pageRepository->create($data);
            DB::commit();
            Session::flash('success', trans('message.create_page_success'));
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_page_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = $this->pageRepository->getOneById($id);
        return view('admin.page.update', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdatePage $req)
    {
        $data_root = $this->pageRepository->getOneById($id);
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $page = $this->pageRepository->getOneById($id);
            if (empty($data['alias'])){
                $data['alias'] = $req->input('alias')?\Str::slug($req->input('alias'), '-'):\Str::slug($data['title'], '-');
            }
            $page->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_page_success'));
            return redirect()->route('admin.page.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_page_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->pageRepository->getOneById($id);

        // Đường dẫn tới tệp tin
        $resize = $this->resizeImage;
        $img_path = pathinfo($data->image, PATHINFO_DIRNAME);
        foreach ($resize as $item){
            $array_resize_ = str_replace($img_path.'/','/public/page/'.$item[0].'x'.$item[1].'/'.$data->id.'-',$data->image);
            $array_resize_ = str_replace(['.jpg', '.png','.bmp','.gif','.jpeg'],'.webp',$array_resize_);
            Storage::delete($array_resize_);
        }
        $this->pageRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_page_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $page = Page::findOrFail($id);
        $page->update(['active' => !$page->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_page_success')
        ];
    }
}
