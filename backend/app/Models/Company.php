<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function entry() {
        return $this->hasOne(Entry::class);
    }

    public function getCompanyId($company_name)
    {
       $company = $this->where('name', $company_name)->first();
       if(!$company) $company = $this->create(['name' => $company_name]);
       return $company->id;
    }
}
