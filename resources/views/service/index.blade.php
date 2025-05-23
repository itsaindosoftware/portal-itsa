@extends('layouts.app_custom')
@section('title-head','Service Management')
@section('title','Service Management')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
<section class="section">

	<div class="section-header">
		@permission('create-portalitsa-service')
		<a href="{{ route('servicebe.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Add Service</a>
		@endpermission
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
			<div class="breadcrumb-item"><a href="#">Service Management</a></div>
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
							<table class="table table-bordered dataTable no-footer" id="table-service-manage" width="100%" role="grid" aria-describedby="table-1_info">
								<thead>
									<tr>
										<th width="7%">No.</th>
										<th class="text-center">Title</th>
								        <th class="text-center">Description</th>
                                        <th class="text-center">Created By</th>
                                        <th class="text-center">Created At</th>
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
@include('service.show')
<script src="{{ asset('assets/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
		var table = $('#table-service-manage').DataTable({
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
				url: "{{ route('servicebe.index') }}",
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
			{ data: 'title', name: 'title' },
			{ data: 'description', name: 'description' },
            { data: 'created_by', name: 'created_by',className: 'text-center' },
            { data: 'created_at', name: 'created_at',className: 'text-center' },
			{ data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
			]
	//
});

$(document).on('click','#deleted-data-service', function(e){
	e.preventDefault();
    var href = $(this).attr('data-href');
    Swal.fire({
        title: 'Are you sure?',
        text: 'Deleted this data',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then((willDeleted) => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (willDeleted.value) {
            $.ajax({
                url: href,
                type: "POST",
                data: {
                    '_method': 'DELETE'
                },

                success: function(data) {
                    if (data.msg == true) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Success Deleted Data',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#table-service-manage').DataTable().ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        })
                    }
                }
            })
        } else {
            console.log(`data was dismissed by ${willDeleted.dismiss}`);
        }

    })
})
$(document).on('click','#show-data-service', function(e){
       e.preventDefault()
        let id = $(this).data('id');
        let route = "{{ route('servicebe.show', ':id') }}";
        route = route.replace(':id', id);
        $.ajax({
            url: route,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data)
                let html = `
                    <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <tbody>
                        <tr><th>Title</th><td>${data[0].title}</td></tr>
                        <tr><th>Description</th><td>${data[0].description}</td></tr>
                        <tr><th>Created By</th><td>${data[0].created_by}</td></tr>
                        <tr><th>Created Date</th><td>${data[0].created_at}</td></tr>
                        </tbody>
                    </table>
                    </div>
                `;
                $('#detail-service-body').html(html);
                $('#modal-view').modal('show');

            }
        });
  });
</script>

@endpush
