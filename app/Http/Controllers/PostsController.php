<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Maison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
        // Récupère toutes les maisons et ses images grâce à la relation des modèles
        $maisons = Maison::with('images')->get();

        // Rendu de la vue avec les données nécessaires
        return Inertia::render('Posts/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'price' => 'required|numeric',
            'rooms' => 'required|integer',
            'size' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'required|file|image',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour ajouter une maison.');
        }


        $maison = Maison::create([
        'title' => $request->title,
        'image' => $imagePath,
        'address' => $request->address,
        'price' => $request->price,
        'rooms' => $request->rooms,
        'size' => $request->size,
        'description' => $request->description,
        'user_id' => Auth::user()->id, // Ajoute l'utilisateur connecté
    ]);

    $image = Image::create([
        'maison_id' => $maison->id,
        'path' => $imagePath,
    ]);

        return redirect()->back()->banner('Informations mises à jour avec succès.');
    }
}
