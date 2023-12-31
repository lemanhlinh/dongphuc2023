<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\Partner;
use App\Repositories\Contracts\BannerInterface;
use Illuminate\Http\Request;
use App\DataTables\BannerDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Banner\CreateBanner;
use App\Http\Requests\Banner\UpdateBanner;

class BannerController extends Controller
{

    protected $bannerRepository;
    public function __construct(BannerInterface $bannerRepository){
        $this->bannerRepository = $bannerRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BannerDataTable $dataTable)
    {
        return $dataTable->render('admin.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Banners::TYPE;
        return view('admin.banner.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBanner $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            if (!empty($data['image'])){
                $data['image'] = $this->bannerRepository->saveFileUpload($data['image'],'banner');
            }
            $model = Banners::create($data);
            DB::commit();
            Session::flash('success', trans('message.create_banner_success'));
            return redirect()->route('admin.banner.edit', $model->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_banner_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banners $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banners::findOrFail($id);
        $types = Banners::TYPE;
        return view('admin.banner.update', compact('banner','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBanner $req, $id)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $banner = Banners::findOrFail($id);
            if (!empty($data['image']) && $banner->image != $data['image']){
                if (File::exists(public_path($banner->image))) {
                    Storage::delete(str_replace('storage','public',$banner->image));
                }
                $data['image'] = $this->bannerRepository->saveFileUpload($data['image'],'banner');
            }
            $banner->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_banner_success'));
            return redirect()->route('admin.banner.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_banner_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Banners::findOrFail($id);
        Storage::delete(str_replace('storage','public',$data->image));
        Banners::destroy($id);

        return [
            'status' => true,
            'message' => trans('message.delete_banner_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $data = Banners::findOrFail($id);
        $data->update(['active' => !$data->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_banner_success')
        ];
    }
}
