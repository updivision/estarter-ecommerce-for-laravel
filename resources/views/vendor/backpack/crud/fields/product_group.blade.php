<div class="row">
	<div class="col-md-12">
		<h2>{{ trans('product.products') }}</h2>
		<div id="group-products"></div>
		<div class="text-center hidden loader">{{ trans('common.loading_ellipsis') }}</div>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-md-12">
		<h3>{{ trans('product.add_product_to_group') }}</h3>
		<div id="ungrouped_products"></div>
	</div>
</div>

@push('crud_fields_styles')
  <!-- no styles -->
@endpush

@push('crud_fields_scripts')
	<script>
		function getUngroupedProducts(excluded_product_id = null) {
			$.ajax({
				url: '{{ route('getUngroupedProducts') }}',
				type: 'POST',
				data: {
					excluded_product_id: excluded_product_id
				},
			})
			.done(function(response) {
				$('#ungrouped_products').html(response);
			})
			.fail(function() {
				$(function(){
	              new PNotify({
	                text: '{{ trans('common.error_occurred') }}',
	                type: 'error',
	                icon: false
	              });
	            });
			});
		}

		function getGroupProducts(group_id = null) {
			// Hide products group and show loader
			$('#group-products').addClass('hidden');
			$('.loader').removeClass('hidden');

			$.ajax({
				url: '{{ route('getGroupProducts') }}',
				type: 'POST',
				data: {
					group_id: group_id,
					current_product_id: {{ $entry->id}}
				},
			})
			.done(function(response) {
				$('#group-products').html(response);

				// Hide loader and show products from group
				$('.loader').addClass('hidden');
				$('#group-products').removeClass('hidden');
			})
			.fail(function(error) {
				$(function(){
	              new PNotify({
	                text: '{{ trans('common.error_occurred') }}',
	                type: 'error',
	                icon: false
	              });
	            });
			});
		}

		function addProductToGroup(product_id = null, group_id = null) {
			$.ajax({
				url: '{{ route('addProductToGroup') }}',
				type: 'POST',
				data: {
					product_id: product_id,
					group_id: group_id
				},
			})
			.done(function(response) {
				console.log(response);

				// Reload group products
				getGroupProducts({{ $entry->group_id }});

				// Reload ungrouped product list
				getUngroupedProducts({{ $entry->id }});
			})
			.fail(function() {
				$(function(){
	              new PNotify({
	                text: '{{ trans('common.error_occurred') }}',
	                type: 'error',
	                icon: false
	              });
	            });
			});
		}

		function removeProductFromGroup(product_id = null, group_id = null) {
			var confirmation = confirm("{{ trans('product.remove_from_group_confirm') }}");

			if (confirmation) {
			    $.ajax({
					url: '{{ route('removeProductFromGroup') }}',
					type: 'POST',
					data: {
						product_id: product_id,
						group_id: group_id
					},
				})
				.done(function(response) {
					if (product_id == {{ $entry->id }}) {
						location.reload();
					}

					// Reload group products
					getGroupProducts({{ $entry->group_id }});

					// Reload ungrouped product list
					getUngroupedProducts({{ $entry->id }});
				})
				.fail(function() {
					$(function(){
		              new PNotify({
	                	text: '{{ trans('common.error_occurred') }}',
		                type: 'error',
		                icon: false
		              });
		            });
				});
			}
		}

		$(document).on('click', '.btn-add-to-group', function() {
			if ($(this).attr('disabled')) {
				return false;
			}

			var product_id = $('#products').val();
			var group_id   = {{ $entry->group_id }};

			addProductToGroup(product_id, group_id);
		});

		$(document).on('click', '.btn-remove-from-group', function() {
			var product_id = $(this).data('id');
			var group_id   = {{ $entry->group_id }};

			removeProductFromGroup(product_id, group_id);
		});

		$(document).ready(function() {
			getGroupProducts({{ $entry->group_id }});
			getUngroupedProducts({{ $entry->id }});
		});
	</script>
@endpush