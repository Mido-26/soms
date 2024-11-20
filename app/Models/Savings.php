<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Savings extends Model
{
    
    use HasFactory;

    // Define the fillable properties
    protected $fillable = [
        'account_balance',
        'interest_earned',
        'last_deposit_date',
        'user_id',
    ];

    /**
     * Get the user that owns the savings.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
{
    return $this->morphMany(Transactions::class, 'transactable');
}

}
