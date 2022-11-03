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

        $name = config('acl.tables.roles','roles');
        Schema::create($name, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->string('name', 255)->unique();
            $table->string('slug', 255)->unique();
            $table->enum('special', ['no-access','all-access','no-defined'])->nullable();
            $table->enum('status',['draft','published'])->nullable()->comment("Situação")->default('published');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
