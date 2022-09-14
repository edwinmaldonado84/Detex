<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use App\Exceptions\InvalidException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Repositories\contactRepository;

class ContactController extends Controller
{
    use ApiResponse;
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function index(ContactRequest $request)
    {

        $list = $this->contactRepository->list($request->all());

        return $this->successResponse($list, 'List', 200);
    }

    public function store(ContactRequest $request)
    {
        $create = $this->contactRepository->create($request->all());

        if (!$create) throw InvalidException::forInvalid("Falló al Crear");

        return $this->successResponse($create, 'Creación Exitosa!', 201);
    }


    public function show(ContactRequest $request, $id)
    {
        $search = $this->contactRepository->find($id);

        if (!$search) throw InvalidException::forInvalid("No se encontro.");

        return $this->successResponse($search, '', 200);
    }


    public function update(ContactRequest $request, $id)
    {

        $payload = $request->all();

        $updated = $this->contactRepository->update($id, $payload);

        if (!$updated) throw InvalidException::forInvalid("Falló al Actualizar");

        return $this->successResponse('', 'Actualización Exitosa!', 200);
    }


    public function destroy(ContactRequest $request, $id)
    {

        try {
            $this->contactRepository->delete($id);
        } catch (\Exception $e) {
            throw InvalidException::forInvalid("No se puede eliminar la clase, hasta que elimine a todos los clientes de la lista de asistencia.");
        }

        return $this->successResponse('', 'Eliminacion Exitosa!', 200);
    }
}
