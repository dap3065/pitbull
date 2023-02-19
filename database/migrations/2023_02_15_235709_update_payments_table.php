<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->float('amount', 8, 2)->change();
            $table->float('discount', 8, 2)->nullable()->change();
            $table->string('paypal_id')->nullable();
            $table->string('status')->nullable();
            $table->json('order_start')->nullable();
            $table->json('order_details')->nullable();
            $table->json('order_complete')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->float('amount')->change();
            $table->float('discount')->change();
            $table->dropColumn('paypal_id');
            $table->dropColumn('status');
            $table->dropColumn('order_start');
            $table->dropColumn('order_details');
            $table->dropColumn('order_complete');
        });
    }
}
