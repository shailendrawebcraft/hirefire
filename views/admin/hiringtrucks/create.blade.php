@extends('admin.layouts.master-soyuz')
@section('title',__('Create new product | '))
@section('body')
@component('admin.component.breadcumb',['thirdactive' => 'active'])

@slot('heading')
{{ __('Add Recovery Truck') }}
@endslot
@slot('menu1')
{{ __("Product") }}
@endslot
@slot('menu2')
{{ __("Add Recovery Truck") }}
@endslot
@slot('button')
<div class="col-md-6">
    <div class="widgetbar">
        <a href="{{ route('hiring-trucks.index') }}" class="btn btn-primary-rgba"><i
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
                    <h5 class="box-title">{{ __('Create New Recovery Truck') }}</h5>
                </div>
                <div class="card-body ml-2">
                    <!-- main content start -->
                    <form action="{{ route("hiring-trucks.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Vehicle Number : ") }}<span
                                            class="text-danger">*</span></label>
                                    <input placeholder="{{ __("Enter vehicle number") }}" required type="text"
                                        value="{{ old('vehicle_number') }}" class="form-control" name="vehicle_number">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Driver Name : ") }}<span
                                            class="text-danger">*</span></label>
                                    <input placeholder="{{ __("Enter driver name") }}" required type="text"
                                        value="{{ old('driver_name') }}" class="form-control" name="driver_name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Mobile Number : ") }}<span
                                            class="text-danger">*</span></label>
                                    <input placeholder="{{ __("Enter mobile number") }}" required type="text"
                                        value="{{ old('mobile_number') }}" class="form-control" name="mobile_number">
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
                                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __("Toggle the truck status") }}</b></small>
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
</script>
@endsection