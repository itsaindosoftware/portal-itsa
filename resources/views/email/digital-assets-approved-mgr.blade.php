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
    </style>
</head>
<body>
    <div class="header">
        <h2>Digital Asset Request Approved</h2>
    </div>
    
    <div class="content">
        <p>Dear Team,</p>
        
        <p>The following digital asset request has been approved by Manager:</p>
        
        <div class="info-box">
            <p><span class="label">RFA Number:</span> {{ $digitalAsset->rfa_number }}</p>
            <p><span class="label">Date:</span> {{ $digitalAsset->date }}</p>
            <p><span class="label">Approved By:</span> {{ $approverName }}</p>
            <p><span class="label">Approval Date:</span> {{ $digitalAsset->approval_date2 }}</p>
        </div>

        @if($digitalAsset->rfa_number)
        <div class="asset-details">
            <h4>Asset Details:</h4>
            <p><span class="label">Asset Number:</span> {{ $digitalAsset->rfa_number }}</p>
            @if($digitalAsset->product_name)
            <p><span class="label">Asset Name:</span> {{ $digitalAsset->product_name }}</p>
            @endif
        </div>
        @endif

        @if($remarks && $remarks != '-')
        <div class="remarks-box">
            <h4>Approver Remarks:</h4>
            <p>{{ $remarks }}</p>
        </div>
        @endif

        <p>Please proceed with the necessary actions for this approved digital asset.</p>
        
        <p>Best regards,<br>
        Digital Asset Management System</p>
    </div>
    
    <div class="footer">
        <p>This is an automated email from the Digital Asset Management System.</p>
    </div>
</body>
</html>