<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notifikasi Pengajuan Dokumen Action DAR - #{{ $dataDar->number_dar }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .email-container {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: rgb(15, 14, 14);
            padding: 25px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header .dar-number {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 10px;
            font-weight: bold;
            font-size: 16px;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
        }
        .notification-box {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 25px 0;
        }
        .detail-card {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #28a745;
        }
        .detail-card.secondary {
            border-left-color: #17a2b8;
        }
        .detail-item {
            margin-bottom: 15px;
        }
        .detail-item:last-child {
            margin-bottom: 0;
        }
        .label {
            font-weight: 600;
            color: #495057;
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .value {
            color: #333;
            font-size: 16px;
            font-weight: 500;
        }
        .document-details {
            background-color: #fff3cd;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #ffc107;
        }
        .approval-info {
            background-color: #d1ecf1;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #17a2b8;
        }
        .action-button {
            text-align: center;
            margin: 30px 0;
        }
        .action-button a {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            display: inline-block;
            transition: transform 0.2s;
        }
        .action-button a:hover {
            transform: translateY(-2px);
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
            border-top: 1px solid #dee2e6;
        }
        .status-badge {
            background-color: #28a745;
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
        }
        .priority-high {
            background-color: #dc3545;
        }
        .priority-medium {
            background-color: #ffc107;
            color: #333;
        }
        @media (max-width: 768px) {
            .details-grid {
                grid-template-columns: 1fr;
            }
            .email-container {
                margin: 10px;
                border-radius: 5px;
            }
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>📋 Notifikasi Pengajuan Dokumen DAR</h1>
            <div class="dar-number">#{{ $dataDar->number_dar }}</div>
        </div>
        
        <div class="content">
            <div class="greeting">
                <p>Halo <strong>Manager</strong>,</p>
            </div>
            
            <div class="notification-box">
                <p style="margin: 0; font-size: 16px;">
                    <strong>🔔 Anda telah menerima notifikasi pengajuan dokumen action DAR yang memerlukan persetujuan Anda.</strong>
                </p>
            </div>
            
          <div class="details-grid">
                <div class="detail-card">
                    <h4 style="margin-top: 0; color: #28a745;">📄 Informasi Dokumen</h4>
                    <div class="detail-item">
                        <span class="label">Nomor DAR</span>
                        <span class="value">{{ $dataDar->number_dar }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Nama Dokumen</span>
                        <span class="value">{{ $dataDar->name_doc ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Nomor Dokumen</span>
                        <span class="value">{{ $dataDar->no_doc ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Jumlah Halaman</span>
                        <span class="value">{{ $dataDar->qty_pages ?? 'N/A' }} halaman</span>
                    </div>
                </div>
                
                <div class="detail-card secondary">
                    <h4 style="margin-top: 0; color: #17a2b8;">👤 Informasi Pengaju</h4>
                    <div class="detail-item">
                        <span class="label">Nama Pengaju</span>
                        <span class="value">{{ $usersReq->name ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">NIK</span>
                        <span class="value">{{ $dataDar->nik_req ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Tanggal Pengajuan</span>
                        <span class="value">{{ $dataDar->created_date ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Status</span>
                        <span class="status-badge">Menunggu Persetujuan</span>
                    </div>
                </div>
            </div>
            
            @if($dataDar->reason)
            <div class="document-details">
                <h4 style="margin-top: 0; color: #856404;">📝 Alasan Pengajuan</h4>
                <p style="margin: 0; font-style: italic; color: #6c757d;">{{ $dataDar->reason }}</p>
            </div>
            @endif
            
            <div class="approval-info">
                <h4 style="margin-top: 0; color: #0c5460;">⚡ Detail Persetujuan</h4>
                <div class="details-grid" style="margin: 15px 0;">
                    <div style="background: none; padding: 0;">
                        <div class="detail-item">
                            <span class="label">Approver yang Diperlukan</span>
                            <span class="value">{{ $approverName ?? 'Manager' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="label">Role</span>
                            <span class="value">{{ $roleName ?? 'Manager' }}</span>
                        </div>
                    </div>
                 <div style="background: none; padding: 0;">
                        <div class="detail-item">
                            <span class="label">Tanggal Persetujuan</span>
                            <span class="value">{{ $approvalDate ?? 'Pending'}}</span> 
                        </div>
                        @if($dataDar->storage_type)
                        <div class="detail-item">
                            <span class="label">Tipe Penyimpanan</span>
                            <span class="value">{{ ucfirst($dataDar->storage_type) }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                
                @if($remarks && $remarks !== '-')
                <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #bee5eb;">
                    <span class="label">Catatan Tambahan</span>
                    <p style="margin: 5px 0 0 0; color: #0c5460; font-weight: 500;">{{ $remarks }}</p>
                </div>
                @endif
            </div> 
            
            <div class="action-button">
                {{-- <a href="{{ url('/dar/approval/' . $dataDar->id) }}" target="_blank">
                    🔍 Lihat Detail & Approve
                </a> --}}
            </div>
            
            <div style="background-color: #e9ecef; padding: 15px; border-radius: 5px; margin-top: 20px;">
                <p style="margin: 0; font-size: 14px; color: #6c757d;">
                    <strong>Catatan:</strong> Silakan login ke sistem untuk melihat detail lengkap dokumen dan melakukan persetujuan. 
                    Dokumen ini memerlukan tindakan dari Anda dalam waktu yang sesuai dengan kebijakan perusahaan.
                </p>
            </div>
        </div>
        
        <div class="footer">
            <p style="margin: 0;">
                Email ini dikirim secara otomatis dari <strong>Sistem Manajemen Dokumen DAR</strong><br>
                Jangan balas email ini. Untuk pertanyaan, hubungi administrator sistem.
            </p>
        </div>
    </div>
</body>
</html>