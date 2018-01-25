<!-- enum discount type-->
<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')
    <?php $entity_model = $crud->model; ?>
    <select
        name="{{ $field['name'] }}"
        @include('crud::inc.field_attributes')
        >

        @if ($entity_model::isColumnNullable($field['name']))
            <option value="">-</option>
        @endif

            @if (count($entity_model::getPossibleEnumValues($field['name'])))
                @foreach ($entity_model::getPossibleEnumValues($field['name']) as $possible_value)
                    <option value="{{ $possible_value }}"
                        @if (( old($field['name']) &&  old($field['name']) == $possible_value) || (isset($field['value']) && $field['value']==$possible_value))
                            selected
                        @endif
                    >{{ $possible_value }}</option>
                @endforeach
            @endif
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')

    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <script>
            $('select').on('change', function() {
                
                field_to_enable_name = $(this).attr('field_to_enable');
                field_to_enable = $("[name='" + String(field_to_enable_name) + "']");

                enable_field_on_option_name = $(this).attr('enable_field_on_option');
                enable_field_on_option = $("[name='" + String(enable_field_on_option_name) + "']");
                
                if(this.value == enable_field_on_option_name){
                    field_to_enable.prop("disabled", false);
                }
                else {
                    field_to_enable.prop("disabled", 'disabled');
                }
            });  
        </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}