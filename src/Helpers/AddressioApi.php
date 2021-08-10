<?php

namespace AdminUI\AdminUIAddress\Helpers;

use Illuminate\Support\Facades\Http;

class AddressioApi
{
    private $apiKey;

    // setup api key
    public function __construct()
    {
        $this->apiKey     = config('adminuiaddress.apiKey', '');
        $this->apiendpoint = 'https://api.getAddress.io';
    }

    public function find($postcode)
    {
        // assemble the url
        $finalUrl = $this->apiendpoint . "/find/" . $postcode . "?api-key=" . $this->apiKey . '&expand=true';
        // using Http get a json response
        $response = Http::get($finalUrl)->json();
        // return the results
        return $response;
    }
}
