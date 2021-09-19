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

    public function getQuestionCategory($category_name)
    {
        return $this->where('name', $category_name)->first();
    }

    public function getQuestionCategoryId($category_name)
    {
        $question_category = $this->getQuestionCategory($category_name);
        return $question_category
        ? $question_category->id 
        : $this->where('name', 'その他')->first()->id;
    }

}
