<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use App\Http\Requests\UserRequest;
use App\Exceptions\InvalidException;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\ProfileResource;

class UserController extends Controller
{
    use ApiResponse;
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(UserRequest $request)
    {

        $list = $this->userRepository->list($request->all());
        $listResource = new UserResource($list);
        return $this->successResponse($listResource, 'List', 200);
    }

    public function store(UserRequest $request)
    {
        $create = $this->userRepository->create($request->all());

        if (!$create) throw InvalidException::forInvalid("Falló al Crear");

        $create->assignRole($request->role);

        return $this->successResponse($create, 'Creación Exitosa!', 201);
    }


    public function show(UserRequest $request, $id)
    {
        $search = $this->userRepository->find($id);

        if (!$search) throw InvalidException::forInvalid("No se encontro.");

        $listResource = new ProfileResource($search);

        return $this->successResponse($listResource, '', 200);
    }


    public function update(UserRequest $request, $id)
    {

        $payload = $request->all();

        $updated = $this->userRepository->update($id, $payload);

        if (!$updated) throw InvalidException::forInvalid("Falló al Actualizar");

        $user = $this->userRepository->find($id);
        $user->syncRoles($request->role);

        return $this->successResponse('', 'Actualización Exitosa!', 200);
    }


    public function destroy(UserRequest $request, $id)
    {
        if (!$this->userRepository->exist($id)) throw InvalidException::forInvalid("No existe");

        try {
            $this->userRepository->delete($id);
        } catch (\Exception $e) {
            throw InvalidException::forInvalid("No se puede eliminar la clase, hasta que elimine a todos los clientes de la lista de asistencia.");
        }

        return $this->successResponse('', 'Eliminacion Exitosa!', 200);
    }
}
