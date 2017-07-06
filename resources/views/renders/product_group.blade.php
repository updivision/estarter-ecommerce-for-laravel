<table class="table table-striped">
	<thead>
		<th>{{ trans('product.name') }}</th>
		<th>{{ trans('product.sku') }}</th>
		<th>{{ trans('product.price') }}</th>
		<th>{{ trans('common.status') }}</th>
		<th>{{ trans('common.actions') }}</th>
	</thead>
	<tbody>
		@foreach ($products as $product)
			<tr @if($currentProductId == $product->id) class="tr-current-product" @endif>
				<td>{{ $product->name }}</td>
				<td>{{ $product->sku }}</td>
				<td>{{ number_format((float)$product->price, 2, '.', '') }}</td>
				<td>{{ $product->active == 1 ? trans('common.status') : trans('common.inactive') }}</td>
				<td>
					<a href="{{ route('crud.products.edit', $product->id) }}" class="btn btn-xs btn-default" target="_blank">{{ trans('common.edit') }}</a>
					@if (count($products) > 1)
						<a href="javascript:void(0)" data-id="{{ $product->id }}" class="btn btn-xs btn-default btn-remove-from-group">
							<i class="fa fa-times"></i> {{ trans('product.remove_from_group') }}
						</a>
					@endif
				</td>
			</tr>
		@endforeach
	</tbody>
</table>