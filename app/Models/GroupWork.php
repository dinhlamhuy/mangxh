<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupWork extends Model
{
    use HasFactory;
    protected $table = 'group_work';
    protected $primaryKey = 'gw_id';
    protected $fillable = [
        'gw_tieude',
        'gw_noidung',
        'gw_hannop',
        'gw_file',
        'gw_typefile',
        'group_id',
        'nguoitao_id',
        'created_at',
        'updated_at'
                
    ]; 
    public $timestamps = true;
}
