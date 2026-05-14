<x-guest-layout>

<!-- FULL SCREEN BACKGROUND -->
<div class="fixed inset-0 bg-cover bg-center"
     style="background-image: url('{{ asset('images/sacco.png') }}');">
</div>

<!-- OPTIONAL DARK OVERLAY (remove if you want pure image) -->
<div class="fixed inset-0 bg-black/30"></div>

<!-- CONTENT WRAPPER -->
<div class="relative min-h-screen flex items-center justify-center">

    <!-- CARD -->
    <div class="w-full max-w-xl p-8 bg-white/90 backdrop-blur rounded-2xl shadow-xl z-10">

        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
            Create Your SACCO Account
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Full Name -->
            <div>
                <x-input-label for="full_name" value="Full Name" />
                <x-text-input id="full_name" class="block mt-1 w-full"
                    type="text" name="full_name" :value="old('full_name')" required autofocus />
                <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" value="Email Address" />
                <x-text-input id="email" class="block mt-1 w-full"
                    type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-input-label for="phone_number" value="Phone Number" />
                <x-text-input id="phone_number" class="block mt-1 w-full"
                    type="text" name="phone_number" :value="old('phone_number')" required />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>

            <!-- Year -->
            <div class="mt-4">
                <x-input-label for="year_of_birth" value="Year of Birth" />
                <x-text-input id="year_of_birth" class="block mt-1 w-full"
                    type="number" name="year_of_birth"
                    max="{{ date('Y') }}" :value="old('year_of_birth')" required />
                <x-input-error :messages="$errors->get('year_of_birth')" class="mt-2" />
            </div>

            <!-- Home -->
            <div class="mt-4">
                <x-input-label for="home_place" value="Home Place" />
                <x-text-input id="home_place" class="block mt-1 w-full"
                    type="text" name="home_place" :value="old('home_place')" required />
                <x-input-error :messages="$errors->get('home_place')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4 relative">
                <x-input-label for="password" value="Password" />
                <x-text-input id="password" class="block mt-1 w-full pr-10"
                    type="password" name="password" required />

                <span onclick="togglePassword('password')" 
                      class="absolute right-3 top-9 cursor-pointer text-gray-500">👁️</span>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 relative">
                <x-input-label for="password_confirmation" value="Confirm Password" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10"
                    type="password" name="password_confirmation" required />

                <span onclick="togglePassword('password_confirmation')" 
                      class="absolute right-3 top-9 cursor-pointer text-gray-500">👁️</span>
            </div>

            <!-- Actions -->
            <div class="mt-6 space-y-3">

                <x-primary-button class="w-full justify-center">
                    Register
                </x-primary-button>

                <a href="{{ route('login') }}"
                   class="block text-center w-full border border-gray-300 p-2 rounded hover:bg-gray-100">
                    Already have an account? Login
                </a>

            </div>

        </form>

    </div>

</div>

<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>

</x-guest-layout>