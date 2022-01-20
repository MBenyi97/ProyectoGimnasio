<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD:database/migrations/2022_01_18_162637_create_members_table.php
            $table->string('dni',9);
            $table->string('name',30);
            $table->integer('weight');
            $table->integer('height');
            $table->date('birthday');
            $table->string('sex');
=======
>>>>>>> 0457668cfbee4fb526a8ae310a193032109d45c5:database/migrations/2022_01_18_162524_create_members_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
