@php
$countries = AdminUI\AdminUIAddress\Models\Country::options();
@endphp

<div class="address-block">
    {!! Form::auiSelect('country_id', $countries, old('country_id', 222),  ['class' => 'country-lookup'], 'Country') !!}
    {!! Form::auiText('phone', old('phone', ''), [], 'Phone') !!}

    <div class="row lookup-block">
        <div class="col-sm-6">
            {!! Form::auiText('postcode', old('postcode', ''), ['class' => 'postcode upperCase'], 'Post Code' ) !!}
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
        {!! Form::auiSelect('lookup', ['' => 'Please Choose'], '', ['class' => 'address-select-pick'], 'Choose Address') !!}
    </div>

    <div class="main-address-block">
        {!! Form::auiText('address', old('address', ''), ['class' => 'address_field'], 'Address') !!}
        {!! Form::auiText('address_2', old('address_2', ''), ['class' => 'address_2_field'], 'Address 2') !!}
        {!! Form::auiText('town', old('town', ''), ['class' => 'town_field'], 'Town') !!}
        {!! Form::auiText('county', old('county', ''), ['class' => 'county_field'], 'County') !!}
        {!! Form::auiText('postcode', old('postcode', ''), ['class' => 'address-postcode upperCase'], 'Postcode') !!}
        {{-- {!! Form::auiText('distance', old('distance', ''), [], 'Distance') !!} --}}
        <input type="hidden" name="lng" class="lng_field" />
        <input type="hidden" name="lat" class="lat_field" />
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
