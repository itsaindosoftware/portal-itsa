@extends('layouts.app_custom')

@section('title', 'Dashboard')
@section('title-head', 'Admin - Dashboard')

@section('content')
<div class="row mb-4">
  <div class="col-12">
    <h4 class="text-dark font-weight-bold">Ringkasan Sistem</h4>
    <p class="text-muted">Berikut ini adalah data statistik pengguna dan sistem module DAR System.</p>
  </div>
</div>

<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1 shadow-sm">
      <div class="card-icon bg-primary">
        <i class="far fa-user"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Pengguna</h4>
        </div>
        <div class="card-body">
          {{ $user }}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1 shadow-sm">
      <div class="card-icon bg-danger">
        <i class="far fa-newspaper"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Permission</h4>
        </div>
        <div class="card-body">
          {{ $permission }}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1 shadow-sm">
      <div class="card-icon bg-warning">
        <i class="far fa-file"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Module</h4>
        </div>
        <div class="card-body">
          {{ $module }}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1 shadow-sm">
      <div class="card-icon bg-success">
        <i class="fas fa-circle"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Role</h4>
        </div>
        <div class="card-body">
          {{ $role }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
