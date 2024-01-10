<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_building","view_any_building","create_building","update_building","restore_building","restore_any_building","replicate_building","reorder_building","delete_building","delete_any_building","force_delete_building","force_delete_any_building","view_feature","view_any_feature","create_feature","update_feature","restore_feature","restore_any_feature","replicate_feature","reorder_feature","delete_feature","delete_any_feature","force_delete_feature","force_delete_any_feature","view_property::type","view_any_property::type","create_property::type","update_property::type","restore_property::type","restore_any_property::type","replicate_property::type","reorder_property::type","delete_property::type","delete_any_property::type","force_delete_property::type","force_delete_any_property::type","view_reservation","view_any_reservation","create_reservation","update_reservation","restore_reservation","restore_any_reservation","replicate_reservation","reorder_reservation","delete_reservation","delete_any_reservation","force_delete_reservation","force_delete_any_reservation","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_room","view_any_room","create_room","update_room","restore_room","restore_any_room","replicate_room","reorder_room","delete_room","delete_any_room","force_delete_room","force_delete_any_room","view_room::type","view_any_room::type","create_room::type","update_room::type","restore_room::type","restore_any_room::type","replicate_room::type","reorder_room::type","delete_room::type","delete_any_room::type","force_delete_room::type","force_delete_any_room::type","view_season","view_any_season","create_season","update_season","restore_season","restore_any_season","replicate_season","reorder_season","delete_season","delete_any_season","force_delete_season","force_delete_any_season","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","page_TranslationManagerPage","page_Themes","page_MyProfilePage","widget_TranslationStatusWidget"]},{"name":"employee","guard_name":"web","permissions":["view_building","view_any_building","create_building","update_building","restore_building","restore_any_building","replicate_building","reorder_building","delete_building","delete_any_building","force_delete_building","force_delete_any_building","view_feature","view_any_feature","create_feature","update_feature","restore_feature","restore_any_feature","replicate_feature","reorder_feature","delete_feature","delete_any_feature","force_delete_feature","force_delete_any_feature","view_property::type","view_any_property::type","create_property::type","view_reservation","view_any_reservation","create_reservation","update_reservation","restore_reservation","restore_any_reservation","replicate_reservation","reorder_reservation","delete_reservation","delete_any_reservation","force_delete_reservation","force_delete_any_reservation","view_room","view_any_room","create_room","update_room","restore_room","restore_any_room","replicate_room","reorder_room","delete_room","delete_any_room","force_delete_room","force_delete_any_room","view_room::type","view_any_room::type","create_room::type","view_season","view_any_season","update_season","page_MyProfilePage","widget_CalendarWidget"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
