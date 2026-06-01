<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
   content="width=device-width, initial-scale=1.0">

<title>Student Attendance</title>

@vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100 p-10">

<div class="max-w-7xl mx-auto">

<h1 class="text-3xl font-bold mb-6">


Student Attendance Dashboard


</h1>

@if(session('success'))


<div class="bg-green-500 text-white p-3 rounded mb-5">

    {{ session('success') }}

</div>


@endif

@if(session('error'))


<div class="bg-red-500 text-white p-3 rounded mb-5">

    {{ session('error') }}

</div>


@endif

<div class="grid grid-cols-5 gap-4 mb-8">


<div class="bg-blue-500 text-white p-5 rounded">

    <h3 class="font-bold">Total Students</h3>

    <p class="text-3xl font-bold">
        {{ $totalStudents }}
    </p>

</div>

<div class="bg-green-500 text-white p-5 rounded">

    <h3 class="font-bold">Present Today</h3>

    <p class="text-3xl font-bold">
        {{ $presentToday }}
    </p>

</div>

<div class="bg-red-500 text-white p-5 rounded">

    <h3 class="font-bold">Absent Today</h3>

    <p class="text-3xl font-bold">
        {{ $absentToday }}
    </p>

</div>

<div class="bg-yellow-500 text-white p-5 rounded">

    <h3 class="font-bold">Holiday Today</h3>

    <p class="text-3xl font-bold">
        {{ $holidayToday }}
    </p>

</div>

<div class="bg-purple-500 text-white p-5 rounded">

    <h3 class="font-bold">Attendance %</h3>

    <p class="text-3xl font-bold">
        {{ $attendancePercentage }}%
    </p>

</div>


</div>

<div class="bg-white p-6 rounded shadow mb-8">


<form method="POST"
      action="/students/attendance">

    @csrf

    <div class="mb-4">

        <label class="block mb-2 font-semibold">
            Select Student
        </label>

        <select name="student_id"
                class="w-full border p-2 rounded"
                required>

            <option value="">
                -- Select Student --
            </option>

            @foreach($students as $student)

                <option value="{{ $student->id }}">

                    {{ $student->admission_number }}
                    -
                    {{ $student->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-4">

        <label class="block mb-2 font-semibold">
            Attendance Date
        </label>

        <input type="date"
               name="date"
               class="w-full border p-2 rounded"
               required>

    </div>

    <div class="mb-4">

        <label class="block mb-2 font-semibold">
            Attendance Status
        </label>

        <select name="status"
                class="w-full border p-2 rounded"
                required>

            <option value="PRESENT">PRESENT</option>
            <option value="ABSENT">ABSENT</option>
            <option value="HOLIDAY">HOLIDAY</option>

        </select>

    </div>

    <button type="submit"
            class="bg-blue-600 text-white px-5 py-2 rounded">

        Mark Attendance

    </button>

</form>


</div>

<div class="bg-white p-6 rounded shadow">


<div class="flex justify-between items-center mb-4">

    <h2 class="text-2xl font-bold">

        Attendance History

    </h2>

    <form method="GET">

        <div class="flex gap-2">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search Student..."
                class="border p-2 rounded"
            >

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded"
            >
                Search
            </button>

        </div>

    </form>

</div>

<table class="w-full border-collapse">

    <thead>

        <tr class="bg-gray-200">

            <th class="border p-2">Admission No</th>

            <th class="border p-2">Student Name</th>

            <th class="border p-2">Course</th>

            <th class="border p-2">Date</th>

            <th class="border p-2">Status</th>

            <th class="border p-2">Actions</th>

        </tr>

    </thead>

    <tbody>

        @forelse($attendanceRecords as $record)

            <tr>

                <td class="border p-2">
                    {{ $record->student->admission_number }}
                </td>

                <td class="border p-2">
                    {{ $record->student->name }}
                </td>

                <td class="border p-2">
                    {{ $record->student->course }}
                </td>

                <td class="border p-2">
                    {{ $record->date }}
                </td>

                <td class="border p-2">

                    @if($record->status === 'PRESENT')

                        <span class="bg-green-500 text-white px-3 py-1 rounded">
                            PRESENT
                        </span>

                    @elseif($record->status === 'ABSENT')

                        <span class="bg-red-500 text-white px-3 py-1 rounded">
                            ABSENT
                        </span>

                    @else

                        <span class="bg-yellow-500 text-white px-3 py-1 rounded">
                            HOLIDAY
                        </span>

                    @endif

                </td>

<td class="border p-2">

    <div class="flex items-center justify-center gap-2">

        <form
            method="POST"
            action="/students/attendance/{{ $record->id }}"
            class="m-0"
        >
            @csrf
            @method('PUT')

            <select
                name="status"
                onchange="this.form.submit()"
                class="border border-gray-300 rounded px-2 py-1 text-sm"
            >
                <option
                    value="PRESENT"
                    {{ $record->status == 'PRESENT' ? 'selected' : '' }}
                >
                    PRESENT
                </option>

                <option
                    value="ABSENT"
                    {{ $record->status == 'ABSENT' ? 'selected' : '' }}
                >
                    ABSENT
                </option>

                <option
                    value="HOLIDAY"
                    {{ $record->status == 'HOLIDAY' ? 'selected' : '' }}
                >
                    HOLIDAY
                </option>

            </select>

        </form>

        <form
            method="POST"
            action="/students/attendance/{{ $record->id }}"
            onsubmit="return confirm('Delete this attendance record?')"
            class="m-0"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm"
            >
                Delete
            </button>

        </form>

    </div>

</td>


            </tr>

        @empty

            <tr>

                <td colspan="6"
                    class="border p-4 text-center">

                    No attendance records found.

                </td>

            </tr>

        @endforelse

    </tbody>

</table>


</div>

<div class="bg-white p-6 rounded shadow mt-8">


<h2 class="text-2xl font-bold mb-4">

    Monthly Attendance Report

</h2>

<table class="w-full border-collapse">

    <thead>

        <tr class="bg-gray-200">

            <th class="border p-2 text-left">Student Name</th>

            <th class="border p-2 text-left">Present</th>

            <th class="border p-2 text-left">Absent</th>

            <th class="border p-2 text-left">Holiday</th>

        </tr>

    </thead>

    <tbody>

        @foreach($monthlyReport as $student)

            <tr>

                <td class="border p-2">
                    {{ $student->name }}
                </td>

                <td class="border p-2">
                    {{ $student->attendance->where('status','PRESENT')->count() }}
                </td>

                <td class="border p-2">
                    {{ $student->attendance->where('status','ABSENT')->count() }}
                </td>

                <td class="border p-2">
                    {{ $student->attendance->where('status','HOLIDAY')->count() }}
                </td>

            </tr>

        @endforeach

    </tbody>

</table>


</div>

</div>

</body>

</html>
