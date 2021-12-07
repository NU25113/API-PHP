<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency', function (Blueprint $table) {
            $table->id('em_id');
            $table->string('em_category', 50);
            $table->integer('em_type');
            $table->text('em_detail');
            $table->string('em_owner', 250);
            $table->string('em_phon', 10);
            $table->string('em_pic', 200);
            $table->string('em_lat', 200);
            $table->string('em_lng', 200);
            $table->timestamp('em_created_at')->nullable();

            $table->integer('em_status');
            $table->date('em_notified')->nullabel();
            $table->string('em_notifier', 200);
            $table->string('em_province', 200);
            $table->string('em_site', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emergency');
    }
}
