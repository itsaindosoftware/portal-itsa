<!DOCTYPE html>
<html>
<head>
    <title>Request Document Action</title>
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
        .asset-details {
            background-color: #e8f5e8;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .data-details {
            background-color: #e3f2fd;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #2196F3;
            border-radius: 3px;
        }
        .remarks-box {
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
        .transfer-from, .transfer-to {
            padding: 15px;
            border-radius: 5px;
        }
        .transfer-from {
            background-color: #e8f5e8;
            border-left: 4px solid #4CAF50;
        }
        .action-button {
            text-align: center;
            margin: 30px 0;
        }
        .action-button a {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: black;
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

        @media (max-width: 600px) {
            .transfer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
         <div class="header">
            <h2>Document Action Request - Awaiting SysDev Approval</h2>
        </div>
        
        <div class="content">
            <p>Dear SysDev Team,</p>
            
            <div class="notification-box">
                <h4>📋 Action Required</h4>
                <p>A Document Action Request requires your approval as the second level approver.</p>
            </div>

            <div class="info-box">
                <p><span class="label">DAR Number:</span> {{ $dataDar->number_dar ?? '-' }}</p>
                <p><span class="label">Date:</span> {{ $dataDar->created_date ?? '-' }}</p>
                <p><span class="label">Requestor:</span> {{ $dataDar->nik_req }}-{{ $dataDar->name }}</p>
                <p><span class="label">Status:</span> Pending SysDev Approval</p>
            </div>

            <div class="data-details">
                <h4>Document Details:</h4>
                <div class="transfer-grid">
                    <div class="transfer-from">
                        <p><span class="label">Document Name:</span><br>{{ $dataDar->name_doc ?? '-' }}</p>
                        <p><span class="label">Document Number:</span><br>{{ $dataDar->no_doc ?? '-' }}</p>
                        <p><span class="label">Qty Pages:</span><br>{{ $dataDar->qty_pages ?? '-' }}</p>
                        <p><span class="label">Rev Number Before:</span><br>{{ $dataDar->rev_no_before ?? '-' }}</p>
                        <p><span class="label">Rev Number After:</span><br>{{ $dataDar->rev_no_after ?? '-' }}</p>
                        <p><span class="label">Storage Age:</span><br>{{ $dataDar->storage_type ?? '-' }}</p>
                        <p><span class="label">Department:</span><br>{{ $dataDar->department ?? '-' }}</p>
                        <p><span class="label">Request Type:</span><br>{{ $dataDar->reqtype ?? '-' }}</p>
                        <p><span class="label">Request Description:</span><br>{{ $dataDar->request_descript ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="notification-box">
                <p><strong>Next Steps:</strong></p>
                <p>Please review the document request details above and proceed with approval or rejection through the PORTAL ITSA SYSTEM.</p>
            </div>

              <div class="action-button">
                <a href="https://192.168.1.7:9002/service" target="_blank">
                    🔍 Lihat Detail & Approve
                </a>
            </div>
            
            <p>Best regards,<br>
            PORTAL ITSA SYSTEM</p>
        </div>

    <div class="footer">
        <p>This is an automated email from the PORTAL ITSA SYSTEM.</p>
    </div>
</body>
</html>