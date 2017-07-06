<select id="products" class="select2_field">
	@foreach($ungroupedProducts as $product)
		<option value="{{ $product->id }}">{{ $product->name }} [{{ $product->sku }}]</option>
	@endforeach
</select>
<div class="row">
	<div class="col-md-12">
		<a href="javascript:void(0)" class="btn btn-primary btn-add-to-group" @if (count($ungroupedProducts) < 1) disabled="true" @endif>
			{{ trans('product.add_to_group') }}
		</a>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('.select2_field').select2();
	});
</script>