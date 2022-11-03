<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Acl\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AclCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:acl   {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configura o pacote ACL';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $force = $this->option('force');

        if (File::exists(app_path('Models/User.php')) && ! $force) {
            if ($this->confirm('Deseja sobrescrever o model User?', true)) {
                File::put(app_path('Models/User.php'), file_get_contents(__DIR__.'/stubs/user-model.stub'));
            }
        }else{
          File::put(app_path('Models/User.php'), file_get_contents(__DIR__.'/stubs/user-model.stub'));
        }
        
        if (File::exists(app_path('Models/Role.php')) && ! $force) {
            if ($this->confirm('Deseja sobrescrever o model Role?', true)) {
                File::put(app_path('Models/Role.php'), file_get_contents(__DIR__.'/stubs/role-model.stub'));
            }
        }else{
            File::put(app_path('Models/Role.php'), file_get_contents(__DIR__.'/stubs/role-model.stub'));
         }
        
        if (File::exists(app_path('Models/Permission.php')) && ! $force) {
            if ($this->confirm('Deseja sobrescrever o model Permission?', true)) {
                File::put(app_path('Models/Permission.php'), file_get_contents(__DIR__.'/stubs/permission-model.stub'));
            }
        }else{
            File::put(app_path('Models/Permission.php'), file_get_contents(__DIR__.'/stubs/permission-model.stub'));
       }

        $this->call('vendor:publish',[
            '--tag' => 'acl-migrations'
        ]);
        $this->call('vendor:publish',[
            '--tag' => 'acl-factories'
        ]);
        
        $this->call('vendor:publish',[
            '--tag' => 'acl-seeder'
        ]);
        $this->line("<options=bold,reverse;fg=green> WHOOPS-IE-TOOTLES </> 😳 \n");
    }
}
