<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicebe extends Model
{
    use HasFactory;
    protected $table = 'service';

    protected $fillable = [
        'title',
        'description'
    ];

    public $timestamps = false;
}
