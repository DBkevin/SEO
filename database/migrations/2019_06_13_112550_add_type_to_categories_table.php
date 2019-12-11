<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->Integer('type')->default(2)->after('meta_image')->comment("栏目类型,1代表栏目封面,2代表列表栏目,默认栏目类型为列表");
            $table->String('layout')->after('type')->nullable()->comment('栏目模板,允许为空');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->dropColumn('type');
            $table->dropColumn('layout');
        });
    }
}
