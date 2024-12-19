<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-[#F8F9FA] dark:bg-[#1E293B] p-6 rounded-md shadow-lg">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-[#334155] text-gray-700 dark:text-gray-300 rounded-md"
                          type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#B91C1C] dark:text-[#EF4444]" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Your Password')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-[#334155] text-gray-700 dark:text-gray-300 rounded-md"
                          type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#B91C1C] dark:text-[#EF4444]" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-[#1E293B] border-gray-300 dark:border-gray-600 text-[#2563EB] shadow-sm focus:ring-[#2563EB]" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Keep me logged in') }}</span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2563EB] dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-[#2563EB] hover:bg-[#1D4ED8] dark:bg-[#2563EB] dark:hover:bg-[#1D4ED8] text-white">
                {{ __('Sign In') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
