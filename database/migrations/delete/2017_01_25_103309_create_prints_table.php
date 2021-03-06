<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('event_id');

            $table->timestamp('queued_at')->nullable() ;
            $table->integer('queued_by');

            $table->timestamp('printed_at')->nullable();
            $table->integer('printed_by');

            $table->timestamp('verified_at')->nullable();
            $table->integer('verified_by');

            $table->timestamp('dispatched_at')->nullable();
            $table->integer('dispatched_by');

            $table->timestamp('delivered_at')->nullable();
            $table->integer('delivered_by');

            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('deleted_by');

            $table->index('user_id') ;
            $table->index('event_id') ;

//            $table->foreign('user_id')->references('id')->on('users');
//            $table->foreign('event_id')->references('id')->on('posts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('printings');
    }
}
