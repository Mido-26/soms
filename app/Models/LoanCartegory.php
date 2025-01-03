<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loancartegory extends Model
{
    use HasFactory;
    protected $fillable = [
        'loanName',
        'minAmount',
        'maxAmount',
        'interest',
        'dueDatedays'
    ];

    public function loans(){
       return $this->hasMany(Loans::class);
    }
}
