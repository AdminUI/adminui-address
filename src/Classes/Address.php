<?php

namespace AdminUI\AdminUIAddress\Classes;

// Laravel 7 Http helper
use Illuminate\Support\Facades\Http;

/**
 * Helper Class to help with getAddress.io
 * This is a rewritten version of
 * https://github.com/Altrozero/get-address-io-php
 * for Laravel 7
 */
class Address
{
    // default address
    const URL = 'https://api.getAddress.io';

    private $apiKey;

    // setup api key
    public function __construct()
    {
        $this->apiKey   = config('adminuiaddress.apiKey', '');
    }

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

    /**
     * Build the Url
     *
     * @param array $data
     * @param array $params
     * @return string
     */
    public function buildUrl($data, $params = array())
    {
        $url = self::URL;
        foreach ($data as $value) {
            if ($value) {
                $url .= '/' . $value;
            }
        }
        $url .= '?api-key=' . $this->apiKey;

        foreach ($params as $key => $param) {
            $url .= '&';
            $url .= urlencode($key) . '=';
            if ($param === true) {
                $url .= 'true';
            } else if ($param === false) {
                $url .= 'false';
            } else {
                $url .= urlencode($param);
            }
        }
        return $url;
    }
}
