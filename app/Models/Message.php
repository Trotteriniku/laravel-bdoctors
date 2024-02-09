<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'name', 'email', 'accout_id', 'content'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
