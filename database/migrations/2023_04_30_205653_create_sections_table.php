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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->integer('number'); // номер секции
            $table->integer('warningValue'); // m3
            $table->integer('maximumValue'); // m3
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->bigInteger('reservoirId')->unsigned();
            $table->foreign('reservoirId', 'FK_sections_reservoirs')
                ->on('reservoirs')
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
        Schema::table('sections', function(Blueprint $table) {
            $table->dropForeign('FK_sections_reservoirs');
        });
        Schema::dropIfExists('sections');
    }
};
