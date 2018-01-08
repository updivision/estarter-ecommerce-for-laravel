<div @include('crud::inc.field_wrapper_attributes') >
	<label>Available Variables</label>
	<ul id="listAvailableVars">
		<small>Select Model first</small>
	</ul>
</div>

{{-- FIELD CSS - will be loaded in the after_styles section --}}
@push('crud_fields_styles')
	<style>
		.available-variables ul {
			list-style-type: none;
			padding: 0;
		}
	</style>
@endpush

{{-- FIELD JS - will be loaded in the after_scripts section --}}
@push('crud_fields_scripts')
	<script>
		function insertIntoCkeditor(str){
			CKEDITOR.instances['ckeditor-body'].insertText(str)
		}

		function getNotificationVars() {
			let model = $('select[name="model"] option:selected').val();
			$('#listAvailableVars').empty()

			$.ajax({
				url: '{{ route('listModelVars') }}',
				type: 'POST',
				data: {
					model: @if (isset($entry) && $entry->model) '{{ $entry->model }}' @else model @endif
				},
			})
			.done(function(response) {
				if (response) {
					$.each(response, function(key, val) {
						$('#listAvailableVars').append('<li class="variable small" data-var=" \{\{ ' + val + ' }} "><a href="javascript:void(0)">\{\{ ' + val + ' }}</a></li>')
					});
				} else {
					$('#listAvailableVars').append('<small class="text-center">No variables available</small>')
				}
			})
		}

		$(document).ready(function () {
			getNotificationVars()
		})

		$(document).on('change', 'select[name="model"]', function () {
			let model = $('select[name="model"] option:selected').val();
			$('#listAvailableVars').empty()

			$.ajax({
				url: '{{ route('listModelVars') }}',
				type: 'POST',
				data: {
					model: model
				},
			})
			.done(function(response) {
				if (response) {
					$.each(response, function(key, val) {
						$('#listAvailableVars').append('<li class="variable small" data-var=" \{\{ ' + val + ' }} "><a href="javascript:void(0)">\{\{ ' + val + ' }}</a></li>')
					});
				} else {
					$('#listAvailableVars').append('<small class="text-center">No variables available</small>')
				}
			})
		})

		$(document).on('click', '.variable', function () {
			let variable = $(this).data('var');
			insertIntoCkeditor(variable)
		})
	</script>
@endpush