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
        $course = $request->course;
$year = $request->year;
$section = $request->section;

$students = Student::query();

if ($course) {
    $students->where('course', $course);
}

if ($year) {

    switch ($year) {

        case 1:
            $students->whereIn('semester', [1,2]);
            break;

        case 2:
            $students->whereIn('semester', [3,4]);
            break;

        case 3:
            $students->whereIn('semester', [5,6]);
            break;

        case 4:
            $students->whereIn('semester', [7,8]);
            break;
    }
}

if ($section) {
    $students->where('section', $section);
}

$students = $students->get();

$courses = Student::select('course')
    ->distinct()
    ->pluck('course');

        $search = $request->search;

        $attendanceRecords = StudentAttendance::with('student')
            ->when($search, function ($query) use ($search) {

                $query->where(function ($mainQuery) use ($search) {

    $mainQuery->whereHas('student', function ($studentQuery) use ($search) {

        $studentQuery->where('name', 'like', "%{$search}%")
                     ->orWhere('admission_number', 'like', "%{$search}%")
                     ->orWhere('course', 'like', "%{$search}%");

    })
    ->orWhere('status', 'like', "%{$search}%");

});
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
        'courses',
        'course',
        'year',
        'section',
        'attendanceRecords',
        'totalStudents',
        'presentToday',
        'absentToday',
        'holidayToday',
        'attendancePercentage',
        'monthlyReport',
        'search'
    )
);  }

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

    return redirect()->to(

    '/students/attendance?' .

    http_build_query([

        'course' => $request->course,

        'year' => $request->year,

        'section' => $request->section
    ])

)->with(

    'success',
    'Attendance marked successfully.'

);
}
public function bulkStore(Request $request)
{
    foreach ($request->attendance as $studentId => $status) {

        StudentAttendance::updateOrCreate(
    [
        'student_id' => $studentId,
        'date' => date('Y-m-d')
    ],
    [
        'status' => $status
    ]
);
    }

    return back()->with(
        'success',
        'Class attendance saved successfully.'
    );
}
}
