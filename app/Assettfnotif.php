<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assettfnotif extends Model
{
    use HasFactory;

    protected $table = 'asset_tf_notif';
    protected $fillable = [
        'reg_fixed_asset_id',
        'from_qty',
        'from_date_of_tf',
        'from_io_no',
        'to_receiving_dept_id',
        'to_cost_center_id',
        'to_location_id',
        'to_qty',
        'to_pic_name',
        'to_effective_date',
        'to_tf_fer_no_erp',
        'created_by',
        'created_at',
        'pic_support',
        'approval_by1',
        'approval_date1',
        'approval_status1',
        'remark_by1',
        'approval_by2',
        'approval_date2',
        'approval_status2',
        'remark_by2',
        'approval_by3',
        'approval_date3',
        'approval_status3',
        'remark_by3',
        'approval_by4',
        'approval_date4',
        'approval_status4',
        'remark_by4',
        'approval_by5',
        'approval_date5',
        'approval_status5',
        'remark_by5',
        'approval_by6',
        'approval_date6',
        'approval_status6',
        'remark_by6'
    ];
}
