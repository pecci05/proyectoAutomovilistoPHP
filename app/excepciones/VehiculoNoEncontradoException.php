<?php
namespace  Dwes\AlquilerMovilidad\Util;
class VehiculoNoEncontradoException extends AlquilerMovilidadException{
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}