<?php
namespace AdminUI\AdminUIAddress\Classes;

class AddressCore
{
    // default address
    const URL = 'https://api.getAddress.io';

    protected $apiKey;

    protected $adminApiKey;

    // setup api key
    public function __construct() {
        $this->apiKey      = config('adminuiaddress.apiKey', '');
        $this->adminApiKey = config('adminuiaddress.adminApiKey', '');
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
                $url .= '/'.$value;
            }
        }
        $url .= '?api-key='.$this->apiKey;

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
