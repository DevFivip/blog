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
        Schema::create('section_heros', function (Blueprint $table) {
            $table->id();
            $table->integer('position');
            $table->string('title');
            $table->text('content');
            $table->text('action_button_title');
            $table->text('action_button_link');

            $table->text('secondary_button_title');
            $table->text('secondary_button_link');

            $table->timestamps();
        });

        Schema::create('section_services', function (Blueprint $table) {
            $table->id();
            $table->integer('position');
            $table->string('title');
            $table->text('content');
            $table->text('label');

            $table->text('action_button_title');
            $table->text('action_button_link');

            $table->text('secondary_button_title');
            $table->text('secondary_button_link');

            $table->timestamps();
        });

        Schema::create('section_customers', function (Blueprint $table) {
            $table->id();

            $table->integer('position');
            $table->string('title');
            $table->text('content');
            $table->text('label');

            $table->text('action_button_title');
            $table->text('action_button_link');

            $table->text('secondary_button_title');
            $table->text('secondary_button_link');

            $table->timestamps();
        });

        Schema::create('section_faqs', function (Blueprint $table) {
            $table->id();
            $table->integer('position');
            $table->string('question');
            $table->text('answer');
            // $table->text('label');
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('content');
            $table->enum('status', ['draft', 'pending', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_heros');
        Schema::dropIfExists('section_services');
        Schema::dropIfExists('section_customers');
        Schema::dropIfExists('section_faqs');
        Schema::dropIfExists('pages');
    }
};
