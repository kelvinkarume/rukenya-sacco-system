<!DOCTYPE html>
<html>
<head>
    <title>Overdue Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Overdue Report - {{ ucfirst($month == 'all' ? 'All Months' : date('F', mktime(0, 0, 0, $month, 1))) }}</h1>
    <table>
        <thead>
            <tr>
                <th>Member Name</th>
                <th>Loans Count</th>
                <th>Total Overdue</th>
            </tr>
        </thead>
        <tbody>
            @foreach($overdueMembers as $member)
            <tr>
                <td>{{ $member['name'] }}</td>
                <td>{{ $member['loans_count'] }}</td>
                <td>KES {{ number_format($member['total_balance']) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>