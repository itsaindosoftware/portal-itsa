<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Schema;
class DistributionDarDepts extends Model
{
    use HasFactory;
    protected $table = 'distribution_dar_depts';

    protected $fillable = [
        'dept_id',
        'reqdar_id',
        'master_docs_id',
        'effective_date',
        'created_at',
        'updated_at',
        'current_status',
        'last_action_date'
    ];

    protected $casts = [
        'effective_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function requestDar()
    {
        return $this->belongsTo(Requestdar::class, 'reqdar_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
    public function masterDocument()
    {
        return $this->belongsTo(MasterDocs::class, 'master_docs_id');
    }

    public function controlLogs()
    {
        return $this->hasMany(DocumentControlLog::class, 'distribution_id');
    }

    public function latestControlLog()
    {
        return $this->hasOne(DocumentControlLog::class, 'distribution_id')->latest();
    }
    public function isOverdue($days = 7)
    {
        if (!$this->last_action_date)
            return false;

        return $this->last_action_date->addDays($days) < now() &&
            in_array($this->current_status, ['distributed', 'pending']);
    }
}
