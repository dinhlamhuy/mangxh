<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgSanPham extends Model
{
    use HasFactory;
    protected $table = 'imgsanpham';
    protected $primaryKey = 'imgsp_id';
    protected $fillable = [
        'imgsp_ten',
        'sp_id',
        'created_at',
        'updated_at',
    ];
}
