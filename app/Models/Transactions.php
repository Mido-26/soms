<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transactions extends Model
{
        use HasFactory;
    
        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = ['amount', 'description', 'user_id', 'type'];

    
        /**
         * Get the parent transactable model (Savings or Loan).
         */
        
         public function user()
         {
            return $this->belongsTo(User::class);
         }
}
