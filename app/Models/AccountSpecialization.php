<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSpecialization extends Model
{
    use HasFactory;

    public $table = 'account_specialization';

    protected $fillable = ['account_id', 'specialization_id'];
}
