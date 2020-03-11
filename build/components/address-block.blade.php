@php
$countries = AdminUI\AdminUIAddress\Models\Country::all();
@endphp
<div class="address-block">
    <div class="form-group">
        <label for="Country" class="control-label">Country</label><br/>
        <select class="custom-select form-control country-lookup" name="country_id">
            @foreach ($countries as $country)
                @php
                if ($country->id == old('country', 222)) {
                    $selected = 'selected="selected"';
                }
                @endphp
                <option value="{{ $country->id }}" data-postcode="{{ $country->postcode }}" {{ $selected }}>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="Phone" class="control-label">Phone</label>
        <input class="form-control" name="phone" type="text" value="{{ old('phone', '') }}">
    </div>

    <div class="row lookup-block">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="Post Code" class="control-label">Post Code</label>
                <input class="form-control postcode upperCase" name="postcode" type="text" value="{{ old('postcode', '') }}">
            </div>
        </div>

        <div class="col-sm-3">
            <label>&nbsp;</label>
            <button type="button" class="postcode-lookup btn btn-block btn-outline-success">Lookup</button>
        </div>
        <div class="col-sm-3">
            <label>&nbsp;</label>
            <button type="button" class="postcode-manual btn btn-block btn-outline-warning">Manually Add</button>
        </div>
    </div>

    <div class="address-select">
        <div class="form-group">
            <label for="Choose Address" class="control-label">Choose Address</label><br/>
            <select class="custom-select form-control address-select-pick" style="width:100%" name="lookup">
                <option value="" selected="selected">Please Choose</option>
            </select>
        </div>
    </div>

    <div class="main-address-block">
        <div class="form-group">
            <label for="Address" class="control-label">Address</label>
            <input class="form-control address_field" name="address" type="text" value="{{ old('address', '') }}">
        </div>
        <div class="form-group">
            <label for="Address 2" class="control-label">Address 2</label>
            <input class="form-control address_2_field" name="address_2" type="text" value="{{ old('address_2', '') }}">
        </div>
        <div class="form-group">
            <label for="Town" class="control-label">Town</label>
            <input class="form-control town_field" name="town" type="text" value="{{ old('town', '') }}">
        </div>
        <div class="form-group">
            <label for="County" class="control-label">County</label>
            <input class="form-control county_field" name="county" type="text" value="{{ old('county', '') }}">
        </div>
        <div class="form-group">
            <label for="Postcode" class="control-label">Postcode</label>
            <input class="form-control address-postcode upperCase" name="postcode" type="text" value="{{ old('postcode', '') }}">
        </div>

        <input type="hidden" name="lng" class="lng_field" value="{{ old('lng', '') }}">
        <input type="hidden" name="lat" class="lat_field" value="{{ old('lat', '') }}">
    </div>
</div>

@push('scripts')
<script>
    $('.address-select, .main-address-block').hide();
    var $data;

    $(document).on('change', '.country-lookup', function() {
        if ($(this).val() != '222') {
            hideLookup($(this));
        } else {
            showLookup($(this));
        }
    });

    $(document).on('click', '.postcode-manual', function() {
        hideLookup($(this));
    });

    $(document).on('keyup', '.postcode', function(){
        $(this).closest('.address-block').find('.address-postcode').val($(this).val());
    });

    $(document).on('click', '.postcode-lookup', function() {
        $select = $(this).closest('.address-block').find('.address-select');
        $postcode = $(this).closest('.row').find('.postcode');
        if ($postcode.val().length < 4) {
            return false;
        }
        $.getJSON("{{ route('api.address.lookup') }}", { postcode: $postcode.val() }, function(data) {
            $data = data;
            var results = '<option value="">Please Choose</options>';
            $.each(data.original.addresses, function(key, val) {
                results += '<option value="' + key + '">' + val.formatted_string + '</option>';
            });
            $('.address-select-pick').html(results);
            $('.address-select').slideDown('fast');
        });
    });

    $(document).on('change', '.address-select-pick', function() {
        key = $(this).val();
        chosen = $data.original.addresses[key];
        $block = $(this).closest('.address-block');
        hideLookup($(this));
        $block.find('.address_field').val(chosen.line_1);
        $block.find('.address_2_field').val(chosen.line_2);
        $block.find('.town_field').val(chosen.town_or_city);
        $block.find('.county_field').val(chosen.county);
        $block.find('.lng_field').val($data.original.longitude);
        $block.find('.lat_field').val($data.original.latitude);
    });

    function hideLookup($block) {
        $block.closest('.address-block').find('.address-select, .lookup-block').hide();
        $block.closest('.address-block').find('.main-address-block').slideDown('fast');
    }
    function showLookup($block) {
        $block.closest('.address-block').find('.lookup-block').show();
        $block.closest('.address-block').find('.main-address-block').slideUp('fast');
    }
</script>
@endpush
