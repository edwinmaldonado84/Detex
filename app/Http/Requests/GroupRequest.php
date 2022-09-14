<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use App\Services\ApiPermissionsService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GroupRequest extends FormRequest
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
            'GET' => 'group_read',
            'POST' => 'group_create',
            'PUT' => 'group_edit',
            'PATCH' => 'group_edit',
            'DELETE' => 'group_delete',
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
                        'name' => 'required|unique:groups,name',
                    ];
                }

            case 'PATCH': {
                    return [
                        'name' => 'unique:groups,name,' . $this->route('group'),
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
            'name' => 'nombre del grupo',
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => ['message' => $validator->errors()->all()]], 422));
    }
}
