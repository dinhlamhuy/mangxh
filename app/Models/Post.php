<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $primaryKey = 'post_id';
    protected $fillable = [
        'caption',
        'post_choduyet',
        'status',
        'user_id',
        'group_id',
        'school_id',
        'type_post',
        'category_post',
        'sharepost_id',
        // 'created_at',
        // 'updated_at',
    ]; 
    public function file_post()
    {
        return $this->hasMany('App\Models\FilePost','post_id');
    }
    public function emoticons()
    {
        return $this->hasMany('App\Models\Emoticon','post_id');
    }

}
