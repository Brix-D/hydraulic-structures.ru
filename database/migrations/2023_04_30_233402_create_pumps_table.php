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
        Schema::create('pumps', function (Blueprint $table) {
            $table->id();
            $table->integer('number'); // номер насоса
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->bigInteger('sectionId')->unsigned();
            $table->foreign('sectionId', 'FK_pumps_sections')
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
        Schema::table('pumps', function(Blueprint $table) {
            $table->dropForeign('FK_pumps_sections');
        });
        Schema::dropIfExists('pumps');
    }
};
