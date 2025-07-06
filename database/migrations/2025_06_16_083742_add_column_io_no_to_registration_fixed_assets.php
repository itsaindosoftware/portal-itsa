<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registration_fixed_assets', function (Blueprint $table) {
            $table->string('io_no', 50)->after('status')->nullable()->comment('IO Number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registration_fixed_assets', function (Blueprint $table) {
            $table->dropColumn('io_no');
        });
    }
};
