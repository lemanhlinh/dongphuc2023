@extends('admin.layouts.admin')

@section('title_file', trans('form.partner.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.partner.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.partner.form.inputs')
            <input type="hidden" name="id" value="{{ $partner->id }}">
            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>
        </form>
    </div>
@endsection
