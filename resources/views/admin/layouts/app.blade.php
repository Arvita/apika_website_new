<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin | Arvita Agus Kurniasari')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f7f2ea] text-[#1f2933] antialiased">
    <div class="min-h-screen lg:grid lg:grid-cols-[280px_1fr]">
        @include('admin.components.sidebar')

        <div class="min-w-0">
            @include('admin.components.topbar')

            <main class="p-4 sm:p-6 lg:p-8">
                @include('admin.components.flash')

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>