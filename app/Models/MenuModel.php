<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'url', 'icon', 'parent_id', 'role_id', 'order', 'is_active'];

    public function getAllMenus()
    {
        $builder = $this->db->table('menus');

        // Get all active parent menus
        $parentMenus = $builder
            ->select('id, name, url, icon, is_active, parent_id')
            ->where('is_active', 1)
            ->where('parent_id IS NULL', null, false) // Fetch only top-level
            ->orderBy('`order`', 'ASC') // if using order column
            ->get()
            ->getResultArray();

        // Get all submenus at once
        $submenus = $builder
            ->select('id, name, url, icon, is_active, parent_id')
            ->where('is_active', 1)
            ->where('parent_id IS NOT NULL', null, false)
            ->orderBy('`order`', 'ASC')
            ->get()
            ->getResultArray();

        // Group submenus by parent_id for faster lookup
        $groupedSubmenus = [];
        foreach ($submenus as $submenu) {
            $groupedSubmenus[$submenu['parent_id']][] = $submenu;
        }

        // Attach submenus to their parent menu
        foreach ($parentMenus as &$parentMenu) {
            $parentMenu['submenus'] = $groupedSubmenus[$parentMenu['id']] ?? [];
        }

        return $parentMenus;
    }

    public function getMenus($role_id = NULL)
    {
        $builder = $this->builder();

        // Fetch parent menus (top-level menus)
        $parentMenus = $builder->select('menus.*, menu_role.role_id')
            ->join('menu_role', 'menu_role.menu_id = menus.id', 'left')
            ->where('menus.parent_id', NULL)  // Ensure we are only fetching parent menus
            ->where('menus.is_active', 1)    // Only active menus
            ->where('menu_role.role_id', $role_id)  // Filter by role_id
            ->orderBy('menus.order', 'ASC')  // Order by menu order
            ->get()
            ->getResultArray();

        // Check if parent menus are fetched
        // log_message('debug', 'Parent Menus: ' . print_r($parentMenus, true));

        // Loop through each parent menu to fetch its submenus
        foreach ($parentMenus as &$parentMenu) {
            // Fetch submenus for each parent menu
            $submenus = $builder->select('menus.*')
                ->join('menu_role', 'menu_role.menu_id = menus.id', 'left') // Join to check submenu privileges
                ->where('menus.parent_id', $parentMenu['id'])  // Filter by parent ID
                ->where('menus.is_active', 1)  // Only active submenus
                ->where('menu_role.role_id', $role_id)  // Filter by role_id for submenus
                ->orderBy('menus.order', 'ASC')  // Order submenus by their order
                ->get()
                ->getResultArray();

            // Add submenus to the parent menu array
            $parentMenu['submenus'] = $submenus;
        }

        // Return the parent menus with submenus
        return $parentMenus;
    }
}
