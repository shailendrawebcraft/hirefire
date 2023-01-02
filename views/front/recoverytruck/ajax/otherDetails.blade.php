<div class="form-group">
    
    @foreach($otherDetails as $label => $otherDetail)
    <label for="">{{$label}} <span class="text-danger">*</span></label>
    <select name="other_details" class="form-control" id="other_details_select" required>
        <option value="">{{__('Select ')}} {{$label}}</option>
        @foreach($otherDetail as $option)
            <option value="{{$option}}" {{old('other_details') == $option ? 'selected' : ''}}>{{$option}}</option>
        @endforeach
    </select>
    @endforeach
</div>

<div class="form-group additional-info">
    <label for="">{{ __('Additional Info')}}</label>
    <textarea name="additional_info" class="form-control" id="additional_info" placeholder="Please additional Info (if any)"></textarea>
</div>