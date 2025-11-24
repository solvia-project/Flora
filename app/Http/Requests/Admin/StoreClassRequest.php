<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'location' => ['required', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'max' => ['nullable', 'integer', 'min:1'],
            'day' => ['nullable', 'string', 'in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday'],
            'time_1' => ['nullable', 'date_format:H:i'],
            'time_2' => ['nullable', 'date_format:H:i'],
            'image' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string'],
        ];
    }
}
