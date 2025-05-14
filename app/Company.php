<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companys';

    protected $fillable = [
       'company_desc'
   ];
   public function getCompany()
   {
       $getData = \DB::connection('dar-system')->table('companys')->get();
       return $getData;
   }
}
