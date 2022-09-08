<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    protected $primaryKey = 'sp_id';
    protected $fillable = [
        'sp_ten',
        'sp_gia',
        'sp_mota',
        'sp_soluong',
        'sp_tinhtrang',
        'sp_diachi',
        'sp_sdt',
        'nguoiban',
        'phanloai',
        'created_at',
        'updated_at',
    ];
}
