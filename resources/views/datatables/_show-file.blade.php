@if($data->file)
    @php
        $fileName = basename($data->file);
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $iconClass = match($extension) {
            'pdf' => 'fas fa-file-pdf text-danger',
            'doc', 'docx' => 'fas fa-file-word text-primary',
            'xls', 'xlsx' => 'fas fa-file-excel text-success',
            'jpg', 'jpeg', 'png', 'gif' => 'fas fa-file-image text-warning',
            'zip', 'rar' => 'fas fa-file-archive text-info',
            'txt' => 'fas fa-file-alt text-secondary',
            default => 'fas fa-file text-secondary'
        };

        // Jika ingin menghilangkan timestamp dari nama file (format: timestamp_namafile.ext)
        $cleanFileName = preg_replace('/^\d+_/', '', $fileName);
    @endphp

    {{-- <a href="{{ asset('storage/' . $data->file) }}"  class="text-decoration-none" style="text-decoration:none"> --}}
        <i class="{{ $iconClass }} me-2"></i> {{ $cleanFileName }}
    {{-- </a> --}}
@else
    <span class="text-muted">
        <i class="fas fa-times-circle me-1"></i>No file
    </span>
@endif
