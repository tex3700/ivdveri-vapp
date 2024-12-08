<?php

namespace App\Models;

use Konekt\Acl\Traits\HasRoles;
class User extends \Konekt\AppShell\Models\User
{
    use HasRoles;
}
