<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'group';
    protected $primaryKey = 'group_id';
    protected $fillable = [
        'group_name',
        'group_founder',
        'group_privacy',
        'group_imgbg'
                
    ]; 
    public $timestamps = true;
    // public $incrementing = false;
}
