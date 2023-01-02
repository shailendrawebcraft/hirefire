@extends('admin.layouts.master-soyuz')
@section('title',__('Best Seller'))
@section('body')

@component('admin.component.breadcumb',['thirdactive' => 'active'])

@slot('heading')
{{ __('Home') }}
@endslot

@slot('menu1')
{{ __("Best Seller Setting") }}
@endslot

@endcomponent

<div class="contentbar">
  <div class="row">
    <form id="best_seller" method="POST" action="{{url('admin/bestseller/update')}}" class="pull-left form-inline">
        @csrf
        <div class="form-group">
        <select required name="filter_by" id="filter_by" class="form-control">
            <option value="">{{ __("Please select action") }}</option>
            <option value="weekly">{{ __("Weekly Report") }}</option>
            <option value="monthly">{{ __("Monthly Report") }}</option>
            <option value="yearly">{{ __("Yearly Report") }}</option>
            <option value="all">{{ __("All Report") }}</option>
        </select>
        </div>
        <button type="submit" class="ml-2 btn btn-md btn-primary-rgba">
        {{__('Save')}}
        </button>
    </form>
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