<div class="row">
    <div class="col-md-12">
        <a href="javascript:void(0)" class="btn btn-primary add-address-btn">
            <i class="fa fa-plus"></i> {{ trans('address.add_address') }}
        </a>
    </div>
</div>

<hr />

<div class="row">
    <div class="col-md-12">
        <div id="client_addresses"></div>
    </div>
</div>

<!-- Add address modal -->
<div class="add-address-modal modal fade" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('common.close') }}"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="fa fa-plus"></i> {{ trans('address.add_address') }}</h4>
        </div>
        <div id="add-address-fields">
            <div class="modal-body">
              <input type="hidden" name="address[client_id]" value="{{ $entry->id }}">

              <div class="form-group">
                <label for="name">{{ trans('address.contact_person') }}:</label>
                <input type="text" class="form-control" name="address[name]" id="name">
              </div>

              <div class="form-group">
                <label for="address1">{{ trans('address.address_1') }}:</label>
                <input type="text" class="form-control" name="address[address1]" id="address1">
              </div>

              <div class="form-group">
                <label for="address2">{{ trans('address.address_2') }}:</label>
                <input type="text" class="form-control" name="address[address2]" id="address2">
              </div>

              <div class="form-group">
                <label for="country">{{ trans('address.country') }}:</label>
                <select name="address[country_id]" class="form-control select2_field" style="width: 100%;" id="country">
                    @foreach($field['country_model']::get() as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="county">{{ trans('address.county') }}:</label>
                        <input type="text" class="form-control" name="address[county]" id="county">
                    </div>

                    <div class="col-md-6">
                        <label for="city">{{ trans('address.city') }}:</label>
                        <input type="text" class="form-control" name="address[city]" id="city">
                    </div>
                </div>
              </div>

              <div class="form-group">
                <label for="postal_code">{{ trans('address.postal_code') }}:</label>
                <input type="text" class="form-control" name="address[postal_code]" id="postal_code">
              </div>

              <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="phone">{{ trans('address.phone') }}:</label>
                        <input type="text" class="form-control" name="address[phone]" id="phone">
                    </div>

                    <div class="col-md-6">
                        <label for="mobile_phone">{{ trans('address.mobile_phone') }}:</label>
                        <input type="text" class="form-control" name="address[mobile_phone]" id="mobile_phone">
                    </div>
                </div>
              </div>

              <div class="form-group">
                <label for="comment">{{ trans('address.comment') }}:</label>
                <textarea name="address[comment]" class="form-control" id="comment" rows="3"></textarea>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('common.cancel') }}</button>
              <button type="button" class="btn btn-primary btn-add-address">{{ trans('common.add') }}</button>
            </div>
        </div>
      </div>
    </div>
</div>

@push('crud_fields_styles')
    <!-- include select2 css-->
    <link href="{{ asset('vendor/adminlte/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select 2 Bootstrap theme -->
    <link href="{{ asset('css/select2-bootstrap-min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('crud_fields_scripts')
    <script src="{{ asset('vendor/adminlte/plugins/select2/select2.min.js') }}"></script>
    <script>
        // List client addresses
        function getClientAddresses(client_id = null) {
            $.ajax({
                url: '{{ route('getClientAddresses') }}',
                type: 'POST',
                data: {
                    client_id: client_id
                },
            })
            .done(function(resp) {
                $('#client_addresses').html(resp);
            })
            .fail(function(resp) {
                // Show error message
                $(function(){
                  new PNotify({
                    text: '{{ trans('common.error_occurred') }}',
                    type: 'error',
                    icon: false
                  });
                });
            });
        }

        // Open modal and init select2
        $(document).on('click', '.add-address-btn', function () {
            $('.add-address-modal').modal('show');

            $('.select2_field').select2({
                theme: "bootstrap"
            });
        });

        // Add new address
        $(document).on('click', '.btn-add-address', function (e) {
            $.ajax({
                url: '{{ route('addClientAddress') }}',
                type: 'POST',
                data: $('#add-address-fields :input').serialize(),
            })
            .done(function(resp) {
                // Close modal
                $('.add-address-modal').modal('hide');

                // Reload client addresses
                getClientAddresses({{ $entry->id }});

                // Show success message
                $(function(){
                  new PNotify({
                    text: '{{ trans('address.address_created') }}',
                    type: 'success',
                    icon: false
                  });
                });
            })
            .fail(function() {
                // Close modal
                $('.add-address-modal').modal('hide');

                // Show error message
                $(function(){
                  new PNotify({
                    text: '{{ trans('common.error_occurred') }}',
                    type: 'error',
                    icon: false
                  });
                });
            });
        });

        // Delete address
        $(document).on('click', '.btn-delete-address', function (){
            var confirmation = confirm("{{ trans('address.delete_address_confirm') }}");
            if (confirmation) {
                var addressId = $(this).data('address-id');

                $.ajax({
                    url: '{{ route('deleteClientAddress') }}',
                    type: 'POST',
                    data: {
                        id: addressId,
                    },
                })
                .done(function() {
                    // Reload client addresses
                    getClientAddresses({{ $entry->id }});

                    // Show success message
                    $(function(){
                      new PNotify({
                        text: '{{ trans('address.address_deleted') }}',
                        type: 'success',
                        icon: false
                      });
                    });
                })
                .fail(function() {
                    // Show error message
                    $(function(){
                      new PNotify({
                        text: '{{ trans('common.error_occurred') }}',
                        type: 'error',
                        icon: false
                      });
                    });
                });

            }
        });

        $(document).ready(function () {
            // List client addresses
            getClientAddresses({{ $entry->id }});
        });
    </script>
@endpush