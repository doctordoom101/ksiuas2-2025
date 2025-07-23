<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}

