<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', "slug")) {
                $table->string('slug')->nullable();
            }
            if (!Schema::hasColumn('users', "document")) {
                $table->string('document')->after('slug')->nullable();
            }
            if (!Schema::hasColumn('users', "phone")) {
                $table->string('phone')->after('document')->nullable();
            }
            if (!Schema::hasColumn('users', "genger")) {
                $table->string('genger')->after('phone')->nullable();
            }
            if (!Schema::hasColumn('users', "profile")) {
                $table->string('profile')->after('genger')->nullable();
            }
            if (!Schema::hasColumn('users', "status")) {
                if (!Schema::hasColumn('users', "status_id")) {
                    if (Schema::hasTable('statuses')) {           
                        $table->foreignUuid('status_id')->nullable()->constrained('statuses')->cascadeOnDelete();
                    }
                    else{
                        $table->enum('status_id',['draft','published'])->nullable()->comment("Situação")->default('published');
                    }
                }
            }
            if (!Schema::hasColumn('users', "deleted_at")) {
                $table->softDeletes();
            }    
        });

        if(Schema::hasTable('teams')){
            Schema::table('teams', function (Blueprint $table) {
                if (!Schema::hasColumn('teams', "slug")) {
                    $table->string('slug')->nullable();
                }
                if (!Schema::hasColumn('users', "deleted_at")) {
                    $table->softDeletes();
                }    
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('slug');     
            $table->dropColumn('document');     
            $table->dropColumn('phone');     
            $table->dropColumn('genger');     
            $table->dropColumn('profile');     
        });
       
    }
};
