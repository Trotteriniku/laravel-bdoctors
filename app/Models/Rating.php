<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['value'];

    public function accounts()
    {
        return $this->belongsToMany(Account::class);
    }
}
