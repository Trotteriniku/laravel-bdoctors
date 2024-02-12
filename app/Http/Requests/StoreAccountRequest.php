<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['image', 'mimes:png,jpg,jpeg'],
            'cv' => ['mimes:application/pdf, application/x-pdf,application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf|max:10000'],
            'address' => ['required', 'min:3', 'max:500'],
            'performance' => ['min:3', 'max:1000'],
            'user_id' => ['numeric'],
            'phone' => ['min:10'],
        ];
    }
    public function messages()
    {
        return [
            'image.image' => 'Il file deve essere un immagine',
            'image.mimes' => 'Utilizza uno dei formati accettati: .png, .jpg, .jpeg',
            'cv.mimes' => 'Il CV deve essere in formato PDF',
            'address.required' => 'L\'indirizzo è obbligatorio',
            'address.min' => 'L\'indirizzo deve contenere almeno :min caratteri',
            'address.max' => 'L\'indirizzo deve contenere almeno :max caratteri',
            'performance.max' => 'La descrizione deve essere di massimo :max caratteri',
            'performance.min' => 'La descrizione deve essere di minimo :min caratteri',
            'user_id.numeric' => 'user id deve essere un numero',
            'phone.min' => 'Il numero di telefono deve essere di :min caratteri',
        ];
    }
}
