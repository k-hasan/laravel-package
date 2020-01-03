<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PostsTable extends Migration{

    public function up()
    {
        Schema::create('posts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('identifier')->index();
            $table->string('slug')->unique()->index();
            $table->string('title');
            $table->string('body');
            $table->text('extra');
            $table->timestamps();

            $table->index('crated_at');
            $table->index('updated_at');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }

}