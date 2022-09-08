<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $primaryKey = 'ad_ma';
    protected $fillable = [
        'ad_account',
        'ad_password',
        'ad_avatar',
        'created_at',
        'updated_at',
    ];
}
