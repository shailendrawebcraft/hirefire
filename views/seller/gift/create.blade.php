@extends("admin.layouts.sellermastersoyuz")
@section('title',__('Add New Gift'))
@section('body')

@component('seller.components.breadcumb',['secondactive' => 'active'])

@slot('heading')
{{ __('Gift') }}
@endslot

@slot('menu1')
{{ __("Gift") }}
@endslot
@slot('button')
<div class="col-md-6">
  <div class="widgetbar">

  <a href="{{ route('seller.gift.index') }}" class="btn btn-primary-rgba mr-2"><i class="feather icon-arrow-left mr-2"></i> {{ __("Back") }}</a>
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
          <h5 class="box-title">{{ __('Add') }} {{ __('Gift') }}</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('seller.gift.store') }}" method="POST">
            @csrf
            <div class="box-body">

            <div class="row">
             <div class="col-md-6 form-group">
                <label>{{__("Title")}}: <span class="required">*</span></label>
                <input required="" type="text" class="form-control" name="title">
              </div>

              <div class="col-md-6 form-group">
                <label>{{__("Gift Code")}}: <span class="required">*</span></label>
                <input required="" type="text" class="form-control" name="gift_code">
              </div>
              
              <div class="col-md-6 form-group">
                <label>{{__('Amount')}}: <span class="required">*</span></label>
                <input required="" type="text" class="form-control select2" name="apply_price">

              </div>
              <div class="col-md-6 form-group">
                <label>{{  __('Max Usage Limit') }}: <span class="required">*</span></label>
                <input required="" type="number" min="1" class="form-control" name="count">
              </div>
             
              <div class="col-md-6 form-group">
                <label>{{  __('Expiry Date') }}: <span class="required">*</span></label>
                <div class="input-group">
                  <input required="" type="text" id="default-date" class="form-control" name="end_date" placeholder="dd/mm/yyyy"
                    aria-describedby="basic-addon5" />
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon5"><i class="feather icon-calendar"></i></span>
                  </div>
                </div>
              </div>

                <div class="form-group col-md-2">
                    <label class="text-dark" for="exampleInputDetails">{{ __('Status') }} </label><br>
                    <label class="switch">
                      <input class="slider" type="checkbox" name="status" />
                      <span class="knob"></span>
                    </label>
                </div>

            </div>

            <div class="form-group">
              <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i>
                {{ __("Reset") }}</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
                {{ __("Create") }}</button>
            </div>
            </div>

            <div class="clear-both"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection