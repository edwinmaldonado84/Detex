<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use App\Exceptions\InvalidException;
use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Repositories\BranchRepository;

class BranchController extends Controller
{
    use ApiResponse;
    private $branchRepository;

    public function __construct(BranchRepository $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    public function index(BranchRequest $request)
    {

        $list = $this->branchRepository->list($request->all());

        return $this->successResponse($list, 'List', 200);
    }

    public function store(BranchRequest $request)
    {
        $create = $this->branchRepository->create($request->all());

        if (!$create) throw InvalidException::forInvalid("Falló al Crear");

        return $this->successResponse($create, 'Creación Exitosa!', 201);
    }


    public function show(BranchRequest $request, $id)
    {
        $search = $this->branchRepository->find($id);

        if (!$search) throw InvalidException::forInvalid("No se encontro.");

        return $this->successResponse($search, '', 200);
    }


    public function update(BranchRequest $request, $id)
    {

        $payload = $request->all();

        $updated = $this->branchRepository->update($id, $payload);

        if (!$updated) throw InvalidException::forInvalid("Falló al Actualizar");

        return $this->successResponse('', 'Actualización Exitosa!', 200);
    }


    public function destroy(BranchRequest $request, $id)
    {

        try {
            $this->branchRepository->delete($id);
        } catch (\Exception $e) {
            throw InvalidException::forInvalid("No se puede eliminar la clase, hasta que elimine a todos los clientes de la lista de asistencia.");
        }

        return $this->successResponse('', 'Eliminacion Exitosa!', 200);
    }
}
