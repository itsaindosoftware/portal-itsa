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
            background-color: #f44336;
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
            border-left: 4px solid #f44336;
            border-radius: 3px;
        }
        .asset-details {
            background-color: #ffebee;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .transfer-details {
            background-color: #fafafa;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #9e9e9e;
            border-radius: 3px;
        }
        .rejection-box {
            background-color: #ffebee;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #f44336;
            border-radius: 3px;
            border: 1px solid #ffcdd2;
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
            background-color: #f5f5f5;
            border-left: 4px solid #9e9e9e;
        }
        .transfer-to {
            background-color: #f5f5f5;
            border-left: 4px solid #9e9e9e;
        }
        .rejected-status {
            background-color: #f44336;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            display: inline-block;
            font-weight: bold;
            font-size: 14px;
        }
        .next-steps {
            background-color: #e3f2fd;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #2196F3;
            border-radius: 3px;
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
         <h2>❌ Digital Asset Transfer Request Rejected</h2>
    </div>
    
    <div class="content">
        <p>Dear Requestor</p>
        
          <p>We regret to inform you that your digital asset transfer request has been 
            <span class="rejected-status">REJECTED</span> by 
            {{ $roleName }}
         </p>
        
        <div class="info-box">
            <p><span class="label">RFA Number:</span> {{ $transferData->rfa_number ?? '-' }}</p>
            <p><span class="label">Date:</span> {{ $transferData->date ?? '-' }}</p>
            <p><span class="label">Rejected By:</span> {{ $approverName ?? '-' }}</p>
            {{-- <p><span class="label">Rejected Date:</span> 
                @if ($users == 'user-mgr-dept-head')
                     <p> {{ $transferData->approval_date1 ?? '-' }}</p>
                @elseif ($users == 'manager-directur')
                     <p> {{ $transferData->approval_date2 ?? '-' }}</p>
                @elseif ($users == 'user-receive-sendnotif-dept')
                     <p> {{ $transferData->approval_date3 ?? '-' }}</p>
                @elseif ($users == 'user-mgr-receive-send-notif-dept')
                     <p> {{ $transferData->approval_date4 ?? '-' }}</p>
                @elseif ($users == 'user-gm-accfinn-sendnotif')
                     <p> {{ $transferData->approval_date5 ?? '-' }}</p>
                @elseif ($users == 'user-acct-digassets')
                     <p> {{ $transferData->approval_date6 ?? '-' }}</p>
                @endif
               
            </p> --}}
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

        {{-- @if($remarks && $remarks != '-')
        <div class="remarks-box">
            <h4>Approver Remarks:</h4>
            <p>{{ $remarks }}</p>
        </div>
        @endif --}}
        <div class="rejection-box">
            <h4 style="color: #f44336; margin-top: 0;">🚫 Rejection Reason:</h4>
            @if($remarks && $remarks != '-')
                <p style="margin-bottom: 0;"><strong>{{ $remarks }}</strong></p>
            @else
                <p style="margin-bottom: 0;"><em>No specific reason provided. Please contact the reviewer for more details.</em></p>
            @endif
        </div>

        <div class="next-steps">
            <h4 style="color: #1976d2; margin-top: 0;">📋 Next Steps:</h4>
            <ul style="margin-bottom: 0;">
                <li>Review the rejection reason carefully</li>
                <li>Make necessary corrections or adjustments to your request</li>
                <li>Contact {{ $approverName ?? '-' }} if you need clarification</li>
                <li>Submit a new transfer request if the issues have been resolved</li>
                <li>Ensure all required documentation and approvals are in place before resubmission</li>
            </ul>
        </div

        <p>Please proceed with the necessary actions for this approved digital asset transfer. The asset will be transferred from <strong>{{ $transferData->department_from_name ?? '-' }}</strong> to <strong>{{ $transferData->department_to_name ?? '-' }}</strong>.</p>
        
        <p>Best regards,<br>
        PORTAL ITSA SYSTEM</p>
    </div>
    
    <div class="footer">
        <p>This is an automated email from the PORTAL ITSA SYSTEM.</p>
    </div>
</body>
</html>