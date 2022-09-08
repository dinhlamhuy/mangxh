<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baocaopost extends Model
{
    use HasFactory;
    protected $table = 'baocaopost';
    protected $primaryKey = 'rp_id';
    protected $fillable = [
        'rp_tieude',
        'rp_noidung',
        'user_tocao',
        'post_id',
        'created_at',
        'updated_at',
    ];
}
