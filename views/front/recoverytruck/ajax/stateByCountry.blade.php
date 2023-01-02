<div class="form-group">
    <label for="">State <span class="text-danger">*</span></label>
    <select name="state" class="form-control" id="state" required>
        <option value="">{{__('Select State')}}</option>
        @foreach($states as $state)
            <option value="{{$state->id}}" {{old('state') == $state->id ? 'selected' : ''}}>{{$state->name}}</option>
        @endforeach
    </select>
</div>