
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register | ChikondiCare</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#F3F4F8] flex items-center justify-center p-4 sm:p-8">

    <main class="w-full max-w-6xl overflow-hidden rounded-3xl bg-white
                 shadow-[0_20px_70px_rgba(30,40,90,0.12)]">

        <div class="grid min-h-[650px] grid-cols-1 lg:grid-cols-2">

            <!-- LEFT PANEL -->
            <section class="relative hidden overflow-hidden bg-gradient-to-br
                            from-[#ffff] via-[#fff] to-[#fff]
                            p-0 text-white lg:flex lg:flex-col lg:justify-center z-10 h-full w-full flex flex-col items-center">


                <!-- Main message -->
                <div class="relative ">
                  

                    <!-- Illustration -->
                    <div class=" ">
                        <img
                            src="{{ asset('images/login-illustration.png') }}"
                            alt="Healthcare administrator working at a computer"
                            class="h-full w-full object-contain "
                        >
                    </div>
                </div>

                <!-- <p class="relative z-10 text-sm text-white/70">
                    © {{ date('Y') }} ChikondiCare. All rights reserved.
                </p> -->

            </section>

            <!-- RIGHT PANEL -->
            <section class="flex items-center justify-center px-6 py-12 sm:px-12 lg:px-14">

                <div class="w-full max-w-md">

                    <!-- Mobile branding -->
                    <div class="mb-10 flex items-center gap-3 lg:hidden">
                        <div class="flex h-11 w-11 items-center justify-center
                                    rounded-xl bg-[#6475E8] text-xl font-bold text-white">
                            C
                        </div>

                        <span class="text-2xl font-bold text-gray-900">
                            ChikondiCare
                        </span>
                    </div>

                    <!-- Logo -->
                    <!-- <div class="mb-7 flex h-14 w-14 items-center justify-center
                                rounded-full bg-[#6475E8] text-2xl font-bold text-white">
                        C
                    </div> -->

                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">
                        Welcome Back
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Please login to your ChikondiCare account.
                    </p>

                    <!-- Error message -->
                    @if ($errors->any())
                        <div class="mt-6 rounded-xl border border-red-100
                                    bg-red-50 p-4 text-sm text-red-600">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Login form -->
                    <form method="POST" action="{{ route('login.submit') }}"
                          class="mt-8 space-y-5">

                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email address"
                                autocomplete="username"
                                required
                                autofocus
                                class="w-full rounded-xl border border-gray-200
                                       bg-[#F7F8FC] px-4 py-4 text-sm text-gray-900
                                       outline-none transition
                                       placeholder:text-gray-400
                                       focus:border-[#6475E8]
                                       focus:ring-4 focus:ring-[#6475E8]/10"
                            >
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password"
                                   class="mb-2 block text-sm font-semibold text-gray-700">
                                Password
                            </label>

                            <div class="relative">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Enter your password"
                                    autocomplete="current-password"
                                    required
                                    class="w-full rounded-xl border border-gray-200
                                           bg-[#F7F8FC] px-4 py-4 pr-14 text-sm
                                           text-gray-900 outline-none transition
                                           placeholder:text-gray-400
                                           focus:border-[#6475E8]
                                           focus:ring-4 focus:ring-[#6475E8]/10"
                                >

                                <button
                                    type="button"
                                    id="togglePassword"
                                    aria-label="Show password"
                                    aria-pressed="false"
                                    class="absolute inset-y-0 right-4 text-gray-400
                                           transition hover:text-[#6475E8]"
                                >
                                    <svg id="eyeIcon"
                                         xmlns="http://www.w3.org/2000/svg"
                                         class="h-5 w-5"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         stroke-width="1.8">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M2.25 12s3.5-7 9.75-7 9.75 7 9.75 7-3.5 7-9.75 7-9.75-7-9.75-7Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Remember me and forgot password -->
                        <div class="flex items-center justify-between gap-3">

                            <label class="flex items-center gap-2 text-sm text-gray-500">
                                <input
                                    type="checkbox"
                                    name="remember"
                                    value="1"
                                    class="h-4 w-4 rounded border-gray-300
                                           accent-[#6475E8]"
                                >
                                Remember me
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-sm font-semibold text-[#6475E8]
                                          hover:underline">
                                    Forgot Password?
                                </a>
                            @endif

                        </div>

                        <!-- Login button -->
                        <button
                            type="submit"
                            class="w-full rounded-xl bg-[#6475E8] px-5 py-4
                                   text-sm font-semibold text-white shadow-lg
                                   shadow-[#6475E8]/20 transition
                                   hover:bg-[#5264D5] active:scale-[0.99]"
                        >
                            Login to your account
                        </button>

                    </form>

                    <div class="mt-5 border-t border-gray-100 pt-6 text-center">
                        <p class="text-xs leading-6 text-gray-400">
                            ChikondiCare Hospital Management System
                            <br>
                            Secure access for authorised hospital staff.
                        </p>
                    </div>

                </div>

            </section>

        </div>

    </main>

    <!-- Password visibility -->
    <script>
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        toggleButton.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';

            passwordInput.type = isHidden ? 'text' : 'password';

            toggleButton.setAttribute(
                'aria-label',
                isHidden ? 'Hide password' : 'Show password'
            );

            toggleButton.setAttribute(
                'aria-pressed',
                isHidden ? 'true' : 'false'
            );

            eyeIcon.innerHTML = isHidden
                ? '<path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18M10.6 10.6a2 2 0 002.8 2.8M9.9 5.2A10.8 10.8 0 0112 5c6.25 0 9.75 7 9.75 7a14.5 14.5 0 01-3.1 3.9M6.2 6.2C3.6 8 2.25 12 2.25 12s3.5 7 9.75 7c1.1 0 2.1-.2 3-.5"/>'
                : '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.5-7 9.75-7 9.75 7 9.75 7-3.5 7-9.75 7-9.75-7-9.75-7Z"/><circle cx="12" cy="12" r="3"/>';
        });
    </script>

</body>
</html>
