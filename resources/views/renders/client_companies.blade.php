@if (count($companies) > 0)
	<table class="table table-striped" >
		<thead>
			<th>{{ trans('company.company_name') }}</th>
			<th>{{ trans('company.address') }}</th>
			<th>{{ trans('company.tin') }}</th>
			<th>{{ trans('company.trn') }}</th>
			<th>{{ trans('common.actions') }}</th>
		</thead>
		<tbody>
			@foreach ($companies as $company)
				<tr>
					<td class="vertical-align-middle">{{ $company->name }}</td>
					<td class="vertical-align-middle font-12">
						{{ $company->address1 }} <br/>
						{{ $company->address2 }} <br/>
						{{ $company->county }}, {{ $company->city }}
					</td>
					<td class="vertical-align-middle">{{ $company->tin }}</td>
					<td class="vertical-align-middle">{{ $company->trn }}</td>
					<td class="vertical-align-middle">
						<a href="javascript:void(0)" data-company-id="{{ $company->id }}" class="btn btn-xs btn-default btn-delete-company">
							<i class="fa fa-trash"></i> {{ trans('common.delete') }}
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div class="alert alert-info">
		{{ trans('company.no_companies') }}
	</div>
@endif