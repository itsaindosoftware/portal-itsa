@extends('layouts.app_custom')
@section('title-head','Digital Assets - Registration Fixed Asset')
@role('user-acct-digassets')
   @section('title','Registration Fixed Asset')
@endrole
@role('admin')
   @section('title','All Request Digital Assets')
@endrole

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-edit.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap5/css/daterangepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap5/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap5/css/rowGroup.bootstrap4.min.css') }}">
@endsection
@section('content')

{{-- @role('user-employee-digassets') --}}
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
												<input type="text" class="form-control daterange-picker" placeholder="Select Date Range" name="date_range" id="date_range">
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>NIK/Name</label>
											<input type="text" class="form-control" name="nik_name" placeholder="Enter NIK/Name" id="nik_name">
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
                                                   <option value="{{ $cp->id }}">{{ $cp->company_desc }}</option>
                                                @endforeach
												<!-- Company options will be loaded dynamically -->
											</select>
										</div>
									</div>
								</div>
								<div class="row">
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
                                    {{-- <div class="col-md-3">
										<div class="form-group">
											<label>Asset Groups</label>
											<select class="form-control" name="asset_group" id="asset_group">
												<option value="">--Select--</option>
                                                @foreach ($masterAssetGroups as $cp )
                                                   <option value="{{ $cp->id }}">{{ $cp->asset_group_name }}</option>
                                                @endforeach
												<!-- Company options will be loaded dynamically -->
											</select>
										</div>
									</div>
                                    <div class="col-md-3">
										<div class="form-group">
											<label>Asset Location</label>
											<select class="form-control" name="asset_location" id="asset_location">
												<option value="">--Select--</option>
                                                @foreach ($masterAssetLocations as $cp )
                                                   <option value="{{ $cp->id }}">{{ $cp->asset_location_name }}</option>
                                                @endforeach
												<!-- Company options will be loaded dynamically -->
											</select>
										</div>
									</div>
                                    <div class="col-md-3">
										<div class="form-group">
											<label>Asset Cost Center</label>
											<select class="form-control" name="asset_cost_center" id="asset_cost_center">
												<option value="">--Select--</option>
                                                @foreach ($masterAssetCostCenters as $cp )
                                                   <option value="{{ $cp->id }}">{{ $cp->cost_center_name }}</option>
                                                @endforeach
												<!-- Company options will be loaded dynamically -->
											</select>
										</div>
									</div> --}}
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
								        <th class="text-center">RFA Number</th>                                        
                                        <th class="text-center">ApprovalBy1</th>
                                        <th class="text-center">ApprovalBy2</th>
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
    {{-- @endrole --}}

@endsection
@push('js')
<script src="{{ asset('assets/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bootstrap5/js/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset('bootstrap5/js/moment.min.js') }}"></script>
<script src="{{ asset('bootstrap5/js/daterangepicker.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

$(document).ready(function() {
        // Initialize date range picker
        $('.daterange-picker').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            autoUpdateInput: false,
            opens: 'left'
        });

        $('.daterange-picker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('.daterange-picker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
});
$(document).on('click', '#edit-data-notif', function(e) {
    e.preventDefault();
		Swal.fire({
			icon: 'info',
			title: 'Edit Not Allowed',
			text: 'You cannot edit this digital asset as it has already been approved.',
			confirmButtonText: 'OK'
		});
});
$(document).ready(function(){
        // $('.addrm').prop('disabled', true);

		var table = $('#table-request-manage').DataTable({
			"columnDefs": [{
				"searchable": false,
				"orderable": false,
				"targets": 0,
				render: function(data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				},
			}],
			processing: true,
			serverSide: true,
			deferRender:true,
            ajax: {
                url: "{{ route('digitalassets.index') }}",
                data: function(d) {
                    d.date_range = $('#date_range').val();
                    d.nik_name = $('#nik_name').val();
                    d.status = $('#status').val();
                    d.company = $('#company').val();
                    d.department = $('#department').val();
                    d.asset_group = $('#asset_group').val();
                    d.asset_location = $('#asset_location').val();
                    d.asset_cost_center = $('#asset_cost_center').val();
                    // d.group_by = $('#group_by').val(); // Add group_by to the request data
                }
            },
			order: [[ 0, 'desc']],
			responsive: true,
			columns: [
			{
				data: null,
				name: null,
				orderable: false,
				searchable: false,
				className: 'text-center'
			},
			{ data: 'date', name: 'date', className: 'text-center' },
			{ data: 'rfa_number', name: 'rfa_number', className:'text-center' },
            // { data: 'approval_status1', name: 'approval_status1',className: 'text-center' },
            { data: 'approval_status2', name: 'approval_status2',className: 'text-center' },
            { data: 'approval_status3', name: 'approval_status3',className: 'text-center' },
			{ data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
			]
	//
});

$(document).ready(function() {
    // Handle filter button click
    $('#btn-filter').on('click', function() {
      $('#table-request-manage').DataTable().ajax.reload();
    });

    // Handle reset button click
    $('#btn-reset').on('click', function() {
        $('#filter-form')[0].reset();
        $('.daterange-picker').val('');
        $('#table-request-manage').DataTable().ajax.reload();
    });
});

$(document).on('click','#approved-3', function(e) {
	e.preventDefault();
	var id = $(this).data('id');
	var href = $(this).data('href');
	if (!id|| !href) {
		Swal.fire({
			title: 'Error!',
			text: 'Invalid request data.',
			icon: 'error'
		});
		return;
	}

	var approvalDate3 = $(this).attr('row-approve3');
	if (approvalDate3) {
		Swal.fire({
			title: 'Already Approved',
			text: 'This request has already been approved by the first approver.',
			icon: 'info'
		});
		return;
	}
    var approvalDate2 = $(this).attr('row-approve2');
    if (!approvalDate2) {
        Swal.fire({
            title: 'Approval Required',
            text: 'This request must be approved by the second approver before you can approve it.',
            icon: 'info'
        });
        return;
    }

	Swal.fire({
		title: 'Are you sure?',
		text: "You want to approve this request?",
		icon: 'warning',
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, approve it!',
		input: 'textarea',
		inputLabel: 'Remarks',
		inputPlaceholder: 'Please enter your remarks here (optional)',
		inputAttributes: {
			'aria-label': 'Remarks',
			'maxlength': 500
		},
		showCancelButton: true,
		cancelButtonText: 'Cancel',
		inputValidator: (value) => {
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
				url: href,
				type: "POST",
				data: {
					'_method': 'POST',
					'remarks': remarks // Send remarks to the server
				},
				success: function(data) {
					Swal.fire(
						'Approved!',
						data.message,
						'success'
					);
					// table.ajax.reload();
					$('#table-request-manage').DataTable().ajax.reload();

				},
				error: function(xhr) {
						Swal.fire(
							'Error!',
							xhr.responseJSON.message,
							'error'
						);
				}
			});
		} else {
			console.log(`data was canceled`);
		}
	});

});


});

$(document).on('click','#rejected-3', function(e) {
	e.preventDefault();
	var id = $(this).data('id');
	var href = $(this).data('href');
	if (!id || !href) {
		Swal.fire({
			title: 'Error!',
			text: 'Invalid request data.',
			icon: 'error'
		});
		return;
	}

	var approvalDate3 = $(this).attr('row-approve3');
	if (approvalDate3) {
		Swal.fire({
			title: 'Already Approved',
			text: 'This request has already been approved by the first approver.',
			icon: 'info'
		});
		return;
	}
    var approvalDate2 = $(this).attr('row-approve2');
    if (!approvalDate2) {
        Swal.fire({
            title: 'Approval Required',
            text: 'This request must be approved by the second approver before you can approve it.',
            icon: 'info'
        });
        return
    }
	Swal.fire({
		title: 'Are you sure?',
		text: "You want to reject this request?",
		icon: 'warning',
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, reject it!',
		input: 'textarea',
		inputLabel: 'Remarks',
		inputPlaceholder: 'Please enter your remarks here (optional)',
		inputAttributes: {
			'aria-label': 'Remarks',
			'maxlength': 500
		},
		showCancelButton: true,
		cancelButtonText: 'Cancel',
		inputValidator: (value) => {
			if (!value) {
				return 'You need to write something!';
			}
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
				url: href,
				type: "POST",
				data: {
					'_method': 'POST',
					'remarks': remarks // Send remarks to the server
				},
				success: function(data) {
					Swal.fire(
						'Rejected!',
						data.message,
						'success'
					);
					// table.ajax.reload();
					$('#table-request-manage').DataTable().ajax.reload();
				},
				error: function(xhr) {
					Swal.fire(
						'Error!',
						xhr.responseJSON.message,
						'error'
					);
				}
			});
		} else {
			console.log(`data was canceled`);
		}
	});
});
</script>
@endpush
