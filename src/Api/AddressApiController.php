<?php

namespace AdminUI\AdminUIAddress\Api;

use Address;
use Distance;
use App\Http\Controllers\Controller;
use AdminUI\AdminUIAddress\Resources\AddressApiResource;
use AdminUI\AdminUIAddress\Models\State;

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
        cache()->clear();
        $response = cache()->remember(
            'address' . $postcode,
            config('adminuiaddress.cacheTime'),
            function () use ($postcode) {
                return json_decode(json_encode(Address::find($postcode, false, true)));
            }
        );

        // return the response
        $addresses = collect($response->addresses ?? (object)[]);
        return AddressApiResource::collection($addresses)
            ->additional([
                'meta' => [
                    'postcode'  => $postcode,
                    'longitude' => $response->longitude ?? 0,
                    'latitude'  => $response->latitude ?? 0,
                    'results'   => $addresses->count(),
                    'distance'  => round(Distance::between([
                        'lat' => $response->latitude ?? 0,
                        'lng' => $response->logitude ?? 0
                    ]), 2)
                ]
            ]);
    }
}
