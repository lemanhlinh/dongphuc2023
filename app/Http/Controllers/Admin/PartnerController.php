<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Student;
use App\Repositories\Contracts\PartnerInterface;
use Illuminate\Http\Request;
use App\DataTables\PartnerDataTable;
use App\Http\Requests\Partner\CreatePartner;
use App\Http\Requests\Partner\UpdatePartner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{

    protected $partnerRepository;
    public function __construct(PartnerInterface $partnerRepository){
        $this->partnerRepository = $partnerRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PartnerDataTable $dataTable)
    {
        return $dataTable->render('admin.partner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePartner $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            if (!empty($data['image'])){
                $data['image'] = $this->partnerRepository->saveFileUpload($data['image'],'partner');
            }
            $model = Partner::create($data);
            DB::commit();
            Session::flash('success', trans('message.create_partner_success'));
            return redirect()->route('admin.partner.edit', $model->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_partner_error'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin.partner.update', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartner $req, $id)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $partner = Partner::findOrFail($id);
            if (!empty($data['image']) && $partner->image != $data['image']){
                if (File::exists(public_path($partner->image))) {
                    Storage::delete(str_replace('storage','public',$partner->image));
                }
                $data['image'] = $this->partnerRepository->saveFileUpload($data['image'],'partner');
            }
            $partner->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_partner_success'));
            return redirect()->route('admin.partner.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_partner_error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Partner::findOrFail($id);
        Storage::delete(str_replace('storage','public',$data->image));
        Partner::destroy($id);

        return [
            'status' => true,
            'message' => trans('message.delete_partner_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $data = Partner::findOrFail($id);
        $data->update(['active' => !$data->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_partner_success')
        ];
    }
}
