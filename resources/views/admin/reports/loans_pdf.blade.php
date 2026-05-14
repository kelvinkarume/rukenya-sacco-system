<!DOCTYPE html>
<html>
<head>
    <title>Loans Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Loans Report - {{ ucfirst($month == 'all' ? 'All Months' : date('F', mktime(0, 0, 0, $month, 1))) }}</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Member Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr>
                <td>{{ $loan->id }}</td>
                <td>{{ $loan->user->name ?? 'N/A' }}</td>
                <td>KES {{ number_format($loan->amount) }}</td>
                <td>{{ $loan->status }}</td>
                <td>{{ $loan->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>