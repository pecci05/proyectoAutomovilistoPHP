<?php
namespace Dwes\AlquilerMovilidad\Util;
class VehiculoYaAlquiladoException extends \Dwes\AlquilerMovilidad\Util\AlquilerMovilidadException
{
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return "<p> El vehiculo ya se ha encontrado</p>";
    }
}