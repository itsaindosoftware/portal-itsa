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
        Schema::create('document_control_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('distribution_id');
            $table->unsignedBigInteger('request_dar_id');
            $table->unsignedBigInteger('dept_id');
            $table->enum('action_type', ['distributed', 'received', 'returned', 'overdue']);
            $table->date('action_date');

            // Fields untuk receive
            $table->string('receiver_name', 100)->nullable();
            $table->text('receiver_signature')->nullable()->comment('base64 atau path file');
            $table->string('position', 50)->nullable();

            // Fields untuk return
            $table->string('return_receiver', 100)->nullable();
            $table->date('return_date')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('distribution_id')->references('id')->on('distribution_dar_depts')->onDelete('cascade');
            $table->foreign('request_dar_id')->references('id')->on('request_dar')->onDelete('cascade');
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');

            // Indexes untuk performance
            $table->index(['distribution_id']);
            $table->index(['request_dar_id']);
            $table->index(['dept_id']);
            $table->index(['action_type']);
            $table->index(['action_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_control_logs');
    }
};
