<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * Mass assignable fields
     */
    protected $fillable = [

        'admission_number',

        'name',

        'stream',

        'course',

        'semester',
        
        'section',

        'category',

        'email',

        'phone'
    ];

    /**
     * Relationship:
     * One student can have many attendance records.
     */
    public function attendance()
    {
        return $this->hasMany(
            StudentAttendance::class
        );
    }
}