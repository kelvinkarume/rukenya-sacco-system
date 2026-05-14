<!DOCTYPE html>
<html>
<head>
    <title>Repayments Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Repayments Report - {{ ucfirst($month == 'all' ? 'All Months' : date('F', mktime(0, 0, 0, $month, 1))) }}</h1>
    <table>
        <thead>
            <tr>
                <th>Member Name</th>
                <th>Loan ID</th>
                <th>Amount</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repayments as $repayment)
            <tr>
                <td>{{ $repayment->user->name ?? 'N/A' }}</td>
                <td>{{ $repayment->loan_id }}</td>
                <td>KES {{ number_format($repayment->amount) }}</td>
                <td>{{ $repayment->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>