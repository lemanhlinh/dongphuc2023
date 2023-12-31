<div class="row">
    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>@lang('form.banner.name')</label> <span class="text-danger">*</span>
            <input type="text" class="form-control" name="name" value="{{ isset($banner) ? $banner->name : old('name') }}" required>
            @if ($errors->has('name'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Loại</label>
            <select class="form-control" id="type" name="type">
                @foreach($types as $k => $type)
                    <option value="{{ $k }}" {{ (isset($banner) && $banner->type == $k) ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group clearfix">
            <label>@lang('form.banner.active')</label> <span class="text-danger">*</span>
            <div class="form-group">
                <div class="icheck-success d-inline">
                    <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\Banners::STATUS_ACTIVE }}" {{ isset($banner->active) && $banner->active == \App\Models\Banners::STATUS_ACTIVE ? 'checked' : 'checked' }} required>
                    <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
                <div class="icheck-danger d-inline">
                    <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\Banners::STATUS_INACTIVE }}" {{ isset($banner->active) && $banner->active == \App\Models\Banners::STATUS_INACTIVE ? 'checked' : '' }} required>
                    <label for="statusRadio2" class="custom-control-label">@lang('form.status.inactive')</label>
                </div>
            </div>
            @if ($errors->has('active'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('active') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-3">
        <!-- text input -->
        <div class="form-group">
            <label>@lang('form.banner.ordering')</label>
            <input type="text" class="form-control" name="ordering" value="{{ isset($banner) ? $banner->ordering : (old('ordering') ? old('ordering') : 1) }}" >
            @if ($errors->has('ordering'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('ordering') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('form.banner.image')</label> <span class="text-danger">*</span>
            <div class="input-group">
                @include('admin.components.buttons.image',['src' => isset($banner->image) ? $banner->image : old('image'),'name' => 'image'])
                @if ($errors->has('image'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('form.content')</label> <span class="text-danger">*</span>
            <textarea id="content" name="content" class="form-control" rows="10" >{{ isset($banner->content) ? $banner->content : old('content') }}</textarea>
            @if ($errors->has('content'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
            <div class="editor"></div>
        </div>
    </div>
</div>
@section('script')
    @parent
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection
