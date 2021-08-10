<?php

namespace AdminUI\AdminUIAddress\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AdminUI\AdminUIAddress\Helpers\AddressioApi;

/**
 * A api request to return via php from GetAddress.io
 */
class AddressApiController extends Controller
{
    public function __construct()
    {
        $this->addressApi = new AddressioApi();
    }

    public function lookupPostcode(Request $request)
    {
        $request->validate([
            'postcode' => ['required'],
        ]);

        $response = $this->addressApi->find(Request('postcode'));

        return json_encode([
            'data' => $response,
        ]);
    }
}
