<?php

namespace App\Models;

use Konekt\Acl\Exceptions\PermissionAlreadyExists;
use Konekt\Acl\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    public static function updateDname(string $name, string $dName)
    {
        if (static::getPermissions()->where('name', $name)->first()) {
            return static::query()->where('name', $name)->update(['display_name' => $dName]);
        } else {
            throw PermissionAlreadyExists::create($name, 'web');
        }
    }

}