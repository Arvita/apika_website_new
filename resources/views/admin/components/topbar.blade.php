<header class="sticky top-0 z-40 border-b border-[#e3d8c8] bg-[#f7f2ea]/85 px-4 py-4 backdrop-blur-xl sm:px-6 lg:px-8">
    <div class="flex items-center justify-between gap-4">
        <div>
            <p class="text-xs font-black uppercase tracking-[0.2em] text-[#4f6f52]">
                Admin Panel
            </p>
            <h1 class="text-xl font-black tracking-tight">
                @yield('page_title', 'Dashboard')
            </h1>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" target="_blank" class="rounded-full border border-[#e3d8c8] bg-[#fffaf2] px-4 py-2 text-sm font-bold">
                View Site
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="rounded-full bg-[#4f6f52] px-4 py-2 text-sm font-bold text-white">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>