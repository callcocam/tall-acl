<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Acl\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Tall\Acl\Concerns\HasRolesAndPermissions;
use Tall\Cms\Models\MakeImport;

class User extends AbstractModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail,  HasRolesAndPermissions;

    protected $with = ['roles','imports'];

    protected $guarded = ['id'];
     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url','access'
    ];

      /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
    ];

    public function getAccessAttribute()
    {
        $roles = array_values($this->roles()->pluck("id", "id")->toArray());
        
        return $roles;
    }

    public function scopeRoles($query, $term)
    {
        return $query->whereHas('roles', function ($builder) use ($term) {
            $builder->where('id', $term);
        });
    }

    public function isUser(){
        return false;
    }

    

    public function imports()
    {
        if(class_exists('\\App\\Models\\MakeImport')){
            return $this->hasMany('\\App\\Models\\MakeImport');
        }
        return $this->hasMany(MakeImport::class);
    }

}
