<x-guest-layout>

<div class="fixed inset-0 bg-cover bg-center"
     style="background-image: url('{{ asset('images/sacco.png') }}');">
</div>

<!-- OPTIONAL DARK OVERLAY (remove if not needed) -->
<div class="fixed inset-0 bg-black/30"></div>

<!-- LOGIN CONTENT -->
<div class="relative min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md p-8 bg-white/90 backdrop-blur rounded-2xl shadow-xl z-10">

        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
            Welcome Back
        </h2>

        <x-auth-session-status class="mb-4 text-green-600" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email or Phone -->
            <div>
                <x-input-label for="login" value="Email or Phone" />
                <x-text-input id="login" class="block mt-1 w-full"
                    type="text" name="login" :value="old('login')" required autofocus />
                <x-input-error :messages="$errors->get('login')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4 relative">
                <x-input-label for="password" value="Password" />
                <x-text-input id="password" class="block mt-1 w-full pr-10"
                    type="password" name="password" required />

                <span onclick="togglePassword()" 
                      class="absolute right-3 top-9 cursor-pointer text-gray-500">👁️</span>

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between mt-4">
                <label class="flex items-center text-sm">
                    <input type="checkbox" name="remember" class="mr-2">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Buttons -->
            <div class="mt-6 space-y-3">

                <x-primary-button class="w-full justify-center">
                    Login
                </x-primary-button>

                <a href="{{ route('register') }}"
                   class="block text-center w-full border border-gray-300 p-2 rounded hover:bg-gray-100">
                    Create Account
                </a>

            </div>

        </form>

    </div>

</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>

</x-guest-layout>