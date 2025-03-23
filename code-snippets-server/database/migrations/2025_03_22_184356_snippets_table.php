<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('snippets', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('content');
            $table->enum('language',['JavaScript','PHP','Python','C#','Java']);
            $table->timestamps();
        });

        Schema::create('tags', function(Blueprint $table){
            $table->id();
            $table->string('tag_name');
            $table->timestamps();
        });

        Schema::create('snippet_tag', function(Blueprint $table){
            $table->unsignedBigInteger('snippet_id');
            $table->unsignedBigInteger('tag_id');

            $table->foreign('snippet_id')->references('id')->on('snippets');
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->primary(['snippet_id', 'tag_id']);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('snippets');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('snippet_tag');
    }
};
