<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsDnameSeeder extends Seeder
{
    private array $permAction = [
        'list' => 'Список',
        'create' => 'Создание',
        'view' => 'Просмотр',
        'edit' => 'Редактирование',
        'delete' => 'Удаление',
    ];

    private array $permModel = [
        'users' => 'Пользователей',
        'roles' => 'Ролей',
        'customers' => 'Клиентов',
        'addresses' => 'Адресов',
        'products' => 'Товаров',
        'orders' => 'Заказов',
        'media' => 'Медиа',
        'settings' => 'Настроек',
        'taxonomies' => 'Основных категорий',
        'taxons' => 'Категорий',
        'properties' => 'Свойств',
        'property values' => 'Значения свойств',
        'channels' => 'Каналов',
        'payment methods' => 'Методов опаты',
        'invitations' => 'Приглашений',
        'shipping methods' => 'Методов доставки',
        'carriers' => 'Курьеров',
        'zones' => 'Области',
        'tax categories' => 'Категорий налогов',
        'tax rates' => 'Размеров налогов',
        'countries' => 'Стран',
        'provinces' => 'Областей',
        'customer purchases' => 'Покупок клиентов',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()['cache']->forget('konekt.acl.cache');

        $resultPermissions = [];
        foreach ($this->permModel as $nameModel => $model) {
            foreach ($this->permAction as $nameAction => $action) {
                $finalStrName = $nameAction . ' ' . $nameModel;
                $finalStrPerm = $action . ' ' . $model;
                $resultPermissions[$finalStrName] = $finalStrPerm;
            }
        }

        foreach ($resultPermissions as $name => $perm) {
            Permission::updateDname($name, $perm);
        }

    }

}