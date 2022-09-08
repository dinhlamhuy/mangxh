<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submissions extends Model
{
    use HasFactory;
    protected $table = 'submissions';
    protected $primaryKey = 'sm_id';
    protected $fillable = [
        'sm_noidung',
        'sm_ngaynop',
        'sm_file',
        'sm_typefile',
        'gw_id',
        'sm_diem',
        'group_id',
        'nguoinop_id'
                
    ]; 
    public $timestamps = true;
}
