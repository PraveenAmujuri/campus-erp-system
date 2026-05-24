<x-app-layout>

    <div class="max-w-2xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">
            Create User
        </h1>

        <form method="POST" action="{{ route('admin.users.store') }}">

            @csrf

            <div class="mb-4">
                <label class="block mb-2">Name</label>

                <input
                    type="text"
                    name="name"
                    class="w-full border rounded px-3 py-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block mb-2">Email</label>

                <input
                    type="email"
                    name="email"
                    class="w-full border rounded px-3 py-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block mb-2">Password</label>

                <input
                    type="password"
                    name="password"
                    class="w-full border rounded px-3 py-2"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="block mb-2">
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="w-full border rounded px-3 py-2"
                    required
                >
            </div>

            <div class="mb-6">
                <label class="block mb-2">Role</label>

                <select
                    name="role"
                    class="w-full border rounded px-3 py-2"
                    required
                >
                    <option value="student">Student</option>
                    <option value="faculty">Faculty</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button
                type="submit"
                class="bg-black text-white px-5 py-2 rounded"
            >
                Create User
            </button>

        </form>

    </div>

</x-app-layout>