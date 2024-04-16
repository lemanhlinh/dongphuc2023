<div class="row">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.product_category.name')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="name" value="{{ isset($product_category) ? $product_category->name : old('name') }}" required>
                    @if ($errors->has('name'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.product_category.slug')</label> <span class="text-danger">(@lang('form.auto_slug'))</span>
                    <input type="text" class="form-control" name="alias" value="{{ isset($product_category) ? $product_category->alias : old('alias') }}">
                    @if ($errors->has('alias'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('alias') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.product_category.image')</label> <span class="text-danger">*</span>
                    <div class="input-group">
                        @include('admin.components.buttons.image',['src' => isset($product_category->image) ? $product_category->image : old('image'),'name' => 'image'])
                        @if ($errors->has('image'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.product_category.ordering')</label>
                    <input type="text" class="form-control" name="ordering" value="{{ isset($product_category) ? $product_category->ordering : old('ordering') }}" >
                    @if ($errors->has('ordering'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('ordering') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group clearfix">
                    <label>@lang('form.product_category.active')</label> <span class="text-danger">*</span>
                    <div class="form-group">
                        <div class="icheck-success d-inline">
                            <input class="" type="radio" id="activeRadio1" name="active" value="{{ \App\Models\ProductsCategories::STATUS_ACTIVE }}" {{ isset($product_category) && $product_category->active == \App\Models\productsCategories::STATUS_ACTIVE ? 'checked' : (old('active') && (old('active') == \App\Models\productsCategories::STATUS_ACTIVE)) ? 'checked' : '' }}  required>
                            <label for="activeRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="activeRadio2" name="active" value="{{ \App\Models\productsCategories::STATUS_INACTIVE }}" {{ isset($product_category) && $product_category->active == \App\Models\productsCategories::STATUS_INACTIVE ? 'checked' : (old('active') && (old('active') === \App\Models\productsCategories::STATUS_INACTIVE)) ? 'checked' : '' }}  required>
                            <label for="activeRadio2" class="custom-control-label">@lang('form.status.inactive')</label>
                        </div>
                    </div>
                    @if ($errors->has('active'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('active') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group clearfix">
                    <label>@lang('form.product_category.is_home')</label> <span class="text-danger">*</span>
                    <div class="form-group">
                        <div class="icheck-success d-inline">
                            <input class="" type="radio" id="homeRadio1" name="is_home" value="{{ \App\Models\productsCategories::IS_HOME }}" {{ (isset($product_category->is_home) && $product_category->is_home == \App\Models\productsCategories::IS_HOME) ? 'checked' : (old('is_home') && (old('is_home') == \App\Models\productsCategories::IS_HOME)) ? 'checked' : '' }}  required>
                            <label for="homeRadio1" class="custom-control-label">@lang('form.status.is_home')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="homeRadio2" name="is_home" value="{{ \App\Models\productsCategories::IS_NOT_HOME }}" {{ (isset($product_category) && $product_category->is_home == \App\Models\productsCategories::IS_NOT_HOME) ? 'checked' : (old('is_home') && (old('is_home') == \App\Models\productsCategories::IS_NOT_HOME)) ? 'checked' : '' }}  required>
                            <label for="homeRadio2" class="custom-control-label">@lang('form.status.is_not_home')</label>
                        </div>
                    </div>
                    @if ($errors->has('is_home'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('is_home') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">SEO</h3>
            </div>
            <div class="card-body p-3">
                <div class="form-group">
                    <label>@lang('form.seo_title')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="seo_title" value="{{ isset($product_category) ? $product_category->seo_title : old('seo_title') }}" >
                    @if ($errors->has('seo_title'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('seo_title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>@lang('form.seo_keyword')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="seo_keyword" value="{{ isset($product_category) ? $product_category->seo_keyword : old('seo_keyword') }}" >
                    @if ($errors->has('seo_keyword'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('seo_keyword') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>@lang('form.seo_description')</label> <span class="text-danger">*</span>
                    <textarea class="form-control" rows="3" name="seo_description" >{{ isset($product_category) ? $product_category->seo_description : old('seo_description') }}</textarea>
                    @if ($errors->has('seo_description'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('seo_description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('form.content')</label>
            <textarea id="content" name="content" class="form-control" rows="10" >{{ isset($product_category->content) ? $product_category->content : old('content') }}</textarea>
            @if ($errors->has('content'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
            <div class="editor"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>@lang('form.content_top')</label>
            <textarea id="content_top" name="content_top" class="form-control" rows="10" >{{ isset($product_category->content_top) ? $product_category->content_top : old('content_top') }}</textarea>
            @if ($errors->has('content_top'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('content_top') }}</strong>
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
