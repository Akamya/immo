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

    public function update(Request $request, $id)
{
    // Validation des données
    $request->validate([
        'title' => 'required|string|max:255',
        'price' => 'required|numeric',
        'address' => 'required|string|max:255',
        'rooms' => 'required|integer',
        'size' => 'required|numeric',
        'description' => 'nullable|string',
        // Ajouter d'autres règles de validation selon tes besoins
    ]);

    // Recherche la maison et met à jour les informations
    $maison = Maison::findOrFail($id);
    $maison->update([
        'title' => $request->title,
        'price' => $request->price,
        'address' => $request->address,
        'rooms' => $request->rooms,
        'size' => $request->size,
        'description' => $request->description,
        // Ajouter d'autres champs à mettre à jour
    ]);

    return redirect()->route('Homepage')->with('success', 'Maison mise à jour avec succès!');
}


    public function edit($id)
{
    $maison = Maison::findOrFail($id); // Recherche la maison par ID
    return Inertia::render('Posts/Edit', [
        'maison' => $maison,
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
}

public function destroy($id)
{
    $maison = Maison::findOrFail($id);
    $maison->delete(); // Supprime la maison

    return redirect()->route('Homepage')->with('success', 'Maison supprimée avec succès!');
}

}
