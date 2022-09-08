<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baocaovipham extends Model
{
    use HasFactory;
    protected $table = 'baocaovipham';
    protected $primaryKey = 'bcvp_id';
    protected $fillable = [
        'bcvp_tieude',
        'bcvp_noidung',
        'user_tocao',
        'user_id',
        'group_id',
        'school_id',
        'created_at',
        'updated_at',
        'bcvp_catory',

    ];
}
