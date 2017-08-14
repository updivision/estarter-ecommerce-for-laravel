<!-- toggle switch  -->
<div @include('crud::inc.field_wrapper_attributes') >
     <label>{!! $field['label'] !!}</label>
  <div class="row">
    <div class="col-md-4"> 
      <label class="switch-light switch-default" onclick="">

      <input type="hidden" name="{{ $field['name'] }}" value="0">
      <input type="checkbox" value="1" name="{{ $field['name'] }}" onchange="onToggle(this)"

          @if (isset($field['value']))
            @if( ((int) $field['value'] == 1 || old($field['name']) == 1) && old($field['name']) !== '0' )
             checked="checked"
            @endif
          @elseif (isset($field['default']) && $field['default'])
            checked="checked"
          @endif

          @if (isset($field['attributes']))
              @foreach ($field['attributes'] as $attribute => $value)
          {{ $attribute }}="{{ $value }}"
            @endforeach
          @endif >

      <span>
        <span class="no" value="0">@lang('common.no')</span>
        <span class="yes" value="1">@lang('common.yes')</span>
        <a></a>
      </span>
      </label>
    </div>
  </div>
    
    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>


@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
  {{-- FIELD EXTRA CSS  --}}
  {{-- push things in the after_styles section --}}

      @push('crud_fields_styles')
         <!-- include toggle switch css-->
        <link href="{{ asset('css/toggle-switch.css') }}" rel="stylesheet" type="text/css" />

      @endpush


  {{-- FIELD EXTRA JS --}}
  {{-- push things in the after_scripts section --}}

      @push('crud_fields_scripts')
          <script>

            function onToggle(obj){
              item_to_enable_name = $(obj).attr('field_to_enable')
              item_to_enable = $("[name='" + String(item_to_enable_name) + "']");
             
              if(item_to_enable.attr('disabled') == 'disabled') {
                item_to_enable.prop("disabled", false);
              }
              else {
                item_to_enable.prop("disabled", 'disabled');
              }
            }
            
        </script>
      @endpush
@endif
