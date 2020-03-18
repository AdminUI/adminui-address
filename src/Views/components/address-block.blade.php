@php
$countries = cache()->remember('auicountries', now()->addDays(1) , function() {
    return AdminUI\AdminUIAddress\Models\Country::active()->orderBy('name')->get();
});
$states = cache()->remember('auistates', now()->addDays(1), function() {
    return AdminUI\AdminUIAddress\Models\State::orderBy('name')->get();
});
@endphp
<div class="address-block">
    <div class="form-group">
        <label for="Country" class="control-label">Country</label><br/>
        <select class="custom-select form-control country-lookup" name="country_id">
            @foreach ($countries as $country)
                <option value="{{ $country->id }}"
                    data-postcode="{{ $country->postcode }}"
                    {{ $country->id == old('country', 222) ? 'selected="selected"' : '' }}
                >
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
            <button type="button" class="postcode-manual btn btn-block btn-outline-warning">Manual</button>
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
        <div class="form-group counties">
            <label for="County" class="control-label">County</label>
            <input class="form-control county_field" name="county" type="text" value="{{ old('county', '') }}">
        </div>
        <div class="form-group states">
            <label for="County" class="control-label">US State</label>
            <select class="custom-select form-control" name="state">
                @foreach ($states as $state)
                    <option value="{{ $state->id }}">
                        {{ $state->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="Postcode" class="control-label">Postcode</label>
            <input class="form-control address-postcode upperCase" name="postcode" type="text" value="{{ old('postcode', '') }}" required="required">
        </div>

        <div class="address-notification alert alert-warning p-1">
        </div>
        <input type="hidden" name="lng" class="lng_field" value="{{ old('lng', '') }}">
        <input type="hidden" name="lat" class="lat_field" value="{{ old('lat', '') }}">
        <input type="hidden" name="distance" class="distance_field" value="{{ old('distance', '') }}">
    </div>
</div>

@push('scripts')
{-- Remember to add @stack('scripts') to template footer --}
<script src="{{ asset('vendor/adminui/js/address-block.js') }}"></script>
@endpush
