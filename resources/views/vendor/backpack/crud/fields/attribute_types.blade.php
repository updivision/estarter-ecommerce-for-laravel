<div class="form-group attr-field attr-type-text col-md-12" style="display: none;">
  <label>{{ trans('attribute.default') }} {{ trans('attribute.text') }}</label>
  <input type="text" name="text" class="form-control" @if(isset($entry) && $entry->type == 'text') value="{{ $entry->values->first()->value }}" @endif>
</div>

<div class="form-group attr-field attr-type-textarea col-md-12" style="display: none;">
  <label>{{ trans('attribute.default') }} {{ trans('attribute.textarea') }}</label>
  <textarea name="textarea" class="form-control">@if(isset($entry) && $entry->type == 'textarea'){{ $entry->values->first()->value }}@endif</textarea>
</div>

<div class="form-group attr-field attr-type-date col-md-12" style="display: none;">
  <label>{{ trans('attribute.default') }} {{ trans('attribute.date') }}</label>
  <input type="date" name="date" class="form-control" @if(isset($entry) && $entry->type == 'date') value="{{ $entry->values->first()->value }}" @endif>
</div>

<div class="form-group attr-field attr-type-dropdown col-md-12" style="display: none;">
  <label>{{ trans('attribute.multiple_select') }}</label>
  <div class="well">
    <a href="javascript:void(0)" id="add_option">
      <i class="fa fa-plus"></i>
      Add Option
    </a>

    <hr>

    <div class="options">

        {{-- Populate options on edit --}}
        @if(isset($entry) && ($entry->type == 'multiple_select' || $entry->type == 'dropdown'))
          @foreach($entry->values as $k=>$option)
            <div class="form-group option">
              <label>Option #{{ $k+1 }}</label>
              <div class="input-group">
                <input type="text" name="current_option[{{$option->id}}]" class="form-control" value="{{ $option->value }}" placeholder="Name">
                <span class="input-group-addon">
                  <i class="fa fa-ban"></i>
                </span>
              </div>
            </div>
          @endforeach
        @endif

        {{-- Input old --}}
        @if (is_array(old('option')) && count(old('option')) > 0)
          @foreach(old('option') as $k=>$option)
            <div class="form-group option">
              <label>Option #{{ $k+1 }}</label>
              <div class="input-group">
                <input type="text" name="option[{{$k}}]" class="form-control" value="{{ $option }}" placeholder="Name">
                <span class="input-group-addon">
                  <a href="javascript:void(0)" class="remove-option"><i class="fa fa-remove"></i></a>
                </span>
              </div>
            </div>
          @endforeach
        @endif
    </div>

  </div>
</div>


@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
  {{-- FIELD EXTRA CSS  --}}
  {{-- push things in the after_styles section --}}

      @push('crud_fields_styles')
          <!-- no styles -->
      @endpush


  {{-- FIELD EXTRA JS --}}
  {{-- push things in the after_scripts section --}}

      @push('crud_fields_scripts')

        <script>

            // Reopen attribute specific filed type on redirect back
            $(document).ready(function() {
                var type = $('#attribute_type').val();

                if(type == 'multiple_select') {
                  type = 'dropdown';

                  $('.attr-type-dropdown').children('label').html('{{ trans('attribute.multiple_select') }}');
                } else {
                  $('.attr-type-dropdown').children('label').html('{{ trans('attribute.dropdown') }}');
                }

                $('.attr-type-'+type).show();

                optionNumeration();
            });

            // Option numerotation function
            function optionNumeration() {
              var i = 0;
                $('.option').each(function() {
                  i++;
                  $(this).find('label').html('{{ trans('attribute.option') }} #'+i);
                  $(this).find('input[name^="option"]').attr('name', 'option['+i+']');
                });
            }

            // Add Option
            $(document).on('click', '#add_option', function() {
                // Create option template
                var option_template = '<div class="form-group option">'
                    option_template +=      '<label>#{{ trans('attribute.option') }}</label>'
                    option_template +=      '<div class="input-group">'
                    option_template +=        '<input type="text" name="option[]" class="form-control" placeholder="Name"/>'
                    option_template +=        '<span class="input-group-addon"><a href="javascript:void(0)" class="remove-option"><i class="fa fa-remove"></i></a></span>'
                    option_template +=      '</div>'
                    option_template +=  '</div>'

                // Append option
                $('.options').append(option_template);

                // Numerotate options
                optionNumeration();
            });

            // Remove selected option
            $(document).on('click', '.remove-option', function() {
                $(this).closest('.option').remove();

                // Numerotate options
                optionNumeration();
            });

            // Show / Hide attribute specific field type
            $(document).on('change', '#attribute_type', function () {
                var type = $(this).val();

                $('.attr-field').hide();
                $('.options').empty();

                if(type == 'multiple_select') {
                  type = 'dropdown';

                  $('.attr-type-dropdown').find('label').html('{{ trans('attribute.multiple_select') }}');
                } else {
                  $('.attr-type-dropdown').find('label').html('{{ trans('attribute.dropdown') }}');
                }

                $('.attr-type-'+type).show();

            });
        </script>

      @endpush
@endif