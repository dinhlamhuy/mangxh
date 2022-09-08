<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;
    protected $table = 'group_members';
    protected $primaryKey = 'id';
    protected $fillable = [
        'group_id',
        'group_status',
        'user_id',
                
    ]; 
    // public $timestamps = true;
    // public $incrementing = false;
}
