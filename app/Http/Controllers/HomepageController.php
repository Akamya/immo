<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Maison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class HomepageController extends Controller
{
    public function index()
    {
        // Récupère toutes les maisons et ses images grâce à la relation des modèles
        $maisons = Maison::with('images')->orderBy('created_at', 'DESC')->paginate(9);

        $userId = Auth::id();

        // dd($maisons);
        // Rendu de la vue avec les données nécessaires
        return Inertia::render('Homepage/Index', [
            'maisons' => $maisons->items(),
            'userId' => $userId,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'pagination' => [
            'current_page' => $maisons->currentPage(),
            'last_page' => $maisons->lastPage(),
            'per_page' => $maisons->perPage(),
            'total' => $maisons->total(),
            'prev_page_url' => $maisons->previousPageUrl(),
            'next_page_url' => $maisons->nextPageUrl(),
            'links' => $maisons->linkCollection(),
        ],
        ]);
    }
}
