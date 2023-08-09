<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil</title>
    <style>
        /* Ajoutez le style pour l'image de fond ici */
        body {
            margin: 0; /* Réinitialise les marges pour le corps */
            padding: 0; /* Réinitialise les marges internes pour le corps */
            height: 100vh; /* Définit la hauteur du corps à 100% de la hauteur de la vue */
            display: flex; /* Utilise le modèle de boîte flexible pour le contenu */
            flex-direction: column; /* Place le contenu en colonne */
        }

        .banner {
            height: 50vh; /* Occupe la moitié de la hauteur de la vue */
            display: flex; /* Utilise le modèle de boîte flexible pour les éléments à l'intérieur */
            align-items: center; /* Centre les éléments verticalement */
            background-image: url('/image/salle.jpg'); /* Remplacez le chemin par le bon chemin vers votre image */
            background-size: cover;
            background-position: center;
            background-color: rgba(255, 255, 255, 0.8); /* Couleur de fond semi-transparente pour la bannière */
            justify-content: flex-start; /* Aligne les éléments à gauche */
            padding-left: 20px; /* Ajoute une marge à gauche pour le logo */
        }

        .home-link {
            font-size: 24px; /* Augmentez la taille du texte des liens */
            color: white; /* Couleur du texte des liens */
            text-decoration: none;
            margin: 10px;
            padding: 10px 20px; /* Ajoutez un espace autour des liens */
            background-color: #009245; /* Couleur de fond des liens */
            border-radius: 10px; /* Bordure arrondie pour les liens */
        }

        .home-link:hover {
            background-color: #007935; /* Couleur de fond des liens au survol */
        }

        h1 {
            text-align: center; /* Centre le texte h1 horizontalement */
            color: #009245; /* Couleur verte du logo OCP */
        }

        .logo {
            height: 150px; /* Ajustez la hauteur du logo */
        }
    </style>
</head>
<body class="antialiased">
    <div class="banner">
        <!-- Contenu de la bannière (peut être du texte, des images, etc.) -->
        <img src="https://seeklogo.com/images/O/ocp-logo-4F7287992D-seeklogo.com.png" alt="Logo OCP" class="logo">
    </div>

    <div class="center-links">
    <!-- Liens centrés verticalement -->
    @guest
        <!-- Afficher les liens d'authentification lorsque l'utilisateur n'est pas connecté -->
        <a href="{{ route('login') }}" class="home-link">Log in</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="home-link">Register</a>
        @endif
    @else
        <!-- Afficher le lien vers la route calendar.store lorsque l'utilisateur est connecté -->
        <a href="{{ route('calendar.index') }}" class="home-link">Réserver</a>
    @endguest
</div>
    <h1>Bienvenue sur la plateforme de réservation <br> de la salle de réunion de la tour de contrôle de Jorf Lasfar</h1>
</body>
</html>