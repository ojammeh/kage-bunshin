<?php

use Illuminate\Database\Seeder;

use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use Dwij\Laraadmin\Models\ModuleFieldTypes;
use Dwij\Laraadmin\Models\Menu;

use App\Role;
use App\Permission;
use App\Department;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        /* ================ LaraAdmin Seeder Code ================ */
        
        // Generating Module Menus
        $modules = Module::all();
        foreach ($modules as $module) {
            Menu::create([
                "name" => $module->name,
                "url" => $module->name_db,
                "icon" => $module->fa_icon,
                "type" => 'module',
                "parent" => 0
            ]);
        }
		
		// Create Administration Department
       	$dept = new Department;
        $dept->name = "Administration";
        $dept->tags = "[]";
        $dept->color = "#000";
        $dept->hod = 1;
        $dept->save();
		
		// Create Super Admin Role
		$role = new Role;
        $role->name = "SUPER_ADMIN";
        $role->display_name = "Super Admin";
        $role->description = "Full Access Role";
        $role->parent = 0;
        $role->dept = $dept->id;
        $role->save();
		
		// Set Full Access For Super Admin Role
		foreach ($modules as $module) {
            Module::setDefaultRoleAccess($module->id, $role->id, "full");
        }
		
		// Create Admin Panel Permission
		$perm = new Permission;
        $perm->name = "ADMIN_PANEL";
        $perm->display_name = "Admin Panel";
        $perm->description = "Admin Panel Permission";
        $perm->save();
		
		$role->attachPermission($perm);
    }
}
