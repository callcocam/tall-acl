<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Acl\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tall\Acl\Concerns\HasPermissions;
use Tall\Acl\Contracts\IRole;
use Tall\Acl\Contracts\IUser;
use Tall\Tenant\Contracts\ITenant;
use Tall\Tenant\Models\Landlord\Tenant;

class Role extends AbstractModel implements IRole
{
    use HasPermissions, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    protected $with = ['access'];
    protected $appends = ['permissions'];

    public function getPermissionsAttribute()
    {
        return array_values($this->permissions()->pluck('id','id')->toArray());
    }

    public function access()
    {

        return $this->permissions();
    }
    
    public function scopeTenants($query, $term)
    {
        return $query->whereHas('hasTenants', function ($builder) use ($term) {
            $builder->where('id', $term);
        });
    }

    public function hasTenants()
    {
        return $this->belongsToMany(Tenant::class)->withTimestamps();
    }
    /**
     * Roles can belong to many users.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany( app(IUser::class))->withTimestamps();
    }

    /**
     * Determine if role has permission flags.
     *
     * @return bool
     */
    public function hasPermissionFlags(): bool
    {
        return ! is_null($this->special);
    }

    /**
     * Determine if the requested permission is permitted or denied
     * through a special role flag.
     *
     * @return bool
     */
    public function hasPermissionThroughFlag(): bool
    {
        if ($this->hasPermissionFlags()) {
            return ! ($this->special === 'no-access');
        }

        return true;
    }
}
