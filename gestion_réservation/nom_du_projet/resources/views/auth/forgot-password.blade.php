<x-guest-layout>
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
        .reset-button {
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

        .reset-button:hover {
            background-color: #007935; /* Couleur de fond des boutons au survol */
        }

        /* Style pour les champs de saisie lorsque focus */
        .focus\:ring-ocp:focus {
            border-color: #009245 !important; /* Couleur de la bordure lorsque le champ est en focus */
            box-shadow: 0 0 0 3px rgba(0, 146, 69, 0.45) !important; /* Ajoute une ombre lorsqu'en focus */
        }

        /* Style pour le lien "Forgot your password?" */
        .forgot-link {
            color: #666; /* Couleur du texte du lien */
            text-decoration: none;
            transition: border-color 0.3s ease; /* Animation de transition de la couleur de la bordure */
            border-color: #666; /* Couleur de la bordure initiale */
            padding: 2px; /* Ajoute un peu d'espace pour la bordure */
            border-radius: 3px; /* Bordure arrondie */
        }

        .forgot-link:hover {
            border-color: #009245; /* Couleur de la bordure lorsque le lien est survolé */
        }

        /* Style pour le lien "Forgot your password?" lorsqu'il est en focus */
        .forgot-link:focus {
            border-color: #009245; /* Couleur de la bordure lorsque le lien est en focus */
            outline: none; /* Supprime l'effet de focus par défaut du navigateur */
        }

    </style>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full focus:ring-ocp" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="reset-button">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
</x-guest-layout>