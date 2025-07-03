<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuRoleModel extends Model
{
    protected $table = 'menu_role';
    protected $primaryKey = 'id';
    protected $allowedFields = ['menu_id', 'role_id'];
    public function getRolesForMenu($menuId)
    {
        return $this->where('menu_id', $menuId)->findAll();
    }
    public function deleteUserPrivileges($user_id)
    {
        return $this->where('role_id', $user_id)->delete();
    }
   
    public function getAllPrivileges($limit, $offset)
    {
        return $this->select('menu_role.menu_id, menu_role.role_id, menus.name as menu_name, roles.role_name as role_name')
            ->join('menus', 'menus.id = menu_role.menu_id')  // Join with the menus table to get menu names
            ->join('roles', 'roles.id = menu_role.role_id')  // Join with the roles table to get role names
            ->orderBy('roles.role_name', 'ASC') // Order by role name
            ->paginate($limit, 'default', $offset); // Paginate the result
    }
}
