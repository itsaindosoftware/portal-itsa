@extends('layouts.app_custom')
@section('title-head','Request Dar')
@section('title','Request Dar')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-edit.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap5/css/daterangepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap5/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap5/css/rowGroup.bootstrap4.min.css') }}">
@endsection
@section('content')

<section class="section">
<div class="section-body">
          <div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Filter</h4>
						<div class="card-header-action">
							<a data-collapse="#filter-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
						</div>
					</div>
					<div class="collapse show" id="filter-collapse">
						<div class="card-body">
							<form id="filter-form">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Date Range</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-calendar"></i>
													</div>
												</div>
												<input type="text" placeholder="Select date range" class="form-control daterange-picker" name="date_range" id="date_range">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>NIK/Name</label>
											<input type="text" class="form-control" placeholder="Enter NIK or Name" name="nik_name" id="nik_name">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Department</label>
											<select class="form-control" name="department" id="department">
												<option value="">All Departments</option>
                                                @foreach ($department as $dp )
                                                   <option value="{{ $dp->id }}">{{ $dp->description }}</option>
                                                @endforeach
												<!-- Department options will be loaded dynamically -->
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Company</label>
											<select class="form-control" name="company" id="company">
												<option value="">All Companies</option>
                                                @foreach ($company as $cp )
                                                   <option value="{{ $cp->id }}">{{ $cp->company }}</option>
                                                @endforeach
												<!-- Company options will be loaded dynamically -->
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Position</label>
											<select class="form-control" name="position" id="position">
												<option value="">All Positions</option>
                                                @foreach ($position as $p )
                                                   <option value="{{ $p->id }}">{{ $p->position }}</option>
                                                @endforeach
												<!-- Position options will be loaded dynamically -->
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Request Type</label>
											<select class="form-control" name="reqtype" id="reqtype">
												<option value="">All Request Types</option>
												@foreach ($reqTypes as $types )
                                                   <option value="{{ $types->id }}">{{ $types->request_type }}</option>
                                                @endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Status</label>
											<select class="form-control select2" name="status" id="status">
												<option value="">All Statuses</option>
												<option value="Pending">Pending</option>
												<option value="Approved">Approved</option>
												<option value="Rejected">Rejected</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group mt-4 pt-1">
											<button type="button" class="btn btn-primary" id="btn-filter">
												<i class="fas fa-filter"></i> Apply Filter
											</button>
											<button type="button" class="btn btn-light" id="btn-reset">
												<i class="fas fa-undo"></i> Reset
											</button>
										</div>
									</div>
								</div>
                                <input type="hidden" name="group_by" id="group_by" value="department">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						@if(session()->has('success'))
						<div class="alert alert-success alert-dismissible show fade">
	                      <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
	                      <div class="alert-body">
	                        <div class="alert-title">Success</div>
	                        {{ session()->get('success') }}
	                        </div>
	                         <button class="close" data-dismiss="alert">
	                          <span>×</span>
	                        </button>
	                    </div>
	                     @endif
						<div class="table-responsive">
							<table class="table table-bordered dataTable no-footer" id="table-request-manage" width="100%" role="grid" aria-describedby="table-1_info">
								<thead>
									<tr>
										<th width="7%">No.</th>
										<th class="text-center">Date</th>
								        <th class="text-center">NIK/Nama</th>
                                        <th class="text-center">Position</th>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Company</th>
                                        <th class="text-center">Request Type</th>
                                        <th class="text-center">ApprovalBy1</th>
                                        <th class="text-center">ApprovalBy2</th>
                                        <th class="text-center">ApprovalBy3</th>
										<th class="text-center" width="15%">Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
@push('js')
@include('request-dar.user-approved2.edit')
@include('request-dar.user-dashboard.show')
@include('request-dar.user-dashboard.view-docs.view-docs-view')
@include('request-dar.user-dashboard.view-docs.view-docs-edit')
@include('request-dar.user-approved2.rejected-appr2.rejected')
<script src="{{ asset('assets/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bootstrap5/js/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset('bootstrap5/js/moment.min.js') }}"></script>
<script src="{{ asset('bootstrap5/js/daterangepicker.min.js') }}"></script>
<script>
$(document).ready(function(){
    	$('.daterange-picker').daterangepicker({
			locale: {format: 'YYYY-MM-DD'},
			drops: 'down',
			opens: 'right',
			autoUpdateInput: false,
		});

		$('.daterange-picker').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
		});

		$('.daterange-picker').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});

	// 	var table = $('#table-request-manage').DataTable({
	// 		"columnDefs": [{
	// 			"searchable": false,
	// 			"orderable": false,
	// 			"targets": 0,
	// 			render: function(data, type, row, meta) {
	// 				return meta.row + meta.settings._iDisplayStart + 1;
	// 			},
	// 		}],
	// 		processing: true,
	// 		serverSide: true,
	// 		deferRender:true,
	// 		ajax: {
	// 			url: "{{ route('requestdar.index') }}",
    //             data: function(d) {
	// 				d.date_range = $('#date_range').val();
	// 				d.nik_name = $('#nik_name').val();
	// 				d.reqtype = $('#reqtype').val();
	// 				d.status = $('#status').val();
    //                 d.position = $('#position').val();
    //                 d.company = $('#company').val();
    //                 d.department = $('#department').val();
	// 			}
	// 		},
	// 		order: [[ 0, 'desc']],
	// 		responsive: true,
	// 		columns: [
	// 		{
	// 			data: null,
	// 			name: null,
	// 			orderable: false,
	// 			searchable: false,
	// 			className: 'text-center'
	// 		},
	// 		{ data: 'created_date', name: 'created_date', className: 'text-center' },
	// 		{ data: 'nik_req', name: 'nik_req', className:'text-center' },
    //         { data: 'position', name: 'position',className: 'text-center' },
    //         { data: 'department', name: 'department',className: 'text-center' },
    //         { data: 'position', name: 'position',className: 'text-center' },
    //         { data: 'reqtype', name: 'reqtype',className: 'text-center' },
    //         { data: 'approval_status1', name: 'approval_status1',className: 'text-center' },
    //         { data: 'approval_status2', name: 'approval_status2',className: 'text-center' },
    //         { data: 'approval_status3', name: 'approval_status3',className: 'text-center' },
	// 		{ data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
	// 		]
	// //
    //    });

    function initDataTable() {
            // Destroy existing table if it exists
            if ($.fn.DataTable.isDataTable('#table-request-manage')) {
                $('#table-request-manage').DataTable().destroy();
            }

            // Configure DataTable with department grouping
            var tableOptions = {
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                }],
                processing: true,
                serverSide: true,
                deferRender: true,
                ajax: {
                    url: "{{ route('requestdar.index') }}",
                    data: function(d) {
                        d.date_range = $('#date_range').val();
                        d.nik_name = $('#nik_name').val();
                        d.reqtype = $('#reqtype').val();
                        d.status = $('#status').val();
                        d.position = $('#position').val();
                        d.company = $('#company').val();
                        d.department = $('#department').val();
                        d.group_by = 'department'; // Always group by department
                    }
                },
                order: [[4, 'asc'], [0, 'desc']], // Sort by department first, then by default order
                responsive: true,
                columns: [
                    {data: null, name: null, orderable: false, searchable: false, className: 'text-center'},
                    {data: 'created_date', name: 'created_date', className: 'text-center'},
                    {data: 'nik_req', name: 'nik_req', className: 'text-center'},
                    {data: 'position', name: 'position', className: 'text-center'},
                    {data: 'department', name: 'department', className: 'text-center'},
                    {data: 'company', name: 'company', className: 'text-center'},
                    {data: 'reqtype', name: 'reqtype', className: 'text-center'},
                    {data: 'approval_status1', name: 'approval_status1', className: 'text-center'},
                    {data: 'approval_status2', name: 'approval_status2', className: 'text-center'},
                    {data: 'approval_status3', name: 'approval_status3', className: 'text-center'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'}
                ],
                // Set up RowGroup for department
                rowGroup: {
                    dataSrc: 'department',
                    startRender: function(rows, group) {
                        return '<span class="font-weight-bold; color:white">Department: ' + group + ' (' + rows.count() + ' records)</span>';
                    }
                }
            };

            // Initialize the table with configured options
            var table = $('#table-request-manage').DataTable(tableOptions);

            return table;
        }

        // Initialize DataTable on page load
        var table = initDataTable();



    function showNotification(type, message) {
        if(type == 'success'){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Successfully',
                text: message,
                showConfirmButton: false,
                timer: 1500
            })
        } else if(type=='warning') {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: message,
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: message,
            })
        }

    }

    $('#btn-filter').click(function() {
		table.ajax.reload();
	});

		// Reset filter
    $('#btn-reset').click(function() {
        $('#filter-form')[0].reset();
        $('.select2').val('').trigger('change');
        table.ajax.reload();
    });


    $(document).on('click', '#approved2-data-dar', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let urlAction = $(this).attr('href');
        let mgr  = $(this).attr('row-approve-manager');
        let sysdev  = $(this).attr('row-approve-sysdev');


        if(mgr == ''){
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'data ini harus diapproval terlebih dahulu oleh manager yang bersangkutan!',
            })
            return false;
        }
        if(sysdev != ''){
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'data ini Sudah diapproved',
            })
            return false;
        }
       Swal.fire({
			title: 'Approved',
			text: 'setujui untuk pengajuan ini?',
			icon: 'warning',
			input: 'textarea',
			inputLabel: 'Remarks',
			inputPlaceholder: 'Masukkan catatan atau komentar (opsional)',
			inputAttributes: {
				'aria-label': 'Remarks',
				'maxlength': 500
			},
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes!',
			cancelButtonText: 'Cancel',
			inputValidator: (value) => {
				// Remark is optional, so no validation needed here
				// If you want to make it required, uncomment the below lines
				// if (!value) {
				//     return 'You need to write something!'
				// }
			}
		}).then((result) => {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			if (result.value || result.value == '') {
				let remarks = result.value || '-'; // Get remarks value, empty string if nothing entered
			
				
				$.ajax({
					url: urlAction,
					type: "POST",
					data: {
						'_method': 'POST',
						'remarks': remarks // Send remarks to the server
					},
					success: function(data) {
						if (data.status == true) {
							Swal.fire({
								position: 'top',
								icon: 'success',
								title: 'Success Approval Data',
								showConfirmButton: false,
								timer: 3000
							})
							$('#table-request-manage').DataTable().ajax.reload();
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Something went wrong!',
							})
						}
					},
				 error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim data',
                    });
                }
				});
			} else {
				  console.log(`data was canceled`);
			}
		});

    })


    $(document).on('click', '#rejected2-data-dar', function(e){
        e.preventDefault();
        let id_reqdar = $(this).data('id');
        let urlAction = $(this).attr('href');
        $('#reject2-modal').modal('show')
        $('#reject2-id').val(id_reqdar)
        $('#rejectForm2').append()
     })
      $(document).ready(function() {
        $('.submit-reject2').click(function() {
            // Validasi form
            let id = $('#reject2-id').val();
            let route = "{{ route('requestdar.rejectedAppr2',':param') }}";
            let urlAction = route.replace(':param', id);
                if (!$('#reject_reason2').val()) {
                Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Harap diisi alasan penolakan untuk perubahan dokumen ini!',
                    })
                    return;
                }
                Swal.fire({
                    title: 'Rejected',
                    text: 'Tolak untuk pengajuan ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((willRejected) => {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    if (willRejected.value) {
                    $.ajax({
                        url: urlAction,
                        type: "POST",
                        data: $('#rejectForm').serialize(),
                        success: function(response) {
                               closeRejectModal();
                                Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: 'Dokumen berhasil direject',
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                                $('#table-request-manage').DataTable().ajax.reload();

                        },
                            error: function(xhr) {
                                alert('Terjadi kesalahan! ' + xhr.responseJSON.message);
                            }
                        });
                    } else {
                        console.log(`data was dismissed by ${willDeleted.dismiss}`);
                    }

                })

            })

        });




})
</script>
@endpush
