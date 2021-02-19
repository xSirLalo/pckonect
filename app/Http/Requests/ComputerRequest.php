<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComputerRequest extends FormRequest
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
        $id = $this->isMethod('put') ? ",{$this->computer->id}" : '';
        return [
            'processor' => 'required',
            'ram' => 'required',
            'storage' => 'required',
            'ip_address' => 'required|ipv4|unique:computers,ip_address'. $id,
            'number' => 'required|numeric|unique:computers,number' . $id,
        ];
    }
}
