<?php 

namespace App\Traits;

use App\Models\Permission;  

trait HasPermissions {

    public function permissions()
    {
        return $this->belongsToMany(Role::class, 'users_permissions');
    }

    
    public function hasRole(...$roles)
    {
        return $this->roles()->whereIn('slug', $roles)->count();
    }
    public function hasPermissionTo(...$permissions)
    {
        //user->hasPermissionTo ('edit-user', 'edit-issue')
        return $this->permissions()->whereIn('slug', $permissions)->count() ||
        $this->roles()->whereHas('permissions', function ($q) use ($permissions){
            $q->whereIn('slug', $permissions);
        })->count();

    }

    
    private function getPermissionsIdsBySlug($permissions)
    {
        return Permission::whereIn('slug', $permissions)->get()->pluck('id')->toArray();
    }


    public function givePermissionsTo(...$permissions)
    {
        return $this->permissions()->attach($this->getPermissionsIdsBySlug($permissions));
    }
    public function setPermissionsTo(...$permissions)
    {
        return $this->permissions()->sync($this->getPermissionsIdsBySlug($permissions));
    }
    public function detachPermissionTo(...$permissions)
    {
        return $this->permissions()->detach($this->getPermissionsIdsBySlug($permissions));
    }
}
