<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'short_name', 'city', 'country', 'founded_year',
        'owner_name', 'contact_email', 'contact_phone',
        'stadium_name', 'stadium_address'
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($club) {
            $club->api_token = Str::random(5);
        });
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
