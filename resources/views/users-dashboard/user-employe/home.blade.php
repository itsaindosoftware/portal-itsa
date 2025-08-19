@extends('layouts.app_custom')

@section('title', 'Dashboard')
@section('title-head', 'UsersEMP - Dashboard')

@section('content')

<!-- Welcome Label -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card" style="background-color: white; border: none;">
            <div class="card-body text-center py-4">
                <h2 class="mb-2" style="color: black;">
                    <i class="fas fa-file-alt mr-3"></i>
                    Selamat Datang di Aplikasi Document Action Request (DAR)
                </h2>
                <p class="mb-0" style="color: black; font-size: 18px;">Sistem Manajemen Permintaan Perubahan Dokumen</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-3 mb-3">
      <div class="card card-statistic-2">
        <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-clipboard-list"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Request DAR User</h4>
          </div>
          <div class="card-body">
            {{ $data }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-3 mb-3">
      <div class="card card-statistic-2">
        <div class="card-icon shadow-primary bg-success">
          <i class="fas fa-list-alt"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Request</h4>
          </div>
          <div class="card-body">
            {{ $totalRequests }}
          </div>
        </div>
      </div>
    </div>
     <div class="col-xl-3 col-md-3 mb-3">
      <div class="card card-statistic-2">
        <div class="card-icon shadow-primary bg-info">
          <i class="fas fa-book"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Documents</h4>
          </div>
          <div class="card-body">
          {{ $totalDocs }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-3 mb-4">
      <div class="card card-statistic-2">
        <div class="card-icon shadow-primary bg-warning">
          <i class="fas fa-clock"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Last Update Request</h4>
          </div>
          <div class="card-body">
            @if($lastUpdateRequest)
              <span style="font-size: 20px">{{ \Carbon\Carbon::parse($lastUpdateRequest->updated_bydate_1)->format('Y-m-d H:i') }}</span>
            @else
            <span style="font-size: 20px">No requests yet</span>
            @endif
          </div>
        </div>
      </div>
    </div>
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
    </div>
</div>

@endsection