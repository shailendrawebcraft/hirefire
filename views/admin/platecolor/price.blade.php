@if($row->offer_price != 0)
<p> {{ __("Offer Price :") }} <b>{{$currency_code->symbol}}{{ sprintf("%.2f",$row->offer_price) }}</b> </p>
@endif
<p> {{ __("Price :") }} <b>{{$currency_code->symbol}}{{ sprintf("%.2f",$row->price) }}</b> </p>

<p><a role="button" data-target="#pricingModal{{ $row->id }}" data-toggle="modal"><span class="badge badge-pill badge-info">{{ __("View pricing summary") }}</span></a></p>

<!-- --------------- -->
<div class="modal fade" id="pricingModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleStandardModalLabel">{{__("Pricing Summary for ").$row->product_name }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <!-- ------- main content start -->
                  <div class="row">

<div class="{{ $row->offer_price != 0 ? "col-md-6" : "col-md-12" }}">
  <h4> {{__("Pricing Summary")}} </h4>
  <hr>

  <div class="row">
    <div align="left" class="left-col col-md-6">
      <b>{{__("Net Price:") }}</b>
    </div>
    <div align="right" class="right-col col-md-6">
      {{$currency_code->symbol}}{{ sprintf("%.2f",$row->actual_selling_price) }}
    </div>
  </div>

  <hr>
  <h4>
    {{__("Tax Summary")}}
  </h4>
  <hr>

  <div class="row">
    <div align="left" class="left-col col-md-6">
      <b>
        {{__("Tax") }}</b>:
    </div>
    <div align="right" class="right-col col-md-6">
      {{$currency_code->symbol}}{{ excl_tax_calculator($row->actual_selling_price,$row->tax) }} @ {{ $row->tax }}%
    </div>
  </div>

  <hr>
  <h4>
    {{__("Commission Summary")}}
  </h4>
  <hr>

  <div class="row">
    <div align="left" class="left-col col-md-6">
      <b>
        {{__("Commission") }}</b>:
    </div>
    <div align="right" class="right-col col-md-6">
      {{$currency_code->symbol}}{{ commission_calculator($row->actual_selling_price,$row->tax,$row->category_id) }}
    </div>
  </div>
</div>
@if($row->offer_price != '0')
<div class="col-md-6">
  <h4>
    {{__("Offer Pricing Summary")}}
  </h4>
  <hr>
  <div class="row">
    <div align="left" class="left-col col-md-6">
      <b>
          {{__("Net Offer Price:")}}
      </b>
    </div>
    <div align="right" class="right-col col-md-6">
      {{$currency_code->symbol}}{{ sprintf("%.2f", $row->actual_offer_price) }}
    </div>
  </div>

  <hr>

  <h4>
    {{__("Tax Summary")}}
  </h4>
  <hr>

  <div class="row">
    <div align="left" class="left-col col-md-6">
      <b>
        {{__("Tax") }}</b>:
    </div>
    <div align="right" class="right-col col-md-6">
      {{$currency_code->symbol}}{{ excl_tax_calculator($row->actual_offer_price,$row->tax) }} @ {{ $row->tax }}%
    </div>
  </div>

  <hr>
  <h4>
    {{__("Commission Summary")}}
  </h4>
  <hr>

  <div class="row">
    <div align="left" class="left-col col-md-6">
      <b>
        {{__("Commission") }}</b>:
    </div>
    <div align="right" class="right-col col-md-6">
      {{$currency_code->symbol}}{{ commission_calculator($row->actual_offer_price,$row->tax,$row->category_id) }}
    </div>
  </div>

</div>
@endif

</div>
<div class="row">
<div class="{{ $row->offer_price != '0' ? "col-md-6" : "col-md-12" }}">
  <hr>
  <h4>{{ __("Final Selling Price") }}</h4>
  <hr>

  <div class="row">
    <div align="left" class="left-col col-md-6">
      <b>
        {{__("Selling Price:")}}
      </b>
    </div>
    <div align="right" class="right-col col-md-6">

      {{$currency_code->symbol}}{{ sprintf("%.2f", $row->price ) }}
      <br> <small>
        {{__("(Incl. of Tax)")}}
      </small>

    </div>
  </div>

</div>
@if($row->offer_price != '0')
<div class="col-md-6">
  <hr>
  <h4>
    {{__("Final Selling Offer Price")}}
  </h4>
  <hr>

  <div class="row">
    <div align="left" class="left-col col-md-6">
      <b>
        {{__("Selling Offer Price:")}}
      </b>
    </div>
    <div align="right" class="right-col col-md-6">
      {{$currency_code->symbol}}{{ sprintf("%.2f", $row->offer_price) }} 
       <br> 
       <small>
         {{__("(Incl. of Tax)")}}
       </small>
    </div>

  </div>

</div>
@endif
</div>
                  <!-- ------- main content end  -->
              </div>
           
          </div>
      </div>
  </div>
<!-- ---------------- -->