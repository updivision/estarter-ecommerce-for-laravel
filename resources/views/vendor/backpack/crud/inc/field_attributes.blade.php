@if (isset($field['attributes']))
    @foreach ($field['attributes'] as $attribute => $value)
    	@if (is_string($attribute))
        {{ $attribute }}="{{ $value }}"
        @endif
    @endforeach

    @if (!isset($field['attributes']['class']))
    	@if (isset($default_class))
    		class="{{ $default_class }}"
    	@else
    		class="form-control"
    	@endif
    @endif
@else
	@if (isset($default_class))
		class="{{ $default_class }}"
	@else
		class="form-control"
	@endif
@endif