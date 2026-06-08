<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    /**
     * Custom table name
     */
    protected $table = 'student_attendance';

    /**
     * Mass assignable fields
     */
    protected $fillable = [

        'student_id',

        'date',

        'status'
    ];

    /**
     * Relationship:
     * Attendance record belongs to one student.
     */
    public function student()
    {
        return $this->belongsTo(
            Student::class
        );
    }
}