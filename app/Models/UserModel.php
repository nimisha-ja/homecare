<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'email', 'password', 'role_id', 'is_active', 'reset_token'];

    public function getUserByEmail($username)
    {
        $username = trim($username);
        return $this->where('LOWER(email)', strtolower($username))->first();
    }
    public function getUsersWithRoles($perPage, $currentPage)
    {
        return $this->select('users.id, users.username, users.email, users.is_active, users.created_at, users.updated_at, roles.role_name, roles.description')
            ->join('roles', 'users.role_id = roles.id')
            ->paginate($perPage, 'default', $currentPage);
    }
    public function getUsersWithRolesnHubs($perPage, $currentPage)
    {
        return $this->select('users.id, users.username, users.email, users.is_active, users.created_at, users.updated_at, roles.role_name, roles.description, hub.hub_name')
            ->join('roles', 'users.role_id = roles.id')
            ->join('hub', 'users.hub = hub.hub_id', 'left') // Use 'left' for LEFT JOIN
            ->paginate($perPage, 'default', $currentPage);
    }
    public function getUsersWithRole()
    {
        return $this->select('users.id, users.username, users.email, users.is_active, users.created_at, users.updated_at, roles.role_name, roles.description')
            ->join('roles', 'users.role_id = roles.id')
            ->findAll();  // Returns all results without pagination
    }

    
}    
