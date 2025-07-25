<x-guest-layout>
    <div class="gradient-bg min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden fade-in">
            <!-- Header -->
            <div class="bg-gradient-to-r from-[#ff2626] to-[#ff6969] text-center p-8"> {{-- Updated to red gradient --}}
                <img src="{{ asset($company->company_logo ?? 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png') }}"
                    alt="Company Logo" class="w-16 h-16 mx-auto mb-4 rounded-full bg-white/20 p-2">
                <h3 class="text-white text-2xl font-bold">{{ $company->system_title ?? 'HRMS Portal' }}</h3>
                <p class="text-white text-sm mt-2">{{ $company->company_description ?? 'Secure Employee Login' }}</p>
            </div>

            <!-- Login Form -->
            <div class="p-8">
                <!-- Show Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-4 focus:ring-red-300 outline-none transition-all">
                        {{-- Updated focus ring color --}}
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:ring-4 focus:ring-red-300 outline-none transition-all">
                        {{-- Updated focus ring color --}}
                        <span id="togglePassword" class="absolute right-4 top-11 text-gray-500 cursor-pointer">
                            <i class="bi bi-eye-slash" id="toggleIcon"></i>
                        </span>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-red-600 rounded">
                            {{-- Updated checkbox color --}}
                            <span>Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-red-600 hover:underline">Forgot
                                Password?</a> {{-- Updated link color --}}
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full py-3 bg-gradient-to-r from-[#ff2626] to-[#ff6969] hover:from-[#ff6969] hover:to-[#ff2626] text-white rounded-xl font-semibold shadow-lg hover:scale-105 transition-all duration-200">
                        {{-- Updated to red gradient button --}}
                        Login
                    </button>

                    <!-- Google Login -->
                    @if (Route::has('google.auth'))
                        <button type="button" onclick="window.location.href='{{ route('google.auth') }}'"
                            class="w-full py-3 border border-gray-300 rounded-xl flex items-center justify-center gap-3 hover:bg-gray-50 transition-all">
                            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg"
                                class="w-5 h-5">
                            Sign in with Google
                        </button>
                    @endif
                    @if (Route::has('register'))
                        <p class="text-center text-gray-600 text-sm">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-red-600 hover:underline">Register</a>
                            {{-- Updated link color --}}
                        </p>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #ff2626, #ff6969, #ff2626);
            /* Updated to red gradient */
            background-size: 300% 300%;
            animation: gradientMove 8s ease infinite;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
        }
    </style>


</x-guest-layout>
