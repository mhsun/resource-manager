<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    public function getFormattedPathAttribute()
    {
        return public_path("storage/{$this->attributes['path']}");
    }

    public function unlink()
    {
        unlink(storage_path("app/public/{$this->path}"));
    }
}
