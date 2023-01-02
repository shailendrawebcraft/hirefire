@extends('admin.layouts.master-soyuz')
@section('title',__('Edit Plate Color :Plate Color | ',['plateColor' => $plateColor->plate_color]))
@section('stylesheet')
    <link rel="stylesheet" href="{{ url("/css/lightbox.min.css") }}">
@endsection
@section('body')
@component('admin.component.breadcumb',['thirdactive' => 'active'])
    @slot('heading')
        {{ __('Edit Plate Color') }}
    @endslot

    @slot('menu1')
        {{ __("Recovery Trucks") }}
    @endslot

    @slot('menu2')
        {{ __("Edit Plate Color") }}
    @endslot

@slot('button')
    <div class="col-md-6">
        <div class="widgetbar">
            <a href="{{ route('platecolor.index') }}" class="btn btn-primary-rgba">
                <i class="feather icon-arrow-left mr-2"></i>{{ __("Back")}}
            </a>
        </div>
    </div>
@endslot
@endcomponent
<div class="contentbar">
    <div class="row">
       
        <div class="col-lg-12">
            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach($errors->all() as $error)
                <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button></p>
                @endforeach
            </div>
            @endif
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="box-title">{{__("Edit Plate Color/Code")}} {{ $plateColor->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="defaultTabContent">
                        <!-- === productdetails start ======== -->
                        <div class="tab-pane fade show active" id="productdetails" role="tabpanel"
                            aria-labelledby="productdetails-tab">
                            <!-- productdetails form start -->

                            <div class="row">
                                <div class="col-md-9">

                                    <!-- <div class="row"> -->
                                    <form action="{{ route("platecolor.update",$plateColor->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        <!-- <div class="col-md-9"> -->
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-dark">{{ __("Plate Color/Code : ") }}<span
                                                            class="text-danger">*</span></label>
                                                    <input placeholder="{{ __("Plate Color/Code") }}" required type="text"
                                                        value="{{ $plateColor->plate_code }}" class="form-control" name="plate_code">
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
                                                            <option {{ $vehicleType->id == $selectedVehicleType->id ? "selected" : "" }}
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
                                                            <option {{ $plateColor->country_id == $country->id ? "selected" : "" }}
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
                                                        name="state_id" id="state_id" class="select2 product_type form-control" {{empty($plateColor->state_id) ? 'disabled=""' : ''}} >
                                                        @if(!empty($plateColor->state_id))
                                                            @foreach($states as $state)
                                                                <option {{ $plateColor->state_id == $state->id ? "selected" : "" }}
                                                                value="{{$state->id}}">{{ __($state->name) }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="{{ $plateColor['detail_type'] == 'None' ? 'd-none' : '' }} col-md-6 detail-type ">
                                                <div class="form-group">
                                                    <label class="text-dark">{{ __("Vehicle Detail Type : ") }}<span
                                                            class="text-danger">*</span></label>
                                                    <select required data-placeholder="{{ __("Please Vehicle Detail Type") }}"
                                                        name="detail_type" id="detail_type" class="select2 product_type form-control">
                                                        <option {{ $plateColor->detail_type == 'None' ? "selected" : "" }} value="None">{{ __("None") }}</option>
                                                        <option {{ $plateColor->detail_type == 'No. of Seats' ? "selected" : "" }}
                                                            value="No. of Seats">{{ __('No. of Seats') }}</option>
                                                        <option {{ $plateColor->detail_type == 'Axle Configuration' ? "selected" : "" }}
                                                        value="Axle Configuration">{{ __('Axle Configuration') }}</option>
                                                        <option {{ $plateColor->detail_type == 'Equipment Type' ? "selected" : "" }}
                                                        value="Equipment Type">{{ __('Equipment Type') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-6 additional-detail detail-type {{ empty($plateColor['additional_detail']) ? 'd-none' : '' }}">
                                                <div class="form-group">
                                                    <label class="text-dark">{{ __("Vehicle additional detail: ") }}<span
                                                            class="text-danger">*</span></label>
                                                    <select required data-placeholder="{{ __("Please Vehicle additional detail") }}"
                                                        name="additional_detail" id="additional_detail" class="select2 product_type form-control" empty($plateColor->additional_detail) ? disabled="disabled" : "" >
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">

                                                <div class="form-group">
                                                    <label class="text-dark">{{ __("Status :") }}</label>
                                                    <br>
                                                    <label class="switch">
                                                        <input type="checkbox" name="status"
                                                            {{ $plateColor->status == '1' ? "checked" : "" }}>
                                                        <span class="knob"></span>
                                                    </label>
                                                    <br>
                                                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __("Toggle the Plate Color type status") }}</b></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="reset" class="btn btn-danger mr-1"><i class="fa fa-ban"></i>
                                                {{ __("Reset")}}</button>
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>
                                                {{ __("Update")}}</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- productdetails form end -->
                        </div>
                        <!-- === productdetails end ======== -->
                    </div>
                </div><!-- card body end -->

            </div>
        </div>
    </div>
</div>
</div>

<!-- Bulk Delete Modal -->
<div id="bulk_delete_spec" class="delete-modal modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="delete-icon"></div>
        </div>
        <div class="modal-body text-center">
          <h4 class="modal-heading">{{ __("Are You Sure ?") }}</h4>
          <p>Do you really want to delete these workshop? This process cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <form id="bulk_delete_form" method="post" action="{{ route('pro.specs.delete',$plateColor->id) }}">
            @csrf
            {{ method_field('DELETE') }}
            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{ __("NO") }}</button>
            <button type="submit" class="btn btn-danger">{{ __("YES") }}</button>
          </form>
        </div>
      </div>
    </div>
</div>

@endsection
@section('custom-script')
<script src='{{ url('js/lightbox.min.js') }}' type='text/javascript'></script>
<script src='//unpkg.com/spritespin@x.x.x/release/spritespin.js' type='text/javascript'></script>
<script src="//unpkg.com/axios/dist/axios.min.js"></script>
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
            var selected_id = '{{$plateColor->additional_detail}}';
            if(cat_id) {
                $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: urlLike,
                    data: {
                        catId: cat_id,
                    },
                    success: function(data) {
                        $('#additional_detail').attr('disabled', false);
                        $.each(data, function(id, title) {
                            up.append($('<option>', {
                                value: title,
                                text: title,
                                selected: title == selected_id && 'selected'
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

        $('#detail_type').trigger('change');
    });
</script>

@endsection