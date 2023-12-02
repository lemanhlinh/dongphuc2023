@extends('admin.layouts.admin')

@section('title_file', trans('form.student.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.student.form.inputs')
            <input type="hidden" name="id" value="{{ $student->id }}">
            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>
        </form>
    </div>
@endsection
