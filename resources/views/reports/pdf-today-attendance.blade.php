<!-- resources/views/reports/pdf-today-attendance.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Attendance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
        img {
            max-width: 50px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Today's Attendance Report</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Staff ID</th>
                <th>Photo</th>
                <th>Check-in Time</th>
                <th>Check-out Time</th>
            </tr>
        </thead>
        <tbody>
            @forelse($allUsers as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->staff_id }}</td>
                    <!-- <td>
                        @if(!empty($user->userDetails->photo))
                            <img src="{{  asset('storage/app/public/employee/' . $user->userDetails->photo) }}" alt="User Photo">
                        @else
                            <i class="fas fa-user-circle" style="font-size: 50px; color: #ccc;"></i>
                        @endif
                    </td> -->
                    <td>
                    @if(!empty( $user['user_details']['photo'] ))
                        <img src="{{ asset('storage/app/public/employees/' . $user['user_details']['photo']) }}"  style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        <i class="fas fa-user-circle" style="font-size: 50px; color: #ccc;"></i> 
                    @endif
                    </td>
                    <td>
                        @if($user->attendance->isNotEmpty())
                            Present at <br>
                            {{ date('d-m-Y h:i:s a', strtotime($user->attendance->first()->created_at)) }}
                        @else
                            Absent
                        @endif
                    </td>
                    <td>
                        @if($user->attendance->isNotEmpty() && !empty($user->attendance->first()->exit_time))
                            {{ $user->attendance->first()->exit_time }}
                        @else
                            ---
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
