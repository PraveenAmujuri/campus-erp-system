<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Staff Management</title>

    @vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-6xl mx-auto">

        <h1 class="text-3xl font-bold mb-6">

            Staff Management Dashboard

        </h1>

        @if(session('success'))

            <div class="bg-green-500 text-white p-3 rounded mb-5">

                {{ session('success') }}

            </div>

        @endif

        <div class="bg-white p-6 rounded shadow mb-8">

            <form method="POST"
                  action="/staff">

                @csrf

                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Staff Name

                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full border p-2 rounded"
                           required>

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Staff Type

                    </label>

                    <select name="type"
                            class="w-full border p-2 rounded"
                            required>

                        <option value="">-- Select Type --</option>

                        <option value="TEACHING">

                            Teaching

                        </option>

                        <option value="NON_TEACHING">

                            Non-Teaching

                        </option>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Subject

                    </label>

                    <input type="text"
                           name="subject"
                           class="w-full border p-2 rounded">

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Role

                    </label>

                    <input type="text"
                           name="role"
                           class="w-full border p-2 rounded">

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Salary

                    </label>

                    <input type="number"
                           step="0.01"
                           name="salary"
                           class="w-full border p-2 rounded"
                           required>

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Email

                    </label>

                    <input type="email"
                           name="email"
                           class="w-full border p-2 rounded">

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Phone

                    </label>

                    <input type="text"
                           name="phone"
                           class="w-full border p-2 rounded">

                </div>

                <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded">

                    Add Staff

                </button>

            </form>

        </div>

        <div class="bg-white p-6 rounded shadow">

            <h2 class="text-2xl font-bold mb-4">

                Staff List

            </h2>

            <form method="GET"
                  action="/staff"
                  class="mb-4">

                <div class="flex gap-2">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Search by name, email or type"
                        class="border p-2 rounded w-80">

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded">

                        Search

                    </button>

                    <a
                        href="/staff"
                        class="bg-gray-500 text-white px-4 py-2 rounded">

                        Clear

                    </a>

                </div>

            </form>

            <table class="w-full border-collapse">

                <thead>

                    <tr class="bg-gray-200">

                        <th class="border p-2 text-left">
                            Name
                        </th>

                        <th class="border p-2 text-left">
                            Type
                        </th>

                        <th class="border p-2 text-left">
                            Subject
                        </th>

                        <th class="border p-2 text-left">
                            Role
                        </th>

                        <th class="border p-2 text-left">
                            Salary
                        </th>

                        <th class="border p-2 text-left">
                            Email
                        </th>

                        <th class="border p-2 text-left">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($staff as $member)

                        <tr>

                            <td class="border p-2">

                                {{ $member->name }}

                            </td>

                            <td class="border p-2">

                                {{ $member->type }}

                            </td>

                            <td class="border p-2">

                                {{ $member->subject ?: '-' }}

                            </td>

                            <td class="border p-2">

                                {{ $member->role ?: '-' }}

                            </td>

                            <td class="border p-2">

                                ₹ {{ $member->salary }}

                            </td>

                            <td class="border p-2">

                                {{ $member->email }}

                            </td>

                            <td class="border p-2">

    <div class="flex gap-2">

        <a href="/staff/{{ $member->id }}/edit"
           class="bg-yellow-500 text-white px-3 py-1 rounded">

            Edit

        </a>

        <form method="POST"
              action="/staff/{{ $member->id }}">

            @csrf

            @method('DELETE')

            <button
                type="submit"
                onclick="return confirm('Are you sure?')"
                class="bg-red-600 text-white px-3 py-1 rounded">

                Delete

            </button>

        </form>

    </div>

</td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="border p-4 text-center">

                                No staff records found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>