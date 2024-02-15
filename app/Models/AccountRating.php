<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountRating extends Model
{
    use HasFactory;
    public $table = 'account_rating';
    protected $guarded = [];
}
