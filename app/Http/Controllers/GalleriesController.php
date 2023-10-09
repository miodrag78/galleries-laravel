<?php
namespace App\Http\Controllers;

use App\Models\Gallery as AppGallery;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class GalleriesController extends Controller
{
    // Prikazi sve galerije
    public function index(Request $request)
    {
        $perPage = 10; // Broj galerija po stranici

        $query = AppGallery::with('images')->orderBy('created_at', 'desc');
        
        $term = $request->input('term');
        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', '%' . $term . '%')
                    ->orWhere('description', 'like', '%' . $term . '%');
            });
        }
        
        $galleries = $query->paginate($perPage);
        
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
        $gallery->title = $request->input('title');
        $gallery->description = $request->input('description');
        $gallery->user_id = $user->id;
        $gallery->urls = $request->input('urls'); // Dodajte ovo kako biste sačuvali 'urls'
        $gallery->save();
    
        // Dodaj slike galeriji (ako je implementirano)
        $imageUrls = $request->input('image_urls');
        if (is_array($imageUrls)) {
            foreach ($imageUrls as $imageUrl) {
                $image = new Image();
            $image->url = $imageUrl;
            $image->gallery_id = $gallery->id;
            $image->save();
            }
        }
    
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
        $gallery->description = $request->description;
        $gallery->urls = $request->input('urls'); // Dodajte ovo kako biste ažurirali 'urls'
        $gallery->save();

        // Ažuriraj slike galerije (ako je implementirano)
        // Ovde možete dodati logiku za ažuriranje slika galerije

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
        // Ovde možete dodati logiku za brisanje slika povezanih sa galerijom

        $gallery->delete();

        return response()->json(['message' => 'Galerija je uspešno obrisana']);
    }
}







