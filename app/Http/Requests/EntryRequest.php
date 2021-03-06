<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vin_number'=>'required',
            'engine_number'=>'required',
            'number_plate'=>'required',
            'license_disc_number_plate'=>'required',
            'model'=>'required',
            'image'=>'required'
        ];
    }
}
