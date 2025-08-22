<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentControlLog extends Model
{
    use HasFactory;

    protected $table = 'document_control_logs';

    protected $fillable = [
        'distribution_id',
        'request_dar_id',
        'dept_id',
        'action_type',
        'action_date',
        'receiver_name',
        'receiver_signature',
        'position',
        'return_receiver',
        'return_date',
        'remarks',
        'created_by',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'action_date' => 'date',
        'return_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function distribution()
    {
        return $this->belongsTo(DistributionDarDepts::class, 'distribution_id');
    }

    public function requestDar()
    {
        return $this->belongsTo(RequestDar::class, 'request_dar_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // public function department()
    // {
    //     return $this->belongsTo(Department::class, 'dept_id');
    // }
}
