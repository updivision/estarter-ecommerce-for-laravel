@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
	    <small>{{ trans('backpack::crud.all') }} <span>{{ $crud->entity_name_plural }}</span> {{ trans('backpack::crud.in_the_database') }}.</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.list') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="row">

    <!-- THE ACTUAL CONTENT -->
    <div class="col-md-12">
      <div class="box">
        <div class="box-header {{ $crud->hasAccess('create')?'with-border':'' }}">

          @include('crud::inc.button_stack', ['stack' => 'top'])

          <div id="datatable_button_stack" class="pull-right text-right"></div>
        </div>

        <div class="box-body table-responsive">

        {{-- Backpack List Filters --}}
        @if ($crud->filtersEnabled())
          @include('crud::inc.filters_navbar')
        @endif

        <table id="crudTable" class="table table-bordered table-striped display">
            <thead>
              <tr>
                @if ($crud->details_row)
                  <th data-orderable="false"></th> <!-- expand/minimize button column -->
                @endif

                {{-- Table columns --}}
                @foreach ($crud->columns as $column)
                  <th>{{ $column['label'] }}</th>
                @endforeach

                @if ( $crud->buttons->where('stack', 'line')->count() )
                  <th>{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </thead>
            <tbody>

              @if (!$crud->ajaxTable())
                @foreach ($entries as $k => $entry)
                <tr data-entry-id="{{ $entry->getKey() }}">

                  @if ($crud->details_row)
                    @include('crud::columns.details_row_button')
                  @endif

                  {{-- load the view from the application if it exists, otherwise load the one in the package --}}
                  @foreach ($crud->columns as $column)
                    @if (!isset($column['type']))
                      @include('crud::columns.text')
                    @else
                      @if(view()->exists('vendor.backpack.crud.columns.'.$column['type']))
                        @include('vendor.backpack.crud.columns.'.$column['type'])
                      @else
                        @if(view()->exists('crud::columns.'.$column['type']))
                          @include('crud::columns.'.$column['type'])
                        @else
                          @include('crud::columns.text')
                        @endif
                      @endif
                    @endif

                  @endforeach

                  @if ($crud->buttons->where('stack', 'line')->count())
                    <td>
                      @include('crud::inc.button_stack', ['stack' => 'line'])
                    </td>
                  @endif

                </tr>
                @endforeach
              @endif

            </tbody>
            <tfoot>
              <tr>
                @if ($crud->details_row)
                  <th></th> <!-- expand/minimize button column -->
                @endif

                {{-- Table columns --}}
                @foreach ($crud->columns as $column)
                  <th>{{ $column['label'] }}</th>
                @endforeach

                @if ( $crud->buttons->where('stack', 'line')->count() )
                  <th>{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </tfoot>
          </table>

        </div><!-- /.box-body -->

        @include('crud::inc.button_stack', ['stack' => 'bottom'])

      </div><!-- /.box -->
    </div>

  </div>

  @if (Route::is('crud.products.index'))
        <div class="clone-product-modal modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('common.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-clone"></i> {{ trans('product.clone_product') }}</h4>
              </div>
              <form action="{{ route('clone.product') }}" method="POST">
                  <div class="modal-body">
                    {!! csrf_field() !!}
                    <input type="hidden" name="product_id" value="">

                    <strong>{{ trans('product.cloned_product_sku') }}</strong>
                    <input type="text" class="form-control" name="clone_sku" required="true">
                    <span>{{ trans('common.must_be_unique') }}</span>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('common.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('product.clone') }}</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
    @endif

@endsection

@section('after_styles')
  <!-- DATA TABLES -->
  <link href="{{ asset('vendor/adminlte/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/form.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/list.css') }}">

  <!-- CRUD LIST CONTENT - crud_list_styles stack -->
  <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
  @stack('crud_list_styles')
@endsection

@section('after_scripts')
  	<!-- DATA TABLES SCRIPT -->
    <script src="{{ asset('vendor/adminlte/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>

    <script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
    <script src="{{ asset('vendor/backpack/crud/js/form.js') }}"></script>
    <script src="{{ asset('vendor/backpack/crud/js/list.js') }}"></script>

    @if ($crud->exportButtons())
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js" type="text/javascript"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js" type="text/javascript"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js" type="text/javascript"></script>
    @endif

    <script src="{{ asset('vendor/adminlte/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
	  jQuery(document).ready(function($) {

      @if ($crud->exportButtons())
      var dtButtons = function(buttons){
          var extended = [];
          for(var i = 0; i < buttons.length; i++){
          var item = {
              extend: buttons[i],
              exportOptions: {
              columns: [':visible']
              }
          };
          switch(buttons[i]){
              case 'pdfHtml5':
              item.orientation = 'landscape';
              break;
          }
          extended.push(item);
          }
          return extended;
      }
      @endif

	  	var table = $("#crudTable").DataTable({
        "pageLength": {{ $crud->getDefaultPageLength() }},
        /* Disable initial sort */
        "aaSorting": [],
        "language": {
              "emptyTable":     "{{ trans('backpack::crud.emptyTable') }}",
              "info":           "{{ trans('backpack::crud.info') }}",
              "infoEmpty":      "{{ trans('backpack::crud.infoEmpty') }}",
              "infoFiltered":   "{{ trans('backpack::crud.infoFiltered') }}",
              "infoPostFix":    "{{ trans('backpack::crud.infoPostFix') }}",
              "thousands":      "{{ trans('backpack::crud.thousands') }}",
              "lengthMenu":     "{{ trans('backpack::crud.lengthMenu') }}",
              "loadingRecords": "{{ trans('backpack::crud.loadingRecords') }}",
              "processing":     "{{ trans('backpack::crud.processing') }}",
              "search":         "{{ trans('backpack::crud.search') }}",
              "zeroRecords":    "{{ trans('backpack::crud.zeroRecords') }}",
              "paginate": {
                  "first":      "{{ trans('backpack::crud.paginate.first') }}",
                  "last":       "{{ trans('backpack::crud.paginate.last') }}",
                  "next":       "{{ trans('backpack::crud.paginate.next') }}",
                  "previous":   "{{ trans('backpack::crud.paginate.previous') }}"
              },
              "aria": {
                  "sortAscending":  "{{ trans('backpack::crud.aria.sortAscending') }}",
                  "sortDescending": "{{ trans('backpack::crud.aria.sortDescending') }}"
              }
          },

          @if ($crud->ajaxTable())
          "processing": true,
          "serverSide": true,
          "ajax": {
              "url": "{!! url($crud->route.'/search').'?'.Request::getQueryString() !!}",
              "type": "POST"
          },
          @endif

          @if ($crud->exportButtons())
          // show the export datatable buttons
          dom: '<"p-l-0 col-md-6"l>B<"p-r-0 col-md-6"f>rt<"col-md-6 p-l-0"i><"col-md-6 p-r-0"p>',
          buttons: dtButtons([
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'print',
            'colvis'
          ]),
          @endif
      });

      @if ($crud->exportButtons())
      // move the datatable buttons in the top-right corner and make them smaller
      table.buttons().each(function(button) {
        if (button.node.className.indexOf('buttons-columnVisibility') == -1)
        {
          button.node.className = button.node.className + " btn-sm";
        }
      })
      $(".dt-buttons").appendTo($('#datatable_button_stack' ));
      @endif

      $.ajaxPrefilter(function(options, originalOptions, xhr) {
          var token = $('meta[name="csrf_token"]').attr('content');

          if (token) {
                return xhr.setRequestHeader('X-XSRF-TOKEN', token);
          }
      });

      // make the delete button work in the first result page
      register_delete_button_action();

      // make the delete button work on subsequent result pages
      $('#crudTable').on( 'draw.dt',   function () {
         register_delete_button_action();

         @if ($crud->details_row)
          register_details_row_button_action();
         @endif
      } ).dataTable();

      function register_delete_button_action() {
        $("[data-button-type=delete]").unbind('click');
        // CRUD Delete
        // ask for confirmation before deleting an item
        $("[data-button-type=delete]").click(function(e) {
          e.preventDefault();
          var delete_button = $(this);
          var delete_url = $(this).attr('href');

	swal({
		title: "{{ trans('backpack::crud.are_you_sure') }}",
		text: "{{ trans('backpack::crud.delete_confirm') }}",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3C8DBC",
		confirmButtonText: "{{ trans('backpack::crud.confirm_delete') }}",
		closeOnConfirm: false,
		closeOnCancel: false
	    },
	    function (isConfirm) {
		if (isConfirm) {
		    $.ajax({
			url: delete_url,
			type: 'DELETE',
			success: function () {
			    // delete the row from the table
			    delete_button.parentsUntil('tr').parent().remove();
			},
			error: function () {
			    // Show an alert with the result
			    new PNotify({
				title: "{{ trans('backpack::crud.delete_confirmation_not_title') }}",
				text: "{{ trans('backpack::crud.delete_confirmation_not_message') }}",
				type: "warning"
			    });
			}
		    });
		    swal("{{ trans('backpack::crud.delete_confirmation_title') }}", "{{ trans('backpack::crud.delete_confirmation_message') }}", "success");
		} else {
		    swal("{{ trans('backpack::crud.delete_confirmation_not_deleted_title') }}", "{{ trans('backpack::crud.delete_confirmation_not_deleted_message') }}", "error");
		}
	    });
        });
      }


      @if ($crud->details_row)
      function register_details_row_button_action() {
        // var crudTable = $('#crudTable tbody');
        // Remove any previously registered event handlers from draw.dt event callback
        $('#crudTable tbody').off('click', 'td .details-row-button');

        // Make sure the ajaxDatatables rows also have the correct classes
        $('#crudTable tbody td .details-row-button').parent('td')
          .removeClass('details-control').addClass('details-control')
          .removeClass('text-center').addClass('text-center')
          .removeClass('cursor-pointer').addClass('cursor-pointer');

        // Add event listener for opening and closing details
        $('#crudTable tbody td.details-control').on('click', function () {
            var tr = $(this).closest('tr');
            var btn = $(this).find('.details-row-button');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                btn.removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
                $('div.table_row_slider', row.child()).slideUp( function () {
                    row.child.hide();
                    tr.removeClass('shown');
                } );
            }
            else {
                // Open this row
                btn.removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
                // Get the details with ajax
                $.ajax({
                  url: '{{ url($crud->route) }}/'+btn.data('entry-id')+'/details',
                  type: 'GET',
                  // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                  // data: {param1: 'value1'},
                })
                .done(function(data) {
                  // console.log("-- success getting table extra details row with AJAX");
                  row.child("<div class='table_row_slider'>" + data + "</div>", 'no-padding').show();
                  tr.addClass('shown');
                  $('div.table_row_slider', row.child()).slideDown();
                  register_delete_button_action();
                })
                .fail(function(data) {
                  // console.log("-- error getting table extra details row with AJAX");
                  row.child("<div class='table_row_slider'>{{ trans('backpack::crud.details_row_loading_error') }}</div>").show();
                  tr.addClass('shown');
                  $('div.table_row_slider', row.child()).slideDown();
                })
                .always(function(data) {
                  // console.log("-- complete getting table extra details row with AJAX");
                });
            }
        } );
      }

      register_details_row_button_action();
      @endif


	  });

    @if (Route::is('crud.products.index'))
      // Clone products
      $(document).on('click', '.clone-btn', function() {
          var product_id = $(this).data('product');
          $('input[name="product_id"]').val(product_id);
          $('input[name="clone_sku"]').val('');
          $('.clone-product-modal').modal('show');
      })
    @endif
	</script>

  <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
  @stack('crud_list_scripts')
@endsection
