<?php


namespace App\Facades;


use App\Services\AuthService;
use Illuminate\Support\Facades\Facade;
/**
 * @method static array login(array $credentials)
 * @method static array register(array $request)
 * @method static array deleteUser(int $id)
 * @method static \Illuminate\Contracts\Pagination\LengthAwarePaginator getListUser()
 */
class UserFacade extends facade
{
    public static function getFacadeAccessor()
    {
        return AuthService::class;
    }
}
