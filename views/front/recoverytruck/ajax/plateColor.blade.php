<div class="form-group">
    <label for="">Plate Code/Colour <span class="text-danger">*</span></label>
    <select name="plate_code" class="form-control" id="plate_code" required>
        <option value="">{{__('Select Plate Code/Color')}}</option>
        @foreach($plateColors as $plateColor)
            <option value="{{$plateColor->id}}" {{old('plate_code') == $plateColor->id ? 'selected' : ''}}>{{$plateColor->plate_code}}</option>
        @endforeach
    </select>
</div>