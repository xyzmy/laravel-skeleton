<?php

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class InitializeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app('cache')->forget(config('permission.cache.key'));

        $this->createPermissions();
        $this->createRoles();
        $this->createMenus();
        $this->createAdmins();
    }

    /**
     * 创建权限.
     *
     * @return void
     */
    private function createPermissions()
    {
        $permissions = [
            ['name' => 'telescope', 'cn_name' => 'Telescope'],
            ['name' => 'horizon', 'cn_name' => 'Horizon'],
            ['name' => 'permissions.index', 'cn_name' => '权限列表'],
            ['name' => 'permissions.store', 'cn_name' => '创建权限'],
            ['name' => 'permissions.show', 'cn_name' => '权限详情'],
            ['name' => 'permissions.update', 'cn_name' => '更新权限'],
            ['name' => 'permissions.destroy', 'cn_name' => '删除权限'],
            ['name' => 'roles.index', 'cn_name' => '角色列表'],
            ['name' => 'roles.store', 'cn_name' => '创建角色'],
            ['name' => 'roles.show', 'cn_name' => '角色详情'],
            ['name' => 'roles.update', 'cn_name' => '更新角色'],
            ['name' => 'roles.destroy', 'cn_name' => '删除角色'],
            ['name' => 'admins.index', 'cn_name' => '管理员列表'],
            ['name' => 'admins.store', 'cn_name' => '创建管理员'],
            ['name' => 'admins.show', 'cn_name' => '管理员详情'],
            ['name' => 'admins.update', 'cn_name' => '更新管理员'],
            ['name' => 'admins.destroy', 'cn_name' => '删除管理员'],
            ['name' => 'admins.restore', 'cn_name' => '恢复管理员'],
            ['name' => 'menus.index', 'cn_name' => '菜单列表'],
            ['name' => 'menus.store', 'cn_name' => '创建菜单'],
            ['name' => 'menus.show', 'cn_name' => '菜单详情'],
            ['name' => 'menus.update', 'cn_name' => '更新菜单'],
            ['name' => 'menus.destroy', 'cn_name' => '删除菜单'],
            ['name' => 'easy-sms-logs.index', 'cn_name' => 'EasySms 日志列表'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }

    /**
     * 创建角色.
     *
     * @return void
     */
    private function createRoles()
    {
        $role = Role::create(['name' => 'super-admin', 'cn_name' => '超级管理员']);
        $role->givePermissionTo(Permission::all());
    }

    /**
     * 创建菜单.
     *
     * @return void
     */
    private function createMenus()
    {

    }

    /**
     * 创建管理员.
     *
     * @return void
     */
    private function createAdmins()
    {
        $admin = new Admin([
            'username' => 'super-admin',
            'mobile_number' => '13000000000',
            'password' => '12345678',
            'real_name' => '超级管理员',
            'enabled' => true,
        ]);
        $admin->save();
        $admin->assignRole('super-admin');
    }
}