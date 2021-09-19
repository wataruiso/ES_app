<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function templates()
    {
        return $this->hasMany(Template::class);
    }
}
