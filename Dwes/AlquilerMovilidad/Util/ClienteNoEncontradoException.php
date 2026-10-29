<?php

namespace Dwes\AlquilerMovilidad\Util;
class ClienteNoEncontradoException extends \Dwes\AlquilerMovilidad\Util\AlquilerMovilidadException
{
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return "<p> Cliente no encontrado </p>";
    }

}