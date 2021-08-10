<?php

namespace AdminUI\AdminUIAddress\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'line_1'           => $this->line_1,
            'line_2'           => $this->line_2,
            'town_or_city'     => $this->town_or_city,
            'county'           => $this->county,
            'country'          => $this->country,
            'formatted_string' => implode(',', array_filter($this->formatted_address))
        ];
    }
}
