<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Tall\Acl;

use Tall\Acl\Models\Permission;
use Illuminate\Support\Facades\Artisan;

class LoadRouterHelper
{

    /**
     * @var array
     */
    private $ignore = ['auth', 'store', 'remove-file', 'auto-route', 'translate', 'profile'];

    /**
     * @var array
     */
    private $required = ['admin','app','list', 'show'];


    public static function make()
    {

        $make = new static();

        return $make->load();
    }


    public static function save(){

        $permissions = self::make();

        foreach ($permissions as $permission) {

            if(!Permission::query()->where('slug', $permission)->count()){
                $permissionArr = explode(".", $permission);
                $last = \Arr::last($permissionArr);
                if(!in_array($last, ['edit','create','show'])){
                    $last = "index";
                }
                $name = str_replace(".", " ", \Illuminate\Support\Str::title($permission));
                Permission::factory()->create([
                    'name' => $name,
                    'slug' => $permission,
                    'group' => $last,
                    'status_id' => null,
                    'description' => $name
                ]);
            }
        }
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    private function load()
    {
        //$this->permission->slug_fixed = true;

        $options = [];

        foreach (\Route::getRoutes() as $route) {

            if (isset($route->action['as'])) :

                $data = explode(".", $route->action['as']);

                if ($this->getIgnore($data)) :

                    if ($this->getRequired($data)) :
                        if (!in_array($route->action['as'], $options)) {
                            array_push($options, $route->action['as']);
                        }
                    endif;

                endif;

            endif;
        }
        return $options;
    }


    private function getIgnore($value)
    {

        $result = true;

        foreach ($this->ignore as $item) {

            if (in_array($item, $value)) {

                $result = false;
            }
        }

        return $result;
    }


    private function getRequired($value)
    {

        $result = false;

        foreach ($this->required as $item) {

            if (in_array($item, $value)) {

                $result = true;
            }
        }

        return $result;
    }

   
}
