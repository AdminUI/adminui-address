$('.address-select, .main-address-block, .address-notification, .states').hide();
    var $data;

    $('.postcode').keyup(function() {
        $(this).val($(this).val().toUpperCase());
    });

    $(document).on('change', '.country-lookup', function() {
        $block = $(this).closest('.address-block');
        if ($(this).val() != '222') {
            hideLookup($(this));
        } else {
            showLookup($(this));
        }
        // check if postcode is a required field
        if ($(this).data('postcode') == 1) {
            requirePostcode($block);
        } else {
            disablePostcode($block);
        }
        // if United States show state list as some payment gateway insist
        if ($(this).val() == '223') {
            showStates($block)
        } else {
            showCounties($block)
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
        $.getJSON("/address/lookup", { postcode: $postcode.val() }, function(data) {
            $data = data;
            if (data.meta.results == 0) {
                hideLookup($postcode);
                $('.address-notification')
                    .html('No Matches Found. Please Enter Manually')
                    .slideDown('fast');
            } else {
                var results = '<option value="">Please Choose ('+ data.meta.results + ' results)</options>';
                $.each(data.data, function(key, val) {
                    results += '<option value="' + key + '">' + val.formatted_string + '</option>';
                });
                $('.address-select-pick').html(results);
                $('.address-select').slideDown('fast');
            }
        });
    });

    $(document).on('change', '.address-select-pick', function() {
        key = $(this).val();
        chosen = $data.data[key];

        $block = $(this).closest('.address-block');
        hideLookup($(this));
        $block.find('.address_field').val(chosen.line_1);
        $block.find('.address_2_field').val(chosen.line_2);
        $block.find('.town_field').val(chosen.town_or_city);
        $block.find('.county_field').val(chosen.county);
        $block.find('.lng_field').val($data.meta.longitude);
        $block.find('.lat_field').val($data.meta.latitude);
        $block.find('.distance_field').val($data.meta.distance);
    });

    function hideLookup($block) {
        $block.closest('.address-block').find('.address-select, .lookup-block').hide();
        $block.closest('.address-block').find('.main-address-block').slideDown('fast');
    }
    function showLookup($block) {
        $block.closest('.address-block').find('.lookup-block').show();
        $block.closest('.address-block').find('.main-address-block').slideUp('fast');
    }
    function upper(string) {
        return string.toUpperCase();
    }
    function requirePostcode($block) {
        $block.find('.postcode').attr('required', 'required');
    }
    function disablePostcode($block) {
        $block.find('.postcode').removeAttr('required');
    }
    function showStates($block) {
        $block.find('.states').show();
        $block.find('.counties').hide();
    }
    function showCounties($block) {
        $block.find('.states').hide();
        $block.find('.counties').show();
    }
