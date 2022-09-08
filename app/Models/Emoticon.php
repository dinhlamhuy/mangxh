<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emoticon extends Model
{
    use HasFactory;
    protected $table = 'emoticons';
    protected $primaryKey = 'post_id';
    protected $fillable = [
        'emoticons_symbol',
        'emoticons_name',
        'user_id',
        'post_id',
        
    ];
    public function posts()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }
}
