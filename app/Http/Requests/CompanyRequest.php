<?php

namespace App\Http\Requests;

use App\Exceptions\InvalidException;
use App\Models\Group;
use App\Services\ApiPermissionsService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
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
                        'name' => '',
                        'business_name' => 'required|unique:companies,business_name',
                        'rfc' => 'required|unique:companies,rfc',
                        'webpage' => '',
                        'observations' => '',
                        'group_id' => 'required',
                    ];
                }

            case 'PATCH': {
                    return [
                        'name' => '',
                        'business_name' => 'unique:companies,business_name,' . $this->route('company'),
                        'rfc' => 'unique:companies,rfc,' . $this->route('company'),
                        'webpage' => '',
                        'observations' => '',
                        'group_id' => 'required',
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
            'business_name.required' => 'La :attribute es obligatoria.',
            'business_name.unique' => 'La :attribute ya existe.',
            'rfc.required' => 'El :attribute es obligatorio.',
            'rfc.unique' => 'El :attribute ya existe.',
            'group_id.required' => 'La :attribute es obligatoria.',
        ];
    }


    public function attributes()
    {
        return [
            'name' => 'raz??n social',
            'rfc' => 'RCF',
            'group_id' => 'agrupaci??n',
        ];
    }

    public function validationData()
    {
        if ($this->route()->getActionMethod() == 'store' or $this->route()->getActionMethod() == 'update') {
            if (!Group::where('id', '=', $this->group_id)->exists()) {


                throw InvalidException::forInvalid('La agrupaci??n no existe.');
            }
        }
        return array_merge($this->all());
    }



    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => ['message' => $validator->errors()->all()]], 422));
    }
}
