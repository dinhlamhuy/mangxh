<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MessageGroup;
use App\Models\Message;

class UserMessage extends Model
{
    use HasFactory;
    public function message(){
        return $this->belongsTo(Message::class);
    }

    public function message_group(){
        return $this->belongsTo(MessageGroup::class);
    }
}
