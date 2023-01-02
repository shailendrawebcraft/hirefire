@extends('admin.layouts.master-soyuz')
@section('title',__('Edit Banner Setting'))
@section('body')

@component('admin.component.breadcumb',['thirdactive' => 'active'])

@slot('heading')
{{ __('Home') }}
@endslot

@slot('menu1')
{{ __("Banner Setting") }}
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
          <h5 class="box-title">{{ __('Banner') }} {{ __('Settings') }}</h5>
        </div>
        <div class="card-body">
          <form id="demo-form2" method="post" enctype="multipart/form-data"
        action="{{url('admin/banner-setting/update')}}" data-parsley-validate class="form-horizontal form-label-left">
        {{csrf_field()}}

        <div class="form-group">
          <label class="control-label" for="first-name">
            {{__('Banner Name')}}: <span class="required">*</span>
          </label>

            <input placeholder="{{ __('Please enter banner name') }}" type="text" id="first-name" name="name"
              class="form-control col-md-12" value="{{ optional($bannersetting)['name'] }}">
        </div>
        
        <div class="form-group">
          <label class="control-label" for="first-name">
            {{__('Banner Image')}}: <span class="required">*</span>
          </label>

          <div class="mb-3">
              @if(isset($bannersetting))
                @if($image = @file_get_contents('images/banner/'.$bannersetting->image))
                  <img src=" {{url('images/banner/'.$bannersetting->image)}} " width="100px" class="rounded p-3 bg-primary-rgba img-fluid">
                @else
                  <img width="100px" src="{{ Avatar::create($bannersetting->name)->toBase64() }}" class="rounded p-3 bg-primary-rgba img-fluid">
                @endif
              @endif
              </div>

          <div class="input-group">

            <input required readonly id="image" name="image" type="text" value="{{ optional($bannersetting)['image'] }}"
                class="form-control">
            <div class="input-group-append">
                <span data-input="image"
                    class="bg-primary text-light midia-toggle input-group-text">{{ __('Browse') }}</span>
            </div>
          </div>
          
          <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{ __('Please Choose Your Banner Image') }})</small>

        </div>

        <div class="form-group">
          @if(isset($bannersetting))
          <label class="control-label" for="first-name">
            {{__('Banner URL')}}: <span class="required">*</span>
          </label>

            <input placeholder="{{ __('Please enter banner name') }}" type="text" id="first-name" name="url"
              class="form-control col-md-12" value="{{ optional($bannersetting)['url'] }}">
          @endif
        </div>

        <div class="form-group">
          <label>
            {{__('Status')}}:
          </label><br>
          <label class="switch">
            <input name="banner_status" class="slider tgl tgl-skewed" type="checkbox" id="toggle-event33"  <?php if(isset($bannersetting) && $bannersetting->status == 1){ echo "checked";} ?>>
            <span class="knob"></span>

          </label>
          <br>
           <input type="hidden" name="status" value="1" id="status3">
           <small class="text-info"> <i class="text-dark feather icon-help-circle"></i>({{__("Choose status for your banner")}})</small>
          </div>
          <div class="form-group">
          <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i>
            {{ __("Reset") }}</button>
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
@endsection

@section('custom-script')
  <script>
      $(".midia-toggle").midia({
          base_url: '{{url('')}}',
          directory_name: 'banner',
          dropzone : {
            acceptedFiles: '.jpg,.png,.jpeg,.webp,.bmp,.gif'
          }
      });
  </script>
@endsection