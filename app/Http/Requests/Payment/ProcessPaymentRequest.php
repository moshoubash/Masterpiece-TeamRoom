<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class ProcessPaymentRequest extends FormRequest
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
            'space_id' => 'required|exists:spaces,id',
            'date' => 'required|date',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'num_attendees' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'host_payout' => 'required|numeric|min:0',
            'service_fee' => 'required|numeric|min:0',
            'payment_method_id' => 'required|string',
        ];
    }
}
