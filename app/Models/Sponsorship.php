<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Sponsorship extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function accounts()
    {
        return $this->belongsToMany(Account::class);
    }
}
