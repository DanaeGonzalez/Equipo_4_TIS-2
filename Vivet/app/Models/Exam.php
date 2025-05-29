<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $hidden = [
        'id',
    ];

    protected $fillable = [
        'exam_file',
        'sender_id',
        'recipient_id',
        'timestamps'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
