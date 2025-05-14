<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typereqform extends Model
{
    use HasFactory;

    protected $table = 'type_of_reqforms';

    protected $fillable = [
       'request_type'
   ];
}
