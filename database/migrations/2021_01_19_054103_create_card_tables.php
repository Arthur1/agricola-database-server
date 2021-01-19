<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name_ja');
            $table->string('name_en');
            $table->integer('published_year')->nullable();
            $table->unsignedBigInteger('revision_id');
            $table->boolean('ja_is_official');
        });

        Schema::create('decks', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name_ja');
            $table->string('name_en');
        });

        Schema::create('card_types', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name_ja');
            $table->string('name_en');
        });

        Schema::create('rev2_category_icons', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name_ja');
            $table->string('name_en');
        });

        Schema::create('special_colors', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('name_ja');
        });

        Schema::create('cards', function (Blueprint $table) {
            // columns
            $table->unsignedBigInteger('id')->primary();
            $table->string('literal_id');
            $table->string('printed_id');
            $table->unsignedBigInteger('playagricola_card_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('deck_id')->nullable();
            $table->unsignedBigInteger('type_id');
            $table->string('name_ja');
            $table->string('name_en');
            $table->unsignedTinyInteger('occ_category')->nullable();
            $table->string('occ_ex_cost')->nullable();
            $table->string('imp_prereq')->nullable();
            $table->string('imp_cost')->nullable();
            $table->text('description');
            $table->boolean('ja_is_official');
            $table->integer('vps');
            $table->boolean('has_arrow');
            $table->boolean('has_bonus');
            $table->boolean('has_neg_bonus');
            $table->boolean('has_pan_icon');
            $table->boolean('has_bread_icon');
            $table->unsignedBigInteger('rev2_category_icon_id')->nullable();
            $table->unsignedBigInteger('special_color_id')->nullable();

            // foreign keys
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('deck_id')->references('id')->on('decks');
            $table->foreign('type_id')->references('id')->on('card_types');
            $table->foreign('rev2_category_icon_id')->references('id')->on('rev2_category_icons');
            $table->foreign('special_color_id')->references('id')->on('special_colors');

            // index
            $table->index('literal_id');
            $table->index('product_id');
            $table->index('deck_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
        Schema::dropIfExists('special_colors');
        Schema::dropIfExists('rev2_category_icons');
        Schema::dropIfExists('card_types');
        Schema::dropIfExists('decks');
        Schema::dropIfExists('products');
    }
}
