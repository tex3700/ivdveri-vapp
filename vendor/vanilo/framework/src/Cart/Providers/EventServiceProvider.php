<?php

declare(strict_types=1);

/**
 * Contains the EventServiceProvider class.
 *
 * @copyright   Copyright (c) 2017 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2018-02-14
 *
 */

namespace Vanilo\Cart\Providers;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Vanilo\Cart\Listeners\AssignUserToCart;
use Vanilo\Cart\Listeners\DissociateUserFromCart;
use Vanilo\Cart\Listeners\RestoreCurrentUsersLastActiveCart;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            AssignUserToCart::class,
            RestoreCurrentUsersLastActiveCart::class,
        ],
        Authenticated::class => [
            AssignUserToCart::class,
            RestoreCurrentUsersLastActiveCart::class,
        ],
        Logout::class => [
            DissociateUserFromCart::class
        ],
        Lockout::class => [
            DissociateUserFromCart::class
        ]
    ];
}
