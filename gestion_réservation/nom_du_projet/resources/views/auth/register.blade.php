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
        .register-button {
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

        .register-button:hover {
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

        /* Style pour le lien "Already registered?" */
        .registered-link {
            color: #666; /* Couleur du texte du lien */
            text-decoration: none;
            transition: border-color 0.3s ease; /* Animation de transition de la couleur de la bordure */
            border-color: #666; /* Couleur de la bordure initiale */
            padding: 2px; /* Ajoute un peu d'espace pour la bordure */
            border-radius: 3px; /* Bordure arrondie */
        }

        .registered-link:hover {
            border-color: #009245; /* Couleur de la bordure lorsque le lien est survolé */
        }

        /* Style pour le lien "Already registered?" lorsqu'il est en focus */
        .registered-link:focus {
            border-color: #009245; /* Couleur de la bordure lorsque le lien est en focus */
            outline: none; /* Supprime l'effet de focus par défaut du navigateur */
        }

    </style>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full focus:ring-ocp" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full focus:ring-ocp" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Matricule -->
        <div class="mt-4">
            <x-input-label for="matricule" :value="__('matricule')" />
            <x-text-input id="matricule" class="block mt-1 w-full focus:ring-ocp" type="text" name="matricule" :value="old('matricule')" required autocomplete="off" />
            <x-input-error :messages="$errors->get('matricule')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full focus:ring-ocp"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full focus:ring-ocp"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 registered-link" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="register-button ml-4">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>