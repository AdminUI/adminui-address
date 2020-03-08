<?php
namespace AdminUI\AdminUIAddress\Helpers;

/**
 * Helper Class to help with distances
 */
class Distance
{

    public static function between($to, $from = false, $unit = 'm')
    {
        $lngTo   = $to['lng'];
        $lngFrom = $from['lng'] ?? env('LNG', 0);
        $latTo   = $to['lat'];
        $latFrom = $from['lat'] ?? env('LAT', 0);

        if ($lngTo == $lngFrom && $latTo == $latFrom) {
            return 0;
        } else {
            $theta = $lngTo - $lngFrom;

            $dist = sin(deg2rad($latTo)) * sin(deg2rad($latFrom))
                + cos(deg2rad($latTo)) * cos(deg2rad($latFrom))
                * cos(deg2rad($theta));

            $dist  = acos($dist);
            $dist  = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit  = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
}
