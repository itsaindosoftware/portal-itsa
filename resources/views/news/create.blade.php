@extends('layouts.app_custom')
@section('title-head','Create News')
@section('title','Create News')
@section('css')
<style>
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-control, .form-control-file {
        border-radius: 4px;
        border: 1px solid #ddd;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .card {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">Create New News Article</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('newsbe.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    {{-- Title --}}
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Enter news title">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="form-group">
                        <label for="slug" class="font-weight-bold">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" placeholder="Auto-generated from title if empty">
                        <small class="text-muted">Leave empty to auto-generate from title</small>
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Excerpt --}}
                    <div class="form-group">
                        <label for="excerpt" class="font-weight-bold">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" class="form-control" rows="3" placeholder="Brief summary of the news (max 500 characters)">{{ old('excerpt') }}</textarea>
                        <small class="text-muted">Auto-generated from description if empty</small>
                        @error('excerpt')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label for="description" class="font-weight-bold">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="form-control" rows="8" placeholder="Enter the full news content">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Meta Description --}}
                    <div class="form-group">
                        <label for="meta_description" class="font-weight-bold">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="form-control" rows="2" maxlength="160" placeholder="SEO meta description (max 160 characters)">{{ old('meta_description') }}</textarea>
                        <small class="text-muted">For SEO purposes</small>
                        @error('meta_description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    {{-- Category --}}
                    <div class="form-group">
                        <label for="category" class="font-weight-bold">Category <span class="text-danger">*</span></label>
                        <select name="category" id="category" class="form-control">
                            <option value="">Select Category</option>
                            <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>General</option>
                            <option value="announcement" {{ old('category') == 'announcement' ? 'selected' : '' }}>Announcement</option>
                            <option value="event" {{ old('category') == 'event' ? 'selected' : '' }}>Event</option>
                            <option value="update" {{ old('category') == 'update' ? 'selected' : '' }}>Update</option>
                            <option value="promotion" {{ old('category') == 'promotion' ? 'selected' : '' }}>Promotion</option>
                            <option value="education" {{ old('category') == 'education' ? 'selected' : '' }}>Education</option>
                        </select>
                        @error('category')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label for="status" class="font-weight-bold">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>inactive</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Published At --}}
                    <div class="form-group">
                        <label for="published_at" class="font-weight-bold">Publish Date</label>
                        <input type="datetime-local" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') }}">
                        <small class="text-muted">Leave empty to use current time when published</small>
                        @error('published_at')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Upload Picture --}}
                    <div class="form-group">
                        <label for="picture" class="font-weight-bold">Featured Image</label>
                        <input type="file" name="picture" id="picture" class="form-control-file" accept="image/*">
                        <small class="text-muted">Max size: 3MB. Supported formats: JPEG, PNG, JPG, GIF</small>
                        @error('picture')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Image Preview --}}
                    <div class="form-group">
                        <div id="imagePreview" style="display: none;">
                            <label class="font-weight-bold">Preview:</label><br>
                            <img id="preview" src="" alt="Image Preview" style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save News
                </button>
                <a href="{{ route('newsbe.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from title
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    titleInput.addEventListener('input', function() {
        if (!slugInput.value || slugInput.getAttribute('data-auto') !== 'false') {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
            slugInput.setAttribute('data-auto', 'true');
        }
    });

    slugInput.addEventListener('input', function() {
        this.setAttribute('data-auto', 'false');
    });

    // Image preview
    const pictureInput = document.getElementById('picture');
    const imagePreview = document.getElementById('imagePreview');
    const preview = document.getElementById('preview');

    pictureInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });

    // Character counter for meta description
    const metaDescription = document.getElementById('meta_description');
    if (metaDescription) {
        const createCounter = function() {
            const counter = document.createElement('small');
            counter.className = 'text-muted float-right';
            counter.id = 'meta_counter';
            metaDescription.parentNode.appendChild(counter);
            return counter;
        };

        const counter = createCounter();

        metaDescription.addEventListener('input', function() {
            const length = this.value.length;
            counter.textContent = `${length}/160 characters`;
            counter.className = length > 160 ? 'text-danger float-right' : 'text-muted float-right';
        });

        // Initial count
        const length = metaDescription.value.length;
        counter.textContent = `${length}/160 characters`;
    }
});
</script>
@endsection
