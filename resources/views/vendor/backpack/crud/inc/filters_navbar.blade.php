<nav class="navbar navbar-default navbar-filters">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle filters</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Filters</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <!-- THE ACTUAL FILTERS -->
			@foreach ($crud->filters as $filter)
				@include($filter->view)
			@endforeach
          <li><a href="#" id="remove_filters_button"><i class="fa fa-eraser"></i> Remove filters</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>


@push('crud_list_styles')
	<style>
    .backpack-filter label {
      color: #868686;
      font-weight: 600;
      text-transform: uppercase;
    }

    .navbar-filters {
      min-height: 25px;
      border-radius: 0;
      margin-bottom: 10px;
      background: #f9f9f9;
      border-color: #f4f4f4;
    }

    .navbar-filters .navbar-collapse {
    	padding: 0;
    }

    .navbar-filters .navbar-toggle {
      padding: 10px 15px;
      border-radius: 0;
    }

    .navbar-filters .navbar-brand {
      height: 25px;
      padding: 5px 15px;
      font-size: 14px;
      text-transform: uppercase;
    }
    @media (min-width: 768px) {
      .navbar-filters .navbar-nav>li>a {
          padding-top: 5px;
          padding-bottom: 5px;
      }
    }

    @media (max-width: 768px) {
      .navbar-filters .navbar-nav {
        margin: 0;
      }
    }
    </style>
@endpush

@push('crud_list_scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/URI.js/1.18.2/URI.min.js" type="text/javascript"></script>
    <script>
      function addOrUpdateUriParameter(uri, parameter, value) {
            var new_url = normalizeAmpersand(uri);

            new_url = URI(new_url).normalizeQuery();

            if (new_url.hasQuery(parameter)) {
              new_url.removeQuery(parameter);
            }

            if (value != '') {
              new_url = new_url.addQuery(parameter, value);
            }

        return new_url.toString();
      }

      function normalizeAmpersand(string) {
        return string.replace(/&amp;/g, "&").replace(/amp%3B/g, "");
      }

      // button to remove all filters
      jQuery(document).ready(function($) {
      	$("#remove_filters_button").click(function(e) {
      		e.preventDefault();

      		@if (!$crud->ajaxTable())
				// behaviour for normal table
				var clean_url = '{{ Request::url() }}';

				// refresh the page to the clean_url
		    	window.location.href = clean_url;
		    @else
		    	// behaviour for ajax table
		    	var new_url = '{{ url($crud->route.'/search') }}';
		    	var ajax_table = $("#crudTable").DataTable();

				// replace the datatables ajax url with new_url and reload it
				ajax_table.ajax.url(new_url).load();

				// clear all filters
				$(".navbar-filters li[filter-name]").trigger('filter:clear');
		    @endif
      	})
      });
    </script>
@endpush