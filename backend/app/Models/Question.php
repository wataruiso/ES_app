<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Question extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    use Sortable;
    public $sortable = ['name', 'word_count', 'updated_at'];
    public $sortableAs = ['company_name'];

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }

    public function getConcatenated()
    {
        return "{$this->name}-{$this->word_count}";
    }

    public function companyNameSortable($query, $direction)
    {
        return $query->orderBy('company_name', $direction);
                  
    }

}
