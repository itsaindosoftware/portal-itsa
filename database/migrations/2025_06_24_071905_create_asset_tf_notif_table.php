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
        Schema::create('asset_tf_notif', function (Blueprint $table) {
            $table->id();
            $table->integer('reg_fixed_asset_id')->unsigned();
            $table->integer('from_qty')->nullable();
            $table->date('from_date_of_tf')->nullable();
            $table->string('from_io_no')->nullable();
            $table->integer('to_receiving_dept_id')->unsigned();
            $table->integer('to_cost_center_id')->unsigned();
            $table->integer('to_location_id')->unsigned();
            $table->integer('to_qty');
            $table->string('to_pic_name');
            $table->date('to_effective_date');
            $table->string('to_tf_fer_no_erp')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('approval_by1')->nullable();
            $table->datetime('approval_date1')->nullable();
            $table->enum('approval_status1', ['0', '1', '2']);
            $table->string('remark_by1')->nullable();
            $table->string('approval_by2')->nullable();
            $table->datetime('approval_date2')->nullable();
            $table->enum('approval_status2', ['0', '1', '2']);
            $table->string('remark_by2')->nullable();
            $table->string('approval_by3')->nullable();
            $table->datetime('approval_date3')->nullable();
            $table->enum('approval_status3', ['0', '1', '2']);
            $table->string('remark_by3')->nullable();
            $table->string('approval_by4')->nullable();
            $table->datetime('approval_date4')->nullable();
            $table->enum('approval_status4', ['0', '1', '2']);
            $table->string('remark_by4')->nullable();
            $table->string('approval_by5')->nullable();
            $table->datetime('approval_date5')->nullable();
            $table->enum('approval_status5', ['0', '1', '2']);
            $table->string('remark_by5')->nullable();
            $table->string('approval_by6')->nullable();
            $table->datetime('approval_date6')->nullable();
            $table->enum('approval_status6', ['0', '1', '2']);
            $table->string('remark_by6')->nullable();
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
        Schema::dropIfExists('asset_tf_notif');
    }
};
