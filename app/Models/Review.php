<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['account_id', 'name', 'content', 'title', 'email'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
