<?php


namespace App\Facades;


use App\Services\AuthService;
use Illuminate\Support\Facades\Facade;

class UserFacade extends facade
{
    /**
     * * @method static array login()
     */
    public static function getFacadeAccessor()
    {
        return AuthService::class;
    }
}
