@extends('layouts.app_custom')
@section('title-head','Create Company')
@section('title','Create Company')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
<div class="section-body">
  <form action="{{ route('company.store') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
             <div class="form-group">
              <label>Company</label>
              <input type="text" name="company_desc" id="company_desc" class="form-control @error('company_desc') is-invalid @enderror" required autocomplete="off">

              @error('company_desc')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <button type="submit" id="save" class="btn btn-primary">Save</button>
              <a href="{{ route('company.index') }}" class="btn btn-secondary">Back</a>
            </div>

          </div>
        </div>

      </div>
    </form>
  </div>
</div>

@endsection
