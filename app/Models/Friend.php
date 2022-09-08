<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;
    protected $table = 'friend';
    protected $primaryKey = ['user_from','user_to'];
    protected $fillable = [
        'f_ghichu',
        'f_trangthai'
                
    ]; 
    public $timestamps = true;
    public $incrementing = false;
}
