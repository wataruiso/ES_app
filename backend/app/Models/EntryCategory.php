<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getEntryCategoryId($category_name)
    {
       $category = $this->where('name', $category_name)->first();
       return $category ? $category->id : $this->where('name', 'その他')->first()->id;
    }
}
