<?php
namespace AdminUI\AdminUIAddress\Classes;

/**
 * Helper Class to help with distances
 */
class Distance
{
    private $lat;

    private $lng;

    public function __construct($lat, $lng) {
        $this->lat = $lat ?? config('adminuiaddress.lat');
        $this->lng = $lng ?? config('adminuiaddress.lng');
    }

    /**
     * Distance calculation
     *
     * @param array $to - array conatining lng and lat
     * @param array $from - array containing lng and lat or fallback to .env
     * @param string $unit - Measurement Unit - km - Kilometers, nm - Nautical Miles, m - miles
     * @return float $distance - measurement result
     */
    public function between($to, $unit = 'm')
    {
        // pull the variables for ease
        $lngTo   = $to['lng'];
        $latTo   = $to['lat'];

        // if location is same as start point return 0
        if ($lngTo == $this->lng && $latTo == $this->lat) {
            return 0;
        } else {
            // do the calculation
            $theta = $lngTo - $this->lng;

            $dist = sin(deg2rad($latTo)) * sin(deg2rad($this->lat))
                + cos(deg2rad($latTo)) * cos(deg2rad($this->lat))
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
