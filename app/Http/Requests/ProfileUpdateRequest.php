<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'lowercase', 'email', 'max:255', \Illuminate\Validation\Rule::unique(\App\Models\User::class)->ignore($this->user()->id)],
            'height_cm' => ['sometimes', 'required', 'integer', 'min:100', 'max:250'],
            'current_weight_kg' => ['sometimes', 'required', 'numeric', 'min:30', 'max:300'],
            'goal_type' => ['sometimes', 'required', 'in:lose,maintain,gain'],
        ];
    }
}
