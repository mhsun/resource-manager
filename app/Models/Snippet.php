<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = htmlentities($value, ENT_QUOTES);
    }

    public function getCodeAttribute($value)
    {
        return html_entity_decode($value, ENT_QUOTES);
    }
}
