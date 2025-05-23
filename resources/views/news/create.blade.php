@extends('layouts.app_custom')
@section('title-head','Create News')
@section('title','Create News')
@section('css')
@endsection

@section('content')

<form action="{{ route('newsbe.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Title --}}
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        @error('title')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Description --}}
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Upload Picture --}}
    <div class="form-group">
        <label for="picture">Upload Picture</label>
        <input type="file" name="picture" class="form-control-file">
        @error('picture')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Buttons --}}
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('newsbe.index') }}" class="btn btn-secondary">Back</a>
</form>

@endsection
