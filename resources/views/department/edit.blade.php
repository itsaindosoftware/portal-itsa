@extends('layouts.app_custom')
@section('title-head','Edit Department ')
@section('title','Edit Department')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
<div class="section-body">
  <form action="{{ route('department.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
             <div class="form-group">
              <label>Department</label>
              <input type="text" name="description" id="description" value="{{ $data->description }}" class="form-control @error('description') is-invalid @enderror" required autocomplete="off">
              @error('description')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <button type="submit" id="save" class="btn btn-primary">Save</button>
              <a href="{{ route('department.index') }}" class="btn btn-secondary">Back</a>
            </div>

          </div>
        </div>

      </div>
    </form>
  </div>
</div>

@endsection
