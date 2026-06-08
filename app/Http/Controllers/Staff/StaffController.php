<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\StoreStaffRequest;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $search = request('search');

        $staff = Staff::query();

        if ($search) {

            $staff->where(function ($query) use ($search) {

                $query->where(
                    'name',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'email',
                    'like',
                    "%{$search}%"
                );

                if (
                    strtoupper($search) === 'TEACHING'
                    ||
                    strtoupper($search) === 'NON_TEACHING'
                ) {

                    $query->orWhere(
                        'type',
                        strtoupper($search)
                    );

                } else {

                    $query->orWhere(
                        'type',
                        'like',
                        "%{$search}%"
                    );

                }

            });

        }

        $staff = $staff
            ->latest()
            ->get();

        return view(
            'staff.index',
            compact(
                'staff',
                'search'
            )
        );
    }

    public function store(
        StoreStaffRequest $request
    ) {

        Staff::create([

            'name' => $request->name,

            'type' => $request->type,

            'subject' => $request->subject,

            'role' => $request->role,

            'salary' => $request->salary,

            'email' => $request->email,

            'phone' => $request->phone
        ]);

        return back()->with(
            'success',
            'Staff member added successfully.'
        );
    }

    public function edit(
        Staff $staff
    ) {
        return view(
            'staff.edit',
            compact('staff')
        );
    }

    public function update(
        StoreStaffRequest $request,
        Staff $staff
    ) {

        $staff->update([

            'name' => $request->name,

            'type' => $request->type,

            'subject' => $request->subject,

            'role' => $request->role,

            'salary' => $request->salary,

            'email' => $request->email,

            'phone' => $request->phone
        ]);

        return redirect('/staff')->with(
            'success',
            'Staff member updated successfully.'
        );
    }

    public function destroy(
        Staff $staff
    ) {

        $staff->delete();

        return redirect('/staff')->with(
            'success',
            'Staff member deleted successfully.'
        );
    }
}