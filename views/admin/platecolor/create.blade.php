@extends('admin.layouts.master-soyuz')
@section('title',__('Create new product | '))
@section('body')
@component('admin.component.breadcumb',['thirdactive' => 'active'])

@slot('heading')
{{ __('Add Plate Color/Code') }}
@endslot
@slot('menu1')
{{ __("Recovery Truck") }}
@endslot
@slot('menu2')
{{ __("Add Plate Color/Code") }}
@endslot
@slot('button')
<div class="col-md-6">
    <div class="widgetbar">
        <a href="{{ route('platecolor.index') }}" class="btn btn-primary-rgba"><i
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
                    <h5 class="box-title">{{ __('Create New  Plate Color/Code') }}</h5>
                </div>
                <div class="card-body ml-2">
                    <!-- main content start -->
                    <form action="{{ route("platecolor.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Plate Color/Code : ") }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" value="{{ old('plate_code') }}" class="form-control plate-code" name="plate_code" data-role="tagsinput" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Vehicle Type : ") }}<span
                                            class="text-danger">*</span></label>
                                    <select required data-placeholder="{{ __("Please select Vehicle Type") }}"
                                        name="vehicletype_id" id="vehicletype_id" class="select2 product_type form-control">
                                        <option value="">{{ __("Please select Vehicle type") }}</option>
                                        @foreach($vehicleTypes as $vehicleType)
                                            <option {{ old('vehicletype_id') == $vehicleType->id ? "selected" : "" }}
                                            value="{{$vehicleType->id}}">{{ __($vehicleType->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Country : ") }}<span
                                            class="text-danger">*</span></label>
                                    <select required data-placeholder="{{ __("Please select Country") }}"
                                        name="country_id" id="country_id" class="select2 product_type form-control">
                                        <option value="">{{ __("Please select Country") }}</option>
                                        @foreach($countries as $country)
                                            <option {{ old('country_id') == $country->id ? "selected" : "" }}
                                            value="{{$country->id}}">{{ __($country->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("State : ") }}<span
                                            class="text-danger">*</span></label>
                                    <select required data-placeholder="{{ __("Please select State") }}"
                                        name="state_id" id="state_id" class="select2 product_type form-control" disabled="disabled">
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6 detail-type d-none">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Vehicle Detail Type : ") }}<span
                                            class="text-danger">*</span></label>
                                    <select required data-placeholder="{{ __("Please Vehicle Detail Type") }}"
                                        name="detail_type" id="detail_type" class="select2 product_type form-control">
                                        <option value="None">{{ __("None") }}</option>
                                        <option {{ old('detail_type') == 'No. of Seats' ? "selected" : "" }}
                                            value="No. of Seats">{{ __('No. of Seats') }}</option>
                                        <option {{ old('detail_type') == 'Axle Configuration' ? "selected" : "" }}
                                        value="Axle Configuration">{{ __('Axle Configuration') }}</option>
                                        <option {{ old('detail_type') == 'Equipment Type' ? "selected" : "" }}
                                        value="Equipment Type">{{ __('Equipment Type') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 additional-detail detail-type d-none">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Vehicle additional detail: ") }}<span
                                            class="text-danger">*</span></label>
                                    <select required data-placeholder="{{ __("Please Vehicle additional detail") }}"
                                        name="additional_detail" id="additional_detail" class="select2 product_type form-control" disabled>
                                    </select>
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
    $(function() {
        var urlLike = baseUrl + '/admin/choose_plate_state';
        $('#country_id').on('change',function() {
            var up = $('#state_id').empty();
            var cat_id = $(this).val();
            if(cat_id == 229) {
                $('#state_id').attr('disabled', false);
                if(cat_id) {
                    $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "GET",
                        url: urlLike,
                        data: {
                        catId: cat_id
                        },
                        success: function(data) {
                        console.log(data);
                        $.each(data, function(id, title) {
                            up.append($('<option>', {
                            value: id,
                            text: title
                            }));
                        });
                        $('#btn_sel').show('fast');
                        $('#btn_rem').show('fast');
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                        }
                    });
                }
            } else {
                $('#state_id').val('').attr('disabled', true);
            }
        });
        
        $('#vehicletype_id').on('change', function() {
            if($('option:selected', this).text().toLowerCase() == 'bus'
            || $('option:selected', this).text().toLowerCase() == 'truck' 
            || $('option:selected', this).text().toLowerCase() == 'construction equipment'
            || $('option:selected', this).text().toLowerCase() == 'construction eq.') {
                $('.detail-type').removeClass('d-none')
            } else {
                !$('.detail-type').hasClass('d-none') && $('.detail-type').addClass('d-none')
            }
        });

        $('#detail_type').on('change', function() {
            var urlLike = baseUrl + '/admin/choose_additional_detail';
            var up = $('#additional_detail').empty();
            var cat_id = $(this).val();
            if(cat_id) {
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: urlLike,
                    data: {
                        catId: cat_id
                    },
                    success: function(data) {
                        $('#additional_detail').attr('disabled', false);
                        $.each(data, function(id, title) {
                            up.append($('<option>', {
                                value: title,
                                text: title
                            }));
                        });
                        $('#btn_sel').show('fast');
                        $('#btn_rem').show('fast');
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                    }
                });
            }
        });
    });

</script>
@endsection