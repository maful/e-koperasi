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

    /**
     * Get the deposits for the member.
     */
    public function deposits()
    {
        return $this->hasMany('App\Models\Deposit', 'anggota_id');
    }

    /**
     * Get the withdrawals for the member.
     */
    public function withdrawals()
    {
        return $this->hasMany('App\Models\Withdrawal', 'anggota_id');
    }

    /**
     * Get the savings history for the member.
     */
    public function savings_history()
    {
        return $this->hasMany('App\Models\SavingHistory', 'anggota_id');
    }

    /**
     * Get the bank interest for the member.
     */
    public function bank_interests()
    {
        return $this->hasMany('App\Models\BankInterest', 'anggota_id');
    }
}
