<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">Welcome Back</h2>
        <p class="text-slate-400 text-sm">Please enter your credentials to access your account.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-300 mb-1" />
            <x-text-input id="email" class="block mt-1 w-full premium-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" class="text-slate-300 mb-1" />

            <x-text-input id="password" class="block mt-1 w-full premium-input"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-white/10 bg-white/5 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-slate-400 font-medium">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-400 hover:text-indigo-300 transition-colors" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full premium-btn">
                {{ __('Secure Login') }}
            </button>
        </div>
        
        @if (Route::has('register'))
            <p class="mt-6 text-center text-sm text-slate-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-indigo-400 font-semibold hover:text-indigo-300 transition-colors">Sign up</a>
            </p>
        @endif
    </form>
</x-guest-layout>
