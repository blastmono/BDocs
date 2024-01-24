<?php

namespace App\Enums;

enum RolesEnum: string
{
    case SuperAdmin = 'superAdmin';
    case Administrador = 'admin';
    case usuario = 'usuario';

    public function label():string
    {
        return match($this)
        {
            static::SuperAdmin =>'SuperAdmin',
            static::Administrador=>'Administrador',
            static::usuario=>'Usuario',
        };
    }

}