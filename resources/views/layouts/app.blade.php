@include('layouts.header')
@include('layouts.nav')
@include('layouts.nav-top')
<main class="p-6 bg-gray-100 min-h-screen flex-1">
    @yield('content')
</main>
@include('layouts.footer')
