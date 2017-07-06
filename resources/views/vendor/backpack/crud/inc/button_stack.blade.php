@if ($crud->buttons->where('stack', $stack)->count())
	@foreach ($crud->buttons->where('stack', $stack) as $button)
	  @if ($button->type == 'model_function')
		{!! $entry->{$button->content}(); !!}
	  @else
		@include($button->content)
	  @endif
	@endforeach
@endif