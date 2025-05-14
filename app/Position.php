<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';

    protected $fillable = [
       'position_desc'
   ];

   public function getPosition()
   {
       $getData = \DB::connection('dar-system')->table('positions')->get();
       return $getData;
   }
}
