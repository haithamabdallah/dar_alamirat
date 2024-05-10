<?php

namespace Modules\Admin\app\ViewModels;

use Modules\Admin\app\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\ViewModels\ViewModel;

class AdminViewModel extends ViewModel
{
    public Admin $admin;
    public $roles;

    public function __construct($admin = null)
    {
        $this->admin = is_null($admin) ? new Admin(old()) : $admin;
        $this->roles = Role::get();
    }

    public function action(): string
    {
        return is_null($this->admin->id)
            ? route('admin.store')
            : route('admin.update', ['admin' => $this->admin->id]);
    }

    public function method(): string
    {
        return is_null($this->admin->id) ? 'POST' : 'PUT';
    }

}
