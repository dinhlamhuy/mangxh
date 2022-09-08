<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schools extends Model
{
    use HasFactory;
    protected $table = 'school';
    protected $primaryKey = 'school_id';
    protected $fillable = [
        'school_name',
        'school_category',
        'school_address',
        'school_phone',
        'school_email',
        'school_link',
        'school_about',
        'userql',
        'school_avatar',
        'school_background',
        'school_status',
        'created_at',
        'updated_at',
                
    ]; 
    public $timestamps = true;
}
