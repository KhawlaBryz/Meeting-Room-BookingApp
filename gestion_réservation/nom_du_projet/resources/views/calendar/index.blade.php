<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Calendrier</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <style>
    /* Couleur pour la salle Digital Factory */
    .event-digital-factory {
        background-color: #C1ECE4; /* Utilisez une couleur de votre choix */
    }

    /* Couleur pour la salle de réunion de la TC */
    .event-salle-tc {
        background-color: #FFD0D0; /* Utilisez une couleur de votre choix */
    }
     /* CSS pour la légende */
     .legend {
            width: 20%; /* Ajuster la largeur de la légende */
            height: 100%;
            position: absolute; /* Position absolute to remove it from normal flow */
            top: 20px; /* Adjust top value as needed to position the legend */
            left: 20px; /* Adjust left value as needed to position the legend */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 0px;
        }


        .legend-item {
            display: flex;
            align-items: right;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }

        .legend-color.event-digital-factory {
            background-color: #C1ECE4;
        }

        .legend-color.event-salle-tc {
            background-color: #FFD0D0;
        }

        .legend-text {
            margin-left: 5px;
        }
        
        #calendar {
    width: 55%;
    height:55%; /* Ajustez la largeur selon vos besoins */
    
    margin: 0 auto; /* Pour centrer le calendrier horizontalement dans le conteneur */
}
/* CSS pour la barre de navigation */
.navbar {
    background-color: #009245; /* Couleur du background */
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: right;
}

.navbar a {
    color: white; /* Couleur des liens */
    margin-right: 15px;
    text-decoration: none;
}
.cal{
    color:#225E67 ;

}
.nom{
    color:white;
    text-align: left;
}
.navbar a:hover {
    color: #225E67; /* Couleur des liens au survol */
    text-decoration: underline;
}
h3 {
        font-size: 24px; /* Ajuster la taille de la police */
        margin-top: 0px; /* Déplacer le titre vers le haut */
        align-items: left;
    }
 #saveBtn
{
    background-color: #009245;
}




</style>
</head>
<body>
   <!-- Ajoutez un élément pour afficher la notification -->
   <div id="reservationSuccessMessage" class="alert alert-success d-none">Réservation effectuée!</div>
    <!-- Formulaire de réservation (Booking Form) -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nouvelle réservation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bookingForm">
                        <div class="mb-3">
                            <label for="title" class="form-label">Objet de réunion</label>
                            <input type="text" class="form-control" id="title" name="title">
                            <span id="titleError" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Date de début</label>
                            <input type="datetime-local" class="form-control" id="start_time" name="start_time">
                            <span id="startTimeError" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="end_time" class="form-label">Date de fin</label>
                            <input type="datetime-local" class="form-control" id="end_time" name="end_time">
                            <span id="endTimeError" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="effectif" class="form-label">Effectif</label>
                            <input type="number" class="form-control" id="effectif" name="effectif">
                            <span id="effectifError" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label for="salle_id" class="form-label">Salle</label>
                            <select class="form-select" id="salle_id" name="salle_id">
                                <option value="1">Digital Factory</option>
                                <option value="2">Salle de réunion de la TC</option>
                            </select>
                            <span id="salleIdError" class="text-danger"></span>
                        </div>

                        <!-- Ajoutez une zone pour afficher les messages d'erreur -->
                        <div id="errorMessage" class="alert alert-danger d-none"></div>
                       
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" id="saveBtn" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

     <!-- Ajouter la barre de navigation -->
     <nav class="navbar">
        <!-- Afficher le nom de l'utilisateur s'il est connecté -->
        @auth
        <div class="text-right">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
            
            
            <a href="{{ route('show.reservations') }}">Mes réservations</a>
            <span class="cal" >Calendrier de réservations</span>
            <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();">Se déconnecter</a>
        </div>
        @endauth
       
    </nav>


    <div>Bienvenue {{ auth()->user()->name }} </br>Pour réserver une salle, il vous suffit de cliquer sur la case correspondant à la date et l'heure de votre événement dans le calendrier.</div>



    <!-- Boîte modale pour afficher les détails de l'événement -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Objet de réunion :</strong> <span id="eventTitleValue"></span></p>
                <p><strong>Date de début :</strong> <span id="eventStartTime"></span></p>
                <p><strong>Date de fin :</strong> <span id="eventEndTime"></span></p>
                <p><strong>Effectif :</strong> <span id="eventEffectif"></span></p>
                <p><strong>Salle :</strong> <span id="eventSalle"></span></p>
            
                <!-- Ajoutez d'autres détails d'événement ici si nécessaire -->
            </div>
        </div>
    </div>
</div>

    <div class="container">
        <div class="row">
            <div class="col-12">
            <h3 class="text-center mt-5" style="float: left;"></h3>
                <div class="loc-md-11 offset-1 mt-5 mb-5">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
       <!-- Ajouter une légende pour expliquer les couleurs des salles -->
<div class="legend">
    <div class="legend-item">
        <div class="legend-color event-digital-factory"></div>
        <div class="legend-text">Digital Factory</div>
    </div>
    <div class="legend-item">
        <div class="legend-color event-salle-tc"></div>
        <div class="legend-text">Salle de réunion de la TC</div>
    </div>
</div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            
            // Fonction pour obtenir le nom de la salle en fonction de son ID
                  function getSalleName(salle_id) {
                      if (salle_id == 1) {
                           return 'Digital Factory';
                               } else if (salle_id == 2) {
                                    return 'Salle de réunion de la TC';
                                       } else {
                                         return 'Salle inconnue';
                                       }
                }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var events = @json($events);

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: events,
                selectable: true,
                selectHelper: true,
                selectMirror: true,
                dayMaxEvents: true,
              
            // Gérer l'événement eventDrop
            eventDrop: function(event) {
                updateEvent(event);
            },

            // Gérer l'événement eventResize
            eventResize: function(event) {
                updateEvent(event);
            },
                
            

                // Gérer l'événement eventClick
             eventClick: function(event) {
                  // Remplir les détails de l'événement dans la boîte modale
                     $('#eventTitle').text(event.title);
                    $('#eventStartTime').text(event.start.format('YYYY-MM-DD HH:mm'));
                   $('#eventEndTime').text(event.end.format('YYYY-MM-DD HH:mm'));

              // Afficher les détails supplémentaires de l'événement
              $('#eventTitleValue').text(event.title);
              $('#eventEffectif').text(event.effectif);
               $('#eventSalle').text(getSalleName(event.salle_id));
              // Afficher les détails de l'utilisateur
              $('#eventUserName').text(event.user_name);
              $('#eventUserMatricule').text(event.user_matricule);

               // Afficher la boîte modale
               $('#eventDetailsModal').modal('show');
             },
        
        
              eventRender: function(event, element) {
                // Ajouter la classe CSS en fonction de la salle
                if (event.salle_id === 1) {
                    element.addClass('event-digital-factory');
                } else if (event.salle_id === 2) {
                    element.addClass('event-salle-tc');
                }

                if (event.end.isBefore(moment(), 'minute')) {
                    return false; // Cela masquera l'événement passé
                }
            
               },
            
                select: function(start, end, allDay) {
                    

                    if (start.isBefore(moment(), 'day')) {
                       alert("Vous ne pouvez pas réservez.");
                    return;
                    }
                  
                    // $('#start_time').val(moment(start).format('YYYY-MM-DDTHH:mm:ss'));
                    // $('#end_time').val(moment(end).format('YYYY-MM-DDTHH:mm:ss'));
                    $('#bookingModal').modal('toggle');
                }
            });

            $('#saveBtn').click(function() {
                var title = $('#title').val();
                var start_time = $('#start_time').val();
                var end_time = $('#end_time').val();
                var effectif = $('#effectif').val();
                var salle_id = $('#salle_id').val();

                $.ajax({
                    url: "{{ route('calendar.store') }}",
                    type: "POST",
                    dataType: 'json',
                    data: { 
                        title: title,
                        start_time: start_time,
                        end_time: end_time,
                        effectif: effectif,
                        salle_id: salle_id
                    },
                    success: function(response) {

                        // Afficher la notification de réservation effectuée
                        $('#reservationSuccessMessage').removeClass('d-none').show();
                        
                        // Recharger les événements du calendrier pour afficher la nouvelle réservation
                        $('#calendar').fullCalendar('refetchEvents');
                        
                        // Masquer le formulaire de réservation
                        $('#bookingModal').modal('hide');

                        // Masquer la notification après 3 secondes (3000 millisecondes)
                        setTimeout(function() {
                            $('#reservationSuccessMessage').fadeOut('slow', function() {
                                $(this).addClass('d-none');
                            });
                        }, 3000);
                    },
                    error: function(error) {
                        if (error.responseJSON.errors) {
                            // Afficher les messages d'erreur dans le formulaire de réservation
                            if (error.responseJSON.errors.title) {
                                $('#titleError').text(error.responseJSON.errors.title);
                            } else {
                                $('#titleError').text('');
                            }

                            if (error.responseJSON.errors.start_time) {
                                $('#startTimeError').text(error.responseJSON.errors.start_time);
                            } else {
                                $('#startTimeError').text('');
                            }

                            if (error.responseJSON.errors.end_time) {
                                $('#endTimeError').text(error.responseJSON.errors.end_time);
                            } else {
                                $('#endTimeError').text('');
                            }

                            if (error.responseJSON.errors.effectif) {
                                $('#effectifError').text(error.responseJSON.errors.effectif);
                            } else {
                                $('#effectifError').text('');
                            }

                            if (error.responseJSON.errors.salle_id) {
                                $('#salleIdError').text(error.responseJSON.errors.salle_id);
                            } else {
                                $('#salleIdError').text('');
                            }
                        } else if (error.responseJSON.error) {
                            // Afficher le message d'erreur général pour le créneau horaire déjà réservé
                            $('#errorMessage').text(error.responseJSON.error).removeClass('d-none').show();
                        }
                    },
                });
                
            });
           
            
        });
    </script>
</body>
</html>