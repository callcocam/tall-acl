<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Acl\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tall\Acl\Concerns\RefreshesPermissionCache;
use Tall\Acl\Concerns\UsesLandlordConnection;
use Tall\Acl\Contracts\Permission as ContractsPermission;

class Permission extends AbstractModel implements ContractsPermission
{
    use RefreshesPermissionCache, UsesLandlordConnection, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Permissions can belong to many roles.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(config('acl.models.role'))->withTimestamps();
    }
    
    protected function slugTo()
    {
        return false;
    }
}
