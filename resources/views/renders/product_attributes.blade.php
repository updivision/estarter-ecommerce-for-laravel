<style>
    img {
        max-width: 100%
    }
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
    .select2-container {
        width: 100% !important;
    }
</style>

@foreach($attributes as $attribute)
    @if($attribute->type == 'text')
        <div class="form-group col-md-12">
          <label>{{ $attribute->name }}</label>
          <input type="text" name="attributes[{{ $attribute->id }}]" onclick="this.select()" class="form-control" value="{{ (count($old) > 0 && $old[$attribute->id] != '') ? $old[$attribute->id] : $attribute->values->first()->value }}">
          <p class="help-block">{{ ucfirst($attribute->type) }}</p>
        </div>
    @endif

    @if($attribute->type == 'textarea')
        <div class="form-group col-md-12">
          <label>{{ $attribute->name }}</label>
          <textarea name="attributes[{{ $attribute->id }}]" onclick="this.select()" class="form-control">{{ (count($old) > 0 && $old[$attribute->id] != '') ? $old[$attribute->id] : $attribute->values->first()->value }}</textarea>
          <p class="help-block">{{ ucfirst($attribute->type) }}</p>
        </div>
    @endif

    @if($attribute->type == 'date')
        <div class="form-group col-md-12">
          <label>{{ $attribute->name }}</label>
          <input type="date" name="attributes[{{ $attribute->id }}]" onclick="this.select()" class="form-control" value="{{ (count($old) > 0 && $old[$attribute->id] != '') ? $old[$attribute->id] : $attribute->values->first()->value }}">
          <p class="help-block">{{ ucfirst($attribute->type) }}</p>
        </div>
    @endif

    @if($attribute->type == 'dropdown' || $attribute->type == 'multiple_select')
        <div class="form-group col-md-12">
          <label>{{ $attribute->name }}</label>
          <input type="hidden" name="attributes[{{ $attribute->id }}]" value="">
          <select name="attributes[{{ $attribute->id }}][]" class="form-control select2_field" @if($attribute->type == 'multiple_select') multiple @endif>
            @if(count($old) > 0 && isset($old[$attribute->id]) && $old[$attribute->id] != '')
                @foreach($attribute->values as $option)
                    <option value="{{ $option->value }}" @if((is_array($old[$attribute->id]) && in_array($option->value, $old[$attribute->id])) || (is_string($old[$attribute->id]) && $old[$attribute->id] == $option->value)) selected @endif>{{ $option->value }}</option>
                @endforeach
            @else
                @foreach($attribute->values as $option)
                    <option value="{{ $option->value }}" @if($attribute->type == 'multiple_select') selected @endif>{{ $option->value }}</option>
                @endforeach
            @endif
          </select>
          <p class="help-block">{{ ($attribute->type == 'dropdown') ? trans('attribute.dropdown') : trans('attribute.multiple_select') }}</p>
        </div>
    @endif

    @if ($attribute->type == 'media')
        @php
            $disk = 'attributes';
            Session::put('attribute_'.$attribute->id, (count($old) > 0 && isset($old[$attribute->id]) && $old[$attribute->id] != '') ? $old[$attribute->id] : $attribute->values->first()->value);
        @endphp

        <div class="form-group col-md-12">
            <label>{{ $attribute->name }}</label>
              <div class="row">
                <div class="col-sm-6" style="margin-bottom: 20px;">
                    <img id="preview-{{ $attribute->id }}" src="{{ url(config('filesystems.disks.'.$disk.'.simple_path').'/'.((count($old) > 0 && isset($old[$attribute->id]) && $old[$attribute->id] != '') ? $old[$attribute->id] : $attribute->values->first()->value)) }}">
                </div>
              </div>

            <input type="hidden" name="attributes[{{ $attribute->id }}]" value="{{ (count($old) > 0 && isset($old[$attribute->id]) && $old[$attribute->id] != '') ? $old[$attribute->id] : $attribute->values->first()->value }}"><br>

            <label class="btn btn-primary btn-file">
                Browse
                <input type="file" data-attribute-id="{{ $attribute->id }}" class="form-control">
            </label>

            <p class="help-block">{{ ucfirst($attribute->type) }}</p>
        </div>

    @endif

@endforeach


<script>
    $(document).ready(function() {
        $('.select2_field').select2();
    });

    $('input[type="file"]').on("change", function() {
        var input = this;
        var attributeId = $(this).data('attribute-id');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview-'+attributeId).attr('src', e.target.result);
                $('input[name="attributes['+attributeId+']"]').val(e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    });
</script>