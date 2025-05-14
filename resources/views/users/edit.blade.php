@extends('layouts.app_custom')
@section('title-head','Edit User ')
@section('title','Edit User')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
<div class="section-body">
  <form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label>NIK</label>
                  <input type="text" name="nik" id="nik"  value="{{ $user->nik }}" class="form-control @error('nik') is-invalid @enderror" required autocomplete="off">
                  @error('nik')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" id="name"  value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" required autocomplete="off">
                  @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" id="username"  value="{{ $user->username }}" class="form-control @error('username') is-invalid @enderror" required autocomplete="off">
                  @error('username')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" id="email"  value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" required autocomplete="off">
                  @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
                <div class="form-group">
                  <label>Department</label>
                  <select class="form-control @error('department_id') is-invalid @enderror" id="department_id" name="department_id">
                    <option value="">--Select Department--</option>
                    @php $db = new \App\Department(); @endphp
                    @foreach($db->getDepartment() as $val)
                      <option value="{{ $val->id }}" @if($val->id == $user->department_id) selected  @endif>{{ $val->description }}</option>
                    @endforeach
                  </select>
                  @error('department_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
                <div class="form-group">
                  <label>Position</label>
                  <select class="form-control @error('position_id') is-invalid @enderror" id="position_id" name="position_id">
                    <option value="">--Select Position--</option>
                    @php $db = new \App\Position(); @endphp
                    @foreach($db->getPosition() as $val)
                      <option value="{{ $val->id }}"  @if($val->id == $user->position_id) selected  @endif>{{ $val->position_desc }}</option>
                    @endforeach
                  </select>
                  @error('position_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
              </div>
            </div>
          </div>

          <!-- KOLOM KANAN -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label>Company</label>
                  <select class="form-control @error('company_id') is-invalid @enderror" id="company_id" name="company_id">
                    <option value="">--Select Company--</option>
                    @php $db = new \App\Company(); @endphp
                    @foreach($db->getCompany() as $val)
                      <option value="{{ $val->id }}" @if($val->id == $user->company_id) selected  @endif>{{ $val->company_desc }}</option>
                    @endforeach
                  </select>
                  @error('company_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
                <div class="form-group">
                  <label>Hak Akses</label>
                  <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id">
                    @php $db = new \App\Role(); @endphp
                    @foreach($db->getRoles() as $val)
                      <option value="{{ $val->id }}" @if($val->id == $user->role_id) selected  @endif>{{ $val->name }}</option>
                    @endforeach
                  </select>
                  @error('role_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                  @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
                <div class="form-group">
                  <label>Password Confirmation</label>
                  <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="off">
                  @error('password_confirmation')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>
                <div class="form-group">
                  <button type="submit" id="save" class="btn btn-primary">Save</button>
                  <a href="{{ route('user.index') }}" class="btn btn-secondary">Back</a>
                </div>
              </div>
            </div>
    </form>
  </div>
</div>

@endsection
