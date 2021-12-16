<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('password-history.table'), function (Blueprint $table) {
            $primaryIdType = config('password-history.primary_id_type') ?? "integer";
            if ($primaryIdType === "integer") {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id');
            } else if ($primaryIdType === 'uuid') {
                $table->uuid('id');
                $table->uuid('user_id');
            }

            $table->string('password');
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
        Schema::dropIfExists(config('password-history.table'));
    }
}
