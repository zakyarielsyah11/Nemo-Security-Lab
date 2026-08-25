<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tool',
        'target',
        'output',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}