<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankInterest extends Model
{
    protected $table = 'bunga_tabungan';

    /**
     * Get the member that owns the deposit.
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'anggota_id');
    }
}
