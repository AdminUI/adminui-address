@php
$countries = cache()->remember('auicountries', now()->addDays(1) , function() {
return AdminUI\AdminUIAdmin\Models\Country::all()->pluck('name', 'id');
});
$states = cache()->remember('auistates', now()->addDays(1), function() {
return AdminUI\AdminUIAdmin\Models\State::orderBy('name')->get();
});
@endphp

<v-row>
    <v-col>
        <x-aui::forms.text name="postcode" id="postcode" label="{{ __('admin/auieaccounts.postcode') }}"
            value="{{ old('postcode') }}" required />

        <div id="address-options">
            <select
                style="border: 1px solid #999; border-radius: 4px; padding: 0.5em 1em; margin-bottom: 1em; width: 100%;"
                name="cars" id="address-selections" onchange="selectAddres()">
                <option value="volvo">Volvo</option>
                <option value="saab">Saab</option>
                <option value="mercedes">Mercedes</option>
                <option value="audi">Audi</option>
            </select>
        </div>

    </v-col>
    <v-col>
        {{-- Button to search --}}
        <div id="hide-button-search" style="display: block">
            <v-btn depressed color="primary" onclick="lookPostCode()">
                Search
            </v-btn>
        </div>
        {{-- Loader spinner --}}
        <div id="postcode-loader" style="display: none">
            <v-progress-circular :width="5" color="blue" indeterminate></v-progress-circular>
        </div>

    </v-col>
    <v-col>
        <v-btn depressed color="info" onclick="toogleHiddenForm()">
            Manual
        </v-btn>
    </v-col>
</v-row>

<testing-this> </testing-this>


{{-- Rest of the form --}}
<div style="display: none" id="hidden-postcode-form">

    <x-aui::forms.select :options="$countries" id="country_id" value="222" name="country_id"
        label="{{ __('admin/auieaccounts.country') }}" />

    <x-auiaddress::layout.hidden_form />
</div>

@push('scripts')

<script>
    // Get the Fields References
    var postcode   = document.querySelector('#postcode');
    var country_id = document.querySelector('#country_id');
    var phone      = document.querySelector('#phone');
    var address    = document.querySelector('#address');
    var address_2  = document.querySelector('#address_2');
    var town       = document.querySelector('#town');
    var county     = document.querySelector('#county');

    // Addreses List
    var addreses     = [];

    //Put the select addres a hidden buy deafult
    disableAddressSelect();

    // Enable and populate the adresses select
    function enableAddressSelect() {
        var element1 = document.querySelector("#address-options");
        element1.style.display = "block";

        // Element to add the select element
        var element2 = document.querySelector("#address-selections");
        // Clear the select
        element2.innerText = null;
        for (const [key, value] of Object.entries(addreses)) {
            var tempName = '';
            // Loop the to make the select name
            for (const [labelKey, name] of Object.entries(value.formatted_address)) {
                tempName += ' ' + name;
            }
            element2.add(new Option(tempName, key));
        }
    }

    function disableAddressSelect() {
        var element1 = document.querySelector("#address-options");
        element1.style.display = "none";
    }

    // Enable the loading state
    function enableLoading() {
        var element1 = document.querySelector("#postcode-loader");
        element1.style.display = "block";
        var element2 = document.querySelector("#hide-button-search");
        element2.style.display = "none";

    }
    // Disable the loading state
    function disableLoading() {
        var element1 = document.querySelector("#postcode-loader");
        element1.style.display = "none";
        var element2 = document.querySelector("#hide-button-search");
        element2.style.display = "block";
    }

    // Function That hide and enalbe the rest of the form
    function enableForm() {
        var x = document.querySelector("#hidden-postcode-form");
        x.style.display = "block";
    }
    // Disable the form
    function disableForm() {
        var x = document.querySelector("#hidden-postcode-form");
        x.style.display = "none";
        disableAddressSelect();
    }
    // Hide or show the hidden addres form
    function toogleHiddenForm() {
        var x = document.querySelector("#hidden-postcode-form");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    // Function That will look for the address using the api
    function lookPostCode() {
        // Check for a empty string
        if (postcode.value === '') {
            window.$app.vue.$store.commit("activateSnackbar", {
                    title  : "",
                    type   : "error",
                    message: "Postcode can't be null"
            });
        } else {
            // csrfToken
            const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
            (async () => {
                const rawResponse = await fetch('address/lookup-poscode', {
                    method: 'POST',
                    headers: {
                        "Content-Type"    : "application/json",
                        "Accept"          : "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token"    : csrfToken
                    },
                    body: JSON.stringify({
                        postcode           : postcode.value,              // Postcode
                    })
                });
                // Parse the data
                enableLoading();
                const content = await rawResponse.json();
                // Check for errors
                if (content.errors) {
                    for (const [key, value] of Object.entries(content.errors)) {
                        window.$app.vue.$store.commit("activateSnackbar", {
                                title  : "",
                                type   : "error",
                                message: value
                        });
                    }
                } else {
                    // Check if the Request is valid if the user din;t type something wrong
                    if (content.data.Message) {
                        window.$app.vue.$store.commit("activateSnackbar", {
                                title  : "",
                                type   : "error",
                                message: content.data.Message
                        });
                        disableLoading();
                    } else {
                        // Call a function to populate the select
                        addreses = content.data.addresses;
                        enableAddressSelect();
                    }

                }

                setTimeout(() => {
                    disableLoading();
                    //console.log(addreses);
                }, 1000);
            })();
        }
    }

    // Select the addres
    function selectAddres() {
        // Get the value of the select box
        element = document.querySelector("#address-selections");

        // Now enable the box where the user can check if is right
        enableForm();

        // Now populate the values
        address.value   = addreses[element.value].line_1 + ' ' + addreses[element.value].line_2 + ' ' + addreses[element.value].line_3 + ' ' + addreses[element.value].line_4
        address_2.value = addreses[element.value].building_name + ' ' + addreses[element.value].building_number+ ' ' + addreses[element.value].thoroughfare;
        town.value      = addreses[element.value].district;
        county.value    = addreses[element.value].county;
    }

</script>
@endpush
