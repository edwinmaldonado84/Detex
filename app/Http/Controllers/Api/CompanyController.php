<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use App\Exceptions\InvalidException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Repositories\CompanyRepository;

class CompanyController extends Controller
{
    use ApiResponse;
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index(CompanyRequest $request)
    {

        $list = $this->companyRepository->list($request->all());

        return $this->successResponse($list, 'List', 200);
    }

    public function store(CompanyRequest $request)
    {
        $create = $this->companyRepository->create($request->all());

        if (!$create) throw InvalidException::forInvalid("Falló al Crear");

        return $this->successResponse($create, 'Creación Exitosa!', 201);
    }


    public function show(CompanyRequest $request, $id)
    {
        $search = $this->companyRepository->find($id);

        if (!$search) throw InvalidException::forInvalid("No se encontro.");

        return $this->successResponse($search, '', 200);
    }


    public function update(CompanyRequest $request, $id)
    {

        $payload = $request->all();

        $updated = $this->companyRepository->update($id, $payload);

        if (!$updated) throw InvalidException::forInvalid("Falló al Actualizar");

        return $this->successResponse('', 'Actualización Exitosa!', 200);
    }


    public function destroy(CompanyRequest $request, $id)
    {
        if (!$this->companyRepository->exist($id)) throw InvalidException::forInvalid("No existe");

        try {
            $this->companyRepository->delete($id);
        } catch (\Exception $e) {
            throw InvalidException::forInvalid("No se puede eliminar la clase, hasta que elimine a todos los clientes de la lista de asistencia.");
        }

        return $this->successResponse('', 'Eliminacion Exitosa!', 200);
    }
}
