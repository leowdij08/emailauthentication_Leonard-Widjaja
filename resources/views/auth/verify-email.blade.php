<x-guest-layout>
    <div class="mb-4 text-sm text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 p-4 rounded-md">
        {{ __('Thank you for signing up! Before you begin, please verify your email address by clicking the link we just sent to your email. If you didn\'t receive the email, we are happy to send it again.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-700 dark:text-green-300 bg-green-100 dark:bg-green-800 p-4 rounded-md">
            {{ __('A new verification link has been sent to the email address you used during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between bg-white dark:bg-gray-900 p-4 rounded-md shadow">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button class="bg-indigo-500 hover:bg-indigo-600 dark:bg-indigo-700 dark:hover:bg-indigo-800 text-white">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
