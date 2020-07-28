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
        <label for="Country" class="control-label">{{ __('address.country') }}</label><br/>
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

        @error('country_id')
            <span class="badge badge-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>

    <div class="form-group">
        <label for="Phone" class="control-label">{{ __('address.phone') }}</label>
        <input class="form-control" name="phone" type="text" value="{{ $address->phone ?? old('phone', '') }}" placeholder="{{ __('address.phone') }}">

        @error('phone')
            <span class="badge badge-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="row lookup-block">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="Post Code" class="control-label">{{ __('address.postcode') }}</label>
                <input class="form-control postcode upperCase" name="postcode" type="text"
                value="{{ $address->postcode ?? old('postcode', '') }}" placeholder="{{ __('address.postcode') }}">
            </div>
        </div>

        <div class="col-sm-3">
            <label>&nbsp;</label>
            <button type="button" class="postcode-lookup btn btn-block btn-outline-success">{{ __('address.lookup-btn') }}</button>
        </div>
        <div class="col-sm-3">
            <label>&nbsp;</label>
            <button type="button" class="postcode-manual btn btn-block btn-outline-warning">{{ __('address.manual-btn') }}</button>
        </div>
    </div>

    <div class="address-select">
        <div class="form-group">
            <label for="Choose Address" class="control-label">{{ __('address.select-address') }}</label><br/>
            <select class="custom-select form-control address-select-pick" style="width:100%" name="lookup">
                <option value="" selected="selected">Select</option>
            </select>
        </div>
    </div>

    <div class="main-address-block">
        <div class="form-group">
            <label for="Address" class="control-label">{{ __('address.address') }}</label>
            <input class="form-control address_field" name="address"
                type="text" value="{{ $address->address ?? old('address', '') }}"
                placeholder="{{ __('address.address') }}">

            @error('address')
                <span class="badge badge-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="Address 2" class="control-label">{{ __('address.address-2') }}</label>
            <input class="form-control address_2_field" name="address_2"
                type="text" value="{{ $address->address_2 ?? old('address_2', '') }}"
                placeholder="{{ __('address.address-2') }}">

            @error('address_2')
                <span class="badge badge-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="Town" class="control-label">{{ __('address.town') }}</label>
            <input class="form-control town_field" name="town"
                type="text" value="{{ $address->town ?? old('town', '') }}"
                placeholder="{{ __('address.town') }}">

            @error('town')
                <span class="badge badge-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group counties">
            <label for="County" class="control-label">{{ __('address.county') }}</label>
            <input class="form-control county_field" name="county"
                type="text" value="{{ $address->county ?? old('county', '') }}"
                placeholder="{{ __('address.county') }}">

            @error('county')
                <span class="badge badge-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group states">
            <label for="County" class="control-label">{{ __('address.state') }}</label>
            <select class="custom-select form-control" name="state">
                @foreach ($states as $state)
                    <option value="{{ $state->id }}">
                        {{ $state->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="Postcode" class="control-label">{{ __('address.postcode') }}</label>
            <input class="form-control address-postcode upperCase" name="postcode"
                type="text" value="{{ $address->postcode ?? old('postcode', '') }}"
                required="required" placeholder="{{ __('address.postcode') }}">
        </div>

        <div class="address-notification alert alert-warning p-1">
        </div>
        <input type="hidden" name="lng" class="lng_field" value="{{ $address->lng ?? old('lng', '') }}">
        <input type="hidden" name="lat" class="lat_field" value="{{ $address->lat ?? old('lat', '') }}">
        <input type="hidden" name="distance" class="distance_field"
        value="{{ $address->distance ?? old('distance', '') }}">
    </div>
</div>

@push('scripts')
{{-- Remember to add @stack('scripts') to you template after jquery for this to work --}}
<script src="{{ asset('vendor/adminui/js/address-block.js') }}"></script>
@endpush
