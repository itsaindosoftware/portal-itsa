<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsbe extends Model
{
    use HasFactory;
    protected $table = 'news';

    protected $fillable = [
        'title',
        'description',
        'pic'
    ];

    public $timestamps = false;
}
