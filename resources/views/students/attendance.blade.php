<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
   content="width=device-width, initial-scale=1.0">

<title>Student Attendance</title>

@vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100">

<div class="w-full max-w-screen-2xl mx-auto px-6 py-6">

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

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">


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

<div class="bg-white p-6 rounded-lg shadow-md mt-8">


<form method="GET"
      action="/students/attendance">

    



        <div class="mb-4">

    <label class="block mb-2 font-semibold">
        Academic Year
    </label>

    <select
name="year"
class="w-full border p-2 rounded">

    <option value="" {{ empty($year) ? 'selected' : '' }}>
        Select Year
    </option>

    <option value="1" {{ $year == 1 ? 'selected' : '' }}>
        1st Year
    </option>

    <option value="2" {{ $year == 2 ? 'selected' : '' }}>
        2nd Year
    </option>

    <option value="3" {{ $year == 3 ? 'selected' : '' }}>
        3rd Year
    </option>

    <option value="4" {{ $year == 4 ? 'selected' : '' }}>
        4th Year
    </option>

</select>

</div>
    <label class="block mb-2 font-semibold">
        Select Course
    </label>

    <select
    name="course"
    class="w-full border p-2 rounded">

        <option value="">
            -- Select Course --
        </option>

        @foreach($courses as $courseItem)

            <option
                value="{{ $courseItem }}"
                {{ $course == $courseItem ? 'selected' : '' }}
            >
                {{ $courseItem }}
            </option>

        @endforeach

    </select>

</div>

<div class="mb-4">

    <label class="block mb-2 font-semibold">
        Section
    </label>

    <select
    name="section"
    class="w-full border p-2 rounded">

        <option value="" {{ empty($section) ? 'selected' : '' }}>
    Select Section
</option>

        <option value="A" {{ $section == 'A' ? 'selected' : '' }}>A</option>
<option value="B" {{ $section == 'B' ? 'selected' : '' }}>B</option>
<option value="C" {{ $section == 'C' ? 'selected' : '' }}>C</option>
<option value="D" {{ $section == 'D' ? 'selected' : '' }}>D</option>
    </select>

</div>

        <button type="submit"
        class="bg-green-600 text-white px-5 py-2 rounded mb-4">

    Load Students

</button>

@if(count($students) > 0)

<div class="overflow-x-auto mt-4">

<table class="w-full border-collapse border min-w-[900px]">

    <thead>

        <tr class="bg-gray-200">

            <th class="border p-2">Admission No</th>
            <th class="border p-2">Student Name</th>
            <th class="border p-2">Semester</th>
            <th class="border p-2">Section</th>
            <th class="border p-2">Attendance Status</th>

        </tr>

    </thead>

    <tbody>

        @foreach($students as $student)

        <tr>

            <td class="border p-2">
                {{ $student->admission_number }}
            </td>

            <td class="border p-2">
                {{ $student->name }}
            </td>

            <td class="border p-2">
                {{ $student->semester }}
            </td>

            <td class="border p-2">
                {{ $student->section }}
            </td>

            <td class="border p-2">


        <select
    name="attendance[{{ $student->id }}]"
    class="w-full border rounded p-1"
>

            <option value="PRESENT">
                PRESENT
            </option>

            <option value="ABSENT">
                ABSENT
            </option>

            <option value="HOLIDAY">
                HOLIDAY
            </option>

        </select>

    

</td>

        </tr>

        @endforeach

    </tbody>

</table>
</div>
@csrf
<button
    type="submit"
    formaction="/students/attendance/bulk"
    formmethod="POST"
    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded mt-4 font-semibold"
>
    Save Attendance
</button>

@endif

</form>


</div>

<div class="bg-white p-6 rounded-lg shadow-md mt-8">


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
                placeholder="Search Name, Admission No, Course, Status..."
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
<div class="overflow-x-auto">
<table class="w-full border-collapse min-w-[1000px]">

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

                <td class="border p-2 text-center">

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

<td class="border p-2 text-center">

    <div class="flex items-center justify-center gap-3">

        <form
            method="POST"
            action="/students/attendance/{{ $record->id }}"
            class="m-0"
        >
            @csrf
@method('PUT')

<input type="hidden" name="course" value="{{ $course }}">
<input type="hidden" name="year" value="{{ $year }}">
<input type="hidden" name="section" value="{{ $section }}">

            <select
    name="status"
    onchange="this.form.submit()"
                
                class="border border-gray-300 rounded px-2 py-2 text-sm bg-white min-w-[130px]"
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
                class="bg-red-600 hover:bg-red-700 text-white h-8 px-4 rounded text-sm flex items-center justify-center"
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


</div>

<div class="bg-white p-6 rounded-lg shadow-md mt-8">

<h2 class="text-2xl font-bold mb-4">

    Monthly Attendance Report

</h2>

<div class="overflow-x-auto mt-4">
<table class="w-full border-collapse border min-w-[900px]">
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
