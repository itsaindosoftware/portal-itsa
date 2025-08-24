<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
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
        'prepared_by',
        'prepared_date',
        'approved_by',
        'approved_date',
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
    public static function logActivity($distributionId, array $data)
    {
        // dd($data);
        try {
            // Get current authenticated user
            $currentUser = Auth::user();

            // Prepare log data
            $logData = [
                'distribution_id' => $distributionId,
                'request_dar_id' => $data['request_dar_id'] ?? null,
                'dept_id' => $data['dept_id'] ?? null,
                'action_type' => $data['action_type'] ?? null,
                'action_date' => $data['action_date'] ?? now(),
                'receiver_name' => $data['receiver_name'] ?? null,
                'receiver_signature' => $data['receiver_signature'] ?? null,
                'position' => $data['position'] ?? null,
                // 'return_receiver' => $data['return_receiver'] ?? null,
                // 'return_date' => $data['return_date'] ?? null,
                'remarks' => $data['remarks'] ?? null,
                'created_by' => $currentUser->name ? $currentUser->id : null,
                'created_at' => now(),
                'updated_at' => now()
            ];

            // Create the log entry
            $log = self::create($logData);

            // Update distribution status based on action type
            self::updateDistributionStatus($distributionId, $data['action_type']);

            return $log;

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error in DocumentControlLog::logActivity: ' . $e->getMessage(), [
                'distribution_id' => $distributionId,
                'data' => $data,
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }
    private static function updateDistributionStatus($distributionId, $actionType)
    {
        try {
            $statusMap = [
                'distributed' => 'distributed',
                'received' => 'received',
                'returned' => 'returned',
                'pending' => 'pending'
            ];

            $newStatus = $statusMap[$actionType] ?? null;
            // dd($distributionId);
            if ($newStatus) {
                // Update the distribution status
                DB::connection('portal-itsa')
                    ->table('distribution_dar_depts')
                    ->where('id', $distributionId)
                    ->update([
                        'current_status' => $newStatus,
                        'last_action_date' => now(),
                        'updated_at' => now()
                    ]);
            }

        } catch (\Exception $e) {
            \Log::error('Error updating distribution status: ' . $e->getMessage(), [
                'distribution_id' => $distributionId,
                'action_type' => $actionType
            ]);
        }
    }
    public static function getActivityHistory($distributionId)
    {
        return self::with(['creator:id,name'])
            ->where('distribution_id', $distributionId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public static function getLatestActivity($distributionId)
    {
        return self::with(['creator:id,name'])
            ->where('distribution_id', $distributionId)
            ->orderBy('created_at', 'desc')
            ->first();
    }
    public static function getActivitySummary($distributionId)
    {
        $activities = self::where('distribution_id', $distributionId)
            ->selectRaw('action_type, COUNT(*) as count, MAX(action_date) as latest_date')
            ->groupBy('action_type')
            ->get();

        $summary = [];
        foreach ($activities as $activity) {
            $summary[$activity->action_type] = [
                'count' => $activity->count,
                'latest_date' => $activity->latest_date
            ];
        }

        return $summary;
    }
    public function scopeByActionType($query, $actionType)
    {
        return $query->where('action_type', $actionType);
    }

    /**
     * Scope for filtering by date range
     */
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('action_date', [$startDate, $endDate]);
    }

    /**
     * Scope for filtering by department
     */
    public function scopeByDepartment($query, $deptId)
    {
        return $query->where('dept_id', $deptId);
    }
    public function getFormattedActionTypeAttribute()
    {
        $actionTypes = [
            'pending' => 'Menunggu',
            'distributed' => 'Didistribusi',
            'received' => 'Diterima',
            'returned' => 'Dikembalikan',
            'overdue' => 'Terlambat'
        ];

        return $actionTypes[$this->action_type] ?? ucfirst($this->action_type);
    }
    public function getFormattedActionDateAttribute()
    {
        return $this->action_date ? $this->action_date->format('d/m/Y H:i') : '-';
    }
     public function hasSignature()
    {
        return !empty($this->receiver_signature);
    }
    public function isReturnAction()
    {
        return $this->action_type === 'returned';
    }
    public function isReceiveAction()
    {
        return $this->action_type === 'received';
    }
    // public function department()
    // {
    //     return $this->belongsTo(Department::class, 'dept_id');
    // }
}
