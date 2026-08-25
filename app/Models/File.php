<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_name',
        'stored_name',
        'mime_type',
        'file_size',
        'path',
        'uploaded_by',
        'description',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function isTextFile()
    {
        $textExtensions = ['txt', 'log', 'csv', 'json', 'xml', 'md', 'ini', 'conf', 'yaml', 'yml', 'php', 'env'];
        $extension = pathinfo($this->original_name, PATHINFO_EXTENSION);
        return in_array(strtolower($extension), $textExtensions);
    }
}