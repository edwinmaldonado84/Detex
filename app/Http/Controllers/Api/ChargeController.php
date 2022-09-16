<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use App\Exceptions\InvalidException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChargeRequest;
use App\Repositories\ChargeRepository;

class ChargeController extends Controller
{
    use ApiResponse;
    private $chargeRepository;

    public function __construct(ChargeRepository $chargeRepository)
    {
        $this->chargeRepository = $chargeRepository;
    }

    public function index(ChargeRequest $request)
    {

        $list = $this->chargeRepository->list($request->all());

        return $this->successResponse($list, 'List', 200);
    }

    public function store(ChargeRequest $request)
    {
        $create = $this->chargeRepository->create($request->all());

        if (!$create) throw InvalidException::forInvalid("Falló al Crear");

        return $this->successResponse($create, 'Creación Exitosa!', 201);
    }


    public function show(ChargeRequest $request, $id)
    {
        $search = $this->chargeRepository->find($id);

        if (!$search) throw InvalidException::forInvalid("No se encontro.");

        return $this->successResponse($search, '', 200);
    }


    public function update(ChargeRequest $request, $id)
    {

        $payload = $request->all();

        $updated = $this->chargeRepository->update($id, $payload);

        if (!$updated) throw InvalidException::forInvalid("Falló al Actualizar");

        return $this->successResponse('', 'Actualización Exitosa!', 200);
    }


    public function destroy(ChargeRequest $request, $id)
    {
        if (!$this->chargeRepository->exist($id)) throw InvalidException::forInvalid("No existe");

        try {
            $this->chargeRepository->delete($id);
        } catch (\Exception $e) {
            throw InvalidException::forInvalid("No se puede eliminar la clase, hasta que elimine a todos los clientes de la lista de asistencia.");
        }

        return $this->successResponse('', 'Eliminacion Exitosa!', 200);
    }
}
