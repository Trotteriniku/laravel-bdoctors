<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSponsorship extends Model
{
    use HasFactory;

    public $table = 'account_sponsorship';

    protected $fillable = ['account_id', 'sponsorship_id', 'start_date', 'end_date'];
}
