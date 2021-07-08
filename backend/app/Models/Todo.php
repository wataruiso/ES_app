<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Todo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    use Sortable;
    public $sortable = ['id', 'title', 'is_done', 'deadline', 'created_at', 'updated_at'];

}
