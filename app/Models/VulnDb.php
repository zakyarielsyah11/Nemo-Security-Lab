<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VulnDb extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'severity',
        'category',
        'remediation',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}