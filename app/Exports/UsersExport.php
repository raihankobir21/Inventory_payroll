<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Employee;
use Carbon\Carbon;


class UsersExport implements FromCollection, WithHeadings
// class UsersExport implements FromCollection
{

        public function collection()
    {
        return User::select('users.staff_id', 'users.name', 'users.email', 'attendances.created_at as check_in_time', 'attendances.exit_time as check_out_time')
                    ->leftJoin('attendances', 'users.id', '=', 'attendances.user_id')
                    ->get();
    }

    public function headings(): array
    {
        return [
            'Staff ID',
            'Name',
            'Email',
            'Check-in Time',
            'Check-out Time',
        ];
    }

}
