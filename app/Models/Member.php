<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'anggota';

    protected $dates = [
        'tanggal_lahir',
    ];

    /**
     * Get the saving record associated with the member.
     */
    public function balance()
    {
        return $this->hasOne('App\Models\Saving', 'anggota_id');
    }
}
