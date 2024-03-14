<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
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
            'title'=>['required','string'],
            'subcategory_id'=>['required'],
            'description'=> ['required'],
            'images.*' => ['mimes:jpeg,png,jpg'],
            'start_time' => ['required'],
            'end_time' => ['required'],            
            'fee_per_seat' => ['required','integer'],
            'seats' => ['required','integer'],
        ];
    }
}
