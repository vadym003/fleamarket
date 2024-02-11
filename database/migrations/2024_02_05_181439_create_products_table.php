<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name'); //product name

            $table->integer('user_id'); // 
            $table->integer('cat_id')->default(0); //category id
            $table->text('description')->nullable();//product description
            $table->text('shortdescription')->nullable();//product short description
            $table->text('features')->nullable();//product features
            $table->double('price', 15, 2)->nullable(); // product price (mark)
            $table->integer('type')->default(0); // product type: 0: myself, 1: others(fleamarket)
            $table->integer('amount')->default(0); // product amount
            $table->integer('deleted')->default(0); //delete flag 0: undeleted, 1: deleted
            $table->dateTime('deleted_at')->nullable();//
            $table->integer('allow_flg')->default(0); // allow flag 0: created, 1: allowed
            $table->dateTime('allowed_at')->nullable(); // allowed date 发布日期
            $table->string('dev_language')->nullable(); // Product Development Language 开发语言
            $table->string('language')->nullable(); // Product Language 支持语言
            $table->string('service')->nullable(); //Product service 服务器支持
            $table->string('install')->nullable(); //Product install 免费服务
            $table->string('others')->nullable(); //Product others
            $table->integer('testflg')->default(0); //Product Test Flag 是否提供免费测试
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
        Schema::dropIfExists('products');
    }
}
