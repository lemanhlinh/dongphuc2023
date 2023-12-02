<div class="row">
    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>@lang('form.student.title')</label> <span class="text-danger">*</span>
            <input type="text" class="form-control" name="title" value="{{ isset($student) ? $student->title : old('title') }}" required>
            @if ($errors->has('title'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>Chức vụ</label> <span class="text-danger">*</span>
            <input type="text" class="form-control" name="creator" value="{{ isset($student) ? $student->creator : old('creator') }}" required>
            @if ($errors->has('creator'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('creator') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group clearfix">
            <label>@lang('form.student.active')</label> <span class="text-danger">*</span>
            <div class="form-group">
                <div class="icheck-success d-inline">
                    <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\Student::STATUS_ACTIVE }}" {{ isset($student->active) && $student->active == \App\Models\Student::STATUS_ACTIVE ? 'checked' : 'checked' }} required>
                    <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
                <div class="icheck-danger d-inline">
                    <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\Student::STATUS_INACTIVE }}" {{ isset($student->active) && $student->active == \App\Models\Student::STATUS_INACTIVE ? 'checked' : '' }} required>
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
            <label>@lang('form.student.ordering')</label>
            <input type="text" class="form-control" name="ordering" value="{{ isset($student) ? $student->ordering : (old('ordering') ? old('ordering') : 1) }}" >
            @if ($errors->has('ordering'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('ordering') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('form.student.image')</label> <span class="text-danger">*</span>
            <div class="input-group">
                @include('admin.components.buttons.image',['src' => isset($student->image) ? $student->image : old('image'),'name' => 'image'])
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
