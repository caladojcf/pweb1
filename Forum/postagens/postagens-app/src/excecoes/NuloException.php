<?php

/**
 * Created by PhpStorm.
 * User: Berg
 * Date: 16/01/17
 * Time: 22:58
 */
//namespace br\com\magazine\excecoes;

class NuloException extends Exception
{
    function __construct()
    {
        parent::__construct("Valor nulo!");
    }

}