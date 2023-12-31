<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sliders;
use Illuminate\Http\Request;
use App\DataTables\SliderDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Slide\CreateSlide;
use App\Http\Requests\Slide\UpdateSlide;
use App\Repositories\Contracts\SlideInterface;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    protected $slideRepository;

    public function __construct(SlideInterface $slideRepository)
    {
        $this->middleware('auth');
        $this->slideRepository = $slideRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSlide $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            if (!empty($data['image'])){
                $data['image'] = $this->slideRepository->saveFileUpload($data['image'],'slider');
            }
            $model = $this->slideRepository->create($data);
            DB::commit();
            Session::flash('success', trans('message.create_slide_success'));
            return redirect()->route('admin.slider.edit', $model->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_slide_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sliders  $sliders
     * @return \Illuminate\Http\Response
     */
    public function show(Sliders $sliders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sliders  $sliders
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = $this->slideRepository->getOneById($id);
        return view('admin.slider.update', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sliders  $sliders
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateSlide $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $slider = $this->slideRepository->getOneById($id);
            if (!empty($data['image']) && $slider->image != $data['image']){
                if (File::exists(public_path($slider->image))) {
                    Storage::delete(str_replace('storage','public',$slider->image));
                    Storage::delete(str_replace('storage','public',str_replace('.webp','-small.webp',$slider->image)));
                }
                $data['image'] = $this->slideRepository->saveFileUpload($data['image'],'slider');
            }
            $slider->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_slide_success'));
            return redirect()->route('admin.slider.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_slide_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sliders  $sliders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->slideRepository->getOneById($id);
        Storage::delete(str_replace('storage','public',$data->image));
        Storage::delete(str_replace('storage','public',str_replace('.webp','-small.webp',$data->image)));
        $this->slideRepository->delete($id);

        return [
            'status' => true,
            'message' => trans('message.delete_slide_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $slider = Sliders::findOrFail($id);
        $slider->update(['active' => !$slider->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_slide_success')
        ];
    }
}
