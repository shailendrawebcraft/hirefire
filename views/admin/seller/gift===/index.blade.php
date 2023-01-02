@extends('admin.layouts.master-soyuz')
@section('title',__('All Coupans'))
@section('body')
@component('admin.component.breadcumb',['secondaryactive' => 'active'])
@slot('heading')
   {{ __('All Coupans') }}
@endslot

@slot('menu1')
   {{ __('Coupans') }}
@endslot

@slot('button')

<div class="col-md-6">
    <div class="widgetbar">
        <a  href=" {{ route('coupan.create') }} " class="btn btn-primary-rgba mr-2">
            <i class="feather icon-plus mr-2"></i> {{__("Add Coupans")}}
        </a>
    </div>                        
</div>
@endslot
@endcomponent
<div class="contentbar"> 
    <div class="row">
        
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="box-title"> {{ __('All Coupans') }}</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="full_detail_table" class="table table-bordered table-striped">
                      <thead>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('gift_code') }}</th>
                        <th>{{ __('starting_date') }}</th>
                        <th>{{ __('end_date') }}</th>
                        <th>{{ __('apply_price') }}</th>
                        <th>{{ __('status') }}</th>
                        <th>{{ __('Action') }}</th>
                      </thead>
                     
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
