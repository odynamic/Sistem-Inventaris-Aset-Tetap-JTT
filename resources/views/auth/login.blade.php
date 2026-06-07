<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Inventaris Aset</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen relative overflow-hidden">

    {{-- BACKGROUND FOTO --}}
    <div class="absolute inset-0">
        <img src="/assets/jasamarga-bg.jpg"
             class="w-full h-full object-cover object-center brightness-[0.70]">
    </div>

    {{-- GRADIENT --}}
    <div class="absolute inset-0"
         style="
            background: linear-gradient(
                to bottom,
                rgba(15,59,137,0.50),
                rgba(21,77,166,0.45) 40%,
                rgba(0,91,172,0.45)
            );
         ">
    </div>

    {{-- MAIN CONTENT --}}
    <div class="relative z-10 h-screen flex items-center justify-center px-6">

        <div class="bg-[#0F3B89]/80 backdrop-blur-xl shadow-2xl rounded-2xl 
                    p-10 w-full max-w-md animate-fadeIn">

            {{-- LOGO --}}
            <div class="flex justify-center mb-6">
                <img src="/assets/logo_jasamarga.png" class="h-16 drop-shadow-xl">
            </div>

            {{-- TITLE --}}
            <h2 class="text-3xl font-bold text-white text-center mb-2">
                Login Sistem
            </h2>
            <p class="text-white/80 text-center text-sm leading-relaxed mb-7">
                Silakan masuk untuk mengakses Sistem Inventaris Aset Tetap di Representative Office 2 PT Jasamarga Transjawa Tol Area Palikanci.
            </p>

            {{-- ERROR MESSAGE --}}
            @if(session('error'))
                <div class="bg-red-500/90 text-white px-4 py-2 rounded-lg text-sm mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- EMAIL --}}
                <div class="mb-4">
                    <label class="text-white text-sm font-medium">Email</label>
                    <div class="relative">

                        {{-- EMAIL ICON --}}
                        <span class="absolute left-3 top-3.5 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                      d="M4.5 6.75l7.5 4.5 7.5-4.5M3.75 17.25h16.5V6.75H3.75v10.5z" />
                            </svg>
                        </span>

                        <input type="email" name="email"
                            class="mt-1 w-full pl-10 pr-4 py-3 rounded-xl bg-white/90 
                                   focus:ring-2 focus:ring-[#FFCC00] outline-none"
                            required autofocus>
                    </div>

                    @error('email')
                        <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="mb-6">
                    <label class="text-white text-sm font-medium">Password</label>

                    <div class="relative">

                        {{-- LOCK ICON --}}
                        <span class="absolute left-3 top-3.5 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                      d="M17.25 10.5V7.5a5.25 5.25 0 10-10.5 0v3M6 10.5h12v9H6v-9z"/>
                            </svg>
                        </span>

                        <input type="password" name="password" id="passwordInput"
                            class="mt-1 w-full pl-10 pr-12 py-3 rounded-xl bg-white/90 
                                   focus:ring-2 focus:ring-[#FFCC00] outline-none"
                            required>

                        {{-- SHOW/HIDE ICON --}}
                        <button type="button" id="togglePassword"
                            class="absolute right-3 top-3 text-gray-600 hover:text-black">

                            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" 
                                 class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 12c2-5 6-7.5 9.75-7.5S19.5 7 21.75 12c-2 5-6 7.5-9.75 7.5S4.25 17 2.25 12z" />
                            </svg>

                            <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                      d="M4.5 4.5l15 15M9.88 9.88A3 3 0 0114.12 14.12M6.23 6.23C4.58 7.39 3.21 9.25 2.25 12c2 5 6 7.5 9.75 7.5 1.63 0 3.19-.34 4.62-.98M17.77 17.77C19.42 16.61 20.79 14.75 21.75 12c-2-5-6-7.5-9.75-7.5-1.27 0-2.5.18-3.65.52"/>
                            </svg>

                        </button>
                    </div>

                    @error('password')
                        <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <button type="submit"
                    class="w-full bg-[#FFCC00] hover:bg-[#e6b800] text-gray-900 
                           font-semibold py-3.5 rounded-xl shadow-lg transition-all">
                    Login
                </button>

            </form>

        </div>
    </div>

    {{-- PASSWORD TOGGLE SCRIPT --}}
    <script>
        const togglePassword = document.getElementById("togglePassword");
        const passwordInput = document.getElementById("passwordInput");
        const eyeOpen = document.getElementById("eyeOpen");
        const eyeClosed = document.getElementById("eyeClosed");

        togglePassword.addEventListener("click", () => {
            const isPassword = passwordInput.type === "password";
            passwordInput.type = isPassword ? "text" : "password";

            eyeOpen.classList.toggle("hidden");
            eyeClosed.classList.toggle("hidden");
        });
    </script>

    {{-- ANIMASI --}}
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out;
        }
    </style>

</body>
</html>
