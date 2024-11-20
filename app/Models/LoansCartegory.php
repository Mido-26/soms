<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoansCartegory extends Model
{
    protected $fillable = [
        'loanName',
        'minAmount',
        'maxAmount',
        'interest',
        'dueDatedays'
    ];

    public function loans(){
       return $this->hasMany('loans');
    }
}
