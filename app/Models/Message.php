<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'name', 'email', 'account_id', 'content', 'created_at'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
