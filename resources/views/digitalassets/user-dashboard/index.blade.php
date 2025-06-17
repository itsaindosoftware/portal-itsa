@extends('layouts.app_custom')
@section('title-head','Digital Assets - Registration Fixed Asset')
@role('user-employee-digassets')
   @section('title','Registration Fixed Asset')
@endrole
@role('admin')
   @section('title','All Request Digital Assets')
@endrole

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-edit.css') }}">
@endsection
@section('content')

{{-- @role('user-employee-digassets') --}}
<section class="section">
	<div class="section-header">
		@permission('create-digital-assets-reg')
		<a href="{{ route('digitalassets.create') }}" class="btn btn-icon icon-left btn-primary" id="show-create-dar"><i class="fas fa-plus"></i> Add request</a>
		@endpermission
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
			<div class="breadcrumb-item"><a href="#">Registration Fixed Asset</a></div>
			{{-- <div class="breadcrumb-item">DataTables</div> --}}
		</div>
	</div>

	<div class="section-body">

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

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

$(document).on('click','#approved-1', function(e) {
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

	var approvalDate1 = $(this).attr('row-approve1');
	if (approvalDate1) {
		Swal.fire({
			title: 'Already Approved',
			text: 'This request has already been approved by the first approver.',
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

	// Swal.fire({
	// 	title: 'Are you sure?',
	// 	text: "You want to approve this request?",
	// 	icon: 'warning',
	// 	showCancelButton: true,
	// 	confirmButtonColor: '#3085d6',
	// 	cancelButtonColor: '#d33',
	// 	confirmButtonText: 'Yes, approve it!'
	// }).then((result) => {
	// 	if (result) {
	// 		$.ajax({
	// 			url: href,
	// 			type: 'POST',
	// 			data: {
	// 				_method: 'POST',
	// 				_token: '{{ csrf_token() }}'
	// 			},
	// 			success: function(response) {
	// 				Swal.fire(
	// 					'Approved!',
	// 					response.message,
	// 					'success'
	// 				);
	// 				table.ajax.reload();
	// 			},
	// 			error: function(xhr) {
	// 				Swal.fire(
	// 					'Error!',
	// 					xhr.responseJSON.message,
	// 					'error'
	// 				);
	// 			}
	// 		});
	// 	}
	// });
});







})
</script>
@endpush
