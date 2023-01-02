<div class="col-md-4 offset-md-4 wow fadeInUp">
    <div class="well mb-4">
        <h4>Vehicle Information -</h4>
        <form action="{{ route('recoverytruck.vehicleinfoverify') }}" method="post" class="vehicle-type"  autocomplete="off">
            @csrf
            <div id="other-details"></div>

            <div class="form-group">
                <label for="">Country <span class="text-danger">*</span></label>
                <select name="country" class="form-control" id="country" required>
                    <option value="">{{__('Select Country')}}</option>
                    @foreach($countries as $country)
                        <option value="{{$country->id}}" {{old('country') == $country->id ? 'selected' : ''}}>{{$country->name}}</option>
                    @endforeach
                </select>
            </div>
            <div id="state-info"></div>

            <div class="form-group" id="color-info">
                <label for="">Plate Code/Colour  <span class="text-danger">*</span></label>
                <input name="plate_code" value="{{old('plate_code')}}" type="text" class="form-control" placeholder="" required readonly />
            </div>
            <div class="form-group" id="plate-number">
                <label for="">Enter the plate number <span class="text-danger">*</span></label>
                <input name="plate_number" id="plate_number" type="text" value="{{old('plate_number')}}" class="form-control" placeholder="" required readonly>
                <input type="hidden" class="form-control" value="{{old('vehicle_id')}}" name="vehicle_id" id="vehicle_id">
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg" >CONTINUE</button>
        </form>
    </div>
</div>