<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Postavite na true da biste omogućili izvršenje ovog requesta
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<string>>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:2|max:255',
        'description' => 'nullable|max:1000',
        'image_urls' => 'required|array|min:1',
        'image_urls.*' => 'url', // Validacija za svaki URL u listi
        'urls' => 'required|array|min:1', // Validacija za polje 'urls'
        'urls.*' => 'url', // Validacija za svaki URL u polju 'urls'
        'term' => 'nullable|string', // Dodajte pravilo za term
        ];
    }
}






