<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Manager extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nationality',
        'birth_date',
        'experience_years',
        'license_type',
        'contact_email',
        'contact_phone',
        'club_id',
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($manager) {
            $manager->api_token = Str::random(5);
        });
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}