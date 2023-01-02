@extends("admin.layouts.sellermastersoyuz")
@section('title',__('All Gift'))
@section('body')
@component('seller.components.breadcumb',['secondactive' => 'active'])
@slot('heading')
   {{ __('All Gift') }}
@endslot

@slot('menu1')
   {{ __('Gift') }}
@endslot
@slot('button')
<div class="col-md-6">
    <div class="widgetbar">
        <a  href=" {{ route('seller.gift.create') }} " class="btn btn-primary-rgba mr-2">
            <i class="feather icon-plus mr-2"></i> {{__("Add Gift")}}
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
                    <h5 class="box-title"> {{ __('All Gift') }}</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="full_detail_table" class="table table-bordered table-striped">
                      <thead>
                        <th>{{ __('S No.') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Code') }}</th>
                        <th>{{ __('Apply Price') }}</th>
                        <th>{{ __('Max Usage') }}</th>
                        <th>{{ __('Expiry Date') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Action') }}</th>
                      </thead>

                      <tbody>
                        @foreach($gifts as $key=> $gift)
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $gift->title }}</td>
                          <td>{{ $gift->gift_code }}</td>
                          <td>{{ $gift->apply_price }}</td>
                          <td>{{ $gift->count }}</td>
                          <td>{{ $gift->end_date }}</td>
                          <td>
                           <form action="{{ route('seller.gift.quick.update',$gift->id) }}" method="POST">
                             {{ csrf_field() }}
                             <button type="Submit" class="btn btn-rounded {{ $gift->status ==1 ? 'btn-success-rgba' : 'btn-danger-rgba' }}">
                               @if($gift->status ==1)
                               {{ __('Active') }}
                               @else
                               {{ __('Deactive') }}
                               @endif
                             </button>
                           </form>
                       </td>
                          <td>
                            <div class="dropdown">
                                <button class="btn btn-round btn-primary-rgba" type="button" id="CustomdropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                <div class="dropdown-menu" aria-labelledby="CustomdropdownMenuButton1">
                                  
                                    <a class="dropdown-item" href="{{ route('seller.gift.edit',$gift->id) }}"><i class="feather icon-edit mr-2"></i>{{ __("Edit") }}</a>
                                    
                                    <a class="dropdown-item btn btn-link" data-toggle="modal" data-target="#delete{{ $gift->id }}" >
                                      <i class="feather icon-delete mr-2"></i>{{ __("Delete") }}</a>
                                  </a>
                                    
                                </div>
                            </div>
                           
                            <div class="modal fade bd-example-modal-sm" id="delete{{$gift->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-sm">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="exampleSmallModalLabel">{{ __("DELETE") }}</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                              <h4>{{ __('Are You Sure ?')}}</h4>
                                              <p>{{ __('Do you really want to delete')}}? {{ __('This process cannot be undone.')}}</p>
                                      </div>
                                      <div class="modal-footer">
                                          <form method="post" action="{{route('seller.gift.destroy',$gift->id)}}" class="pull-right">
                                              {{csrf_field()}}
                                              {{method_field("DELETE")}}
                                              <button type="reset" class="btn btn-secondary" data-dismiss="modal">{{ __("No") }}</button>
                                              <button type="submit" class="btn btn-primary">{{ __("YES") }}</button>
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
@endsection
