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
use Tall\Acl\Contracts\IPermission;
use Tall\Acl\Contracts\IRole;

class Permission extends AbstractModel implements IPermission
{
    use RefreshesPermissionCache, HasFactory;

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
        return $this->belongsToMany(app(IRole::class))->withTimestamps();
    }
    
    protected function slugTo()
    {
        return false;
    }
}
