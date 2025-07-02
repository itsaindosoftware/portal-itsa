<!DOCTYPE html>
<html>
<head>
    <title>Digital Asset Approved</title>
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
        .transfer-details {
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
            background-color: #ffebee;
            border-left: 4px solid #f44336;
        }
        .transfer-to {
            background-color: #e8f5e8;
            border-left: 4px solid #4CAF50;
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
        <h2>Digital Asset Transfer Notification Request Approved</h2>
    </div>
    
    <div class="content">
        <p>Dear Team,</p>
        
        <p>The following digital asset transfer request has been approved by Dept Head:</p>
        
        <div class="info-box">
            <p><span class="label">RFA Number:</span> {{ $transferData->rfa_number ?? '-' }}</p>
            <p><span class="label">Date:</span> {{ $transferData->date ?? '-' }}</p>
            <p><span class="label">Approved By:</span> {{ $approverName ?? '-' }}</p>
            <p><span class="label">Approval Date:</span> {{ $transferData->approval_date1 ?? '-' }}</p>
            <p><span class="label">Transfer Ref No. ERP:</span> {{ $transferData->to_tf_fer_no_erp ?? '-' }}</p>
            <p><span class="label">Effective Date:</span> {{ $transferData->to_effective_date ?? '-' }}</p>
        </div>

        @if($transferData->rfa_number)
        <div class="asset-details">
            <h4>Asset Details:</h4>
            <p><span class="label">Asset Number:</span> {{ $transferData->rfa_number }}</p>
            <p><span class="label">IO Number:</span> {{ $transferData->io_no ?? '-' }}</p>
            @if($transferData->product_name)
            <p><span class="label">Asset Name:</span> {{ $transferData->product_name }}</p>
            @endif
            <p><span class="label">Quantity:</span> {{ $transferData->from_qty ?? '1 unit(s)' }}</p>
        </div>
        @endif

        <div class="transfer-details">
            <h4>Transfer Details:</h4>
            <div class="transfer-grid">
                <div class="transfer-from">
                    <h5 style="margin-top: 0; color: #f44336;">📤 Transfer FROM</h5>
                    <p><span class="label">Transferring Department:</span><br>{{ $transferData->department_from_name ?? '-' }}</p>
                    <p><span class="label">Cost Center:</span><br>{{ $transferData->from_cost_center_code ?? '-' }} - {{ $transferData->from_cost_center_name ?? '-' }}</p>
                    <p><span class="label">Location:</span><br>{{ $transferData->loc_from ?? '-' }}</p>
                    <p><span class="label">PIC Name:</span><br>{{ $transferData->requestor_name ?? '-' }}</p>
                </div>
                
                <div class="transfer-to">
                    <h5 style="margin-top: 0; color: #4CAF50;">📥 Transfer TO</h5>
                    <p><span class="label">Receiving Department:</span><br>{{ $transferData->department_to_name ?? '-' }}</p>
                    <p><span class="label">New Cost Center:</span><br>{{ $transferData->to_cost_center_code ?? '-' }} - {{ $transferData->to_cost_center_name ?? '6003009 - Mold MTN' }}</p>
                    <p><span class="label">New Location:</span><br>{{ $transferData->loc_to ?? '-' }}</p>
                    <p><span class="label">PIC Name:</span><br>{{ $transferData->to_pic_name ?? '-' }}</p>
                </div>
            </div>
        </div>

        @if($remarks && $remarks != '-')
        <div class="remarks-box">
            <h4>Approver Remarks:</h4>
            <p>{{ $remarks }}</p>
        </div>
        @endif

        <p>Please proceed with the necessary actions for this approved digital asset transfer. The asset will be transferred from <strong>{{ $transferData->department_from_name ?? '-' }}</strong> to <strong>{{ $transferData->department_to_name ?? '-' }}</strong>.</p>
        
        <p>Best regards,<br>
        PORTAL ITSA SYSTEM</p>
    </div>
    
    <div class="footer">
        <p>This is an automated email from the PORTAL ITSA SYSTEM.</p>
    </div>
</body>
</html>