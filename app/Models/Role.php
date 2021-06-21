<?php

namespace App\Models;

use App\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, HasPermissions;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }
    public function hasPermissionTo(...$permissions)
    {
        //role->hasPermissionTo ('edit-user', 'edit-issue')
        return $this->permissions()->whereIn('slug', $permissions)->count();

    }

    //Este funcao serviu para colocar no Model do registar ao inves de fazer la. 
    public function scopeDeveloper($query)
    {
        return $query->where('slug', 'developer');
         
    }
    public function scopeAdmin($query)
    {
        return $query->where('slug', 'admin');
         
    }
    public function scopeVendor($query)
    {
        return $query->where('slug', 'vendor');
         
    }
}
