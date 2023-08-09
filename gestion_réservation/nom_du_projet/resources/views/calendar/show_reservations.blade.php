<!DOCTYPE html>
<html>
<head>
    <!-- Les en-têtes de la page -->
    <title>Affichage des réservations</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

         /* Styles pour la barre de navigation */
         .navbar {
            background-color: #009245; /* Couleur du background */
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: right;
        }
        .mes{
            color: #225E67; 
        }
        .navbar a {
            color: white; /* Couleur des liens */
            margin-right: 15px;
            text-decoration: none;
        }

        .navbar a:hover {
            color: #225E67; /* Couleur des liens au survol */
            text-decoration: underline;
        }
        
         /* ... (Le style du reste de la page)... */
         .actions {
            display: flex;
            justify-content: space-evenly;
        }

        .actions button {
            padding: 5px 10px;
        }

        .actions button:first-child {
            background-color: #3AA6B9;
            color: #fff;
        }

        .actions button:last-child {
            background-color: #FF5733;
            color: #fff;
        }
        .form-control {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .form-control {
        font-weight: bold;
        color: #009245; /* Couleur verte */
        display: block;
        margin-bottom: 10px;
    }

    .form-control  {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }
    </style>
</head>
<body>
    <!-- Ajouter la barre de navigation -->
<nav class="navbar">
    <!-- Afficher le nom de l'utilisateur s'il est connecté -->
    @auth
    <div class="text-right">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
        
        
        <span class="mes">Mes réservations</span>
        <a href="{{ route('calendar.index') }}">Calendrier de réservations</a>
        <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();">Se déconnecter</a>
    </div>
    @endauth
</nav>

<!-- Formulaire de recherche -->
<div class="search-form">
    
    <input type="text" class="form-control" id="searchReservation" name="searchReservation" placeholder="Rechercher">
</div>

<div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Mes réservations existantes</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Objet de réunion</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Effectif</th>
                            <th>Salle</th>
                            <th>Nom de l'utilisateur</th>
                            <th>Matricule de l'utilisateur</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                        <tr>
                            <td>{{ $event['title'] }}</td>
                            <td>{{ $event['start'] }}</td>
                            <td>{{ $event['end'] }}</td>
                            <td>{{ $event['effectif'] }}</td>
                            <td>{{ $event['salle_id'] }}</td>
                            <td>{{ $event['name'] }}</td>
                            <td>{{ $event['matricule'] }}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

   

<script>
     function filterReservations() {
        const searchInput = document.getElementById('searchReservation').value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach((row) => {
            const reservationName = row.querySelector('td:first-child').textContent.toLowerCase();
            if (reservationName.includes(searchInput)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Gérer l'événement de saisie dans le champ de recherche
    document.getElementById('searchReservation').addEventListener('input', filterReservations);
</script>

</body>
</html>