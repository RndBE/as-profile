<x-layouts.auth>
    {{-- <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 via-white to-gray-100"> --}}
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <img src="{{ asset('assets/img/CV AS.png') }}" alt="CV Arta Solusindo" class="h-16 w-auto">
            </div>

            <!-- Header -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ __('Welcome Back!') }}
                </h2>
                <p class="text-sm text-gray-500">
                    {{ __('Log in to access your dashboard and manage your system.') }}
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="text-center mb-4 text-green-600 font-medium" :status="session('status')" />

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('Email Address') }}
                    </label>
                    <flux:input
                        name="email"
                        type="email"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="email@example.com"
                        class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500"
                    />
                </div>

                <!-- Password -->
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ __('Password') }}
                    </label>
                    <flux:input
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        viewable
                        class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500"
                    />
                    @if (Route::has('password.request'))
                        <flux:link
                            class="absolute top-0 right-0 text-sm text-blue-600 hover:text-blue-800"
                            :href="route('password.request')"
                            wire:navigate
                        >
                            {{ __('Forgot password?') }}
                        </flux:link>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" />
                </div>

                <!-- Submit Button -->
                <div>
                    <flux:button
                        variant="primary"
                        type="submit"
                        class="w-full py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-all duration-200 shadow-md"
                    >
                        {{ __('Log In') }}
                    </flux:button>
                </div>
            </form>

            <!-- Divider -->
            <div class="my-6 border-t border-gray-200"></div>

            <!-- Register Info -->
            @if (Route::has('register'))
                <div class="text-center text-sm text-gray-600">
                    {{ __('Don\'t have an account?') }}
                    <flux:link :href="route('register')" wire:navigate class="text-blue-600 hover:text-blue-800 font-medium">
                        {{ __('Sign up') }}
                    </flux:link>
                </div>
            @endif
        </div>
    {{-- </div> --}}
</x-layouts.auth>
