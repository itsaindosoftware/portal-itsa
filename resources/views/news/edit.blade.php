@extends('layouts.app_custom')
@section('title-head','Edit News')
@section('title','Edit News')
@section('css')
@endsection

@section('content')

<form action="{{ route('newsbe.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    {{-- Title --}}
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control"  value="{{ $data->title }}">
        @error('title')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Description --}}
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control">{{ $data->description }}</textarea>
        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Upload Picture --}}
    {{-- Upload Picture --}}
    <div class="form-group">
        <label for="picture">Upload Picture</label><br>
    
        @if($data->pic)
            <div class="mb-2">
                <img src="{{ asset('storage/news/' . $data->pic) }}" alt="Current Picture" width="200" style="border:1px solid #ccc; padding:5px;">
            </div>
        @endif

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
