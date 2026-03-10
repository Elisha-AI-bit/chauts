<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">Create Account</h2>
        <p class="text-slate-400 text-sm">Join the Chalimbana University Timetable System today.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-slate-300 mb-1" />
            <x-text-input id="name" class="block mt-1 w-full premium-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-5">
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-300 mb-1" />
            <x-text-input id="email" class="block mt-1 w-full premium-input" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" class="text-slate-300 mb-1" />

            <x-text-input id="password" class="block mt-1 w-full premium-input"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-5">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-slate-300 mb-1" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full premium-input"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full premium-btn">
                {{ __('Create Account') }}
            </button>
        </div>

        <p class="mt-6 text-center text-sm text-slate-400">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-indigo-400 font-semibold hover:text-indigo-300 transition-colors">Log In</a>
        </p>
    </form>
</x-guest-layout>
