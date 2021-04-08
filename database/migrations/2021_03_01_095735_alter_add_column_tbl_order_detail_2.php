<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnTblOrderDetail2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('tbl_order_detail', function (Blueprint $table) {
          $table->string('coupon',50)->nullable();
          $table->integer('feeship');
          $table->string('order_code');
      });
   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_order_detail', function (Blueprint $table) {
            $table->dropColumn('coupon');
            $table->dropColumn('feeship');
            $table->dropColumn('order_code');
        });
    }
}
