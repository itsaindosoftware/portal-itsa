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
        Schema::table('asset_tf_notif', function (Blueprint $table) {
            $table->string('pic_support')->nullable()->after('to_tf_fer_no_erp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_tf_notif', function (Blueprint $table) {
            $table->dropColumn('pic_support');
        });
    }
};
