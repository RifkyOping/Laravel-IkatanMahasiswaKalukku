<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'email',
        'phone',
        'instagram',
        'facebook',
        'whatsapp',
        'youtube',
        'show_address',
        'show_email',
        'show_phone',
        'show_instagram',
        'show_facebook',
        'show_whatsapp',
        'show_youtube',
        'org_period',
        'is_registration_open',
        'ketua_photo',
        'sekretaris_photo',
        'bendahara_photo',
        'ketua_name',
        'sekretaris_name',
        'bendahara_name',
        'whatsapp_group_link',
    ];

    protected $casts = [
        'show_address' => 'boolean',
        'show_email' => 'boolean',
        'show_phone' => 'boolean',
        'show_instagram' => 'boolean',
        'show_facebook' => 'boolean',
        'show_whatsapp' => 'boolean',
        'show_youtube' => 'boolean',
        'is_registration_open' => 'boolean',
    ];
}
