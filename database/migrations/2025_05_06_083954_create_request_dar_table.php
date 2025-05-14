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
        Schema::create('request_dar', function (Blueprint $table) {
            $table->id();
            $table->string('nik_req', 30);
            $table->string('nik_atasan', 30);
            $table->integer('dept_id');
            $table->integer('company_id');
            $table->integer('position_id');
            $table->integer('typereqform_id');
            $table->integer('user_id');
            $table->string('name_doc',100);
            $table->string('no_doc',100);
            $table->integer('qty_pages');
            $table->string('created_by');
            $table->datetime('created_date');
            $table->text('file_doc');
            $table->string('storage_type');
            $table->string('rev_no');
            $table->string('approval_by1', 40);
            $table->datetime('approval_date1');
            $table->enum('approval_status1', ['0','1','2']);
            $table->string('approval_by2', 40);
            $table->datetime('approval_date2');
            $table->enum('approval_status2', ['0','1','2']);
            $table->string('remark_approval_by2');
            $table->string('approval_by3', 40);
            $table->datetime('approval_date3');
            $table->enum('approval_status3', ['0','1','2']);
            $table->string('remark_approval_by3');
            $table->string('updated_by_1', 40);
            $table->datetime('updated_bydate_1');
            $table->string('updated_by_2', 40);
            $table->datetime('updated_bydate_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_dar');
    }
};
