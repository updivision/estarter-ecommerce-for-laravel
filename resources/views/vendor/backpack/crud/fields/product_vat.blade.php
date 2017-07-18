@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
  {{-- FIELD EXTRA CSS  --}}
  {{-- push things in the after_styles section --}}

      @push('crud_fields_styles')
          <!-- no styles -->
      @endpush


  {{-- FIELD EXTRA JS --}}
  {{-- push things in the after_scripts section --}}

      @push('crud_fields_scripts')

        <script src="{{ asset('js/bigNumber.js') }}"></script>

        <script>
          var price = $('input[name="price"]');
          var price_with_vat = $('input[name="price_with_vat"]');
          var tax_value = $('#tax').select2().find(':selected').data('value');

          // Calculate price with tax on document ready
          $(document).ready(function() {
            if (price.val().length > 0 ) {
                tax_val = new BigNumber(tax_value);
                price_val = new BigNumber(price.val());

                priceWithTax = price_val.plus(tax_val.dividedBy(100).times(price_val)).toFixed(2);

                price_with_vat.val(priceWithTax);
            }
          });

          // Calculate price without tax
          $(document).on('keyup', 'input[name="price_with_vat"]', function() {
            if ($(this).val().length > 0) {
                tax_val = new BigNumber(tax_value);
                price_with_vat_val = new BigNumber(price_with_vat.val());

                priceWithoutTax = price_with_vat_val.dividedBy(tax_val.dividedBy(100).plus(1)).toFixed(2);

                price.val(priceWithoutTax);
            } else {
              price.val('');
            }
          });

          // Calculate price without on selected tax change
          $('#tax').select2().on("change", function(e) {
            tax_value = $('#tax').select2().find(':selected').data('value');

            tax_val = new BigNumber(tax_value);
            price_with_vat_val = new BigNumber(price_with_vat.val());

            priceWithoutTax = price_with_vat_val.dividedBy(tax_val.dividedBy(100).plus(1)).toFixed(2);

            price.val(priceWithoutTax);
          });
        </script>

      @endpush
@endif