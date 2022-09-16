<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use App\Services\ApiPermissionsService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChargeRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $publics = [];
        $permitions = [
            'GET' => 'charge_read',
            'POST' => 'charge_create',
            'PUT' => 'charge_edit',
            'PATCH' => 'charge_edit',
            'DELETE' => 'charge_delete',
        ];

        $result = new ApiPermissionsService($this->user());
        return $result->check($this->method(), $publics, $permitions);
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
                return [];

            case 'POST': {
                    return [
                        'name' => 'required|unique:charges,name',
                        'description' => '',
                    ];
                }

            case 'PATCH': {
                    return [
                        'name' => 'unique:charges,name,' . $this->route('charge'),
                        'description' => '',
                    ];
                }

            case 'PUT':
                return [];

            case 'DELETE':
                return [];

            default:
                break;
        }
    }


    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio.',
            'name.unique' => 'El :attribute ya existe.',
        ];
    }


    public function attributes()
    {
        return [
            'name' => 'nombre del cargo',
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => ['message' => $validator->errors()->all()]], 422));
    }
}
