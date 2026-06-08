<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Management</title>

    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100 p-10">

<div class="max-w-7xl mx-auto">

    {{-- Page Heading --}}
    <h1 class="text-3xl font-bold mb-6">

        Student Management Dashboard

    </h1>

    {{-- Success Message --}}
    @if(session('success'))

    @if ($errors->any())

    <div class="bg-red-500 text-white p-3 rounded mb-5">

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

        <div class="bg-green-500 text-white p-3 rounded mb-5">

            {{ session('success') }}

        </div>

    @endif

    {{-- Add Student Form --}}
    <div class="bg-white p-6 rounded shadow mb-8">

        <form id="studentForm"
      method="POST"
      action="/students">

            @csrf

            {{-- Admission Number --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Admission Number

                </label>

                <input id="admission_number"
       type="text"
       name="admission_number"
                       value="{{ old('admission_number') }}"
                       class="w-full border p-2 rounded"
                       required>

            </div>

            {{-- Student Name --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Student Name

                </label>

                <input id="name"
       type="text"
       name="name"
                       value="{{ old('name') }}"
                       class="w-full border p-2 rounded"
                       required>

            </div>

            {{-- Stream --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Stream

                </label>

                <select id="stream"
        name="stream"
                        class="w-full border p-2 rounded"
                        required>

                    <option value="">Select Stream</option>

                    <option value="Science">
                        Science
                    </option>

                    <option value="Arts">
                        Arts
                    </option>

                </select>

            </div>

            {{-- Course --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Course

                </label>

                <input id="course"
       type="text"
       name="course"
                       class="w-full border p-2 rounded"
                       required>

            </div>

            {{-- Semester --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Semester

                </label>

                <input id="semester"
       type="number"
       name="semester"
                       min="1"
                       max="6"
                       class="w-full border p-2 rounded"
                       required>

            </div>

            {{-- Section --}}
<div class="mb-4">

    <label class="block mb-2 font-semibold">

        Section

    </label>

    <select id="section"
            name="section"
            class="w-full border p-2 rounded"
            required>

        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>

    </select>

</div>

            {{-- Category --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Category

                </label>

                <select id="category"
        name="category"
                        class="w-full border p-2 rounded"
                        required>

                    <option value="GEN">GEN</option>
                    <option value="OBC">OBC</option>
                    <option value="SC">SC</option>
                    <option value="ST">ST</option>

                </select>

            </div>

            {{-- Email --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Email

                </label>

                <input id="email"
       type="email"
       name="email"
                       class="w-full border p-2 rounded">

            </div>

            {{-- Phone --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Phone

                </label>

                <input id="phone"
       type="text"
       name="phone"
                       class="w-full border p-2 rounded">

            </div>

            <button type="submit"
        class="bg-blue-600 text-white px-5 py-2 rounded">

    <span id="submitText">
        Add Student
    </span>

</button>

        </form>

    </div>

    {{-- Student List --}}
    <div class="bg-white p-6 rounded shadow">

<div class="flex justify-between items-center mb-4">

    <h2 class="text-2xl font-bold">

        Student List

    </h2>

    <form method="GET"
          action="/students"
          class="flex gap-2">

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

    </form>

</div>

        <table class="w-full border-collapse">

            <thead>

                <tr class="bg-gray-200">

                    <th class="border p-2 text-center">Admission No</th>
<th class="border p-2 text-center">Name</th>
<th class="border p-2 text-center">Course</th>
<th class="border p-2 text-center">Semester</th>
<th class="border p-2 text-center">Section</th>
<th class="border p-2 text-center">Category</th>
<th class="border p-2 text-center">Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse($students as $student)

                    <tr>

                        <td class="border p-2">

                            {{ $student->admission_number }}

                        </td>

                        <td class="border p-2">

                            {{ $student->name }}

                        </td>

                        <td class="border p-2">

                            {{ $student->course }}

                        </td>

                        <td class="border p-2">

    {{ $student->semester }}

</td>

<td class="border p-2">

    {{ $student->section }}

</td>

<td class="border p-2">

    {{ $student->category }}

</td>

<td class="border p-2">

    <div class="flex justify-center gap-2">

        <button
            type="button"
            onclick='fillEditForm(@json($student))'
            class="bg-yellow-500 text-white w-20 py-1 rounded">

            Edit

        </button>

        <form
            action="/students/{{ $student->id }}"
            method="POST"
            onsubmit="return confirm('Delete student?')">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="bg-red-600 text-white w-20 py-1 rounded">

                Delete

            </button>

        </form>

    </div>

</td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center p-4">

                            No students found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
<script>

function fillEditForm(student)
{
    document.getElementById('admission_number').value =
        student.admission_number;

    document.getElementById('name').value =
        student.name;

    document.getElementById('stream').value =
        student.stream;

    document.getElementById('course').value =
        student.course;

    document.getElementById('semester').value =
    student.semester;

document.getElementById('section').value =
    student.section;

document.getElementById('category').value =
    student.category;

    document.getElementById('email').value =
        student.email ?? '';

    document.getElementById('phone').value =
        student.phone ?? '';

    let form =
        document.getElementById('studentForm');

    form.action =
        '/students/' + student.id;

    let existingMethod =
        document.getElementById('methodField');

    if (!existingMethod) {

        let method =
            document.createElement('input');

        method.type = 'hidden';
        method.name = '_method';
        method.value = 'PUT';
        method.id = 'methodField';

        form.appendChild(method);
    }

    document.getElementById('submitText').innerText =
        'Update Student';

    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

</script>
</body>

</html>