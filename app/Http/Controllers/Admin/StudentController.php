<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\DataTables\StudentDataTable;
use App\Http\Requests\Student\CreateStudent;
use App\Http\Requests\Student\UpdateStudent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Repositories\Contracts\StudentInterface;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    protected $studentRepository;
    public function __construct(StudentInterface $studentRepository){
        $this->studentRepository = $studentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StudentDataTable $dataTable)
    {
        return $dataTable->render('admin.student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStudent $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            if (!empty($data['image'])){
                $data['image'] = $this->studentRepository->saveFileUpload($data['image'],'student');
            }
            $model = Student::create($data);
            DB::commit();
            Session::flash('success', trans('message.create_student_success'));
            return redirect()->route('admin.student.edit', $model->id);
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.create_article_error'));
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
        $student = Student::findOrFail($id);
        return view('admin.student.update', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudent $req, $id)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $student = Student::findOrFail($id);
            if (!empty($data['image']) && $student->image != $data['image']){
                if (File::exists(public_path($student->image))) {
                    Storage::delete(str_replace('storage','public',$student->image));
                }
                $data['image'] = $this->studentRepository->saveFileUpload($data['image'],'student');
            }
            $student->update($data);
            DB::commit();
            Session::flash('success', trans('message.update_student_success'));
            return redirect()->route('admin.student.edit', $id);
        } catch (\Exception $exception) {
            \Log::info([
                'message' => $exception->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            Session::flash('danger', trans('message.update_student_error'));
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
        $data = Student::findOrFail($id);
        Storage::delete(str_replace('storage','public',$data->image));
        Student::destroy($id);

        return [
            'status' => true,
            'message' => trans('message.delete_student_success')
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function changeActive($id)
    {
        $data = Student::findOrFail($id);
        $data->update(['active' => !$data->active]);
        return [
            'status' => true,
            'message' => trans('message.change_active_student_success')
        ];
    }
}
