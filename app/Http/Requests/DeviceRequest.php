<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
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
            "serial_number" => "required|min:2",
            "meta_data" => "required|min:2",
        ];
    }

    public function messages()
    {
        return [
            "serial_number.required" => "Serial number harus diisi!",
            "serial_number.min" => "Minimal 2 karakter",
            "meta_data.required" => "Meta data harus diisi!",
            "meta_data.min" => "Minimal 2 karakter",
        ];
    }
}
