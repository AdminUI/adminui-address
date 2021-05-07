<?php

namespace AdminUI\AdminUIAddress\Helpers;

use Illuminate\Support\Facades\Http;

class AddressioApi
{
    private $apiKey;

    // setup api key
    public function __construct()
    {
        $this->apiKey     = env('GETADDRESS_API_KEY');
        $this->apiedpoint = 'https://api.getAddress.io';
    }

    public function find($postcode)
    {
        // assemble the url
        $finalUrl = $this->apiedpoint . "/find/" . $postcode . "?api-key=" . $this->apiKey . '&expand=true';
        // using Http get a json response
        $response = Http::get($finalUrl)->json();
        // return the results
        return $response;
    }
}
