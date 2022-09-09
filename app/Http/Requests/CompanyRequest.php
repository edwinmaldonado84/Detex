<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use App\Services\ApiPermissionsService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CompanyRequest extends FormRequest
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
            'GET' => 'company_read',
            'POST' => 'company_create',
            'PUT' => 'company_edit',
            'PATCH' => 'company_edit',
            'DELETE' => 'company_delete',
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
                        'name' => 'required|unique:companies,name',
                        'rfc' => '',
                        'phone' => '',
                        'address' => '',
                        'owner' => ''
                    ];
                }

            case 'PATCH': {
                    return [
                        'name' => 'unique:companies,name,' . $this->route('company'),
                        'rfc' => '',
                        'phone' => '',
                        'address' => '',
                        'owner' => ''
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
            'name.unique' => 'El :attribute ya ha sido usado.',
        ];
    }


    public function attributes()
    {
        return [
            'name' => 'Nombre de la compania',
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => ['message' => $validator->errors()->all()]], 422));
    }
}
