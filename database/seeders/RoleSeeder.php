<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
        


        Permission::create([ 'name' => 'dashboard',
                            'description'  =>  'Ver el deshboard'])->syncRoles([$role1]);

        Permission::create([ 'name' => 'users.index',
                            'description'  =>  'Usuarios'])->syncRoles([$role1]);

        Permission::create([ 'name' => 'empleados.index',
                            'description'  =>  'Empleados'])->syncRoles([$role1]);

        Permission::create([ 'name' => 'roles.index',
                            'description'  =>  'Roles'])->syncRoles([$role1]);

        Permission::create([ 'name' => 'producto.index',
                            'description'  =>  'Productos'])->syncRoles([$role1]);

        Permission::create([ 'name' => 'compra.index',
                            'description'  =>  'Compras'])->syncRoles([$role1]);

        Permission::create([ 'name' => 'insumo.index',
                            'description'  =>  'Insumos'])->syncRoles([$role1]);

        Permission::create([ 'name' => 'categoria.index',
                            'description'  =>  'Categorias'])->syncRoles([$role1]);

        Permission::create([ 'name' => 'proveedor.index',
                            'description'  =>  'Proveedores'])->syncRoles([$role1]);

        Permission::create([ 'name' => 'venta.index',
                            'description'  =>  'Ventas'])->syncRoles([$role1]);
        


    }
}
