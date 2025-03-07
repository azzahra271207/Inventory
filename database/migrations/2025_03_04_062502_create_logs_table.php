<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT
            $table->timestamp('timestamp')->useCurrent(); // TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            $table->unsignedBigInteger('user_id'); // BIGINT UNSIGNED
            $table->string('action', 255); // VARCHAR(255)
            $table->string('table_name', 255); // VARCHAR(255)
            $table->text('old_value')->nullable(); // TEXT NULL
            $table->text('new_value')->nullable(); // TEXT NULL
            $table->string('ip_address', 255)->nullable(); // VARCHAR(255) NULL
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}