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
        $getData = \DB::connection('portal-itsa')->table('departments')->get();
        return $getData;
    }

    public function requestDars()
    {
        return $this->hasMany(Requestdar::class, 'dept_id');
    }
    public function distributionDarDepts()
    {
        return $this->hasMany(DistributionDarDepts::class, 'dept_id');
    }
}
