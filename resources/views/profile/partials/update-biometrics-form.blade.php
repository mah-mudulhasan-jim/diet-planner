<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Biometric Profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your height, weight, and current fitness goal. Changing your weight will automatically update your dashboard chart.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="height_cm" :value="__('Height (cm)')" />
            <x-text-input id="height_cm" name="height_cm" type="number" class="mt-1 block w-full" :value="old('height_cm', $user->height_cm)" required />
            <x-input-error class="mt-2" :messages="$errors->get('height_cm')" />
        </div>

        <div>
            <x-input-label for="current_weight_kg" :value="__('Current Weight (kg)')" />
            <x-text-input id="current_weight_kg" name="current_weight_kg" type="number" step="0.1" class="mt-1 block w-full" :value="old('current_weight_kg', $user->current_weight_kg)" required />
            <x-input-error class="mt-2" :messages="$errors->get('current_weight_kg')" />
        </div>

        <div>
            <x-input-label for="goal_type" :value="__('Primary Goal')" />
            <select id="goal_type" name="goal_type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="lose" {{ $user->goal_type === 'lose' ? 'selected' : '' }}>Lose Weight</option>
                <option value="maintain" {{ $user->goal_type === 'maintain' ? 'selected' : '' }}>Maintain Weight</option>
                <option value="gain" {{ $user->goal_type === 'gain' ? 'selected' : '' }}>Gain Weight</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('goal_type')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>