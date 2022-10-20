<?php

class mainController
{

    public static function helloWorld($request, $context)
    {
        $context->mavariable = "hello world";
        return context::SUCCESS;
    }

    public static function superTest($request, $context)
    {
        $context->var = "j'ai compris $request[param1], super : $request[param2]";
        return context::SUCCESS;
    }

    public static function index($request, $context)
    {

        return context::SUCCESS;
    }

    public static function login($request, $context)
    {
        $context->user = utilisateurTable::getUserByLoginAndPass($request['login'], $request['pass']);
        if ($context->user == false) return context::ERROR;
        return context::SUCCESS;
    }

    public static function trajet($request, $context)
    {
        $context->trajet = trajetTable::getTrajet($request['depart'], $request['arrivee']);
        if ($context->trajet == false) return context::ERROR;
        return context::SUCCESS;
    }


}
