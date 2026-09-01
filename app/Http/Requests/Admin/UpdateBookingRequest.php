<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'company' => ['nullable', 'string', 'max:255'],
            'industry' => ['nullable', 'string', 'max:255'],
            'discussion_topic' => ['nullable', 'string'],
            'preferred_date' => ['nullable', 'string', 'max:50'],
            'preferred_time' => ['nullable', 'string', 'max:50'],
            'specialist' => ['nullable', 'string', 'max:255'],
            'duration' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'string', 'in:confirmed,pending,cancelled,completed'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
