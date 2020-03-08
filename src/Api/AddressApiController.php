<?php
namespace AdminUI\AdminUIAddress\Api;

use App\Http\Controllers\Controller;
/**
 * A api request to return via php from GetAddress.io
 * Ensure to include the .env file
 * GETADDRESS_API_KEY=dksiAXAn00mJYTfjyCKFNA16164
 * GETADDRESS_ADMIN_KEY=sZ3yX699Q0qI_UkZI-PVXg16164
 *
 * LNG=-1.9181377
 * LAT=50.8115552
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
        $postcode = str_replace(' ', '', request('postcode'));

        $results = cache()->remember('address.'.$postcode, '604800', function () use ($postcode) {
            return get_address()->expand()->find($postcode);
        });
        return response()->json($results->respond());
    }
}
