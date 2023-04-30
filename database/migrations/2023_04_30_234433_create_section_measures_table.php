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
        Schema::create('section_measures', function (Blueprint $table) {
            $table->id();
            $table->integer('value'); // значение замера
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->bigInteger('userId')->unsigned();
            $table->foreign('userId', 'FK_section_measures_users')
                ->on('users')
                ->references('id');
            $table->bigInteger('sectionId')->unsigned();
            $table->foreign('sectionId', 'FK_section_measures_sections')
                ->on('sections')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('section_measures', function(Blueprint $table) {
            $table->dropForeign('FK_section_measures_users');
            $table->dropForeign('FK_section_measures_sections');
        });
        Schema::dropIfExists('section_measures');
    }
};
