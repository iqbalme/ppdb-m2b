<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncTriggerAvgUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('DROP TRIGGER `calc_avg_nilai_akademik_update`');
        DB::unprepared('
            CREATE TRIGGER calc_avg_nilai_akademik_update
			BEFORE UPDATE ON `t_nilai_akademik` FOR EACH ROW
            BEGIN
			SET	NEW.avg = ((NEW.semester1+NEW.semester2+NEW.semester3+NEW.semester4+NEW.semester5)/5);
            END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DROP TRIGGER `calc_avg_nilai_akademik_update`');
    }
}
