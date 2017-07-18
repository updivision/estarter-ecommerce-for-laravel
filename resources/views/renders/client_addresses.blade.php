@if (count($addresses) > 0)
	<table class="table table-striped" >
		<thead>
			<th>{{ trans('address.contact_person') }}</th>
			<th>{{ trans('address.address') }}</th>
			<th>{{ trans('address.mobile_phone') }}</th>
			<th>{{ trans('address.comment') }}</th>
			<th>{{ trans('common.actions') }}</th>
		</thead>
		<tbody>
			@foreach ($addresses as $address)
				<tr>
					<td class="vertical-align-middle">{{ $address->name }}</td>
					<td class="vertical-align-middle font-12">
						{{ $address->address1 }} <br/>
						{{ $address->address2 }} <br/>
						{{ $address->county }}, {{ $address->city }}
					</td>
					<td class="vertical-align-middle">{{ $address->mobile_phone }}</td>
					<td class="vertical-align-middle">{{ $address->comment }}</td>
					<td class="vertical-align-middle">
						<a href="javascript:void(0)" data-address-id="{{ $address->id }}" class="btn btn-xs btn-default btn-delete-address">
							<i class="fa fa-trash"></i> {{ trans('common.delete') }}
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div class="alert alert-info">
		{{ trans('address.no_addresses') }}
	</div>
@endif