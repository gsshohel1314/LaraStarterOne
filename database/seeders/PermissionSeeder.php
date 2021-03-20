<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleAppDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);
        Permission::updateOrCreate([
            'module_id' =>$moduleAppDashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'app.dashboard'
        ]);

        $moduleAppRole = Module::updateOrCreate(['name' => 'Role Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'View Role',
            'slug' => 'app.role.view'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Create Role',
            'slug' => 'app.role.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Edit Role',
            'slug' => 'app.role.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Delete Role',
            'slug' => 'app.role.delete'
        ]);

        //Users
        $moduleAppUser = Module::updateOrCreate(['name' => 'User Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'View User',
            'slug' => 'app.user.view'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Create User',
            'slug' => 'app.user.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Edit User',
            'slug' => 'app.user.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Delete User',
            'slug' => 'app.user.delete'
        ]);

        //Backups
        $moduleAppBackups = Module::updateOrCreate(['name' => 'Backups']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Access Backup',
            'slug' => 'app.backups.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Create Backup',
            'slug' => 'app.backups.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Download Backup',
            'slug' => 'app.backups.download'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Delete Backup',
            'slug' => 'app.backups.delete'
        ]);


        // Pages
        $moduleAppPage = Module::updateOrCreate(['name' => 'Page']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Access Page',
            'slug' => 'app.pages.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Create Page',
            'slug' => 'app.pages.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Edit Page',
            'slug' => 'app.pages.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Delete Page',
            'slug' => 'app.pages.delete'
        ]);

        // Menus
        $moduleAppMenu = Module::updateOrCreate(['name' => 'Menu']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Access Menu',
            'slug' => 'app.menus.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Access Menu Builder',
            'slug' => 'app.menus.builder'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Create Menu',
            'slug' => 'app.menus.create'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Edit Menu',
            'slug' => 'app.menus.edit'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Delete Menu',
            'slug' => 'app.menus.delete'
        ]);
    }
}
