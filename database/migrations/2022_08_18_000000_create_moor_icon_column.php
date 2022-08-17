<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
        /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->boolean('has_cut_peat_icon')->after('has_bread_icon');
            $table->boolean('has_fell_trees_icon')->after('has_cut_peat_icon');
            $table->boolean('has_slash_and_burn_icon')->after('has_fell_trees_icon');
            $table->boolean('has_hiring_fare_icon')->after('has_slash_and_burn_icon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn('has_cut_peat_icon');
            $table->dropColumn('has_fell_trees_icon');
            $table->dropColumn('has_slash_and_burn_icon');
            $table->dropColumn('has_hiring_fare_icon');
        });
    }
};
