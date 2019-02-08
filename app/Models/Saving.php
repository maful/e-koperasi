<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    protected $table = 'tabungan';

    /**
     * Get the member that owns the saving.
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'anggota_id');
    }
}
