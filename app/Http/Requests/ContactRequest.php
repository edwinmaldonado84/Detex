<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Validation\Rule;
use App\Exceptions\InvalidException;
use App\Services\ApiPermissionsService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactRequest extends FormRequest
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
            'GET' => 'contact_read',
            'POST' => 'contact_create',
            'PUT' => 'contact_edit',
            'PATCH' => 'contact_edit',
            'DELETE' => 'contact_delete',
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
                        'name' => 'required',
                        'last_name' => [
                            'required',
                            Rule::unique('contacts')->where(function ($query) {
                                return $query->where('name', request('name'))
                                    ->where('last_name', request('last_name'));
                            }),
                        ],
                        'birtday' => '',
                        'observations' => '',
                    ];
                }

            case 'PATCH': {
                    return [
                        'name' => 'required',
                        'last_name' => [
                            'required',
                            Rule::unique('contacts')->where(function ($query) {
                                return $query->where('name', request('name'))
                                    ->where('last_name', request('last_name'));
                            })->ignore($this->route('contact')),
                        ],
                        'birtday' => '',
                        'observations' => '',
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
            'last_name.required' => 'El :attribute es obligatorio.',
            'last_name.unique' => 'El nombre y apellido ya existen.',
        ];
    }


    public function attributes()
    {
        return [
            'name' => 'nombre',
            'last_name' => 'apellido',
        ];
    }


    /**
     * @return request merge values and valid after
     */
    /*  public function validationData()
    {
        if ($this->route()->getActionMethod() == 'store') {
            if (!Company::where('id', '=', $this->company_id)->exists()) {


                throw InvalidException::forInvalid('El compania no existe.');
            }
        }
        return array_merge($this->all());
    } */


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => ['message' => $validator->errors()->all()]], 422));
    }
}
