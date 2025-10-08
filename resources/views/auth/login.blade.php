<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-hall-manager-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Role Selection -->
            <!-- Removed role selection buttons as per user request -->

            <div>
                <x-label for="email" value="{{ __('Email Address') }}" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <x-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="maya@gmail.com" />
                </div>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <x-input id="password" class="block mt-1 w-full pl-10" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" style="background: linear-gradient(135deg, #9333ea 0%, #3b82f6 100%); color: white; padding: 12px 16px; border-radius: 8px; border: none; width: 100%; font-weight: 500; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    {{ __('Sign In') }}
                </button>
            </div>
        </form>

        <div class="mt-4 flex justify-center items-center space-x-2">
            <span class="text-gray-700">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Register here</a>
        </div>
    </x-authentication-card>
</x-guest-layout>
