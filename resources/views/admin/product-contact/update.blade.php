@extends('admin.layouts.admin')

@section('title_file', trans('form.order-product.update'))

@section('content')
    <div class="card card-primary card-body">
        <form action="{{ route('admin.product-contact.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.product-contact.form.inputs')
            <input type="hidden" name="id" value="{{ $contact->id }}">
{{--            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>--}}
        </form>
    </div>
@endsection

@section('script')
    @parent
@endsection
