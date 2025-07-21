<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'position', 'nationality', 'birth_date', 'birth_place',
        'passport_number', 'salary', 'contract_start', 'contract_end',
        'medical_record', 'agent_name', 'contact_email', 'contact_phone',
        'club_id',
    ];

    protected static function boot() {
        parent::boot();

        static::creating(function ($player) {
            $player->api_token = Str::random(5);
        });
    }
    
    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
