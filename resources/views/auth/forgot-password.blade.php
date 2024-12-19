<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 bg-[#F8F9FA] dark:bg-[#1E293B] p-4 rounded-md shadow-md">
        {{ __('Trouble accessing your account? Don’t worry! Just provide your email address, and we’ll send you a link to reset your password and regain access.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" class="text-green-600 dark:text-green-400" />

    <form method="POST" action="{{ route('password.email') }}" class="bg-[#F8F9FA] dark:bg-[#1E293B] p-6 rounded-md shadow-lg">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-[#334155] text-gray-700 dark:text-gray-300 rounded-md"
                          type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#B91C1C] dark:text-[#EF4444]" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-[#2563EB] hover:bg-[#1D4ED8] dark:bg-[#2563EB] dark:hover:bg-[#1D4ED8] text-white">
                {{ __('Send Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
