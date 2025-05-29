<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|alpha|max:50',              // pets.name
            'species' => 'required|in:perro,gato,exóticos', // pets.species
            'first_name' => 'required|alpha|max:50',       // clients.first_name
            'phone' => 'required|digits:9',                // clients.phone
            'appointment_date' => 'required|date_format:d-m-Y', // appointments.appointment_date
            'appointment_time' => 'required|date_format:H:i',   // custom, extra campo de hora
            'reason' => 'required|in:consulta,control',    // appointments.reason
        ];
    }

    public function messages()
    {
        return [
            'required' => 'campo incompleto',
            'alpha' => 'solo letras permitidas',
            'in' => 'opción no válida',
            'digits' => 'debe tener exactamente 9 dígitos',
            'date_format' => 'formato no válido',
        ];
    }
}
