<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'author_id' => 'required|exists:authors,id',
            'title' => 'required|string|min:5|max:100',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string|min:150|max:1000',
            'year' => 'required|integer|min:1901|max:' . date('Y'), //anno corrente
            'language' => 'required|string|min:2|max:50',
            // categorie
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ];
    }
}
