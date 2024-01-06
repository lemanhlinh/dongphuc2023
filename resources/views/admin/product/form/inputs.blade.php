<div class="row" id="form-product-option">
{{--    đánh dấu loại tin tức--}}
    <input type="hidden" value="0" name="type" id="type">
    <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.product.name')</label> <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="name" value="{{ isset($product) ? $product->name : old('name') }}" required>
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
                    <label>@lang('form.product.alias')</label> <span class="text-danger">(@lang('form.auto_slug'))</span>
                    <input type="text" class="form-control" name="alias" value="{{ isset($product) ? $product->alias : old('alias') }}">
                    @if ($errors->has('alias'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('alias') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group clearfix">
                    <label>@lang('form.product.active')</label> <span class="text-danger">*</span>
                    <div class="form-group">
                        <div class="icheck-success d-inline">
                            <input class="" type="radio" id="statusRadio1" name="active" value="{{ \App\Models\Product::STATUS_ACTIVE }}" {{ (isset($product->active) && $product->active == \App\Models\product::STATUS_ACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\product::STATUS_ACTIVE)) ? 'checked' : '' }}  required>
                            <label for="statusRadio1" class="custom-control-label">@lang('form.status.active')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="statusRadio2" name="active" value="{{ \App\Models\Product::STATUS_INACTIVE }}" {{ (isset($product) && $product->active == \App\Models\product::STATUS_INACTIVE) ? 'checked' : (old('active') && (old('active') == \App\Models\product::STATUS_INACTIVE)) ? 'checked' : '' }}  required>
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
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group clearfix">
                    <label>@lang('form.product.is_home')</label> <span class="text-danger">*</span>
                    <div class="form-group">
                        <div class="icheck-success d-inline">
                            <input class="" type="radio" id="homeRadio1" name="is_home" value="{{ \App\Models\Product::IS_HOME }}" {{ (isset($product->is_home) && $product->is_home == \App\Models\product::IS_HOME) ? 'checked' : (old('is_home') && (old('is_home') == \App\Models\product::IS_HOME)) ? 'checked' : '' }}  required>
                            <label for="homeRadio1" class="custom-control-label">@lang('form.status.is_home')&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-danger d-inline">
                            <input class="" type="radio" id="homeRadio2" name="is_home" value="{{ \App\Models\Product::IS_NOT_HOME }}" {{ (isset($product) && $product->is_home == \App\Models\product::IS_NOT_HOME) ? 'checked' : (old('is_home') && (old('is_home') == \App\Models\product::IS_NOT_HOME)) ? 'checked' : '' }}  required>
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
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.product.sku')</label>
                    <input type="text" class="form-control" name="sku" value="{{ isset($product) ? $product->sku : old('sku') }}">
                    @if ($errors->has('sku'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('sku') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.product.category')</label> <span class="text-danger">*</span>
                    <select name="category_id" id="category_id" class="form-control" required>
                        @forelse($categories as $key => $category)
                            <option value="{{ $category['id'] }}" {{ isset($product->category_id) && $product->category_id == $category['id'] ? 'selected' : old('category_id') == $category['id'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Ảnh trước</label> <span class="text-danger">*</span>
                    <div class="input-group">
                        @include('admin.components.buttons.image',['src' => isset($product->image) ? $product->image : old('image'),'name' => 'image'])
                        @if ($errors->has('image'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Ảnh sau</label> <span class="text-danger">*</span>
                    <div class="input-group">
                        @include('admin.components.buttons.image',['src' => isset($product->image_after) ? $product->image_after : old('image_after'),'name' => 'image_after'])
                        @if ($errors->has('image_after'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('image_after') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.product.ordering')</label>
                    <input type="text" class="form-control" name="ordering" value="{{ isset($product) ? $product->ordering : old('ordering') }}" >
                    @if ($errors->has('ordering'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('ordering') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.product.price')</label>
                    <input type="text" class="form-control" name="price" value="{{ isset($product) ? $product->price : old('price') }}" >
                    @if ($errors->has('price'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">SEO</h3>
                    </div>
                    <div class="card-body p-3">
                        <div class="form-group">
                            <label>@lang('form.seo_title')</label>
                            <input type="text" class="form-control" name="seo_title" value="{{ isset($product) ? $product->seo_title : old('seo_title') }}" >
                            @if ($errors->has('seo_title'))
                                <span class="help-block text-danger">
                            <strong>{{ $errors->first('seo_title') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('form.seo_keyword')</label>
                            <input type="text" class="form-control" name="seo_keyword" value="{{ isset($product) ? $product->seo_keyword : old('seo_keyword') }}" >
                            @if ($errors->has('seo_keyword'))
                                <span class="help-block text-danger">
                            <strong>{{ $errors->first('seo_keyword') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('form.seo_description')</label>
                            <textarea class="form-control" rows="3" name="seo_description" >{{ isset($product) ? $product->seo_description : old('seo_description') }}</textarea>
                            @if ($errors->has('seo_description'))
                                <span class="help-block text-danger">
                            <strong>{{ $errors->first('seo_description') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-12">
                    <button id="ckfinder-modal" type="button" class="btn btn-success button-a button-a-background" style="float: left">UpLoad</button>
                    <div id="sortable-container">
                        @if(!empty($images))
                            @forelse($images as $item)
                                <span class="mr-2 mb-3" style="width: 200px;">
                                        <img src="{{ asset(replace_image($item)) }}" class="img-responsive mr-2" style="width: 50px;">
                                        <button class="delete-btn" type="button">Xóa</button>
                                    </span>
                            @empty
                            @endforelse
                        @endif
                    </div>
                    <input type="hidden" name="sortedIds" id="sortedIdsInput" value="{{ (!empty($images))?replace_image(implode(',',$images)):'' }}">
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>Mô tả ngắn</label> <span class="text-danger">*</span>
            <textarea id="content_info" name="content_info" class="form-control" rows="10" >{{ isset($product->content_info) ? $product->content_info : old('content_info') }}</textarea>
            @if ($errors->has('content_info'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('content_info') }}</strong>
                </span>
            @endif
            <div class="editor"></div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>Thông tin sản phẩm</label> <span class="text-danger">*</span>
            <textarea id="content" name="content" class="form-control" rows="10" >{{ isset($product->content) ? $product->content : old('content') }}</textarea>
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
    <script src="{{ asset('js/admin/Sortable.js') }}"></script>
    <script>
        CKEDITOR.replace( 'content' );
        CKEDITOR.replace( 'content_info' );

        const sortableContainer = document.getElementById('sortable-container');
        $('#ckfinder-modal').on('click', function() {
            CKFinder.modal({
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function(finder) {
                    finder.on('files:choose', function(evt) {
                        const files = evt.data.files;
                        files.forEach( function( file, i ) {
                            const fileroot = file.getUrl();
                            const divElement = document.createElement('span');
                            divElement.classList.add('mr-2');
                            divElement.classList.add('mb-3');
                            divElement.style.width = '200px';
                            divElement.innerHTML = `
                                    <img src="${fileroot}" class="img-responsive mr-2" style="width: 50px;">
                                    <button class="delete-btn" type="button">Xóa</button>
                                `;
                            sortableContainer.appendChild(divElement);
                        });
                        updateSortedIdsInput();
                        deleteImages();
                    });

                    finder.on('file:choose:resizedImage', function(evt) {
                        const files = evt.data.resizedUrl;
                        files.forEach( function( file, i ) {
                            const fileroot = file.getUrl();
                            const divElement = document.createElement('span');
                            divElement.classList.add('mr-2');
                            divElement.classList.add('mb-3');
                            divElement.style.width = '200px';
                            divElement.innerHTML = `
                                    <img src="${fileroot}" class="img-responsive mr-2" style="width: 50px;">
                                    <button class="delete-btn" type="button">Xóa</button>
                                `;
                            sortableContainer.appendChild(divElement);
                        });
                        updateSortedIdsInput();
                        deleteImages();
                    });
                }
            });
        });

        function updateSortedIdsInput() {
            const imageElements = $('#sortable-container img');
            const imageLinks = imageElements.map(function() {
                return this.src.replace(/^.*\/\/[^/]+/, '');
            }).get();
            $('#sortedIdsInput').val(imageLinks.join(','));
        }

        function deleteImages() {
            $('#form-product-option .delete-btn').on('click', function() {
                var confirmed = confirm('Bạn có chắc chắn muốn xóa?');

                if (confirmed) {
                    $(this).parent().remove();
                    var imageElements = $('#sortable-container img');
                    var imageLinks = imageElements.map(function() {
                        return this.src.replace(/^.*\/\/[^/]+/, '');
                    }).get();
                    $('#sortedIdsInput').val(imageLinks.join(','));
                }
            });
        }
    </script>
@endsection
