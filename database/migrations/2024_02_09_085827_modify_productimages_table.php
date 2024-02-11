<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProductimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('productimages', function (Blueprint $table) {
                        
            $table->integer('deleted')->default(0); // delete flag 0: undeleted, 1: deleted
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('productimages', function (Blueprint $table) {
                        
            $table->dropColumn('deleted');
            $table->dropColumn('deleted_at');
        });
    }
}
