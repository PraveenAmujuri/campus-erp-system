<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Notifications</title>

    @vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100 p-10">

<div class="max-w-6xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">
        Notification Dashboard
    </h1>

    {{-- Statistics Dashboard --}}
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">

        <div class="bg-blue-500 text-white p-4 rounded shadow">
            <h3 class="font-semibold">Total</h3>
            <p class="text-2xl font-bold">
                {{ $totalNotifications }}
            </p>
        </div>

        <div class="bg-green-500 text-white p-4 rounded shadow">
            <h3 class="font-semibold">Email</h3>
            <p class="text-2xl font-bold">
                {{ $emailCount }}
            </p>
        </div>

        <div class="bg-yellow-500 text-white p-4 rounded shadow">
            <h3 class="font-semibold">SMS</h3>
            <p class="text-2xl font-bold">
                {{ $smsCount }}
            </p>
        </div>

        <div class="bg-purple-500 text-white p-4 rounded shadow">
            <h3 class="font-semibold">WhatsApp</h3>
            <p class="text-2xl font-bold">
                {{ $whatsappCount }}
            </p>
        </div>

        <div class="bg-red-500 text-white p-4 rounded shadow">
            <h3 class="font-semibold">Failed</h3>
            <p class="text-2xl font-bold">
                {{ $failedCount }}
            </p>
        </div>

    </div>

    @if(session('success'))

        <div class="bg-green-500 text-white p-3 rounded mb-5">

            {{ session('success') }}

        </div>

    @endif

    {{-- Notification Form --}}
    <div class="bg-white p-6 rounded shadow mb-8">

        <form id="notificationForm"
      method="POST"
      action="/notifications">

    @csrf


            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Recipient

                </label>

                <input id="recipient"
       type="text"
       name="recipient"
                       value="{{ old('recipient') }}"
                       class="w-full border p-2 rounded"
                       required>

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Notification Type

                </label>

                <select id="type"
        name="type"
                        class="w-full border p-2 rounded"
                        required>

                    <option value="EMAIL">EMAIL</option>
                    <option value="SMS">SMS</option>
                    <option value="WHATSAPP">WHATSAPP</option>

                </select>

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Select Template

                </label>

                <select id="templateSelect"
                        class="w-full border p-2 rounded">

                    <option value="">
                        -- Choose Template --
                    </option>

                    @foreach($templates as $template)

                        <option value="{{ $template->message }}">

                            {{ $template->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Message

                </label>

                <textarea id="message"
                          name="message"
                          rows="5"
                          class="w-full border p-3 rounded"
                          required>{{ old('message') }}</textarea>

            </div>

            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded">

                <span id="submitText">
    Send Notification
</span>

            </button>

        </form>

    </div>

    {{-- Notification History --}}
    <div class="bg-white p-6 rounded shadow">

        <h2 class="text-2xl font-bold mb-4">

            Notification History

        </h2>

        <form method="GET"
              action="/notifications"
              class="mb-4 flex gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search recipient or message"
                class="border p-2 rounded w-80">

            <select name="type"
                    class="border p-2 rounded w-56">

                <option value="ALL"
                    {{ ($type ?? 'ALL') === 'ALL' ? 'selected' : '' }}>
                    All Notifications
                </option>

                <option value="EMAIL"
                    {{ ($type ?? '') === 'EMAIL' ? 'selected' : '' }}>
                    EMAIL
                </option>

                <option value="SMS"
                    {{ ($type ?? '') === 'SMS' ? 'selected' : '' }}>
                    SMS
                </option>

                <option value="WHATSAPP"
                    {{ ($type ?? '') === 'WHATSAPP' ? 'selected' : '' }}>
                    WHATSAPP
                </option>

            </select>

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 rounded">

                Search

            </button>

        </form>

        <table class="w-full border-collapse">

            <thead>

                <tr class="bg-gray-200">

                    <th class="border p-2">Recipient</th>
                    <th class="border p-2">Type</th>
                    <th class="border p-2">Message</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Sent At</th>
                    <th class="border p-2">Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($notifications as $notification)

                    <tr>

                        <td class="border p-2">
                            {{ $notification->recipient }}
                        </td>

                        <td class="border p-2">
                            {{ $notification->type }}
                        </td>

                        <td class="border p-2">
                            {{ $notification->message }}
                        </td>

                        <td class="border p-2">
                            {{ $notification->status }}
                        </td>

                        <td class="border p-2">
                            {{ $notification->created_at }}
                        </td>

                        

                            <td class="border p-2">

    <div class="flex justify-center gap-2">

        <button
            type="button"
            onclick='fillEditForm(@json($notification))'
            class="bg-yellow-500 text-white w-20 py-1 rounded">

            Edit

        </button>

        <form method="POST"
              action="/notifications/{{ $notification->id }}">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Delete notification?')"
                                    class="bg-red-600 text-white w-20 py-1 rounded">

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

                            No notifications found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<script>

    const templateSelect =
        document.getElementById('templateSelect');

    const messageBox =
        document.getElementById('message')

    templateSelect.addEventListener(
        'change',
        function () {

            messageBox.value = this.value;

        }
    );

</script>
<script>

function fillEditForm(notification)
{
    document.getElementById('recipient').value =
        notification.recipient;

    document.getElementById('type').value =
        notification.type;

    document.getElementById('message').value =
        notification.message;

    let form =
        document.getElementById('notificationForm');

    form.action =
        '/notifications/' + notification.id;

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
        'Update Notification';

    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

</script>
</body>

</html>