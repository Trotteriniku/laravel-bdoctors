<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;
use App\Models\Review;
use App\Models\User;
use App\Models\Sponsorship;
use App\Models\Rating;
use App\Models\Specialization;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Account extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;

    protected $fillable = ['cv', 'image', 'user_id', 'phone', 'address', 'performances', 'visible'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class)->withPivot('start_date', 'end_date');
    }
    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'account_specialization');
    }
    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'account_specialization');
    }
    public function ratings()
    {
        return $this->belongsToMany(Rating::class);
    }
}
