<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <style>
        /* Ajoutez le style pour l'image de fond ici */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('/image/salle.jpg'); /* Remplacez le chemin par le bon chemin vers votre image */
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Style pour les boutons */
        .login-button {
            font-size: 16px;
            color: #fff;
            text-decoration: none;
            margin: 10px;
            padding: 10px 20px;
            background-color: #009245; /* Couleur de fond des boutons */
            border-radius: 10px;
            border: none;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: #007935; /* Couleur de fond des boutons au survol */
        }

        /* Style pour les champs de saisie lorsque focus */
        .focus\:ring-ocp:focus {
            border-color: #009245 !important; /* Couleur de la bordure lorsque le champ est en focus */
            box-shadow: 0 0 0 3px rgba(0, 146, 69, 0.45) !important; /* Ajoute une ombre lorsqu'en focus */
        }

        /* Style pour le checkbox coché */
        input[type="checkbox"].checked-box {
            appearance: none; /* Masque l'apparence par défaut du checkbox */
            width: 16px;
            height: 16px;
            border: 2px solid #009245; /* Couleur de la bordure du checkbox */
            background-color: #fff; /* Couleur de fond du checkbox non coché */
            border-radius: 4px;
            vertical-align: middle;
            cursor: pointer;
        }

        input[type="checkbox"].checked-box:checked {
            background-color: #009245; /* Couleur de fond du checkbox coché */
            border-color: #009245; /* Couleur de la bordure du checkbox coché */
        }

    </style>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full focus:ring-ocp" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full focus:ring-ocp"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="checked-box rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-ocp" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="login-button ml-3">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>