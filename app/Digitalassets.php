<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Digitalassets extends Model
{
    use HasFactory;
    protected $table = 'registration_fixed_assets';
    // protected $connection = 'portal_itsa';
    protected $fillable = [
        'date',
        'rfa_number',
        'requestor_name',
        'receved_date',
        'issue_fixed_asset_no',
        'production_code',
        'product_name',
        'grn_no',
        'user_id',
        'department_id',
        'company_id',
        'asset_group_id',
        'asset_location_id',
        'asset_cost_center_id',
        'remark',
        'status',
        'io_no'

    ];

}
