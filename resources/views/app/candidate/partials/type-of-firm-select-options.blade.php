@foreach($typeOfFirmOptionList as $optionGroup)
    <optgroup label="{{$optionGroup['name']}}">
        @foreach($optionGroup['optionList'] as $option)
        <option
              value="{{ $option['band']->id }}"
              {{ in_array($option['band']->id, old('type_of_firms', $selectedLawFirmBands)) ? 'selected="selected"' : '' }}
              data-children="{{ getTypeOfFirmOptionChildData($option['band'], $selectedLawFirmBands, old('type_of_firms'))}}"
              >
              {{ $option['displayName'] }}
        </option>
        @endforeach
    </optgroup>
@endforeach
