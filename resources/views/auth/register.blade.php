<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="height_cm" :value="__('Height (cm)')" />
            <x-text-input id="height_cm" class="block mt-1 w-full" type="number" name="height_cm" :value="old('height_cm')" required autocomplete="height_cm" />
            <x-input-error :messages="$errors->get('height_cm')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="current_weight_kg" :value="__('Current Weight (kg)')" />
            <x-text-input id="current_weight_kg" class="block mt-1 w-full" type="number" step="0.1" name="current_weight_kg" :value="old('current_weight_kg')" required autocomplete="current_weight_kg" />
            <x-input-error :messages="$errors->get('current_weight_kg')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="goal_type" :value="__('Primary Goal')" />
            <select id="goal_type" name="goal_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="lose">Lose Weight</option>
                <option value="maintain" selected>Maintain Weight</option>
                <option value="gain">Gain Muscle</option>
            </select>
            <x-input-error :messages="$errors->get('goal_type')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
