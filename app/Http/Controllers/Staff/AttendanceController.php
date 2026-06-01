<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\StaffAttendance;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $staff = Staff::latest()->get();

        $search = $request->search;
        

$attendanceRecords = StaffAttendance::with('staff')

    ->when($search, function ($query) use ($search) {

        $query->where(function ($attendanceQuery) use ($search) {

            $attendanceQuery->where(
                'status',
                'like',
                "%{$search}%"
            )
            ->orWhereRaw(
    "DATE_FORMAT(date, '%Y-%m-%d') LIKE ?",
    ["%{$search}%"]
)
            ->orWhereHas(
                'staff',
                function ($staffQuery) use ($search) {

                    $staffQuery->where(
                        'name',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhereRaw(
    'UPPER(type) = ?',
    [strtoupper($search)]
);
                }
            );
        });
    })
    ->latest()
    ->get();

        $today = date('Y-m-d');

        $totalStaff = Staff::count();

        $presentToday = StaffAttendance::where(
            'date',
            $today
        )
        ->where(
            'status',
            'PRESENT'
        )
        ->count();

        $absentToday = StaffAttendance::where(
            'date',
            $today
        )
        ->where(
            'status',
            'ABSENT'
        )
        ->count();

        $holidayToday = StaffAttendance::where(
            'date',
            $today
        )
        ->where(
            'status',
            'HOLIDAY'
        )
        ->count();

        $attendancePercentage =
            $totalStaff > 0
                ? round(
                    ($presentToday / $totalStaff) * 100,
                    2
                )
                : 0;

        $monthlyReport = Staff::with(
            'attendance'
        )->get();

        $salaryReport = Staff::with(
            'attendance'
        )->get();

        return view(
            'staff.attendance',
            compact(
                'staff',
                'attendanceRecords',
                'totalStaff',
                'presentToday',
                'absentToday',
                'holidayToday',
                'attendancePercentage',
                'monthlyReport',
                'salaryReport',
                'search'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_id' => [
                'required',
                'exists:staff,id'
            ],
            'date' => [
                'required',
                'date'
            ],
            'status' => [
                'required',
                'in:PRESENT,ABSENT,HOLIDAY'
            ]
        ]);

        $alreadyMarked = StaffAttendance::where(
            'staff_id',
            $request->staff_id
        )
        ->where(
            'date',
            $request->date
        )
        ->exists();

        if ($alreadyMarked) {

            return back()->with(
                'error',
                'Attendance already marked for this staff member on this date.'
            );
        }

        if ($request->status === 'HOLIDAY') {

            $month = date('m', strtotime($request->date));
            $year = date('Y', strtotime($request->date));

            $holidayCount = StaffAttendance::where(
                'staff_id',
                $request->staff_id
            )
            ->where(
                'status',
                'HOLIDAY'
            )
            ->whereMonth(
                'date',
                $month
            )
            ->whereYear(
                'date',
                $year
            )
            ->count();

            if ($holidayCount >= 2) {

                return back()->with(
                    'error',
                    'This staff member has already used 2 holidays this month.'
                );
            }
        }

        StaffAttendance::create([
            'staff_id' => $request->staff_id,
            'date' => $request->date,
            'status' => $request->status
        ]);

        return back()->with(
            'success',
            'Attendance marked successfully.'
        );
    }

    public function update(
        Request $request,
        StaffAttendance $attendance
    )
    {
        $request->validate([

            'status' => [
                'required',
                'in:PRESENT,ABSENT,HOLIDAY'
            ]
        ]);

        $attendance->update([

            'status' => $request->status
        ]);

        return back()->with(
            'success',
            'Attendance updated successfully.'
        );
    }

    public function destroy(
        StaffAttendance $attendance
    )
    {
        $attendance->delete();

        return back()->with(
            'success',
            'Attendance record deleted successfully.'
        );
    }
}
?>
