@extends('admin.layouts.master-soyuz')
@section('title',__('Edit Workshop :Workshop | ',['shop' => $shop->name]))
@section('stylesheet')
    <link rel="stylesheet" href="{{ url("/css/lightbox.min.css") }}">
@endsection
@section('body')
@component('admin.component.breadcumb',['thirdactive' => 'active'])
    @slot('heading')
        {{ __('Edit Workshop') }}
    @endslot

    @slot('menu1')
        {{ __("Recovery Trucks") }}
    @endslot

    @slot('menu2')
        {{ __("Edit Workshop") }}
    @endslot

@slot('button')
    <div class="col-md-6">
        <div class="widgetbar">
            <a href="{{ route('shop.index') }}" class="btn btn-primary-rgba">
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
                    <h5 class="box-title">{{__("Edit Workshop")}} {{ $shop->name }}</h5>
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
                                    <form action="{{ route("shop.update",$shop->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        <!-- <div class="col-md-9"> -->
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-dark">{{__("Workshop Name:")}} <span
                                                            class="text-danger">*</span></label>
                                                    <input placeholder="{{ __("Enter Workshop name") }}" required
                                                        type="text" value="{{ $shop->name }}"
                                                        class="form-control" name="name">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-dark">{{ __("Latitude : ") }}<span
                                                            class="text-danger">*</span></label>
                                                    <input placeholder="{{ __("Latitude") }}" required type="text"
                                                        value="{{ $shop->lat }}" class="form-control" name="lat">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-dark">{{ __("Longitude : ") }}<span
                                                            class="text-danger">*</span></label>
                                                    <input placeholder="{{ __("Longitude") }}" required type="text"
                                                        value="{{ $shop->lng }}" class="form-control" name="lng">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-dark">{{ __("Location : ") }}<span
                                                            class="text-danger">*</span></label>
                                                    <input placeholder="{{ __("Location") }}" required type="text"
                                                        value="{{ $shop->location }}" class="form-control" name="location">
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
                                                            <option {{ $shop->emirates == $state->name ? "selected" : "" }}
                                                            value="{{$state->name}}">{{ __($state->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    @php
                                                        $timing_all = $shop->timing == '24X7' ? 'checked' : '';
                                                    @endphp
                                                    <label class="text-dark">{{ __("Workshop Timing : ") }}<span
                                                            class="text-danger">*</span></label>
                                                    <input placeholder="{{ __("Workshop Timing") }}" required type="text" id="timing"
                                                        value="{{ $shop->timing }}" class="form-control" name="timing" {{$timing_all ? 'disabled' : ''}}>
                                                    <input type="checkbox" name="timing_all" {{ $timing_all }} id="timing_all">
                                                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __("Toggle if workshop opens for 24x7") }}</b></small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-dark">{{ __("Shop Type : ") }}<span class="text-danger">*</span></label>
                                                    <br>
                                                    @php
                                                        $storeTypeIds = json_decode($shop->shoptype_ids)
                                                    @endphp
                                                    @foreach($shoptypes as $shoptype)
                                                        <label class="switch">
                                                            <input type="checkbox" name="shoptype[{{$shoptype->id}}]"
                                                                {{ in_array($shoptype->id, $storeTypeIds) == '1' ? "checked" : "" }}>
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
                                                    @php
                                                        $weekDays = json_decode($shop->closing_days)
                                                    @endphp
                                                    @foreach($weekdays as $key => $weekday)
                                                    <br>
                                                    <label class="switch">
                                                        <input type="checkbox" name="closing_at[{{$key}}]" {{ in_array($weekday, $weekDays) ? "checked" : "" }}>
                                                        <span class="knob"></span>
                                                    </label>
                                                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __("Toggle if Closed at ") }} {{$weekday}}</b></small>
                                                    @endforeach
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="text-dark">Status :</label>
                                                    <br>
                                                    <label class="switch">
                                                        <input type="checkbox" name="status"
                                                            {{ $shop->status == '1' ? "checked" : "" }}>
                                                        <span class="knob"></span>
                                                    </label>
                                                    <br>
                                                    <small class="text-muted"><i class="fa fa-question-circle"></i>
                                                        Toggle the
                                                        vehicle type status</b>.</small>
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
          <form id="bulk_delete_form" method="post" action="{{ route('pro.specs.delete',$shop->id) }}">
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
    $('.stick_close_btn').on('click', function () {

        var action = confirm('Are your sure ?');

        if (action == true) {
            var imageid = $(this).data('imageid');

            axios.post('{{ url("delete/gallery/image/") }}', {
                id: imageid
            }).then(res => {

                alert(res.data.msg);
                location.reload();

            }).catch(err => {
                alert(err);
                return false;
            });
        } else {

            alert('Delete cancelled !');
            return false;

        }

    });

    $('.delete_image_360').on('click', function () {

        var action = confirm('Are your sure ?');

        if (action == true) {
            var imageid = $(this).data('imageid');

            axios.post('{{ route("delete.360") }}', {
                id: imageid
            }).then(res => {

                alert(res.data.msg);
                location.reload();

            }).catch(err => {
                alert(err);
                return false;
            });
        } else {

            alert('Delete cancelled !');
            return false;

        }

    });

    $('.pre_order').on('change',function(){

        if($(this).is(':checked')){

            $("select[name='preorder_type']").attr('required','required');
            $('input[name="product_avbl_date"]').attr('required','required');
            $('.preShow').show();

        }else{

            $("select[name='preorder_type']").removeAttr('required','required');
            $('input[name="product_avbl_date"]').removeAttr('required','required');
            $('.preShow').hide();

        }

    });

    $('.preorder_type').on('change',function(){
        var val = $(this).val();

        if(val == 'partial'){

            $('input[name="partial_payment_per"]').attr('required','required');
            $('#partial_payment_per').show();


        }else{

            $('input[name="partial_payment_per"]').removeAttr('required','required');
            $('#partial_payment_per').hide();

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
            $('#timing').val('{{$shop->timing}}');
        }
    })
</script>

@endsection