<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Perubahan Formulir DAR</title>
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
            background-color: #ff9800;
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
            border-left: 4px solid #ff9800;
            border-radius: 3px;
        }
        .data-details {
            background-color: #e3f2fd;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #2196F3;
            border-radius: 3px;
        }
        .revision-alert {
            background-color: #fff3cd;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #ff9800;
            border-radius: 3px;
            border: 1px solid #ffeaa7;
        }
        .revision-remarks {
            background-color: #ffebee;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #f44336;
            border-radius: 3px;
        }
        .action-required {
            background-color: #e8f5e8;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #4CAF50;
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
        .status-revision {
            color: #ff9800;
            font-weight: bold;
            font-size: 14px;
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
        <h2>📝 Formulir DAR Memerlukan Revisi</h2>
    </div>
    
    <div class="content">
        <p>Dear {{ $getUserReq->name ?? 'Requestor' }},</p>
        
        <div class="revision-alert">
            <h4>🔄 Form Revision Required</h4>
            <p>Formulir Document Action Request Anda memerlukan revisi dan pembaruan sebelum dapat dilanjutkan ke tahap persetujuan berikutnya.</p>
        </div>

        <div class="info-box">
            <p><span class="label">DAR Number:</span> {{ $data->number_dar ?? '-' }}</p>
            <p><span class="label">Tanggal Pengajuan Awal:</span> {{ $data->created_date ? \Carbon\Carbon::parse($data->created_date)->format('d F Y') : '-' }}</p>
            <p><span class="label">Requestor:</span> {{ $data->nik_req ?? '-' }} - {{ $getUserReq->name ?? '-' }}</p>
            <p><span class="label">Revisi Diminta Oleh:</span> {{ $approverName ?? '-' }}</p>
            <p><span class="label">Tanggal Revisi:</span> {{ now()->format('d F Y') }}</p>
            <p><span class="label">Status:</span> <span class="status-revision">⚠️ Memerlukan Revisi</span></p>
        </div>

        <div class="data-details">
            <h4>Detail Formulir Saat Ini:</h4>
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
        <div class="revision-remarks">
            <h4>📋 Catatan Revisi dari {{ $approverName ?? 'Approver' }}:</h4>
            <p style="font-style: italic; background-color: white; padding: 10px; border-radius: 5px;">
                "{{ $remarks }}"
            </p>
        </div>
        @endif

        <div class="action-required">
            <h4>🚨 Tindakan yang Diperlukan:</h4>
            <ol style="margin: 10px 0; padding-left: 20px;">
                <li><strong>Review catatan revisi</strong> di atas dengan seksama</li>
                <li><strong>Login ke Portal ITSA</strong> untuk mengakses formulir DAR Anda</li>
                <li><strong>Update formulir</strong> sesuai dengan catatan revisi yang diberikan/Upload ulang dokumen</li>
                <li><strong>Pastikan semua informasi</strong> sudah lengkap dan akurat</li>
                <li><strong>Submit ulang</strong> formulir yang telah direvisi</li>
            </ol>
        </div>

        <div class="revision-alert">
            <p><strong>⚠️ Penting:</strong></p>
            <ul style="margin: 10px 0; padding-left: 20px;">
                <li>Permintaan DAR Anda akan tetap dalam status <strong>"Pending Revision"</strong> hingga formulir yang telah direvisi disubmit ulang</li>
                <li>Mohon segera lakukan revisi untuk menghindari keterlambatan proses</li>
                <li>Jika ada pertanyaan terkait revisi, silakan hubungi approver atau tim IT Dept</li>
            </ul>
        </div>

        <div style="background-color: #e3f2fd; padding: 15px; margin: 15px 0; border-radius: 5px;">
            <p><strong>💡 Tips:</strong> Pastikan untuk membaca dengan teliti setiap poin dalam catatan revisi agar formulir dapat disetujui pada submission berikutnya.</p>
        </div>
        
        <p style="margin-top: 20px;">
            Jika Anda memerlukan bantuan lebih lanjut, jangan ragu untuk menghubungi tim IT Dept.
        </p>
        
        <p>Best regards,<br>
        <strong>PORTAL ITSA SYSTEM</strong></p>
    </div>

    <div class="footer">
        <p>Email otomatis dari sistem PORTAL ITSA - Mohon tidak membalas email ini</p>
    </div>
</body>
</html>