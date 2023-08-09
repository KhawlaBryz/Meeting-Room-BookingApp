<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; // Assurez-vous d'importer le modèle Booking

class DashboardController extends Controller
{
    public function dashboard()
    {
        $events = Booking::all(); // Récupérez les événements depuis la base de données ou toute autre source

        return view('dashboard', compact('events')); // Transmettez la variable $events à la vue
    }
}