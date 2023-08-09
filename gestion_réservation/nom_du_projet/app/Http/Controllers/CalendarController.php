<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Assurez-vous d'importer la classe Auth
use App\Models\Booking;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index()
    {
        $events = array();
        $bookings = Booking::join('users', 'bookings.user_id', '=', 'users.id')
        ->select('bookings.*', 'users.name', 'users.matricule')
        ->get();
        $bookings = Booking::all();
        foreach ($bookings as $booking) {
            $events[] = [
                'title' => $booking->title,
                'start' => $booking->start_time,
                'end' => $booking->end_time,
                'effectif' => $booking->effectif, // Ajoutez l'effectif à l'événement
            'salle_id' => $booking->salle_id, // Ajoutez l'ID de la salle à l'événement
            'user_id' => $booking->user_id, // ID de l'utilisateur
            'user_name' => $booking->name, // Nom de l'utilisateur
            'user_matricule' => $booking->matricule, // Matricule de l'utilisateur
 
 
        ];
        }

        return view('calendar.index', ['events' => $events]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
          
            'effectif' => 'required|integer',
            'salle_id' => 'required|in:1,2',
        ]);

        $selectedDateTime = new Carbon($request->start_time);
        $now = Carbon::now();
    
        // Comparer la date et l'heure de début avec la date et l'heure actuelles
        if ($selectedDateTime->isPast()) {
            return response()->json(['error' => 'Vous ne pouvez pas réserver pour une heure déjà passée.'], 400);
        }

        $selectedDate = new Carbon($request->date);
        $today = Carbon::today();
        if ($selectedDate->lt($today)) {
            return response()->json(['error' => 'Vous ne pouvez pas réserver pour les dates passées.'], 400);
        }

        if (!$this->isSlotAvailable($request->start_time, $request->end_time, $request->salle_id,$request->effectif)) {
            return response()->json(['error' => 'Le créneau horaire est déjà réservé. Veuillez choisir un autre créneau.'], 400);
        }
        if (!$this->isCapacityAvailable($request->start_time, $request->end_time, $request->salle_id, $request->effectif)) {
            return response()->json(['error' => 'La capacité maximale de la salle est dépassée pour ce créneau horaire.'], 400);
        }
        

        $user_id = Auth::id(); // Récupérer l'ID de l'utilisateur connecté

        $booking = Booking::create([
            'title' => $request->title,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
           
            'effectif' => $request->effectif,
            'salle_id' => $request->salle_id,
            'user_id' => $user_id, // Attribuer l'ID de l'utilisateur connecté au champ "user_id"
        ]);
        

        return response()->json($booking);
    }

    private function isSlotAvailable($start, $end, $salle_id, $effectif)
    {
        $existingBookings = Booking::where('salle_id', $salle_id)
            ->where(function ($query) use ($start, $end) {
                $query->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            })->get();
    
        return $existingBookings->isEmpty();
    }

    private function isCapacityAvailable($start, $end, $salle_id, $effectif)
{
    // Récupérer la capacité maximale de la salle
    $salleCapacity = $salle_id == 1 ? 30 : ($salle_id == 2 ? 16 : 0);

    $existingBookings = Booking::where('salle_id', $salle_id)
        ->where(function ($query) use ($start, $end) {
            $query->where('start_time', '<', $end)
                ->where('end_time', '>', $start);
        })->get();

    $totalEffectif = $effectif;

    foreach ($existingBookings as $booking) {
        $totalEffectif += $booking->effectif;
    }

    return $totalEffectif <= $salleCapacity;
}

public function showReservations()
{
    $events = array();
    $userId = Auth::id(); // Récupérer l'ID de l'utilisateur connecté
    
    $userBookings = Booking::where('user_id', $userId)
        ->join('users', 'bookings.user_id', '=', 'users.id')
        ->select('bookings.*', 'users.name', 'users.matricule')
        ->get();
    
    foreach ($userBookings as $booking) {
        $events[] = [
            'title' => $booking->title,
            'start' => $booking->start_time,
            'end' => $booking->end_time,
            'effectif' => $booking->effectif,
            'salle_id' => $booking->salle_id,
            'user_id' => $booking->user_id,
            'name' => $booking->name,
            'matricule' => $booking->matricule,
        ];
    }

    return view('calendar/show_reservations', ['events' => $events]);
}

public function update(Request $request, $id)
{
    $user = auth()->user();
    $reservation = Booking::where('user_id', $user->id)->find($id);

    if (!$reservation) {
        return response()->json(['error' => 'La réservation n\'existe pas ou ne vous appartient pas.'], 403);
    }

    // Valider les données du formulaire de modification ici
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
        'effectif' => 'required|integer|min:1',
        'salle_id' => 'required|integer|in:1,2', // ou utilisez un autre moyen pour valider la salle_id
    ]);

    // Mettre à jour les champs de la réservation
    $reservation->update($validatedData);

    return response()->json(['message' => 'La réservation a été mise à jour avec succès.'], 200);
}

}