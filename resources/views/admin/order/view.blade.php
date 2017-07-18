@extends('backpack::layout')

@section('content-header')
	<section class="content-header">
	  <h1>
	    <span>{{ $crud->entity_name }}</span>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.preview') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
	@if ($crud->hasAccess('list'))
		<a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a><br><br>
	@endif

	<div class="row">
		<div class="col-md-12 well">
			<h2>{{ trans('order.order') }} #{{ $order->id }} - {{ $order->user->name }}</h2>
		</div>
	</div>

	<div class="row">
		<div class="col-md-7">
			<div class="box">
			    <div class="box-header with-border">
			      <h3 class="box-title">
		            <span><i class="fa fa-ticket"></i> {{ trans('order.order_status') }}</span>
		          </h3>
			    </div>
			    <div class="box-body">
			    	<h4>
			    		Current status <br><br>
			    		<span class="label label-default">{{ $order->status->name }}</span>
			    	</h4>

					<hr>

					<h4>
						Status history
					</h4>
			    	@if (count($order->statusHistory) > 0)
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>{{ trans('order.status') }}</th>
									<th>{{ trans('common.date') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($order->statusHistory as $statusHistory)
									<tr>
										<td>{{ $statusHistory->status->name }}</td>
										<td>{{ $statusHistory->created_at }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<div class="alert alert-info">
							{{ trans('order.no_status_history') }}
						</div>
					@endif

					<hr>

					@if (count($orderStatuses) > 0)
						<form action="{{ route('updateOrderStatus') }}" method="POST">
							{!! csrf_field() !!}
							<input type="hidden" name="order_id" value="{{ $order->id }}">

							<div class="form-group">
								<select name="status_id" id="status_id" class="select2_field" style="width: 100%">
									@foreach($orderStatuses as $orderStatus)
										<option value="{{ $orderStatus->id }}">{{ $orderStatus->name }}</option>
									@endforeach
								</select>
							</div>

							<button type="submit" class="btn btn-primary">{{ trans('order.update_status') }}</button>
						</form>
					@else
						<div class="alert alert-info">
							{{ trans('order.no_order_statuses') }}
						</div>
					@endif
			    </div>
		    </div>
		</div>
		<div class="col-md-5">
			<div class="box">
			    <div class="box-header with-border">
			      <h3 class="box-title">
		            <span><i class="fa fa-user"></i> {{ trans('client.client') }}</span>
		          </h3>
			    </div>

			    <div class="box-body">
			    	<h3>{{ trans('user.tab_general') }}</h3>
					<div class="col-md-12 well">
						<div class="col-md-6">
							<i class="fa fa-user-circle-o"></i> {{ $order->user->name }} <br/>
							<i class="fa fa-envelope"></i> <a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a> <br/>
						</div>
						<div class="col-md-6">
							<i class="fa fa-birthday-cake"></i> {{ $order->user->birthday ? $order->user->birthday.' ('.$order->user->age().' '.strtolower(trans('common.years')).')': '-' }}
							<br>
							{!! ($order->user->gender == 1) ? '<i class="fa fa-mars"></i> '.trans('user.male') : '<i class="fa fa-venus"></i> '.trans('user.female') !!}
						</div>
					</div>
			    </div>
		    </div>

		    <div class="box">
			    <div class="box-header with-border">
			      <h3 class="box-title">
		            <span><i class="fa fa-user"></i> {{ trans('client.client') }}</span>
		          </h3>
			    </div>

			    <div class="box-body">
			    	<h3>Addresses</h3>
			    </div>
		    </div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="box">
			    <div class="box-header with-border">
			      <h3 class="box-title">
		            <span><i class="fa fa-truck"></i> {{ trans('carrier.carrier') }}</span>
		          </h3>
			    </div>

			    <div class="box-body">
					<table class="table table-condensed">
						<thead>
							<tr>
								<th style="width: 150px;">{{ trans('carrier.logo') }}</th>
								<th>{{ trans('carrier.carrier') }}</th>
								<th>{{ trans('carrier.price') }}</th>
								<th>{{ trans('carrier.delivery_text') }}</th>
							</tr>
						</thead>
						<tr>
							<td class="vertical-align-middle">
								<img src="{{ Storage::disk('carriers')->exists($order->carrier->logo) ? (url(config('filesystems.disks.carriers.simple_path')).'/'.$order->carrier->logo) : (url(config('filesystems.disks.carriers.simple_path')).'/default.png') }}" alt="" style="width: 100px;">
							</td>
							<td class="vertical-align-middle">{{ $order->carrier->name }}</td>
							<td class="vertical-align-middle">{{ $order->carrier->price.' '.$order->currency->name }}</td>
							<td class="vertical-align-middle">{{ $order->carrier->delivery_text }}</td>
						</tr>
					</table>
			    </div>
		    </div>
	    </div>
    </div>

	<div class="row">
		<div class="col-md-12">
			<div class="box">
			    <div class="box-header with-border">
			      <h3 class="box-title">
		            <span><i class="fa fa-shopping-cart"></i> {{ trans('product.products') }}</span>
		          </h3>
			    </div>

			    <div class="box-body">
			    	<div class="col-md-12">
				    	<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>{{ trans('product.product') }}</th>
									<th>{{ trans('product.price') }}</th>
									<th>{{ trans('product.price_with_tax') }}</th>
									<th>{{ trans('order.quantity') }}</th>
									<th class="text-right">{{ trans('common.total') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($order->products as $product)
									<tr>
										<td class="vertical-align-middle">
											<a href="{{ route('crud.products.edit', $product->pivot->product_id) }}">{{ $product->pivot->name }}</a><br/>
											<span class="font-12">SKU: {{ $product->pivot->sku }}</span>
										</td>
										<td class="vertical-align-middle">{{ decimalFormat($product->pivot->price).' '.$order->currency->name }}</td>
										<td class="vertical-align-middle">{{ decimalFormat($product->pivot->price_with_tax).' '.$order->currency->name }}</td>
										<td class="vertical-align-middle">{{ $product->pivot->quantity }}</td>
										<td class="vertical-align-middle text-right">{{ decimalFormat($product->pivot->price_with_tax*$product->pivot->quantity).' '.$order->currency->name }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>

					<div class="col-md-6 col-md-offset-6">
						<table class="table table-condensed">
							<tr>
								<td class="text-right">{{ trans('order.shipping_cost') }}:</td>
								<td class="text-right">{{ $order->carrier->price.' '.$order->currency->name }}</td>
							</tr>
							<tr>
								<td class="text-right"><strong>{{ trans('common.total') }}:</strong></td>
								<td class="text-right"><strong>{{ $order->total().' '.$order->currency->name }}</strong></td>
							</tr>
						</table>
					</div>

			    </div>
		    </div>
		</div>
	</div>
@endsection


@section('after_styles')
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/show.css') }}">

	<!-- include select2 css-->
	<link href="{{ asset('vendor/adminlte/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

	<!-- Select 2 Bootstrap theme -->
	<link href="{{ asset('css/select2-bootstrap-min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('after_scripts')
	<script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
	<script src="{{ asset('vendor/backpack/crud/js/show.js') }}"></script>

	<!-- include select2 js -->
    <script src="{{ asset('vendor/adminlte/plugins/select2/select2.min.js') }}"></script>

	<script>
		$(document).ready(function () {
			@if (count($orderStatuses) > 0)
				$('.select2_field').select2();
			@endif
		});
	</script>
@endsection