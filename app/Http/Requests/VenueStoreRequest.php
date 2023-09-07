<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VenueStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $venueId = $this->route('venue');
        $rules = [
            'category' => 'required|in:Private,Public',
            'name' => 'required|string|max:255',
            'is_activated' => 'boolean',
            'description' => 'nullable|string',
            'phone_number' => 'required|string|max:20',
            'email_address' => [
                'required',
                'email',
                Rule::unique('venues', 'email_address')->ignore($venueId),
            ],
            'website' => 'nullable|string|url|max:255',
            'full_address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'activated_at' => 'nullable|date'
        ];

        if ($this->input('is_activated')) {
            $rules['type'] = 'required|string|max:255';
        }

        return $rules;
    }
}
