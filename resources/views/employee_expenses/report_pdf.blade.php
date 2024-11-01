<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Date-wise Expenses Report</h2>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Staff ID</th>
                <th>Purpose</th>
                <th>Amount</th>
                <th>Remaining Balance</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->user->name }}</td>
                <td>{{ $expense->staff_id }}</td>
                <td>{{ $expense->purpose }}</td>
                <td>{{ $expense->expense_amount }}</td>
                <td>{{ $expense->remain_balance }}</td>
                <td>{{ $expense->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
