@extends('layouts.app_custom')

@section('title', 'Dashboard')
@section('title-head', 'Manager - Dashboard')

@section('content')

<h1>Manager</h1>

@endsection


{{-- <div class="row">
  <!-- Statistik Card Total DAR -->
  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Total Request DAR</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Statistik Card Bulan Ini -->
  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Request Bulan Ini</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $monthlyRequests }}
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Detail User Info -->
<div class="row">
  <div class="col-xl-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex align-items-center">
        <i class="fas fa-user-circle mr-2"></i>
        <h6 class="m-0 font-weight-bold text-primary">Informasi user detail</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" width="100%" cellspacing="0">
            <tbody>
              <tr>
                <td width="15%">NIK</td>
                <td width="35%">: {{ $users->nik }}</td>
                <td width="15%">Email</td>
                <td width="35%">: {{ $users->email }}</td>
              </tr>
              <tr>
                <td>Username</td>
                <td>: {{ $users->username }}</td>
                <td>Department</td>
                <td>: {{ $users->description }}</td>
              </tr>
              <tr>
                <td>Name</td>
                <td>: {{ $users->name }}</td>
                <td>Position</td>
                <td>: {{ $users->position_desc }}</td>
              </tr>
              <tr>
                <td>Company</td>
                <td colspan="3">: {{ $users->company_desc }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div> --}}
