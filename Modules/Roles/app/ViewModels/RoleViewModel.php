<?php

namespace Modules\Roles\app\ViewModels;

use Illuminate\Support\Collection;
use Modules\Roles\app\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\ViewModels\ViewModel;

class RoleViewModel extends ViewModel
{
    public Role $role;
    public Collection $permissions;
    public array $selectedPermissions;

    public function __construct($role = null)
    {
        $this->role = is_null($role) ? new Role(old()) : $role;
        $this->permissions = Permission::permissionsByGroups();
        $this->selectedPermissions =  is_null($role) ? [] : $role->permissions->pluck('id')->toArray();
    }

    public function action(): string
    {
        return is_null($this->role->id)
            ? route('roles.store')
            : route('roles.update', ['role' => $this->role->id]);
    }

    public function method(): string
    {
        return is_null($this->role->id) ? 'POST' : 'PUT';
    }

}
