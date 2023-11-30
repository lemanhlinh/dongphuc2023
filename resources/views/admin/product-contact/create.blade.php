@extends('admin.layouts.admin')

@section('title_file', trans('form.order-product.create'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.product-contact.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.product-contact.form.inputs')
            <button type="submit" class="btn btn-primary">@lang('form.button.submit')</button>
        </form>
    </div>
@endsection

@section('script')
    @parent
@endsection

