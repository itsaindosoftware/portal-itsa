@extends('layouts.app_custom')
@section('title-head','Edit News')
@section('title','Edit News')
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
    .current-image {
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 4px;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">Edit News Article</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('newsbe.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    {{-- Title --}}
                    <div class="form-group">
                        <label for="title" class="font-weight-bold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $data->title) }}" placeholder="Enter news title">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="form-group">
                        <label for="slug" class="font-weight-bold">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $data->slug) }}" placeholder="URL-friendly version of title">
                        <small class="text-muted">Leave empty to auto-generate from title</small>
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Excerpt --}}
                    <div class="form-group">
                        <label for="excerpt" class="font-weight-bold">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" class="form-control" rows="3" placeholder="Brief summary of the news (max 500 characters)">{{ old('excerpt', $data->excerpt) }}</textarea>
                        <small class="text-muted">Auto-generated from description if empty</small>
                        @error('excerpt')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label for="description" class="font-weight-bold">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="form-control" rows="8" placeholder="Enter the full news content">{{ old('description', $data->description) }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Meta Description --}}
                    <div class="form-group">
                        <label for="meta_description" class="font-weight-bold">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="form-control" rows="2" maxlength="160" placeholder="SEO meta description (max 160 characters)">{{ old('meta_description', $data->meta_description) }}</textarea>
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
                            <option value="general" {{ old('category', $data->category) == 'general' ? 'selected' : '' }}>General</option>
                            <option value="announcement" {{ old('category', $data->category) == 'announcement' ? 'selected' : '' }}>Announcement</option>
                            <option value="event" {{ old('category', $data->category) == 'event' ? 'selected' : '' }}>Event</option>
                            <option value="update" {{ old('category', $data->category) == 'update' ? 'selected' : '' }}>Update</option>
                            <option value="promotion" {{ old('category', $data->category) == 'promotion' ? 'selected' : '' }}>Promotion</option>
                            <option value="education" {{ old('category', $data->category) == 'education' ? 'selected' : '' }}>Education</option>
                        </select>
                        @error('category')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label for="status" class="font-weight-bold">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control">
                            <option value="draft" {{ old('status', $data->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="active" {{ old('status', $data->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $data->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Published At --}}
                    <div class="form-group">
                        <label for="published_at" class="font-weight-bold">Publish Date</label>
                        <input type="datetime-local" name="published_at" id="published_at" class="form-control"
                               value="{{ old('published_at', $data->published_at ? date('Y-m-d\TH:i', strtotime($data->published_at)) : '') }}">
                        <small class="text-muted">Leave empty to use current time when published</small>
                        @error('published_at')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Views Count Display --}}
                    <div class="form-group">
                        <label class="font-weight-bold">Views Count</label>
                        <div class="form-control-plaintext">
                            <span class="badge badge-info">{{ number_format($data->views_count ?? 0) }} views</span>
                        </div>
                    </div>

                    {{-- Upload Picture --}}
                    <div class="form-group">
                        <label for="picture" class="font-weight-bold">Featured Image</label><br>

                        @if($data->pic)
                            <div class="mb-3">
                                <label class="font-weight-bold d-block">Current Image:</label>
                                <img src="{{ asset('storage/news/' . $data->pic) }}" alt="Current Picture"
                                     class="current-image" style="max-width: 100%; height: auto; max-height: 200px;">
                            </div>
                        @endif

                        <input type="file" name="picture" id="picture" class="form-control-file" accept="image/*">
                        <small class="text-muted">Max size: 3MB. Supported formats: JPEG, PNG, JPG, GIF. Leave empty to keep current image.</small>
                        @error('picture')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- New Image Preview --}}
                    <div class="form-group">
                        <div id="imagePreview" style="display: none;">
                            <label class="font-weight-bold">New Image Preview:</label><br>
                            <img id="preview" src="" alt="Image Preview" style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;">
                        </div>
                    </div>

                    {{-- Metadata Info --}}
                    <div class="form-group">
                        <div class="card bg-light">
                            <div class="card-body p-3">
                                <h6 class="card-title mb-2">Article Info</h6>
                                <small class="text-muted d-block">Created by: <strong>{{ $data->created_by }}</strong></small>
                                <small class="text-muted d-block">Created at: <strong>{{ date('M d, Y H:i', strtotime($data->created_at)) }}</strong></small>
                                @if($data->updated_by)
                                <small class="text-muted d-block">Last updated by: <strong>{{ $data->updated_by }}</strong></small>
                                @endif
                                @if($data->updated_at && $data->updated_at != $data->created_at)
                                <small class="text-muted d-block">Updated at: <strong>{{ date('M d, Y H:i', strtotime($data->updated_at)) }}</strong></small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update News
                </button>
                <a href="{{ route('newsbe.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
                @if($data->slug)
                <a href="#" onclick="copyToClipboard('{{ url('/news/' . $data->slug) }}')" class="btn btn-info">
                    <i class="fas fa-link"></i> Copy URL
                </a>
                @endif
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from title (only if current slug is empty or matches old title pattern)
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const originalTitle = '{{ $data->title }}';
    const originalSlug = '{{ $data->slug }}';

    titleInput.addEventListener('input', function() {
        // Auto-generate slug only if it's empty or if it matches the original title pattern
        const titleSlug = originalTitle.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
        if (!slugInput.value || slugInput.value === originalSlug || slugInput.value === titleSlug) {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
        }
    });

    // Image preview for new upload
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

    // Character counter for excerpt
    const excerpt = document.getElementById('excerpt');
    if (excerpt) {
        const createExcerptCounter = function() {
            const counter = document.createElement('small');
            counter.className = 'text-muted float-right';
            counter.id = 'excerpt_counter';
            excerpt.parentNode.appendChild(counter);
            return counter;
        };

        const excerptCounter = createExcerptCounter();

        excerpt.addEventListener('input', function() {
            const length = this.value.length;
            excerptCounter.textContent = `${length}/500 characters`;
            excerptCounter.className = length > 500 ? 'text-danger float-right' : 'text-muted float-right';
        });

        // Initial count
        const excerptLength = excerpt.value.length;
        excerptCounter.textContent = `${excerptLength}/500 characters`;
    }
});

// Copy URL to clipboard function
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message (you can customize this)
        alert('URL copied to clipboard!');
    }, function(err) {
        console.error('Could not copy text: ', err);
        // Fallback for older browsers
        const textArea = document.createElement("textarea");
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            alert('URL copied to clipboard!');
        } catch (err) {
            console.error('Fallback: Could not copy text: ', err);
        }
        document.body.removeChild(textArea);
    });
}
</script>
@endsection
