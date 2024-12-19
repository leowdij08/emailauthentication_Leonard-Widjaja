<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 bg-[#F8F9FA] dark:bg-[#1E293B] p-4 rounded-md shadow-md">
        {{ __('You are in a secure section of the application. Please verify your password to proceed.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="bg-[#F8F9FA] dark:bg-[#1E293B] p-6 rounded-md shadow-lg">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 dark:border-gray-600 dark:bg-[#334155] text-gray-700 dark:text-gray-300 rounded-md"
                          type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#B91C1C] dark:text-[#EF4444]" />
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-4">
            <x-primary-button class="bg-[#2563EB] hover:bg-[#1D4ED8] dark:bg-[#2563EB] dark:hover:bg-[#1D4ED8] text-white">
                {{ __('Confirm Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
