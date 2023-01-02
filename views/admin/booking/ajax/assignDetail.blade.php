<form action="{{ route("bookingassign.store") }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-dark">{{ __("Driver: ") }}<span
                        class="text-danger">*</span></label>
                <select name="driver_id" class="form-control driver_id" required>
                    <option data-truckid="" value="">Select Driver</option>
                    @foreach($drivers as $driver)
                        <option {{$driver->online_status != 1 ? 'disabled' : ''}} data-truckid="{{$driver->truck_id}}" {{(!empty($bookingAssign) && $bookingAssign->driver_id == $driver->id) ? "selected" : ""}} value="{{$driver->id}}">{{ $driver->driver_name }} - {{ $driver->mobile_number }} ({{$driver->capacity}})</option>
                    @endforeach
                </select>
                <input type="hidden" name="truck_id" class="truck_id"/>
                <div class="text-right">
                    <a href="{{url('manage/driver/create')}}" target="_new">Add Driver</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-dark">{{ __("Estimated Pickup time (in minutes): ") }}<span
                        class="text-danger">*</span></label>
                <input type="number" min="1" max="600" step="1" class="form-control" name="estimated_pickup_time" value="{{isset($bookingAssign->estimated_pickup_time) ? $bookingAssign->estimated_pickup_time : 20}}" placeholder="In minutes"/>
                <input type="hidden" name="booking_id" value="{{$booking->id}}" />
                <input type="hidden" name="id" value="{{isset($bookingAssign->id) ? $bookingAssign->id : ''}}" />
            </div>
        </div>
    </div>
    <div class="col-md-12 form-group text-right">
        <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>
            {{ __("Assign")}}</button>
    </div>
</form>
