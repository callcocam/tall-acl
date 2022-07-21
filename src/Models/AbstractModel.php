<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Acl\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tall\Form\Models\Status;
use Tall\Sluggable\SlugOptions;
use Tall\Sluggable\HasSlug;
use Ramsey\Uuid\Uuid;

abstract class AbstractModel extends Model
{
    use  SoftDeletes, HasSlug;
    
    public $incrementing = false;

    protected $keyType = "string";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function statuses(){
        return $this->belongsTo(Status::class);
    }

    public function isUser()
    {
        return false;
    }

    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (is_null($model->id)):
                $model->id = Uuid::uuid4();
            endif;
        });
    }
    
    public function getSlugOptions()
    {
        if (is_string($this->slugTo())) {
            return SlugOptions::create()
                ->generateSlugsFrom($this->slugFrom())
                ->saveSlugsTo($this->slugTo());
        }
    }
}