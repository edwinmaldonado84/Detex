<?php
namespace App\Core;


use Illuminate\Support\Collection;

class Result
{
    /**
     * @var bool
     */
    protected $success = false;

    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @var string
     */
    protected $message = 'Proceso exitoso.';

    /**
     * @var null|mixed
     */
    protected $data;

    const MESSAGE_FORBIDDEN = "Acción prohibida.";
    const MESSAGE_NOT_FOUND = "Recurso no encontrado.";
    const MESSAGE_UNAUTHORIZED = "No tienes suficiente permiso.";
    const MESSAGE_ERROR_500 = "Se ha producido un error en el servidor.";
    const MESSAGE_FAILED_CREATE = "No logró crearlo.";
    const MESSAGE_FAILED_UPDATE = "No se actualizó.";
    const MESSAGE_FAILED_DELETE = "No ha podido eliminar.";
    const MESSAGE_SUCCESS = "Éxito en la transacción.";
    const MESSAGE_SUCCESS_LIST = "Se en listo con exito.";
    const MESSAGE_SUCCESS_CREATE = "Creación exitosa.";
    const MESSAGE_SUCCESS_UPDATE = "Actualización exitosa.";
    const MESSAGE_SUCCESS_DELETE = "Eliminación exitosa.";

    /**
     * Command result object constructor
     *
     * @param bool $success
     * @param string $message
     * @param null $data
     * @param int $statusCode
     */
    public function __construct($success = false, $message = '', $data = null, $statusCode = 200)
    {
        $this->success = $success;
        $this->message = $message;
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    /**
     * @param bool $success
     * @param string $message
     * @param null $data
     * @param int $statusCode
     * @return $this
     */
    public function set($success = false, $message = '', $data = null, $statusCode = 200)
    {
        $this->success = $success;
        $this->message = $message;
        $this->statusCode = $statusCode;
        $this->data = $data;

        return $this;
    }

    /**
     * determine if command transaction was successful
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->success;
    }

    /**
     * the status code
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * the command result message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * the command result returned data
     *
     * @return null
     */
    public function getData()
    {
        if( is_null($this->data) ) return new Collection();

        if( is_array($this->data) ) return new Collection($this->data);

        return $this->data;
    }
}
