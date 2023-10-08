<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\GalleryRequest;
use App\Image;

class Gallery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'user_id'
    ];
    //relacije
    public function images() {
        return $this->hasMany(Image::class); //galerija ima vise slika
    }
    public function user() {
        return $this->belongsTo(User::class); //jedna galerija pripada jednom useru
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}