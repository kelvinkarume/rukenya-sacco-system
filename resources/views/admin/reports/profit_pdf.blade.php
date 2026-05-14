<!DOCTYPE html>
<html>
<head>
    <title>Profit Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
    </style>
</head>
<body>
    <h1>Profit Report - {{ ucfirst($month == 'all' ? 'All Months' : date('F', mktime(0, 0, 0, $month, 1))) }}</h1>
    <p>Total Profit: KES {{ number_format($totalProfit) }}</p>
</body>
</html>