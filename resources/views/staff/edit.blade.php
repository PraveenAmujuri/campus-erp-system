<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Staff</title>

    @vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-4xl mx-auto">

        @if(session('success'))

            <div class="bg-green-500 text-white p-3 rounded mb-5">

                {{ session('success') }}

            </div>

        @endif

        <div class="bg-white p-6 rounded shadow">

            <h1 class="text-3xl font-bold mb-6">

                Edit Staff Member

            </h1>

            <form method="POST"
                  action="/staff/{{ $staff->id }}">

                @csrf

                @method('PUT')

                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Staff Name

                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name', $staff->name) }}"
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

                        <option value="TEACHING"
                            {{ $staff->type === 'TEACHING' ? 'selected' : '' }}>

                            Teaching

                        </option>

                        <option value="NON_TEACHING"
                            {{ $staff->type === 'NON_TEACHING' ? 'selected' : '' }}>

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
                           value="{{ old('subject', $staff->subject) }}"
                           class="w-full border p-2 rounded">

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Role

                    </label>

                    <input type="text"
                           name="role"
                           value="{{ old('role', $staff->role) }}"
                           class="w-full border p-2 rounded">

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Salary

                    </label>

                    <input type="number"
                           step="0.01"
                           name="salary"
                           value="{{ old('salary', $staff->salary) }}"
                           class="w-full border p-2 rounded"
                           required>

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Email

                    </label>

                    <input type="email"
                           name="email"
                           value="{{ old('email', $staff->email) }}"
                           class="w-full border p-2 rounded">

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Phone

                    </label>

                    <input type="text"
                           name="phone"
                           value="{{ old('phone', $staff->phone) }}"
                           class="w-full border p-2 rounded">

                </div>

                <div class="flex gap-3">

                    <button type="submit"
                            class="bg-blue-600 text-white px-5 py-2 rounded">

                        Update Staff

                    </button>

                    <a href="/staff"
                       class="bg-gray-500 text-white px-5 py-2 rounded">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>