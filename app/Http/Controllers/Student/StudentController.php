<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

use App\Http\Requests\Student\StoreStudentRequest;

use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display student dashboard.
     */
public function index()
{
    $search = request('search');

    $students = Student::when(
        $search,
        function ($query) use ($search) {

            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('admission_number', 'like', "%{$search}%")
                  ->orWhere('course', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
        }
    )
    ->latest()
    ->get();

    return view(
        'students.index',
        compact(
            'students',
            'search'
        )
    );
}

    /**
     * Store a new student.
     */
    public function store(
        StoreStudentRequest $request
    ) {

        Student::create([

            'admission_number' =>
                $request->admission_number,

            'name' =>
                $request->name,

            'stream' =>
                $request->stream,

            'course' =>
                $request->course,

            'semester' =>
                $request->semester,

            'category' =>
                $request->category,

            'email' =>
                $request->email,

            'phone' =>
                $request->phone
        ]);

        return back()->with(
            'success',
            'Student added successfully.'
        );
    }
    public function update(
    StoreStudentRequest $request,
    Student $student
) {

    $student->update([

        'admission_number' =>
            $request->admission_number,

        'name' =>
            $request->name,

        'stream' =>
            $request->stream,

        'course' =>
            $request->course,

        'semester' =>
            $request->semester,

        'category' =>
            $request->category,

        'email' =>
            $request->email,

        'phone' =>
            $request->phone
    ]);

    return back()->with(
        'success',
        'Student updated successfully.'
    );
}

public function destroy(
    Student $student
) {

    $student->delete();

    return back()->with(
        'success',
        'Student deleted successfully.'
    );
}
}