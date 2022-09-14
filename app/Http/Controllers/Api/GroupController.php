<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;
use App\Exceptions\InvalidException;
use App\Http\Controllers\Controller;
use App\Repositories\GroupRepository;

class GroupController extends Controller
{
    use ApiResponse;
    private $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->companyRepository = $groupRepository;
    }

    public function index(GroupRequest $request)
    {

        $list = $this->companyRepository->list($request->all());

        return $this->successResponse($list, 'List', 200);
    }

    public function store(GroupRequest $request)
    {
        $create = $this->companyRepository->create($request->all());

        if (!$create) throw InvalidException::forInvalid("Falló al Crear");

        return $this->successResponse($create, 'Creación Exitosa!', 201);
    }


    public function show(GroupRequest $request, $id)
    {
        $search = $this->companyRepository->find($id);

        if (!$search) throw InvalidException::forInvalid("No se encontro.");

        return $this->successResponse($search, '', 200);
    }


    public function update(GroupRequest $request, $id)
    {

        $payload = $request->all();

        $updated = $this->companyRepository->update($id, $payload);

        if (!$updated) throw InvalidException::forInvalid("Falló al Actualizar");

        return $this->successResponse('', 'Actualización Exitosa!', 200);
    }


    public function destroy(GroupRequest $request, $id)
    {

        try {
            $this->companyRepository->delete($id);
        } catch (\Exception $e) {
            throw InvalidException::forInvalid("No se puede eliminar la clase, hasta que elimine a todos los clientes de la lista de asistencia.");
        }

        return $this->successResponse('', 'Eliminacion Exitosa!', 200);
    }
}
