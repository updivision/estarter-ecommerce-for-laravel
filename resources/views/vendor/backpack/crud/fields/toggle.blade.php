<!-- radio toggle -->
@php
    $optionPointer = 0;
    $optionValue = old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' ));
@endphp

<div @include('crud::inc.field_wrapper_attributes') >

    <div>
        <label>{!! $field['label'] !!}</label>
    </div>

    @if( isset($field['options']) && is_array($field['options']) )

        @foreach ($field['options'] as $value => $label )
            @php ($optionPointer++)

            @if( isset($field['inline']) && $field['inline'] )

            <label class="radio-inline" for="{{$field['name']}}_{{$optionPointer}}">
                <input data-field-toggle="{{ json_encode($field['hide_when']) }}" type="radio" id="{{$field['name']}}_{{$optionPointer}}" name="{{$field['name']}}" value="{{$value}}" {{$optionValue!=='' && $optionValue == $value ? ' checked': ''}}> {!! $label !!}
            </label>

            @else

            <div class="radio">
                <label for="{{$field['name']}}_{{$optionPointer}}">
                    <input data-field-toggle="{{ json_encode($field['hide_when']) }}" type="radio" id="{{$field['name']}}_{{$optionPointer}}" name="{{$field['name']}}" value="{{$value}}" {{$optionValue!=='' && $optionValue == $value ? ' checked': ''}}> {!! $label !!}
                </label>
            </div>

            @endif

        @endforeach

    @endif

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
        jQuery(document).ready(function($){

            window.$hiddenFields = window.$hiddenFields || {};

            var $toggle = function( $radio ){

                $hideWhen = $radio.data('field-toggle'),
                $value    = $radio.val(),
                $radioSet = $radio.attr('name');

                $hiddenFields[ $radioSet ] = $hiddenFields[ $radioSet ] || [];

                if( Object.keys($hiddenFields[ $radioSet ]).length ){
                    $.each($hiddenFields[ $radioSet ], function(idx, field){
                        field.show();
                    });
                    $hiddenFields[ $radioSet ] = [];
                }

                if( typeof $hideWhen[ $value ] !== undefined ){
                    $.each($hideWhen[ $value ], function(idx, name){

                        var f = $('[name="'+name+'"]').parents('.form-group');

                        if( f.length ){
                            $hiddenFields[ $radioSet ].push(f);
                            f.hide();
                        }
                    });
                }
            };

            $('input[data-field-toggle]').on('change', function(){
                return $toggle( $(this) );
            });

            $('input[data-field-toggle]:checked').each(function(){
                return $toggle( $(this) );
            });
        });
    </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}