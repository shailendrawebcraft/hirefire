@extends('admin.layouts.master-soyuz')
@section('title',__('Shipping Charge Settings |'))
@section('body')
    @component('admin.component.breadcumb',['thirdactive' => 'active'])
        @slot('heading')
            {{ __('Shipping Charge edit') }}
        @endslot
        @slot('menu2')
            {{ __("Shipping Charge") }}
        @endslot​
    @endcomponent


    <div class="contentbar">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error)
                        <p>{{ $error}}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button></p>
                    @endforeach
                </div>
            @endif

            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="box-title">{{ __('Edit') }} {{ __('Shipping Charge') }}</h5>
                    </div>
                    <div class="card-body">
                        <form id="demo-form2" method="post"  action="{{route('admin.shipping.charge.update',$record->id)}}"
                              data-parsley-validate class="form-horizontal form-label-left">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="first-name">
                                            {{__('Method Name')}}:
                                        </label>

                                        <input type="text" name="city_name" value="{{$record->city_id ?? ''}}"
                                               class="form-control col-md-12">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="first-name">
                                            {{__('price')}}:
                                        </label>

                                        <input type="text" name="custom_price" value="{{$record->custom_price ?? ''}}"
                                               class="form-control col-md-12">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">

                                    <button  type="submit"
                                             class="btn btn-primary-rgba"><i class="fa fa-check-circle"></i>
                                        {{ __("Update") }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection