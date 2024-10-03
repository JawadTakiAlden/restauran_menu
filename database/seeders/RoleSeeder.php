<?php

namespace Database\Seeders;

use App\AdminPermission;
use App\AppRoles;
use App\ResPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            AdminPermission::CREATE_RES,
            AdminPermission::UPDATE_RES,
            AdminPermission::DELETE_RES,
            AdminPermission::UPDATE_LOGO,
            AdminPermission::STOP_RES,
            AdminPermission::RENEW_RES,
            AdminPermission::CREATE_TEMPLATE,
            AdminPermission::UPDATE_TEMPLATE,
            AdminPermission::DELETE_TEMPLATE,
            AdminPermission::SHOW_TEMPLATE,
            AdminPermission::CREATE_TEMPLATE_COLOR,
            AdminPermission::DELETE_TEMPLATE_COLOR,
            AdminPermission::UPDATE_TEMPLATE_COLOR,
            AdminPermission::CREATE_TEMPLATE_TRANSLATION,
            AdminPermission::UPDATE_TEMPLATE_TRANSLATION,
            AdminPermission::DELETE_TEMPLATE_TRANSLATION,
            AdminPermission::DELETE_RES_SUBSCRIPTION,
            ResPermission::CREATE_CATEGORY,
            ResPermission::UPDATE_CATEGORY,
            ResPermission::DELETE_CATEGORY,
            ResPermission::SHOW_CATEGORY,
            ResPermission::CREATE_PRODUCT,
            ResPermission::UPDATE_PRODUCT,
            ResPermission::DELETE_PRODUCT,
            ResPermission::SHOW_PRODUCT,
            ResPermission::CREATE_CATEGORY_TRANLSATION,
            ResPermission::DELETE_CATEGORY_TRANLSATION,
            ResPermission::UPDATE_CATEGORY_TRANLSATION,
            ResPermission::CREATE_PRODUCT_TRANLSATION,
            ResPermission::UPDATE_PRODUCT_TRANLSATION,
            ResPermission::DELETE_PRODUCT_TRANLSATION,
            ResPermission::CREATE_OFFER,
            ResPermission::DELETE_OFFER,
        ];

        foreach ($permissions as $permission){
            Permission::create(['name' => $permission]);
        }

        $superAdmin = Role::create(['name' => AppRoles::SUPER_ADMIN]);

        $superAdmin->syncPermissions([
            AdminPermission::CREATE_RES,
            AdminPermission::UPDATE_RES,
            AdminPermission::DELETE_RES,
            AdminPermission::UPDATE_LOGO,
            AdminPermission::STOP_RES,
            AdminPermission::RENEW_RES,
            AdminPermission::CREATE_TEMPLATE,
            AdminPermission::UPDATE_TEMPLATE,
            AdminPermission::DELETE_TEMPLATE,
            AdminPermission::SHOW_TEMPLATE,
            AdminPermission::CREATE_TEMPLATE_COLOR,
            AdminPermission::DELETE_TEMPLATE_COLOR,
            AdminPermission::UPDATE_TEMPLATE_COLOR,
            AdminPermission::CREATE_TEMPLATE_TRANSLATION,
            AdminPermission::UPDATE_TEMPLATE_TRANSLATION,
            AdminPermission::DELETE_TEMPLATE_TRANSLATION,
            AdminPermission::DELETE_RES_SUBSCRIPTION,
            ResPermission::CREATE_CATEGORY,
            ResPermission::UPDATE_CATEGORY,
            ResPermission::DELETE_CATEGORY,
            ResPermission::SHOW_CATEGORY,
            ResPermission::CREATE_PRODUCT,
            ResPermission::UPDATE_PRODUCT,
            ResPermission::DELETE_PRODUCT,
            ResPermission::SHOW_PRODUCT,
            ResPermission::CREATE_CATEGORY_TRANLSATION,
            ResPermission::DELETE_CATEGORY_TRANLSATION,
            ResPermission::UPDATE_CATEGORY_TRANLSATION,
            ResPermission::CREATE_PRODUCT_TRANLSATION,
            ResPermission::UPDATE_PRODUCT_TRANLSATION,
            ResPermission::DELETE_PRODUCT_TRANLSATION,
            ResPermission::CREATE_OFFER,
            ResPermission::DELETE_OFFER,
        ]);
        $restaurant = Role::create(['name' => AppRoles::RESTAURANT]);
        $restaurant->syncPermissions([
            ResPermission::CREATE_CATEGORY,
            ResPermission::UPDATE_CATEGORY,
            ResPermission::DELETE_CATEGORY,
            ResPermission::SHOW_CATEGORY,
            ResPermission::CREATE_PRODUCT,
            ResPermission::UPDATE_PRODUCT,
            ResPermission::DELETE_PRODUCT,
            ResPermission::SHOW_PRODUCT,
            ResPermission::CREATE_CATEGORY_TRANLSATION,
            ResPermission::DELETE_CATEGORY_TRANLSATION,
            ResPermission::UPDATE_CATEGORY_TRANLSATION,
            ResPermission::CREATE_PRODUCT_TRANLSATION,
            ResPermission::UPDATE_PRODUCT_TRANLSATION,
            ResPermission::DELETE_PRODUCT_TRANLSATION,
            ResPermission::CREATE_OFFER,
            ResPermission::DELETE_OFFER,
        ]);
    }
}
