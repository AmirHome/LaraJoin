<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateArticlesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('articles',function(Blueprint $table){
            $table->increments("id");
            $table->string("title")->nullable();
            $table->text("text")->nullable();
            $table->integer("user_id")->references("id")->on("user")->nullable();
            $table->integer("category_id")->references("id")->on("categories")->nullable();
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
        Schema::drop('articles');
    }

}