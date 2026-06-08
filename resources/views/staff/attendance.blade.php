<!DOCTYPE html>

<html lang="en">

<head>


<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Staff Attendance</title>

@vite(['resources/css/app.css'])


</head>

<body class="bg-gray-100 p-10">


<div class="max-w-6xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">

        Staff Attendance Dashboard

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

    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">

        <div class="bg-blue-500 text-white p-5 rounded shadow">

            <h3 class="text-lg font-bold">
                Total Staff
            </h3>

            <p class="text-3xl font-bold">
                {{ $totalStaff }}
            </p>

        </div>

        <div class="bg-green-500 text-white p-5 rounded shadow">

            <h3 class="text-lg font-bold">
                Present Today
            </h3>

            <p class="text-3xl font-bold">
                {{ $presentToday }}
            </p>

        </div>

        <div class="bg-red-500 text-white p-5 rounded shadow">

            <h3 class="text-lg font-bold">
                Absent Today
            </h3>

            <p class="text-3xl font-bold">
                {{ $absentToday }}
            </p>

        </div>

        <div class="bg-yellow-500 text-white p-5 rounded shadow">

            <h3 class="text-lg font-bold">
                Holiday Today
            </h3>

            <p class="text-3xl font-bold">
                {{ $holidayToday }}
            </p>

        </div>

        <div class="bg-purple-500 text-white p-5 rounded shadow">

            <h3 class="text-lg font-bold">
                Attendance %
            </h3>

            <p class="text-3xl font-bold">
                {{ $attendancePercentage }}%
            </p>

        </div>

    </div>

    <div class="bg-white p-6 rounded shadow mb-8">

        <form method="POST"
              action="/staff/attendance">

            @csrf

            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Select Staff

                </label>

                <select name="staff_id"
                        class="w-full border p-2 rounded"
                        required>

                    <option value="">

                        -- Select Staff --

                    </option>

                    @foreach($staff as $member)

                        <option value="{{ $member->id }}">

                            {{ $member->name }}
                            ({{ $member->type }})

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

            </div>

            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded">

                Mark Attendance

            </button>

        </form>

    </div>

<div class="bg-white p-6 rounded shadow mb-8">

<div class="flex justify-between items-center mb-4">

    <h2 class="text-2xl font-bold">
        Attendance History
    </h2>

    <form method="GET" action="{{ url('/staff/attendance') }}"
          class="flex gap-2">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search Staff..."
            class="border rounded px-3 py-2"
        >

        <button
            type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded"
        >
            Search
        </button>

    </form>

</div>

    <table class="w-full border-collapse">

        <thead>

            <tr class="bg-gray-200">

                <th class="border p-2 text-left">
                    Staff Name
                </th>

                <th class="border p-2 text-left">
                    Type
                </th>

                <th class="border p-2 text-left">
                    Date
                </th>

                <th class="border p-2 text-left">
                    Status
                </th>

                <th class="border p-2 text-center">
                    Actions
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($attendanceRecords as $record)

                <tr>

                    <td class="border p-2">
                        {{ $record->staff->name }}
                    </td>

                    <td class="border p-2">
                        {{ $record->staff->type }}
                    </td>

                    <td class="border p-2">
                        {{ $record->date }}
                    </td>

                    <td class="border p-2">

                        @if($record->status === 'PRESENT')

                            <span class="bg-green-500 text-white px-2 py-1 rounded text-sm">
                                PRESENT
                            </span>

                        @elseif($record->status === 'ABSENT')

                            <span class="bg-red-500 text-white px-2 py-1 rounded text-sm">
                                ABSENT
                            </span>

                        @else

                            <span class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">
                                HOLIDAY
                            </span>

                        @endif

                    </td>

                    <td class="border p-2">

                        <div class="flex items-center justify-center gap-2">

                            <form
                                method="POST"
                                action="/staff/attendance/{{ $record->id }}"
                            >
                                @csrf
                                @method('PUT')

                                <select
    name="status"
    onchange="this.form.submit()"
    class="border rounded px-2 py-1 text-sm w-28"
>
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
                                action="/staff/attendance/{{ $record->id }}"
                                onsubmit="return confirm('Delete this attendance record?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded text-sm"
                                >
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5"
                        class="border p-4 text-center">

                        No attendance records found.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

    <div class="bg-white p-6 rounded shadow mb-8">

        <h2 class="text-2xl font-bold mb-4">

            Monthly Attendance Report

        </h2>

        <table class="w-full border-collapse">

            <thead>

                <tr class="bg-gray-200">

                    <th class="border p-2 text-left">
                        Staff Name
                    </th>

                    <th class="border p-2 text-left">
                        Present
                    </th>

                    <th class="border p-2 text-left">
                        Absent
                    </th>

                    <th class="border p-2 text-left">
                        Holiday
                    </th>
                    <th class="border p-2 text-left">
                        Attendance %
                    </th>
                </tr>

            </thead>

            <tbody>

                @foreach($monthlyReport as $member)

                    <tr>

                        <td class="border p-2">

                            {{ $member->name }}

                        </td>

                       @php

    $presentCount =
        $member->attendance
            ->where('status', 'PRESENT')
            ->count();

    $absentCount =
        $member->attendance
            ->where('status', 'ABSENT')
            ->count();

    $holidayCount =
        $member->attendance
            ->where('status', 'HOLIDAY')
            ->count();

    $totalAttendance =
        $presentCount +
        $absentCount;

    $attendancePercentage =
        $totalAttendance > 0
            ? round(
                ($presentCount / $totalAttendance) * 100,
                2
            )
            : 0;

@endphp

<td class="border p-2">
    {{ $presentCount }}
</td>

<td class="border p-2">
    {{ $absentCount }}
</td>

<td class="border p-2">
    {{ $holidayCount }}
</td>

<td class="border p-2">
    {{ $attendancePercentage }}%
</td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>
    <div class="bg-white p-6 rounded shadow mt-8">

    <h2 class="text-2xl font-bold mb-4">

        Salary Calculation Report

    </h2>

    <table class="w-full border-collapse">

        <thead>

            <tr class="bg-gray-200">

                <th class="border p-2 text-left">
                    Staff Name
                </th>

                <th class="border p-2 text-left">
                    Monthly Salary
                </th>

                <th class="border p-2 text-left">
                    Present
                </th>

                <th class="border p-2 text-left">
                    Holiday
                </th>

                <th class="border p-2 text-left">
                    Payable Days
                </th>

                <th class="border p-2 text-left">
                    Payable Salary
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($salaryReport as $member)

                @php

                    $present =
                        $member->attendance
                            ->where('status', 'PRESENT')
                            ->count();

                    $holiday =
                        $member->attendance
                            ->where('status', 'HOLIDAY')
                            ->count();

                    $payableDays =
                        $present + $holiday;

                    $dailySalary =
                        $member->salary / 30;

                    $payableSalary =
                        round(
                            $dailySalary * $payableDays,
                            2
                        );

                @endphp

                <tr>

                    <td class="border p-2">

                        {{ $member->name }}

                    </td>

                    <td class="border p-2">

                        ₹ {{ number_format($member->salary, 2) }}

                    </td>

                    <td class="border p-2">

                        {{ $present }}

                    </td>

                    <td class="border p-2">

                        {{ $holiday }}

                    </td>

                    <td class="border p-2">

                        {{ $payableDays }}

                    </td>

                    <td class="border p-2 font-bold">

                        ₹ {{ number_format($payableSalary, 2) }}

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

</body>

</html>
