<x-guest-layout>
    <!-- Session Status -->

    <head>
        <meta charset="utf-8" />
        <title>Medical DZ</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;1,100;1,300;1,400&display=swap"
            rel="stylesheet" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-md px-md-5 d-flex m-0 justify-content-between">
                <div class="d-flex align-items-center justify-content-center" style="display: flex; align-items:center ; justify-content:center">
                    @guest
                        <a href="{{ route('home') }}" class="login"
                            style="login">الصفحة الرئيسية</a>
                    @endguest
                </div>
            </nav>
        </header>


        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="responsive">
                <x-input-label for="code" :value="'كود التسجيل'" />
                <x-text-input id="code" class="block mt-1 w-full" type="text" placeholder="ادخل كود التسجيل"
                    name="code" :value="old('code')" />
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ 'تذكرني' }}</span>
                </label>
            </div>
            {{-- <div class="mt-4">
            <p>Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">{{ ('Register') }}</a></p>
        </div> --}}

        <div class="text-auto">
            <x-primary-button class="childbtn">
                {{ 'تسجيل' }}
            </x-primary-button>

        </div>

            </div>
        </form>
        <style>
 .login{
            padding: 10px !important;
            border-radius: 8px;
            border: 0;
            padding: 0;
            background-color: rgb(9, 92, 140);
            color: white;
            margin-bottom: 5px !important;
            letter-spacing: 1px;
            font-size: 18px;
            margin-right: 20px;
            margin-top: 5px !important;

        }
        .login:hover{
            background-color: rgba(9, 86, 131, 0.852);
        }

            </style>
    </body>

    </html>
</x-guest-layout>
