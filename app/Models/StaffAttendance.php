<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffAttendance extends Model
{
        /**
     * Custom table name
     */
    protected $table = 'staff_attendance';
    /**
     * Mass assignable fields
     */
    protected $fillable = [

        'staff_id',

        'date',

        'status'
    ];

    /**
     * Relationship:
     * Attendance record belongs to one staff member
     */
    public function staff()
    {
        return $this->belongsTo(
            Staff::class
        );
    }
}