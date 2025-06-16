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
        Schema::create('registration_fixed_assets', function (Blueprint $table) {
            $table->id();
            $table->datetime('date');
            $table->string('rfa_number')->unique();
            $table->string('requestor_name');
            $table->string('issue_fixed_asset_no')->unique();
            $table->string('production_code')->nullable();
            $table->string('product_name');
            $table->string('grn_no');
            $table->integer('user_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('asset_group_id')->unsigned();
            $table->integer('asset_location_id')->unsigned();
            $table->integer('asset_cost_center_id')->unsigned();
            $table->string('remark')->nullable();
            $table->string('approval_by1', 40);
            $table->datetime('approval_date1');
            $table->enum('approval_status1', ['0', '1', '2']);
            $table->string('approval_by2', 40);
            $table->datetime('approval_date2');
            $table->enum('approval_status2', ['0', '1', '2']);
            $table->string('remark_approval_by2');
            $table->string('approval_by3', 40);
            $table->datetime('approval_date3');
            $table->enum('approval_status3', ['0', '1', '2']);
            $table->string('remark_approval_by3');
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
        Schema::dropIfExists('registration_fixed_asset');
    }
};
