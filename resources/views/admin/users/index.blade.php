<x-app-layout>

    <div class="max-w-5xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-6">
            System Users
        </h1>

        @if(session('success'))

            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>

        @endif

        <table class="w-full border">

            <thead class="bg-gray-100">

                <tr>
                    <th class="border p-3">Name</th>
                    <th class="border p-3">Email</th>
                    <th class="border p-3">Role</th>
                    <th class="border p-3">Created At</th>
                </tr>

            </thead>

            <tbody>

                @foreach($users as $user)

                    <tr>
                        <td class="border p-3">
                            {{ $user->name }}
                        </td>

                        <td class="border p-3">
                            {{ $user->email }}
                        </td>

                        <td class="border p-3 capitalize">
                            {{ $user->role }}
                        </td>

                        <td class="border p-3">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</x-app-layout>