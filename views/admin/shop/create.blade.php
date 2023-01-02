@extends('admin.layouts.master-soyuz')
@section('title',__('Create new product | '))
@section('body')
@component('admin.component.breadcumb',['thirdactive' => 'active'])

@slot('heading')
{{ __('Add Shop Type') }}
@endslot
@slot('menu1')
{{ __("Recovery Truck") }}
@endslot
@slot('menu2')
{{ __("Add Shop Type") }}
@endslot
@slot('button')
<div class="col-md-6">
    <div class="widgetbar">
        <a href="{{ route('shop.index') }}" class="btn btn-primary-rgba"><i
                class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}</a>
    </div>
</div>
@endslot
​
@endcomponent
<div class="contentbar">
    <div class="row">

        <div class="col-lg-12">
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach($errors->all() as $error)
                <p>
                    {{ $error}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </p>
                @endforeach
            </div>
            @endif
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="box-title">{{ __('Create New Shop Type') }}</h5>
                </div>
                <div class="card-body ml-2">
                    <!-- main content start -->
                    <form action="{{ route("shop.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Workshop Name : ") }}<span
                                            class="text-danger">*</span></label>
                                    <input placeholder="{{ __("Workshop Name") }}" required type="text"
                                        value="{{ old('name') }}" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Latitude : ") }}<span
                                            class="text-danger">*</span></label>
                                    <input placeholder="{{ __("Latitude") }}" required type="text"
                                        value="{{ old('lat') }}" class="form-control" name="lat">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Longitude : ") }}<span
                                            class="text-danger">*</span></label>
                                    <input placeholder="{{ __("Longitude") }}" required type="text"
                                        value="{{ old('lng') }}" class="form-control" name="lng">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Location : ") }}<span
                                            class="text-danger">*</span></label>
                                    <input placeholder="{{ __("Location") }}" required type="text"
                                        value="{{ old('location') }}" class="form-control" name="location">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Emirates : ") }}<span
                                            class="text-danger">*</span></label>
                                    <select required data-placeholder="{{ __("Please select Emirates") }}"
                                        name="emirates" id="emirates" class="select2 product_type form-control">
                                        <option value="">{{ __("Please select Emirates") }}</option>
                                        @foreach($states as $state)
                                            <option {{ old('emirates') == $state->name ? "selected" : "" }}
                                            value="{{$state->name}}">{{ __($state->name) }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Workshop Timing : ") }}<span
                                            class="text-danger">*</span></label>
                                    <input placeholder="{{ __("Workshop Timing") }}" required type="text"
                                        value="{{ old('timing') }}" class="form-control" name="timing" id="timing">
                                    <input type="checkbox" name="timing_all" {{ old('timing') == '1' ? "checked" : "" }}  id="timing_all">
                                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __("Toggle if workshop opens for 24x7") }}</b></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Shop Type : ") }}<span class="text-danger">*</span></label>
                                    <br>
                                    @foreach($shoptypes as $shoptype)
                                        <label class="switch">
                                            <input type="checkbox" name="shoptype[{{$shoptype->id}}]"
                                                {{ old('shoptype.'.$shoptype->id) == '1' ? "checked" : "" }}>
                                            <span class="knob"></span>
                                        </label>
                                        <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __("Toggle if ") }} {{$shoptype->name}}</b></small>
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Closed at : ") }}<span class="text-danger">*</span></label>
                                    @foreach($weekdays as $key => $weekday)
                                    <br>
                                    <label class="switch">
                                        <input type="checkbox" name="closing_at[{{$key}}]" {{ old('closing_at.'.$key) == '1' ? "checked" : "" }}>
                                        <span class="knob"></span>
                                    </label>
                                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __("Toggle if Closed at ") }} {{$weekday}}</b></small>
                                    @endforeach
                                    <br>
                                </div>
                            </div>

                            <div class="col-md-3">

                                <div class="form-group">
                                    <label class="text-dark">{{ __("Status :") }}</label>
                                    <br>
                                    <label class="switch">
                                        <input type="checkbox" name="status"
                                            {{ old('status') == '1' ? "checked" : "" }}>
                                        <span class="knob"></span>
                                    </label>
                                    <br>
                                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __("Toggle the shop type status") }}</b></small>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-md-offset-1 col-md-10 form-group">
                    <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i> {{ __("Reset")}}</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                        {{ __("Create")}}</button>
                </div>


                </form>
                <!-- main content end -->
            </div>
        </div>
    </div>
</div>



</div>
@endsection
@section('custom-script')
<script>
    $('.product_type').on('change', function () {

        var type = $(this).val();

        if (type == 'd_product') {

            $('.ex_pro_link').addClass('display-none');
            $('.product_file').removeClass('display-none');
            $("input[product_file]").attr('required', 'required');
            $("input[external_product_link]").removeAttr('required', 'required');


        } else if (type == 'ex_product') {

            $('.ex_pro_link').removeClass('display-none');
            $('.product_file').addClass('display-none');
            $("input[product_file]").removeAttr('required', 'required');
            $("input[external_product_link]").attr('required', 'required');

        } else {

            $('.ex_pro_link').addClass('display-none');
            $('.product_file').addClass('display-none');
            $("input[product_file]").removeAttr('required', 'required');
            $("input[external_product_link]").removeAttr('required', 'required');
        }

    });

    $(".midia-toggle").midia({
        base_url: '{{url('')}}',
        directory_name: 'simple_products',
        dropzone : {
            acceptedFiles: '.jpg,.png,.jpeg,.webp,.bmp,.gif'
        }
    });

    $(".file-toggle").midia({
        base_url: '{{url('')}}',
        directory_name: 'product_files',
        dropzone : {
            acceptedFiles: '.jpg,.png,.jpeg,.webp,.bmp,.gif,.pdf,.docx,.doc'
        }
    });

    $(document).on('click', '#timing_all', function() {
        if($(this).is(':checked')){
            $('#timing').attr('disabled', true)
            $('#timing').val('24X7');
        } else {
            $('#timing').attr('disabled', false)
            $('#timing').val('');
        }
    })
</script>
@endsection