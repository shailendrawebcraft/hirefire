@extends('admin.layouts.master-soyuz')
@section('title',__('Shipping Coupan Setting'))
@section('body')
@component('admin.component.breadcumb',['secondaryactive' => 'active'])
@slot('heading')
   {{ __('Shipping Coupan') }}
@endslot

@slot('menu1')
   {{ __('Shipping Coupan') }}
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
          <h5 class="box-title">{{ __('Shipping ') }} {{ __('Coupan') }}</h5>
        </div>
        <div class="card-body">
          <form id="demo-form2" method="post" enctype="multipart/form-data"
        action="{{url('admin/shi_cupan/update')}}" data-parsley-validate class="form-horizontal form-label-left">
        {{csrf_field()}}

        <div class="row">
          <div class="col-md-6">
            <label class="control-label" for="first-name">
              {{__('Select shipping coupan type')}}: <span class="required">*</span>
            </label>
            
            <div class="form-group">
            <select required name="filter_by" id="shipping_coupan_name" class="form-control">
                <option value="fix">{{ __("Fix") }}</option>
                <option value="percentage">{{ __("Percentage") }}</option>
            </select>
            </div>
         
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="coupan_type_fix">
                <div class="form-group">
                    <label class="text-dark">{{ __("Fix shipping coupan value") }}:</label>
                    <input min="1" type="text" placeholder="Fix shipping coupan" class="form-control coupan_type"
                        name="number_of_price" value="{{ optional($shippingcoupan)['number_of_price'] }}" id="value">
                </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="coupan_type_percentage" style="display:none">
                <div class="form-group">
                    <label class="text-dark">{{ __("Percentage of shipping coupan value") }}:</label>
                    <input min="1" type="text" placeholder="Percentage of shipping coupan" class="form-control coupan_type"
                        name="number_of_price" value="{{ optional($shippingcoupan)['number_of_price'] }}" id="value">
                </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
          <label class="control-label" for="first-name">
            {{__('Shipping coupan name')}}: <span class="required">*</span>
          </label>

            <input placeholder="{{ __('Please enter shipping coupan name') }}" type="text" id="first-name" name="name"
              class="form-control col-md-12" value="{{ optional($shippingcoupan)['name'] }}">
          </div>
        </div>

        <div class="form-group">
          <label>
            {{__('Status')}}:
          </label><br>
          <label class="switch">
            <input name="shipping_coupan_status" class="slider tgl tgl-skewed" type="checkbox"  <?php if(isset($shippingcoupan) && $shippingcoupan->status == 1){ echo "checked";} ?> id="toggle-event33" >
            <span class="knob"></span>
          </label>
          <br>
           <input type="hidden" name="status" value="1" id="status3">
           <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("Choose status for your shipping coupan")}})</small>
          </div>
          <div class="form-group">
          <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
            {{ __("Update") }}</button>
        </div>

        <div class="clear-both"></div>

          </form>
        </div>
      </div>
    

    </div>
  </div>
</div>

<script>
$('#shipping_coupan_name').on('change', function() {
      if(this.value=="fix"){
          $('.coupan_type_fix').show()
          $('.coupan_type_percentage').hide()

      }
      else if(this.value == "percentage"){
          $('.coupan_type_percentage').show()
          $('.coupan_type_fix').hide()

      }
  
});

</script>

@endsection