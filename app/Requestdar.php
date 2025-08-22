<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Requestdar extends Model
{
    use HasFactory;

    protected $table = 'request_dar';
    public $timestamps = false;
    protected $fillable = [
        'number_dar',
        'nik_req',
        'nik_atasan',
        'dept_id',
        'company_id',
        'position_id',
        'typereqform_id',
        'user_id',
        'name_doc',
        'no_doc',
        'qty_pages',
        'created_by',
        'created_date',
        'file_doc',
        // 'storage_type',
        'rev_no_before',
        'rev_no_after',
        'approval_by1',
        'approval_date1',
        'approval_status1',
        'remark_approval_by1',
        'approval_by2',
        'approval_date2',
        'approval_status2',
        'remark_approval_by2',
        'approval_by3',
        'approval_date3',
        'approval_status3',
        'remark_approval_by3',
        'updated_by_1',
        'updated_bydate_1',
        'updated_by_2',
        'updated_bydate_2',
        'status'
    ];

    public static function generateDocumentNumber()
    {
        $now = Carbon::now();
        $month = $now->format('m');
        $year = $now->format('Y');

        // Cari nomor dokumen terakhir untuk bulan ini
        $lastDocument = Requestdar::whereYear('created_date', $year)
            ->whereMonth('created_date', $month)
            ->orderBy('id', 'desc')
            ->first();

        //    dd($lastDocument);

        if (!$lastDocument) {
            $nextNumber = 1;
        } else {
            // Ekstrak nomor dari format MM/NNN
            $parts = explode('/', $lastDocument->number_dar);
            $nextNumber = intval($parts[1]) + 1;
        }
        $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Gabungkan bulan dan nomor urut
        return $month . '/' . $formattedNumber;
    }
    public function distributions()
    {
        return $this->hasMany(DistributionDarDepts::class, 'request_dar_id');
    }

    public function controlLogs()
    {
        return $this->hasMany(DocumentControlLog::class, 'request_dar_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'dept_id');
    }
    public function typeDocs()
    {
        return $this->belongsTo(Typereqform::class, 'typereqform_id');
    }

}
