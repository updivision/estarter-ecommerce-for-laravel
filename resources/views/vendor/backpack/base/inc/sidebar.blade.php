@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="http://placehold.it/160x160/00a65a/ffffff/&text={{ Auth::user()->name[0] }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">{{ trans('backpack::base.administration') }}</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/categories') }}"><i class="fa fa-bars"></i> <span>{{ trans('category.categories') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/products') }}"><i class="fa fa-list"></i> <span>{{ trans('product.products') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/attributes') }}"><i class="fa fa-tag"></i> <span>{{ trans('attribute.attributes') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/attributes-sets') }}"><i class="fa fa-tags"></i> <span>{{ trans('attribute.attribute_sets') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/currencies') }}"><i class="fa fa-usd"></i> <span>{{ trans('currency.currencies') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/carriers') }}"><i class="fa fa-truck"></i> <span>{{ trans('carrier.carriers') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/taxes') }}"><i class="fa fa-balance-scale"></i> <span>{{ trans('tax.taxes') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/orders') }}"><i class="fa fa-list-ul"></i> <span>{{ trans('order.orders') }}</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/order-statuses') }}"><i class="fa fa-list-ul"></i> <span>{{ trans('order.order_statuses') }}</span></a></li>


          <li><a href="{{ url('admin/setting') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>


          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
