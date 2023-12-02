<div class="row">
    <div class="col-sm-6">
        <!-- text input -->
        <div class="form-group">
            <label>@lang('form.partner.name')</label> <span class="text-danger">*</span>
            <input type="text" class="form-control" name="name" value="{{ isset($partner) ? $partner->name : old('name') }}" required>
            @if ($errors->has('name'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group clearfix">
            <label>@lang('form.partner.active')</label> <span class="text-danger">*</span>
            <div class="form-group">
                <div class="icheck-success d-inline">
                    <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\Partner::STATUS_ACTIVE }}" {{ isset($partner->active) && $partner->active == \App\Models\Partner::STATUS_ACTIVE ? 'checked' : 'checked' }} required>
                    <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                </div>
                <div class="icheck-danger d-inline">
                    <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\Partner::STATUS_INACTIVE }}" {{ isset($partner->active) && $partner->active == \App\Models\Partner::STATUS_INACTIVE ? 'checked' : '' }} required>
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
            <label>@lang('form.partner.ordering')</label>
            <input type="text" class="form-control" name="ordering" value="{{ isset($partner) ? $partner->ordering : (old('ordering') ? old('ordering') : 1) }}" >
            @if ($errors->has('ordering'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('ordering') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>@lang('form.partner.image')</label> <span class="text-danger">*</span>
            <div class="input-group">
                @include('admin.components.buttons.image',['src' => isset($partner->image) ? $partner->image : old('image'),'name' => 'image'])
                @if ($errors->has('image'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>
@section('script')
    @parent
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
@endsection
