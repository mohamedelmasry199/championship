<x-guest-layout>
    <head>
      <meta charset="utf-8" />
      <title>user</title>
      <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
      <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;1,100;1,300;1,400&display=swap"
        rel="stylesheet" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    <body id="signUP-Bage">
    <header>
            <nav class="navbar navbar-expand-md px-md-5 d-flex m-0 justify-content-between">
                <div class="container-fluid header">
                    <a class="navbar-brand logo" href="{{ route('home') }}">MCQ Lab</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <li class="nav-item pt-2" style="margin-top:-30px">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <ul class="navbar-nav signin-btn d-flex ml-auto flex-row">
                            <li><a href="{{ route('register') }}" class="btn login mx-3 btn-outline-primary">Sign Up</a></li>
                            <li><a href="{{ route('login') }}" class="btn login btn-outline-primary">Sign in</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="code" :value="('code')" />
                <x-text-input id="code" class="block mt-1 w-full" placeholder="Enter New Code"  type="text" name="code" :value="old('code')" />
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>



            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ ('Already registered?') }}
                </a>

                <x-primary-button class="ms-4 registerbtn">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
        </body>
    </html>
    </x-guest-layout>
