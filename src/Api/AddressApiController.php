<?php
namespace AdminUI\AdminUIAddress\Api;

use App\Http\Controllers\Controller;
use AdminUI\AdminUIAddress\Helpers\Address;

/**
 * A api request to return via php from GetAddress.io
 */
class AddressApiController extends Controller
{
    /**
     * Lookup results on postocde
     *
     * @return result an expanded result from getaddress.io
     */
    public function lookup()
    {
        // strip any spaces from postcode
        $postcode = str_replace(' ', '', request('postcode'));

        // do api request and cache the results
        $response = cache()->remember('address'.$postcode, '604800', function() use ($postcode) {
            $address = new Address();
            return $address->find($postcode, false, true);
        });

        // return the response
        return response()->json($response);
    }
}
