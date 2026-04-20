<!DOCTYPE html>
<html lang="id">

<head>
    @include('partials.head', ['title' => 'Information'])
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
</head>

<body class="bg-gray-100 font-sans">

    @include('partials.header')

    <div class="min-h-screen">

        <!-- Konten Utama -->
        <main class="py-10 mt-14">
            <div class="w-full max-w-[1120px] mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>

</body>

</html>
