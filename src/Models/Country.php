<?php
namespace AdminUI\AdminUIAddress\Models;

Use App\Model;

class Country extends Model
{
    public function scopeOptions()
    {
        return ['' => 'Choose country'] + $this->pluck('name', 'id')->toArray();
    }
}
