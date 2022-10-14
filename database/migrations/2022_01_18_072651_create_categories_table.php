<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
                $table->id();
            
            // name  varchar() unique
            $table->string('name')->unique();
            $table->string('slug')->unique();
             // $table->unsignedBigInteger('parent_id')->nullable();
            // $table->foreign('parent_id')->references('id')->on('categories')->nullOnDelete();

            //equal 
            $table->foreignId('parent_id')
                  -> nullable()
                  ->constrained('categories'  , 'id')
                  ->nullOnDelete();


               $table->text('description')->nullable();
               $table->string('art_path')->nullable();
           

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
        Schema::dropIfExists('categories');
    }
}
