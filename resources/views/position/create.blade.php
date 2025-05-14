@extends('layouts.app_custom')
@section('title-head','Create Position ')
@section('title','Create Position')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
<div class="section-body">
  <form action="{{ route('position.store') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
             <div class="form-group">
              <label>Position</label>
              <input type="text" name="position_desc" id="position_desc" class="form-control @error('position_desc') is-invalid @enderror" required autocomplete="off">

              @error('position_desc')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <button type="submit" id="save" class="btn btn-primary">Save</button>
              <a href="{{ route('position.index') }}" class="btn btn-secondary">Back</a>
            </div>

          </div>
        </div>

      </div>
    </form>
  </div>
</div>

@endsection
