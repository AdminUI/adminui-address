<?php
namespace AdminUI\AdminUIAddress\Classes;

// Laravel 7 Http helper
use Illuminate\Support\Facades\Http;
use AdminUI\AdminUIAddress\Classes\AddressCore;
/**
 * Helper Class to help with getAddress.io
 * This is a rewritten version of
 * https://github.com/Altrozero/get-address-io-php
 * with a Laravel 7 wrapper
 */
class Address extends AddressCore
{
    /**
     * Find Api Request
     *
     * @param string $postcode
     * @param string $property
     * @param boolean $expand
     * @param string $sort
     * @param string $format
     * @return object
     */
    public function find($postcode, $property = false, $expand = false, $sort = false, $format = false)
    {
        // Build the url
        $url = $this->buildUrl(
            [
                'find',
                $postcode,
                $property
            ],
            [
                'expand' => $expand,
                'sort'   => $sort,
                'format' => $format
            ]
        );
        // using Http get a json response
        $response = Http::get($url)->json();
        // return the results
        return $response;
    }
}
