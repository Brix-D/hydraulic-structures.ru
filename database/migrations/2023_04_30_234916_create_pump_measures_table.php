<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Objects\PumpState;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pump_measures', function (Blueprint $table) {
            $table->id();
            $table->enum('state', PumpState::values()); // статус насоса
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->bigInteger('userId')->unsigned();
            $table->foreign('userId', 'FK_pump_measures_users')
                ->on('users')
                ->references('id');
            $table->bigInteger('pumpId')->unsigned();
            $table->foreign('pumpId', 'FK_pump_measures_pumps')
                ->on('pumps')
                ->references('id');
            $table->bigInteger('sectionMeasureId')->unsigned();
            $table->foreign('sectionMeasureId', 'FK_pump_measures_section_measures')
                ->on('section_measures')
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
        Schema::table('pump_measures', function(Blueprint $table) {
            $table->dropForeign('FK_pump_measures_users');
            $table->dropForeign('FK_pump_measures_pumps');
            $table->dropForeign('FK_pump_measures_section_measures');
        });
        Schema::dropIfExists('pump_measures');
    }
};
