<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Formulir DAR Berhasil Direvisi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 0 0 5px 5px;
            font-size: 12px;
        }
        .info-box {
            background-color: white;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #4CAF50;
            border-radius: 3px;
        }
        .data-details {
            background-color: #e3f2fd;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #2196F3;
            border-radius: 3px;
        }
        .revision-success {
            background-color: #e8f5e8;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #4CAF50;
            border-radius: 3px;
            border: 1px solid #c8e6c9;
        }
        .previous-remarks {
            background-color: #f3e5f5;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #9c27b0;
            border-radius: 3px;
        }
        .action-required {
            background-color: #fff3cd;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #ffc107;
            border-radius: 3px;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .transfer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 15px 0;
        }
        .transfer-from {
            padding: 15px;
            border-radius: 5px;
            background-color: #e8f5e8;
            border-left: 4px solid #4CAF50;
        }
        .status-updated {
            color: #4CAF50;
            font-weight: bold;
            font-size: 14px;
        }
        .revision-timeline {
            background-color: #f5f5f5;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #e0e0e0;
        }

        @media (max-width: 600px) {
            .transfer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>✅ Formulir DAR Telah Direvisi</h2>
    </div>
    
    <div class="content">
        <p>Dear Requestor,</p>
        
        <div class="revision-success">
            <h4>🔄 Form Successfully Revised</h4>
            <p>SYD telah berhasil melakukan revisi pada formulir Document Action Request dan telah mengirimkan ulang untuk persetujuan Anda.</p>
        </div>

        <div class="info-box">
            <p><span class="label">DAR Number:</span> {{ $data->number_dar ?? '-' }}</p>
            <p><span class="label">Requestor:</span> {{ $data->nik_req ?? '-' }} - {{ $getUserReq->name ?? '-' }}</p>
            <p><span class="label">Tanggal Pengajuan Awal:</span> {{ $data->created_date ? \Carbon\Carbon::parse($data->created_date)->format('d F Y') : '-' }}</p>
            <p><span class="label">Tanggal Revisi Selesai:</span> {{ $data->updated_at ? \Carbon\Carbon::parse($data->updated_at)->format('d F Y, H:i') : now()->format('d F Y, H:i') }}</p>
            <p><span class="label">Status:</span> <span class="status-updated">✅ Telah Direvisi - Menunggu Review</span></p>
        </div>

        {{-- <div class="revision-timeline">
            <h4>📋 Timeline Revisi:</h4>
            <ul style="margin: 10px 0; padding-left: 20px; list-style-type: none;">
                <li style="margin: 5px 0;">
                    <span style="color: #4CAF50;">✅</span> <strong>Pengajuan Awal:</strong> {{ $data->created_date ? \Carbon\Carbon::parse($data->created_date)->format('d F Y') : '-' }}
                </li>
                <li style="margin: 5px 0;">
                    <span style="color: #ff9800;">⚠️</span> <strong>Permintaan Revisi:</strong> oleh {{ $approverName ?? 'SysDev' }}
                </li>
                <li style="margin: 5px 0;">
                    <span style="color: #4CAF50;">✅</span> <strong>Revisi Selesai:</strong> {{ now()->format('d F Y, H:i') }}
                </li>
                <li style="margin: 5px 0;">
                    <span style="color: #2196F3;">🔍</span> <strong>Menunggu Review Ulang:</strong> SysDev Team
                </li>
            </ul>
        </div> --}}

        <div class="data-details">
            <h4>Detail Formulir yang Telah Direvisi:</h4>
            <div class="transfer-grid">
                <div class="transfer-from">
                    <p><span class="label">Nama Dokumen:</span><br>{{ $data->name_doc ?? '-' }}</p>
                    <p><span class="label">Nomor Dokumen:</span><br>{{ $data->no_doc ?? '-' }}</p>
                    <p><span class="label">Jumlah Halaman:</span><br>{{ $data->qty_pages ?? '-' }}</p>
                    <p><span class="label">No Revisi Sebelum:</span><br>{{ $data->rev_no_before ?? '-' }}</p>
                    <p><span class="label">No Revisi Sesudah:</span><br>{{ $data->rev_no_after ?? '-' }}</p>
                    <p><span class="label">Jenis Penyimpanan:</span><br>{{ $data->storage_type ?? '-' }}</p>
                    <p><span class="label">Departemen:</span><br>{{ $getDataDar->department ?? '-' }}</p>
                    <p><span class="label">Jenis Permintaan:</span><br>{{ $getDataDar->reqtype ?? '-' }}</p>
                    <p><span class="label">Deskripsi Permintaan:</span><br>{{ $getDataDar->request_descript ?? '-' }}</p>
                </div>
            </div>
        </div>

        @if($remarks && $remarks != '-')
        <div class="previous-remarks">
            <h4>📝 Catatan Revisi Sebelumnya (untuk referensi):</h4>
            <p style="font-style: italic; background-color: white; padding: 10px; border-radius: 5px;">
                "{{ $remarks }}"
            </p>
            {{-- <small style="color: #666;">
                <em>Catatan di atas adalah permintaan revisi yang telah direspon oleh requestor</em>
            </small> --}}
        </div>
        @endif

        {{-- <div class="action-required">
            <h4>🔍 Tindakan yang Diperlukan:</h4>
            <ol style="margin: 10px 0; padding-left: 20px;">
                <li><strong>Review formulir yang telah direvisi</strong> dengan detail form di atas</li>
                <li><strong>Periksa apakah semua poin revisi</strong> telah ditangani dengan baik</li>
                <li><strong>Login ke Portal ITSA</strong> untuk melakukan proses approval</li>
                <li><strong>Setujui atau berikan feedback tambahan</strong> jika masih ada yang perlu diperbaiki</li>
            </ol>
        </div> --}}
{{-- 
        <div class="revision-success">
            <p><strong>💡 Informasi:</strong></p>
            <ul style="margin: 10px 0; padding-left: 20px;">
                <li>Requestor telah merespons semua poin revisi yang diminta</li>
                <li>Form telah diperbarui dan siap untuk direview ulang</li>
                <li>Silakan melakukan approval jika semua persyaratan telah terpenuhi</li>
            </ul>
        </div> --}}

        {{-- <div style="background-color: #e1f5fe; padding: 15px; margin: 15px 0; border-radius: 5px; border-left: 4px solid #01579b;">
            <p><strong>🚀 Next Steps:</strong> Setelah Anda melakukan approval, formulir akan dilanjutkan ke tahap berikutnya dalam workflow DAR atau akan dikirimkan notifikasi completion ke requestor.</p>
        </div> --}}
        
        <p style="margin-top: 20px;">
            Terima kasih atas perhatian dan kerjasamanya dalam proses review DAR ini.
        </p>
        
        <p>Best regards,<br>
        <strong>PORTAL ITSA SYSTEM</strong></p>
    </div>

    <div class="footer">
        <p>Email otomatis dari sistem PORTAL ITSA - Mohon tidak membalas email ini</p>
    </div>
</body>
</html>