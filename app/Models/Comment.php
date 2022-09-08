<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $primaryKey = 'cmt_id';
    protected $fillable = [
        'cmt_hinhanh',
        'cmt_noidung',
        'cmt_reply',
        'user_id',
        'post_id',
        
    ];
    // public function posts()
    // {
    //     return $this->belongsTo('App\Models\Post', 'post_id');
    // }
}