<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SensorRequest extends FormRequest
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
            "nama_sensor" => "required|min:2",
            "topic" => "required",
            "data" => "required",
        ];
    }

    public function messages()
    {
        return [
            "nama_sensor.required" => "Nama sensor harus diisi!",
            "nama_sensor.min" => "Minimal 2 karakter",
            "topic.required" => "Topic harus diisi!",
            "data.required" => "Data harus diisi!"
        ];
    }
}
