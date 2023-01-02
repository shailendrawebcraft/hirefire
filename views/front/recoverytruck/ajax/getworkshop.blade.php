<div class="form-group">
    <select name="" id="" class="form-control">
        <!-- <option value="" selected>--All Emirates</option> -->
        @foreach($emirates as $emirate)
            <option value="{{ $emirate }}">{{ $emirate }}</option>
        @endforeach
    </select>
</div>
<ul class="modal-list" >
    @foreach($shops as $shop)
        <li id="shop-{{$shop->id}}" data-distance="{{$shop->distance}}">
            <div class="list-content">
                <h5 class="mb-0">{{$shop->name}}</h5>
                <p class="mb-1">{{$shop->location}}, {{$shop->emirates}}</p>
                <p class="mb-2 time-day">
                    <i class="material-symbols-sharp"> pin_drop</i> <span id="distance-{{$shop->id}}">~{{$shop->distance}}</span> km. <span class="time-date-data">|</span> <i class="material-symbols-sharp"> update </i> {{$shop->timing}}, {{ $shop->closing_days == "[]" ? "All Day Working" : implode(', ', json_decode($shop->closing_days))." Closed" }} </p>
                <a href="javascript:void(0)" data-id="{{$shop->id}}"  data-lat="{{$shop->lat}}" data-lng="{{$shop->lng}}"  data-name="{{$shop->name}}" data-add="{{$shop->location}}" data-emirates="{{$shop->emirates}}" data-dismiss="modal" class="btn btn-primary btn-sm drop-button">Drop off Here</a>
            </div>
        </li>
    @endforeach
</ul>