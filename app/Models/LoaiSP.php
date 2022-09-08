<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiSP extends Model
{
    use HasFactory;
    protected $table = 'loaisanpham';
    protected $primaryKey = 'pl_id';
    protected $fillable = [
        'pl_ten',
        'pl_icon',
        'pl_tag',
        'created_at',
        'updated_at',
    ];
}

