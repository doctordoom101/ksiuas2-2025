<?php

namespace App\Models;

use App\Helper\EncryptionHelper;
use Illuminate\Database\Eloquent\Model;

class EncryptedData extends Model
{
    protected $fillable = [
        'encrypted_data',
        'decryption_key',
        'decrypted_data',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            // Decrypt before insert
            $model->decrypted_data = EncryptionHelper::decrypt($model->encrypted_data);
        });
    }
}
