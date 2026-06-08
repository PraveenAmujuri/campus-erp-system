<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    /**
     * Mass assignable fields
     */
    protected $fillable = [

        'name',

        'type',

        'subject',

        'role',

        'salary',

        'email',

        'phone'
    ];

    /**
     * Relationship:
     * One staff member can have many attendance records
     */
    public function attendance()
    {
        return $this->hasMany(
            StaffAttendance::class
        );
    }
}