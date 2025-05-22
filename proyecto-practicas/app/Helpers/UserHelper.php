<?php


use App\Enums\Rol;
use App\Models\User;

if (!function_exists('getUser'))
{
    /**
     * @return User
     */
    function getUser(): User
    {
        /** @var User $user */
        $user = auth()->user();
        return $user;
    }
}

if (!function_exists('getUserRol')) {
    /**
     * @return Rol
     */
    function getUserRol(): Rol
    {
        return getUser()->getAttribute('rol');
    }
}

if (!function_exists('getUserId')) {
    /**
     * @return int
     */
    function getUserId(): int
    {
        return getUser()->getAttribute('id');
    }
}

if (!function_exists('getUserName')) {
    /**
     * @return string
     */
    function getUserName(): string
    {
        return getUser()->getAttribute('name');
    }
}
