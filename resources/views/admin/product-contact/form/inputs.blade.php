<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.product-contact.fullname')</label>
                    <input type="text" class="form-control" name="fullname" value="{{ isset($contact) ? $contact->fullname : old('fullname') }}" readonly>
                    @if ($errors->has('fullname'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('fullname') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.product-contact.telephone')</label>
                    <input type="text" class="form-control" name="telephone" value="{{ isset($contact) ? $contact->telephone : old('telephone') }}" readonly>
                    @if ($errors->has('telephone'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('telephone') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.product-contact.number_product')</label>
                    <input type="text" class="form-control" name="telephone" value="{{ isset($contact) ? $contact->number_product : old('number_product') }}" readonly required>
                    @if ($errors->has('number_product'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('number_product') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.product-contact.email')</label>
                    <input type="text" class="form-control" name="email" value="{{ isset($contact) ? $contact->email : old('email') }}" readonly>
                    @if ($errors->has('email'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.product-contact.name_product')</label>
                    <input type="text" class="form-control" name="name_product" value="{{ isset($contact) ? $contact->name_product : old('name_product') }}" readonly>
                    @if ($errors->has('name_product'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('name_product') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@section('link')
    @parent
@endsection

@section('script')
    @parent
@endsection
