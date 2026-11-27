<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_id' => 'required|exists:events,id',
            'name' => 'required|max:50',
            'email' => 'required|email|max:255',
            'number_of_people' => 'required|integer|min:1|max:10',
            'reserved_at' => 'required|date|after:now',
        ];
    }

    public function messages(): array
    {
        return [
            'reserved_at.after' => '日時は、今より後の日時を選んでください。',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => '名前',
        ];
    }
}
