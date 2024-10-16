<?php

namespace Modules\Admin\app\Models;

use App\Models\Role;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];
    protected $guard_name  = 'admin';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['permission_names'];

    public function getImageAttribute()
    {
        if (isset($this->attributes['image']) && Storage::disk('public')->exists($this->attributes['image'])) {
            return storage_asset($this->attributes['image']);
        } else {
            return asset('assets/images/admin.png');
        }
    }

    public function getPermissionNamesAttribute()
    {
        return $this->role->Permissions->pluck('name')->toArray();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    # Relations 

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


}
