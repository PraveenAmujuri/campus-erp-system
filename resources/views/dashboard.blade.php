<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Campus ERP Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">
                        Welcome, {{ Auth::user()->name }}
                    </h3>
                    <p class="text-gray-600">
                        Manage students, staff, attendance, and notifications from one place.
                    </p>
                </div>
            </div>

            <!-- Quick Access -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

                <a href="/students"
                   class="bg-blue-600 text-white p-6 rounded-lg shadow hover:bg-blue-700 text-center">
                    <h3 class="font-bold text-lg">Students</h3>
                    <p class="text-sm mt-2">Manage Students</p>
                </a>

                <a href="/staff"
                   class="bg-green-600 text-white p-6 rounded-lg shadow hover:bg-green-700 text-center">
                    <h3 class="font-bold text-lg">Staff</h3>
                    <p class="text-sm mt-2">Manage Staff</p>
                </a>

                <a href="/students/attendance"
                   class="bg-yellow-500 text-white p-6 rounded-lg shadow hover:bg-yellow-600 text-center">
                    <h3 class="font-bold text-lg">Student Attendance</h3>
                    <p class="text-sm mt-2">Attendance Records</p>
                </a>

                <a href="/staff/attendance"
                   class="bg-purple-600 text-white p-6 rounded-lg shadow hover:bg-purple-700 text-center">
                    <h3 class="font-bold text-lg">Staff Attendance</h3>
                    <p class="text-sm mt-2">Attendance Records</p>
                </a>

                <a href="/notifications"
                   class="bg-red-600 text-white p-6 rounded-lg shadow hover:bg-red-700 text-center">
                    <h3 class="font-bold text-lg">Notifications</h3>
                    <p class="text-sm mt-2">Send Alerts</p>
                </a>

            </div>

            <!-- System Status -->
            <div class="mt-8 bg-white shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-4">
                        System Status
                    </h3>

                    <ul class="space-y-2 text-gray-700">
                        <li>✅ Authentication System Active</li>
                        <li>✅ Student Management Module</li>
                        <li>✅ Staff Management Module</li>
                        <li>✅ Student Attendance Module</li>
                        <li>✅ Staff Attendance Module</li>
                        <li>✅ Notification Module</li>
                        <li>✅ Railway MySQL Connected</li>
                        <li>✅ Render Deployment Live</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>