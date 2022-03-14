<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateQuestion extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function template()
    {
        return $this->hasOne(Template::class);
    }
}
