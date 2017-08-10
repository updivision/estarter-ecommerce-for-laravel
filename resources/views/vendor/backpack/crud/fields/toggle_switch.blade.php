<!-- toggle switch  -->
<div @include('crud::inc.field_wrapper_attributes') >
     <label>{!! $field['label'] !!}</label>
  <div class="row">
    <div class="col-md-4"> 
      <label class="switch-light switch-default" onclick="">
        
      <input type="checkbox">

      <span>
        <span class="no">NO</span>
        <span class="yes">YES</span>
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
          <!-- no scripts -->
      @endpush
@endif
