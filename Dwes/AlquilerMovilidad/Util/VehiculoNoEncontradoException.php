<?php
namespace Dwes\AlquilerMovilidad\Util;
require_once "AlquilerMovilidadException.php";
class VehiculoNoEncontradoException extends AlquilerMovilidadException
{
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return "<p> No se ha encontrado el vehiculo</p>";
    }
}
