<?php

namespace App\Http\Requests;

use App\Models\Company;
use Illuminate\Validation\Rule;
use App\Exceptions\InvalidException;
use App\Services\ApiPermissionsService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BranchRequest extends FormRequest
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
            'GET' => 'branch_read',
            'POST' => 'branch_create',
            'PUT' => 'branch_edit',
            'PATCH' => 'branch_edit',
            'DELETE' => 'branch_delete',
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
                        'rfc' => '',
                        'phone' => '',
                        'address' => '',
                        'owner' => '',
                        'company_id' => [
                            'required',
                            Rule::unique('branches')->where(function ($query) {
                                return $query->where('name', request('name'))
                                    ->where('company_id', request('company_id'));
                            }),
                        ],
                    ];
                }

            case 'PATCH': {
                    return [
                        'name' => 'required',
                        'rfc' => '',
                        'phone' => '',
                        'address' => '',
                        'owner' => '',
                        'company_id' => [
                            'required',
                            Rule::unique('branches')->where(function ($query) {
                                return $query->where('name', request('name'))
                                    ->where('company_id', request('company_id'));
                            })->ignore($this->route('company')),
                        ],
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
            'name.required' => 'El nombre de la :attribute es obligatorio.',
            'company_id.required' => 'La :attribute es obligatoria.',
            'company_id.unique' => 'La :attribute ya tiene esta sucursal.',
        ];
    }


    public function attributes()
    {
        return [
            'name' => 'Sucursal',
            'company_id' => 'Compania',
        ];
    }


    /**
     * @return request merge values and valid after
     */
    public function validationData()
    {
        if ($this->route()->getActionMethod() == 'store') {
            if (!Company::where('id', '=', $this->company_id)->exists()) {


                throw InvalidException::forInvalid('El compania no existe.');
            }
        }
        return array_merge($this->all());
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => ['message' => $validator->errors()->all()]], 422));
    }
}
