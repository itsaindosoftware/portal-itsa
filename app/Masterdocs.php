<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masterdocs extends Model
{
    use HasFactory;
    protected $table = 'master_documents';

    protected $fillable = [
        'title',
        'description',
        'file',
        'type_doc'
    ];
}
