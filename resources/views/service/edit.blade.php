@extends('layouts.app_custom')
@section('title-head','Edit Service')
@section('title','Edit Service')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
<div class="section-body">
  <form action="{{ route('servicebe.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
             <div class="form-group">
              <label>Title</label>
              <input type="text" name="title" id="title" value="{{ $data->title }}" class="form-control @error('title') is-invalid @enderror" required autocomplete="off">

              @error('title')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
              <div class="form-group">
              <label>Description</label>
              {{-- <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" required autocomplete="off"> --}}
             <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ $data->description }}</textarea>
              @error('description')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <button type="submit" id="save" class="btn btn-primary">Save</button>
              <a href="{{ route('servicebe.index') }}" class="btn btn-secondary">Back</a>
            </div>

          </div>
        </div>

      </div>
    </form>
  </div>
</div>

@endsection
