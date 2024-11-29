<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Maison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class HomepageController extends Controller
{
    public function index()
    {
        // Récupère toutes les maisons et ses images grâce à la relation des modèles
        $maisons = Maison::with('images')->orderBy('created_at')->get();

        // Rendu de la vue avec les données nécessaires
        return Inertia::render('Homepage/Index', [
            'maisons' => $maisons,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
