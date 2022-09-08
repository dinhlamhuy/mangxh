<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilePost extends Model
{
    use HasFactory;
    protected $table = 'file_post';
    // protected $primaryKey = 'post_id';
    protected $fillable = [
        'img_name',
        'img_type',
        'post_id',
        // 'created_at',
        // 'updated_at',
    ];
    public function posts()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }
}
