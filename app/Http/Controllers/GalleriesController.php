<?php


namespace App\Http\Controllers;

use App\Models\Gallery as AppGallery;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use Illuminate\Support\Facades\Auth;

class GalleriesController extends Controller
{
    // Prikazi sve galerije
    public function index()
    {
        $galleries = AppGallery::with('images')->orderBy('created_at', 'desc')->get();
        return response()->json($galleries);
    }

    // Prikazi pojedinačnu galeriju
    public function show($id)
    {
        $gallery = AppGallery::with('images')->find($id);
        
        if (!$gallery) {
            return response()->json(['message' => 'Galerija nije pronađena'], 404);
        }
        
        return response()->json($gallery);
    }

    // Kreiraj novu galeriju
    public function store(GalleryRequest $request)
    {
        $user = Auth::user();
        
        $gallery = new AppGallery();
        $gallery->title = $request->title;
        $gallery->user_id = $user->id;
        $gallery->save();

        // Dodaj slike galeriji (ako je implementirano)

        return response()->json($gallery, 201);
    }

    // Ažuriraj postojeću galeriju
    public function update(GalleryRequest $request, $id)
    {
        $gallery = AppGallery::find($id);

        if (!$gallery) {
            return response()->json(['message' => 'Galerija nije pronađena'], 404);
        }

        $gallery->title = $request->title;
        $gallery->save();

        // Ažuriraj slike galerije (ako je implementirano)

        return response()->json($gallery);
    }

    // Obriši galeriju
    public function destroy($id)
    {
        $gallery = AppGallery::find($id);

        if (!$gallery) {
            return response()->json(['message' => 'Galerija nije pronađena'], 404);
        }

        // Obriši galeriju i sve njene slike (ako je implementirano)

        $gallery->delete();

        return response()->json(['message' => 'Galerija je uspešno obrisana']);
    }
}