<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare inputs for validation (Sanitization & Honeypot Check).
     */
    protected function prepareForValidation(): void
    {
        // Sanitize string inputs: strip tags & trim whitespace
        $this->merge([
            'full_name' => $this->full_name ? trim(strip_tags($this->full_name)) : null,
            'phone' => $this->phone ? trim(strip_tags($this->phone)) : null,
            'email' => $this->email ? strtolower(trim(strip_tags($this->email))) : null,
            'company' => $this->company ? trim(strip_tags($this->company)) : null,
            'industry' => $this->industry ? trim(strip_tags($this->industry)) : null,
            'discussion_topic' => $this->discussion_topic ? trim(strip_tags($this->discussion_topic)) : null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => [
                'required', 
                'string', 
                'min:2', 
                'max:70', 
                'regex:/^[a-zA-Z\s\.\'-]+$/'
            ],
            'phone' => [
                'required', 
                'string', 
                'min:7', 
                'max:16', 
                'regex:/^[\+]?[0-9\s\-()]{7,16}$/'
            ],
            'email' => [
                'required', 
                'string', 
                'email:rfc', 
                'max:100',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'company' => [
                'required', 
                'string', 
                'min:2', 
                'max:100'
            ],
            'industry' => [
                'required', 
                'string', 
                'in:Bakery,Pastry,Cookies & Biscuits,Confectionery,Dairy,Food Manufacturing,Other'
            ],
            'discussion_topic' => [
                'required', 
                'string', 
                'in:Product Performance,Butter Solution,Cost Efficiency,Custom Formulation'
            ],
            'event_date_id' => ['nullable', 'exists:event_dates,id'],
            'consultation_slot_id' => ['nullable', 'exists:consultation_slots,id'],
            'preferred_date' => ['required', 'date'],
            'preferred_time' => ['required', 'string', 'max:100'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'bunge_website_hp' => ['nullable', 'max:0'], // Anti-spam honeypot (must be empty)
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'full_name.regex' => 'Full Name can only contain letters, spaces, dots, hyphens, and apostrophes.',
            'full_name.max' => 'Full Name cannot exceed 70 characters.',
            'full_name.min' => 'Full Name must be at least 2 characters.',
            'phone.regex' => 'Phone Number must contain valid numbers (max 16 characters).',
            'phone.max' => 'Phone Number cannot exceed 16 characters.',
            'phone.min' => 'Phone Number must be at least 7 digits.',
            'email.regex' => 'Please enter a valid email address containing @ and a valid domain.',
            'email.email' => 'Please enter a valid email address containing @.',
            'email.max' => 'Email Address cannot exceed 100 characters.',
            'company.max' => 'Company Name cannot exceed 100 characters.',
            'company.min' => 'Company Name must be at least 2 characters.',
            'industry.in' => 'Please select a valid Industry option.',
            'discussion_topic.in' => 'Please select a valid Discussion Topic option.',
            'bunge_website_hp.max' => 'Spam submission detected.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'full_name' => 'Full Name',
            'phone' => 'Phone Number',
            'email' => 'Email Address',
            'company' => 'Company',
            'industry' => 'Industry',
            'discussion_topic' => 'Discussion Topic',
            'event_date_id' => 'Event Date',
            'consultation_slot_id' => 'Consultation Time Slot',
            'preferred_date' => 'Preferred Date',
            'preferred_time' => 'Preferred Time',
            'notes' => 'Additional Notes',
        ];
    }

    /**
     * Get the URL to redirect to on a validation error.
     */
    protected function getRedirectUrl(): string
    {
        return url('/#consultation');
    }
}
