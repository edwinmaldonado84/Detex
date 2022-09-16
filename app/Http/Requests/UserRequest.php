<?php

namespace App\Http\Requests;

use Spatie\Permission\Models\Role;
use App\Exceptions\InvalidException;
use App\Services\ApiPermissionsService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            'GET' => 'user_read',
            'POST' => 'user_create',
            'PUT' => 'user_edit',
            'PATCH' => 'user_edit',
            'DELETE' => 'user_delete',
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
                        'email' => 'required|unique:users,email',
                        'password' => 'required',
                        'role' => 'required',
                    ];
                }
                //TODO: check not udate password
            case 'PATCH': {
                    return [
                        'name' => 'required',
                        'email' => 'required|unique:users,name,' . $this->route('user'),
                        'password' => '',
                        'role' => 'required',
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
            'email.required' => 'El :attribute es obligatorio.',
            'email.unique' => 'El :attribute ya existen.',
            'password.required' => 'La :attribute es obligatoria.',
            'role_id.required' => 'El :attribute es obligatorio.',
        ];
    }


    public function attributes()
    {
        return [
            'name' => 'nombre',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'role_id' => 'role',
        ];
    }

    public function validationData()
    {
        if ($this->route()->getActionMethod() == 'store' or $this->route()->getActionMethod() == 'update') {
            if (!Role::where('name', '=', $this->role)->exists()) {


                throw InvalidException::forInvalid('El role no existe.');
            }
        }
        return array_merge($this->all());
    }



    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => ['message' => $validator->errors()->all()]], 422));
    }
}
