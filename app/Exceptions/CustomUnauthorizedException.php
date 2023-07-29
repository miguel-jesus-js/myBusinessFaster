<?php

namespace App\Exceptions;
use Exception;

class CustomUnauthorizedException extends Exception
{
    protected $message = 'No tienes los permisos necesarios para realizar esta acción.';
}
