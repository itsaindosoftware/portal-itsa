<?php

// DocControltrackController.php - Updated
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\FileBag;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Masterdocs;
use App\Department;
use App\Typereqform;
use App\Requestdar;
use App\DistributionDarDepts;
use App\DocumentControlLog;

class DocControltrackController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $statusOptions = [
            'pending' => 'Pending',
            'distributed' => 'Distributed',
            'received' => 'Received',
            'returned' => 'Returned',
            'overdue' => 'Overdue'
        ];

        return view('doccontroltrack.index', compact('departments', 'statusOptions'));
    }

    // public function getData(Request $request)
    // {
    //     $query = DistributionDarDepts::with([
    //         'requestDar:id,name_doc,number_dar',
    //         'department:id,description',
    //         'latestControlLog:id,distribution_id,action_type,action_date,receiver_name'
    //     ]);

    //     // Filter by department
    //     if ($request->dept_id) {
    //         $query->where('dept_id', $request->dept_id);
    //     }

    //     // Filter by status
    //     if ($request->status) {
    //         $query->where('current_status', $request->status);
    //     }

    //     // Filter by date range
    //     if ($request->start_date && $request->end_date) {
    //         $query->whereBetween('effective_date', [$request->start_date, $request->end_date]);
    //     }
    //     $query = $query->groupBy('master_docs_id');
    //     // $query->groupBy('master_docs_id');

    //     return DataTables::of($query)
    //         ->addIndexColumn()
    //         ->addColumn('document_info', function ($row) {
    //             return '
    //                 <div>
    //                     <strong>' . ($row->requestDar->name_doc ?? '-') . '</strong><br>
    //                     <small class="text-muted">No: ' . ($row->requestDar->number_dar ?? '-') . '</small>
    //                 </div>
    //             ';
    //         })
    //         ->addColumn('department_name', function ($row) {
    //             return $row->department->name ?? '-';
    //         })
    //         ->addColumn('status_badge', function ($row) {
    //             $statusClass = [
    //                 'pending' => 'secondary',
    //                 'distributed' => 'info',
    //                 'received' => 'success',
    //                 'returned' => 'primary',
    //                 'overdue' => 'danger'
    //             ];

    //             $statusText = [
    //                 'pending' => 'Menunggu',
    //                 'distributed' => 'Didistribusi',
    //                 'received' => 'Diterima',
    //                 'returned' => 'Dikembalikan',
    //                 'overdue' => 'Terlambat'
    //             ];

    //             $class = $statusClass[$row->current_status] ?? 'secondary';
    //             $text = $statusText[$row->current_status] ?? $row->current_status;

    //             return '<span class="badge badge-' . $class . '">' . $text . '</span>';
    //         })
    //         ->addColumn('last_activity', function ($row) {
    //             if ($row->latestControlLog) {
    //                 return '
    //                     <div>
    //                         <small>' . ucfirst($row->latestControlLog->action_type) . '</small><br>
    //                         <small class="text-muted">' .
    //                     Carbon::parse($row->latestControlLog->action_date)->format('d/m/Y') .
    //                     '</small>
    //                     </div>
    //                 ';
    //             }
    //             return '<span class="text-muted">Belum ada aktivitas</span>';
    //         })
    //         ->addColumn('days_since', function ($row) {
    //             if ($row->last_action_date) {
    //                 $days = Carbon::parse($row->last_action_date)->diffInDays(now());
    //                 $color = $days > 7 ? 'text-danger' : ($days > 3 ? 'text-warning' : 'text-success');
    //                 return '<span class="' . $color . '">' . $days . ' hari</span>';
    //             }
    //             return '<span class="text-muted">-</span>';
    //         })
    //         ->addColumn('actions', function ($row) {
    //             $actions = '<div class="btn-group" role="group">';

    //             // View Detail Button
    //             $actions .= '<button type="button" class="btn btn-sm btn-info" onclick="viewDetail(' . $row->id . ')" title="Lihat Detail">
    //                 <i class="fas fa-eye"></i>
    //             </button>';

    //             // Action buttons based on status
    //             if ($row->current_status == 'distributed') {
    //                 $actions .= '<button type="button" class="btn btn-sm btn-success" onclick="markReceived(' . $row->id . ')" title="Tandai Diterima">
    //                     <i class="fas fa-check"></i>
    //                 </button>';
    //             }

    //             if ($row->current_status == 'received') {
    //                 $actions .= '<button type="button" class="btn btn-sm btn-primary" onclick="markReturned(' . $row->id . ')" title="Tandai Dikembalikan">
    //                     <i class="fas fa-undo"></i>
    //                 </button>';
    //             }

    //             // History Button
    //             $actions .= '<button type="button" class="btn btn-sm btn-warning" onclick="viewHistory(' . $row->id . ')" title="Lihat Riwayat">
    //                 <i class="fas fa-history"></i>
    //             </button>';

    //             $actions .= '</div>';

    //             return $actions;
    //         })
    //         ->rawColumns(['document_info', 'status_badge', 'last_activity', 'days_since', 'actions'])
    //         ->make(true);
    // }



    public function getData(Request $request)
    {
        $query = DB::connection('portal-itsa')->table('distribution_dar_depts as ddd')
            ->select(
                'ddd.id',
                'ddd.master_docs_id',
                'ddd.dept_id',
                'ddd.current_status',
                'ddd.effective_date',
                'ddd.last_action_date',
                'rd.name_doc',
                'rd.number_dar',
                'md.title',
                'dept.description as department_name',
                'log.action_type',
                'log.action_date',
                'log.receiver_name'
            )
            ->leftJoin('request_dar as rd', 'rd.id', '=', 'ddd.reqdar_id')
            ->leftJoin('departments as dept', 'dept.id', '=', 'ddd.dept_id')
            ->leftJoin('document_control_logs as log', function ($join) {
                $join->on('log.distribution_id', '=', 'ddd.id')
                    ->whereRaw('log.id = (SELECT MAX(id) FROM document_control_logs WHERE distribution_id = ddd.id)');
            })
            ->leftJoin('master_documents as md', 'md.id', '=', 'ddd.master_docs_id');
            // ->where('ddd.dept_id', Auth::user()->dept_id)->get();

            // dd($query);


        // Filter by department
        if ($request->dept_id) {
            $query->where('ddd.dept_id', $request->dept_id);
        }

        // Filter by status
        if ($request->status) {
            $query->where('ddd.current_status', $request->status);
        }

        // Filter by date range
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('ddd.effective_date', [$request->start_date, $request->end_date]);
        }
        if (Auth::user()->hasRole('manager')) {
            // dd('masuk');
            $query->where('ddd.dept_id', Auth::user()->department_id);
        }
        // Group by master_docs_id
        $query->where('md.is_archived', 'archived')->groupBy('ddd.master_docs_id');
        // dd($query);
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('document_info', function ($row) {
                return '
                <div>
                    <strong>' . ($row->title ?? '-') . '</strong><br>
                    <small class="text-muted">No: ' . ($row->number_dar ?? '-') . '</small>
                </div>
            ';
            })
            ->addColumn('department_name', function ($row) {
                return $row->department_name ?? '-';
            })
            ->addColumn('status_badge', function ($row) {
                $statusClass = [
                    'pending' => 'secondary',
                    'distributed' => 'info',
                    'received' => 'success',
                    'returned' => 'primary',
                    'overdue' => 'danger'
                ];

                $statusText = [
                    'pending' => 'Menunggu',
                    'distributed' => 'Didistribusi',
                    'received' => 'Diterima',
                    'returned' => 'Dikembalikan',
                    'overdue' => 'Terlambat'
                ];

                $class = $statusClass[$row->current_status] ?? 'secondary';
                $text = $statusText[$row->current_status] ?? $row->current_status;

                return '<span class="badge badge-' . $class . '">' . $text . '</span>';
            })
            ->addColumn('last_activity', function ($row) {
                if ($row->action_type) {
                    return '
                    <div>
                        <small>' . ucfirst($row->action_type) . '</small><br>
                        <small class="text-muted">' .
                        Carbon::parse($row->action_date)->format('d/m/Y') .
                        '</small>
                    </div>
                ';
                }
                return '<span class="text-muted">Belum ada aktivitas</span>';
            })
            ->addColumn('days_since', function ($row) {
                if ($row->last_action_date) {
                    $days = Carbon::parse($row->last_action_date)->diffInDays(now());
                    $color = $days > 7 ? 'text-danger' : ($days > 3 ? 'text-warning' : 'text-success');
                    return '<span class="' . $color . '">' . $days . ' hari</span>';
                }
                return '<span class="text-muted">-</span>';
            })
            ->addColumn('actions', function ($row) {
                $actions = '<div class="btn-group" role="group">';

                // View Detail Button
                if (Auth::user()->hasRole('sysdev')) {
                    $actions .= '<button type="button" class="btn btn-sm btn-info" onclick="viewDetail(' . $row->id . ')" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                    </button>';

                }

                // Action buttons based on status
                if (Auth::user()->hasRole('manager')) {
                    if ($row->current_status == 'distributed') {
                        $actions .= '<button type="button" class="btn btn-sm btn-success" onclick="markReceived(' . $row->id . ')" title="Tandai Diterima">
                    <i class="fas fa-check"></i>
                </button>';
                    }
                }
                if (Auth::user()->hasRole('manager')) {
                    if ($row->current_status == 'received') {
                        $actions .= '<button type="button" class="btn btn-sm btn-primary" onclick="markReturned(' . $row->id . ')" title="Tandai Dikembalikan">
                    <i class="fas fa-undo"></i>
                </button>';
                    }
                }


                // History Button
                $actions .= '<button type="button" class="btn btn-sm btn-warning" onclick="viewHistory(' . $row->id . ')" title="Lihat Riwayat">
                <i class="fas fa-history"></i>
            </button>';

                $actions .= '</div>';

                return $actions;
            })
            ->rawColumns(['document_info', 'status_badge', 'last_activity', 'days_since', 'actions'])
            ->make(true);
    }

    public function show($id)
    {
        $distribution = DistributionDarDepts::with([
            'requestDar',
            'department',
            'controlLogs' => function ($query) {
                $query->orderBy('created_at', 'desc');
            },
            'controlLogs.creator:id,name'
        ])->findOrFail($id);

        return response()->json($distribution);
    }

    public function markReceived(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'action_date' => 'required|date',
            'receiver_signature' => 'nullable|string',
            'remarks' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $userName = Auth::user()->name;
            $pos_id = Auth::user()->position_id;
            // $dept

            $getPosition = DB::connection('portal-itsa')->table('positions')->where('id', $pos_id)->first();
            $position = '';
            if ($getPosition) {
                $position=$getPosition->position_desc;
            }
            $distribution = DistributionDarDepts::findOrFail($id);
            // dd($distribution);
            // Create control log
            DocumentControlLog::logActivity($id, [
                'request_dar_id' => $distribution->reqdar_id,
                'dept_id' => $distribution->dept_id,
                'action_type' => 'received',
                'action_date' => $request->action_date,
                'receiver_name' => $userName,
                'position' => $position,
                'receiver_signature' => $request->receiver_signature,
                'remarks' => $request->remarks
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil ditandai sebagai diterima'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function markReturned(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'return_receiver' => 'required|string|max:100',
            'return_date' => 'required|date',
            'remarks' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $distribution = DistributionDarDepts::findOrFail($id);

            // Create control log
            DocumentControlLog::logActivity($id, [
                'request_dar_id' => $distribution->reqdar_id,
                'dept_id' => $distribution->dept_id,
                'action_type' => 'returned',
                'action_date' => $request->return_date,
                'return_receiver' => Auth::user()->name,
                'return_date' => $request->return_date,
                'remarks' => $request->remarks
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil ditandai sebagai dikembalikan'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }


    // public function getHistory($id)
    // {
    //     $logs = DocumentControlLog::with(['creator:id,name'])
    //         ->where('distribution_id', $id)
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     return response()->json($logs);
    // }
    public function getHistory($id)
    {
        // dd($id);
        try {
            // Get distribution data with related information
            $distribution = DistributionDarDepts::with([
                'requestDar:id,name_doc,number_dar,typereqform_id',
                // 'requestDar.typeDocs:id,request_type',
                'department:id,description',
                'masterDocument:id,title',
                'controlLogs' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                },
            ])->findOrFail($id);
            // dd($distribution);
            // Get all distributions for the same master document
            $allDistributions = DistributionDarDepts::with([
                'department:id,description',
                'controlLogs' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                },
                'controlLogs.creator:id,name'
            ])
                ->where('master_docs_id', $distribution->master_docs_id)
                ->get();

            $typeDocs = Typereqform::find($distribution->requestDar->typereqform_id);
            // dd($typeDocs);

            // Get control logs for this specific distribution
            $logs = DocumentControlLog::with(['creator:id,name'])
                ->where('distribution_id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
            // dd($distribution);
            // Prepare response data
            $response = [
                'distribution' => $distribution,
                'document' => [
                    'title' => $distribution->masterDocument->title ?? '-',
                    'name' => $distribution->requestDar->name_doc ?? '-',
                    'number' => $distribution->requestDar->number_dar ?? '-',
                    'request_type' => $typeDocs->request_type ?? '-',
                    'revision' => '-',
                    'effective_date' => $distribution->effective_date ?? $distribution->masterDocument->effective_date
                ],
                'distributions' => $allDistributions->map(function ($dist) {
                    $latestLog = $dist->controlLogs->first();
                    return [
                        'id' => $dist->id,
                        'department' => $dist->department->description ?? '-',
                        'department_code' => $this->getDepartmentCode($dist->department->description ?? ''),
                        'current_status' => $dist->current_status,
                        'distributed_date' => $dist->effective_date,
                        'received_info' => $this->getReceivedInfo($dist->controlLogs),
                        'returned_info' => $this->getReturnedInfo($dist->controlLogs),
                        'latest_activity' => $latestLog ? [
                            'type' => $latestLog->action_type,
                            'date' => $latestLog->action_date ?? $latestLog->created_at,
                            'user' => $latestLog->creator->name ?? 'System'
                        ] : null
                    ];
                }),
                'logs' => $logs
            ];

            return response()->json($response);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading document details: ' . $e->getMessage()
            ], 500);
        }
    }
    private function getDepartmentCode($departmentName)
    {
        $codes = [
            'Engineering' => 'ENG',
            'Quality Assurance Department' => 'QAD',
            'Production' => 'PRO',
            'PPIC' => 'PPIC',
            'Marketing' => 'MKT',
            'Purchasing' => 'PUR',
            'HR/GA/HSE' => 'HRM',
            'Accounting/Finance/CIC' => 'FIN',
            'SYD/IT' => 'SIT',
            'Research & Development' => 'RND',
            'Maintenance Dies' => 'MDS',
            'Production Engineering' => 'PDE',
            'PPIC' => 'PPIC',
            'Production' => 'PRD'
        ];

        return $codes[$departmentName] ?? strtoupper(substr($departmentName, 0, 3));
    }

    private function getReceivedInfo($logs)
    {
        $receivedLog = $logs->where('action_type', 'received')->first();
        if ($receivedLog) {
            return [
                'receiver_name' => $receivedLog->receiver_name,
                'signature' => $receivedLog->receiver_signature,
                'date' => $receivedLog->action_date,
                'position' => $receivedLog->position
            ];
        }
        return null;
    }

    private function getReturnedInfo($logs)
    {
        $returnedLog = $logs->where('action_type', 'returned')->first();
        if ($returnedLog) {
            return [
                'return_receiver' => $returnedLog->return_receiver,
                'return_date' => $returnedLog->return_date ?? $returnedLog->action_date,
                'remarks' => $returnedLog->remarks
            ];
        }
        return null;
    }


    public function getDashboardData()
    {
        $summary = [
            'total' => DistributionDarDepts::where('current_status', '=','distributed')->count(),
            'pending' => DistributionDarDepts::where('current_status', 'pending')->count(),
            'distributed' => DistributionDarDepts::where('current_status', 'distributed')->count(),
            'received' => DistributionDarDepts::where('current_status', 'received')->count(),
            'returned' => DistributionDarDepts::where('current_status', 'returned')->count(),
            'overdue' => DistributionDarDepts::where('current_status', 'overdue')->count()
        ];

        return response()->json($summary);
    }
}
