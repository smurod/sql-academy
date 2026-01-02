<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ ('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ ('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <div class="relative flex items-center justify-center mb-4">
            <span class="absolute bg-white px-2 text-gray-500 text-sm">или</span>
            <div class="w-full h-px bg-gray-300"></div>
        </div>

        <a href="{{ url('auth/google') }}"
           class="inline-flex items-center justify-center gap-2 bg-white text-gray-700 border border-gray-300 font-medium px-4 py-2 rounded-md">
            <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="w-5 h-5">
            Войти через Google
        </a><br>
        <br><a href="{{ url('auth/github') }}"
           class="inline-flex items-center justify-center gap-2 bg-white text-gray-700 border border-gray-300 font-medium px-4 py-2 rounded-md">
            <img src="https://www.svgrepo.com/show/361509/github-logo.svg" alt="Google" class="w-5 h-5">
            Войти через Github
        </a>
    </div>
</x-guest-layout>
