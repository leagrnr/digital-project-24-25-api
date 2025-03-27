<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompagnyStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'logo' => ['required', 'string', 'max:512'],
            'siret' => ['required', 'string', 'max:18'],
            'mail_manager' => ['required', 'string', 'max:50'],
            'telephone_manager' => ['required', 'string', 'max:16'],
            'adresse_siege' => ['required', 'string', 'max:124'],
        ];
    }
}
