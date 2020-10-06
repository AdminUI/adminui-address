<?php
namespace AdminUI\AdminUIAddress\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function scopeOptions()
    {
        return ['' => 'Choose country'] + $this->pluck('name', 'id')->toArray();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
