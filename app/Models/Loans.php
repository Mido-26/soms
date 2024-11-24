<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loans extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'duration_in_days',
        'principal_amount',
        'amount',
        'interest_rate',
        'status',
        'user_id',
        'loansCategory_id',
        'description'
    ];

    public function loanscartegory(){
        return $this->belongsTo(LoansCartegory::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
