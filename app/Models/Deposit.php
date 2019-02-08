<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'setoran';

    /**
     * Get the member that owns the deposit.
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'anggota_id');
    }
}
