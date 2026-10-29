<?php
namespace  Dwes\AlquilerMovilidad\Util;
class VehiculoYaAlquiladoException extends AlquilerMovilidadException{
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}