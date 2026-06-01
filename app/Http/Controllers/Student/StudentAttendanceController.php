<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    /**
     * Display attendance dashboard.
     */
    public function index(Request $request)
    {
        $students = Student::latest()->get();

        $search = $request->search;

        $attendanceRecords = StudentAttendance::with('student')
            ->when($search, function ($query) use ($search) {

                $query->whereHas(
                    'student',
                    function ($studentQuery) use ($search) {

                        $studentQuery->where(
                            'name',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'admission_number',
                            'like',
                            "%{$search}%"
                        );
                    }
                );
            })
            ->latest()
            ->get();

        $today = date('Y-m-d');

        $totalStudents = Student::count();

        $presentToday = StudentAttendance::where(
            'date',
            $today
        )
        ->where(
            'status',
            'PRESENT'
        )
        ->count();

        $absentToday = StudentAttendance::where(
            'date',
            $today
        )
        ->where(
            'status',
            'ABSENT'
        )
        ->count();

        $holidayToday = StudentAttendance::where(
            'date',
            $today
        )
        ->where(
            'status',
            'HOLIDAY'
        )
        ->count();

        $attendancePercentage =
            $totalStudents > 0
                ? round(
                    ($presentToday / $totalStudents) * 100,
                    2
                )
                : 0;

        $monthlyReport = Student::with(
            'attendance'
        )->get();

        return view(
            'students.attendance',
            compact(
                'students',
                'attendanceRecords',
                'totalStudents',
                'presentToday',
                'absentToday',
                'holidayToday',
                'attendancePercentage',
                'monthlyReport',
                'search'
            )
        );
    }

    /**
     * Store attendance record.
     */
    public function store(Request $request)
    {
        $request->validate([

            'student_id' => [
                'required',
                'exists:students,id'
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

        $alreadyMarked =
            StudentAttendance::where(
                'student_id',
                $request->student_id
            )
            ->where(
                'date',
                $request->date
            )
            ->exists();

        if ($alreadyMarked) {

            return back()->with(
                'error',
                'Attendance already marked for this student on this date.'
            );
        }

        StudentAttendance::create([

            'student_id' => $request->student_id,

            'date' => $request->date,

            'status' => $request->status
        ]);

        return back()->with(
            'success',
            'Attendance marked successfully.'
        );
    }

    /**
     * Delete attendance record.
     */
    public function destroy(
        StudentAttendance $attendance
    )
    {
        $attendance->delete();

        return back()->with(
            'success',
            'Attendance record deleted successfully.'
        );
    }
    /**
 * Update attendance record.
 */
public function update(
    Request $request,
    StudentAttendance $attendance
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
}
