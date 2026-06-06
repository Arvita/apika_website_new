<x-guest-layout>
    <div class="mt-10">
        <p class="text-xs font-black uppercase tracking-[0.22em] text-[#4f6f52] dark:text-[#c7d7a9]">
            Welcome back
        </p>

        <h1 class="mt-3 text-3xl font-black tracking-tight text-[#17212b] dark:text-[#f6f1e8] sm:text-4xl">
            Login Admin
        </h1>

        <p class="mt-3 max-w-md text-sm leading-7 text-[#6b6258] dark:text-[#d7cec0]/75">
            Masuk untuk mengelola konten akademik Arvita Agus Kurniasari.
        </p>
    </div>

    @if (session('status'))
        <div class="mt-6 rounded-2xl border border-[#d8e2d2] bg-[#eaf0e6] px-4 py-3 text-sm font-bold text-[#3e5d42] dark:border-white/10 dark:bg-white/10 dark:text-[#e9efe1]">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <label for="email" class="text-sm font-black text-[#17212b] dark:text-[#f6f1e8]">
                Email
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                class="mt-2 block w-full rounded-2xl border border-[#e3d8c8] bg-white/75 px-4 py-3 text-sm font-semibold text-[#17212b] outline-none transition placeholder:text-[#9b9388] focus:border-[#4f6f52] focus:ring-4 focus:ring-[#4f6f52]/10 dark:border-white/10 dark:bg-white/5 dark:text-[#f6f1e8] dark:placeholder:text-[#d7cec0]/40 dark:focus:border-[#e9efe1]"
                placeholder="admin@arvitaagusk.com"
            >

            @error('email')
                <p class="mt-2 text-sm font-semibold text-red-600 dark:text-red-300">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <div class="flex items-center justify-between gap-4">
                <label for="password" class="text-sm font-black text-[#17212b] dark:text-[#f6f1e8]">
                    Password
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-black text-[#4f6f52] transition hover:text-[#405d43] dark:text-[#c7d7a9]">
                        Lupa password?
                    </a>
                @endif
            </div>

            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="mt-2 block w-full rounded-2xl border border-[#e3d8c8] bg-white/75 px-4 py-3 text-sm font-semibold text-[#17212b] outline-none transition placeholder:text-[#9b9388] focus:border-[#4f6f52] focus:ring-4 focus:ring-[#4f6f52]/10 dark:border-white/10 dark:bg-white/5 dark:text-[#f6f1e8] dark:placeholder:text-[#d7cec0]/40 dark:focus:border-[#e9efe1]"
                placeholder="Masukkan password"
            >

            @error('password')
                <p class="mt-2 text-sm font-semibold text-red-600 dark:text-red-300">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <label class="flex items-center gap-3">
            <input
                type="checkbox"
                name="remember"
                class="h-4 w-4 rounded border-[#d7cbbd] text-[#4f6f52] focus:ring-[#4f6f52] dark:border-white/10 dark:bg-white/5"
            >

            <span class="text-sm font-semibold text-[#6b6258] dark:text-[#d7cec0]/75">
                Ingat saya
            </span>
        </label>

        <button
            type="submit"
            class="group inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-[#4f6f52] px-5 py-3.5 text-sm font-black text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-[#405d43] dark:bg-[#e9efe1] dark:text-[#151b18] dark:hover:bg-white"
        >
            Masuk Dashboard
            <span class="transition group-hover:translate-x-0.5">→</span>
        </button>
    </form>

    <div class="mt-8 rounded-2xl border border-[#e3d8c8] bg-white/45 p-4 dark:border-white/10 dark:bg-white/5">
        <p class="text-xs font-bold leading-6 text-[#6b6258] dark:text-[#d7cec0]/70">
            Halaman ini khusus untuk pengelolaan konten website akademik. Setelah login berhasil, sistem akan mengarah ke dashboard admin.
        </p>
    </div>
</x-guest-layout>