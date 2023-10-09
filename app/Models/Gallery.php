<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\GalleryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class Gallery extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'user_id', 'urls'];
    //relacije
    public function images()
    {
        return $this->hasMany(Image::class); // galerija ima više slika
    }
    public function user()
    {
        return $this->belongsTo(User::class); // jedna galerija pripada jednom useru
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
