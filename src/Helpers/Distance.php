<?php
namespace AdminUI\AdminUIAddress\Helpers;

/**
 * Helper Class to help with distances
 */
class Distance
{
    /**
     * DIstance calculation
     *
     * @param array $to - array conatining lng and lat
     * @param array $from - array containing lng and lat or fallback to .env
     * @param string $unit - Measurement Unit - km - Kilometers, nm - Nautical Miles, m - miles
     * @return float $distance - measurement result
     */
    public static function between($to, $from = false, $unit = 'm')
    {
        // pull the variables for ease
        $lngTo   = $to['lng'];
        $lngFrom = $from['lng'] ?? env('LNG', 0);
        $latTo   = $to['lat'];
        $latFrom = $from['lat'] ?? env('LAT', 0);

        // if location is same as start point return 0
        if ($lngTo == $lngFrom && $latTo == $latFrom) {
            return 0;
        } else {
            // do the calculation
            $theta = $lngTo - $lngFrom;

            $dist = sin(deg2rad($latTo)) * sin(deg2rad($latFrom))
                + cos(deg2rad($latTo)) * cos(deg2rad($latFrom))
                * cos(deg2rad($theta));

            $dist  = acos($dist);
            $dist  = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit  = strtoupper($unit);

            // return the distance in unit requested
            if ($unit == "KM") {
                return ($miles * 1.609344);
            } else if ($unit == "NM") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
}
