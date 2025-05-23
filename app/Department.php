<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = [
        'description'
    ];
    public function getDepartment()
    {
        $getData = \DB::connection('portal-tsa')->table('departments')->get();
        return $getData;
    }
}
