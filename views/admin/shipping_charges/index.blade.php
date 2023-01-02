@extends('admin.layouts.master-soyuz')
@section('title',__('Shipping Charge Settings'))
@section('body')
@component('admin.component.breadcumb',['thirdactive' => 'active'])
@slot('heading')
{{ __('Shipping Charge') }}
@endslot
@slot('menu1')
{{ __("Shipping Charge") }}
@endslot​
​@slot('button')
<div class="col-md-6">
  <div class="widgetbar">

    <a  href=" {{ route('admin.shipping.charge.create') }} " class="btn btn-primary-rgba mr-2">
        <i class="feather icon-plus mr-2"></i> {{__("Add Shipping Charge")}}
    </a>
 
  </div>
</div>
@endslot
@endcomponent
    <div class="contentbar">
        <div class="row">

            <div class="col-lg-12">
                <div id="flash-message">

                </div>
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 >{{ __('Shipping Charge') }}</h5>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Global Shipping Charges :") }}</label>
                                    <br>
                                    <label class="switch">
                                        <input type="checkbox" name="handling_changes"
                                               {{ $global_payment == 'true' ? "checked" : "" }} id="handling_Chrages" >
                                        <span class="knob"></span>
                                    </label>
                                    <br>
                                    <small class="text-muted"><i class="fa fa-question-circle"></i> {{ __("Toggle to allow Gloabl Shipping Charges.") }}</b></small>
                                </div>
                            </div>
                      		@if(isset($records[0]->global_price))
                            <div class="col-md-4 paymentHandling_charge" style="display:none">
                                <div class="form-group">
                                    <label class="text-dark">{{ __("Price :") }}</label>
                                    <input min="1" type="number" placeholder="Price" class="form-control handling_Chrages_input"
                                           name="Price" step="0.01" value="{{ $records[0]->global_price }}" id="handling_Chrages_input">
                                </div>
                            </div>
                      		@endif
                            <div class="col-md-4 mt-4 paymentHandling_charge" style="display:none">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary _globalHandingChange" style="margin-top: 9px;margin-left: 104px;" onclick=""><i class="fa fa-check-circle"></i>
                                        {{ __("Set")}}</button>
                                </div>
                            </div>
                        </div>
                        <hr/>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- table to display shipping charge start -->
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                <th>{{ __('Id') }}</th>
                                <th>{{ __('city Name') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Global Price') }}</th>
                                <th>{{ __('Price Type') }}</th>
                                <th>{{ __('Action') }}</th>

                                </thead>
                                <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <th scope="row">{{$record->id}}</th>
                                        <td>{{$record->city_id}}</td>
                                        <td class="{{$record->Type_of_charge  == 'custom' ? 'text-success':''}}">{{$record->custom_price}}</td>
                                        <td class="{{$record->Type_of_charge  == 'global' ? 'text-success':''}}">{{$record->global_price }}</td>
                                        <td class="{{$record->Type_of_charge  == 'custom' ? 'text-success':''}}">{{$record->Type_of_charge  == 'global' ? "Global":"Custom"}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{route('admin.shipping.charge.edit',$record->id)}}"><i class="fa fa-edit"></i></a>
                                            <Button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$record->id}}"><i class="fa fa-trash"></i></Button>

                                            <div class="modal fade bd-example-modal-sm" id="delete{{ $record->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger border-danger">
                                                            <h5 class="modal-title" id="exampleSmallModalLabel">{{ __("DELETE") }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h4>{{ __('Are You Sure ?')}}</h4>
                                                            <p>{{ __('Do you really want to delete')}}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post" action="{{route('admin.shipping.charge.remove',$record->id)}}" class="pull-right">
                                                                {{csrf_field()}}

                                                                <button type="reset" class="btn btn-secondary" data-dismiss="modal">{{ __("No") }}</button>
                                                                <button type="submit" class="btn btn-danger">{{ __("YES") }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setGlobalPrice(_global_price=null,funType){
            $.ajax({

                type: "POST",
                url: "{{route('admin.shipping.charge.ajax.request')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    _global_price,
                    funType
                },
                success: function(data)
                {
                    location.reload();
                }
            })

        }

        $(document).ready(function(){
            if(`{{$global_payment}}`){
                $('.paymentHandling_charge').show()
            }
        })

        $('#handling_Chrages').on('change',function(){
            const status = $(this).prop('checked');
            if(status ){
                $('.paymentHandling_charge').show()
            }else{
                $('.paymentHandling_charge').hide()

                setGlobalPrice(null,"setCustomPrice")
            }

        })

        $('._globalHandingChange').on('click',function(){
            const _global_price =  $(".handling_Chrages_input").val();

            setGlobalPrice(_global_price,"setGlobalPrice")

        })

    </script>

@endsection
<!-- @section('custom-script')
    <script>var url = {!! json_encode( url('admin/shipping_update')) !!};</script>
  <script src="{{ url('js/ship.js') }}"></script>
@endsection  -->
